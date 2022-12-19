<?php
//Sessão
session_start();
//Conexao
require_once "bdd.php";

if(isset($_POST['btn_excluir'])){
    $id = mysqli_escape_string($connect, $_POST['id']);

    $sql = "UPDATE Entrega SET status = '''excluido''' WHERE id = '$id'";

    if(mysqli_query($connect, $sql)){
        $_SESSION['mensagem'] = "Deletado Com Sucesso!";
        header('Location: home.php');
    }
    else {
        $_SESSION['mensagem'] = "Erro ao Deletar!";
        header('Location: home.php');
    }
}