<?php
 require_once 'Conexao/conexao.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['id'])) {

    $id = $_POST['id'];
} else {

    $id = 0;
}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Novo Agendamento</title>
  </head>
  <body>
      <?php
                        

                          $sql= "SELECT * FROM clientes order by nome asc";
                          $resultadosql = $conexao->query($sql);
                          $vetorRegistros = $resultadosql->fetch_all(MYSQLI_ASSOC);

      ?>  
  	<div class="container">
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
    <h1>Novo Agendamento</h1>

     <form class="row g-3" action="processa.php" method="POST">
     	<input type="number" name="id" hidden="true" >
<div class="form-floating mb-3">
 <select class="form-select" aria-label="Default select example" name="id_usuario" ">
  <option selected>Seliconar Cliente</option>
  <?php foreach ($vetorRegistros as $key) { ?>
  <option value="<?=$key['id'];?>"><?=$key['nome'];?></option>
   <?php  }?>
</select>
</div>
<div class=" col-md-6 form-floating">
  <input type="date" class="form-control" id="dia" name="dia" placeholder="dia">
  <label for="dia">Dia</label>
</div>
 
  <div class="col-md-6 form-floating">
   
    <input type="time" class="form-control" id="hora" name="hora">
    <label for="hora">Hora</label>
  </div>
  <div class=" form-floating">
   
    <input type="text" class="form-control" id="tipo" name="tipo">
     <label for="tipo" class="form-label">Tipo de atendimento</label>
  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-primary">Agendar</button>
  </div>
</form>
</div>
  </body>
</html>