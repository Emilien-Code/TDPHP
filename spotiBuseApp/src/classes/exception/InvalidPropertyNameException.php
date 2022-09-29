<?php 
    namespace iutnc\spotibuse\exception;
    class InvalidPropertyNameException extends \Exception{
        public function __construct(){
            parent::__construct("Champ inexstant");
        }
    }