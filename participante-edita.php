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
$nome                   =$_POST['nome'];
$cpf                    =$_POST['cpf'];
$data_nascimento        =$_POST['data_nasc'];
$celular                =$_POST['celular'];
$email                  =$_POST['email'];
$idade                  =$_POST['idade'];
$Cidade                 =$_POST['Cidade'];
$Estado                 =$_POST['Estado'];

//cria o comando a ser envido para o BD
$sql = "update Usuario set
    nome              = ?,
    cpf               = ?,
    data_nascimento   = ?,
    celular           = ?,
    email             = ?,
    idade             = ?,
    Cidade            = ?,
    where Estado      =?";
// cada ? indica um valor que sera passado para a consulta
//cria a consulta
$consulta = $mysqli->prepare($sql);

$consulta->bind_param("sssssissi",
 $nome,$cpf,$data_nascimento,$celular,$email,$idade,$Cidade,$Estado);

$consulta->execute();

if(!consulta){
    die("ERRO: <br> (". $consulta->errno . ") <br> " .
        $consulta->error);
}
$consulta->close();
$mysqli->close();

header("location: Configuração_teste.php.php");
?>