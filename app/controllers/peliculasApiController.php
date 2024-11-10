<?php
require_once './app/models/peliculas.model.php';
require_once './app/views/json.view.php';

class TaskApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new PeliculasModel();
        $this->view = new JSONView();
    }
}