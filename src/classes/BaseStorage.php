<?php

    namespace src\classes;

    use src\interfaces\StorageInterface;

    abstract class BaseStorage implements StorageInterface
    {
        /**
         * @var array $config
         */
        public $config;

        public function __construct($configs)
        {
            foreach ($configs as $name => $config) {
                $this->config[$name] = $config;
            }
        }
    }