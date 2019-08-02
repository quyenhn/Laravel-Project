<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Message;
use LRedis;
use App\Events\NewMessage;
use Illuminate\Http\Request;
use Helper;
class ChatController extends Controller
{   
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function get()
    {
        $contacts = User::find(auth()->user()->id)->friends();//->whereNotIn('id',auth()->id()) ;//dd($contacts);
        // User::where('id', '!=', auth()->user()->id)->get(); 
        // get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        $unreadIds = Message::select(\DB::raw('"from" as sender_id, count("from") as messages_count'))
            ->where('to', auth()->id())
            ->where('read', false)
            ->groupBy('from')
            ->get();
        // add an unread key to each contact with the count of unread messages
        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();
            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
            return $contact;
        });
        /*->where('id', '!=', auth()->user()->id)->*/
         return response()->json($contacts);
    }
    
    public function getMessagesFor($id)
    {
        // mark all messages with the selected contact as read
        Message::where('from', $id)->where('to', auth()->id())->update(['read' => true]);
        // get all messages between the authenticated user and the selected user
        $messages = Message::where(function($q) use ($id) {
            $q->where('from', auth()->id());
            $q->where('to', $id);
        })->orWhere(function($q) use ($id) {
            $q->where('from', $id);
            $q->where('to', auth()->id());
        })->orderBy('created_at','asc')
        ->get();
        return response()->json($messages);
    }
    public function send(Request $request)
    {
        $message = Message::create([
            'from' => auth()->id(),
            'to' => $request->contact_id,
            'text' => $request->text
        ]);
        broadcast(new NewMessage($message))->toOthers();
        return response()->json($message);
    }
    public function index()
    {
         return view('chat-room.index');
    }
////chat public
    public function getMessages()//get messages public
    {
        $messages = Message::where('to',null)->select('messages.*','name','avatar')->join('users','users.id','=','from')->orderBy('created_at','asc')->get();

        return response()->json($messages,200);
    }
    public function sendMessage(Request $request)//send messages to public 
    {
        //$data = $request->only(['name','body']);
        $message = Message::create([
            'from' => auth()->id(),
            'text' => $request->text
        ]);

        $redis = LRedis::connection();
        $redis->publish('message',json_encode($message));
        
        return response()->json($message,200);
    }
    public function public_chat()
    {
         return view('chat-room.public_chat');
    }
    public function getAllUser()
    {
        // $users = User::all();
        $users = Helper::loggedUsers();
       // dd($users);
        return response()->json($users);
    }
    public function send_public()
    {
        $redis = LRedis::connection();
        $redis->publish('message',"day la tin nhan test ne`");
        return "da published";
    }
}
