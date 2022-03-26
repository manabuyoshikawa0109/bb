<?php

namespace App\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Providers\RouteServiceProvider;

/**
 * 管理者 ログイン後のリダイレクト先
 */
class AdminLoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // 管理者のログイン後に遷移させたいリダイレクト先を指定
        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended(RouteServiceProvider::ADMIN_HOME);
    }
}
