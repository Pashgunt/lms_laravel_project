<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/*
 * Класс реализации посредника для ролей пользователей
 */
class RoleMiddleware
{
    /**
     * Проверка ролей пользователя
     * @return \Illuminate\Contracts\Foundation\Application|RedirectResponse|
     * \Illuminate\Routing\Redirector|mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $roles = explode('|', $role);

        foreach ($roles as $role) {
            if (mb_strtolower($request->user()->role->role_name) === $role) {
                return $next($request);
            }
        }

        return redirect('index');
    }
}
