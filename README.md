Instruções de acesso:

Para acessar o sistema é preciso ter instalado na máquina os seguintes serviços: 
- Docker
- Docker Compose

``` 
$ git clone https://github.com/gabrielmrp/crud-php.git
```

Entre na pasta do sistema

```
$ cd crud-php
```

Faça a instalação do sistema através do comando abaixo
  
```  
$ docker-compose up --build
```
 
Encontre o ip da máquina virtual (X.X.X.X)

```
$ docker-machine ip default
```
 
- Acessando o site:

Caso queira fazer a migração dos bancos de dados bem como a população do mesmo o comando é o seguinte:

```
X.X.X.X/start
```

Caso queira fazer apenas a migração:

```
X.X.X.X/migrate
```

Se quiser posteriormente fazer a população:

```
X.X.X.X/populate
```

Caso não opte por migrar e popular o banco de dados, o acesso ao sistema é dado pelo link: 
```
X.X.X.X
```
