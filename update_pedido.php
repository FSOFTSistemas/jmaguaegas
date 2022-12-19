<?php

include "bd.php";

$id = $_POST['id'];
$descricao = $_POST['descricao'];

try {
        $usuario = "u114975982_kikogasbd";
        $senha = "Benicio01";
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=u114975982_kikogasbd', $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //preparo minha query
        $stmt = $pdo->prepare('UPDATE Entrega SET descricao = :pdescricao WHERE id = :pid');
        //executo o comando da query passando como parâmetro minhas variáveis
        $stmt->execute(array(
            ':pid'   => $id,
            ':pdescricao' => $descricao
        ));
         
        echo $stmt->rowCount(); 

} catch(PDOException $e) {

  echo 'Error: ' . $e->getMessage();
}
?>