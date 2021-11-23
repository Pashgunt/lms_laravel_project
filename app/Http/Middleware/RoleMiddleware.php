<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Проверка ролей пользователя
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $roles = explode('|', $role);

        foreach ($roles as $role) {
            if ($request->user()->hasRole($role)) {
                return $next($request);
            }
        }

        return redirect('index');
    }
}
