<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: index.php');
    exit;
}

require_once 'Conexao.php';

?>

<ul>
    <?php
    $consulta = Conexao::getInstance()->prepare("SELECT * FROM usuario");
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
                                        <h5>Nome</h5>
                                        <h3 id="nome"> <?php echo $linha['nome']; ?></h3>
                                        <h5>Senha</h5>
                                        <h3 id="senha"><?php echo $linha['senha']; ?></h3>
                                        <h5>Telefone</h5>
                                        <h3 id="telefone"><?php echo $linha['telefone']; ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>

        <!-- Modal -->
        <div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="mymodal <?php echo $linha['id']; ?> Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mymodalLabel">Usuario <span class="span1"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="nome1" class="control-label">Nome:</label>
                        <textarea name="nome1" type="text" class="form-control" id="nome1"></textarea>

                        <label for="senha1" class="control-label">Senha:</label>
                        <textarea name="senha1" type="text" class="form-control" id="senha1"></textarea>

                        <label for="telefone1" class="control-label">Telefone:</label>
                        <textarea name="telefone1" type="text" class="form-control" id="telefone1"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary delet" data-dismiss="modal" onclick="f_deletar()">Excluir</button>
                        <button type="button" class="btn btn-secondary" onclick="f_updateUsuario()">Alterar</button>
                        <!-- <button type="button" class="btn btn-primary entreg" onclick="f_mostra()">Confirmar</button> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- fim modal -->
        <div class="a"></div>

    <?php } ?>

</ul>

<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.0.0.min.js"></script>
<script src="js/plugin.js"></script>
<!-- sidebar -->
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/custom.js"></script>

<script type="text/javascript">
    $('#MyModal').on('show.bs.modal', function(event) {
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
    /* function f_mostra() {
        let nome = "<?php echo $dados['nome'] ?>";
        let id = document.querySelector('.span1').textContent;
    
        $.post("update.php", {
            id : id,
            nome : nome

        }, function(msg) {
            alert('Confirmado com sucesso !');
            document.location.reload(true);
        });      
    }
*/

    function f_updateUsuario(nome, senha, telefone) {
        let nome = document.getElementById('nome1').value;
        let senha = document.getElementById('senha1').value;
        let telefone = document.getElementById('telefone1').value;
        let id = document.querySelector('.span1').textContent;

        $.post("update_usuario.php", {
            id: id,
            nome: nome,
            senha: senha,
            telefone: telefone
        }, function(msg) {
            document.location.reload(true);
        });
    }

    function f_deletar() {
        let id = document.querySelector('.span1').textContent;

        $.post("delete_usuario.php", {
            id: id
        }, function(msg) {
            document.location.reload(true);
        })

    }
</script>