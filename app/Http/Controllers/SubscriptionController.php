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
            //if user send info....
            $data = $request->all();

            $subscription = Subscription::all();
            return response()->json([
                'subscription' => $subscription
            ]);

        } catch(Exception $ex) {
            return response()->json(['error' => 'Resource not found'], 404);
        }
    }
}
