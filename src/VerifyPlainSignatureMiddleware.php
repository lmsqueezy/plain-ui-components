<?php

namespace LemonSqueezy\PlainUiComponents;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class VerifyPlainSignatureMiddleware
{
    /**
     * Handle the incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless($signature = $request->header('plain-request-signature'), 400, 'Missing webhook signature.');
        abort_unless($secret = Config::get('plain.secret'), 403, 'No webhook secret configured.');
        abort_unless(hash_equals(hash_hmac('sha256', $request->getContent(), $secret), $signature), 403, 'Invalid signature.');

        return $next($request);
    }
}
