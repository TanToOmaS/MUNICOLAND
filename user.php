<?php

include_once 'DB.php';

class User extends DB
{

    private $nombre;
    private $username;

    public function userExists($user, $pass)
    {
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE USUARIO = :user');
        $query->execute(['user' => $user]);

        if ($query->rowCount()) {
            $userDb = $query->fetch(PDO::FETCH_ASSOC);
            $passwordDb = $userDb["PASSWORD"];
            if(password_verify($pass, $passwordDb)){
                return true;
            }else{
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    public function setUser($user)
    {
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE USUARIO = :user');
        $query->execute(['user' => $user]);

        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['NOMBRE'];
            $this->username = $currentUser['USUARIO'];
        }
    }

    public function getNombre()
    {
        return $this->nombre;
    }
}
?>

<script type="text/javascript" src="assets/js/util.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>