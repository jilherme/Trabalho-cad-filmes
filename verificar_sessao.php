<?php

//error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] != 'LOGIN_EFETUADO') {
    $msg = urlencode('Efetue login para continuar!');
    header("location: login.php?retorno=$msg");
    exit;
}

//Verifica se o cookie não expirou
if (!isset($_COOKIE["login"])) {
    if (!isset($_SESSION)) {
        session_start();
    }
    session_unset($_SESSION);
    $_SESSION['login'] = '';
    $_SESSION['user'] = '';
    $msg = urlencode('Sessão expirou! Efetue login para continuar!');
    header("location: login.php?retorno=$msg");
}
?>

