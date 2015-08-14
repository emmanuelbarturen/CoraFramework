<?php namespace App\Util;
Class Form{

    public static function select($nombre,$data,$selected =  null,$attr=null)
    {
        $attr2='';
        $control='';
        if (is_array($attr)) {
            foreach ($attr as $key => $value) {
                $attr2.="$key='$value'";
            }
        }
        $control.= "<select name='$nombre' $attr2 >";
        foreach ($data as $key =>$value) {
            if($key==$selected)
                $control.= "<option value='".$key."' selected>".$value."</option>";
            else
                $control.= "<option value='".$key."'>".$value."</option>";
        }
        $control.= "</select>";
        return $control;
    }

}
