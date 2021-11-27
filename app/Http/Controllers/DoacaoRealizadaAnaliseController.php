<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DoacaoRealizada;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DoacaoRealizadaAnaliseController extends Controller
{

    public function pegaTodasDoacoesQuilos()
    {
        return DB::select(DB::raw(
            "SELECT users.id, users.nome, doacao_realizadas.unidade_medida, sum(quantidade) as quantidade_total
            FROM users INNER JOIN doacao_realizadas ON
            users.id = doacao_realizadas.doador_id 
            WHERE doacao_realizadas.retirado = " . true . "
            and doacao_realizadas.unidade_medida = 'quilos'
            group by users.id
            order by quantidade_total DESC"
        ));
    }

    public function pegaDoacoesQuilosLimit5()
    {
        return DB::select(DB::raw(
            "SELECT users.id, users.nome, doacao_realizadas.unidade_medida, sum(quantidade) as quantidade_total
            FROM users INNER JOIN doacao_realizadas ON
            users.id = doacao_realizadas.doador_id 
            WHERE doacao_realizadas.retirado = " . true . "
            and doacao_realizadas.unidade_medida = 'quilos'
            group by users.id
            order by quantidade_total DESC 
            limit 5"
        ));
    }

    public function pegaDoacoesMesQuilos()
    {
        $data_atual = Carbon::now();
        $data_atual_formatada = $data_atual->format('Y-m-d') . ' ' . '23:59:59';
        $data_inicio = $data_atual->subMonth(1);
        $data_inicio_formatada = $data_inicio->format('Y-m-d') . ' ' . '00:00:00';
        return DB::select(DB::raw(
            "SELECT
            users.id,
            users.nome,
            doacao_realizadas.unidade_medida ,
            sum(quantidade) as quantidade_total
        FROM
            users
        INNER JOIN doacao_realizadas ON
            users.id = doacao_realizadas.doador_id
        WHERE
            doacao_realizadas.created_at BETWEEN " . "'" . $data_inicio_formatada . "'" . " and " . "'" . $data_atual_formatada . "'" . "
            and doacao_realizadas.retirado = true
            and doacao_realizadas.unidade_medida = 'quilos'
        group by
            users.id
            order by quantidade_total DESC 
        "
        ));
    }

    public function pegaTodasDoacoesUnidades()
    {
        return DB::select(DB::raw(
            "SELECT users.id, users.nome, doacao_realizadas.unidade_medida, sum(quantidade) as quantidade_total
            FROM users INNER JOIN doacao_realizadas ON
            users.id = doacao_realizadas.doador_id 
            WHERE doacao_realizadas.retirado = " . true . "
            and doacao_realizadas.unidade_medida = 'unidade'
            group by users.id
            order by quantidade_total DESC "

        ));
    }

    public function pegaDoacoesUnidadesLimit5()
    {
        return DB::select(DB::raw(
            "SELECT users.id, users.nome, doacao_realizadas.unidade_medida, sum(quantidade) as quantidade_total
            FROM users INNER JOIN doacao_realizadas ON
            users.id = doacao_realizadas.doador_id 
            WHERE doacao_realizadas.retirado = " . true . "
            and doacao_realizadas.unidade_medida = 'unidade'
            group by users.id
            order by quantidade_total DESC 
            limit 5"
        ));
    }

    public function pegaDoacoesMesUnidades()
    {
        $data_atual = Carbon::now();
        $data_atual_formatada = $data_atual->format('Y-m-d') . ' ' . '23:59:59';
        $data_inicio = $data_atual->subMonth(1);
        $data_inicio_formatada = $data_inicio->format('Y-m-d') . ' ' . '00:00:00';
        return DB::select(DB::raw(
            "SELECT
            users.id,
            users.nome,
            doacao_realizadas.unidade_medida ,
            sum(quantidade) as quantidade_total
        FROM
            users
        INNER JOIN doacao_realizadas ON
            users.id = doacao_realizadas.doador_id
        WHERE
            doacao_realizadas.created_at BETWEEN " . "'" . $data_inicio_formatada . "'" . " and " . "'" . $data_atual_formatada . "'" . "
            and doacao_realizadas.retirado = true
            and doacao_realizadas.unidade_medida = 'unidade'
        group by
            users.id
            order by quantidade_total DESC 
        "
        ));
    }
}
