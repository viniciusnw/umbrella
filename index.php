<?php

include('./autoload.php');
include('./config.php');
include('./functions.php');

# Salva a url solicitada em uma global
if( isset( $_GET['c'] ) ) {

    $GLOBALS['url']    = explode( "/", $_GET['c'] );
    $GLOBALS['url'][0] = ucfirst( $GLOBALS['url'][0] );

    foreach ( $GLOBALS['url'] as $key => $value ){

        if( $value == "" ){

            unset( $GLOBALS['url'][ $key ] );
        }
    }
}

# Estrutura qual objeto deve ser instanciado com base na url 
if( is_array( $GLOBALS['url'] ) ){
        
    foreach ( $GLOBALS['url'] as $indice => $valor){

        $controller_ = ($indice == 0) ?  $valor : $controller_;
        $method      = ($indice == 1) ?  $valor : $method;

        if($indice != 0 && $indice != 1){
            $parans[] = $valor;
        }
    }
}

/*
 * Verifica se a classe solicitada existe, se sim ela é instanciada
 * se não um erro 404 é enviado
 */
if( class_exists($controller_) ){
    
    $controller = new $controller_();
    
    /*
     * chama o metodo que carregara a view
     */
    header('Content-Type: text/html; charset=utf-8');
    $controller->{ $method }( $parans );
}
else{
    
    header('HTTP/1.0 404 Not Found', true, 404);
}