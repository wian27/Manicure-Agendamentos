
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once 'Conexao/conexao.php';

$sql = "SELECT * FROM clientes";
$resultadoSql = $conexao->query($sql);
$vetorRegistros = $resultadoSql->fetch_all(MYSQLI_ASSOC);


if (isset($_POST['pesquisar'])) {
  //$tipo = $_POST['pesquisar'];

 $pesquisar = $_POST['pesquisar'];
 //$pesquisarLike = "%".$pesquisar."%";
 $sql = "SELECT * FROM clientes where %".$pesquisar."%  like ? order by nome DESC";
 $sqlprep = $conexao->prepare($sql);
 $sqlprep->bind_param($pesquisar);
 $sqlprep->execute();
 $resultadoSql = $sqlprep->get_result();
}else{
  $pesquisar = "";
  $sql = "SELECT * FROM clientes order by nome desc";
  $resultadoSql = $conexao->query($sql);
}
$vetorRegistros = $resultadoSql->fetch_all(MYSQLI_ASSOC);


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/estilo.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <title>Lista de Clientes</title>
  </head>
  <body>
              <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Lista de Clientes</a>
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
      <form class="d-flex" action="listaClientes.php" method="POST">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="pesquisar" id="pesquisar">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    <br>
 
    <?php
                         

                         

                            $sql= "SELECT * FROM agendamentos ";
                          $resultadoFeitos = $conexao->query($sql);
                          $vetorRegistroFeito = $resultadoFeitos->fetch_all(MYSQLI_ASSOC);
         $excluido = "";                 
if (isset($_GET['msg'])) {
  $excluido = $_GET['msg'];
}
      ?>  
      
<h5  style="background-color: red;"> <?php echo $excluido;?></h5>
<table class="table caption-top table-dark table-borderless">
  <caption>Lista de Clientes</caption>
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">Telefone</th>
      <th scope="col">Adicional</th>
           
    </tr>
  </thead>

  <tbody>

    <?php
/*while ($rows_cursos = mysqli_fetch_array($resultado)) {
    //echo $rows_cursos['nome']."<br>";
 
    echo "<a href=\"perfil.php", " \">" . $rows_cursos['nome'] . "</a><br>";
}*/
       foreach ($vetorRegistros as $key) {
 
      ?>
    <tr>
      <td><?=$key['id'];?></td>
      <td><a href="profile.php?id=<?=$key['id'];?>"><?=$key['nome'];?></a></td>
      <td><?=$key['telefone'];?></td>
      <td><?=$key['adicional'];?></td>
      <td>
                        <form action="formCliente.php" method="POST">
                        <input type="number" name="id" value="<?=$key['id'];?>" hidden="true">
                        <input type="number" hidden="true" name="fez" value="1">
                        <button type="submit">EDITAR</button>
                       </form>
              
               </td> 
               <td>
                        <form action="deleteCliente.php" method="POST">
                        <input type="number" name="id" value="<?=$key['id'];?>" hidden="true">
                        <input type="number" hidden="true" name="fez" value="1">
                        <button type="submit">EXCLUIR</button>
                       </form>
              
               </td> 
    </tr>
  <?php  }?>
  </tbody>
</table>
  </body>
</html>