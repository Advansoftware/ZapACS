<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Models\ModelContato;
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
    private $objContato;
    protected $fillable=['nome','tel','avatar','endereco','id_bairro','ultima_sinconizacao'];
    public function __construct($lista)
    {
        $this->lista = $lista;
        $this->objContato=new ModelContato();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            print_r($this->lista);
            $this->teste();

            SincronizaFotos::dispatch($lista)
            ->delay(now()->addSecond(10));

        } catch (Exception $e) {
            throw new Exception('falha ao sincronizar contatos');
        }
    }

    private function teste()
    {
        try {
            //roda p codpgp

            $conta=0;
        foreach ($lista as $contato) {
            if(DB::table('contatos')->where('tel', '=', $contato['tel'])->count()){

            }
            else{
                DB::table('contatos')->insert([
                    'nome' => $contato['nome'],
                    'tel' => $contato['tel'],
                    'avatar' => $contato['avatar'],
                    'defaultImg'=>$contato['imgDefault'],
                    'id_user'=> auth()->user()->id
                ]);
                $conta++;
             }
        }
        return $conta;
        } catch (Exception $e) {

            throw $e;
        }
    }
}
