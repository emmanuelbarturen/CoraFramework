<?php
class DatabaseMysqli { 

    private $conn = null;
    private static $instancia = null;
    private static $lastId=-1;
    public static function getInstancia(){
        if(self::$instancia == null){
            self::$instancia = new DatabaseMysqli();
        }
        return self::$instancia;
    }
    public function beginTransaction()
    {
        $this->open_connection();
        $this->conn->autocommit(FALSE);
    }
    public function commit()
    {
        $this->open_connection();
        $this->conn->commit();
    }
    public function rollback()
    {
        $this->open_connection();
        $this->conn->rollback();
    }
    public function endTransaction()
    {
        $this->open_connection();
        $this->conn->autocommit(TRUE);
        $this->close_connection();
    }
    public function lastId()
    {
        $id=self::$lastId;
        self::$lastId=-1;
       return $id;
    }
    private function open_connection() { 
            if ($this->conn!=null) {
               return $this->conn;
            }
            $this->conn = new mysqli(getenv('DB_HOST'),getenv('DB_USERNAME'),getenv('DB_PASSWORD'), getenv('DB_DATABASE'));
            $this->conn->set_charset("utf8");
            if ($this->conn->connect_errno) {
                die("Fallo al contenctar a MySQL: (" . $this->conn->connect_errno . ") " . $this->conn->connect_error);
            }
    } 

    private function close_connection() { $this->conn->close(); } 

    public function executeScalar($query) {  

    		$this->open_connection();         
            if (!$this->conn->query($query)) {
                Log::error("\n\nQUERY:".$query."--------".$this->conn->connect_errno);
               throw new Exception("QUERY:".$query."--------".$this->conn->connect_errno);
            }
            $affectedRows = $this->conn->affected_rows;
            self::$lastId = mysqli_insert_id($this->conn);
            $this->close_connection();
            return $affectedRows;
    } 
    public function results_from_execute($query) {       
    	$this->open_connection();
        if (!$this->conn->query($query)) {
               throw new Exception("QUERY:".$query."--------".$this->conn->connect_errno);
            }
    	$result = $this->conn->query($query) ;
        if ($result) {
            for ($rows = array (); $row = $result->fetch_assoc(); $rows[] = $row);            
            mysqli_free_result($result) ;       
            $this->close_connection();
            return $rows; 
        }
        else
            return $arrayName = array();
    } 
}

