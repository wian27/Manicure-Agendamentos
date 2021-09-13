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

$sql = "SELECT * FROM clientes where id=?";
$sqlprep = $conexao->prepare($sql);
$sqlprep->bind_param("i", $id);
$sqlprep->execute();
$sqlResultado = $sqlprep->get_result();
$vetorUmRegistro = $sqlResultado->fetch_assoc();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Novo Cliente</title>
  </head>
  <body>
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
    <h1>Novo Cliente</h1>

     <form class="row g-3" action="processaCliente.php" method="POST">
     	<input type="number" name="id" hidden="true" value="<?= $vetorUmRegistro['id']; ?>">

<div class=" col-md-6 form-floating">
  <input type="text" class="form-control" id="dia" name="nome"  value="<?= $vetorUmRegistro['nome']; ?>">
  <label for="nome">Nome</label>
</div>
 
  <div class="col-md-6 form-floating">
   
    <input type="number" class="form-control" id="hora" name="telefone" value="<?= $vetorUmRegistro['telefone']; ?>">
    <label for="telefone">Telefone</label>
  </div>
  <div class=" form-floating">   
    <input type="text" class="form-control" id="tipo" name="adicional" value="<?= $vetorUmRegistro['adicional']; ?>">
     <label for="adicional" class="form-label">Informação adicional</label>
  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-primary">Salvar</button>
  </div>
</form>
</div>
  </body>
</html>