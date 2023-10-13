<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User; 

class ProviderController extends Controller
{
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){ 

        try{
            $socialUser = Socialite::driver($provider)->user();  
        } catch(Excemption $e){
            return redirect('/');
        }
 
        $user = User::updateOrCreate([
            'provider_id' => $socialUser->id,
            'provider' => $provider
        ], [
            'name' => $socialUser->name,
            'avatar'=>$socialUser->avatar,
            'username' => User::generateUsername($socialUser->nickname), 
            'email' => $socialUser->email,
            'provider_token' => $socialUser->token
        ]);
     
        Auth::login($user);
     
        return redirect('/products');
    }
    public function logout()
{
    Auth::logout(); // Log the user out
    return redirect('/signin') ; // Redirect to the login page or any other desired page
}
}
