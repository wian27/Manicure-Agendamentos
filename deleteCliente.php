<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 require_once('Conexao/conexao.php');


@$id = $_POST['id'];

$sql = "DELETE FROM clientes WHERE id=?";
$sqlprep = $conexao->prepare($sql);
$sqlprep->bind_param("i",$id);
$sqlprep->execute();
$msgOk = "Cliente excluido com sucesso";

header("Location:listaClientes.php?msg=$msgOk");


?>
