<!-- $dsn = "mysql:host=127.0.0.1;dbname=u114975982_jmaguaegas;charset=utf8";
$usuario = "u114975982_jmaguaegas";
$senha = "Benicio01"; -->

<?php
/*
  * Constantes de parâmetros para configuração da conexão
  */
define('HOST', 'localhost');
define('DBNAME', 'jmaguaegas');
define('CHARSET', 'utf8');
define('USER', 'root');
define('PASSWORD', '');

class Conexao
{

    /*
    * Atributo estático para instância do PDO
    */
    private static $pdo;

    /*
    * Escondendo o construtor da classe
    */
    private function __construct()
    {
        //
    }

    /*
    * Método estático para retornar uma conexão válida
    * Verifica se já existe uma instância da conexão, caso não, configura uma nova conexão
    */
    public static function getInstance()
    {
        if (!isset(self::$pdo)) {
            try {
                $opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => TRUE);
                self::$pdo = new PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . "; charset=" . CHARSET . ";", USER, PASSWORD, $opcoes);
            } catch (PDOException $e) {
                print "Erro: " . $e->getMessage();
            }
        }
        return self::$pdo;
    }
}
