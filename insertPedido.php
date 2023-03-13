    <?php


    class InserirPedido
    {

        public function inserir($descricao)
        {
            require_once 'Conexao.php';
            $status = "Pendente";
            $entregador = " ";
            $timezone = new DateTimeZone('America/Sao_Paulo');
            $data_atual = new DateTime('now', $timezone);
            $data_atual = $data_atual->format('Y-m-d H:i:s');

            $sql_insert = "INSERT INTO Entrega(descricao, status, entregador, data) VALUES (:DESCRICAO, :STATUSS, :ENTREGADOR, :DATA)";

            $stmt = Conexao::getInstance()->prepare($sql_insert);

            $stmt->bindParam(':DESCRICAO', $descricao);
            $stmt->bindParam(':STATUSS', $status);
            $stmt->bindParam(':ENTREGADOR', $entregador);
            $stmt->bindParam(':DATA', $data_atual);

            if ($stmt->execute()) {
                $dados = array("CREATE" => "OK");
                return true; //Cadastrado com sucesso!

            } else {

                $dados = array("CREATE" => "ERRO");
                return false; //Erro ao cadastrar
            }
        }
        //echo json_encode($dados);


    }
    ?>


