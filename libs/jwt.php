<?php
    function createJWT($payload) {
        // Header
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        // Payload
        $payload = json_encode($payload);

        // Base64Url
        $header = base64_encode($header);
        $header = str_replace(['+', '/', '='], ['-', '_', ''], $header);
        $payload = base64_encode($payload);
        $payload = str_replace(['+', '/', '='], ['-', '_', ''], $payload);

        // Firma
        $signature = hash_hmac('sha256', $header . "." . $payload, 'mi1secreto', true);
        $signature = base64_encode($signature);
        $signature = str_replace(['+', '/', '='], ['-', '_', ''], $signature);

        // JWT
        $jwt = $header . "." . $payload . "." . $signature;
        return $jwt;
    }

    function validateAndDecodeJWT($jwt) {
        $jwt = explode('.', $jwt); // [header, payload, signature]

        if(count($jwt) != 3) {
            return false;
        }

        $header = $jwt[0]; // $header
        $payload = $jwt[1]; // $payload (contenido)
        $signature = $jwt[2]; // $signature (firma)

        $valid_signature = hash_hmac('sha256', $header . "." . $payload, JWT_KEY, true);
        $valid_signature = base64_encode($valid_signature);
        $valid_signature = str_replace(['+', '/', '='], ['-', '_', ''], $valid_signature);
        
        // Verificamos que la firma sea válida
        if($signature != $valid_signature) {
            return false;
        }

        // Decodificamos el payload
        $payload = base64_decode($payload); 
        $payload = json_decode($payload); 

        return $payload;
    }

    function isTokenExpired ($payload) {
        return $payload->exp < time();
    }