<?php 
    $dsn = "mysql:host=127.0.0.1;dbname=u114975982_kikogasbd;charset=utf8";
    $usuario = "u114975982_kikogasbd";
    $senha = "Benicio01";

    try{

        $PDO = new PDO($dsn, $usuario, $senha);

        //echo "<h1>Conectado com sucesso !</h1>";

    }catch(PDOException $erro){
        //echo "<h1>Erro ao conectar </h1>";
    }

?>