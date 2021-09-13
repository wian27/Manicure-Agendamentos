<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 require_once('Conexao/conexao.php');




//$foto = $_FILES['foto'];
//$id = $_POST['id'];
@$id_usuario = $_POST["id_usuario"];

@$fez = $_POST["fez"];



		$sql ="INSERT INTO feitos(id_usuario,fez) values(?,?)";
		$sqlprep = $conexao->prepare($sql);
		$sqlprep->bind_param("ii",$id_usuario,$fez);
		$sqlprep->execute();
		$msgOk = "Conta inserida com sucesso";

	header("Location:index.php");
?>
