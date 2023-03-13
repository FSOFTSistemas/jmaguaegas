<?php

require_once 'Conexao.php';

$id = $_POST['id'];
$descricao = $_POST['descricao'];

try {
        $pdo = Conexao::getInstance();
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
