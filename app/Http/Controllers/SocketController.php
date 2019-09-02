<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use LRedis;
use Auth;
class SocketController extends Controller
{
    public function index()
    {
        $friends = User::where('id','!=',auth()->user()->id)->get();
        return view('socketchat.index',compact('friends'));
    }
    public function show($id)
    {
        $friend = User::find($id);
        $msgs = Message::where(function($q) use ($id) {
            $q->where('from', auth()->id());
            $q->where('to', $id);
        })->orWhere(function($q) use ($id) {
            $q->where('from', $id);
            $q->where('to', auth()->id());
        })->orderBy('created_at','asc')
        ->get();
        // dd($msgs);
        return view('socketchat.show',compact('friend','msgs'));
    }
    public function store(Request $request){
        $message = Message::create([
            'from' => Auth::user()->id,
            'to' => $request->to,
            'text' => $request->text
        ]);
        $redis = LRedis::connection();
        $redis->publish('message', json_encode($message));

        return response()->json(true);
        
        
    }

}
