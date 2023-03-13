<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: index.php');
    exit;
}

include "bd.php";
$id_usu = $_SESSION['id'];
$sql = "SELECT * FROM usuario WHERE id ='" . $_SESSION['id'] . "' ";
$usu = $PDO->prepare($sql);
$usu->execute();
$dados = $usu->fetch();

if(isset( $_POST['data1'])){
    $data1 = $_POST['data1'];
    $data2 = $_POST['data2'];
}
if(isset($_POST['Entregador'])){
    $entregador1 = $_POST['Entregador'];
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="F-SOFT">

    <title>JM ÁGUA E GÁS - Vendas</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--  -->
    <!-- owl stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesoeet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <link rel="stylesheet" type="text/css" href="css/style-pedidos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- banner bg main start -->
    <div class="banner_bg_main">
        <div class="container">
            <div class="header_section_top">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="custom_menu">
                            <ul>
                                <li><a href="home.php">INICIO</a></li>
                                <li><a href="cadastro.php">CADASTRAR PEDIDO</a></li>
                                <li><a href="sair.php">Sair</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header top section start -->
        <!-- logo section start -->
        <div class="logo_section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="logo"><a href="home.php"><img src="images/JM.png" width="180px"></a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- logo section end -->
        <!-- header section start -->
        <div class="busca header_section">
            <div class="container">
                <div class="containt_main">
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <a href="home.php">INICIO</a>
                        <a href="cadastro.php">CADASTRAR PEDIDOS</a>
                        <a href="sair.php">Sair</a>
                    </div>
                    <span class="toggle_icon" onclick="openNav()"><img src="images/toggle-icon.png"></span>
                    <div class="main">
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- header section end -->
    </div>

    <!-- header section end -->

    <div class="fashion_section">
        <div class="container">

            <div id="imprimir" class="fashion_section_2">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="box_main">
                            
                            <!--Inicio de filtros-->
                            <h4 style="font-weight: bold; text-align: center">Filtros</h4>
                            <form  method="post" action="vendas.php">
                                <h6>Usuário</h6>
                               <select class="form-select form-select-lg" name="Entregador" id="Entregador">
                                 <option value="<?php echo $dados['nome']; ?>"><?php echo $dados['nome']; ?></option>
                                 <?php 
                                    if($dados['nome'] == 'admin'){
                                        $consulta = "SELECT * FROM usuario";
                                        $usu = $PDO->prepare($consulta);
                                        $usu->execute();
                                        
                                        while($usuarios = $usu->fetch()){
                                        
                                ?><option value="<?php echo $usuarios['nome']; ?>"><?php echo $usuarios['nome']; ?></option>
                                <?php
                                        }
                                    }
                                 ?>
                               </select>
                               <!--Data inicio-->
                               <label>Selecione as datas</label>
                               <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Data início</span>
                                    <input type="date" value="<?php echo $Date; ?>" class="form-control" id="data1" name="data1">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Data fim</span>
                                    <input type="date" class="form-control" id="data2" name="data2">
                                </div>

                               <!--Data fIm-->
                               <button type="submit" class="btn btn-primary" style="width:100%">Filtrar</button>
                              </form> 
                              
                              </br>
                              </br>
                              <div class="separador"></div>
                            <!--Fim de filtros-->
                            
                            <h2>Vendas</h2>
                              
                            <div class="separador"></div>

                            <ul>
                                <?php
                                if (empty($data1) && empty($data2)) {
                                    $consulta = $PDO->prepare("SELECT * FROM Entrega WHERE entregador <> '' and data = NOW() and status <> 'Excluido' ORDER by id desc");
                                } else {
                                    $consulta = $PDO->prepare("SELECT * FROM Entrega WHERE DATE(data) between '" . $data1 . "%' AND '" . $data2 . "%' AND entregador = '" . $entregador1 . "' and status <> 'Excluido' ORDER BY id desc");
                                }
                                $consulta->execute();
                                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                    $temp = $linha['id_produto'];
                                    $prod = $PDO->query("SELECT nome,preco FROM Produto where id = $temp");
                                    $prod->execute();
                                    $prod = $prod->fetch();
                                    
                                ?>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-9 col-sm-11">
                                                <h6>Pedido - entregador: <?php echo $linha['entregador']; ?> <?php echo date("d-m-Y", strtotime($linha['data'])); ?></h6>
                                                <h4 id="produto" style="font-weight: bold;"><?php echo $linha['qtde']; ?> - <?php echo $prod['nome']; ?> : <?php echo number_format(($linha['qtde'] *$prod['preco']),2,",","."); ?></h4>
                                                <h3 id="descricao"><?php echo $linha['descricao']; ?></h3>
                                            </div>
                                             <div class="col-md-3 col-sm-3" >
                                                <br>
                                                <a class="btn btn-secondary" style="color:white; width:100%;" target="_blank" href="cupom.php?id=<?php echo $linha['id'] ?>">Imprimir</a>
                                            </div>
                                        </div>
                                    </li>
                                     <br>
                                    <div class="separador"></div>

                                <?php } ?>
                            </ul>
                            <div class="separador"></div>
                            <div class="separador"></div>
                            <div class="separador"></div>
                            <div class="separador"></div>
                            <div class="separador"></div>
                            <b>
                                <span>
                                    Quantidade de pedidos: <?php print($consulta->rowCount());?>
                                </span>
                                <span>
                                    <h4>Resumo de vendas</h4>
                                    </br></br>
                                    <?php
                                    if (empty($data1) && empty($data2)) {
                                        $sql = $PDO->prepare("SELECT e.id_produto, p.nome, p.preco, sum(e.qtde) as qtde, (p.preco * sum(e.qtde)) as total FROM Entrega e inner join Produto p on p.id = e.id_produto WHERE DATE(e.data) = NOW() and e.entregador <> '' and status <> 'Excluido' group by e.id_produto;");
                                    } else {
                                        $sql = $PDO->prepare("SELECT e.id_produto, p.nome, p.preco, sum(e.qtde) as qtde, (p.preco * sum(e.qtde)) as total FROM Entrega e inner join Produto p on p.id = e.id_produto WHERE DATE(e.data) between '" . $data1 . "%' AND '" . $data2 . "%' AND entregador = '" . $entregador1 . "' and status <> 'Excluido' group by e.id_produto;");
                                    }
                                    $sql->execute();
                                    ?>
                                    <table class="table">
                                      <thead>
                                        <tr>
                                          <th scope="col" style="width:50%;">Produto</th>
                                          <th scope="col" style="width:15%;">QTDE</th>
                                          <th scope="col" style="width:15%;">Valor</th>
                                          <th scope="col" style="width:15%;">Total</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php 
                                            $tot = 0;
                                            while ($linha = $sql->fetch(PDO::FETCH_ASSOC)) {
                                            $tot += $linha['total'];
                                        ?>
                                        <tr>
                                          <th scope="row"><?php echo $linha['nome']; ?></th>
                                          <td><?php echo $linha['qtde']; ?></td>
                                          <td><?php echo number_format($linha['preco'],2,",","."); ?></td>
                                          <td><?php echo number_format($linha['total'],2,",","."); ?></td>
                                        </tr>
                                        <?php } ?>
                                      </tbody>
                                      <tfoot>
                                        <tr>
                                          <td>TOTAL</td>
                                          <td></td>
                                          <td></td>
                                          <td><?php echo number_format($tot,2,",","."); ?></td>
                                        </tr>
                                      </tfoot>
                                    </table>
                                </span>
                            <b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- fashion section end -->
    <!-- footer section start -->
    <div class="footer_section layout_padding">
        <div class="container">
            <div class="footer_logo"><a href="home.php"><img src="images/JM.png" width="90px"></a></div>
        </div>
    </div>

    <!-- footer section end -->
    <!-- copyright section start -->
    <div class="copyright_section">
        <div class="container">
            <p class="copyright_text">© 2021 All Rights Reserved. Design by<a href="https://f-softsistemas.com.br">FSOFT sistemas</a></p>
        </div>
    </div>

    <!-- copyright section end -->
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
    <script>
        function atualiza() {
            window.location.href = 'home.html';
        }
    </script>

</body>
<script language="javascript" type="text/javascript">
    function f_imprimir(imprimir) {
        var conteudo = document.getElementById('imprimir').innerHTML,
            tela_impressao = window.open();

        tela_impressao.document.write('<span style="font-size:10px">' + conteudo + '</spab>');
        tela_impressao.window.print();
    }
</script>

</html>

