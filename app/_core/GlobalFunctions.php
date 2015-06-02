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
 * @return int
 */
function action($action,$param=''){
    $arg = explode('@',$action);
    return url(strtolower(str_replace('Controller','',$arg[0])).'/'.strtolower($arg[1]).'/'.$param);
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


function incluir($path){
    include app_path().'views/'.$path;
}
