<?php

function __autoload( $class_name ) {
        
    foreach ( $GLOBALS['applicationDirs'] as $dir ) {
            
        if( file_exists( $dir  . "/" . $class_name . '.php' ) ){
        
            include $dir . "/" . $class_name . '.php';
            break;
        }
    }
}

/*
 * 
 * Funcao para listar pastas/subpastas dinamicamente
 * 
 * function listDirs( $dir = false){
        
    if( $dir ){

        $dir = dir( SITE_PATH . '/' . $dir);
    }
    else{

        $dir = dir( SITE_PATH );
    }

    while( $file = $dir->read() ){

        if( is_dir( $file ) ){

            $dirs[] = $file; 
        }
    }

    foreach ( $GLOBALS['exludeDirs'] as $dirName ) {

        $excludeIndx[] = array_search( $dirName , $dirs);
    }

    foreach ( $excludeIndx as $key ) {

        unset( $dirs[$key] );
    }
}*/