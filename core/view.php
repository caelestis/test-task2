<?php

use helpers\StringHelper;

/**
 * Class View
 */
class View
{
    /**
     * @var string
     */
    public $layout     = 'main';
    /**
     * @var string
     */
    public $layoutPath = 'views/layout/';
    /**
     * @var string
     */
    public $layoutExt  = '.php';
    /**
     * @var string
     */
    public $errorPage  = 'error';
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public static $language   = 'en-EN';

    /**
     * @var string
     */
    private $controllerFolder;
    /**
     * @var string
     */
    private $content;
    /**
     * @var string
     */
    private $js;
    /**
     * @var string
     */
    private $css;

    /**
     * View constructor.
     *
     * @param string $controller
     * @param array  $config
     */
    public function __construct(string $controller, array $config)
    {
        $this->controllerFolder = StringHelper::stringToWeb($controller);
        $this->controllerFolder = str_replace('-controller', '', $this->controllerFolder);

        $this->configure($config);
    }

    /**
     * @param array $config
     */
    private function configure(array $config)
    {
        if (array_key_exists('view', $config)) {
            foreach ($config['view'] as $name => $value) {
                if ($name == 'language') {
                    self::$$name = $value;
                } else {
                    $this->$name = $value;
                }
            }
        }
    }

    /**
     * @param string $template_view
     * @param null   $data
     *
     * @return string
     */
    public function render(string $template_view, $data = null)
    {
        if (is_array($data)) {
            /** Convert array to vars */
            extract($data);
        }

        ob_start();
        ob_implicit_flush(false);
        require_once 'views/' . $this->controllerFolder . '/' . $template_view . '.php';
        $this->content = ob_get_contents();
        ob_end_clean();

        require_once $this->layoutPath . $this->layout . $this->layoutExt;

        return $this->content;
    }

    /**
     * @return string
     */
    public function renderNotFound()
    {
        ob_start();
        ob_implicit_flush(false);
        require_once $this->layoutPath . $this->errorPage . $this->layoutExt;
        $this->content = ob_get_contents();
        ob_end_clean();

        require_once $this->layoutPath . $this->layout . $this->layoutExt;

        return $this->content;
    }

    public function registerJSFile(string $jsFile)
    {
        $this->js .= '<script src="'. $jsFile .'"></script>';
    }

    public function registerCSSFile(string $cssFile)
    {
        $this->css .= '<link rel="stylesheet" href="'. $cssFile .'">';
    }

    /**
     * @param $category
     * @param $message
     *
     * @return string
     */
    public static function translation($category, $message)
    {
        $filePath = 'messages/' . self::$language . '/' . $category . '.php';
        $messages = '';
        if (file_exists($filePath)) {
            $messages = include $filePath;
        }

        if (is_array($messages)) {
            return (array_key_exists($message, $messages)) ? $messages[$message] : $message;
        }

        return $message;
    }

    /**
     * @param string $url
     *
     * @return bool
     */
    public function redirect(string $url)
    {
        header('Location: ' . $url);

        return true;
    }
}