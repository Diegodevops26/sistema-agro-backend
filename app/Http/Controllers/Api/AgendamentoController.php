<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agendamento;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    
    public function index()
    {
        
        $agendamentos = Agendamento::with(['propriedade', 'servico', 'tecnico.usuario', 'recursos'])->get();
        
        return response()->json($agendamentos);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'propriedade_id' => 'required|exists:propriedades,id',
            'servico_id' => 'required|exists:servicos,id',
            'tecnico_usuario_id' => 'required|exists:tecnicos,usuario_id',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'status' => 'in:Pendente,Confirmado,Em Andamento,Concluído,Cancelado',
            'observacoes' => 'nullable|string',
            'recursos' => 'nullable|array',
            'recursos.*' => 'exists:recursos,id'
        ]);

        
        $agendamento = Agendamento::create($request->except('recursos'));

        
        if ($request->has('recursos')) {
            $agendamento->recursos()->attach($request->recursos);
        }

        
        return response()->json([
            'message' => 'Agendamento criado com sucesso!',
            'data' => $agendamento->load('recursos')
        ], 201);
    }

    
    public function show(string $id)
    {
        $agendamento = Agendamento::with(['propriedade', 'servico', 'tecnico.usuario', 'recursos'])->find($id);

        if (!$agendamento) {
            return response()->json(['message' => 'Agendamento não encontrado'], 404);
        }

        return response()->json($agendamento);
    }

    
    public function update(Request $request, string $id)
    {
        $agendamento = Agendamento::find($id);

        if (!$agendamento) {
            return response()->json(['message' => 'Agendamento não encontrado'], 404);
        }

        $request->validate([
            'propriedade_id' => 'exists:propriedades,id',
            'servico_id' => 'exists:servicos,id',
            'tecnico_usuario_id' => 'exists:tecnicos,usuario_id',
            'data_inicio' => 'date',
            'data_fim' => 'date|after:data_inicio',
            'status' => 'in:Pendente,Confirmado,Em Andamento,Concluído,Cancelado',
            'recursos' => 'nullable|array',
            'recursos.*' => 'exists:recursos,id'
        ]);

        
        $agendamento->update($request->except('recursos'));

        
        if ($request->has('recursos')) {
            $agendamento->recursos()->sync($request->recursos);
        }

        return response()->json([
            'message' => 'Agendamento atualizado com sucesso!',
            'data' => $agendamento->load(['propriedade', 'servico', 'tecnico.usuario', 'recursos'])
        ]);
    }

    
    public function destroy(string $id)
    {
        $agendamento = Agendamento::find($id);

        if (!$agendamento) {
            return response()->json(['message' => 'Agendamento não encontrado'], 404);
        }

        $agendamento->delete();

        return response()->json(['message' => 'Agendamento removido com sucesso!']);
    }
}