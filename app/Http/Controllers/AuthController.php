<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function googleAuth() {
        return Socialite::driver('google')->with(['prompt' => 'select_account'])->redirect();
    }

    public function googleCallback() {
        
        try {

            $user = Socialite::driver('google')->user();
            $find_user = User::where('google_id', $user->id)->orWhere('email', $user->email)->first();


            if($find_user) {

                Auth::login($find_user);
                return redirect()->intended('/');

            } else {

                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_@$?&%#!`';

                $random_pasword = substr(str_shuffle($characters), 0, 16);

                $new_user = User::create([
                    'name' => $user->name,
                    'email' =>$user->email,
                    'google_id' => $user->id,
                    'password' => hash::make($random_pasword),
                ]);

                Auth::login($new_user);
                return redirect()->intended('/');

            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

}
