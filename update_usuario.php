<?php

require_once 'Conexao.php';
$id = $_POST['id'];
$nome = $_POST['nome'];
$senha2 = $_POST['senha'];
$telefone = $_POST['telefone'];

try {
  $pdo = Conexao::getInstance();
  //preparo minha query
  $stmt = $pdo->prepare('UPDATE usuario SET nome = :pnome, senha = :psenha, telefone = :ptelefone WHERE id = :pid');
  //executo o comando da query passando como parâmetro minhas variáveis
  $stmt->execute(array(
    ':pid'   => $id,
    ':pnome' => $nome,
    ':psenha' => $senha2,
    ':ptelefone' => $telefone
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
  <title>Usuario</title>
</head>

<body>
  <?php
  if ($stmt != 0) {
    echo "
          <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://www.kikogasgus.com.br/Usuario.php'>
          <script type=\"text/javascript\">
            alert(\"Usuario Alterado com Sucesso.\");
          </script>
        ";
  } else {
    echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://www.kikogasgus.com.br/Usuario.php'>
        <script type=\"text/javascript\">
          alert(\"Erro ao Alterar o Usuario.\");
        </script>
      ";
  }
  ?>
</body>

</html>