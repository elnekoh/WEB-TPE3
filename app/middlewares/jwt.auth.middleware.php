<?php
    require_once 'libs/jwt.php';

    class JWTAuthMiddleware {
        public function run($req, $res) {
            // obtengo el token desde el header
            $auth_header = $_SERVER['HTTP_AUTHORIZATION']; // Bearer token
            $auth_header = explode(' ', $auth_header); // ["Bearer", "token"]

            // Verificamos que el header sea correcto
            if(count($auth_header) != 2) {
                return;
            }
            if($auth_header[0] != 'Bearer') {
                return;
            }

            // Validamos el token
            $jwt = $auth_header[1];
            $res->user = validateAndDecodeJWT($jwt);
        }
    }
