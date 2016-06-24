<?php

/**
 * Classe abstrata de conexão com banco.
 * Constrói conexão 
 * Implementa PDO;
 * 
 * @author: Vinicius Inacio
 * @email: vinicius@quarteldesign.com / viniciusnw@hotmail.com
 */

class DAO extends PDO{
    
    /*
     * @overload Construtor sobrecarregado c/ informações do nosso banco
     * @parans: 
     * $file arquivo c/ configurações de acesso ao banco
     */
    public function __construct( $indice = false, $file = 'DB.ini' ){
        
        $dsn = $this->dsn( $file, $indice );
        
        #Tentativa de conexão
        try{
            parent::__construct($dsn[0], $dsn[1], $dsn[2]);
            parent::setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }
        catch (PDOException $e){
            echo 'Falha na conexão: ' . $e->getMessage();
        }    
    }
    
    protected function execute( $sql ){
        
        try {
            
            $query = $this->prepare($sql);
            
            $query->execute();
            
            $return = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Exception $ex) {
            
            $return = false;
            print $ex->getMessage();
        }
    }


    private function dsn( $file, $indice ){
                 
        #Arquivo de configurações ~parseado~
        $settings = parse_ini_file( $file, TRUE );
        
        if( $indice ){
            
            $db_access = 'db_access_' . $indice;
        }
        else{
            
            $db_access = 'db_access_' . $_SERVER['HTTP_HOST'];
        }
        
        #DNS da conexão
        $dsn  = $settings[$db_access]['driver'] . ':host='; #driver
        $dsn .= $settings[$db_access]['host']   . ';port='; #host
        $dsn .= ( isset( $settings[$db_access]['port'] ) )? $settings[$db_access]['port'] . ';'  : ';'; #porta (tendo ou não)
        $dsn .= 'dbname=' . $settings[$db_access]['schema']; #banco

        #Username
        $uname = $settings[$db_access]['username'];
        #Senha
        $psswd = ( isset( $settings[$db_access]['password'] ) ) ? $settings[$db_access]['password'] : '';
        
        return [ $dsn, $uname, $psswd ];
    }
}