<?php

require_once 'Conexao.php';

$id = $_POST['id'];

try {
  $pdo = Conexao::getInstance();
  //preparo minha query
  $stmt = $pdo->prepare('DELETE FROM Produto WHERE id = :pid');
  //executo o comando da query passando como parâmetro minhas variáveis
  $stmt->execute(array(
    ':pid'   => $id
  ));

  echo $stmt->rowCount();
} catch (PDOException $e) {

  echo 'Error: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=
  , initial-scale=1.0">
  <title>Produto</title>
</head>

<body>
  <?php
  if ($stmt != 0) {
    echo "
          <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://www.kikogasgus.com.br/Produto.php'>
          <script type=\"text/javascript\">
            alert(\"Produto Excluido com Sucesso.\");
          </script>
        ";
  } else {
    echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://www.kikogasgus.com.br/Produto.php'>
        <script type=\"text/javascript\">
          alert(\"Produto não foi Ecluido com Sucesso.\");
        </script>
      ";
  }
  ?>
</body>

</html>