<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateRequest\RecoveryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

/**
 * Контроллер для изменения пароля
 */
class PasswordResetLinkController extends Controller
{

    /**
     * Возвращение блока для изменения пароля
     */
    public function create(): View
    {
        return view('recovery');
    }

    /**
     * Изменение пароля
     */
    public function store(RecoveryRequest $request): RedirectResponse
    {

        /**
         * Валидация полей
         */
        $request->validated();

        /**
         * Отправление письма
         */
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
