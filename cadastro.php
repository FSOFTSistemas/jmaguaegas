<?php
session_start();

include "bd.php";
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
   <link  rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"  crossorigin="anonymous">
   
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
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
                  <div class="logo"><a href="home.php"><img src="images/JM.png" width="180px"></a></div>
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
                  <form method="POST">
                      
                      <div class="form-group">
                          <label for="sel1" class="form-label">Produto</label>
                            <select class="form-select" id="prod" name="prod">
                              <option selected>Selecione o produto</option>
                              
                              <?php
                                $consulta = $PDO->query("SELECT * FROM Produto;");
                                
                                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
                                      <option value="<?php echo $linha['id']; ?>" name="prod" id="prod"><?php echo $linha['nome']; ?></option> 
                             <?php } ?>
                            </select>
                            <br>
                    </div>
                   <div class="form-group">
                      <label for="usr">Quantidade:</label>
                      <input type="number" class="form-control" id="qtde" name="qtde">
                    </div>
                    <hr/>
                    <!--Produto 2-->
                    <div class="form-group">
                    <div hidden="hidden" id="produto2">
                    <label for="sel1"  class="form-label">Produto 2</label>
                      <select  class="form-select" id="prod2"  name="prod2">
                              <option selected>Selecione o produto</option>
                              
                              <?php
                                $consulta = $PDO->query("SELECT * FROM Produto;");
                                
                                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
                                      <option value="<?php echo $linha['id']; ?>" name="prod2" id="prod2"><?php echo $linha['nome']; ?></option> 
                             <?php } ?>
                            </select>
                            <br>
                       <div class="form-group">
                          <label for="usr"  >Quantidade:</label>
                          <input type="number"  class="form-control" id="qtde2" name="qtde2">
                        </div> 
                    </div>
                    <!--Produto 2-->
                   
                    <!--Produto 3-->
                    <div hidden="hidden" id="produto3">
                    <hr/>
                    <div class="form-group">
                        <label for="sel1"  class="form-label">Produto 3</label>
                      <select  class="form-select" id="prod3"  name="prod3">
                              <option selected>Selecione o produto</option>
                              
                              <?php
                                $consulta = $PDO->query("SELECT * FROM Produto;");
                                
                                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
                                      <option value="<?php echo $linha['id']; ?>" name="prod3" id="prod3"><?php echo $linha['nome']; ?></option> 
                             <?php } ?>
                            </select>
                            <br>
                    </div>
                   <div class="form-group">
                      <label for="usr"  >Quantidade:</label>
                      <input type="number"  class="form-control" id="qtde3" name="qtde3">
                    </div> 
                    </div>
                    <!--Produto 3-->
                    <button type="button" class="btn btn-success" onclick="toggle(this)">+</button><br><br>
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
                        $qtde = addslashes($_POST['qtde']);
                        $prod = addslashes($_POST['prod']);
                        $qtde2 = addslashes($_POST['qtde2']);
                        $prod2 = addslashes($_POST['prod2']);
                        $qtde3 = addslashes($_POST['qtde3']);
                        $prod3 = addslashes($_POST['prod3']);

                        if (!empty($desc)) {
                           if ($ped->inserir($desc, $qtde, $prod, $qtde2, $prod2,  $qtde3, $prod3)) {
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
         <div class="footer_logo"><a href="home.php"><img src="images/JM.png" width="90px"></a></div>
      </div>
   </div>
   <!-- footer section end -->
   <!-- copyright section start -->
   <div class="copyright_section">
      <div class="container">
         <p class="copyright_text">© 2021 All Rights Reserved. Design by <a href="https://f-softsistemas.com.br/">FSOFT Sistemas.</a></p>
      </div>
   </div>
   <!-- copyright section end -->
   <!-- Javascript files-->
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
   <script src="js/jquery-3.0.0.min.js"></script>
   <script src="js/plugin.js"></script>
   <script  src="https://code.jquery.com/jquery-3.3.1.slim.min.js"  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"  crossorigin="anonymous"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"  integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"  crossorigin="anonymous"></script>
<script  src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"  integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"  crossorigin="anonymous"></script>
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
  <script>
  let toggle = button => {
    let element = document.getElementById("produto2");
    let hidden = element.getAttribute("hidden");

    if (hidden) {
       element.removeAttribute("hidden");
    } else {
       let element3 = document.getElementById("produto3");
       let hidden3 = element.getAttribute("hidden");
       
       element3.removeAttribute("hidden");
    }
  }
</script>

</body>

</html>