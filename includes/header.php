<!doctype html>
<html language="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    
    <!-- Folha de estilo  -->
    <link rel="stylesheet" type="text/css" href="css/style/estilo.css"/>
    <link rel="stylesheet" href="css/style/calendario.css">

     <!-- Fontes  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <title>Creche Tia Carminha</title>
    <style>
      .texto{
        position: relative;
      }
      .texto:before{
        animation-name: alonga;
        animation-duration: 1s;
        animation-direction: alternate-reverse;
        animation-iteration-count: infinite;
        content:'';
        position:absolute;
        bottom:0;
        right:0px;
        z-index: 0;
        background:rgba(150, 21, 21, 1);
        height:8px;
      }

      @keyframes alonga {
        from{ 
            width:0;
          }

        to{
            width:100px;
        }
      }
      
    </style>
  </head>
  <body>

    <header>
      <nav class="navbar navbar-expand-md">
        <div class="container-fluid">
          <div>
            <a href="index.php"><img src="img/nova-logo.png" class="logo"></a>
          </div>
          <div class="collapse navbar-collapse " >
            <ul class="navbar-nav me-auto mb-2 mb-md-0" >
            <li class="nav-item">
                <a class="nav-link  link-navbar" href="index.php">Início</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  link-navbar" href="nossa-historia.php">Nossa História</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  link-navbar" href="metodologias.php">Metodologias</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  link-navbar" href="seja-apoiador.php">Seja um apoiador</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  link-navbar" href="contato.php">Contato</a>
              </li>
            </ul>
          </div>          
        </div>
      </nav>
    </header>

