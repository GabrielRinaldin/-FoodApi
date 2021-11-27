<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PerfilEditController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        try{
            $user = User::findOrFail($id);
            $user->nome = $request->nome;
            $user->email = $request->email;
            $user->celular = $request->celular;
            if($request->has('password') && $request->password != '' && $request->password != null){
                $user->password = bcrypt($request->password);
            }

            $user->save();
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'msg' => 'Perfil Atualizado'
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'code' => 500,
                'error' => 'Erro ao atualizar perfil'
            ]);
        }
      
    }
}
