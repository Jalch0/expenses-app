<?php

require_once 'models/usermodel.php';

    class Signup extends SessionController{

        function __construct(){
            parent::__construct();
            error_log('signup::construct -> inicio del signup');
        }

        function render(){
            error_log('signup::render -> Carga el index de signup');
            $this->view->render('login/signup');
        }

        function newUser(){
            if($this->existPOST(['username', 'password'])){

                $username = $this->getPost('username');
                $password = $this->getPost('password');

                if($username == '' || empty($username) || $password == '' || empty($password)){
                    return $this->redirect('signup', ['error' => Errors::ERROR_SIGNUP_NEWUSER_EMPTY]);
                }
                $user = new UserModel();
                $user->setUsername($username);
                $user->setPassword($password);
                $user->setRole('user');

                if($user->exists($username)){
                    $this->redirect('signup', ['error' => Errors::ERROR_SIGNUP_NEWUSER_EXISTS]);
                }else if($user->save()){
                    $this->redirect('', ['success' => Success::SUCCESS_SIGNUP_NEWUSER]);
                }else {
                    $this->redirect('signup', ['error' => Errors::ERROR_SIGNUP_NEWUSER]);
                }
            }else{
                $this->redirect('signup', ['error' => Errors::ERROR_SIGNUP_NEWUSER]);
            }
        }
    }
?>