<?php
require_once __DIR__ . '/model.php';

class ReviewsModel extends Model {
    
    public function getAll(){
        $query = $this->db->prepare('SELECT * FROM reviews');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function get($id){
        $query = $this->db->prepare('SELECT * FROM reviews WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function insert($id_pelicula, $puntuacion, $comentario, $usuario){
        $query = $this->db->prepare('INSERT INTO reviews (id_pelicula, puntuacion, comentario, id_usuario) VALUES (?, ?, ?, ?)');
        $query->execute([$id_pelicula, $puntuacion, $comentario, $usuario]);
        return $this->db->lastInsertId();
    }
}