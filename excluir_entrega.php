<?php

require_once 'Conexao.php';

$id = $_POST['id'];
$status = "Excluido";

try {
        $pdo = Conexao::getInstance();
        //preparo minha query
        $stmt = $pdo->prepare('UPDATE Entrega SET status = :excluido WHERE id = :pid');
        //executo o comando da query passando como parâmetro minhas variáveis
        $stmt->execute(array(
            ':pid'   => $id,
            ':excluido' => $status
        ));
         
        echo $stmt->rowCount(); 

} catch(PDOException $e) {

  echo 'Error: ' . $e->getMessage();
}
