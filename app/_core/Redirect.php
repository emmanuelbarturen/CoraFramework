<?php namespace Core;
class Redirect {

    public static function toAction($arg,$id=null)
    {
        $params = explode('@',$arg);
        if(is_array($params) ){
            if(strtolower($params[0])!='maincontroller') {
                $controller = str_replace('Controller','',$params[0]);
                $action = $params[1];
                static::toUrl('admin/'.strtolower($controller).'/'.strtolower($action).'/'.$id);
            }
            else{
                $action = $params[1];
                static::toUrl(strtolower($action).'/'.$id);
            }
        }else
            throw new Exception('Argumento no valido para la funcion toAction');
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