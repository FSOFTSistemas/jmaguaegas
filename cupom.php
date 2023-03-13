<?php 
    include "bd.php"; 
    $sql = "SELECT * FROM Entrega WHERE id ='" . $_GET['id'] . "' ";
    $usu = $PDO->prepare($sql);
    $usu->execute();
    $dados = $usu->fetch();
    
    $sqlProd = "SELECT * FROM Produto where id = ".$dados['id_produto'];
    $usu = $PDO->prepare($sqlProd);
    $usu->execute();
    $produto = $usu->fetch();
?>

<html>
<head>
  <meta charset="utf-8">
  <title>Cupom #<?php echo $_GET['id'] ?></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <link rel="stylesheet" href="cupom.css" type="text/css" />
  <style>
    /*@media print { #noprint { display:none; }	}*/
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
    
    <table style="width: 100%">
        <thead>
            <th style="font-size:small; width: 40%; text-align:left">Produto</th>
            <th style="font-size:small; width: 20%; text-align:center ">Qtde</th>
            <th style="font-size:small; width: 20%; text-align:center ">Unit.</th>
            <th style="font-size:small; width: 20%; text-align:center">Total</th>
        </thead>
        <tbody>
            <td style="font-size:small"><?php echo $produto['nome']; ?></td>
            <td style="font-size:small; text-align:center"><?php echo number_format($dados['qtde'],2); ?></td>
            <td style="font-size:small; text-align:center"><?php echo number_format($produto['preco'],2); ?></td>
            <td style="font-size:small; text-align:center"><?php echo number_format($produto['preco'] * $dados['qtde'],2); ?></td>
        </tbody>
    </table>
    <br><br>
    <hr>
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