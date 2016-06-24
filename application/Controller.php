<?php

abstract class Controller extends View{
    
    private $script_start, 
            $script_end,
            $elapsed_time;
    
    function __construct( ) { }
    
    /*
     * @parans $name, $arguments
     * 
     * Quando um metodo que não existe é chamado em algum controller o erro é enviado
     * 
     * [name]
     * Nome do metodo chamado
     * 
     * [arguments]
     * parametros da chamada deste metodo
     */
    function __call($name, $arguments) {
        
        header('HTTP/1.0 404 Not Found', true, 404);
        
        $this->load_page('404', 'index', '404', 'index');
        
        echo "<pre>"
            . "Error: 404 "
            . "<br>"
            . "Metodo: {$name}"
            . "<br>"
            . "Parametros: ";
            print_r( $arguments );
        echo '</pre>';
    }
    
    
    /*
     * Verifica se a solicitacao do metodo foi via ajax
     * se não, o script para.
     */
    function verifyAjax(){
        
        $apacheRequest = apache_request_headers();
            
        if( ! isset( $apacheRequest['X-Requested-With'] ) ){
            
            #XMLHttpRequest
            exit;
        }
    }
    
    /*
     * @parans $array, $return
     * Printa ou retorna um json
     * 
     * [array]
     * Array: Array que sera transformado em json
     * 
     * [return]
     * bool: false -> printa o json / true -> retorna o json
     */
    function getJson( $array, $return = false ){
        
        if( $return ){
            
            return json_encode( $array );
        }
        else{
            
            print json_encode( $array );
        }
    }
    
    /*
     *  Running time, verifica o tempo de execucao de algum script
     */
    
    #Start count
    public function start(){
        
        list($usec, $sec) = explode(' ', microtime());
        
        $this->script_start = (float) $sec + (float) $usec;
    }
    
    #Stop count
    public function stop(){
         
        list($usec, $sec) = explode(' ', microtime());
        
        $this->script_end = (float) $sec + (float) $usec;
        
        $this->elapsed_time = round($this->script_end - $this->script_start, 5);
        
        echo '<script> alert("';
        
        echo $this->elapsed_time . ' Segundos / ' . round( ((memory_get_peak_usage(true) / 1024) / 1024), 2 ) . 'Mb';
        
        echo '") </script>';
    }
}
