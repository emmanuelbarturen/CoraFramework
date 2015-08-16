<?php namespace App\Util;

use Core\Exception;

class File{
    public $name =null;
    public $url =null;
    public $extension=null;
    private $resource=null;
    private $path=null;
    public $msg = null;
    private $maxsize = null;
    private $extensionsaccepted = [];

    public function __construct($inputname,$path, $extensionsaccepted = [], $maxize = 2097152){
        $this->resource = $_FILES[$inputname];
        $this->path = $path;
        $this->maxsize = $maxize;
        $this->extensionsaccepted= $extensionsaccepted;
    }

    public function upload(){

        if($this->resource['error']){
            $this->msg = $this->resource['error'];
            return false;
        }
        if(!$this->checkmaxSize())
        {
            $this->msg = "El archivo supera el maximo permitido";
            return false;
        }
        if(!$this->checkExtension())
        {
            $this->msg = "Este tipo de arhivo no se encuentra permitido. Solo arhivos con las extensiones: ".implode(',',$this->extensionsaccepted);
            return false;
        }
        return $this->storage($this->resource['name'],$this->resource['tmp_name']);
    }
    public static function create_thumb($name, $path_to_image_directory,$path_to_thumbs_directory, $final_width_of_image)
    {
        if(!is_dir($path_to_image_directory)){
            throw new Exception('No existe el directorio '.$path_to_image_directory);
        }
        if(!is_dir($path_to_thumbs_directory)){
            throw new Exception('No existe el directorio '.$path_to_thumbs_directory);
        }

        if(preg_match('/[.](jpg)$/', $name)) {
            $im = imagecreatefromjpeg($path_to_image_directory . $name);
        } else if (preg_match('/[.](gif)$/', $name)) {
            $im = imagecreatefromgif($path_to_image_directory . $name);
        } else if (preg_match('/[.](png)$/', $name)) {
            $im = imagecreatefrompng($path_to_image_directory . $name);
        }
        else{
            throw new Exception('Solo se pueden hacer thumbs de imagenes jpg, gif y png');
        }

        $ox = imagesx($im);
        $oy = imagesy($im);

        $nx = $final_width_of_image;
        $ny = floor($oy * ($final_width_of_image / $ox));

        $nm = imagecreatetruecolor($nx, $ny);

        if(!imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy))return false;
        if(!imagejpeg($nm, $path_to_thumbs_directory . $name))return false;

        return true;
    }
    private function storage($name,$temp_name){
        $today = date("YmdHis");
        $new_file_name = $today.'_'.$name;
        if(move_uploaded_file($temp_name,$this->path.$new_file_name)){
            $this->name=$new_file_name;
            $this->url = $this->path.$new_file_name;
            return true;
        }else{
            $this->msg = "No se pudo cargar el archivo";
            return false;
        }
    }

    public static function hasFile($nombre){
        return isset($_FILES[$nombre]) && count($_FILES[$nombre])>0;
    }

    private function checkmaxSize(){
        return $this->resource['size']<$this->maxsize;
    }
    private  function checkExtension(){
        $filename = $this->resource['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        return in_array($ext,$this->extensionsaccepted);
    }
    public static function download($path ,$disposition = 'inline', $filename = null){
        header('Content-type: application/pdf');
        if($filename!=null) {
            header('Content-Disposition: '.$disposition.'; filename="' . $filename . '"');
        }
        else {
            header('Content-Disposition: '.$disposition.';');
        }
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        readfile($path);
        exit();
    }
    public static function delete($path){
        if(! is_dir($path)) {
            if(file_exists($path))
                unlink($path);
        }
    }
}