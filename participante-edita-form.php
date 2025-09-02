<?php
if(!isset($_GET["cod"])){
echo 'Escolha um participante da lista!<br>'.
     '<a href="participante-lista.php">Clique aqui</a>';
     exit();
}
require "conexao.php";

$idUsuario = $_GET["cod"];
$sql = "select * from Usuario where idUsuario =?";
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
    <title>Edição de participantes</title>
    <link rel="stylesheet" href="Style-Edita.css">
</head>
<body>
    
<h1>EDIÇÃO DE PARTICIPANTES</h1>
<form method="post" action="./participante-edita.php">
    <table border="1" align="center">
    <tr>
        <td>Código: </td>
        <td> 
          <?= $dados['idUsuario'] ?>    
          <input type="hidden" name="idUsuario"
           value="<?= $dados["idUsuario"]?>">   
        </td>
    </tr>
<tr>
    <th>Nome:</th>
    <td>
    <input type="text" name="nome" size="40"
    value="<?= $dados['nome'] ?>">    
    </td>
</tr>
<tr>
    <th>Cpf:</th>
    <td>
        <input type="text" name="cpf"
        value="<?= $dados['cpf'] ?>">
    </td>
</tr>
<tr>
    <th>data de nascimento:</th>
    <td>
    <input type="date" name="data_nasc"
    value="<?= $dados['data_nascimento'] ?>">
    </td>
</tr>
<tr>
    <th>Celular:</th>
    <td>
    <input type="text" name="celular"
    value="<?= $dados['celular'] ?>">
    </td>
</tr>
<tr>
    <th>email:</th>
    <td>
    <input type="text" name="email" size="20"
    value="<?= $dados['email'] ?>">
    </td>
</tr>
<tr>
    <th>Idade:</th>
    <td>
    <input type="text" name="idade"
    value="<?= $dados['idade'] ?>">
    </td>
</tr>
<tr>
    <th colspan="2">endereco</th>
</tr>
<tr>
    <th>Cidade:</th>
    <td>
    <input type="text" name="Cidade"
    value="<?= $dados['Cidade'] ?>">
    </td>
</tr>
<th>Estado:</th>
 <td>
 <select name="Estado">
    <option value="AC" <?= $dados['Estado'] == 'AC' ? 'selected' : '' ?>>Acre</option>
     <option value="AL" <?= $dados['Estado'] == 'AL' ? 'selected' : '' ?>>Alagoas</option>
      <option value="AP" <?= $dados['Estado'] == 'AP' ? 'selected' : '' ?>>Amapá</option>
       <option value="AM" <?= $dados['Estado'] == 'AM' ? 'selected' : '' ?>>Amazonas</option>
        <option value="BA" <?= $dados['Estado'] == 'BA' ? 'selected' : '' ?>>Bahia</option>
         <option value="CE" <?= $dados['Estado'] == 'CE' ? 'selected' : '' ?>>Ceará</option>
          <option value="DF" <?= $dados['Estado'] == 'DF' ? 'selected' : '' ?>>Distrito Federal</option>
           <option value="ES" <?= $dados['Estado'] == 'ES' ? 'selected' : '' ?>>Espírito Santo</option>
            <option value="GO" <?= $dados['Estado'] == 'GO' ? 'selected' : '' ?>>Goiás</option>
             <option value="MA" <?= $dados['Estado'] == 'MA' ? 'selected' : '' ?>>Maranhão</option>
              <option value="MT" <?= $dados['Estado'] == 'MT' ? 'selected' : '' ?>>Mato Grosso</option>
               <option value="MS" <?= $dados['Estado'] == 'MS' ? 'selected' : '' ?>>Mato Grosso do Sul</option>
                <option value="MG" <?= $dados['Estado'] == 'MG' ? 'selected' : '' ?>>Minas Gerais</option>
                 <option value="PA" <?= $dados['Estado'] == 'PA' ? 'selected' : '' ?>>Pará</option>
                  <option value="PB" <?= $dados['Estado'] == 'PB' ? 'selected' : '' ?>>Paraíba</option>
                 <option value="PR" <?= $dados['Estado'] == 'PR' ? 'selected' : '' ?>>Paraná</option>
                <option value="PE" <?= $dados['Estado'] == 'PE' ? 'selected' : '' ?>>Pernambuco</option>
               <option value="PI" <?= $dados['Estado'] == 'PI' ? 'selected' : '' ?>>Piauí</option>
              <option value="RJ" <?= $dados['Estado'] == 'RJ' ? 'selected' : '' ?>>Rio de Janeiro</option>
             <option value="RN" <?= $dados['Estado'] == 'RN' ? 'selected' : '' ?>>Rio Grande do Norte</option>
            <option value="RS" <?= $dados['Estado'] == 'RS' ? 'selected' : '' ?>>Rio Grande do Sul</option>
           <option value="RO" <?= $dados['Estado'] == 'RO' ? 'selected' : '' ?>>Rondônia</option>
          <option value="RR" <?= $dados['Estado'] == 'RR' ? 'selected' : '' ?>>Roraima</option>
         <option value="SC" <?= $dados['Estado'] == 'SC' ? 'selected' : '' ?>>Santa Catarina</option>
        <option value="SP" <?= $dados['Estado'] == 'SP' ? 'selected' : '' ?>>São Paulo</option>
       <option value="SE" <?= $dados['Estado'] == 'SE' ? 'selected' : '' ?>>Sergipe</option>
      <option value="TO" <?= $dados['Estado'] == 'TO' ? 'selected' : '' ?>>Tocantins</option>
</select> 
</td>
</tr>
<tr>
    <td colspan="2" align="center">
       <input type="submit" value="Salvar Modificação" name="Salvar">
    </td>
</tr>
</h1>

</body>
</html>