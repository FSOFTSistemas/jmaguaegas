<?php
session_start();

require_once 'insertPedido.php';
$ped = new InserirPedido;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>KIKO ÁGUA/GÁS</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- bootstrap css -->
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
</head>

<body>
   <!-- banner bg main start -->
   <div class="banner_bg_main">
      <!-- header top section start -->
      <div class="container">
         <div class="header_section_top">
            <div class="row">
               <div class="col-sm-12">
                  <div class="custom_menu">
                     <ul>
                        <li><a href="home.php">INICIO</a></li>
                        <li><a href="pedidos1.php">PEDIDOS</a></li>
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
      <div class="header_section">
         <div class="container" style="padding-bottom: 20px;">
            <div class="containt_main">
               <div id="mySidenav" class="sidenav">
                  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                  <a href="home.php">INICIO</a>
                  <a href="pedidos1.php">PEDIDOS</a>
                  <a href="sair.php">Sair</a>
               </div>
               <span class="toggle_icon" onclick="openNav()"><img src="images/toggle-icon.png"></span>
               <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ENTREGADORES
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                     <a class="dropdown-item" href="#">LUCAS</a>
                     <a class="dropdown-item" href="#">JHON</a>
                     <a class="dropdown-item" href="#">NATAHAN</a>
                     <a class="dropdown-item" href="#">JOSE</a>
                     <a class="dropdown-item" href="#">FABIO</a>
                     <a class="dropdown-item" href="#">KAKA</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- header section end -->

   </div>
   <!-- banner bg main end -->
   <!-- fashion section start -->
   <div class="fashion_section">
      <div id="main_slider" class="carousel slide" data-ride="carousel">
         <div class="container">
            <h1 class="fashion_taital">Cadastro de Pedido</h1>
            <div class="fashion_section_2">
               <div class="container">
                  <h2>Pedido</h2>
                  <!-- <form action="/action_page.php">
                     <input type="checkbox" id="agua" name="agua" value="agua">
                     <label for="vehicle1"> Água</label><br>
                     <input type="checkbox" id="agranel" name="agranel" value="agranel">
                     <label for="vehicle2"> Agranel</label><br>
                     <input type="checkbox" id="gas" name="gas" value="gas">
                     <label for="vehicle3"> Gás</label><br><br>
                  </form> -->
                  <form method="POST">
                     <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea type="text" class="form-control" name="descricao" id="descricao" placeholder="Digite aqui o pedido" name="descricao"></textarea>
                     </div>
                     <button type="submit" class=" enviar btn btn-primary">
                        Enviar
                     </button>
                     <?php
                     if (isset($_POST['descricao'])) {
                        $desc = addslashes($_POST['descricao']);

                        if (!empty($desc)) {
                           if ($ped->inserir($desc)) {
                              echo "<strong><font color=\"#008000\">Pedido Inserido com sucesso !</strong>";
                              //header('Location: cadastro.php');
                           } else {
                              echo "Erro ao inserir.";
                           }
                        } else {
                           echo "<b><font color=\"#FF0000\">Preencha a descricao</b>";
                        }
                     }
                     ?>
                  </form>

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
         <p class="copyright_text">© 2021 All Rights Reserved. Design by <a href="https://html.design">FSOFT Sistmas.</a></p>
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
         window.location.href = 'index.html';
      }
   </script>

</body>

</html>