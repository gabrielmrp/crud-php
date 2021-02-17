<?php

namespace App\Controllers;
 
require_once(dirname(__DIR__, 2).'/app/models/Divida.php');
require_once(dirname(__DIR__, 2).'/app/controllers/HomeController.php');

use App\Models\Divida;
use App\Controllers\HomeController;
use App\Controllers\DevedorController;

class DividaController extends HomeController
{
	private $verbose_name;
	private $input_types;
    public function __construct()
    {
         
         $this->verbose_name = [
            "descricao"=>"Descrição",
            "valor"=>"Valor (em R$)",
            "data_de_vencimento"=>"Vencimento",
            "devedor_id"=>"Id",
            "updated"=>"Atualizada",
            "id"=>"Código"  ];

         $this->input_types =
            [
            "descricao"=>"text",
            "valor"=>"number",
            "data_de_vencimento"=>"date",
            "devedor_id"=>"hidden",
            "updated"=>"hidden",
            "id"=>"hidden"  
            ];   
    }

    public function get_verbose_name(){
    	return $this->verbose_name;
    }

    public function get_input_types(){
    	return $this->input_types;
    }

    public function listDividas()
    {
    	$path = dirname(__DIR__, 2).'/views/dividas.php';

    	$args = [
    			'elements'=>Divida::all()->toArray(),
				'entity'=>'dividas',
				'entity_verbose'=>'dívidas',   
				'verbose_name'=>$this->verbose_name,
				'input_types'=>$this->input_types 
    			];
        
  

        return render_php($path,$args);
    }

    public function insert()
    { 
    	 
    	$data = $_POST;
    	$data['updated']=  date('Y-m-d h:i:s', time());
  
        $success = Divida::create($data);
        $mensagem = $data["nome"]." adicionado";
        $resultado = "success";
            
          
        echo render_php(dirname(__DIR__, 2).'/views/message.php',
            ['mensagem'=>$mensagem,
            'resultado'=>$resultado]);
  
    }

        public function update($id)
    {
        //$path = dirname(__DIR__, 2).'/views/devedor.php';
          
         unset($_POST['submit']);
         $array_to_update = array_merge($_POST,["id"=>$id[1]]);
         
           
         $success = Divida::where('id',$id[1])->update($array_to_update);

         $mensagem = $_POST["nome"]." adicionado";
         $resultado = "success";

         echo render_php(dirname(__DIR__, 2).'/views/message.php',
            ['mensagem'=>$mensagem,
            'resultado'=>$resultado]);
         return $this->listDividas(); 
 
    }

     public function delete($id){

        $path = dirname(__DIR__, 2).'/views/divida.php';
        var_dump($id);
        Divida::destroy($id);
        echo $id." deleted";
    }
}