<?php
session_start();
session_unset();
$_SESSION['login'] = '';
$_SESSION['user'] = '';
header("location: index.php");
