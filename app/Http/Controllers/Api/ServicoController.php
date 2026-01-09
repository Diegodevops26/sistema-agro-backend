<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    
    public function index()
    {
        // Busca todos os serviços do banco
        $servicos = Servico::all(); 
        return response()->json($servicos);
    }

    public function store(Request $request)
    {
        // 1. Validação dos dados vindos do Front-end
        $request->validate([
            'nome' => 'required|string|unique:servicos,nome|max:255',
            'categoria' => 'required|in:Consultoria,Operacional,Manutenção,Análise,Outro',
            'duracao_media' => 'nullable|string',
            'valor_base' => 'nullable|numeric', // Garante que seja número
            'status' => 'in:Ativo,Inativo',
        ]);

        // 2. Criação
        $servico = Servico::create($request->all());

        // 3. Resposta
        return response()->json([
            'message' => 'Serviço criado com sucesso!',
            'data' => $servico
        ], 201);
    }

    /**
     * EXIBIR: Retorna um único serviço pelo ID.
     * GET /api/servicos/{id}
     */
    public function show(string $id)
    {
        $servico = Servico::find($id);

        if (!$servico) {
            return response()->json(['message' => 'Serviço não encontrado'], 404);
        }

        return response()->json($servico);
    }

    /**
     * ATUALIZAR: Altera os dados de um serviço existente.
     * PUT /api/servicos/{id}
     */
    public function update(Request $request, string $id)
    {
        $servico = Servico::find($id);

        if (!$servico) {
            return response()->json(['message' => 'Serviço não encontrado'], 404);
        }

        // Validação (o 'unique' ignora o ID atual para permitir manter o mesmo nome)
        $request->validate([
            'nome' => 'string|max:255|unique:servicos,nome,' . $id,
            'categoria' => 'in:Consultoria,Operacional,Manutenção,Análise,Outro',
            'valor_base' => 'numeric',
            'status' => 'in:Ativo,Inativo',
        ]);

        $servico->update($request->all());

        return response()->json([
            'message' => 'Serviço atualizado com sucesso!',
            'data' => $servico
        ]);
    }

    /**
     * DELETAR: Remove um serviço do banco.
     * DELETE /api/servicos/{id}
     */
    public function destroy(string $id)
    {
        $servico = Servico::find($id);

        if (!$servico) {
            return response()->json(['message' => 'Serviço não encontrado'], 404);
        }

        $servico->delete();

        return response()->json(['message' => 'Serviço removido com sucesso!']); // 204 No Content é comum também
    }
}