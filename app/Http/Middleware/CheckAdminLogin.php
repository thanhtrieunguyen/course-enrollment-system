<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('isAdmin')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập quyền Admin!');
        }

        return $next($request);
    }
}
