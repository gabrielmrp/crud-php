<?php

namespace App\Controllers;
 
require_once(dirname(__DIR__, 2).'/app/models/Devedor.php');
require_once(dirname(__DIR__, 2).'/app/models/Divida.php');
require_once(dirname(__DIR__, 2).'/app/controllers/HomeController.php');


use App\Models\Devedor;
use App\Models\Divida;
use App\Controllers\HomeController;
 


class DevedorController extends HomeController
{
    public function hello($params)
    {
        return "Olá {$params[1]}";
    }

    public function listDevedores()
    {
    	$path = dirname(__DIR__, 2).'/views/devedores.php';
        $args = [];
        $args['elements'] = Devedor::all()->toArray();



        $args['verbose_name']=[
            "nome"=>"Nome",
            "cpf_ou_cnpj"=>"Cpf/Cnpj",
            "data_de_nascimento"=>"Nascimento",
            "endereco"=>"Endereço",
            "id"=>"Código" 
                                ];

        $args['input_types']=[
            "nome"=>"text",
            "cpf_ou_cnpj"=>"text",
            "data_de_nascimento"=>"date", 
            "endereco"=>"text",
            "id"=>"hidden"  
            ];   

        $args['entity'] = 'devedores';
         
        return render_php($path,$args);
    }

    public function get($id)
    {
        $path = dirname(__DIR__, 2).'/views/devedor.php'; 
        $args_devedor = [];
         

        $args_devedor['elements'] = Devedor::find($id)->toArray();

        $args_devedor['entity'] = 'devedor';
        $args_devedor['verbose_name']=[
            "nome"=>"Nome",
            "cpf_ou_cnpj"=>"Cpf/Cnpj",
            "data_de_nascimento"=>"Nascimento",
            "endereco"=>"Endereço",
            "id"=>"Código" 
                                ];

        $args_devedor['input_types']=[
            "nome"=>"text",
            "cpf_ou_cnpj"=>"text",
            "data_de_nascimento"=>"date", 
            "endereco"=>"text",
            "id"=>"hidden"  
            ];   
         
        
 
      
        $args_dividas = [];                
        $args_dividas['elements'] = Divida::where('devedor_id',$id[1])->get()->toArray();

        $args_dividas['entity'] = 'divida';

        $args_dividas['verbose_name']=[
            "descricao"=>"Descrição",
            "valor"=>"Valor (em R$)",
            "data_de_vencimento"=>"Vencimento",
            "devedor_id"=>"Id",
            "id"=>"Código"  ];

        $args_dividas['input_types']=[
            "descricao"=>"text",
            "valor"=>"number",
            "data_de_vencimento"=>"date",
            "devedor_id"=>"hidden",
            "id"=>"hidden"  
            ];   
 
        return render_php($path,
            ['devedor'=>$args_devedor,
            'dividas'=>$args_dividas] );
 
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
         
          
         $success = Devedor::where('id',$id[1])->update($array_to_update);
 
         if ($success) {
            echo $id." atualizado";
         }
        
    }


    public function delete($id){

        $path = dirname(__DIR__, 2).'/views/devedor.php';
        var_dump($id);
        Devedor::destroy($id);
        echo $id." deleted";
    }
}