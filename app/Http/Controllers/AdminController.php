<?php

namespace App\Http\Controllers;
use App\Article;
use App\User;
use Carbon\Carbon;
use App\Http\Requests\CreateAdminRequest;
use App\Repositories\backend\Admin\AdminRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
	 public function __construct(AdminRepositoryInterface $admin)
    {
        $this->admin = $admin;
    }
    public function index(){
        $dataAdmin = $this->admin->all();
        //dd($dataAdmin);
        return view('admin.admin_account.index', compact('dataAdmin'));
    }

    public function add(){
        return view('admin.admin_account.add');
    }

    public function processAdd(CreateAdminRequest $request){
        $check = $this->admin->checkIfExist($request->username, $request->email);

        if ($check==0){
            return redirect()->back()->withErrors("Username đã được sử dụng!");
        }
        elseif($check==1){
            return redirect()->back()->withErrors("Email đã được sử dụng!");
        }
        else{
            if($this->admin->save($request->except('_token'))){
                return redirect()->route('admin.admin_account.index');
            }
            else{
                return redirect()->back()->withErrors('Tạo tài khoản thất bại!');
            }
        }
    }

    public function my_profile(){
        return view('admin.my_profile.index');
    }

    public function delete($id){
        $delete = $this->admin->delete($id);
        if ($delete==true){
            return redirect()->back();
        }else{
            return redirect()->back()->withErrors('Xóa tài khoản thất bại');
        }
    }
    public function post_list()
    {
    	$posts=Article::all();
    	return view('admin.posts.post_list',compact('posts'));
    }
    public function post_new()
    {
    	$posts=Article::whereDate('created_at', Carbon::today())->get();;
    	return view('admin.posts.post_new',compact('posts'));
    }
    public function getUserList()
    {
    	$dataUser=User::all();
    	return view('admin.user_account.index',compact('dataUser')); 
    }
    public function change_status($id){
    	$user = User::find($id);
        if ($user){
            if ($user->active==1){
                $user->active = 0;
            }
            else{
                $user->active = 1;
            }
            $change_status = $user->save();
            return redirect()->back();
        }
        else{
            return redirect()->back()->withErrors('Đổi trạng thái thất bại');
        }
        
    }
    public function user_new(Request $request)
    {
    	//$dataUser=User::whereDate('created_at', Carbon::today())->get();
        $startDate = Input::get('start_date');
      //  \Log::info('start date'.$startDate);
        $endDate = Input::get('end_date'); 
     //    \Log::info('end date'.$endDate);
        if ($startDate>$endDate) 
        {
            return view('admin.user_account.user_new')->with('startDate',$startDate)->with('endDate',$endDate)->with('alert_danger', 'Ngày kết thúc phải sau ngày bắt đầu!');
        }
        $dataUser=User::whereBetween(\DB::raw('DATE(created_at)'),[$startDate,$endDate])->orderBy('created_at','desc')->get()->groupBy(function($item) {
            return $item->created_at->format('Y-m-d');
        });
       // dd($dataUser->isEmpty());
        if ($dataUser->isEmpty() && $startDate!=null && $endDate!=null) {
//            $request->session()->flash('alert', 'Không có kết quả!');
            return view('admin.user_account.user_new')->with('startDate',$startDate)->with('endDate',$endDate)->with('alert_warning', 'Không có user nào đăng ký trong khoảng ngày đã chọn!');
        }
    	return view('admin.user_account.user_new',compact('dataUser','startDate','endDate'));
    }
    public function user_active()
    {   
        //$dataUser=User::where('last_login_at','>=', Carbon::now()->subMinute())->get();
        //$dataUser=User::whereDate('last_login_at', Carbon::today())->get();
        $startDate = Input::get('start_date');
        $endDate = Input::get('end_date'); 
        if ($startDate>$endDate) 
        {
            return view('admin.user_account.user_active')->with('startDate',$startDate)->with('endDate',$endDate)->with('alert_danger', 'Ngày kết thúc phải sau ngày bắt đầu!');
        }
        $dataUser=\App\Activity::whereBetween('day',[$startDate,$endDate])->orderBy('day','desc')->get()->groupBy(function($item) {
            return $item->day;
        });
        if ($dataUser->isEmpty() && $startDate!=null && $endDate!=null) 
        {
            return view('admin.user_account.user_active')->with('startDate',$startDate)->with('endDate',$endDate)->with('alert_warning', 'Không có user nào hoạt động trong khoảng ngày đã chọn!');
        }
        //dd($dataUser);
        return view('admin.user_account.user_active',compact('dataUser','startDate','endDate'));
    }
     public function update_avatar(Request $request)
    {

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = \Auth::guard('admin')->user();

        $avatarName = $user->id.'_avatar'.time().'_'.request()->avatar->getClientOriginalName();

        $request->avatar->storeAs('avatars',$avatarName);

        $user->avatar = $avatarName;
        $user->save();

        return back()
            ->with('alert','You have successfully upload image.');

    }
    public function delete_post($id)
    {
        $article=Article::find($id);
        $article->delete();
        return redirect()->back();
    }
}
