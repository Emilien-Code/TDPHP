<?php
    namespace loader;
    class Psr4ClassLoader{
        private $prefix;
        private $prePathLen;
        private $pathToClass;
        

        public function __construct(string $prefix, string $prePath){
            $this->prefix = $prePath;
            $this->prePathLen = strlen($prefix);
        }

        public function loadClass(string $path){
            require_once($this->prefix.'/'.substr(str_replace('\\','/',$path) , $this->prePathLen).'.php'); 
        }

        public function register(){
            spl_autoload_register([$this, "loadClass"]);
        }

    }