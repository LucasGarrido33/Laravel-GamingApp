<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\SocialAccountService;

use Socialite;
use Auth;

use App\Profile;
use App\User;

class SocialAuthController extends Controller
{

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(SocialAccountService $service, $provider,  Request $request)
    {
        $socialiteDriver = Socialite::driver($provider);
        $providerUser = $socialiteDriver->user();
        $providerName = class_basename($socialiteDriver);

        $user = $service->createOrGetSocialAccountUser($providerUser , $providerName);

        //si l'utilisateur n'existe pas on garde les informations du provider en sessions puis on redirige vers la page pour terminer l'inscription.
        if (!$user){
            $request->session()->put('socialUser', $providerUser);
            $request->session()->put('provider', $providerName);

            return redirect('/register/social');
        }

        auth()->login($user);

        return redirect('/');
    }


    public function create(SocialAccountService $service ,Request $request){

            $this->validate($request, [
                'name' => 'required|max:255|unique:users,username',
                'password' => 'required|min:6|confirmed',
            ]);

            //on creer un user avec les informations en session
            User::create([
                'email' => $request->session()->get('socialUser.email'),
                'username' => $request->name,
                'password' => bcrypt($request->password),
            ]);

            $user = $service->createOrGetSocialAccountUser($request->session()->get('socialUser'), $request->session()->get('provider'));
            $user->profile()->save(new Profile);
            Auth::login($user);
            $request->session()->forget('socialUser');

        return redirect('/');
    }

    public function terminateRegister()
    {
            return view('auth.social.terminateregister');
    }

}
