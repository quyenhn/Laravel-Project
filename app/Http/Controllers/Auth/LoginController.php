<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Session;
use Redirect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redis;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['guest','checkbanned'])->except('logout');
        
    }

   /* protected function credentials(\Illuminate\Http\Request $request) {
        return ['email' => $request->{$this->username()}, 'password' => $request->password, 'active' => 1];

    }*/

    /*public function logout(Request $request) 
    {
       Auth::logout();
       return redirect('/login');
    //Auth::logout();
    //Session::flash('message', "Logout success sir!");
    //return Redirect::to('/login');
   }*/

    // Overriding the authenticated method from Illuminate\Foundation\Auth\AuthenticatesUsers
   protected function authenticated(Request $request, $user)
   {
    if(Auth::check() && Auth::user()->active == 1){
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
    }
        // Building namespace for Redis
    $id = $user->id;
    $browser = $request->server('HTTP_USER_AGENT');
    $namespace = 'users:'.$id.$browser;

        // Getting the expiration from the session config file. Converting from minutes to seconds.
    $expire = config('session.lifetime') * 60;

        // Setting redis using id as value
    Redis::SET($namespace,$id);
    Redis::EXPIRE($namespace,$expire);
}

    // Overriding the logout method from Illuminate\Foundation\Auth\AuthenticatesUsers
public function logout(Request $request)
{
        // Building namespace for Redis
    $id = Auth::user()->id;
    $browser = $request->server('HTTP_USER_AGENT');
    $namespace = 'users:'.$id.$browser;

        // Deleting user from redis database when they log out
    Redis::DEL($namespace);

    $this->guard()->logout();
   

   // $request->session()->flush();

    //$request->session()->regenerate();

    return redirect('/');
}
}
