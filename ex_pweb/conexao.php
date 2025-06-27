<?php

$host = "localhost";
$user = "root";
$pass = "";
$bd = "loja";

$conexao = mysqli_connect($host, $user, $pass, $bd);

if(!$conexao) die("Erro de conexão: ". mysqli_connect_error());
