<?php

include "bd.php";

$id = $_POST['id'];
$status = "Excluido";

try {

        //preparo minha query
        $stmt = $PDO->prepare('UPDATE Entrega SET status = :excluido WHERE id = :pid');
        //executo o comando da query passando como parâmetro minhas variáveis
        $stmt->execute(array(
            ':pid'   => $id,
            ':excluido' => $status
        ));
        
        
          //AGORA incrementando O ESTOQUE
        try {
            //preparo minha query JLC
        $query = $PDO->prepare('select * from Entrega where id = :id');
        $query->execute(array(
            ':id'   => $id
        ));
        $linha = $query->fetch(PDO::FETCH_ASSOC);
            
          $temp = $PDO->prepare('UPDATE Produto SET estoque = (estoque + :saida) WHERE id = :id');
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
