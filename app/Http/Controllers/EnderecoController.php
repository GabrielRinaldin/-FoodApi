<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Endereco;
use Illuminate\Support\Facades\Log;
class EnderecoController extends Controller
{
    public function index($id)
    {
        return Endereco::where('user_id', $id)->get();
    }

    public function store(Request $request)
    {
        try
        {
            $endereco = new Endereco;
            $endereco->estado = $request->estado;
            $endereco->cidade = $request->cidade;
            $endereco->bairro = $request->bairro;
            $endereco->logradouro = $request->logradouro;
            $endereco->numero = $request->numero;
            $endereco->complemento = $request->complemento;
            $endereco->user_id = $request->user_id;
            $endereco->save();
    
            return response()->json([
                'code' => 200,
                'status' => 'Success',
                'msg' => 'Endereço Cadastrado com sucesso'
            ]);
        }
        catch(\Exception $e){

            return response()->json([
                'code' => 500,
                'status' => 'Fail',
                'msg' => 'Falha ao cadastrar endereço'
            ]);
        }

        
    }

    public function show($id)
    {
        return Endereco::findOrFail($id);

    }

    public function update(Request $request, $id)
    {
        $endereco = Endereco::findOrFail($id);
        $endereco->estado = $request->estado;
        $endereco->cidade = $request->cidade;
        $endereco->bairro = $request->bairro;
        $endereco->logradouro = $request->logradouro;
        $endereco->numero = $request->numero;
        $endereco->complemento = $request->complemento;
        $endereco->save();

        return response()->json([
            'code' => 200,
            'status' => 'Success',
            'msg' => 'Endereço Atualizado com sucesso'
        ]);
    }

    public function delete($id)
    {
        $endereco = Endereco::findOrFail($id);
        $endereco->delete();

        return response()->json([
            'code' => 200,
            'status' => 'Success',
            'msg' => 'Endereço Deleteado com sucesso'
        ]);
    }
}
