<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Closure;
use Illuminate\Http\Request;

class cekLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('/')->withErrors([
                'msg' => 'Harap Login Terlebih Dahulu!',
            ]);
        } else {
            $user = auth()->user();
            $token = Token::where('user_token', $user->user_token)->first();

            if (empty($token)) {
                return redirect()->route('/')->withErrors([
                    'msg' => 'Harap Login Terlebih Dahulu!',
                ]);
            }

            return $next($request);
        }

    }
}
