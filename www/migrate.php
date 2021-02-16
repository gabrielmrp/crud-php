<?php 

use Illuminate\Database\Capsule\Manager;

$capsule = new Manager;

#Manager::table('DROP TABLE IF EXISTS `users`;');

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
	    $table->integer('devedor_id')->unsigned();
	    $table->foreign('devedor_id')->references('id')->on('devedores')->onDelete('cascade');   
});							

Manager::insert('INSERT INTO `devedores` (`nome`, `cpf_ou_cnpj`, `data_de_nascimento`,`endereco`) VALUES
  ("João Cruz", "19382749582", "1976-02-01","Rua Cuíra 234, Caeté, MG, Brasil"),
  ("Maria Guedes",  "01012345678","1986-07-21","Rua Jacarandá 33 Ap 201, Belo Horizonte, MG, Brasil"),
  ("Débora Soares",  "65432182719","1976-04-09","Rua Cedro 114, Valença, RJ, Brasil"),
  ("Madeireira Campos", "65432101234567","","Rua Luiz Melodia 21, Belo Horizonte, MG, Brasil" ),
  ("Envitec LTDA",  "12327495843218","","Rua Francisco Sales 800, São Paulo, SP, Brasil"); ');

Manager::insert('INSERT INTO `dividas` (`descricao`, `valor`, `data_de_vencimento`,`devedor_id`) VALUES
  ("Nota Promissória código 1923", 1000, "2021-09-01",1),
  ("Nota Promissória código 2021",  2000,"2021-07-01",2),
  ("Nota Promissória código 2013",  3000,"2021-06-01",3),
  ("Nota Promissória código 2045", 10000,"2022-01-01",4),
  ("Nota Promissória código 2034",  20000,"2022-09-01",4); ');

echo "Migration completa";
