<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class CookieConsentController extends Controller
{
    public function consent(): JsonResponse
    {
        return response()
            ->json(['cookie_consent' => true])
            ->cookie(config('cookie-consent.cookie_name'), 1, 2628000);
    }
}
