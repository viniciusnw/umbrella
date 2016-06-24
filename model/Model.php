<?php

class Model extends DAO{
    
    function getData( array $array ){
        
        $sql = 'SELECT * FROM data where 1';
        
        return $this->execute( $sql );
    }
}

