<?php
require_once 'Exception.php';
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
require_once '../app/controllers/MainController.php';

class App
{
    private $url = null;

    public function __construct()
    {
        Session::garbage_collector();
        $this->startVars(); 
        $this->url = $this->parseUrl();
        if (isset($this->url[0])) {
            $controller = $this->getController();
            $is_admin = $controller instanceof MainController ? false : true;
            $method = $this->getMethod($controller, $is_admin);
            $params = $this->getParams();
            $this->run($controller, $method, $params);
        } else {
            $controller = new \MainController();
            $method = 'home';
            $this->run($controller, $method);
        }
        Session::sentinel();
    }

    public function getController()
    {
        $controller = null;
        if ($this->url[0] != getenv('ADM_NAME')) {
            $controller = 'MainController';
            return new $controller;
        }
        unset($this->url[0]);
        $controller = isset($this->url[1]) ? $this->url[1] . 'Controller' : 'AdminController';
        if (!file_exists('../app/controllers/admin/' . ucfirst($controller) . '.php')) {
            throw new Exception('No existe controlador "' . ucfirst($controller) . '.php"');
        }
        require_once '../app/controllers/admin/' . ucfirst($controller) . '.php';
        unset($this->url[1]);
        return new $controller;
    }

    public function getMethod($controller, $is_admin)
    {
        $method = null;
        if ($is_admin) {
            if (isset($this->url[2])) {
                $method = str_replace('-', '_', $this->url[2]);
                unset($this->url[2]);
            } else {
                $method = 'index';
            }
        } else {
            $method = str_replace('-', '_', $this->url[0]);
            unset($this->url[0]);
        }
        if (!method_exists($controller, $method)) {
            if (getenv('APP_DEBUG') == 'true') {
                throw new Exception('el metodo ' . $method . '  no existe en MainController.');
            }
            \Core\Redirect::toAction('MainController@oops');
        }
        return $method;
    }

    public function getParams()
    {
        return $this->url ? array_values($this->url) : [];
    }

    public function run($controller, $method, $params = [])
    {
        if (!$controller instanceof MainController) {
            if (!Session::check_auth()) {
                $controller = new MainController();
                $method = 'login';
            }
        }

        print call_user_func_array([$controller, $method], $params);
    }

    /**
     * Obtiene el url desde la carpeta public hacia adelante
     * @return array
     * @throws Exception
     */
    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }

    /**
     * Establece las variables que se encuentren en app.conf como variables de entorno para su uso en la aplicacion.
     */
    public function startVars()
    {

        $conf_file = file(__DIR__ . '/../../app.conf');
        if (!$conf_file) {
            $whoops = new Run();
            $whoops->pushHandler(new PrettyPageHandler());
            $whoops->register();
            throw new Exception("No se encuentra archivo app.conf en la carpeta raiz pe mi querido.... mutilador de frameworks XD! ");
        }
        $env_variables = array('APP_DEBUG', 'DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD', 'TIMEZONE', 'UPLOAD_MAX_FILESIZE', 'POST_MAX_SIZE', 'ADM_NAME', 'DB_MOTOR');
        foreach ($conf_file as $line) {
            $l = explode("=", $line);
            if (in_array($l[0], $env_variables)) {
                $value = trim(array_pop(explode("=", $line)));
                putenv("$l[0]=$value");
            }
        }
        $this->setConfigs();
    }

    public function setConfigs()
    {
        ini_set('date.timezone', getenv('TIMEZONE'));
        ini_set('post_max_size', getenv('POST_MAX_SIZE'));
        ini_set('upload_max_filesize', getenv('UPLOAD_MAX_FILESIZE'));
        ini_set('default_charset', 'UTF-8');
        if (getenv('APP_DEBUG') == 'true') {
            $whoops = new Run();
            $whoops->pushHandler(new PrettyPageHandler());
            $whoops->register();
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
        } else {
            ini_set('display_errors', 0);
            error_reporting(0);
        }
    }
}
