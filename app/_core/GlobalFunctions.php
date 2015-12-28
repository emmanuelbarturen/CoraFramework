<?php
/*
 * Funciones Globales para toda la aplicacion
 */


/**
 * Imprime por pantalla la variable o arreglo que se pase por parametro para su inspeccion
 * @param $var
 */
function dd($var)
{
    if (ob_get_contents()) ob_end_clean();
    echo '<pre>';
    if(is_array($var))
        print_r($var);
    else
        echo $var;
    echo '</pre>';
    exit();
}

/**
 * Devuelve la url raiz mas los parametros que se pasen por argumentos
 * @param string $url
 * @return int
 */
function url($url = ''){
    $actual_link = str_replace('index.php','','http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
    return  $actual_link.$url;
}

/**
 * Crea una url basada en la accion del controlador que se pase por parametro con el formato NameController@actionName
 * @param $action
 * @param string $param
 * @return string
 */
function action($action,$params_a=null){

    $arg = explode('@',str_replace('-','_',$action));
    $params='';
    if(is_array($params_a)){
        $params=implode('/',$params_a);
    }else{
        $params=$params_a;
    }

    if(strtolower($arg[0])!='maincontroller') {
        /*if(!method_exists($arg[0],$arg[1]))
            throw new \Core\Exception('La funcion '.$arg[1].' no esta definida en '.$arg[0]);*/

        return url('admin/'.strtolower(str_replace('Controller','',$arg[0])).'/'.str_replace('_','-',strtolower($arg[1])).'/'.$params);
    }
    if(!method_exists('MainController',$arg[1]))
        throw new \Core\Exception('La funcion '.$arg[1].' no esta definida en MainController');
    return url(str_replace('_','-',strtolower($arg[1])).'/'.$params);
}

/**
 * Obtiene el nombre del dominio de la aplicacion
 */
function app_path(){
    return dirname(dirname( __FILE__ )).'/';
}

/**
 * Obtiene el nombre de la carpeta storage
 * @return string
 */
function storage_path(){
    return app_path().'/storage/';
}
/**
 * obtiene la ruta de la carpeta publica
 * @return string
 */
function public_path(){
    return  dirname(dirname(dirname( __FILE__ ))).'/public';
}

/**
 * Devuelve la ruta publica para obtener la direccion de un recurso
 * @param string $path
 * @return string
 */
function asset($path = ''){
    $actual_link = str_replace('index.php','','http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
    return  $actual_link.$path;
}

/**
 * Obtener mensaje flash
 * @param $name
 * @return mixed
 */
function get_msg($name){
    return Session::getflash($name);
}

/**
 * Verificar si una variable de session existe
 * @param $name
 * @return bool
 */
function has_msg($name){
    return Session::has($name);
}
/**
 * Obtiene la ruta completa del url
 * @return bool
 */
function getFullUrl(){
    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
    $protocol = substr(strtolower($_SERVER["SERVER_PROTOCOL"]), 0, strpos(strtolower($_SERVER["SERVER_PROTOCOL"]), "/")).$s;
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
    return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
}