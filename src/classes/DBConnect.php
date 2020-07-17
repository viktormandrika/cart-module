<?php


namespace src\classes;

use Illuminate\Database\Capsule\Manager as Capsule;

class DBConnect
{
    private $capsule;
    public static $instance;
    public $config;

    public function __construct(array $configs)
    {
        foreach ($configs as $name => $config) {
            $this->config[$name] = $config;
        }
        $this->capsule = new Capsule;
        $this->connect();
        $this->boot();
    }


    public static function getInstance(array $config): object
    {
        if (self::$instance === null) {
            self::$instance = new self($config);
          }
        return self::$instance;
    }

    public function connect()

    {
        $this->capsule->addConnection([
            'driver' => $this->config['driver'],
            'host' => $this->config['host'],
            'database' => $this->config['database'],
            'username' => $this->config['username'],
            'password' => $this->config['password'],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
        $this->capsule->setAsGlobal();
    }

    public function boot()
    {
        $this->capsule->bootEloquent();
    }
}