<?php
class Login extends SessionController{
        function __construct(){
            parent::__construct();
            error_log('Login::construct -> inicio del login');
        }

        function render(){
            error_log('Login::render -> Carga el index de login');
            $this->view->render('login/index');
        }

        function authenticate(){
            if($this->existPOST(['username', 'password'])){
                $username = $this->getPost('username');
                $password = $this->getPost('password');

                if($username == '' || empty($username) || $password == '' || empty($password)){
                    return $this->redirect('', ['error' => Errors::ERROR_LOGIN_AUTHENTICATE_EMPTY]);
                }

                $user = $this->model->login($username, $password);

                if($user != NULL){
                    $this->initialize($user);
                }else{ 
                    return $this->redirect('', ['error' => Errors::ERROR_LOGIN_AUTHENTICATE_DATA]);
                }
            }else{
                return $this->redirect('', ['error' => Errors::ERROR_LOGIN_AUTHENTICATE]);
            }
        }

}
?>