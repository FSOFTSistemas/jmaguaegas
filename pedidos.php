<?php
session_start();
if(!isset($_SESSION['id'])){
   header('location: index.php');
   exit;
}

include "bd.php";
$id_usu = $_SESSION['id'];
$sql = "SELECT * from usuario where id ='". $_SESSION['id']."' ";
$usu = $PDO->prepare($sql);
$usu->execute();
$dados = $usu->fetch();

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

   <style type="text/css">
      .titulo{
         margin: 0;
         position: absolute;
         left: 50%;
         margin-right: -50%;
         transform: translate(-50%, -50%) 
      }
      .item{
         font-weight: bold;
         color: green;
      }
      .a{
            width: 100%;
            height: 5px;
            background-color: lightgray;
         }
      .b{
         width: 100%;
         height: 2px;
         background-color: lightgray;
      }
   </style>

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
                  <div class="logo"><a href="home.html"><img src="images/logo.png"></a></div>
               </div>
            </div>
         </div>
      </div>
      
      <!-- header top section start -->
      <!-- header section start -->
      <div class="header_section">
         <div class="container">
            <div class="containt_main">
               <div id="mySidenav" class="sidenav">
                  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                  <a href="/home.php">INICIO</a>
                  <a href="#">CADASTRAR PEDIDO</a>
                  <a href="#">PEDIDOS</a>
               </div>
               <span class="toggle_icon" onclick="openNav()"><img src="images/toggle-icon.png"></span>
               <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ENTREGADORES</button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <ul>
                     <?php
                        $consulta_entregador = $PDO->prepare("SELECT * FROM Entrega GROUP by entregador");
                        $consulta_entregador->execute();
                        while ($entregador= $consulta_entregador->fetch(PDO::FETCH_ASSOC)) { 
                     ?>
                     <li><a class="dropdown-item" href="#"><?php echo $entregador['entregador'];?></a></li>
                     <?php } ?>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

    <!-- header section end -->
    
   <div class="container">
   <div class="fashion_section_2">
      <div class="row">
      
         <div class="col-lg-12 col-sm-12">
         
            <div class="box_main">
               <!-- Lista de pedidos section start -->
            
                    <ul>
                        <?php 
                        if($dados['nome'] == 'admin'){
                            $consulta = $PDO->prepare("SELECT entregador FROM Entrega GROUP by entregador");
                        }else{
                           $consulta = $PDO->prepare("SELECT entregador FROM Entrega where entregador like '".$dados['nome']."'");
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
                                                        <div class="col-md-7 col-sm-7">
                                                            <h2 class="item">Entregador: <?php echo "<span style='color:orange;'> ".$linha['entregador']."</span>"; ?></h2>
                                                            <div class="a"></div>
                                                            
                                                        </div>
                                                        <ul>
                                                               <?php 
                                                               if($linha['entregador'] == 'admin'){
                                                                  $consulta1 = $PDO->prepare("SELECT * FROM Entrega where entregador <> '' ");
                                                               }else{
                                                                  $consulta1 = $PDO->prepare("SELECT * FROM Entrega where entregador like '".$linha['entregador']."' ");
                                                               }
                                                               
                                                               $consulta1->execute();
                                                               while ($linha1 = $consulta1->fetch(PDO::FETCH_ASSOC)) 
                                                                  { ?>
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
                                                                                          <h3 id="descricao"><?php echo $linha1['descricao']; ?></h3>
                                                                                    </div>
                                                                                 </div>
                                                                              </div>
                                                                           </div>
                                                                        </div>
                                                                     </div>
                                                                  </div>
                                                               </li>
                                                               <div class="b"></div>
                                                           <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>                    
                        <?php } ?>      
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
   
    <!-- fashion section end -->

  
      <!-- footer section start -->
      <div class="footer_section layout_padding">
         <div class="container">
            <div class="footer_logo"><a href="home.html"><img src="images/footer-logo.png"></a></div>
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