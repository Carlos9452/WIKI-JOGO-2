<?php 
// 'Chama' o arquivo de conexão com o bd
require "conexao.php";

// consulta sql para ler os dados da tabela participante 
$sql = "Select * from usuario";

// envia a consulta para ser executada pelo mysql
// e recebe o resultado
$resultado = $mysqli->query($sql);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participantes Cadastrados</title>
</head>
<body>
    <h1>PARTICIPANTE CADASTRADOS</h1>
    <table border="1">
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>Celular</th>
            <th>Data Nascimento</th>
        </tr>
        <?php 
         if ($resultado->num_rows > 0){
            // a consulta retornou registros
            while($Linha = $resultado->fetch_assoc()){
                echo '<tr>';
                echo '<td>'. $Linha['idUsuario']. '</td>';
                echo '<td>'. $Linha['nome']. '</td>';
                echo '<td>'. $Linha['cpf']. '</td>';
                echo '<td>'. $Linha['email']. '</td>';
                echo '<td>'. $Linha['Estado']. '</td>';
                echo '<td>'. $Linha['celular']. '</td>';
                echo '<td>'. $Linha['data_nascimento']. '</td>';
                echo '<td><a href="./participante-detalhe.php?cod='.
                   $Linha['idUsuario'] . '"> detalhes</a></td>';
                echo '</tr>';
            }
         } else{
            echo '<tr><td colspan=6>A tabela esta vaiza!</td></tr>';
         }
        ?>    
    </table>
</body>
</html>