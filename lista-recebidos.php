<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: index.php');
    exit;
}

require_once 'Conexao.php';
$id_usu = $_SESSION['id'];
$sql = "SELECT * FROM usuario WHERE id ='" . $_SESSION['id'] . "' ";
$usu = Conexao::getInstance()->prepare($sql);
$usu->execute();
$dados = $usu->fetch();

?>

<ul>
    <?php
    $timezone = new DateTimeZone('America/Sao_Paulo');
    $data_atual = new DateTime('now', $timezone);
    $data_atual = $data_atual->format('Y-m-d');

    if ($dados['nome'] == 'admin' || $dados['nome'] == 'kiko') {
        $consulta = Conexao::getInstance()->prepare("SELECT * FROM Entrega WHERE DATE(data) LIKE '" . $data_atual . "%' AND entregador <> '' AND status <> 'Excluido' ORDER BY id DESC");
    } else {
        $consulta = Conexao::getInstance()->prepare("SELECT * from Entrega WHERE DATE(data) LIKE '" . $data_atual . "%' AND entregador LIKE '" . $dados['nome'] . "' AND status <> 'Excluido' ORDER BY id DESC");
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
                                        <h6 style="color: black; font-weight: bold; text-align: center;">Pedido: <?php echo $linha['numpedido'] ?></h6>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <h5 style="color: black; font-weight: bold;">ENTREGADOR:
                                            <?php echo "<span style='color:green; 'font-weight: bold;>" . $linha['entregador'] . "</span>" ?>
                                            <?php echo "<span style='color:rgb(134, 130, 130); 'font-weight: bold;>" . date("d-m-Y H:i:s", strtotime($linha['data']));
                                            "</span>" ?></h5>
                                        <h3><a href="Tel:<?php echo getNumber($linha['descricao']); ?>"><?php echo $linha['descricao'] ?></a></h3>
                                        <!--<button type="button" class="btn" name="btn_excluir" id="id" onclick="f_excluir(<?php echo $linha['id'] ?>)">Excluir</button>-->
                                        <?php
                                        if ($dados['nome'] == 'admin') { ?>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#MyModal2<?php echo $linha['id'] ?>">
                                                Exluir</button>
                                        <?php
                                        }

                                        ?>
                                        <!-- Modal -->
                                        <div class="modal fade" id="MyModal2<?php echo $linha['id'] ?>" role="dialog" aria-labelledby="mymodal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Pedido</h5>
                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Tem Certeza que Deseja Excluir Esse Pedido ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><br></br>
                                                        <button type="button" class="btn btn-primary" name="btn_excluir" id="id" onclick="f_excluir(<?php echo $linha['id'] ?>)">Sim, Desejo Excluir!</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </li>

        <div class="a"></div>

    <?php } ?>
</ul>

<b>
    <span>Quantidade de pedidos:
        <?php
        print($consulta->rowCount());
        ?>
    </span>
    <b>

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
        <script language="javascript" type="text/javascript">
            function f_excluir(id) {
                $.post("excluir_entrega.php", {
                    id: id
                }, function(msg) {
                    document.location.reload(true);
                })

            }
        </script>