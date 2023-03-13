<?php

require_once 'Conexao.php';

$id = $_POST['id'];

try {
        $pdo = Conexao::getInstance();

        $stmt = $pdo->prepare('DELETE FROM Produto WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo $stmt->rowCount();

} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
