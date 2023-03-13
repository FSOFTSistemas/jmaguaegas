<?php

include "bd.php";

$id = $_POST['id'];
$nome = $_POST['nome'];

echo "ID: ".$id."testes";

$timezone = new DateTimeZone('America/Sao_Paulo');
$data_atual = new DateTime('now', $timezone);
$data_atual = $data_atual->format('Y-m-d');

try {

        //preparo minha query JLC
        $query = $PDO->prepare('select COUNT(id) from Entrega where entregador = :nome and data like :dt');
        $query->execute(array(
            ':nome'   => $nome,
            ':dt' => $data_atual.'%'
        ));
        $count = 0;
        $linha = $query->fetch(PDO::FETCH_ASSOC);
        $count = $linha['COUNT(id)'];
        
        
        $stmt = $PDO->prepare('UPDATE Entrega SET entregador = :pnome, numpedido = :pedido WHERE id = :pid');
        //executo o comando da query passando como parâmetro minhas variáveis JLC   
        $stmt->execute(array(
            ':pid'   => $id,
            ':pnome' => $nome,
            ':pedido' => $count+1
        ));
        
        
        //AGORA DECREMENTANDO O ESTOQUE
        try {
            //preparo minha query JLC
        $query = $PDO->prepare('select * from Entrega where id = :id');
        $query->execute(array(
            ':id'   => $id
        ));
        $linha = $query->fetch(PDO::FETCH_ASSOC);
            
          $temp = $PDO->prepare('UPDATE Produto SET estoque = (estoque - :saida) WHERE id = :id');
          $temp->execute(array(
            ':id'   => $linha['id_produto'],
            ':saida' => $linha['qtde']
          ));
        
          echo $temp->rowCount();
        } catch(PDOException $e) {
          echo 'Error: ' . $e->getMessage();
        }
         
        echo $stmt->rowCount(); 

} catch(PDOException $e) {

  echo 'Error: ' . $e->getMessage();
}
?>