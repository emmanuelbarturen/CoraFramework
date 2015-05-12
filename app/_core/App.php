<?php namespace Core;
require_once 'Exception.php';
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
/**
 * Class App
 * @package App
 */

class App
{
    protected $controller;
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {

        $this->startVars();
        $url = $this->parseUrl();
        if (!$url) {
            $this->controller = 'home';
            $url[0] = $this->controller;
        }

        if (file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = $url[0].'Controller';
            unset($url[0]);
        } else {
            throw new Exception('No existe controlador '.ucfirst($url[0]).'Controller.php oye mi querido .....programador de radio xD');
        }
        require_once '../app/controllers/' . ucfirst($this->controller) . '.php';
        $objController = new $this->controller();
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                throw new Exception('La funcion del controlador no existe pe chicho, ta que estas en nada ah!! xD ');
            }
        }
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$objController, $this->method], $this->params);
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
    }

    /**
     * Establece las variables que se encuentren en web.config como globales para su uso en la aplicacion.
     */
    public function startVars()
    {

        $conf_file = file(__DIR__ . '/../../web.config');
        if (!$conf_file) {
            $whoops = new Run();
            $whoops->pushHandler(new PrettyPageHandler());
            $whoops->register();
            throw new Exception("No se encuentra archivo web.config en la carpeta raiz pe mi querido.... mutilador de frameworks XD! ");
        }
        $env_variables = array('APP_DEBUG', 'DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD','SMARTY_TIMEZONE','SMARTY_CACHE_VIEWS','SMARTY_LIFETIME_CACHE_VIEWS');
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
        ini_set('date.timezone',getenv('SMARTY_TIMEZONE'));
        if (getenv('APP_DEBUG') == 'true') {
            $whoops = new Run();
            $whoops->pushHandler(new PrettyPageHandler());
            $whoops->register();
            ini_set('display_errors', 1);
            ini_set('default_charset', 'UTF-8');
        } else {
            ini_set('display_errors', 0);
        }
    }
}
