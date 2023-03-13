<?php
session_start();
require_once 'Conexao.php';
require_once 'insertUsuario.php';
$ped = new InserirUsuario;
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
                        <li><a href="Usuario.php">Usuario</a></li>
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
                  <a href="listar_usuario.php">Usuarios</a>
                  <a href="sair.php">Sair</a>
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
            <h1 class="fashion_taital">Cadastro de Usuario</h1>
            <div class="fashion_section_2">
               <div class="container">
                  <h2>Usuario</h2>
                  <form method="POST">
                     <div class="form-group">
                        <label for="nome">Nome</label>
                        <textarea type="text" class="form-control" name="nome" id="nome" placeholder="Digite aqui o Nome do Usuario" name="nome"></textarea>

                        <label for="senha">Senha</label>
                        <textarea type="text" class="form-control" name="senha" id="senha" placeholder="Digite aqui a Senha do Usuario" name="senha"></textarea>

                        <label for="telefone">Telefone</label>
                        <textarea type="text" class="form-control" name="telefone" id="telefone" placeholder="Digite aqui o Telefone do Usuario" name="telefone"></textarea>
                     </div>
                     <button type="submit" class=" enviar btn btn-primary">
                        Enviar
                     </button>
                     <?php
                     if (isset($_POST['nome'])) {
                        $nome = addslashes($_POST['nome']);
                        $senha2 = addslashes($_POST['senha']);
                        $telefone = addslashes($_POST['telefone']);

                        if (!empty($nome) || !empty($senha2) || !empty($telefone)) {
                           if ($ped->inserir($nome, $senha2, $telefone)) {
                              echo "<strong><font color=\"#008000\">Usuario Inserido com Sucesso !</strong>";
                              //header('Location: cadastro.php');
                           } else {
                              echo "Erro ao Cadastrar Usuario.";
                           }
                        } else {
                           echo "<b><font color=\"#FF0000\">Preencha as descricao</b>";
                        }
                     }
                     ?>
                  </form>

               </div>

            </div>
         </div>
      </div>
   </div>

   <div class="fashion_section">
      <div id="main_slider" class="carousel slide" data-ride="carousel">
         <div class="container">
            <h1 class="fashion_taital">Usuarios Cadastrado</h1>
            <div class="fashion_section_2">
               <div class="row">
                  <div class="col-lg-12 col-sm-12">
                     <div class="box_main">
                        <!-- Lista de pedidos section start -->
                        <h1 class="item" style="color: orangered;">Usuarios</h1>
                        <div class="a"></div>

                        <table class="table">
                           <thead>
                              <tr>
                                 <th scope="col">Id</th>
                                 <th scope="col">Usuario</th>
                                 <th scope="col">Senha</th>
                                 <th scope="col">Telefone</th>
                                 <th scope="row">Ações</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $consulta = $PDO->prepare("SELECT * FROM usuario");
                              $consulta->execute();

                              while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {

                              ?>

                                 <tr>
                                    <div class="container">
                                       <div class="row">
                                          <div class="col-md-8">
                                             <div class="people-nearby">
                                                <div class="nearby-user">
                                                   <div class="row">
                                                      <div class="col-lg-12 col-sm-12">
                                                         <td id="id"> <?php echo $linha['id']; ?></td>

                                                         <td id="nome"> <?php echo $linha['nome']; ?></td>

                                                         <td id="senha"><?php echo $linha['senha']; ?></td>

                                                         <td id="telefone"><?php echo $linha['telefone']; ?></td>

                                                         <td>
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#MyModal2" data-whateverid="<?php echo $linha['id']; ?>" data-whatevernome="<?php echo $linha['nome']; ?>">
                                                               Exluir</button>
                                                            <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#exampleModal" data-whateverid="<?php echo $linha['id']; ?>" data-whatevernome="<?php echo $linha['nome']; ?>" data-whateversenha="<?php echo $linha['senha']; ?>" data-whatevertelefone="<?php echo $linha['telefone']; ?>">
                                                               Alterar</button>
                                                         </td>

                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </tr>
                           </tbody>
                        <?php } ?>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Modal -->
   <div class="modal fade" id="MyModal2" role="dialog" aria-labelledby="mymodal" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Excluir Usuario</h5>
               <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form method="POST" action="excluir_usuario.php" enctype="multipart/form-data">
                  <div class="form-group">
                     <label for="recipient-nome" class="control-label">Nome:</label>
                     <input name="nome" type="text" class="form-control" id="recipient-nome">
                  </div>
                  <input name="id" type="hidden" id="id_usuario">
                  <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><br></br>
                     <button type="submit" class="btn btn-primary" name="btn_excluir">Sim, Desejo Excluir!</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

   </table>

   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Usuario</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form method="POST" action="update_usuario.php" enctype="multipart/form-data">
                  <div class="form-group">
                     <label for="recipient-nome" class="control-label">Nome:</label>
                     <input name="nome" type="text" class="form-control" id="recipient-nome">
                  </div>
                  <div class="form-group">
                     <label for="recipient-senha" class="control-label">Senha:</label>
                     <input name="senha" type="text" class="form-control" id="recipient-senha">
                  </div>
                  <div class="form-group">
                     <label for="recipient-telefone" class="control-label">Telefone:</label>
                     <input name="telefone" type="text" class="form-control" id="recipient-telefone">
                  </div>
                  <input name="id" type="hidden" id="id_usuario">
                  <div class="modal-footer">
                     <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                     <button type="submit" class="btn btn-danger">Alterar</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

   <!-- fashion section end  action="update_usuario.php" enctype="multipart/form-data" -->
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
         <p class="copyright_text">© 2021 All Rights Reserved. Design by <a href="https://html.design">FSOFT Sistemas.</a></p>
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


   <script type="text/javascript">
      $('#MyModal2').on('show.bs.modal', function(event) {
         var button = $(event.relatedTarget) // Button that triggered the modal
         var recipientid = button.data('whateverid')
         var recipientnome = button.data('whatevernome')


         var modal = $(this)
         modal.find('.modal-title').text('Usuario ' + recipientnome)
         modal.find('#id_usuario').val(recipientid)
         modal.find('#recipient-nome').val(recipientnome)
      })
   </script>




   <script type="text/javascript">
      $('#exampleModal').on('show.bs.modal', function(event) {
         var button = $(event.relatedTarget) // Button that triggered the modal
         var recipientid = button.data('whateverid')
         var recipientnome = button.data('whatevernome')
         var recipientsenha = button.data('whateversenha')
         var recipienttelefone = button.data('whatevertelefone')

         var modal = $(this)
         modal.find('.modal-title').text('Usuario ' + recipientnome)
         modal.find('#id_usuario').val(recipientid)
         modal.find('#recipient-nome').val(recipientnome)
         modal.find('#recipient-senha').val(recipientsenha)
         modal.find('#recipient-telefone').val(recipienttelefone)
      })
   </script>
   <!--
