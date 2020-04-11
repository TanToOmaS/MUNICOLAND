<?php

class UserSession{

    public function __construct(){
        session_start();
    }

    public function setCurrentUser($user){
        $_SESSION['user'] = $user;
    }

    public function getCurrentUser(){
        return $_SESSION['user'];
    }

    public function closeSession(){
        session_unset();
        session_destroy();
        // Borrar cookie PHPSESSID si existe para forzar la recreacion
        if (isset($_COOKIE[session_name()])){
            setcookie(session_name(), "", time() - 3600, "/");
        }
    }
}

?>