<?php

/**
 * Class Controller
 */
class Controller {
    /**
     * @var View
     */
    public $view;
    /**
     * @var db
     */
    protected $db;

    /**
     * Controller constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->view = new View(get_class($this), $config);
        $this->db   = new db($config);
    }

    public function actionIndex()
    {
    }
}