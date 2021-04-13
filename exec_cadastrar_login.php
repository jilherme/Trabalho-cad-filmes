<?php

require_once('conectar.php');

//pegamos os dados que vieram do formulario no vetor $_POST 
$nome = $_POST['use'];
$senha = $_POST['pas'];

//montar o comando SQL que vai gravar os dados na tabela cadastro
$sql = "insert into usuario (nome,senha) values ('$nome','$senha')";
//executar/gravar os dados na tabela
mysqli_query($conexao, $sql)or die(mysqli_error($conexao));

$msg= urlencode('Usuário criado com sucesso!');
header("location: login.php?retorno=$msg");

?>   