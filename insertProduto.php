<?php
        

        class InserirProduto{

            public function inserir($nome, $preco, $estoque){
                include "bd.php";
                
                $sql_insert = "INSERT INTO Produto(nome, preco, estoque) VALUES (:NOME, :PRECO, :ESTOQUE)";

                $stmt = $PDO->prepare($sql_insert);
                
                $stmt->bindParam(':NOME', $nome);
                $stmt->bindParam(':PRECO', $preco);
                $stmt->bindParam(':ESTOQUE', $estoque);

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


