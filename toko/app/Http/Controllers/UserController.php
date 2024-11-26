<?php

namespace App\Http\Controllers;

// use Dotenv\Validator;

use App\Models\User;
// use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                "data" => [
                    "errors" => $validator->invalid()
                ]
                ], 422);
        }

        $user = User::where('username', $request->username)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect'],
            ]);
        }

        $token = $user->createToken("tokenName")->plainTextToken;

        return response()->json([
            "data" => [
                "token" => $token
            ]
        ]); 
    }

    public function store(Request $request)
    {
        User::create($request->all());
        return response()->json(['message' => 'berhasil Register'], 201);
        $request->validate([
            'username' => 'required|string|max:30',
            'email' => 'required|unique',
            'password' => 'required',
        ], [
            'username.required' => 'username wajib isi',
            'username.string' => 'username hanya boleh berupa text',
            'username.max' => 'username tidak boleh lebih dari 50 karakter',
            'email.required' => 'email waib isi',
            'email.unique' => 'email wajib unik',
            'password.required' => 'password harus ada',
        ]);
        $user = new User($request->all());
        $user->create([
            $user->username = $request->input('username'),
            $user->email = $request->input('email')->unique(),
            $user->password = Hash::make($request->input('password'))
        ]);
        return response()->json(['message' => 'Berhasil register']);
    }
    public function logout(Request $request){
        if (!$request->user()) {
            return response()->json(['error' => 'belum login'], 401);
        }
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
