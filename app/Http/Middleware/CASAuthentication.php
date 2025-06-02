<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use phpCAS;

class CASAuthentication
{
    public function handle(Request $request, Closure $next)
    {
        if (!phpCAS::isInitialized()) {
            $this->initializeCAS();
        }

        if (!phpCAS::isAuthenticated()) {
            return redirect()->route('login');
        }

        return $next($request);
    }

    private function initializeCAS()
    {
        $casVersion = CAS_VERSION_3_0;
        $casHostname = config('cas.hostname');
        $casPort = config('cas.port');
        $casUri = config('cas.uri');

        phpCAS::client($casVersion, $casHostname, $casPort, $casUri, true);
        phpCAS::setNoCasServerValidation();

        phpCAS::setServerLoginURL(config('cas.login_url'));
        phpCAS::setServerServiceValidateURL(config('cas.service_validate_url'));

        \Log::info("CAS Middleware: Initialized with version $casVersion, hostname $casHostname, port $casPort, uri $casUri");
    }
}