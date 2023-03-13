<?php
//conexao com banco de dados
$dsn = "mysql:host=127.0.0.1;dbname=u114975982_kikogasbd;charset=utf8";
    $usuario = "u114975982_kikogasbd";
    $senha = "Benicio01";
    $db = "Entrega";

    $connect = mysqli_connect($dsn, $usuario, $senha, $db);

    if(mysqli_connect_error()){
        echo "Erro na conexão: ".mysqli_connect_error();
    }