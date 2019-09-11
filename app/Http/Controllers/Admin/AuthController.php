<?php
namespace App\Http\Controllers\Admin;
use Auth;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    protected $guard = 'admin';
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
     protected $redirectTo = 'admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$this->middleware('guest:admin')->except('logout');
    }

    public function getLogin()
    {
    	return view('admin.login');
    }

       public function postLogin(Request $request)
    {
        // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:8'
      ]);
      // Attempt to log the user in
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('admin.dashboard'));
      }
      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function getRegister()
    {
    	return view('admin.register');
    }

    public function postRegister(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
    	return Validator::make($data, [
    		'name' => ['required', 'string', 'max:255'],
    		'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
    		'password' => ['required', 'string', 'min:8', 'confirmed'],
    	]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   
       return Admin::create([  //cho nay mac dinh return luon
       	'name' => $data['name'],
       	'email' => $data['email'],
       	'password' => Hash::make($data['password']),
       ]);
   }
}
