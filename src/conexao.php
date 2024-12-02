<?php
    $server = '127.0.0.1';
    $user = 'root';
    $password = '';
    $bd = 'BD_TechWay';

    $conexao = mysqli_connect($server,$user,$password,$bd) or die("Falha ou erro na conexão".mysqli_error());

	mysqli_set_charset($conexao,'utf8');
?>