<?php 

use Illuminate\Database\Capsule\Manager;
 
$capsule = new Manager;

#esquema

Manager::schema()->dropIfExists('dividas');				
Manager::schema()->dropIfExists('devedores');

Manager::schema()->create('devedores',
	function ($table) {
	    $table->increments('id');
	    $table->string('nome',64);
	    $table->string('cpf_ou_cnpj',14)->unique();
	    $table->date('data_de_nascimento')->nullable();
	    $table->string('endereco',128);	   
});
 
Manager::schema()->create('dividas',
	function ($table) {
	    $table->increments('id');
	    $table->string('descricao',64)->default('');
	    $table->integer('valor')->default(0);
	    $table->date('data_de_vencimento')->default('2099-12-31 00:00:00');
	    $table->timestamp('updated')->nullable();
	    $table->integer('devedor_id')->unsigned();
	    $table->foreign('devedor_id')->references('id')->on('devedores')->onDelete('cascade');   
});							

 

