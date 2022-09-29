<?php
    namespace iutnc\spotibuse\exception;
    class InvalidPropertyValueException extends \Exception{
        public function __construct(){
            parent::__construct("durée invalid");
        }
    }