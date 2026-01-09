<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recurso;
use Illuminate\Http\Request;

class RecursoController extends Controller
{
    public function index()
    {
        $recursos = Recurso :: all();
        return response() -> json ($recursos);
    }


    public function store(Request $request) 
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:100', // Ex: Trator, Pulverizador
            'identificador_unico' => 'required|string|unique:recursos,identificador_unico|max:100', // Placa ou Serial
            'status' => 'in:Operacional,Em Manutenção,Inativo',
            'observacoes' => 'nullable|string',
        ]);

        $recurso = Recurso::create($request->all());

        return response()->json([
            'message' => 'Recurso cadastrado com sucesso!',
            'data' => $recurso
        ], 201);
    }
    public function show(string $id)
    {
        $recurso = Recurso::find($id);

        if (!$recurso) {
            return response()->json(['message' => 'Recurso não encontrado'], 404);
        }

        return response()->json($recurso);
    }
    public function update(Request $request, string $id)
    {
        $recurso = Recurso::find($id);

        if (!$recurso) {
            return response()->json(['message' => 'Recurso não encontrado'], 404);
        }

        $request->validate([
            'nome' => 'string|max:255',
            'tipo' => 'string|max:100',
            // O unique aqui ignora o ID atual para permitir atualizar outros campos sem mudar o serial
            'identificador_unico' => 'string|max:100|unique:recursos,identificador_unico,' . $id,
            'status' => 'in:Operacional,Em Manutenção,Inativo',
            'observacoes' => 'nullable|string',
        ]);

        $recurso->update($request->all());

        return response()->json([
            'message' => 'Recurso atualizado com sucesso!',
            'data' => $recurso
        ]);
    }

    public function destroy(string $id)
    {
        $recurso = Recurso::find($id);

        if (!$recurso) {
            return response()->json(['message' => 'Recurso não encontrado'], 404);
        }

        $recurso->delete();

        return response()->json(['message' => 'Recurso removido com sucesso!']);
    }

}