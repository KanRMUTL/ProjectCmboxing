<?php

namespace App\Paypal;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
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
        // $clientId ="AX33yAYWKaL0h0LiSN6tyir0CGD_Ft9ztwCP2xqhQabpK8CfakgrLgPdD1TKZd16YWL6W7FINMAK1j_7";
        // $clientSecret ="EFO4pLI-ENYIHdfig_V_7tdyQYDZzt_g7ZSRQqEYAhTVgYG0rHavQqM3FZyYu66WZWDGO8VHW-qrqQ8tqQUiHD-C";
        // return new ProductionEnvironment($clientId, $clientSecret);
        // -------------------  live ENV -------------------
        // In production, use ProductionEnvironment.
        // $clientId ="AX33yAYWKaL0h0LiSN6tyir0CGD_Ft9ztwCP2xqhQabpK8CfakgrLgPdD1TKZd16YWL6W7FINMAK1j_7";
        // $clientSecret ="EFO4pLI-ENYIHdfig_V_7tdyQYDZzt_g7ZSRQqEYAhTVgYG0rHavQqM3FZyYu66WZWDGO8VHW-qrqQ8tqQUiHD-C";
        // return new ProductionEnvironment($clientId, $clientSecret);

        // ----------- Sandbox ENV -----------
        // This sample uses SandboxEnvironment. 
        $clientId ="YRdeNWYAop7ueYexmDKFc9zSxN0ILG6Pji7dN5-0cIZFw_4Vi-ByQ9S7Ur6X6Ga_uPUhgmb9ZlJQ6sP";
        $clientSecret ="EHEASCVdqwbNT8_gdOhleG-7VswgiUB7ZjcAgiNoRO8YxLUXBk-tap9X9oKHgtcHP9HnZLuQKT0J2hBn";
        return new ProductionEnvironment($clientId, $clientSecret);
        
    }
}
