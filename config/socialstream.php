<?php

use JoelButcher\Socialstream\Features;
use JoelButcher\Socialstream\Providers;

return [
    'middleware' => ['web'],
    'prompt' => null,
    'providers' => [
         Providers::google(),
    ],
    'features' => [
        // Features::generateMissingEmails(),
         Features::createAccountOnFirstLogin(),
        // Features::globalLogin(),
        // Features::authExistingUnlinkedUsers(),
        Features::rememberSession(),
        Features::providerAvatars(),
        Features::refreshOAuthTokens(),
    ],
    'home' => '/dashboard',
    'redirects' => [
        'login' => '/dashboard',
        'register' => '/dashboard',
        'login-failed' => '/login',
        'registration-failed' => '/register',
        'provider-linked' => '/user/profile',
        'provider-link-failed' => '/user/profile',
    ]
];
