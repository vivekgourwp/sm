<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AuthController extends Controller
{
 

    public function signup(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(), // ✅ this is the data to validate
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
            ]
        );

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validateUser->errors()->all()
            ], 401);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // ✅ hash here
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User successfully registered',
            'data' => $user
        ], 200);
    }

    public function login(Request $request)
    {
        // Step 1: Validate
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Step 2: Attempt authentication
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $authUser = Auth::user();

            return response()->json([
                'status' => true,
                'message' => 'User login successfully',
                'data' => $authUser,
                'token' => $authUser->createToken("Auth Token")->plainTextToken, // ✅ fixed typo
                'token_type' => 'bearer'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Authentication failed',
                'errors' => ['Invalid email or password'],
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => "You are logged out successfully"
            ], 200);
        }
    }

}
