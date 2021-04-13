<?php
$nomeServidor = "localhost";
$usuario = "root";
$senha = "";
$banco = 'cad_filmes';

//comando para conectar com BD mysql
$conexao = mysqli_connect($nomeServidor, $usuario, $senha);

//comando para selecionar o BD que vai utilizar
$base_dados = mysqli_select_db($conexao, $banco);

//comando para alterar o charset do banco
if (!mysqli_set_charset($conexao, 'utf8')) {
    $msg = '<div class="alert alert-danger"><strong> Erro ao usar utf8: </strong></div>';
    die($msg . mysqli_error($conexao));
}

// Testar conexão
if (!$conexao) {
    $msg = '<div class="alert alert-danger"><strong> Connection failed: </strong></div>';
    die($msg . mysqli_connect_error());
}
// Testa se base de dados existe
if (!$base_dados) {
    $msg = '<div class="alert alert-danger"><strong> Erro: Base de dados não existe!</strong></div>';
    die($msg);
}