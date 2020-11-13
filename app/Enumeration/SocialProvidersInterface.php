<?php

namespace App\Enumeration;
interface SocialProvidersInterface
{
    const PROVIDER_FACEBOOK = 'facebook';
    const PROVIDER_GOOGLE = 'google';
    const PROVIDERS = [
        self::PROVIDER_FACEBOOK,
        self::PROVIDER_GOOGLE,
    ];
}