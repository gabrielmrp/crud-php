<?php

namespace App\Controllers;
 
require_once(dirname(__DIR__, 2).'/app/models/Devedor.php');
require_once(dirname(__DIR__, 2).'/app/models/Divida.php');
require_once(dirname(__DIR__, 2).'/app/controllers/HomeController.php');


use App\Models\Devedor;
use App\Models\Divida;
use App\Controllers\HomeController;
use App\Controllers\DividaController;
 


class DevedorController extends HomeController
{
    private $verbose_name;
    private $input_types;


    public function __construct()
    {
        
        $this->verbose_name = [
            "nome"=>"Nome",
            "pessoa"=>"Pessoa",
            "cpf_ou_cnpj"=>"Cpf/Cnpj",
            "data_de_nascimento"=>"Nascimento",
            "endereco"=>"Endereço",
            "id"=>"Código"  
        ];
        $this->input_types = [
            "nome"=>"text",
            "pessoa"=>"text",
            "cpf_ou_cnpj"=>"text",
            "data_de_nascimento"=>"date", 
            "endereco"=>"text",
            "id"=>"hidden"  
            ];
    }

    public function listDevedores()
    {
    	$path = dirname(__DIR__, 2).'/views/devedores.php';
         
        $elements = Devedor::all()->toArray();

        foreach ($elements as $key => $value) {
           $elements[$key]['pessoa']= 
           strlen($elements[$key]['cpf_ou_cnpj'])===11?
           "Física":"Jurídica";
        } 

        $args = [
            'elements'=>$elements,
            'verbose_name'=>$this->verbose_name,
            'input_types'=>$this->input_types,
            'entity'=>'devedores',
            'entity_verbose'=>'devedores'
        ]; 
         
        return render_php($path,$args);
    }

    public function get($id)
    {
        $path = dirname(__DIR__, 2).'/views/devedor.php';  
        $DividaController = new DividaController(); 

        $args = [
                'devedor'=>[
                            'elements'=>Devedor::find($id)->toArray(),
                            'entity'=>'devedor',
                            'entity_verbose'=>'devedor',
                            'verbose_name'=>$this->verbose_name,
                            'input_types'=>$this->input_types,  
                            ],
                'dividas'=>[
                            'elements'=>Divida::where('devedor_id',$id[1])->get()->toArray(),
                            'entity'=>'divida',
                            'entity_verbose'=>'dívida',
                            'verbose_name'=>$DividaController->get_verbose_name(),
                            'input_types'=>$DividaController->get_input_types(), 
                            ]
                ];
          
        return render_php($path,$args);
 
    }

    public function insert()
    {
         $path = dirname(__DIR__, 2).'/views/devedores.php';
          
         
         $unique_ok =  
         (Devedor::where('cpf_ou_cnpj','=',$_POST['cpf_ou_cnpj'])->first() === null);

         if ($unique_ok) {
            $success = Devedor::create($_POST);
            $mensagem = $_POST["nome"]." adicionado";
            $resultado = "success";
            
         }
         else{
            $mensagem =  "Cpf/Cnpj já adicionado";
            $resultado = "danger";
         }
        echo render_php(dirname(__DIR__, 2).'/views/message.php',
            ['mensagem'=>$mensagem,
            'resultado'=>$resultado]);

         return $this->listDevedores();
          
    }

    public function update($id)
    {
        $path = dirname(__DIR__, 2).'/views/devedor.php';
          
         unset($_POST['submit']);
         $array_to_update = array_merge($_POST,["id"=>$id[1]]);
         
         $unique_ok =  
         (Devedor::where('cpf_ou_cnpj','=',$_POST['cpf_ou_cnpj'])->first() === null);

         
        if ($unique_ok) {
             $success = Devedor::where('id',$id[1])->update($array_to_update);
             $mensagem = $_POST["nome"]." adicionado";
             $resultado = "success";

             echo render_php(dirname(__DIR__, 2).'/views/message.php',
            ['mensagem'=>$mensagem,
            'resultado'=>$resultado]);
         return $this->listDevedores(); 

            
         } 
         else{
            $mensagem =  "Cpf/Cnpj já adicionado";
            $resultado = "danger";
            var_dump($mensagem);
            return die( "HTTP/1.0 404 Not Found" );
         }
        
    }


    public function delete($id){

        $path = dirname(__DIR__, 2).'/views/devedor.php';
        var_dump($id);
        Devedor::destroy($id);
        echo $id." deleted";
    }

    public function dashboard(){
        $path = dirname(__DIR__, 2).'/views/dashboard.php';
        $devedores_juridica = Devedor::whereRaw('LENGTH(cpf_ou_cnpj) = 14')->count();
        $devedores_fisica = Devedor::whereRaw('LENGTH(cpf_ou_cnpj) = 11')->count();

        $dividas_pessoa_juridica = Devedor::selectRaw("IF(SUM(valor) IS NULL,0,SUM(valor)) as Total")
                            ->leftJoin('dividas','dividas.devedor_id','=','devedores.id')
                            ->whereRaw('LENGTH(cpf_ou_cnpj) = 14') 
                            ->get()
                            ->first()['Total'];  

        $dividas_pessoa_fisica = Devedor::selectRaw("IF(SUM(valor) IS NULL,0,SUM(valor)) as Total")
                            ->leftJoin('dividas','dividas.devedor_id','=','devedores.id')
                            ->whereRaw('LENGTH(cpf_ou_cnpj) = 11') 
                            ->get()
                            ->first()['Total'];          
         
        $devedor_valores = Devedor::select("nome")
                            ->selectRaw("IF(SUM(valor) IS NULL,0,SUM(valor)) as Total")
                            ->leftJoin('dividas','dividas.devedor_id','=','devedores.id')
                            ->groupBy('nome')
                            ->orderBy('Total','DESC')
                            ->get()
                            ->toArray();

        $vencimento_valores = Divida::select("data_de_vencimento")
                            ->selectRaw("IF(SUM(valor) IS NULL,0,SUM(valor)) as Total") 
                            ->groupBy('data_de_vencimento')
                            ->orderBy('Total','DESC')
                            ->get()
                            ->toArray();                    

         // Rotinas para formatação para a correta inserção de dados nos gráficos                   
         $k=[];
           foreach ($devedor_valores as $key => $value) {
               array_push($k,array_values($value));
           }

         $datas=['x'];
         $valores=['Total'];
           foreach ($vencimento_valores as $key => $value) {
                array_push($datas,$value['data_de_vencimento']);
                array_push($valores,$value['Total']);
            }
  
            $args=[
                'dashboard'=>
                    [
                        'pessoa'=>[
                            'Jurídica'=>$dividas_pessoa_juridica,
                            'Física'=>$dividas_pessoa_fisica
                        ],
                        'dividas_pessoa'=>[
                            'Jurídica'=>$devedores_juridica,
                            'Física'=>$devedores_fisica
                        ],

                        'devedor_valores'=> json_encode($k),
                        'vencimento_valores'=> json_encode([$datas,$valores])

                    ]
            ];
        return render_php($path,$args);
    }
}