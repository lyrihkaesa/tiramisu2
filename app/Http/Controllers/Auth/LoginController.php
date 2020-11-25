<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;
use Auth;
use App\User;

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
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

  	public function showLoginForm()
    {
      return redirect('/fb-login');
    }

  	public function redirect()
    {
      return Socialite::driver('facebook')
        ->usingGraphVersion('v7.0')->redirect();
    }

  	public function callback()
    {
      $facebook = Socialite::driver('facebook')->user();

      $user = $this->findOrCreate($facebook);

      if($user->banned == 1)
      {
        return redirect('/')->with('gagal', 'Akun di banned!! hubungi admin untuk menindak lanjuti');
      }

      Auth::login($user, true);

      $user->historyLogin()->create([
      	'ip'	=> request()->ip(),
        'browser'	=> request()->userAgent(),
        'extra'		=> 'Logged In!!'
      ]);

      return redirect($this->redirectTo);

    }

  	public function findOrCreate($facebook)
    {
      $user = User::where('provider_id',$facebook->getId())->first();

      $raw = $facebook->getRaw();

      $uname = $facebook->getName();

      $uname = explode(' ',$uname);
      $name = str_slug($uname[0]).rand(000,999);

      $gender = $raw['gender'] ?? 'hode';

      switch($gender)
      {
        case 'male':
          $gender = 'cowok';
          break;
        case 'female':
          $gender = 'cewek';
          break;
        default:
          $gender = 'hode';
          break;
      }

      if( ! $user)
      {
        $user = new User;
        $user->provider_id = $facebook->getId();
        $user->name = $facebook->getName();
        $user->email = $facebook->getEmail();
        $user->biodata = 'Saya pemain Toram!';
        $user->ign = '-';
        $user->username = $name;
        $user->gender = $gender;
        $user->alamat = 'Bumi, Indonesia';
        $user->link = $raw['link'] ?? '-';
        $user->save();
      }

      return $user;
    }


  	public function devLogin()
    {
      // must be only in development
      if(! app()->isLocal())
      {
        return $this->redirect();
      }

      // login as admin

      if (request()->has('user')) {
        $user = User::find(1326);
      } else {
        $user = User::find(1);
      }

      Auth::login($user, true);

      $user->historyLogin()->create([
      	'ip'	=> request()->ip(),
        'browser'	=> request()->userAgent(),
        'extra'		=> 'Logged In as Development!!'
      ]);

      return redirect($this->redirectTo);
    }

}