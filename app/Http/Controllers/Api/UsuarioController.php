<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
   
    public function index()
    {
       
        $usuarios = Usuario::with('tecnico')->get();
        return response()->json($usuarios);
    }

    public function listarTecnicos()
    {
        $tecnicos = Usuario::where('perfil', 'tecnico')
            ->where('ativo', true) // Opcional: trazer apenas os ativos
            ->with('tecnico') // Carrega a especialidade e registro da tabela 'tecnicos'
            ->get();

        return response()->json($tecnicos);
    }

    public function show(string $id)
    {
        $usuario = Usuario::with('tecnico')->find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        return response()->json($usuario);
    }

    public function update(Request $request, string $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $request->validate([
            'nome' => 'string|max:255',
            'email' => ['email', 'max:255', Rule::unique('usuarios')->ignore($usuario->id)],
            'perfil' => 'in:administrador,tecnico,produtor',
            'ativo' => 'boolean',
            // Se for técnico, pode validar campos extras
            'especialidade' => 'nullable|string|required_if:perfil,tecnico',
            'registro_profissional' => 'nullable|string'
        ]);

        // Atualiza dados básicos
        $usuario->fill($request->only(['nome', 'email', 'perfil', 'ativo']));

        // Se enviou senha nova, atualiza o hash
        if ($request->filled('senha_hash')) {
            $usuario->senha_hash = Hash::make($request->senha_hash);
        }

        $usuario->save();

        // Se for técnico, atualiza ou cria os dados na tabela 'tecnicos'
        if ($usuario->perfil === 'tecnico') {
            $usuario->tecnico()->updateOrCreate(
                ['usuario_id' => $usuario->id],
                [
                    'especialidade' => $request->especialidade ?? $usuario->tecnico?->especialidade,
                    'registro_profissional' => $request->registro_profissional ?? $usuario->tecnico?->registro_profissional
                ]
            );
        }

        return response()->json([
            'message' => 'Usuário atualizado com sucesso!',
            'data' => $usuario->load('tecnico')
        ]);
    }
    
    public function destroy(string $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $usuario->delete();

        return response()->json(['message' => 'Usuário removido com sucesso!']);
    }
}