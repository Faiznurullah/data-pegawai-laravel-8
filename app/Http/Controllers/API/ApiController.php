<?php

namespace App\Http\Controllers\API;

use App\Models\ApiUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Facade\FlareClient\Api;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    
  
    public function register(Request $request){

        $request->validate([
          'name' => 'required|string|max:20',
          'email' => 'required|email|string|max:200|unique:apiusers',
          'password' => 'required|string|min:8'
        ]);

        $user = ApiUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now()
        ]);

        $token = $user->createToken('auth:sanctum')->plainTextToken;

        return response()->json([
          'data' => $user,
          'access-token' => $token,
          'Type-token' => 'Bearer'
        ]);

    }

    

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email|string|max:200',
            'password' => 'required|string|min:8'
          ]);

          if(!Auth::attempt(
            $request->only('email', 'password')
          )){

             return response()->json([
                'message' => 'Unauthenticated'
             ], 401);

          }

          $user = ApiUser::where('email', $request->email)->firstOrFail();

          $token = $user->createToken('auth:sanctum')->plainTextToken;
  
          return response()->json([
            'data' => $user,
            'access-token' => $token,
            'Type-token' => 'Bearer'
          ]);

    }


    public function logout(Request $request){

      $x = $request->user()->tokens()->delete();

      return response()->json([
        'message' => 'Berhasil Logout'
      ]);


    }

  

}
