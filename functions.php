<?php
    
    function get_post(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)){
            return json_decode(file_get_contents('php://input'), true);
        }
        else{
            return $_POST;
        }
    }
    
    function debug_array( $array, $exit = true, $tipo = true){
        
        echo '<pre>';
        
        if( $tipo ){
            
            print_r( $array );
        }
        else{
           
            var_dump( $array );
        }
        
        if( $exit ){
            exit;
        }
    }