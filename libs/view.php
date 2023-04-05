<?php

class View{

    function __construct(){

    }
    // $nombre = archivo de views , $data = parametros que queremos incluir en la vista que se muestre en pantalla
    function render($nombre, $data = []){
        $this->d = $data;

        $this->handleMessages();

        require 'views/' . $nombre . '.php';
    }

    //Mensajes de error y success en una operación
    private function handleMessages(){
        if(isset($_GET['success']) && isset($_GET['error']) ){
            //error
        }else if(isset($_GET['success'])){
            $this->handleSuccess();
        }else if(isset($_GET['error'])){
            $this->handleError();
        }
    }
    //función de error, recorre el archivo errors.php en busca del mensaje dado por la url
    private function handleError(){
        $hash = $_GET['error'];
        $error = new Errors();

        if($error->existsKey($hash)){
            $this->d['error'] = $error->get($hash);
        }

    }
    //función de success, recorre el archivo success.php en busca del mensaje dado por la url
    private function handleSuccess(){
        $hash = $_GET['success'];
        $success = new Success();

        if($success->existsKey($hash)){
            $this->d['success'] = $success->get($hash);
        }

    }

    public function showMessages(){
        $this->showErrors();
        $this->showSuccess();
    }

    public function showErrors(){
        if(array_key_exists('error', $this->d))
        echo '<div class="error">'.$this->d['error'].'</div>';
    }
    public function showSuccess(){
        if(array_key_exists('success', $this->d))
        echo '<div class="success">'.$this->d['success'].'</div>';
    }
}

?>