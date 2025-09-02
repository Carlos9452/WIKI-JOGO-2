<?php
if(!isset($_GET["cod"])){
echo 'Escolha um participante da lista!<br>'.
     '<a href="participante-lista.php">Clique aqui</a>';
     exit();
}
require "conexao.php";

$idUsuario = $_GET["cod"];

$sql = "select * from Usuario where idusuario =?";


$consulta = $mysqli->prepare($sql);

$consulta->bind_param("i",$idUsuario);

$consulta->execute();
$resultado = $consulta->get_result();

$dados = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <h1>Detalhes do participante</h1>
 <table border ="1" align="center">
 <tr>
    <th>Codigo Usuario: </th>
    <td> <?= $dados["idUsuario"] ?> </td>
</tr>  
<tr>
    <th>Nome: </th>
    <td> <?= $dados["nome"] ?> </td>
</tr> 
<tr>
    <th>Senha: </th>
    <td> <?= $dados["senha"] ?> </td>
</tr> 
<tr>
    <th>E-Mail: </th>
    <td> <?= $dados["email"] ?> </td>
</tr> 
<tr>
    <th>CPF: </th>
    <td> <?= $dados["cpf"] ?> </td>
</tr> 
<tr>
    <th>Idade: </th>
    <td> <?= $dados["idade"] ?> </td>
</tr> 
<tr>
    <th>Data de nascimento: </th>
    <td> <?= $dados["data_nascimento"] ?> </td>
</tr> 
<tr>
    <th colspan="2">Endereço</th>
</tr>
<tr>
    <th>Cidade: </th>
    <td> <?= $dados["Cidade"] ?> </td>
</tr> 
<tr>
    <th>Estado: </th>
    <td> <?= $dados["Estado"] ?> </td>
</tr> 
</table>
<p align="center">
    <a href="./participante-lista.php">VOLTAR </a>
</p>
</body>
</html>



