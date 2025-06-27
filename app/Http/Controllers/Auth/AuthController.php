<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Dados de validação inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Enviar email de verificação diretamente
            $user->sendEmailVerificationNotification();

            $token = $user->createToken('auth_token')->plainTextToken;

            \Log::info('Usuário registrado e evento disparado', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);

            return response()->json([
                'message' => 'Usuário registrado com sucesso. Verifique seu email para ativar a conta.',
                'user' => $user,
                'token' => $token,
                'email_verified' => $user->hasVerifiedEmail()
            ], 201);

        } catch (\Exception $e) {
            \Log::error('Erro no registro do usuário: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Erro interno do servidor',
                'error' => app()->environment('local') ? $e->getMessage() : 'Erro no registro'
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Dados de validação inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['Credenciais inválidas.'],
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login realizado com sucesso',
            'user' => $user,
            'token' => $token,
            'email_verified' => $user->hasVerifiedEmail()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso'
        ]);
    }

    public function user(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
            'email_verified' => $request->user()->hasVerifiedEmail()
        ]);
    }
}