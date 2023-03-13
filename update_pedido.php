<?php

include "bd.php";

$id = $_POST['id'];
$descricao = $_POST['descricao'];

try {

        //preparo minha query
        $stmt = $PDO->prepare('UPDATE Entrega SET descricao = :pdescricao WHERE id = :pid');
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