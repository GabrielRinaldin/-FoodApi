<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ExemploJoao extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exemplo:joao';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        for ($i = 0; $i < 10; $i++) {
            $maxSpeed = 60;
            $speed = mt_rand(0, 150);
            $checkSpeed = (($speed / $maxSpeed -1 ) * 100);

            if($checkSpeed > 0 && $checkSpeed < 20){
                Log::info("Velocidade atual: " . $speed . " Velocidade maxima: " . $maxSpeed . " Porcentagem acima ou abaixo: " .number_format($checkSpeed, 2,',', '.') . " Multa de R$150,00");
            }
            if($checkSpeed >= 20 && $checkSpeed < 50){
                Log::info("Velocidade atual: " . $speed . " Velocidade maxima: " . $maxSpeed . " Porcentagem acima ou abaixo: " .number_format($checkSpeed, 2,',', '.') . " Multa de R$200,00");
            }
            if($checkSpeed >= 50){
                Log::info("Velocidade atual: " . $speed . " Velocidade maxima: " . $maxSpeed . " Porcentagem acima ou abaixo: " .number_format($checkSpeed, 2,',', '.') . " Multa de R$900,00");
            }
        }
    }
}
