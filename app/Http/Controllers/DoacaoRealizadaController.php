<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DoacaoRealizada;
use App\Models\Doacao;
use Illuminate\Support\Facades\Log;

class DoacaoRealizadaController extends Controller
{
    public function index(Request $request)
    {
        return DoacaoRealizada::where('doador_id', $request->id)
            ->where('retirado', false)
            ->join('users', 'user_id', '=', 'users.id')
            ->select(
                'users.nome as recebedor_nome',
                'doacao_realizadas.nome',
                'doacao_realizadas.quantidade',
                'doacao_realizadas.unidade_medida',
                'doacao_realizadas.id',
            )->get();
    }

    public function store(Request $request)
    {
        Log::info($request->all());
        try {
            $checaDoacao = Doacao::where('id', $request->doacao_id)->first();
            if ($checaDoacao->quantidade < $request->quantidade) {
                return response()->json([
                    'code' => 400,
                    'status' => 'Error',
                    'msg' => 'Quantidade informada maior que disponivel'
                ]);
            }
            $checaDoacao->quantidade = $checaDoacao->quantidade - $request->quantidade;
            if ($checaDoacao->quantidade == 0) {
                $checaDoacao->status = "retirado";
            }

            $checaDoacao->save();

            $doacao_realizada = new DoacaoRealizada;
            $doacao_realizada->doador_id = $request->doador_id;
            $doacao_realizada->user_id = $request->user_id;
            $doacao_realizada->doacao_id = $request->doacao_id;
            $doacao_realizada->nome = $request->nome;
            $doacao_realizada->unidade_medida = $request->unidade_medida;
            $doacao_realizada->quantidade = $request->quantidade;
            $doacao_realizada->retirado = false;
            $doacao_realizada->save();

            return response()->json([
                'code' => 200,
                'status' => 'Success',
                'msg' => 'Você recebeu essa doação, obrigado por confirmar a retirada!'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return response()->json([
                'code' => 500,
                'status' => 'Error',
                'msg' => 'Erro ao receber Doação'
            ]);
        }
    }

    public function edit(Request $request)
    {
        try {
        $doacao = DoacaoRealizada::findOrFail($request->id);
        $doacao->retirado = $request->status;
        $doacao->save();

        return response()->json([
            'code' => 200,
            'status' => 'Success',
            'msg' => 'Doação realizada!'
        ]);

        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => 'Error',
                'msg' => 'Erro ao atualizar Doação'
            ]);
        }
    }

    public function pegaDoadoesRealizadas(Request $request)
    {
        try {
            return DoacaoRealizada::where('doador_id', $request->id)
                ->where('retirado', true)
                ->join('users', 'user_id', '=', 'users.id')
                ->select(
                    'users.nome as recebedor_nome',
                    'doacao_realizadas.nome',
                    'doacao_realizadas.quantidade',
                    'doacao_realizadas.unidade_medida',
                    'doacao_realizadas.id',
                )->get();
        }
        catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => 'Error',
                'msg' => 'Erro ao deletar Doação'
            ]);
        }
    }
}
