<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleOAuthController extends Controller
{
    public function handleProvider(){
        return Socialite::driver('google')->redirect();
    }

    public function handleRedirectBackToApp(){
        $userFromProvider = Socialite::driver('google')->user();
            //does the user already exist? If yes, then we log the user into the app. If not we save details and log user into the database
            $isUserExists = User::where('email',$userFromProvider->getEmail())
            ->where('provider_id',$userFromProvider->getId())
            ->exists();

            if($isUserExists){
                //log user into our app
                    $loginUser = User::where('email',$userFromProvider->getEmail())
                    ->where('provider_id',$userFromProvider->getId())
                    ->first();

                    Auth::login($loginUser,true);
                    return redirect('/');               
            }
            else{
                //we create new user and log user into the app
                $newUser = User::create([
                    'name' => $userFromProvider->name,
                    'email' => $userFromProvider->getEmail(),
                    'avatar' => $userFromProvider->getAvatar(),
                    'password' => null,
                    'provider_id' => $userFromProvider->getId()
                ]);
                if($newUser){
                    Auth::login($newUser,true);
                    return redirect('/');

                }
            }
    }
}
