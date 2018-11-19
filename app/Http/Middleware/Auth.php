<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Session\Session;

class Auth
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
        $session = new Session();
        if ($session->has('auth')) {
            return $next($request);
        }
        else {
            $session = new Session();
            $session->set('alert-login','Bạn chưa đăng nhập, vui lòng đăng nhập trước');
            return redirect()->route('frontend_getLogin');
        }
        return $next($request);
    }
}
