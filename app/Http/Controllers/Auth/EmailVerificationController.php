<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EmailVerificationController extends Controller
{
    /**
     * Enviar notificação de verificação de email
     */
    public function send(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email já verificado'
            ], 400);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Link de verificação enviado para seu email'
        ]);
    }

    /**
     * Verificar email via POST (para uso com API)
     */
    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));

        if (!$user) {
            return response()->json([
                'message' => 'Usuário não encontrado'
            ], 404);
        }

        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            return response()->json([
                'message' => 'Link de verificação inválido'
            ], 400);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email já verificado'
            ], 400);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json([
            'message' => 'Email verificado com sucesso'
        ]);
    }

    /**
     * Verificar email via GET (quando usuário clica no link do email)
     * Redireciona para frontend ou retorna resposta JSON
     */
    public function verifyViaGet(Request $request)
    {
        $user = User::find($request->route('id'));

        if (!$user) {
            // Você pode redirecionar para uma página de erro no frontend
            return response()->json([
                'message' => 'Usuário não encontrado'
            ], 404);
        }

        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            return response()->json([
                'message' => 'Link de verificação inválido'
            ], 400);
        }

        if ($user->hasVerifiedEmail()) {
            // Redirecionar para página de sucesso no frontend
            return redirect(config('app.frontend_url') . '/email-verified?status=already-verified');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // Redirecionar para página de sucesso no frontend
        return redirect(config('app.frontend_url') . '/email-verified?status=verified');
    }
}