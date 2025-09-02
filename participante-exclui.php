<?php
if(!isset($_GET["cod"])){
echo 'Escolha um participante da lista!<br>'.
     '<a href="participante-lista.php">Clique aqui</a>';
     exit();
}
require "conexao.php";

$idUsuario = $_GET["cod"];

$sql = "delete from Usuario where idUsuario =?";


$consulta = $mysqli->prepare($sql);

$consulta->bind_param("i",$idUsuario);

$consulta->execute();

// encerrar a consulta e a conexão com o BD
$consulta->close();
$mysqli->close();

//volta para a listagem de participantes
header('location: participante-lista.php');
?>