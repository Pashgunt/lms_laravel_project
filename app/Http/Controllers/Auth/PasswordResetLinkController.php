<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateRequest\RecoveryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;


class PasswordResetLinkController extends Controller
{

    public function create()
    {
        return view('recovery');
    }

    public function store(RecoveryRequest $request): RedirectResponse
    {
        $this->validateController->checkRecovery($request);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
