<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HandlePaymentNotificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $payload = $request->all();

        Log::info('Incoming-midtrans', [
            'payload' => $payload
        ]);

        $orderId = $payload['order_id'];
        $statusCode = $payload['status_code'];
        $grossAmount = $payload['gross_amount'];

        $reqSignature = $payload['signature_key'];

        $signature = hash('sha512', $orderId . $statusCode . $grossAmount . config('midtrans.key'));

        if ($signature != $reqSignature) {
            return response()->json([
                'message' => 'invalid signature'
            ], 401);
        }

        $transactionStatus = $payload['transaction_status'];

        $order = Transaction::where('midtrans_id', $orderId)->first();
        if (!$order) {
            return response()->json([
                'message' => 'invalid order'
            ], 400);
        }

        if ($transactionStatus == 'settlement') {
            $order->status = 'paid';
            $order->save();
        } else if ($transactionStatus == 'expire') {
            $order->status = 'dibatalkan';
            $order->save();
        }

        return response()->json(['message' => 'success']);
    }
}
