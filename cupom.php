<?php 
    include "bd.php"; 
    $sql = "SELECT * FROM Entrega WHERE id ='" . $_GET['id'] . "' ";
    $usu = $PDO->prepare($sql);
    $usu->execute();
    $dados = $usu->fetch();
?>

<html>
<head>
  <meta charset="utf-8">
  <title>Cupom #<?php echo $_GET['id'] ?></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <link rel="stylesheet" href="cupom.css" type="text/css" />
  <style>
    @media print { #noprint { display:none; }	}
  </style>
</head>
<body>
<div class="cupom">
	<center><img src="JM.png" width="90px" /></center><br />
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="titulo-cupom">Pedido de Venda - <?php echo $_GET['id']?></td>
        </tr>
        <tr>
            <td class="titulo-cupom">JM Água e Gás<br><br></td>
        </tr>
        <tr>
            <td class="descricao">Rua José Bezerra Lins, Dom Helder Camâra Garanhuns/Pernambuco</td>
        </tr>
        <tr>
            <td class="descricao">www.jmaguaegas.app.br</td>
        </tr>
        <tr>
            <td class="descricao">TEL: (87) 98108-7421</td>
        </tr>
    </table>

    <hr>

    
    <p class="titulo-cupom">Pedido</p>
    <br>
    <?php
        echo $dados['descricao'];
    ?>

    <hr>

    <div class="titulo-cupom">ENTREGADOR: <?php echo $dados['entregador'] ?></div>
    <div class="titulo-cupom">NÃO É DOCUMENTO FISCAL</div>

</div>
</body>

<script>
	$(document).ready(function(){
		window.print();
	});
</script>
</html>