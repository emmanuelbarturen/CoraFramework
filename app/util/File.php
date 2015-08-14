<?php namespace App\Util;

class File{
    public $name =null;
    public $url =null;
    public $extension=null;
    private $resource=null;
    private $path=null;
    public function __construct($inputname,$path = ''){
        $this->resource = $_FILES[$inputname];
        $this->path = $path;
    }

    public function upload(){
        if(is_array($this->resource['name'])){
            for($i=0;$i<count($this->resource['name']);$i++) {
                if($this->resource['name'][$i]!='')
                    $this->storage($this->resource['name'][$i],$this->resource['tmp_name'][$i],$this->resource['size'][$i],$this->resource['error'][$i]);
            }
        }
        else {
            $this->storage($this->resource['name'],$this->resource['tmp_name'],$this->resource['size'],$this->resource['error']);
            $this->name = $this->name[0];
            $this->url = $this->url[0];
        }
    }
    private function storage($name,$temp_name,$size ,$error){
        $today = date("YmdHis");
        $new_file_name = $today.'_'.$name;
        move_uploaded_file($temp_name,public_path().'/'.$this->path.$new_file_name);
        $this->name[]=$new_file_name;
        $this->url[] = $this->path.$new_file_name;
    }

    public static function hasFile($nombre){
        return isset($_FILES[$nombre]) && count($_FILES[$nombre])>0;
    }

    public static function maxSize($name,$size = 2097152){
        $file = $_FILES[$name]['size'];
        $size = $size;
        return $file<$size;
    }
    public static function extensionAcceptable($name,$arrayExtension){
        $filename = $_FILES[$name]['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        return in_array($ext,$arrayExtension);
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
        if(is_array($path)) {
            foreach($path as $one) {
                self::delete($one);
            }
        }
        else {
            $complete_path =public_path().'/'.$path;
            if(! is_dir($complete_path)) {
                if(file_exists($complete_path))
                    unlink($complete_path);
            }
        }
    }
}