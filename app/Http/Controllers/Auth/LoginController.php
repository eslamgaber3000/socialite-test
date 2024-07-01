<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }


    public function redirectGoogle(){
        return Socialite::driver('google')->redirect();

    }
    public function redirectGoogleCallback(){
        $user = Socialite::driver('google')->user();  
        $this->_registerOrLoginUser($user);
        return redirect()->route('home'); 
     }

    public function redirectFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function redirectFacebookCallback(){
        $user = Socialite::driver('facebook')->user();
        $this->_registerOrLoginUser($user);
        return redirect()->route('home');
    }
    
    public function redirectGithub(){
        return Socialite::driver('github')->redirect();
    }

    public function redirectGithubCallback(){
        $user=Socialite::driver('github')->user();
        $this->_registerOrLoginUser($user);
        return redirect()->route('home');
    }
    protected function _registerOrLoginUser($data)
    {
    $user =User::where("email",'=',$data->email)->first();
    if(! $user)
    {
    $user = new User();
    $user->name = $data->name;
    $user->email = $data->email;
    $user->provider_id = $data->id;
    // $user->avatar = $data->avatar;
    $user->save();
    }
    Auth::login($user);
    }
    
}
