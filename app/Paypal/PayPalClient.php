<?php

namespace App\Paypal;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
// use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;

class PayPalClient
{
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    public static function environment()
    {
        // -------------------  live ENV -------------------
        // In production, use ProductionEnvironment.
        $clientId ="AX33yAYWKaL0h0LiSN6tyir0CGD_Ft9ztwCP2xqhQabpK8CfakgrLgPdD1TKZd16YWL6W7FINMAK1j_7";
        $clientSecret ="EFO4pLI-ENYIHdfig_V_7tdyQYDZzt_g7ZSRQqEYAhTVgYG0rHavQqM3FZyYu66WZWDGO8VHW-qrqQ8tqQUiHD-C";
        return new ProductionEnvironment($clientId, $clientSecret);

        // ----------- Sandbox ENV -----------
        // This sample uses SandboxEnvironment. 
        // $clientId ="AdeKmKTa4nB9aWe7oZbheexKhuDFwXkfJIwjf8qcbdVlek869ZnqJ34TvF-rUvJcjVSRcXh26ff7VdDk";
        // $clientSecret ="EFO4pLI-5AN46UqSEYLaShkveQKgig8X1B0wCv5PHB2XjzUb4VbRBXGml9zdFeqS02U0ygTDzzuj3U8A";
        // return new SandboxEnvironment($clientId, $clientSecret);
        
    }
}
