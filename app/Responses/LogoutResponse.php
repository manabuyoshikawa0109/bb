<?php

namespace App\Responses;

use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // 参考：https://www.4web8.com/25845.html
        $path = '/';
        if(request()->is('admin') || request()->is('admin/*')){
            $path = '/admin';
        }
        return $request->wantsJson()
                    ? new JsonResponse('', 204)
                    : redirect($path);
    }
}
