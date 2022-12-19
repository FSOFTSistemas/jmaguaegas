<?php 
    class ConexaoBancoDados {
        private const URL = "mysql:host=127.0.0.1;dbname=u114975982_kikogasbd;charset=utf8";
        private const USUARIO = "u114975982_kikogasbd";
        private const SENHA = "Benicio01";

        public static function conexao() {
            try {

                return new PDO(self::URL, self::USUARIO, self::SENHA);
            } catch(PDOException $e) {
                echo "Error: ".$e->getMessage();
            }
        }
    }
?>