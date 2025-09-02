<?php
// Conecta com o BD
require 'conexao.php';

// Verifica se o formulário foi "executado" 
// (se o botão submit foi clicado)
if (isset($_POST['login'])) {
    // Inicia / cria uma sessão
    session_start();

    // Lê os dados do formulário
    $usuario = $_POST['usuario'];
    $senha   = $_POST['senha'];

    // Cria o comando a ser enviado para o BD
    $sql = "select * from Login where nome = ? and senha = ?";

    // Cada ? indica um valor que será passado para a consulta
    // Cria a consulta
    $consulta = $mysqli->prepare($sql);

    // Substitui as interrogações pelos valores armazenados nas variáveis. É 
    // preciso indicar o tipo de dados para cada campo, usando a as iniciais:
    // i - valor numérico inteiro
    // d - valor real
    // s - string
    $consulta->bind_param("ss", $usuario, $senha);

    // Executa a consulta e lê o resultado
    $consulta->execute();

    // Lê o resultado da consulta
    $resultado = $consulta->get_result();

    // Verifica se a consulta retorna dados (econtrou um registro com o
    // usuário e senha informados)
    $n_usuarios = $resultado->num_rows;

    if ($n_usuarios > 0) {
        // Extrai os dados do resultado
        $dados = $resultado->fetch_assoc();

        // Grava na sessão os dados do usuário
        $_SESSION['nome_usuario']   = $dados['Nome'];
        $_SESSION['login_usuario']  = $dados['login'];
        $_SESSION['funcao_usuario'] = $dados['funcao'];

        // Redireciona para a página de controle
        header('location: index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuários</title>
</head>
<body>
    <table align="center">
        <tr>
            <th>ACESSO AO SISTEMA</th>
        </tr>
        <tr>
            <td align="center">
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                    Usuário: <input type="text" name="usuario"> <br>
                    Senha: <input type="password" name="senha"> <br>
                    <input type="submit" value="Acessar" name="login">
                </form>
            </td>
        </tr>
    </table>
</body>
</html>