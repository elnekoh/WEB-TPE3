<?php
require_once './app/models/reviews.model.php';
require_once './app/models/peliculas.model.php';
require_once './app/models/user.model.php';
require_once './app/views/json.view.php';

define('PAGE_SIZE', 5);
define('PUNTUACION_MAX', 5);
define('PUNTUACION_MIN', 1);

class ReviewsApiController {
    private $model;
    private $view;
    private $peliculaModel;
    private $userModel;

    public function __construct() {
        $this->model = new ReviewsModel();
        $this->view = new JSONView();
        $this->peliculaModel = new PeliculasModel();
        $this->userModel = new UserModel();
    }

    public function getAll($req, $res) {
        $orderBy = false;
        $order = false;
        $page = false;

        //para paginar
        if(isset($req->query->page) && is_numeric($req->query->page) && $req->query->page > 0){
            $page = $req->query->page;
        }

        //para ordenar
        if(isset($req->query->orderBy)){
            $orderBy = $req->query->orderBy;
        }
        if(isset($req->query->order) ){
            $order = $req->query->order;
        }

        //obtengo las reseñas
        $reviews = $this->model->getAll($orderBy, $order, $page);

        //muestra las reseñas
        $this->view->response($reviews);
    }

    public function get($req, $res) {
        //obtengo el id de la reseña
        $id = $req->params->id;

        //obtengo la reseña
        $review = $this->model->get($id);

        //muestra la reseña si existe, si no, 404
        if ($review) {
            $this->view->response($review);
        } else {
            $this->view->response("No existe la reseña con el id={$id}", 404);
        }
    }

    public function insert($req, $res){
        //verifica que el usuario sea admin
        $this->verifyUser($res);

        //verifica que los parametros sean correctos
        $parametros = $this->verify_params($req);

        //inserta la reseña
        $id = $this->model->insert($parametros['id_pelicula'], $parametros['puntuacion'], $parametros['comentario'], $parametros['usuario']);

        //si no se inserta, devuelve un error
        if (!$id) {
            return $this->view->response("Error al insertar la reseña", 500);
        }

        //devuelve la reseña insertada
        $review = $this->model->get($id);
        return $this->view->response($review, 201);
    }

    public function update($req, $res){
        //verifica que el usuario sea admin
        $this->verifyUser($res);

        //verifica que se haya ingresado el id de la reseña
        if (empty($req->params->id)) {
            return $this->view->response('Falta el id de la reseña', 400);
        }
        //obtengo el id de la reseña
        $id = $req->params->id;

        //verifica que los parametros sean correctos
        $parametros = $this->verify_params($req);

        // verifica que la reseña exista
        if (!$this->model->get($id)) {
            return $this->view->response('No existe la reseña con el id ingresado', 400);
        }

        //actualiza la reseña
        $resultado = $this->model->update($id, $parametros['id_pelicula'], $parametros['puntuacion'], $parametros['comentario'], $parametros['usuario']);

        //si no se actualiza, devuelve un error, si se actualiza, devuelve la reseña actualizada
        if ($resultado) {
            $review = $this->model->get($id);
            return $this->view->response($review);
        }else{
            return $this->view->response("Error al editar la reseña", 500);
        }    
    }

    // verifica que el usuario sea admin
    private function verifyUser($res){
        if(!$res->user){
            return $this->view->response("No autorizado", 401);
        }
        if($res->user->role != 'admin'){
            return $this->view->response("No autorizado", 403);
        }
        if (isTokenExpired($res->user->exp)){
            return $this->view->response("Token expirado", 401);
        }
    }

    // Verifica que los parametros que llegan para insert y update sean correctos
    private function verify_params($req){
        if (empty($req->body->id_pelicula)) {
            return $this->view->response('Es necesario el id de la pelicula', 400);
        }
        if (empty($req->body->puntuacion)) {
            return $this->view->response('Faltó el puntaje deseado', 400);
        }

        $id_pelicula = $req->body->id_pelicula;
        $puntuacion = $req->body->puntuacion;
        $comentario = null;
        $usuario = null;

        if (!$this->peliculaModel->getPelicula($id_pelicula)) {
            return $this->view->response('No existe la pelicula con el id ingresado', 400);
        }

        if ($puntuacion < PUNTUACION_MIN || $puntuacion > PUNTUACION_MAX) {
            return $this->view->response('La puntuación debe estar entre 1 y 5', 400);
        }

        if (!empty($req->body->comentario)) {
            $comentario = $req->body->comentario;
        }

        if (!empty($req->body->id_usuario)){
            $usuario = $req->body->id_usuario;
            if (!$this->userModel->getUserById($usuario)) {
                return $this->view->response('id usuario errónea', 400);
            }
        }

        return array(
            "id_pelicula" => $id_pelicula,
            "puntuacion" => $puntuacion,
            "comentario" => $comentario,
            "usuario" => $usuario
        );
    }

}