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
}