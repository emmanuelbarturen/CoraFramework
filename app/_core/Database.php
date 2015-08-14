<?php
/**
 * Created by PhpStorm.
 * User: nolobean
 * Date: 29/05/15
 * Time: 04:26 PM
 */
use Core\Exception;
class Database  {

    private static $pdo=null;
    private static $stm=null;
    private static $instance=null;
    public function __construct($host, $user, $pass,$dbname) {
        static::$pdo=$this->getConnection($host, $user, $pass,$dbname);

    }
    public static function getInstancia(){
        if(self::$instance == null){
            $host = getenv('DB_HOST');
            $dbname = getenv('DB_DATABASE');
            $user = getenv('DB_USERNAME');
            $pass = getenv('DB_PASSWORD');
            self::$instance = new Database($host, $user, $pass,$dbname);
        }
        return self::$instance;
    }

    private function getConnection($host, $user, $pass,$dbname) {
        if (self::$pdo == null) {
            try {
                switch (getenv('DB_MOTOR')) {
                    case 'mysql':# MySQL con PDO_MYSQL
                        # Para que la conexion al mysql utilice las collation UTF-8 añadir charset=utf8 al string de la conexion.
                        self::$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
                        break;
                    case 'sqlite': # SQLite Database
                        self::$pdo = new PDO("sqlite:cora_database.db");
                        break;
                    case 'sqlserver': # MS SQLServer y Sybase con PDO_DBLIB
                        self::$pdo = new PDO("mssql:host=$host;dbname=$dbname, $user, $pass");
                        self::$pdo = new PDO("sybase:host=$host;dbname=$dbname, $user, $pass");
                        break;
                    default:
                        throw new Exception('Motor de Base de datos no soportado.');
                }
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return self::$pdo;
            } catch (PDOException $e) {
                throw new Exception($e->getMessage(),$e);
            }
        }else
        {
            return self::$pdo;
        }
    }


    /**
     * ejecuta prepare y ejeccuta el query a la base de datos
     * @param $q
     * @param $params
     * @return mixed
     * @throws \Core\Exception
     */
    private function sendQuery($q,$params) {
        try{

            static::$stm = static::$pdo->prepare($q);
            if($params!=null && is_array($params)){
                $datos = array_values($params);
                static::$stm->execute($datos);
            }
            else
                static::$stm->execute();
        }
        catch (PDOException $err){
            throw new Exception ($err->getMessage(),$err);
        }

    }
    public function executeScalar($q, $params = null) {
        $this->sendQuery($q, $params);
        if (!is_null(static::$stm)) {
            if (!is_object(static::$stm)) {
                return static::$stm;
            } else {
                return static::$stm->rowCount();
            }
        }
        return null;
    }
    /**
     * Recibe el resource de la ejecucion (sendQuery) y lo convierte a un fech para ser usado
     * @param $q
     * @param null $array_index
     * @param null $params
     * @return array|bool
     */
    public function execute($q, $params = null) {

        $this->sendQuery($q, $params);
        if (is_object(static::$stm)) {
            $arr = array();
            while ($row = static::$stm->fetch(PDO::FETCH_ASSOC)) {
                    $arr[] = $row;
            }
            return $arr;
        }
        return static::$stm->rowCount() ? false : true;
    }
    public function getInsertedID() {
        return static::$pdo->lastInsertId();
    }
    public function getError(){
        return static::$stm->errorInfo();
    }
    public function __destruct() {
        static::$pdo=null;
        static::$stm=null;
    }
}