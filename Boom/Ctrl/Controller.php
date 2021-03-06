<?php
namespace Boom\Ctrl;

use Cake\ORM\TableRegistry;

class Controller
{
    public $name;
    public $request;
    public $response;
    public $params;
    public $action;
    public $appname;
    public $layout;
    public $layoutVars = [];
    public $hasModel = true;

    public function __construct($appname, $request, $response, $params = array(), $name)
    {
        $this->appname = ucfirst($appname);
        $this->request = $request;
        $this->response = $response;
        $this->params = $params;
        $this->name = $name;
        if (!isset($params[0]) || (isset($params[0]) && !empty($params[0]))) {
            $this->action = 'main';
        }

        $this->layout = "default";

        if ($this->hasModel) {
            $this->loadModel();
        }

        if (method_exists($this, 'setLayoutVars')) {
            $this->setLayoutVars();
        }
    }

    public function run()
    {

    }

    public function action_main($params = null)
    {

    }

    public function redirect($to)
    {
        return $this->response->withRedirect(BASE_URL . $to);
    }

    public function view($view, $params = array(), $layout = false) // Inverser plutot non ? On aura plus souvent besoind du layout que non
    {
        $path = 'Apps/' . $this->appname . '/Views/' . ucfirst($view) . '.php';
        extract($params);
        ob_start();
        require($path);
        $tampon = ob_get_contents();
        ob_end_clean();
        if (!empty($layout)) {
            extract($this->layoutVars);
            $layout_file = 'Apps/' . $this->appname . '/Views/Layouts/' . (is_string($layout) ? $layout : $this->layout) . '.php';
            if (file_exists($layout_file)) {

                include($layout_file);
            }
        } else {
            if (isset($_SERVER['enhancer']) && !empty($_SERVER['enhancer'])) {
                return $tampon;
            } else {

                return $this->response->write($tampon);
            }
        }
    }

    public static function view_static($view, $params = array(), $layout = false)///@todo gerer le fait qu'on puisse ne pas avoir de layouts
    {
        $path = 'Apps/' . substr(strrchr(get_called_class(), "\\"), 1) . '/Views/' . ucfirst($view) . '.php';
        extract($params);
        ob_start();
        require($path);
        $tampon = ob_get_contents();
        ob_end_clean();
        echo $tampon;
    }

    public function loadModel($name = null)
    {
        if (is_null($name)) {
            $name = ucfirst($this->name);
        }

        $namespace = 'Apps\\' . ucfirst($this->appname) . '\Model\\' . $name . 'Table';
        if (class_exists($namespace) && !isset($this->{$name})) {
            $this->{$name} = TableRegistry::get($name, ['className' => $namespace]);
            //$this->{$name}->appname = $this->appname;
        } else {
            echo 'Model ' . $namespace . ' not found </br>';
        }
    }
}