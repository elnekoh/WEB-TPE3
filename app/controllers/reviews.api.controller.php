<?php
require_once './app/models/reviews.model.php';
require_once './app/models/peliculas.model.php';
require_once './app/models/user.model.php';
require_once './app/views/json.view.php';

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
        $reviews = $this->model->getAll();
        $this->view->response($reviews);
    }

    public function get($req, $res) {
        $id = $req->params->id;
        $review = $this->model->get($id);
        if ($review) {
            $this->view->response($review);
        } else {
            $this->view->response("No existe la reseña con el id={$id}", 404);
        }
    }

    public function insert($req, $res){
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

        $id = $this->model->insert($id_pelicula, $puntuacion, $comentario, $usuario);

        if (!$id) {
            return $this->view->response("Error al insertar la reseña", 500);
        }

        $review = $this->model->get($id);
        return $this->view->response($review, 201);


    }
}