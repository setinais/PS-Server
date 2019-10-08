<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VerifiedEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $credentials['email'] = $request['username'];
        $credentials['password'] = $request['password'];
        $user = Auth::attempt($credentials);
        if($user){
            if(!Auth::user()->hasVerifiedEmail()) {
                return response()->json(
                    [
                        'message' => 'E-mail não verificado, por favor olhe sua caixa de entrada ou spam!!',
                        'errors' => true,
                        'data' => Auth::user()->hasVerifiedEmail()
                    ], 422
                );
            }else{
                Auth::logout();
                return $next($request);
            }
        }else{
            return $next($request);
        }



    }
}
