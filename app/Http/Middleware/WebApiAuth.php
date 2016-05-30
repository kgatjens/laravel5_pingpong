<?php

namespace HepC\Http\Middleware;

use Closure;
use Hash;

class WebApiAuth
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
        // 1) get the required fields
        $token    = $request->input('token');
        $datetime = $request->input('datetime');
        $secret   = config('auth.secret');

        // 2) get the current time
        $current_time = time();

        // 3) allow time 6 before and after current time
        $current_time_before = time() - ( 6 * 60 * 60 );
        $current_time_after = time() + ( 6 * 60 * 60 );

        // 4) check for require fields
        //if( is_null($token) || is_null($datetime) ){
        if( is_null($token)){
            return \Response::json(array('error'=> 'Invalid request.'), 501);
        }

        // 5) check for timestamp//
        // if( ($datetime < $current_time_before) || ($datetime > $current_time_after) ){
        //     return \Response::json(array('error'=> 'Invalid request.'), 501);
        // } 

        // 6) generate token
        //$_token = hash('sha256', 'hepC'.$secret.'app'.$datetime);

        // 7) check for token
        // if( $_token != $token ){
        //     return \Response::json(array('error'=> 'Invalid token.'), 501);
        // }

        // 8) continue
        return $next($request);
    }
}
