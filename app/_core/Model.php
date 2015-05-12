<?php
require_once 'DatabaseMysqli.php';
class Model{

	protected static $table;
	public static function find($id) {
        $results = self::where('id','=',$id);
        return $results[0];
    }
    public static function findBy($campo,$criterio) {
        $results = self::where($campo,'=',$criterio);
        return $results[0];
    }
    public static function where($campo,$condicion ,$valor) {  
        $objCon= new DatabaseMysqli();
        $query = "SELECT * FROM ".static::$table." WHERE ".$campo.$condicion."'".$valor."'";
        //die($query);
        $results = $objCon->results_from_execute($query);
 		return $results;
    }
    public static function query($query) {  
        $objCon= new DatabaseMysqli();
        $results = $objCon->results_from_execute($query);
        return $results;
    }
    public static function all($orden = null) {
        $objCon= new DatabaseMysqli();
        $query = "SELECT * FROM ".static::$table;
        if ($orden) {
        	$query.=' '.$orden;
        }
        //echo $query;
 		$results = $objCon->results_from_execute($query);
 		return $results;
    }
    public static function lists($field1,$field2) {
        $objCon= new DatabaseMysqli();
        $query = "SELECT `$field1`as id,`$field2` as value FROM ".static::$table;
        $results = $objCon->results_from_execute($query);
        return $results;
    }
    public static function listWhere($field1,$field2,$campo,$operador,$valor) {
        $objCon= new DatabaseMysqli();
        $query = "SELECT `$field1`as id,`$field2` as value 
        FROM ".static::$table." WHERE ".$campo.$operador.$valor.";";
        $results = $objCon->results_from_execute($query);
        return $results;
    }
    public static function insert($data){
    	$objCon= new DatabaseMysqli();
    	foreach ($data as $key => $value) {
    		@$columnas.=$key.',';
    		@$valores.=is_string($value)? "'".$value."',":$value.',';
    		
    	}
    	$columnas = substr($columnas,0,-1);
    	$valores = substr($valores,0,-1);
    	$query='INSERT INTO '.static::$table.'('.$columnas.')VALUES('.$valores.');';
       	return $objCon->executeScalar($query);
    }
    public static function update($data){
    	$objCon= new DatabaseMysqli();
    	foreach ($data as $key => $value) {
    		@$valores=is_string($value)? "'".$value."'":$value;
    		@$sets.=$key.'='.$valores.',';
    	}
    	$sets = substr($sets,0,-1);
    	$query='UPDATE '.static::$table.' set '.$sets.' WHERE id = '.$data['id'];
        return $objCon->executeScalar($query);
    }
    public static function delete($id){
    	$objCon= new DatabaseMysqli();
    	$query='DELETE FROM '.static::$table.' WHERE id='.$id;
        //die($query);
       	return $objCon->executeScalar($query);
    }
}