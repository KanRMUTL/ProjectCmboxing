<?php

namespace App\Paypal;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

class PayPalClient
{
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    public static function environment()
    {
        $clientId ="AdeKmKTa4nB9aWe7oZbheexKhuDFwXkfJIwjf8qcbdVlek869ZnqJ34TvF-rUvJcjVSRcXh26ff7VdDk";
        $clientSecret ="EFO4pLI-5AN46UqSEYLaShkveQKgig8X1B0wCv5PHB2XjzUb4VbRBXGml9zdFeqS02U0ygTDzzuj3U8A";
       // This sample uses SandboxEnvironment. 
       // In production, use ProductionEnvironment.
        return new SandboxEnvironment($clientId, $clientSecret);
    }
}
