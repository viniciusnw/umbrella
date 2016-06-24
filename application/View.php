<?php
/**
 * Classe view.
 * Metodos para que classes gerem visões 
 * 
 * @author: Vincius Marques Inacio
 * @email: vinicius@quarteldesign.com / viniciusnw@hotmail.com
 */

abstract class View{
    
    private $title;
    
    /*
     * @parans $header, $page, $footer, $data
     * [header]
     * String: nome do headers a ser carregado
     * 
     * [page]
     * String: pagina a ser carregada (./view/$page)
     * Array: pagina a ser carregada a partir do indice (./view/$indice/$page)
     * 
     * [footer]
     * String: nome do footer a ser carregado
     * 
     * [data]
     * dados a serem carregados na view
     */
    public function load_page($_title_ = false, $_header_ = false, $_page_ = false, $_footer_ = false, $_data_ = null ){
        
        #Seta o titulo da pagina
        $this->title = $_title_;
        
        #Dados
        if( is_array($_data_) ){
            
            extract( $_data_ );
            unset( $_data_ );
        }
        
        #Header
        if( $_header_ ){
            
            $this->get_header( $_header_ );
        }
        
        #Page
        if( is_array($_page_) ){
           
            foreach ($_page_ as $_local_ => $_valor_) {
                
                include SITE_PATH . '/view/' . $_local_ . '/'. $_valor_ . '.php';
            }
        }
        else{
            
            include SITE_PATH . '/view/'. $_page_ . '.php';
        }
        
        #Footer
        if( $_footer_ ){
            
            $this->get_footer( $_footer_ );
        }
    }

    /*
     * Retorna o titulo da pagina
     */
    public function get_title(){
        
        return $this->title;
    }
    
    /*
     * 
     * @parans $get_header
     * String: header
     */
    private function get_header( $get_header ){
        
        include SITE_PATH . '/view/headers/header-' . $get_header . '.php';
    }
    
    /*
     * 
     * @parans $get_footer
     * String: footer
     */
    private function get_footer( $get_footer ){
        
        include SITE_PATH . '/view/footers/footer-' . $get_footer . '.php';
    }
    
    /*
     * @parans $get_css
     * String: Nome do arquivo css extra a ser carregado no header
     */
    public function get_css( $get_css = false ){
        
        #Bootstrap Core CSS
        echo '<link href="' . RAIZ . 'view/assets/components/bootstrap/css/bootstrap.min.css" rel="stylesheet">';
        
        #Font-Awesome
        echo '<link href="' . RAIZ . 'view/assets/components/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">';
        
        #All css min
        echo '<link href="' . RAIZ . 'view/assets/css/min/all.min.css" rel="stylesheet">';

        #Custom CSS
        if( $get_css ){
            
            if( is_array($get_css) ){

                foreach ($get_css as $css){

                    echo '<link href="' . RAIZ . 'view/assets/css/custom-' . $css . '.css" rel="stylesheet">';
                }
            }
            else{

                echo '<link href="' . RAIZ . 'view/assets/css/custom-' . $get_css . '.css" rel="stylesheet">';
            }
        }
    }
    
    /*
     * @parans $get_js
     * String: Nome do arquivo js extra a ser carregado no foter
     */
    public function get_js( $get_js = false ){
        
        #jQuery
        echo '<script src="' . RAIZ . 'view/assets/components/jquery/jquery.js"></script>';

        #Bootstrap Core JavaScript
        echo '<script src="' . RAIZ . 'view/assets/components/bootstrap/js/bootstrap.min.js"></script>';
        
        #All js min
        echo '<script src="' . RAIZ . 'view/assets/js/min/concat.min.js"></script>';
        
        #Custom JS
        if( $get_js ){
            
            if( is_array($get_js) ){

                foreach ($get_js as $js){
                    echo '<script src="' . RAIZ . 'view/assets/js/custom-' . $js . '.js"></script>';
                }
            }
            else{

                echo '<script src="' . RAIZ . 'view/assets/js/custom-' . $get_js . '.js"></script>';
            }
        }
    }
}
