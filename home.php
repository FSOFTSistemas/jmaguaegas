<?php
session_start();
if(!isset($_SESSION['id'])){
   header('location: index.php');
   exit;
}

require_once 'Conexao.php';
$id_usu = $_SESSION['id'];
$sql = "SELECT * from usuario where id ='". $_SESSION['id']."' ";
$usu = Conexao::getInstance()->prepare($sql);
$usu->execute();
$dados = $usu->fetch();

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
      <title>JM ÁGUA E GÁS</title>
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

      <style type="text/css">
         .a{
            width: 100%;
            height: 5px;
            background-color: lightgray;
         }

         .botao {
            float: right;
            height: 50px;
            margin: 10px 0;
         }
         .span1{
            visibility: hidden;
         }
         .item{
            font-weight: bold;
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
                           <li><a href="#">INICIO</a></li>
                           <li><a href="cadastro.php">NOVO PEDIDO</a></li>
                           <?php
                              if($dados['nome'] == 'admin'){?>
                                 <li><a href="Produto.php">PRODUTOS</a></li>
                                 <li><a href="Usuario.php">USUÁRIOS</a></li>
                           <?php
                               }
                            ?>
                           <li><a href="vendas.php">CONTROLE DE VENDAS</a></li>
                           <li><a href="pedidos1.php">PEDIDOS</a></li>
                           <li><a href="#">Usuario logado:   <?php echo  $dados['nome'] ?></a></li>
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
                     <div class="logo"><a href="home.html"><img src="images/JM.png" width="180px"></a></div>
                  </div>
               </div>
            </div>
         </div>
         <!-- logo section end -->
         <!-- header section start -->
         <div class="header_section">
            <div class="container">
               <div class="containt_main">
                  <div id="mySidenav" class="sidenav">
                     <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                     <a href="home.php">INICIO</a>
                     <a href="cadastro.php">NOVO PEDIDO</a>
                     <?php
                        if($dados['nome'] == 'admin'){?>
                     <a href="Produto.php">PRODUTOS</a>
                     <a href="Usuario.php">USUARIOS</a>
                     <?php
                                    }
                        ?>
                     <a href="vendas.php">CONTROLE DE VENDAS</a>
                     <a href="pedidos1.php">PEDIDOS</a>
                     <a href="sair.php">Sair</a>
                  </div>
                  <span class="toggle_icon" onclick="openNav()"><img src="images/toggle-icon.png"></span>
                  <div class="dropdown">
                     <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ENTREGADORES
                     </button>
                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php
                           $consulta_entregador = Conexao::getInstance()->prepare("SELECT * FROM Entrega GROUP BY entregador");
                           $consulta_entregador->execute();
                           while ($entregador = $consulta_entregador->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <a class="dropdown-item" href="#"><?php echo $entregador['entregador'];?></a>
                        <?php } ?>
                     </div>
                  </div>
                  <div class="main">
                     <!-- Another variation with a button -->
                     <div class="input-group">
                        <input type="text" class="form-control" placeholder="Pesquisar entrega por descrição">
                        <div class="input-group-append">
                           <button class="btn btn-secondary" type="button" style="background-color: #5F9EA0; border-color:#5F9EA0 ">
                           <i class="fa fa-search"></i>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- header section end -->
         <!-- banner section start -->
         <div class="banner_section layout_padding">
         </div>
         <!-- banner section end -->
      </div>
      <!-- banner bg main end -->
      <!-- fashion section start -->
      <div class="fashion_section">
         <div id="main_slider" class="carousel slide" data-ride="carousel">
            <div class="container">
               <h1 class="fashion_taital">Controle de Pedidos</h1>
               <div class="fashion_section_2">
                  <div class="row">
                     <div class="col-lg-4 col-sm-4">
                        <div class="box_main">
                           <!-- Lista de pedidos section start -->
                           <h1 class="item" style="color: orangered;">Pendentes para entrega</h1>
                              <div class = "a"></div>

                           <!-- Litar pedidos aqui -->
                           <div class="listarpedidos"></div>

                        </div>
                     </div>
                     <?php
                     if($dados['nome'] != 'home'){?>
                        <div class="col-lg-4 col-sm-4">
                        <div class="box_main">
                           <!-- Lista de pedidos section start -->
                           <h1 class="item" style="color: green;">Entregas Recentes</h1>
                           <div class = "a"></div>

                           <!-- Litar pedidos aqui -->
                           <div class="listarrecebidos"></div>
                           </div>
                           </div>
                        <?php
                         }

                       ?>


                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- fashion section end -->
      <!-- jewellery  section start -->
      <div class="jewellery_section">
         <div id="jewellery_main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               <div class="carousel-item active">

               </div>
            </div>
            <div class="loader_main">
               <div class="loader"></div>
            </div>
         </div>
      </div>
      <!-- jewellery  section end -->
      <!-- footer section start -->
      <div class="footer_section layout_padding">
         <div class="container">
            <div class="footer_logo"><center><a href="home.html"><img src="images/JM.png" width="90px" ></a></center></div>
         </div>
      </div>
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <p class="copyright_text">© 2021 All Rights Reserved. Design by <a href="https://f-softsistemas.com.br">FSOFT sistemas</a></p>
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
      <script language="javascript" type="text/javascript">
         function f_mostra() {
            let nome = "<?php echo $dados['nome'] ?>";
            let id = document.querySelector('.span1').textContent;

            $.post("update.php", {
                  id : id,
                  nome : nome

            }, function(msg) {
                     alert('deletado com sucesso !');
                     document.location.reload(true);
            });
         }


         function f_updateDesc(desc) {
            let descricao = document.getElementById('descricao1').value;
            let id = document.querySelector('.span1').textContent;

            $.post("update_pedido.php", {
                  id : id,
                  descricao : descricao
            }, function(msg) {
                  document.location.reload(true);
            });

         }

         function f_deletar() {
            let id = document.querySelector('.span1').textContent;

            $.post("delete.php", {
               id : id
            }, function(msg) {
               document.location.reload(true);
            });

         }
      </script>
      <script type="text/javascript">

         $('#MyModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let id = button.data('id'); // Extraia informações dos atributos data- *
            let descricao = button.data('descricao');
            let modal = $(this);

            modal.find('#descricao1').val(descricao);
            document.querySelector('.span1').innerHTML = id;
         });
      </script>
      <script>
         function reloadListaEntrega() {
            $.ajax({
               url: "lista-pedidos.php",
               success: function(entrega) {
                  $('.listarpedidos').html(entrega);
               },
               error: function() {
                  $('.listarpedidos').html("Pagina não encontrada!");
               }
            });
         }

         function reloadListaRecebido() {
            $.ajax({
               url: "lista-recebidos.php",
               success: function(recebido) {
                  $('.listarrecebidos').html(recebido);
               },
               error: function() {
                  $('.listarrecebidos').html("Pagina não encontrada!");
               }
            });
         }


         setInterval(() => {
            reloadListaEntrega();
            reloadListaRecebido();
         }, 15000);
      </script>
      <script>
         $(document).ready(function() {
            $.post('lista-pedidos.php', function(retorna1) {
               $('.listarpedidos').html(retorna1);
            });
         });

         $(document).ready(function() {
            $.post('lista-recebidos.php', function(retorna2) {
               $('.listarrecebidos').html(retorna2);
            });
         });
      </script>

   </body>
</html>