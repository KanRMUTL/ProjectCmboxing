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
        // -------------------  Sanbox ENV Developer's token -------------------
        // In production, use ProductionEnvironment.
        $clientId ="AYyIR29sBnQywy4Gwn0-BU77TM_0Io4MP5R8CGAkh1RpyACdgsRTZWRepiL7oY3OM4oVtpwqcaPlpdZI";
        $clientSecret ="EE-uXtJk9JGo81BU-tBIIyuXnygoxq2g1o72D9mj4cc2klPF3pD_twh_7iL3igT99EfEKQE-jsu1fg60";
        return new SandboxEnvironment($clientId, $clientSecret);

 
        // // ----------- Live ENV Token of CMBS -----------
        // // This sample uses ProductionEnvironment. 
        // $clientId ="YRdeNWYAop7ueYexmDKFc9zSxN0ILG6Pji7dN5-0cIZFw_4Vi-ByQ9S7Ur6X6Ga_uPUhgmb9ZlJQ6sP";
        // $clientSecret ="EHEASCVdqwbNT8_gdOhleG-7VswgiUB7ZjcAgiNoRO8YxLUXBk-tap9X9oKHgtcHP9HnZLuQKT0J2hBn";
        // return new ProductionEnvironment($clientId, $clientSecret);
        
    }
}
