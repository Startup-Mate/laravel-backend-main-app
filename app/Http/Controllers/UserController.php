<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user();
        $data = $request->except(['email', 'password']);
        $user->update($data);
        return response()->json(['message' => 'User updated successfully', 'data' => $user], 200);
    }
}
