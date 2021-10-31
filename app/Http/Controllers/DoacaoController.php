<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Endereco;
use App\Models\Doacao;
use Illuminate\Support\Facades\Log;

class DoacaoController extends Controller
{
    public function index(Request $request, $id)
    {
        $query = Doacao::where('doacoes.user_id', $id)->join('enderecos', 'endereco_id', '=', 'enderecos.id')
            ->select(
                "doacoes.id as doacao_id",
                "doacoes.nome as nome",
                "doacoes.unidade_medida as unidade_medida",
                "doacoes.quantidade as quantidade ",
                "doacoes.status as status",
                "doacoes.validade as validade",
                "doacoes.user_id as user_id",
                "doacoes.endereco_id as endereco_id",
                "enderecos.estado",
                "enderecos.cidade",
                "enderecos.bairro",
                "enderecos.logradouro",
                "enderecos.numero",
                "enderecos.complemento",
            );

        if ($request->has('status') && $request->status != '') {
            $query->where('doacoes.status', $request->status);
        }

        return $query->get();
    }

    public function store(Request $request)
    {
        try {
            $doacao = new Doacao;
            $doacao->nome = $request->nome;
            $doacao->unidade_medida = $request->unidade_medida;
            $doacao->quantidade = $request->quantidade;
            $doacao->status = $request->status;
            $doacao->validade = $request->validade;
            $doacao->user_id = $request->user_id;
            $doacao->endereco_id = $request->endereco_id;
            $doacao->save();

            return response()->json([
                'code' => 200,
                'status' => 'Success',
                'msg' => 'Doação cadastrada com sucesso!'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getTrace());
            Log::error($e->getLine());
            return response()->json([
                'code' => 500,
                'status' => 'Error',
                'msg' => 'Erro ao Cadastrar a doação',
            ]);
        }
    }

    public function show($id)
    {
        return Doacao::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        try {
            $doacao = Doacao::findOrFail($id);
            $doacao->status = $request->status;
            $doacao->save();

            return response()->json([
                'code' => 200,
                'status' => 'Success',
                'msg' => 'Doação atualizada com sucesso!'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getTrace());
            Log::error($e->getLine());
            return response()->json([
                'code' => 500,
                'status' => 'Error',
                'msg' => 'Erro ao Atualizar a doação',
            ]);
        }
    }

    public function mostraTodasDoacoes()
    {
        return Doacao::join('users', 'user_id', '=', 'users.id')
            ->join('enderecos', 'endereco_id', '=', 'enderecos.id')
            ->select(
                'doacoes.id',
                'doacoes.nome as doacao',
                'doacoes.unidade_medida',
                'doacoes.quantidade',
                'doacoes.status',
                'doacoes.validade',
                'users.nome',
                'users.email',
                'users.celular',
                'users.id as user_id',
                'enderecos.estado',
                'enderecos.cidade',
                'enderecos.bairro',
                'enderecos.logradouro',
                'enderecos.numero',
                'enderecos.complemento',
            )
            ->where('status', 'disponivel')
            ->get();
    }
}
