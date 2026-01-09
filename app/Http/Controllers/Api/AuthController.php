<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario; // Importe seu Model Usuario
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth; // Use o Facade Auth

class AuthController extends RoutingController
{
    // Método para Registrar
    public function register(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'], // Valida unicidade na tabela usuarios
            'senha_hash' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' busca por um campo 'senha_hash_confirmation'
            'perfil' => ['required', 'in:administrador,tecnico'],
            // Adicione outras validações se necessário (telefone, etc.)
        ]);

        $usuario = Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha_hash' => Hash::make($request->senha_hash), // Hashing da senha!
            'perfil' => $request->perfil,
            'ativo' => true, // Ou conforme sua regra
            // Preencha outros campos se houver
        ]);

        // Opcional: Criar registro em agricultores/tecnicos se necessário
        if ($request->perfil === 'tecnico' && $request->filled('especialidade')) {
            $usuario->tecnico()->create([
                'especialidade' => $request->especialidade,
                // outros campos de tecnico
            ]);
        } // Adicionar lógica similar para agricultor se aplicável no registro

        // Gerar token após registro (opcional, pode só retornar sucesso)
        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Usuário registrado com sucesso!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $usuario // Retorna os dados do usuário criado
        ], 201);
    }

    // Método para Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha_hash' => 'required', // Nome do campo no form deve ser senha_hash
        ]);

        // Tenta autenticar usando o guard 'web' ou 'api' configurado
        // Verifica o email e a senha_hash (comparando o hash)
        $usuario = Usuario::where('email', $request->email)->first();

        if (! $usuario || ! Hash::check($request->senha_hash, $usuario->senha_hash)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }

        // Se autenticado, cria um token Sanctum
        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login bem-sucedido!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $usuario // Retorna dados do usuário logado
        ]);
    }

    // Método para Logout
    public function logout(Request $request)
    {
        // Revoga o token atual que foi usado para autenticar a requisição
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso!']);
    }
}