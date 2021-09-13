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
    <title>Historico de Agendamentos</title>
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
                 
                  <?php
                                       require_once 'Conexao/conexao.php';

                                        $sql= "SELECT * FROM agendamentos order by data_agendamento desc";
                                        $resultadosql = $conexao->query($sql);
                                        $vetorRegistros = $resultadosql->fetch_all(MYSQLI_ASSOC);


                                        $sql= "SELECT * FROM clientes ";
                                        $resultadoClinetes = $conexao->query($sql);
                                        $vetorRegistrosClientes = $resultadoClinetes->fetch_all(MYSQLI_ASSOC);                        

                    ?>  
                    

              <table class="table caption-top table-dark table-borderless">
                <caption>Historico de agendamentos</caption>
                <thead>
                  <tr>
                   
                    <th scope="col">Nome</th>
                     <th scope="col">Dia e Hórario de Agendamento</th>
                    <th scope="col">Hórario</th>
                    <th scope="col">Data</th>
                    <th scope="col">Tipo</th>
                  </tr>
                </thead>

                <tbody>

                  <?php
                    $fez = "";
                   foreach ($vetorRegistros as $key) {

                            foreach ($vetorRegistrosClientes as $clientes) { 

                              if($key['id_usuario'] == $clientes['id']){
                                   if ($key['id_usuario'] == $clientes['id'] && $key['feito'] == 1) {
                                  $fez = "Feito";
                                }else if($key['id_usuario'] == $clientes['id'] && $key['cancelou'] == 1){
                                  $fez = "Cancelou";
                                }else if($key['id_usuario'] == $clientes['id'] && $key['cancelou'] == 0 && $key['feito'] == 0 ){
                                  $fez = "Agendado";
                                }
                   ?>
                   <tr>
                     <td><a href="profile.php?id=<?=$key['id_usuario'];?>"><?=$clientes['nome']; }}?></a></td>
                   
                    <td><?=$key['hora_agendamento'];?> <?=date("d/m/Y",strtotime($key['data_agendamento']));?></td>        
                    <td><?=$key['hora'];?></td>
                    <td><?=date("d/m/Y", strtotime($key['dia']));?></td>      
                    <td><?=$key['tipo'];?></td>
                    <td><?=$fez?></td>
                  </tr>
               <?php  } ?>
                </tbody>
                 
              </table>
      </div>
     
  </body>
</html>