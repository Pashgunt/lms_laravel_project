<?php

namespace App\Http\Middleware;

use App\Models\Courses;
use Closure;
use Illuminate\Http\Request;

/**
 * Проверка, что студенту назначен курс, к которому он обращается
 */
class AppointmentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        foreach ($request->user()->appointments as $appointment) {
            if ($appointment->course->id === $request->courseId->id) {
                return $next($request);
            }
        }

        return abort(404);
    }
}
