<?php
    const JWT_KEY = 'Hola12222!!!%';
    const JWT_EXP = 3600; // 1hs

    require_once 'libs/router.php';

    require_once 'app/controllers/reviews.api.controller.php';
    require_once 'app/controllers/user.api.controller.php';
    //require_once 'app/middlewares/jwt.auth.middleware.php';
    $router = new Router();

    //$router->addMiddleware(new JWTAuthMiddleware());

    #                 endpoint        verbo      controller              método
    $router->addRoute('reviews'      ,            'GET',     'ReviewsApiController',   'getAll');
    $router->addRoute('reviews/:id'  ,            'GET',     'ReviewsApiController',   'get'   );
    $router->addRoute('reviews'  ,                'POST',    'ReviewsApiController',   'insert');
    $router->addRoute('reviews/:id'  ,            'PUT',     'ReviewsApiController',   'update');
    
    $router->addRoute('user/token'    ,            'GET',     'UserApiController',   'getToken');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
?>