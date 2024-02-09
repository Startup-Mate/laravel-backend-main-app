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

            //save info subscription
            
            return response()->json([
                'success' => true
            ]);

        } catch(Exception $ex) {
            return response()->json(['error' => 'Resource not found'], 404);
        }
    }
}
