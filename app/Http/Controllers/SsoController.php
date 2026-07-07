<?php

namespace App\Http\Controllers;

use App\Services\SsoTokenIssuer;
use Illuminate\Http\Request;

class SsoController extends Controller
{
    public function launchPharmacy(Request $request, SsoTokenIssuer $issuer)
    {
        $user = $request->user();

        $token = $issuer->issueFor($user);

        $url = config('sso.pharmacy_callback_url') . '?token=' . urlencode($token);

        return redirect()->away($url);
    }
}
