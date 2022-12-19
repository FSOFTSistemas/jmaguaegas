<?php 
    require_once "cbd.php";
    date_default_timezone_set('America/Sao_Paulo');

    class ListarPedidos {

        private const CONSULTA_ENTREGADOR_VAZIO = "SELECT * FROM Entrega WHERE entregador = '' ";
        private const CONSULTA_ENTREGADOR_ADMIN = "SELECT * FROM Entrega WHERE entregador <> '' ORDER BY id DESC";
        private const CONSULTA_ENTREGADOR_NOME = "SELECT * FROM Entrega WHERE entregador LIKE '";

        public function listarTodosPedidos() {
            try {
                $PDO = ConexaoBancoDados::conexao();
                $consulta = $PDO->prepare(self::CONSULTA_ENTREGADOR_VAZIO);
                $consulta->execute();

                while($resultado = $consulta->fetchAll(PDO::FETCH_ASSOC)) {
                    if(strtotime('+20 minutes', strtotime($resultado['data'])) > strtotime(date('Y-m-d H:i:s'))) {
                        echo "entrou na condicao: <br>";
                        var_dump($resultado);
                    } 
                    $lista = $resultado;
                }
                
                return $lista;

            } catch(PDOException $e) {
                echo 'Error: '.$e->getMessage();
            }
        }

        public function listarTudosPedidosEntregues($dados) {
            try {
                $PDO = ConexaoBancoDados::conexao();

                if($dados['nome'] == 'admin') {
                    $consulta = $PDO->prepare(self::CONSULTA_ENTREGADOR_ADMIN);
                } else {
                    $consulta = $PDO->prepare(self::CONSULTA_ENTREGADOR_NOME .$dados['nome']."' ORDER BY id DESC");
                }
                $consulta->execute();
                
                return $consulta->fetchAll(PDO::FETCH_ASSOC);

            } catch(PDException $e) {
                echo 'Error: '.$e->getMessage();
            }  

        }
    }

    $obj = new ListarPedidos();
    $dados = ["nome" => "admin"];

    $exemplo = $obj->listarTodosPedidos();
    var_dump($exemplo);
    
    


?>