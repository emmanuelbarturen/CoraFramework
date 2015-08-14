<?php
use Core\Exception;
class Model{
    private static $database;
    protected static $table;
    protected static $fillable = [];
    function __construct(){
        self::getConnection();
    }
    private static function getConnection(){
        require_once('Database.php');
        self::$database = Database::getInstancia();
    }

    public static function find($id){
        $results = self::where('id', $id);
        return isset($results[0])?$results[0]:null;
    }
    public static function lists($id,$value){
        $list = null;
        self::getConnection();
        $query = "SELECT $id as id,$value as value FROM " . static::$table;
        $results = self::$database->execute($query, null);
        if ($results) {
             foreach ($results as  $values) {
                $list[$values['id']] = $values['value'];
            }
        }
        else
            $list=[];

        return $list;
    }
    public static function where($field, $value,$add_query = ''){
        $objs = null;
        self::getConnection();
        $query = "SELECT * FROM " . static::$table . " WHERE " . $field . " = ? ".$add_query;
        $results = self::$database->execute($query, array($value));

        if ($results) {
            $class = get_called_class();
            foreach ($results as $index => $cols) {
                $obj = new $class();
                foreach ($cols as $key => $val) {
                    $obj->$key = $val;
                }
                $objs[] = $obj;
            }
        }
        else
            $objs=[];

        return $objs;
    }
    public static function query($query){
        $objs = null;
        self::getConnection();
        $results = self::$database->execute($query);
        if ($results) {
            $class = get_called_class();
            foreach ($results as $index => $cols) {
                $obj = new $class();
                foreach ($cols as $key => $val) {
                    $obj->$key = $val;
                }
                $objs[] = $obj;
            }
        }
        else
            $objs=[];

        return $objs;
    }
    public static function search($field, $value){
        $objs = null;
        self::getConnection();
        $query = "SELECT * FROM " . static::$table . " WHERE " . $field . " like CONCAT('%',?,'%')";
        $results = self::$database->execute($query, array($value));
        if ($results) {
            $class = get_called_class();
            foreach ($results as $index => $cols) {
                $obj = new $class();
                foreach ($cols as $key => $val) {
                    $obj->$key = $val;
                }
                $objs[] = $obj;
            }
        }
        else
            $objs=[];

        return $objs;
    }
    public static function all($order = null){
        $objs = null;
        self::getConnection();
        $query = "SELECT * FROM " . static::$table;
        if ($order) {
            $query .= ' Order By '.$order;
        }
        $results = self::$database->execute($query, null);
        if ($results) {
            $class = get_called_class();
            foreach ($results as $index => $cols) {
                $obj = new $class();
                foreach ($cols as $key => $val) {
                    $obj->$key = $val;
                }
                $objs[] = $obj;
            }
        }
        else
            $objs=[];
        return $objs;
    }
    private function filter_values($vals){
        $arr_vals=[];
        if(is_array(get_object_vars($this))) {
            foreach(get_object_vars($this) as $key=>$val1) {
                $arr_vals[$key]=$val1;
            }
        }
        if(is_array($vals)) {
            foreach($vals as $key2=>$val2) {
                $arr_vals[$key2]=$val2;
            }
        }

        if(count(static::$fillable)>0) {
            foreach ($arr_vals as $key=>$val) {
                if (!in_array($key, static::$fillable)) {
                    unset($arr_vals[$key]);
                }
            }
        }
        return $arr_vals;
    }

