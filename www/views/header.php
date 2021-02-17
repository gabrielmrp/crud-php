<!DOCTYPE html>
<html>

<head>
    <!-- Title -->
    <title>
       Gerenciamento de Dívidas
  </title>


  <!-- Favicon -->
  <link rel="icon" href="../static/img/favicon.ico" type="image/x-icon" />

  <!-- Arquivos CSS -->
 

   <link rel="stylesheet" href="<?= '../static/css/card.css'; ?>">  
  <link rel="stylesheet" href="<?= '../static/css/bootstrap.min.css'; ?>">
  <link rel="stylesheet" href="<?= '../static/css/master.css'; ?>">
  <link rel="stylesheet" href="<?= '../static/css/fontawesome.min.css'; ?>">
  <link rel="stylesheet" href="<?= '../static/css/brands.min.css'; ?>">
  <link rel="stylesheet" href="<?= '../static/css/solid.min.css'; ?>">

  <!-- Bloco de Estilos -->
  
</head>

<body> 
    
    <!-- Navbar -->
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light"> 
          <img src="<?='../static/img/favicon.png'; ?>" height='45px'> 
      <button class="navbar-toggler" type="button" 
      data-toggle="collapse" data-target="#conteudo-navbar" 
      aria-controls="conteudo-navbar" aria-expanded="false" 
      aria-label="Ativar navegação">
      <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="conteudo-navbar">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item system_title"> 
              Gerenciamento de Dívidas
          </a>
      </li>
      <li class="nav-item" >
         <a class="nav-link" href="/dashboard">
        Dashboard
            </a>
      </li>
      <li class="nav-item"> 
        <a class="nav-link" href="/devedores">
        Devedores
            </a>
      </li>
      <li class="nav-item"> 
        <a class="nav-link" href="/dividas">
        Dívidas
            </a>
      </li>

      
</ul>           
</div>
</nav>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/dashboard">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="/devedores">Devedores</a>
        </li>  
        <?php if ($args['entity'] != 'devedores' && $args['entity'] != 'dividas')
        {
        ?>
        <li class="breadcrumb-item">
            Devedor
        </li>    
        <?php
        }
        ?>     
    </ol>
</nav>

 
