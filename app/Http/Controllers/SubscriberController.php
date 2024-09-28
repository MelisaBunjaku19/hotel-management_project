<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        // Validate email input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribers,email'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        // Save the subscriber
        Subscriber::create([
            'email' => $request->email
        ]);

        return response()->json(['success' => true, 'message' => 'Subscription successful!']);
    }
}
