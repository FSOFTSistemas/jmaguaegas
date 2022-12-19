<?php

include "bd.php";

$id = $_POST['id'];

try {
        $usuario = "u114975982_kikogasbd";
        $senha = "Benicio01";
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=u114975982_kikogasbd', $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('DELETE FROM Produto WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo $stmt->rowCount();

} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
?>