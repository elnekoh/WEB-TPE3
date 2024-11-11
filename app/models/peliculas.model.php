<?php
require_once __DIR__ . '/model.php';

class PeliculasModel extends Model {

    public function getPeliculas() {
        $query = $this->db->prepare('SELECT * FROM peliculas');
        $query->execute();
        $peliculas = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $peliculas;
    }

    public function getPelicula($id) {
        $query = $this->db->prepare('SELECT * FROM peliculas WHERE id=?');
        $query->execute([$id]);
        $pelicula = $query->fetch(PDO::FETCH_OBJ); 
    
        return $pelicula;
    }

    public function getPeliculasByGenero($id_genero) {
        $query = $this->db->prepare('SELECT * FROM peliculas WHERE id_genero=?');
        $query->execute([$id_genero]);
        $peliculas = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $peliculas;
    }

    public function insertarPelicula($titulo, $descripcion, $director, $anio, $id_genero, $filePath = null) {
        if ($filePath) {
            $query = $this->db->prepare('INSERT INTO peliculas(titulo, descripcion, director, anio, id_genero, path_img) VALUES(?,?,?,?,?,?)');
            $query->execute([$titulo, $descripcion, $director, $anio, $id_genero, $filePath]);
            return $this->db->lastInsertId();
        }else{
            $query = $this->db->prepare('INSERT INTO peliculas(titulo, descripcion, director, anio, id_genero) VALUES(?,?,?,?,?)');
            $query->execute([$titulo, $descripcion, $director, $anio, $id_genero]);
        }
        
        return $this->db->lastInsertId();
    }

    public function borrarPelicula($id) {
        $query = $this->db->prepare('DELETE FROM peliculas WHERE id=?');
        $query->execute([$id]);
    }

    public function editarPelicula($id, $titulo, $descripcion, $director, $anio, $id_genero, $filePath = null) {
        if($filePath){
            $query = $this->db->prepare('UPDATE peliculas SET titulo=?, descripcion=?, director=?, anio=?, id_genero=?, path_img=? WHERE id=?');
            $query->execute([$titulo, $descripcion, $director, $anio, $id_genero,$filePath, $id]);
        }else{
            $query = $this->db->prepare('UPDATE peliculas SET titulo=?, descripcion=?, director=?, anio=?, id_genero=? WHERE id=?');
            $query->execute([$titulo, $descripcion, $director, $anio, $id_genero, $id]);
        }
    }

    public function peliculaExists($id) {
        $query = $this->db->prepare('SELECT COUNT(*) FROM peliculas WHERE id = ?');
        $query->execute([$id]);
        return $query->fetchColumn() > 0;
    }
         //prueba
    public function getGeneros(){
        $query = $this->db->prepare("SELECT * FROM generos");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
