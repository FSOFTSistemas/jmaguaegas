<?php
require_once 'Conexao.php';
class Logar
{

    public function efetuar_login($usuario, $senha)
    {
        $pdo = Conexao::getInstance();
        $sql = $pdo->prepare('SELECT * from usuario WHERE nome = :nome and senha = :senha');
        $sql->bindValue(':nome', $usuario);
        $sql->bindValue(':senha', $senha);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id'] = $dado['id'];
            return true; //usuario logado com sucesso;
        } else {
            return false; //erro ao logar;
        }
    }
}
