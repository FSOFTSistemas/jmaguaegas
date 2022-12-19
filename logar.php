<?php 

class Logar{

    public function efetuar_login($usuario, $senha){
        $usu_bd = "u114975982_kikogasbd";
        $senha_bd = "Benicio01";
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=u114975982_kikogasbd', $usu_bd, $senha_bd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare('SELECT * from usuario WHERE nome = :nome and senha = :senha');
        $sql->bindValue(':nome', $usuario);
        $sql->bindValue(':senha', $senha);
        $sql->execute();

        if($sql->rowCount() > 0){
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id'] = $dado['id'];
            return true;//usuario logado com sucesso;
        }else{
            return false;//erro ao logar;
        }
    }

}
?>