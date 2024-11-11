<?php
require_once './app/models/Reviews.model.php';
require_once './app/views/json.view.php';

class ReviewsApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new ReviewsModel();
        $this->view = new JSONView();
    }

    public function getAll($req, $res) {
        $peliculas = $this->model->getAll();
        $this->view->response($peliculas);
    }

    public function get($req, $res) {
        $id = $req->params->id;
        $pelicula = $this->model->get($id);
        if ($pelicula) {
            $this->view->response($pelicula);
        } else {
            $this->view->response("No existe la pelicula con el id={$id}", 404);
        }
    }
}