<script>
         function reloadListaProduto() {
            $.ajax({
               url: "listar_produto.php",
               success: function(produto) {
                  $('.listarproduto').html(produto);
               },
               error: function() {
                  $('.listarproduto').html("Pagina não encontrada!");
               }
            });
         }

         setInterval(() => {
            reloadListaProduto();
         }, 15000);
      </script>
      <script>
         $(document).ready(function() {
            $.post('listar_produto.php', function(retorna1) {
               $('.listarproduto').html(retorna1);
            });
         });
      </script>
      -->
   <script type="text/javascript">
      $('#MyModal123').on('show.bs.modal', function(event) {
         let button = $(event.relatedTarget);
         let id = button.data('id');
         let nome = button.data('nome');
         let senha = button.data('senha');
         let telefone = button.data('telefone');

         let modal = $(this);

         modal.find('#nome1').val(nome);
         modal.find('#senha1').val(senha);
         modal.find('#telefone1').val(telefone);
         document.querySelector('.span1').innerHTML = id;
      });
   </script>
   <script language="javascript" type="text/javascript">
      function f_mostra() {
         let nome = "<?php echo $dados['nome'] ?>";
         let senha = "<?php echo $dados['senha'] ?>";
         let telefone = "<?php echo $dados['telefone'] ?>";
         let id = document.querySelector('.span1').textContent;

         $.post("update_usuario.php", {
            id: id,
            nome: nome,
            senha: senha,
            telefone: telefone

         }, function(msg) {
            alert('Confirmado com sucesso !');
            document.location.reload(true);
         });
      }

      function f_updateUsuario(id, nome, senha, telefone) {
         let id = document.getElementById('recipient-id').value;
         let nome = document.getElementById('recipient-nome').value;
         let senha = document.getElementById('recipient-senha').value;
         let telefone = document.getElementById('recipient-telefone').value;


         $.post("update_usuario.php", {
            id: id,
            nome: nome,
            senha: senha,
            telefone: telefone
         }, function(msg) {
            document.location.reload(true);
         });
      }
   </script>
   <script language="javascript" type="text/javascript">
      function f_excluir(id) {
         $.post("excluir_usuario.php", {
            id: id
         }, function(msg) {
            document.location.reload(true);
         })

      }
   </script>

</body>

</html>