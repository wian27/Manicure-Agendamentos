<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 require_once('Conexao/conexao.php');




//$foto = $_FILES['foto'];
$id = $_POST['id'];
@$id_usuario = $_POST["id_usuario"];
//$nome = $_POST["nome"];
@$dia = $_POST["dia"];
@$hora = $_POST['hora'];
@$tipo = $_POST['tipo'];
@$agendado = $_POST['agendado'];
@$feito = $_POST['feito'];
@$cancelou = $_POST['cancelou'];


var_dump($_POST);

// Inicio Arquivo de upload

/*date_default_timezone_set("America/Sao_paulo");
$dataEHora = date('dmYHi');
$nome_arquivo = "fotos/".$dataEHora . $_FILES["foto"]["name"];
$nome_arquivo_tmp = $_FILES["foto"]["tmp_name"];
$msgErroArquivo = "";

if (move_uploaded_file($nome_arquivo_tmp,$nome_arquivo)==false) {
	$msgErroArquivo = "Arquivo de foto não pode ser enviado";
}*/

// Fim Arquivo de upload
if ($id == 0) {
		$sql ="INSERT INTO agendamentos(dia,hora,tipo,id_usuario) values(?,?,?,?)";
		$sqlprep = $conexao->prepare($sql);
		$sqlprep->bind_param("sssi",$dia,$hora,$tipo,$id_usuario);
		$sqlprep->execute();
		$msgOk = "Conta inserida com sucesso";
}else{
	$sql = "UPDATE agendamentos SET agendado=?,feito=?,cancelou=?  where id=?";
	$sqlprep = $conexao->prepare($sql);
	$sqlprep->bind_param("biii",$agendado,$feito,$cancelou,$id);
	$sqlprep->execute();
}

/*
	$sql = "UPDATE portoes SET foto=? where id=?";
	$sqlprep = $conexao->prepare($sql);
	$sqlprep->bind_param("s",$nome_arquivo);
	$sqlprep->execute();
	$msgOk = "Conta atualizada com sucesso";

*/
	header("Location: index.php");
?>
