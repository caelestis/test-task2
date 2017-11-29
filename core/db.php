<?php

class db
{
    /**
     * @var string
     */
    public $host     = 'localhost';
    /**
     * @var string
     */
    public $name     = 'test';
    /**
     * @var string
     */
    public $username = 'root';
    /**
     * @var string
     */
    public $password = '';
    /**
     * @var string
     */
    public $charset  = 'UTF8';

    /**
     * @var array
     */
    private $config;

    /**
     * @var PDO
     */
    public $pdo;

    /**
     * db constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->configure();
        $this->createLink();
    }

    public function configure()
    {
        if (array_key_exists('view', $this->config)) {
            foreach ($this->config['db'] as $name => $value) {
                $this->$name = $value;
            }
        }
    }

    private function createLink()
    {
        try {
            $this->pdo = new PDO(
                'mysql:host='. $this->host .';dbname=' . $this->name.';charset=' . $this->charset,
                $this->username,
                $this->password
            );
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}