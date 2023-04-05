<?php

require_once 'classes/session.php';
require_once 'models/usermodel.php';

    class SessionController extends Controller {
        
        private $userSession;
        private $username;
        private $userid;
        private $session;
        private $sites;
        private $user;

        function __construct(){
            parent:: __construct();
            $this->init();
        }


        function init(){
            $this->session = new Session();

            $json = $this->getJSONFileConfig();

            $this->sites = $json['sites'];
            $this->defaultSites = $json['default-sites'];

            //funcion para validar si un usuario existe en una sesion y si tiene permisos para acceder a una página
            $this->validateSession();
            
        }

        //transformar el json en un objeto

        private function getJSONFileConfig(){
            $string = file_get_contents('config/access.json');
            $json = json_decode($string, true);
            
            return $json;
        }

        public function validateSession(){
            error_log('SESSIONCONTROLLER::validateSession');
            // si existe la sesión
            if($this->existsSession()){
                $role = $this->getUserSessionData()->getRole();
                // Si la página a entrar es pública
                if($this->isPublic()){
                    $this->redirectDefaultSiteByRole($role);
                }else{
                    if($this->isAuthorized($role)){
                        //Entra a la sesión
                    }else {
                        $this->redirectDefaultSiteByRole($role);
                    }
                }

            }else {
                // no existe la sesión
                if($this->isPublic()){
                    //no pasa nada, lo deja entrar
                }else {
                    // si no es pública
                    header('location: ' . constant('URL') . '');
                }
            }
        }

        function existsSession(){
            if(!$this->session->exists()) return false;
            //Si se crea la sesión y no tiene información (no existe en la aplicacion un escenario así)
            if($this->session->getCurrentUser() == NULL) return false;
            
            $userid = $this->session->getCurrentUser();

            if($userid) return true;
            
            return false;
        }
        
        function getUserSessionData(){
            //trae el id almacenado en la sesión
            $id = $this->session->getCurrentUser();
            $this->user = new UserModel();
            $this->user->get($id);
            error_log('SESSIONCONTROLLER::getUserSessionData -> ' . $this->user->getUsername());
            return $this->user;
        }

        function isPublic(){
        $currentURL = $this->getCurrentPage();
        //preg_replace reemplazara los caracteres seleccionados "", por un "" (string vacio en este caso), de $currenturl
        $currentURL = preg_replace("/\?.*/", "", $currentURL);
            for($i = 0; $i < sizeof($this->sites); $i++){
                if($currentURL == $this->sites[$i]['site'] && $this->sites[$i]['access'] == 'public'){
                    return true;
                }
            }
            return false;
        }

        function getCurrentPage(){
            $actualLink = trim("$_SERVER[REQUEST_URI]");
            $url = explode('/', $actualLink);
            error_log('SESSIONCONTROLLER::getCurrentPage ->' . $url[2]);
            return $url[2];
        }

        private function redirectDefaultSiteByRole($role){
            $url = '';
            for($i = 0; $i < sizeof($this->sites); $i++){
                if($this->sites[$i]['role'] == $role){
                    $url = 'expenses/' . $this->sites[$i]['site'];
                break;
                }
            }
            header('location:' . constant('URL') . $url);
        }

        private function isAuthorized($role){
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace("/\?.*/", "", $currentURL);
            for($i = 0; $i < sizeof($this->sites); $i++){
                if($currentURL == $this->sites[$i]['site'] && $this->sites[$i]['role'] == $role){
                    return true;
                }
            }
            return false;
        }

        function initialize($user){
            $this->session->setCurrentUser($user->getId());
            error_log('SessionController::initialize-> userid ' . $user->getId());
            $this->authorizeAccess($user->getRole());
        }

        function authorizeAccess($role){
            switch($role){
                case 'user':
                    $this->redirect($this->defaultSites['user'], []);
                break;
                case 'admin':
                    $this->redirect($this->defaultSites['admin'], []);
                break;
            }
        }

        function logout(){
            $this->session->closeSession();
        }


    }

?>