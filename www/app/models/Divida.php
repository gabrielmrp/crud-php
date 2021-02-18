<?php

namespace App\Models;
  
use Illuminate\Database\Eloquent\Model;

class Divida extends Model
{
    protected $table = "dividas";
    protected $fillable = ['descricao',
							'valor',
							'data_de_vencimento',
							'devedor_id',
							'updated'
						   ];
    public $timestamps = false;


    public function get_vencimento_valores(){

    	return Divida::select("data_de_vencimento")
                            ->selectRaw("IF(SUM(valor) IS NULL,0,SUM(valor)) as Total") 
                            ->groupBy('data_de_vencimento')
                            ->orderBy('Total','DESC')
                            ->get()
                            ->toArray(); 
    }

    
}
