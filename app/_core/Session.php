<?php

use Core\Exception;
class Session {

    public static function flash($key,$value){
        static::set('flash.new',$key,$value);
    }

    private static function set($type,$key,$value){
        $_SESSION[$type][$key]=$value;
    }

    public static function start_auth(){
        static::set('app','auth',true);
    }
    public static function check_auth(){
        return (isset($_SESSION['app']['auth']) && $_SESSION['app']['auth']==true);
    }


    public static function destroy_auth(){
        if(isset($_SESSION['app']['auth'])) {
            unset($_SESSION['app']['auth']);
        }
    }
    public static function sentinel(){
        if(isset($_SESSION['flash.new'])){
            $_SESSION['flash.old']=$_SESSION['flash.new'];
            unset($_SESSION['flash.new']);
        }
    }

    public static function garbage_collector(){
        if(isset($_SESSION['flash.old'])){
            unset($_SESSION['flash.old']);
        }
    }
    public static function getflash($name){
        return static::get('flash.new',$name);
    }
    public static function has($name){
        return isset($_SESSION['flash.new'][$name]);
    }
    private static function get($type,$name){
        try {
            if(isset($_SESSION[$type]))
                return $_SESSION[$type][$name];
            else
                throw new Exception('No existen variables de session del tipo '.$type);
        }
         catch(Exception $e){
             throw new Exception('Variable "'.$name.'" desconocida',$e);
         }
    }
}