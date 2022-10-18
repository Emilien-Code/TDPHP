<?php

    class HttpRequest extends \AbstractHttpRequest {
    
        function __construct() {

            foreach ($_SERVER as $k => $v){
                if($k==="SCRIPT_NAME")
                    $script_name = $v;
                if($k==="SCRIPT_FILENAME")
                    $root = dirname($v);
                if($k==="PATH")
                    $path_info = $v;
                if($k==="REQUEST_METHOD")
                    $method = $v;
                
            }

            $get = $_GET;
            $post = $$_POST;



            print_r($_GET."<br/>");
            print_r($_POST."<br/>");


            echo($script_name) ."<br/>";
            echo($root) ."<br/>";
            echo($path_info) ."<br/>";
            echo($method) ."<br/>";
            
        }
    
    }