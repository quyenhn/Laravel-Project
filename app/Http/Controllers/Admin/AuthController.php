<?php
namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use App\Http\Controllers\Controller;
use Auth;

class AuthController extends Controller
{   

    public function login(){
        if (Auth::guard('admin')->check()){
            return redirect()->route('admin.posts.list');
        }
        else{
            return view('admin.login');
        }
    }

    public function processLogin(LoginRequest $request){
        $dataRequest = $request->except('_token');
        $user = Admin::where('name',$dataRequest['username'])->first();
 //       dd($dataRequest);
      //  dd($user);
        if (Auth::guard('admin')->attempt(['name' => $dataRequest['username'], 'password' => $dataRequest['password']])){
            $user->save();
            // return view('admin.layouts.master');
            return redirect()->route('admin.posts.list');
        }
        else{
            return redirect()->back()->withErrors("Username hoặc mật khẩu không đúng");
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
       // $request->session()->flush();
        //$request->session()->regenerate();
        return redirect()->route( 'admin.login' );
    }
}