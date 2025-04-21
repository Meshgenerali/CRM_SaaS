<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Safaricom\Mpesa\Mpesa;

class PaymentController extends Controller
{
        // Callback to handle M-Pesa confirmation
        public function mpesaCallback(Request $request)
        {
            $mpesa = new \Safaricom\Mpesa\Mpesa();
            $callbackData = $mpesa->getDataFromCallback();

            \Log::info('M-Pesa Callback', $callbackData);

            $mpesa->finishTransaction();

            return response()->json(['message' => 'Callback received']);
        }

}
