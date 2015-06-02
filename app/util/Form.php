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

