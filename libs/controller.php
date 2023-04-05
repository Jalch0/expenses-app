<?php

class Controller{

    function __construct(){
        $this->view = new View();
    }

    function loadModel($model){
        $url = 'models/' . $model . 'model.php';

        if(file_exists($url)){
            require_once $url;

            $modelName = $model . 'Model';
            $this->model = new $modelName();
        }
    }

    // Cuando reciba params, reemplaza a isset
    function existPOST($params){
        foreach($params as $param){
            if(!isset($_POST[$param])){
                error_log('CONTROLLER::existsPost => No existe el parametro' . $param);
                return false;
            }
        }
        return true;
    }

    function existGET($params){
        foreach($params as $param){
            if(!isset($_GET[$param])){
                error_log('CONTROLLER::existsGet => No existe el parametro' . $param);
                return false;
            }
        }
        return true;
    }

    function getGet($name){
        return $_GET[$name];
    }

    function getPost($name){
        return $_POST[$name];
    }

    //Cuando se complete un dato, la funcion redirigirá al usuario a:
    function redirect($route, $mensajes){
        $data = [];
        $params = '';

        forEach($mensajes as $key => $mensaje){
            array_push($data, $key . '=' . $mensaje);
        }
        $params = join('&', $data);

        // ?NOMBRE=Marcos&apellido=Rivas

        if($params !== ''){
            $params = '?' . $params;
        }

        header('Location: ' . constant('URL') . $route . $params);

    }

}

?>