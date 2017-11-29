<?php
use helpers\StringHelper;

class Route
{
    /**
     * @var string
     */
    public $controllerName = 'Main';
    /**
     * @var string
     */
    public $actionName = 'index';
    /**
     * @var string
     */
    public $actionError = 'error';

    /**
     * @var array
     */
    protected $config;

    /**
     * Route constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        self::configure();
    }

    private function configure()
    {
        if (array_key_exists('route', $this->config)) {
            foreach ($this->config['route'] as $name => $value) {
                $this->$name = $value;
            }
        }

        $this->actionName  = StringHelper::webPathToString($this->actionName);
        $this->actionError = StringHelper::webPathToString($this->actionError);
    }

    /**
     * @throws Exception
     */
    public function init()
    {
        $routes         = explode('/', $_SERVER['REQUEST_URI']);

        $controllerName = $this->getController($routes) . 'Controller';
        $actionName     = $this->getAction($routes);
        $controller     = new $controllerName($this->config);
        $action         = 'action' . $actionName;

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            self::error();
        }
    }

    /**
     * @param array $routes
     *
     * @return string
     */
    private function getController(array $routes)
    {
        if (!empty($routes[1])) {
            $controllerName = StringHelper::webPathToString($routes[1]);
        } else {
            $controllerName = $this->controllerName;
        }

        $controllerPath = 'controllers/' . $controllerName . 'Controller.php';

        if (file_exists($controllerPath)) {
            include_once $controllerPath;
        } else {
            include_once 'controllers/' . $this->controllerName . 'Controller.php';;
            self::error();
        }

        $modelPath = 'models/' . $controllerName . '.php';
        if (file_exists($modelPath)) {
            include_once $modelPath;
        }

        return $controllerName;
    }

    /**
     * @param array $routes
     *
     * @return string
     */
    private function getAction(array $routes)
    {
        if (!empty($routes[2])) {
            $actionName = StringHelper::webPathToString($routes[2]);
        } else {
            $actionName = $this->actionName;
        }

        return $actionName;
    }

    private function error()
    {
        $controllerName = $this->controllerName . 'Controller';
        $controller     = new $controllerName($this->config);
        $action         = 'action' . $this->actionError;

        $controller->$action();

        die();
    }
}