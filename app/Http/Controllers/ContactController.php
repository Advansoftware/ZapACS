<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Configs;
use App\Jobs\SincronizaContatos;
use Illuminate\Http\Request;
//use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use App\Models\Models\ModelContato;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\VarDumper;

use function League\Plates\Util\id;

class ContactController extends Controller
{
    private $objContato;
    protected $fillable=['nome','tel','avatar','endereco','id_bairro','ultima_sinconizacao'];
    public function __construct(){
        $this->objContato=new ModelContato();
    }

    public function index()
    {
        /*
        $client = new Client([
            'base_uri' => 'http://localhost/',
            'timeout'  => 2.0,
        ]);

        $response = $client->request('GET', 'whats', [
            'query' => ['sessionName' => 'session1']]);

        $conta = json_decode($response->getBody()->getContents());
        foreach($conta->resultInfo as $contas){
            if(property_exists('name', $contas)){
                $conta['name'];
            }
            if(property_exists('formattedName', $contas)){
                $conta['contact']['formattedName'];
            }
        }*/
        $contatos=$this->objContato->where("tel", "!=", 0)->where('id_user', '=', auth()->user()->id)->orderBy('notify', 'desc')->orderBy('nome', 'asc')->simplePaginate(30);
        return view('contato', compact('contatos'));
    }

    Public function sincronizar()
    {
        $lista=json_decode(file_get_contents("http://localhost/whats/getavatar.php?sessao=".session('user_sessao')), true);
        SincronizaContatos::dispatch($lista)
            ->delay(now()->addSecond(1));
    }

    public function notify(){
        header('Content-type:application/json;charset=utf-8');
        $conttotal = DB::table('contatos')->where('notify', '>',  0)->count() + DB::table('contatos')->where('notify', '>',  0)->sum('notify');
        function roda($acao='roda'){
            $conta=0;
            $conttotal=0;
            $dados=json_decode(file_get_contents("http://localhost:3334/notify?sessionName=".session('user_sessao')), true);
            $arr= array();
            foreach ($dados as $notifica => $i) {
                foreach ($i as $id){
                    $ids =  $id['id']['user'];
                    if(DB::table('contatos')->where('tel', '=',  $ids)->count()){
                        DB::table('contatos')->where('tel', '=',  $ids)->update(['notify' => $id['unreadCount']]);
                         $conta++;
                         $conttotal+=$id['unreadCount'];
                         $consulta = DB::table('contatos')->where('tel', '=',  $ids)->get('notify');
                         $consultados = DB::table('contatos')->where('notify', '=',  0)->get();
                         foreach($consultados as $verifica){
                            $arr[]= ['user'=>$verifica->tel, 'qtd' => 0, 'notify'=> $verifica->notify];
                         }
                         foreach($consulta as $notify){
                            $arr[]=['user'=>$ids, 'qtd' => $id['unreadCount'], 'notify'=> $notify->notify];
                         }
                    }
                }
            }
           if($acao=='cont'){
               return $conta + $conttotal;
            }
            else {
                return $arr;
            }

        }

        if(roda('cont') == $conttotal){
           return response()->json(roda(), 200);
        }
        else{
            DB::table('contatos')->update(['notify' => 0]);
            roda();
            return response()->json(roda(), 200);

        }
    }

    public function avatar($id,$number){
        $avatar=json_decode(file_get_contents("http://localhost:3334/img?sessionName=".session('user_sessao')."&number=".$number, true));
        $affected = DB::table('contatos')
              ->where('id', $id)
              ->update(['avatar' => $avatar->result, 'defaultImg' => '0']);
              if($affected){
                return response()->json(['retorno'=>'ok','avatar'=>$avatar->result], 200);
              }
              else{
                return response()->json(['retorno'=>'erro'], 200);
              }
    }
    public function contactProfle($id){
        $contato=$this->objContato->find($id);
     return view('contactProfile', compact('contato'));
    }


    Public function store(Request $request){
        $cadastro=$this->objContato->create([
            'nome'=>$request->nome,
            'tel'=>$request->tel,
            'avatar'=>$request->avatar,
            'endereco'=>$request->endereco,
            'id_bairro'=>$request->id_bairro,
            'ultima_sinconizacao'=>$request->ultima_sinconizacao
        ]);
        if($cadastro){
            return redirect('contato');
        }
    }
}
