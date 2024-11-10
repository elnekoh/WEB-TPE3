<?php
    
    require_once 'libs/router.php';

    require_once 'app/controllers/task.api.controller.php';
    require_once 'app/controllers/user.api.controller.php';
    require_once 'app/middlewares/jwt.auth.middleware.php';
    $router = new Router();

    //$router->addMiddleware(new JWTAuthMiddleware());

    #                 endpoint        verbo      controller              método
    $router->addRoute('peliculas'      ,            'GET',     'PeliculasApiController',   'getAll');
    $router->addRoute('peliculas/:id'  ,            'GET',     'PeliculasApiController',   'get'   );
    $router->addRoute('peliculas/:id'  ,            'DELETE',  'PeliculasApiController',   'delete');
    $router->addRoute('peliculas'  ,                'POST',    'PeliculasApiController',   'create');
    $router->addRoute('peliculas/:id'  ,            'PUT',     'PeliculasApiController',   'update');
    
    //$router->addRoute('usuarios/token'    ,            'GET',     'UserApiController',   'getToken');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
?>