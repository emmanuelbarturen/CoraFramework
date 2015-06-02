<?php

class HomeController extends Controller
{
    public function index(){
        $this->view('web/home');
    }
    public function login(){
      $this->view('admin/login');

    }
    public function quienes_somos(){
        $this->view('web/quienes-somos');
    }
    public static function uno(){return 'das';}
    public static function dos(){return 'dos';}
    public function contacto(){
        $this->view('web/contacto');
    }
    public function distribuidores(){
        $this->view('web/distribuidores');
    }
    public function servicios(){
        $this->view('web/servicios');
    }

    public function producto($id)
    {
        $producto = Producto::find($id);
        $relacionados = Producto::query('Select * from producto  where categoria_id='.$producto['categoria_id'].' order by RAND() limit 4');
        $materiales= Material::lists('id','nombre');
        $categorias = Categoria::all();
        $this->view('web/detalleproducto',compact('producto','relacionados','materiales','categorias'));
    }
    public function productos($idCategoria=null){
        if($idCategoria!=null) {
            $titulo = Categoria::find($idCategoria);
            $productos = Producto::where('categoria_id','=',$idCategoria);
        }
        else {
            if ($_POST) {
                $categorias_ids=array();
                $subcategoria_ids=array();
                $materiales_ids=array();
                if (isset($_POST['categoria'])) {
                    foreach ($_POST['categoria'] as $key => $value) {
                        array_push($categorias_ids,$value);
                    }
                }
                if (isset($_POST['subcategoria'])) {
                    foreach ($_POST['subcategoria'] as $key => $value) {
                        array_push($subcategoria_ids,$value);
                    }
                }
                if (isset($_POST['material'])) {
                    foreach ($_POST['material'] as $key => $value) {
                        array_push($materiales_ids,$value);
                    }
                }
                $titulo = ['nombre'=>"Filtrado"];
                $objProducto = new Producto();
                $productos = $objProducto->getProductoFilter($categorias_ids,$subcategoria_ids,$materiales_ids);
            }
            else
            {
                $titulo = ['nombre'=>"Todos"];
                $productos = Producto::all();
            }

        }
        $categorias = Categoria::all();
        $subcategorias =Subcategoria::all();
        $materiales = Material::all();
        $this->view('web/productos',compact('titulo','productos','categorias','subcategorias','materiales'));
    }

    public function descargar()
    {
        $file = public_path()."/infafiza.pdf";
        $filename = 'filename.pdf';
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        readfile($file);
        exit();
    }

}