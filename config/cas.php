<?php

return [
    'hostname' => env('CAS_HOSTNAME', 'shib.idm.umd.edu'),
    'uri' => env('CAS_URI', '/shibboleth-idp/profile/cas'),
    'port' => env('CAS_PORT', 443),
    'version' => env('CAS_VERSION', '3.0'),
    'login_url' => env('CAS_LOGIN_URL', 'https://shib.idm.umd.edu/shibboleth-idp/profile/cas/login'),
    'logout_url' => env('CAS_LOGOUT_URL', 'https://shib.idm.umd.edu/shibboleth-idp/profile/cas/logout'),
    'service_validate_url' => env('CAS_SERVICE_VALIDATE_URL', 'https://shib.idm.umd.edu/shibboleth-idp/profile/cas/serviceValidate'),
];