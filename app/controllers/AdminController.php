<?php
use Core\Redirect;
class AdminController extends Controller{
    public function __construct(){
        /*if (!isset($_SESSION['auth'])) {
           Redirect::toUrl('login');
        }*/
    }
    public function index(){
        $this->view('admin/index');
    }
    public function productos(){

        /*$productos = Categoria::all();
        dd($productos);*/
        $ps=Categoria::paginate('select * from categoria');

    }
    public function agregar_producto(){
        echo 'ou yes ou yes';
    }
    public function test(){
        dd(Database::getAvailableDrivers());
    }

}