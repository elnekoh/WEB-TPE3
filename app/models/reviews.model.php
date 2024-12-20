<?php
require_once __DIR__ . '/model.php';

class ReviewsModel extends Model {
    
    public function getAll($orderBy = false, $order = false, $page = false){
        $sql = 'SELECT * FROM reviews';

        if($orderBy){
            $orderBy = strtolower($orderBy);
            switch($orderBy) {
                case 'puntuacion':
                    $sql .= ' ORDER BY puntuacion';
                    break;
                case 'id_pelicula':
                    $sql .= ' ORDER BY id_pelicula';
                    break;
                case 'id_usuario':
                    $sql .= ' ORDER BY id_usuario';
                    break;
                case 'comentario':
                    $sql .= ' ORDER BY comentario';
                    break;
                case 'id':
                    $sql .= ' ORDER BY id';
                    break;
            }
        }

        if($order){
            $order = strtolower($order);
            switch($order) {
                case 'asc':
                    $sql .= ' ASC';
                    break;
                case 'ascendente':
                    $sql .= ' ASC';
                    break;
                case 'desc':
                    $sql .= ' DESC';
                    break;
                case 'descendente':
                    $sql .= ' DESC';
                    break;
            }
        }

        if($page){
            $sql .= ' LIMIT '. PAGE_SIZE .' OFFSET ' . ($page - 1) * PAGE_SIZE;
        }

        $query = $this->db->prepare($sql);
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

    public function update($id, $id_pelicula, $puntuacion, $comentario, $usuario){
        $query = $this->db->prepare('UPDATE reviews SET id_pelicula = ?, puntuacion = ?, comentario = ?, id_usuario = ? WHERE id = ?');
        return $query->execute([$id_pelicula, $puntuacion, $comentario, $usuario, $id]);
    }
}