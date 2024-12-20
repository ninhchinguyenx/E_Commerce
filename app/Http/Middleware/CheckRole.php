<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        $user = Auth::user();
        $roles = explode(',', $roles);
        
        // Kiểm tra nếu user không tồn tại hoặc vai trò không hợp lệ
        if (!$user || !in_array( strtolower($user->role->name), $roles)) {
            toastr()->error('Bạn không có quyền truy cập vào page này.');
            return redirect('/login-admin');
        }
        return $next($request);
    }
}
