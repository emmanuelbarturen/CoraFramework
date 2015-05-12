<?php
use Core\Redirect;
class HomeController extends Controller
{
    public function index(){
        $variable = 'hola framework';
        $color = 'Carlos Cervera';
        $priceExpression=201;
        $this->view('example',compact('variable','color','priceExpression'));
    }
    public function redirect()
    {
        Redirect::toAction('HomeController@otro');
    }

    public function otro(){
        echo 'dasa';
    }

}