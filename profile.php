
    <?php
                         require_once 'Conexao/conexao.php';

                         $id = 0;
                         if (isset($_GET['id'])) {
                         	$id = $_GET['id'];
                         }

                          $sql= "SELECT * FROM clientes order by nome asc";
                          $resultadosql = $conexao->query($sql);
                          $vetorRegistros = $resultadosql->fetch_all(MYSQLI_ASSOC);

                            $sql= "SELECT * FROM agendamentos ";
                          $resultadoFeitos = $conexao->query($sql);
                          $vetorRegistroFeito = $resultadoFeitos->fetch_all(MYSQLI_ASSOC);

      ?>  
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="css/estilo.css">

    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <title>Profile</title>
  </head>
  <body>
              <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
       <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                      </li>
        <li class="nav-item">            
                        <a class="nav-link" href="formAgendamento.php">Novo Agendamento</a>
                      </li>
     
                      
                        <li class="nav-item">            
                        <a class="nav-link" href="formCliente.php">Novo Cliente</a>
                      </li>
                        <li class="nav-item">            
                        <a class="nav-link" href="listaClientes.php">Clientes</a>
                      </li>
                       <li class="nav-item">  
                      <a class="nav-link" href="historicoAgendamentos.php">Historico de agendamentos</a>
                    </li>        
       
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    <br>    
 <?php

                          $sql= "SELECT * FROM clientes order by nome asc";
                          $resultadosql = $conexao->query($sql);
                          $vetorRegistros = $resultadosql->fetch_all(MYSQLI_ASSOC);

                            $sql= "SELECT * FROM agendamentos ";
                          $resultadoFeitos = $conexao->query($sql);
                          $vetorRegistroFeito = $resultadoFeitos->fetch_all(MYSQLI_ASSOC);

      ?>
<table class="table caption-top table-dark table-borderless">
  <caption>Lista de Clientes</caption>
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">Telefone</th>
      <th scope="col">Adicional</th>
      <th scope="col">Qtd. feitas</th>
       <th scope="col">Qtd. canc</th>

      
    </tr>
  </thead>

  <tbody>

    <?php
    $fez = 0;    
    $cancelado = 0;

       foreach ($vetorRegistros as $key) {

 	if ($id ==  $key['id']) {
 		// code...
 	
      ?>
    <tr>
      <td><?=$key['id'];?></td>
      <td><?=$key['nome'];?></td>
      <td><?=$key['telefone'];?></td>
      <td><?=$key['adicional'];?></td>
      <?php  
         foreach ($vetorRegistroFeito as $feito) {
        
       if ($feito["id_usuario"] == $key["id"] && $feito["feito"] == 1) {
          
           $fez++;
       } 
       if ($feito["id_usuario"] == $key["id"] && $feito["cancelou"] == 1) {
            // @$feito['feito']++;
          // $contador = $feito['fez'];
           $cancelado++;
       }}
     
?>
<td><?=$fez;?></td>
<td><?=$cancelado;?></td>
     
    </tr>
  <?php  } }  ?>
  </tbody>
</table>
  </body>
</html>