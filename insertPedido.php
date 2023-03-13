    <?php
        

        class InserirPedido{

            public function inserir($descricao, $qtde, $prod, $qtde2, $prod2,  $qtde3, $prod3){
                include "bd.php";
                $status = "Pendente";
                $entregador = " ";
                $timezone = new DateTimeZone('America/Sao_Paulo');
                $data_atual = new DateTime('now', $timezone);
                $data_atual = $data_atual->format('Y-m-d H:i:s');
                
               
                // $query = $PDO->prepare('select * from Produto where id = :id');
                // $query->execute(array(
                //     ':id'   => $prod
                // ));
                // $linha = $query->fetch(PDO::FETCH_ASSOC);
                // $total = parseFloat($linha['preco']) * $qtde;
                

                $sql_insert = "INSERT INTO Entrega(descricao, status, entregador, data, id_produto, qtde) VALUES (:DESCRICAO, :STATUSS, :ENTREGADOR, :DATA, :PROD, :QTDE)";

                $stmt = $PDO->prepare($sql_insert);
                
                $stmt->bindParam(':DESCRICAO', $descricao);
                $stmt->bindParam(':STATUSS', $status);
                $stmt->bindParam(':ENTREGADOR', $entregador);
                $stmt->bindParam(':DATA', $data_atual);
                $stmt->bindParam(':PROD', $prod);
                $stmt->bindParam(':QTDE', $qtde);
                // $stmt->bindParam(':total', $total);

                if($stmt->execute()){
                    
                    $dados = array("CREATE"=> "OK");
                    return true;//Cadastrado com sucesso!

                }else{

                    $dados = array("CREATE"=> "ERRO");
                    return false;//Erro ao cadastrar
                }
            }
        //echo json_encode($dados);

        
    }
    ?>


