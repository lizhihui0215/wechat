<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Log;
use Debugbar;
use Validator;
use App\Models\User;
use App\Jobs\SendMail;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    // success redirectPath
    protected $redirectPath = '/dashboard';

    // failed redirectPath
    protected $loginPath = '/auth/login';

    // max login attempts
    protected $maxLoginAttempts = 10;

    // logout redirectPath
    protected $redirectAfterLogout = '/auth/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
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
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
    }
    
    public function postRegister(RegisterRequest $request, UserRepository $user_gestion)
    {
      $user = $user_gestion->store($request->all(),$confirmation_code = str_random(30));

      // TODO: send mail
      $this->dispatch(new SendMail($user));

      return redirect('/auth/login')->with('ok',trans('front/verify.message'));
    }

    public function getRegister()
    {
      return view('users.register');
    }

    /*
    */
    public function getLogin()
    {
      return view('users.login');
    }

    public function postLogin(LoginRequest $request)
    {
      $identifier = $request->input('identifier');
      $password = $request->input('password');
      $remember = $request->input('remember');
      $loginMethod = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

      if ($this->hasTooManyLoginAttempts($request)) {
        $this->sendLockoutResponse($request);
        return redirect('/auth/login')->withErrors([trans('front/login.maxattempt')])
                                     ->withInput($request->only('identifier'));
      }
      $credentials = [
        $loginMethod => $identifier,
        'password' => $password
      ];

      if (!Auth::attempt($credentials,$remember)) {
        $this->incrementLoginAttempts($request);
        return redirect('/auth/login')->withErrors([trans('front/login.credentials')])
                                      ->withInput($request->only('identifier','remember'));
      }

      $user = Auth::user();
      Debugbar::info($user);
      if(!$user->confirmed){
        Auth::logout();
        $request->session()->put('user_id', $user->id);
        return redirect('/auth/login')->withErrors([trans('front/verify.again')]);
      }

      $this->clearLoginAttempts($request);
      if($request->session()->has('user_id'))	{
				$request->session()->forget('user_id');
			}
      return redirect('/dashboard');
    }

    public function getConfirm(UserRepository $user_gestion, $confirmation_code)
    {
      $user = $user_gestion->confirm($confirmation_code);
      return redirect('/auth/login')->with('ok', trans('front/verify.success'));
    }

    public function confirm($confirmation_code)
    {
      $user = $this->model->where('confirmation_code',$confirmation_code)->firstOrFail();
      $user->confirmed = true;
      $user->confirmation_code = null;
      $user->save();
    }

    public function getResend(UserRepository $user_gestion,Request $request)
    {
      if ($request->session()->has('user_id')) {
        $user = $user_gestion->getById($request->session()->get('user_id'));

        $this->dispatch(new SendMail($user));

        return redirect('/auth/login')->with('ok', trans('front/verify.resend'));
      }
      return redirect('/auth/login');
    }
}
