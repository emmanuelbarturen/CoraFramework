<?php
namespace Core;
use Exception as BaseException;
class Exception extends BaseException{

   public function __construct($msg,$e = null){
       parent::__construct($msg);
       $output = $msg."\n";
       $output.=$e==null?'':$e->getTraceAsString()."\n\n";
       file_put_contents(storage_path().'logs/cora.log',$output, FILE_APPEND);
   }
}
