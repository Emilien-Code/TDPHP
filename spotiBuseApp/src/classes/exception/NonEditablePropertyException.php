<?php 
    namespace iutnc\spotibuse\exception;
    class NonEditablePropertyException extends \Exception{
        public function __construct(){
            parent::__construct("Champ non modifiable");
        }
    }