<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Safaricom\Mpesa\Mpesa;
use App\Models\SubscriptionPayment;
use App\Models\BusinessPlan;

class PaymentController extends Controller
{
        // Callback to handle M-Pesa confirmation
        public function mpesaCallback(Request $request)
        {
            $mpesa = new \Safaricom\Mpesa\Mpesa();
            $callbackData = $mpesa->getDataFromCallback();
            $businessId = session('businessId');
            $subscription = BusinessPlan::findOrFail($businessId);

            \Log::info('M-Pesa Callback', $callbackData);

             // Check if the transaction was successful
        if (isset($callbackData['ResultCode']) && $callbackData['ResultCode'] == 0) {
            try {
                // Store the payment data in the mpesa_payments table
                SubcriptionPayment::create([
                    'business_id' => $businessId,
                    'plan_id' => $subscription->plan_id,
                    'transaction_type' => $callbackData['TransactionType'] ?? null,
                    'trans_id' => $callbackData['TransID'],
                    'trans_time' => $callbackData['TransTime'],
                    'trans_amount' => $callbackData['TransAmount'],
                    'business_short_code' => $callbackData['BusinessShortCode'],
                    'bill_ref_number' => $callbackData['BillRefNumber'] ?? null,
                    'invoice_number' => $callbackData['InvoiceNumber'] ?? null,
                    'org_account_balance' => $callbackData['OrgAccountBalance'] ?? null,
                    'third_party_trans_id' => $callbackData['ThirdPartyTransID'] ?? null,
                    'msisdn' => $callbackData['MSISDN'],
                    'first_name' => $callbackData['FirstName'] ?? null,
                    'middle_name' => $callbackData['MiddleName'] ?? null,
                    'last_name' => $callbackData['LastName'] ?? null,
                    'status' => 'completed', // Mark as completed for successful transactions
                    'callback_response' => json_encode($callbackData), // Store full response
                ]);

                // Finish the transaction
                $mpesa->finishTransaction();

                return response()->json(['message' => 'Payment processed successfully']);
            } catch (\Exception $e) {
                Log::error('Error saving M-Pesa payment: ' . $e->getMessage());
                return response()->json(['message' => 'Error processing payment'], 500);
            }
        } else {
            // Log failed transaction
            Log::warning('M-Pesa Callback Failed', $callbackData);
            return response()->json(['message' => 'Transaction failed'], 400);
        }

        $subscription->update(['is_atvive'=>true]);


            return response()->json(['message' => 'Callback received']);
        }

}
