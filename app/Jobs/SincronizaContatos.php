<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SincronizaContatos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    /**
    * @var array
    */
    private $lista;
    private $id;
    protected $fillable=['nome','tel','avatar','endereco','id_bairro','ultima_sinconizacao'];
    public function __construct($lista)
    {
        $this->lista = $lista;
        $this->id = auth()->user()->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->lista as $contato) {
            if(DB::table('contatos')->where('tel', '=', $contato['tel'])->count()){

            }
            else{
                DB::table('contatos')->insert([
                    'nome' => $contato['nome'],
                    'tel' => $contato['tel'],
                    'avatar' => $contato['avatar'],
                    'defaultImg'=>$contato['imgDefault'],
                    'id_user'=> $this->id
                ]);
             }
        }

            /*SincronizaFotos::dispatch($lista)
            ->delay(now()->addSecond(10));*/
    }

    private function teste()
    {
        try {
            //roda p codpgp

        } catch (Exception $e) {

            throw $e;
        }
    }
}
