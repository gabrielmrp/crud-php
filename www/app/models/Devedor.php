<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;

class Devedor extends Model
{
    protected $table = "devedores";
    protected $fillable = [
    	                   'nome',
    					   'cpf_ou_cnpj',
    					   'data_de_nascimento',
    					   'endereco'
    					  ];
    public $timestamps = false;


}

