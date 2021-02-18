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
         
         
        $elements = Devedor::insert_pessoa(
                    Devedor::all()->toArray()
                    );

        $args = [
            'elements'=>$elements,
            'verbose_name'=>$this->verbose_name,
            'input_types'=>$this->input_types,
            'entity'=>'devedores',
            'entity_verbose'=>'devedores'
        ]; 
         
        return $this->render_php($path,$args);
    }

    public function get($id)
    {
        $path = dirname(__DIR__, 2).'/views/devedor.php';  
        $DividaController = new DividaController(); 
       
         
        $ref_devedor = Devedor::find($id)->first()->toArray()['id'];

        $elements = Devedor::insert_pessoa(
                    Devedor::find($id)->toArray()
                    );
         

        $args = [
                'devedor'=>[
                            'elements'=>$elements,
                            'entity'=>'devedor',
                            'entity_verbose'=>'devedor',
                            'verbose_name'=>$this->verbose_name,
                            'input_types'=>$this->input_types,  
                            ],
                'dividas'=>[
                            'elements'=>Divida::where('devedor_id',$id[1])->get()->toArray(),
                            'entity'=>'dividas',
                            'entity_verbose'=>'dívida',
                            'ref_devedor'=>$ref_devedor,
                            'verbose_name'=>$DividaController->get_verbose_name(),
                            'input_types'=>$DividaController->get_input_types(), 
                            ]
                ];
          
        return $this->render_php($path,$args);
 
    }

    public function insert()
    {
         $path = dirname(__DIR__, 2).'/views/devedores.php';          
         
         #Checagem de cpf/cnpj único
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
        echo $this->render_php(dirname(__DIR__, 2).'/views/message.php',
            ['mensagem'=>$mensagem,
            'resultado'=>$resultado]);

         return $this->listDevedores();
          
    }

    public function update($id)
    {
        $path = dirname(__DIR__, 2).'/views/devedor.php';
          
         unset($_POST['submit']);
         unset($_POST['pessoa']);
         $array_to_update = array_merge($_POST,["id"=>$id[1]]);
         
          
         #Checagem de cpf/cnpj único
         $found = Devedor::where('cpf_ou_cnpj','=',$_POST['cpf_ou_cnpj'])->first();
         echo "<script>alert($found)</script>";
         $unique_ok = True;
         if($found!==null)
            if($id[1] !== (string)$found['id']){
                $unique_ok=False;
            }

 
        if ($unique_ok==True) {
             $success = Devedor::where('id',$id[1])->update($array_to_update);
             $mensagem = "Informações de ".$_POST["nome"]." alteradas";
             $resultado = "success";
  
         } 
         else{
             $mensagem =  "Cpf/Cnpj já adicionado";
             $resultado = "danger"; 
            
         }

         echo $this->render_php(dirname(__DIR__, 2).'/views/message.php',
            ['mensagem'=>$mensagem,
            'resultado'=>$resultado]);

         echo $this->listDevedores(); 
    }


    public function delete($id){

        $path = dirname(__DIR__, 2).'/views/devedor.php';
        $success = Devedor::destroy($id);
        if ($success) {
            $mensagem = "Usuário deletado";
            $resultado = "success";
        }
        else{
            $mensagem = "Usuário não deletado";
            $resultado = "danger";
        }
        echo $this->render_php(dirname(__DIR__, 2).'/views/message.php',
            ['mensagem'=>$mensagem,
            'resultado'=>$resultado]);
 
    }

    public function dashboard(){

        $path = dirname(__DIR__, 2).'/views/dashboard.php';
 
        $Divida = new Divida();
        $Devedor = new Devedor();

        $devedor_valores = $Devedor->get_devedor_valores(); 
        $vencimento_valores = $Divida->get_vencimento_valores();  

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
                            'Jurídica'=>$Devedor->get_dividas_pessoa_juridica(),
                            'Física'=>$Devedor->get_dividas_pessoa_fisica()
                        ],
                        'dividas_pessoa'=>[
                            'Jurídica'=>$Devedor->count_devedores_juridica(),
                            'Física'=>$Devedor->count_devedores_fisica()
                        ],

                        'devedor_valores'=> json_encode($k),
                        'vencimento_valores'=> json_encode([$datas,$valores])

                    ]
            ];
        return $this->render_php($path,$args);
    }
}