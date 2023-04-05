<?php

class Errores extends Controller{
    function __construct(){
        parent::__construct();
        error_log('Errores::construct -> inicio de errores');
    }

    function render(){
        $this->view->render('errores/index');
    }
}

?>