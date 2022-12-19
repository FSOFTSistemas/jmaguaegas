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

    <title>Kiko - Pedidos</title>

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
                        <div class="logo"><a href="home.php"><img src="images/logo.png"></a></div>
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
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Pesquisar entrega por descrição">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button" style="background-color: #f26522; border-color:#f26522 ">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header section end -->
    </div>

    <!-- header section end -->

    <div class="fashion_section">
        <div class="container">
            <h1 class="fashion_taital">Controle de Pedidos por entregador</h1>
            <?php

            ?>
            <div class="menu_busca">
                <div class="buscar_data">
                    <form method="post" action="pedidos1.php">
                        <label class="lbl" for="dia">Filtrar: </label>
                        <select name="Entregador" id="Entregador">
                            <ul>

                                <?php
                                $sql = "SELECT * FROM usuario";
                                $entregadores = $PDO->prepare($sql);
                                $entregadores->execute();

                                while ($entregador = $entregadores->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <li>
                                        <option id="Entregador" name="Entregador" value="<?php echo $entregador['nome']; ?>"><?php echo $entregador['nome']; ?></option>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </select>
                        <input type="date" id="data1" name="data1"><i> à </i><input type="date" id="data2" name="data2">
                        <input class="btn_filtro btn" type="submit" value="Buscar">
                        <button type="button" class="btn" name="btn_imprimir" id="id" onclick="f_imprimir(imprimir)">Imprimir</button>
                    </form>
                </div>
            </div>
            <div id="imprimir" class="fashion_section_2">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="box_main">

                            <!-- Lista de pedidos section start -->
                            <h2>Entregas</h2>

                            <div class="separador"></div>

                            <ul>
                                <?php
                                if (empty($data1) && empty($data2)) {
                                    $consulta = $PDO->prepare("SELECT * FROM Entrega WHERE entregador <> '' ORDER by entregador LIMIT 50");
                                } else {
                                    $consulta = $PDO->prepare("SELECT * FROM Entrega WHERE DATE(data) between '" . $data1 . "%' AND '" . $data2 . "%' AND entregador = '" . $entregador1 . "' ORDER BY entregador");
                                }
                                $consulta->execute();
                                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <li>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="people-nearby">
                                                        <div class="nearby-user">
                                                            <div class="row">
                                                                <div class="col-md-2 col-sm-2">
                                                                    <img src="images/entrega.png" class="profile-photo-lg">
                                                                </div>
                                                                <div class="col-md-7 col-sm-7">
                                                                    <h5>Pedido - entregador: <?php echo $linha['entregador']; ?> <?php echo date("d-m-Y", strtotime($linha['data'])); ?></h5>
                                                                    <h3 id="descricao"><?php echo $linha['descricao']; ?></h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <div class="separador"></div>

                                <?php } ?>
                            </ul>
                            <b><span>Quantidade de pedidos:
                                    <?php
                                    print($consulta->rowCount());
                                    ?>
                                </span><b>
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
            <div class="footer_logo"><a href="home.php"><img src="images/footer-logo.png"></a></div>
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

</html>
<script language="javascript" type="text/javascript">
    function f_imprimir(imprimir) {
        var conteudo = document.getElementById('imprimir').innerHTML,
            tela_impressao = window.open();

        tela_impressao.document.write('<span style="font-size:10px">' + conteudo + '</spab>');
        tela_impressao.window.print();
    }
</script>