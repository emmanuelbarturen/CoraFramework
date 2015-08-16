<?php

use App\Util\File;
use App\Util\Helper;
use Core\Redirect;
class MainController extends Controller{

    /*
    |--------------------------------------------------------------------------
    | Funciones de Autenticacion
    |--------------------------------------------------------------------------
    |
    | Funciones para logeo del administrador
    |
    */
    /*no borrar*/
    public function login(){
        return $this->view('auth.login');
    }
    /*no borrar*/
    public function validate_auth(){
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $credentials_json  = System::where('sys_key','auth')[0]->sys_value;
        $credentials = Helper::jsonToList($credentials_json);
        if(($user==$credentials['username'] && $pass==$credentials['password'])) {
            Session::start_auth();
            Redirect::toAction('AdminController@index');
        }
        else {
            Session::flash('msg','Credenciales no validas');
            Redirect::toAction('MainController@login');
        }
    }
    /*no borrar*/
    public function logout(){
        Session::destroy_auth();
        Redirect::toAction('MainController@home');
    }
    /*error 404 -  no borrar*/
    public function oops(){
        return $this->view('mensajes/404');
    }

    public function info(){
        return $this->view('info');
    }

    /*
    |--------------------------------------------------------------------------
    | Vistas
    |--------------------------------------------------------------------------
    |
    | Llamadas a las vistas de la web
    |
    */
    /*home -  no borrar*/
    public function home(){
        return $this->view('index');
    }
    public function save(){
        $img =  new File('archivo',public_path().'/img/',['jpg','png']);
        if(!$img->upload()){
            echo $img->msg;
            die();
        }
        File::create_thumb($img->name,public_path().'/img/',public_path().'/img/thumbs/',100);
        echo $img->url;
    }


}
