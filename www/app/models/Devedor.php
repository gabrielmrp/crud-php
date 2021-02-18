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

    static public function insert_pessoa($elements)
    {
    	foreach ($elements as $key => $value) 
    	{
           $elements[$key]['pessoa']= 
           strlen($elements[$key]['cpf_ou_cnpj'])===11?
           "Física":"Jurídica";
        } 

        return $elements;

    }

    public function count_devedores_juridica(){
    	return Devedor::whereRaw('LENGTH(cpf_ou_cnpj) = 14')->count();}
	public function count_devedores_fisica(){
		return Devedor::whereRaw('LENGTH(cpf_ou_cnpj) = 11')->count();}


	public function get_devedor_valores(){
    	return Devedor::select("nome")
                ->selectRaw("IF(SUM(valor) IS NULL,0,SUM(valor)) as Total")
                ->leftJoin('dividas','dividas.devedor_id','=','devedores.id')
                ->groupBy('nome')
                ->orderBy('Total','DESC')
                ->get()
                ->toArray();
	}     

	public function get_dividas_pessoa_fisica(){
    	return  Devedor::selectRaw("IF(SUM(valor) IS NULL,0,SUM(valor)) as Total")
                ->leftJoin('dividas','dividas.devedor_id','=','devedores.id')
                ->whereRaw('LENGTH(cpf_ou_cnpj) = 11') 
                ->get()
                ->first()['Total']; 
	}                           


public function get_dividas_pessoa_juridica(){
	return  Devedor::selectRaw("IF(SUM(valor) IS NULL,0,SUM(valor)) as Total")
            ->leftJoin('dividas','dividas.devedor_id','=','devedores.id')
            ->whereRaw('LENGTH(cpf_ou_cnpj) = 14') 
            ->get()
            ->first()['Total']; 
        }
     

}

