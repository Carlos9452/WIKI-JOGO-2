<?php 
//verifica se o formulario foi executado ou não 
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    Echo 'Preencha o formulario! <br>'.
     '<a href="participante-cadastro-form.html">Clique Aqui</a>';
    Exit();
}

// conectar com o BD mysql
require 'conexao.php';

//lê os dados do formulario em variaveis 
$nome                     =$_POST['nome'];
$email                   =$_POST['email'];
$cpf                       =$_POST['cpf'];
$celular               =$_POST['celular'];
$data_nascimento      =$_POST['data_nascimento'];
$Estado                 =$_POST['Estado'];
$Cidade                 =$_POST['Cidade'];

//cria o comando a ser envido para o BD
$sql = "insert into Usuario
        (nome,email,cpf,celular,data_nascimento,Estado,Cidade)
        values
        (?, ?, ?, ?, ?, ?, ?)";
// cada ? indica um valor que sera passado para a consulta
//cria a consulta
$consulta = $mysqli->prepare($sql);

$consulta->bind_param("sssssss",
    $nome, $email, $cpf, $celular, $data_nascimento, $Estado ,$Cidade);
$consulta->execute();

$consulta->close();
$mysqli->close();

header("location: Usuario Cadastrados.php");
?>