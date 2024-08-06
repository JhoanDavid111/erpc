<?php

class Usuario {
    private $peremail;
    private $perpass;
    private $db;

    public function __construct() {
        $this->db = conexion::get_conexion();
    }

    function setEmail($email) {
        $this->peremail = $email;
    }

    function setPassword($password) {
        $this->perpass = $password;
    }

    function getPassword() {
        return sha1(md5($this->perpass));
    }

    // Método para autenticar con usuario y contraseña
    public function login($email) {
        $result = false;        
        $password = $this->getPassword();        
        $malito = $email;        

        $sql = "SELECT * FROM persona WHERE (pernom = :email OR peremail = :email) AND actemp = 1 LIMIT 1";
        $sth = $this->db->prepare($sql);
        $sth->execute(array(':email' => $malito));
        $usuario = $sth->fetchObject();

        if ($usuario && $sth->rowCount() == 1) {
            $vpass = $usuario->perpass;

            if ($password == $vpass) {
                $result = $usuario;
            }
        }
        
        return $result;
    }

    // Método para verificar el email proporcionado por Google
    public function verificarEmail($email) {
        $result = false;

        if (strpos($email, '@canalcapital.gov.co') !== false) {
            $sql = "SELECT * FROM persona WHERE peremail = :email AND actemp = 1 LIMIT 1";
            $sth = $this->db->prepare($sql);
            $sth->execute(array(':email' => $email));
            $usuario = $sth->fetchObject();

            if ($usuario && $sth->rowCount() == 1) {
                $result = $usuario;
            }
        }

        return $result;
    }
}
