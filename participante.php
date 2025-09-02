<?php
require "conexao.php";

$sql = "select * from Usuario";

$resultado = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participantes cadastrados</title>
</head>
<body>
<h1>PARTICIPANTES CADASTRADOS</h1>

<table border="1">
    <tr>
        <th>CODIGO</th>
        <th>NOME</th>
        <th>SENHA</th>
        <th>E-MAIL</th>
        <th>CPF</th>
        <th>IDADE</th>
        <th>DATA NASCIMENTO</th>
        <th>ESTADO</th>
        <th>CIDADE</th>
</tr>
<?php
if ($resultado->num_rows > 0){

 while($linha = $resultado->fetch_assoc()){
    echo'<tr>';
    echo'<td>' . $linha['idUsuario'] . '</td>';
    echo'<td>' . $linha['nome']             . '</td>';
    echo'<td>' . $linha['senha']            . '</td>';
    echo'<td>' . $linha['email']            . '</td>';
    echo'<td>' . $linha['cpf']              . '</td>';
    echo'<td>' . $linha['idade']            . '</td>';
    echo'<td>' . $linha['data_nascimento']  . '</td>';
    echo'<td>' . $linha['Estado']           . '</td>';
    echo'<td>' . $linha['Cidade']           . '</td>';
    echo'<td><a href="./participante-detalhe.php?cod=' .
    $linha['idUsuario'] . '".detalhes </a> </td>';
    echo'</tr>';
}   
} else{

    echo '<tr><td colspan="6">a tabela esta vazia!</td>/<tr>';
}
?>
</table>    
</body>
</html>