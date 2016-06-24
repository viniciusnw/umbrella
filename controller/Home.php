<?php

class Home extends Controller{
    
    function index( ){
        
        /*
         * Load view
         * 
         * 1 - title
         * 2 - header
         * 3 - page
         * 4 - footer
         */
        $this->load_page('MVC - started', 'index', 'Home', 'index');
    }
}