<?php

    require_once './app/models/user.model.php';
    require_once './app/views/json.view.php';
    require_once './libs/jwt.php';

    class UserApiController {
        private $model;
        private $view;

        public function __construct() {
            $this->model = new UserModel();
            $this->view = new JSONView();
        }

        public function getToken($req, $res){
            // obtengo el usuario y contraseña desde el header
            $auth_header = $_SERVER['HTTP_AUTHORIZATION']; // "Basic dXN1YXJpbw=="
            $auth_header = explode(' ', $auth_header); // ["Basic", "dXN1YXJpbw=="]

            // Verificamos que el header sea correcto
            if(count($auth_header) != 2) {
                return $this->view->response('Los encabezados de autenticación son incorrectos.', 401);
            }
            if($auth_header[0] != 'Basic') {
                return $this->view->response('Los encabezados de autenticación son incorrectos.', 401);
            }

            // Decodifico el usuario y contraseña que estan en base64
            $user_pass = base64_decode($auth_header[1]); // "usuario:password"
            $user_pass = explode(':', $user_pass); // ["usuario", "password"]
            $pass = $user_pass[1]; // "password"

            // Busco El usuario en la base
            $user = $this->model->getUserByUsername($user_pass[0]);

            // Checkeo la contraseña y que el usuario exista
            if($user == null || !password_verify($pass, $user->password)) {
                return $this->view->response("Error en los datos ingresados", 401);
            }
            
            // Generamos el token
            $token = createJWT(array(
                'id' => $user->id,
                'username' => $user->username,
                'role' => $user->role,
                'iat' => time(),
                'exp' => time() + JWT_EXPIRATION_TIME
            ));

            return $this->view->response($token);
        }
    }