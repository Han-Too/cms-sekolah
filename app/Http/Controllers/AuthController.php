<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            User::where("username", $request->username)
                ->update([
                    "last_login" => Carbon::now()->format("Y-m-d H:i:s"),
                ]);

            Token::create([
                'user_token' => $user->user_token,
                'token' => Str::random(24),
                'expired_at' => Carbon::now()->addHours(2)
            ]);

            $request->session()->regenerate();

            return redirect("dashboard");
        } else {
            return back()->withErrors([
                'msg' => 'Username Tidak Terdaftar',
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
