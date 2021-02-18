<?php 

use Illuminate\Database\Capsule\Manager;
 
$capsule = new Manager;

 
#seeds 


Manager::insert('INSERT INTO `devedores` (`nome`, `cpf_ou_cnpj`, `data_de_nascimento`,`endereco`) VALUES
  ("João Cruz", "19382749582", "1976-02-01","Rua Cuíra 234, Caeté, MG, Brasil"),
  ("Maria Guedes",  "01012345678","1986-07-21","Rua Jacarandá 33 Ap 201, Belo Horizonte, MG, Brasil"),
  ("Débora Soares",  "65432182719","1976-04-09","Rua Cedro 114, Valença, RJ, Brasil"),
  ("Madeireira Campos", "65432101234567","","Rua Luiz Melodia 21, Belo Horizonte, MG, Brasil" ),
  ("Envitec LTDA",  "12327495843218","","Rua Francisco Sá 800, São Paulo, SP, Brasil"),
 ("Mariana  Ramos", "12282749582", "1979-02-01","Rua Elmo 234, Ubá, MG, Brasil"),
  ("Nuno Alves",  "01012363678","1989-07-21","Rua Dummont 33 Ap 101, Lisboa, PT, Portugal"),
  ("Lia Barbosa",  "65462182719","1956-04-09","Rua Montijo 814, Niterói, RJ, Brasil"),
  ("CSP Consultoria", "75432101234567","","Rua do Ouro 21, Belo Horizonte, MG, Brasil" ),
  ("Ágil Empreendimentos",  "12325595843218","","Rua João Sales 600, Guarulhos, SP, Brasil")


  ; ');

$now = date('Y-m-d h:i:s', time());
  
Manager::insert('INSERT INTO `dividas` (`descricao`, `valor`, `data_de_vencimento`,`devedor_id`,`updated`) VALUES
  ("Bradesco, código 1923", 1000, "2021-09-01",1,"'.$now.'"),
  ("Renner, código 2021",  2000,"2021-07-01",2,"'.$now.'"),
  ("Itaú, código 2013",  3000,"2021-06-01",3,"'.$now.'"),
  ("Banco do Brasil, código 2045", 10000,"2022-01-01",6,"'.$now.'"),
  ("Américo Guarino, código 2034",  20000,"2022-09-01",4,"'.$now.'"),
  ("Caixa Econômica Federal, código 2013",  300,"2021-06-01",3,"'.$now.'"),
  ("C&A, código 2035", 1000,"2022-01-01",2,"'.$now.'"),
  ("Texaco, código 2034",  2000,"2022-06-21",4,"'.$now.'"),
  ("Braskem, código 2023",  5000,"2021-06-01",3,"'.$now.'"),
  ("Nubank, código 4045", 7000,"2022-01-01",2,"'.$now.'"),
  ("Vilma, código 1034",  2000,"2022-09-01",5,"'.$now.'"),
  ("Soya, código 2013",  300,"2021-06-07",7,"'.$now.'"),
  ("Gilberto Souza, código 2045", 10000,"2022-01-01",9,"'.$now.'"),
  ("MRV Engenharia, código 2034",  2000,"2022-09-06",8,"'.$now.'"),
  ("Sony, código 2013",  800,"2021-11-01",7,"'.$now.'"),
  ("Agar, código 2045", 4000,"2022-11-11",6,"'.$now.'"),
  ("Itaú, código 2034",  1000,"2022-05-01",10,"'.$now.'") 
  ; 

   ');


header('location: /');

