<?php
use App\Util\File;
use App\Util\Helper;
use Core\Redirect;

class AdminController extends Controller{

    public function index(){
        return $this->view('admin/index');
    }
    public function change_password(){

        return $this->view('auth.change_credentials');
    }
    public function update_password(){
        $p1=$_POST['p1'];
        $p2=$_POST['p2'];
        if($p1!=$p2) {
            Session::flash('msg','las contrasenas no coinciden');
            Redirect::toAction('AdminController@change_password');
        }
         if(strlen($p1)<5 || strlen($p2)<5) {
             Session::flash('msg','las contrasenas deben tener mas de 5 caracteres');
             Redirect::toAction('AdminController@change_password');
         }
        $obj  = System::where('sys_key','auth')[0];
        $credentials = Helper::jsonToList($obj->sys_value);
        $credentials['password']=$p1;
        $obj->sys_value=Helper::listToJson($credentials);
        $obj->update();
        Redirect::toAction('AdminController@index');
    }

}