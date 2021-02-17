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


}
