<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Exception;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function getSubscription(Request $request) 
    {
        try {
            $data = $request->validate([
                'amount' => 'required|string',
                'data' => 'required|json',
                'order_reference' => 'required|json',
                'status' => 'required|json',
                'period' => 'required|json',
                'payment_intent' => 'required|json',
                'user_id' => 'nullable|exists:users,id',
                'package' => 'nullable|exists:packages,id',
                'transaction_id' => 'nullable|exists:transactions,id',
                'number' => 'required|integer'
            ]);

            $subscription = Subscription::create($data);

            return response()->json([
                'message' => 'Subscription created successfully', 
                'data' => $subscription
            ], 200);

        } catch(Exception $ex) {
            return response()->json(['error' => 'Resource not found'], 404);
        }
    }
}
