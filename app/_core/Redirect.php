<?php namespace Core;
class Redirect {

    public static function toAction($arg)
    {
        $params = explode('@',$arg);
        if(is_array($params) )
        {
            $controller = str_replace('Controller','',$params[0]);
            $action = $params[1];
            static::toUrl(strtolower($controller).'/'.strtolower($action));
        }else
            throw new Exception('Argumento no valido para la funcion toAction, es Controlador@accion, asi o con manzanitas?');
    }
    public  static function toUrl($url){
        if($url){
            header('location:'.url($url));
            exit;
        }
    }
    public static function back(){
        header("location:javascript://history.go(-1)");
    }
}