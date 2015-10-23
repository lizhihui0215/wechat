<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Jobs\SendMail;
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
    protected $redirectPath = '/profile';

    // failed redirectPath
    protected $loginPath = '/auth/login';

    // max login attempts
    protected $maxLoginAttempts = 10;
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
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
      $identifier = $request->input['identifier'];
      $password = $request->input['password'];
      $memory = $request->input['memory'];

      $identifier = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';




      return view('dashboards.dashboard');
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
}
