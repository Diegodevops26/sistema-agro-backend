<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ServicoController;
use App\Http\Controllers\Api\RecursoController;
use App\Http\Controllers\Api\AgendamentoController;
use App\Http\Controllers\Api\UsuarioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// =========================================================================
// 🔓 ROTAS PÚBLICAS (Não precisa de login)
// =========================================================================

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// =========================================================================
// 🔒 ROTAS PROTEGIDAS (Precisa do Token de acesso)
// =========================================================================

Route::middleware('auth:sanctum')->group(function () {

    // --- Autenticação ---
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // --- Usuários / Técnicos ---
    // Rota para retornar o usuário logado (opcional, mas útil)
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // Rota específica para listar apenas técnicos (para o formulário de agendamento)
    Route::get('/tecnicos', [UsuarioController::class, 'listarTecnicos']);

    // --- CRUDs Completos (Listar, Criar, Editar, Deletar) ---
    // O apiResource cria automaticamente as rotas: index, store, show, update, destroy
    Route::apiResource('servicos', ServicoController::class);
    Route::apiResource('recursos', RecursoController::class);
    Route::apiResource('agendamentos', AgendamentoController::class);

});