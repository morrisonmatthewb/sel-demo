<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpCAS;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->initializeCAS();
    }

    public function login()
    {
        try {
            \Log::info('Login method called');
            
            if (!phpCAS::isInitialized()) {
                \Log::info('CAS not initialized, initializing now');
                $this->initializeCAS();
            }

            \Log::info('Checking if user is already authenticated');
            if (phpCAS::isAuthenticated()) {
                $user = phpCAS::getUser();
                \Log::info("User already authenticated: $user");
                session(['cas_user' => $user]);
                return redirect('/')->with('success', 'Already logged in');
            }

            \Log::info('User not authenticated, forcing authentication');
            phpCAS::forceAuthentication();

            // This line should not be reached as forceAuthentication should redirect
            \Log::warning('Reached unexpected point after forceAuthentication');
            return redirect('/')->with('error', 'Unexpected authentication flow');

        } catch (\Exception $e) {
            \Log::error('CAS Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response($e->getMessage() . "\n" . $e->getTraceAsString(), 500)
                ->header('Content-Type', 'text/plain');
        }
    }

    public function logout()
    {
        \Log::info('Logout method called');
        if (phpCAS::isInitialized()) {
            \Log::info('CAS is initialized, proceeding with logout');
            session()->forget('cas_user');
            phpCAS::logout(['url' => url('/')]);
        } else {
            \Log::warning('CAS not initialized during logout');
            session()->forget('cas_user');
            return redirect('/');
        }
    }

    private function initializeCAS()
    {
        if (!phpCAS::isInitialized()) {
            $casVersion = CAS_VERSION_3_0;
            $casHostname = config('cas.hostname');
            $casPort = config('cas.port');
            $casUri = config('cas.uri');

            \Log::info("Initializing CAS with: version=$casVersion, hostname=$casHostname, port=$casPort, uri=$casUri");

            phpCAS::client($casVersion, $casHostname, $casPort, $casUri, true);
            phpCAS::setNoCasServerValidation();

            $loginUrl = config('cas.login_url');
            $validateUrl = config('cas.service_validate_url');
            
            phpCAS::setServerLoginURL($loginUrl);
            phpCAS::setServerServiceValidateURL($validateUrl);

            \Log::info("CAS Login URL: $loginUrl");
            \Log::info("CAS Validate URL: $validateUrl");
            \Log::info('CAS initialization completed');
        } else {
            \Log::info('CAS already initialized');
        }
    }
}