    public function save($vals = null){
        $values = $this->filter_values($vals);
        $filtered = null;
        foreach ($values as $key => $value) {
            if ($value !== null && $value !== '' && strpos($key, 'obj_') === false && $key !== 'id') {
                if ($value === false) {
                    $value = 0;
                }
                $filtered[$key] = $value;
            }
        }
        
        $columns = array_keys($filtered);

        if (isset($values['id'])) {
            $columns = join(" = ?, ", $columns);
            $columns .= ' = ?';
            $query = "UPDATE " . static::$table . " SET $columns WHERE id =" . $values['id'];
        } else {
            $params = join(", ", array_fill(0, count($columns), "?"));
            $columns = join(", ", $columns);
            $query = "INSERT INTO " . static::$table . " ($columns) VALUES ($params)";

        }
        $result = self::$database->executeScalar($query, $filtered);

        if ($result) {
            $this->id = self::$database->getInsertedID();
            return true;
        } else {
            return false;
        }
    }
    public function update($vals=null)
    {
        $values = $this->filter_values($vals);
        $filtered = null;
        foreach ($values as $key => $value) {
            if ($value !== null && $value !== '' && strpos($key, 'obj_') === false && $key !== 'id') {
                if ($value === false) {
                    $value = 0;
                }
                $filtered[$key] = $value;
            }
        }
        $columns = array_keys($filtered);

        if (isset($values['id'])) {

            $columns = join(" = ?, ", $columns);
            $columns .= ' = ?';
            $query = "UPDATE " . static::$table . " SET $columns WHERE id =" . $values['id'];
        } else {
            throw new Exception('No se ha definido un id');
        }
        $result = self::$database->executeScalar($query, $filtered);

        if ($result) {
            $this->id = $values['id'];
            return true;
        } else {
            return false;
        }
    }
    public static function delete($id){
        self::getConnection();
        $query = "DELETE FROM " . static::$table . " WHERE id =?";
         return self::$database->executeScalar($query,array($id));
    }
    public function destroy(){
        self::getConnection();
        $values = get_object_vars($this);
        if (isset($values['id'])) {
            $query = "DELETE FROM " . static::$table . " WHERE id =?";
            return self::$database->executeScalar($query,array($values['id']));
        } else {
            throw new Exception('No se ha definido un id');
        }
    }

    /*
	 * $query:  query de la consulta
	 * $pagina:  # de pagina a  mostrar
	 * $limite:  # de registros por pagina
	 */

    public static function paginate($query, $pagina = false, $limite = false)
    {
        define('LIMIT_REGXPAG',10);
        define('LIMIT_PAGEVIEW',3);
        self::getConnection();
        static $_paginacion = array();
        /*   Define el valor de la variable  */
        if(!($limite && is_numeric($limite))){
            $limite = LIMIT_REGXPAG;
        }

        /*  Define el inicio de la pagina */
        if ($pagina && is_numeric($pagina)){
            $inicio = ($pagina - 1) * $limite;
        } else {
            $pagina = 1;
            $inicio = 0;
        }

        /*  Consulta a la BD */
        $result = self::$database->execute($query, null);

        $registros =  count($result);


        /*  Define el total de paginas */
        $total = ceil($registros / $limite);

        if ($pagina>$total) $pagina=$total;


        /*  Define el inicio de la pagina */
        if ($pagina && is_numeric($pagina)){
            $inicio = ($pagina - 1) * $limite;
        } else {
            $pagina = 1;
            $inicio = 0;
        }

        /*  Consulta con limites  */
        $query = $query . " LIMIT $inicio, $limite";
        $result = self::$database->execute($query, null);

        /* Define las otras variables de la paginación */
        $_paginacion['actual'] = $pagina;
        $_paginacion['total'] = $total;

        if($pagina > 1){
            $_paginacion['primero'] = 1;
            $_paginacion['anterior'] = $pagina - 1;
        } else {
            $_paginacion['primero'] = '';
            $paginacion['anterior'] = '';
        }

        if($pagina < $total){
            $_paginacion['ultimo'] = $total;
            $_paginacion['siguiente'] = $pagina + 1;
        } else {
            $_paginacion['ultimo'] = '';
            $_paginacion['siguiente'] = '';
        }

        $total_paginas = $_paginacion['total'];
        $pagina_seleccionada = $_paginacion['actual'];
        $rango = ceil(LIMIT_PAGEVIEW / 2);

        if($pagina_seleccionada < $rango){
            $rango_derecho = LIMIT_PAGEVIEW;
        } else {
            $rango_derecho = $pagina_seleccionada + $rango;
        }

        if ($total_paginas<LIMIT_PAGEVIEW) $rango_derecho = $total_paginas;
        $rango_izquierdo = $pagina_seleccionada - ($rango-1);
        if ($rango_izquierdo<=0) $rango_izquierdo=1;
        $paginas = range($rango_izquierdo,$rango_derecho);
        $_paginacion['rango'] = $paginas;
        dd($_paginacion);
        return $result;
    }
    public function relation($table,$foreign_id,$id = 'id'){
        static::$table =$table;
        $result =  static::where($id,$this->$foreign_id);
        return $result[0];
    }
}
