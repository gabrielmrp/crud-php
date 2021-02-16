<?php

namespace App\Controllers;
 
require_once(dirname(__DIR__, 2).'/app/models/Divida.php');
require_once(dirname(__DIR__, 2).'/app/controllers/HomeController.php');

use App\Models\Divida;
use App\Controllers\HomeController;

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
            "id"=>"Código"  ];

         $this->input_types =
            [
            "descricao"=>"text",
            "valor"=>"number",
            "data_de_vencimento"=>"date",
            "devedor_id"=>"hidden",
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
        $args = [];
        $args['elements'] = Divida::all()->toArray();
        $args['entity'] = 'dividas';
        $args['entity_verbose'] = 'dívidas';         
        $args['verbose_name']=$this->verbose_name;
        $args['input_types']=$this->input_types;   
  

        return render_php($path,$args);
    }

     public function delete($id){

        $path = dirname(__DIR__, 2).'/views/divida.php';
        var_dump($id);
        Divida::destroy($id);
        echo $id." deleted";
    }
}