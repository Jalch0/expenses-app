<?php

require_once 'models/usermodel.php';

class LoginModel extends Model{

    function __constructor(){
        parent::__construct();
    }


    function login($username, $password){
        try {
            $query = $this->prepare('SELECT * FROM users WHERE username = :username');
            $query->execute(['username' => $username]);

            if($query->rowCount() == 1){
                $item = $query->fetch(PDO::FETCH_ASSOC);

                $user = new UserModel();
                $user->from($item);

                if(password_verify($password, $user->getPassword())){
                    error_log('LoginModel::login->success name: ' . $user->getUsername() . ' role = ' . $user->getRole());
                    return $user;
                } else {
                    error_log('LoginModel::login->password no es igual');
                    return NULL;
                }
            } else {
                error_log('LoginModel::login->password no es igual');
            }
        }catch(PDOException $e){
            error_log('LOGINMODEL::login->exception ' . $e);
            return null;
        }
    }
}


?>