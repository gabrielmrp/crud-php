<?php

namespace App\Controllers;
 
require_once(dirname(__DIR__, 2).'/app/models/Divida.php');
require_once(dirname(__DIR__, 2).'/app/controllers/HomeController.php');

use App\Models\Divida;
use App\Controllers\HomeController;

class DividaController extends HomeController
{
    public function hello($params)
    {
        return "Olá {$params[1]}";
    }

    public function listDividas()
    {
    	$path = dirname(__DIR__, 2).'/views/dividas.php';
        $args = [];
        $args['elements'] = Divida::all()->toArray();
        $args['entity'] = 'dividas';
         
         $args['input_types']=[
            "descricao"=>"text",
            "valor"=>"number",
            "data_de_vencimento"=>"date",
            "devedor_id"=>"hidden",
            "id"=>"hidden"  
            ]; 
 
        

        return render_php($path,$args);
    }

     public function delete($id){

        $path = dirname(__DIR__, 2).'/views/divida.php';
        var_dump($id);
        Divida::destroy($id);
        echo $id." deleted";
    }
}