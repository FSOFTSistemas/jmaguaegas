<?php
        

        class InserirUsuario{

            public function inserir($nome, $senha2, $telefone){
                include "bd.php";
                
                $sql_insert = "INSERT INTO usuario(nome, senha, telefone) VALUES (:NOME, :SENHA, :TELEFONE)";

                $stmt = $PDO->prepare($sql_insert);
                
                $stmt->bindParam(':NOME', $nome);
                $stmt->bindParam(':SENHA', $senha2);
                $stmt->bindParam(':TELEFONE', $telefone);

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


