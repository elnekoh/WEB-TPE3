<?php
require_once __DIR__ . '/model.php';

class UserModel extends Model {
 
    public function getUserByUsername($username) {    
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE username = ?");
        $query->execute([$username]);
    
        $user = $query->fetch(PDO::FETCH_OBJ);
    
        return $user;
    }

    //yo pienso que la contraseña deberia hashearla el controlador.
    //asi que la contraseña no se hashea aca, tiene que llegar hasheada.
    public function addUser($username, $password, $role) {
        $query = $this->db->prepare('INSERT INTO usuarios(username, password, role) VALUES(?, ?, ?)');
        $query->execute([$username, $password, $role]);
    }

    public function getUserById($id) {
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $query->execute([$id]);
    
        $user = $query->fetch(PDO::FETCH_OBJ);
    
        return $user;
    }
}
