<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: index.php');
    exit;
}

require_once 'Conexao.php';
$id_usu = $_SESSION['id'];
$sql = "SELECT * from usuario where id ='" . $_SESSION['id'] . "' ";
$usu = Conexao::getInstance()->prepare($sql);
$usu->execute();
$dados = $usu->fetch();

?>

<ul>
    <?php
    if ($dados['nome'] == 'admin') {
        $consulta = Conexao::getInstance()->prepare("SELECT * FROM Entrega WHERE entregador = '' ");
    } else {
        $consulta = Conexao::getInstance()->prepare("SELECT * FROM Entrega WHERE entregador = '' LIMIT 1 ");
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
                                        <h5>Pedido - <?php echo date("d-m-Y H:i:s", strtotime($linha['data'])); ?></h5>
                                        <h3 id="descricao"><a href="Tel:<?php echo getNumber($linha['descricao']); ?>"> <?php echo $linha['descricao']; ?> </a></h3>
                                    </div>
                                    <button type="button" class="botao btn btn-primary" data-toggle="modal" data-target="#MyModal" data-descricao="<?php echo $linha['descricao']; ?>" data-id="<?php echo $linha['id']; ?>">Entregar</button>
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
                        <h5 class="modal-title" id="mymodalLabel">PEDIDO <span class="span1"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="descricao1" class="control-label">Descrição:</label>
                        <textarea name="descricao1" type="text" class="form-control" id="descricao1"></textarea>
                    </div>
                    <div class="modal-footer">
                        <?php
                        if ($dados['nome'] == 'admin') { ?>
                            <button type="button" class="btn btn-secondary delet" data-dismiss="modal" onclick="f_deletar()">Excluir</button>
                            <button type="button" class="btn btn-secondary" onclick="f_updateDesc()">Alterar</button>
                        <?php
                        }
                        ?>
                        <button type="button" class="btn btn-primary entreg" onclick="f_mostra()">Confirmar</button>
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

<?php
function getNumber($desc)
{
    $text = $desc;
    $matches = array();
    //aqui eu filtro a descricao e pego apenas os numeros
    preg_match_all('/[ ][0-9]{2}[\- ][0-9]{9}|[0-9]{9}/', $text, $matches);
    $matches = $matches[0];
    //aqui retiro todos os espaços
    $telefone = str_replace(" ", "", $matches[0]);
    $tamanho_telefone = strlen($telefone);
    //verificação para saber se foi colocado ddd, caso não tenha cido colocado adiciono 87
    if ($tamanho_telefone == 9) {
        return "+5587" . $telefone;
    } else {
        return "+55" . $telefone;
    }
}
?>


<script type="text/javascript">
    $('#MyModal').on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget);
        let id = button.data('id');
        let descricao = button.data('descricao');

        let modal = $(this);

        modal.find('#descricao1').val(descricao);
        document.querySelector('.span1').innerHTML = id;
    });
</script>
<script language="javascript" type="text/javascript">
    function f_mostra() {
        let nome = "<?php echo $dados['nome'] ?>";
        let id = document.querySelector('.span1').textContent;

        $.post("update.php", {
            id: id,
            nome: nome

        }, function(msg) {
            alert('Confirmado com sucesso !');
            document.location.reload(true);
        });
    }


    function f_updateDesc(desc) {
        let descricao = document.getElementById('descricao1').value;
        let id = document.querySelector('.span1').textContent;

        $.post("update_pedido.php", {
            id: id,
            descricao: descricao
        }, function(msg) {
            document.location.reload(true);
        });
    }

    function f_deletar() {
        let id = document.querySelector('.span1').textContent;

        $.post("delete.php", {
            id: id
        }, function(msg) {
            document.location.reload(true);
        })

    }
</script>