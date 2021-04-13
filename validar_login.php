<?php

//conexao com o banco de dados
require_once('conectar.php');

if (isset($_POST['use']) && !empty($_POST['use'])) {
    //pegar os dados do formulario (via post)
    $use = $_POST['use'];
    $pas = $_POST['pas'];

//testar com o banco de dados
    $sql = "select * from usuario where nome='$use' and senha='$pas'";
    $retorno = mysqli_query($conexao, $sql) or die('ERRO...');
    $num = mysqli_num_rows($retorno);

    if ($num > 0) {
        session_start();
        $_SESSION['login'] = 'LOGIN_EFETUADO';
        $_SESSION['user'] = $use;
        
        //Exemplo ajuste de tempo de expiração para cookie:
        //ajuste de 30 dias  (60 seg * 60 min * 24 horas * 30 dias)
        //$expira = time() + 60*60*24*30;
        
        //Exemplo de cookie para 60 segundos
        $expira = time() + 60*3;
        
        //Cria um cookie que expira em um determinado horário
        setcookie("login", "logado", $expira);
        
        header("location: index.php");
    } else {
        $msg = urlencode('Dados invalidos!');
        header("location: login.php?retorno=$msg");
    }
} else {
    //o cara chegou aqui sem passar pelo form de login
    $msg = 'Acesso negado - Efetue o login';
    header("location: login.php?retorno=$msg");
}
?>