<?php
Class Form{

public static function select($nombre,$data,$attr=null)
{
    $attr2='';
    if (is_array($attr)) {
        foreach ($attr as $key => $value) {
        $attr2.="$key='$value'";
        }
    }
    echo "<select name='$nombre' $attr2 >";
        foreach ($data as $key) {
           echo "<option value='".$key['id']."'>".$key['value']."</option>";
        }
    echo "</select>";
}

}
/*clase para manejo de las rutas del usuario*/
class Url 
{

    private static function to($ruta)
    {

        $appRoot = substr($_SERVER['REQUEST_URI'], 0,16);
        return 'http://'.$_SERVER['HTTP_HOST'].$appRoot.$ruta;
    }

    public static function link_css($cssName)
    {
       print '<link href="'.self::to($cssName).'" media="screen" rel="stylesheet" type="text/css">';
    }
    public static function script($scriptname)
    {
       print '<script type="text/javascript" src="'.self::to($scriptname).'"></script>';
    }
    public static function toUrl($name)
    {
        print self::to($name);
    }
    public static function returnUrl($nombre)
    {
         return self::to($nombre);
    }
    public static function action($controller,$action,$params=null)
    {
       return self::to($controller).'/'.$action.'/'.$params;
    }
    public static function partialView($name)
    {
        $path = str_replace('\\', '/', __DIR__);
        $path = str_replace('util', 'views/', $path);
       include $path.$name.'.php';
    }
}


class Log{
    public static function setLog($message)
    {
        $directory = __dir__."/../logs/log.txt";
        error_log("Log message:\n".$message."\n\n\n", 3, $directory);
    }
    public static function error($message)
    {
        $directory = __dir__."/../logs/error_log.txt";
        error_log("Error message:\n".$message."\n\n\n", 3, $directory);
    }
}
?>