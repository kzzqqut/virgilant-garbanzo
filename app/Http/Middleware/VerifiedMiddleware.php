<?php
/**
 * Created by PhpStorm.
 * User: kzzqqut
 * Date: 10/26/17
 * Time: 4:41 AM
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class VerifiedMiddleware
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
        $user = User::all()->count();
        if (!($user == 1)) {
            if (!Auth::user()->hasPermissionTo('Manage objects')) //If user does //not have this permission
            {
                abort('401');
            }
        }

        return $next($request);
    }
}