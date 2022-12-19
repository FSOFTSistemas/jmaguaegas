<?php

include "bd.php";

$id = $_POST['id'];
$nome = $_POST['nome'];

echo "ID: ".$id."testes";

$timezone = new DateTimeZone('America/Sao_Paulo');
$data_atual = new DateTime('now', $timezone);
$data_atual = $data_atual->format('Y-m-d');

try {
        $usuario = "u114975982_kikogasbd";
        $senha = "Benicio01";
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=u114975982_kikogasbd', $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //preparo minha query JLC
        $query = $pdo->prepare('select COUNT(id) from Entrega where entregador = :nome and data like :dt');
        $query->execute(array(
            ':nome'   => $nome,
            ':dt' => $data_atual.'%'
        ));
        $count = 0;
        $linha = $query->fetch(PDO::FETCH_ASSOC);
        $count = $linha['COUNT(id)'];
        
        
        $stmt = $pdo->prepare('UPDATE Entrega SET entregador = :pnome, numpedido = :pedido WHERE id = :pid');
        //executo o comando da query passando como parâmetro minhas variáveis JLC   
        $stmt->execute(array(
            ':pid'   => $id,
            ':pnome' => $nome,
            ':pedido' => $count+1
        ));
         
        echo $stmt->rowCount(); 

} catch(PDOException $e) {

  echo 'Error: ' . $e->getMessage();
}
?>