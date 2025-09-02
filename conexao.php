<?php
//arquivo de conexao do php com o mysql deve ser usado por todos os 
//scripts que fazem acesso ao banco de dados.

//variaveis com os dados da conexao
$host    ='localhost';  // endereco do servido
$usuario ='root';       // usuario
$senha   ='';       // senha do usuario
$bd      ='Shadow_of_the_sins';     // nome do bd que deseja acessar

//faz a conexao
$mysqli = new mysqli($host,$usuario,$senha,$bd);

// verifica se a conexao foi bem sucedida
if($mysqli ->errno) {
 die ('ERRO de conexao. ERRO:' . $mysqli->connect_error); 
} // else {
  //   echo 'conexao bem sucedida!';
  //}

// Define a codificacao dos dados (charset) para exibir os caracteres 
//acentuados de forma correta
$mysqli->set_charset("utf8");

?>
