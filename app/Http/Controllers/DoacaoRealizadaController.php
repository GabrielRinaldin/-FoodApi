<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DoacaoRealizada;
use App\Models\Doacao;

class DoacaoRealizadaController extends Controller
{
    public function index()
    {
        return DoacaoRealizada::all();
    }

    public function store(Request $request)
    {
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
            $doacao_realizada->save();

            return response()->json([
                'code' => 200,
                'status' => 'Success',
                'msg' => 'Doação Realizada'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => 'Error',
                'msg' => 'Erro ao realizar Doação'
            ]);
        }
    }

    public function show()
    {
    }
}
