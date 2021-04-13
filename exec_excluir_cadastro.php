<?php

require_once('conectar.php');

$codigo = $_POST['codigo'];

$sql = "SELECT capa FROM filme WHERE codigo='$codigo'";
$retorno = mysqli_query($conexao, $sql);

if (mysqli_num_rows($retorno) > 0) {
    $registro = mysqli_fetch_assoc($retorno);
} else {
    $msg = "Error: " . $sql . "<br>" . mysqli_error($conexao);
    mysqli_close($conexao);
    header("location: lista_cadastro.php?retorno=$msg");
}

//Se ocorrer erro ou não for enviada capa para o filme é atribuida uma imagem padrão a capa

$sql = "DELETE FROM filme "
        . "WHERE codigo='$codigo'";

if (mysqli_query($conexao, $sql)) {
    mysqli_close($conexao);
    //apaga a capa armazenada para o filme
    if ($registro['capa'] != 'imagens/sem_foto.png') {
        unlink($registro['capa']);
    }
    header("location: lista_cadastro.php");
} else {
    $msg = "Error: " . $sql . "<br>" . mysqli_error($conexao);
    mysqli_close($conexao);
    header("location: lista_cadastro.php?status=$msg");
}
?>
