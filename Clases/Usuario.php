<?php
class Usuario{
    private $id_usuario;
    private $login_usuario;
    private $pass_usuario;
    private $nombre_usuario;
    private $apellido_usuario;
    private $correo_usuario;
    private $edad_usuario;
    private $codigo_perfil;
    private $fechaNacimiento_usuario;
    private $queryins;
    
    function getId_usuario() {
        return $this->id_usuario;
    }

    function getLogin_usuario() {
        return $this->login_usuario;
    }

    function getPass_usuario() {
        return $this->pass_usuario;
    }

    function getNombre_usuario() {
        return $this->nombre_usuario;
    }

    function getApellido_usuario() {
        return $this->apellido_usuario;
    }

    function getCorreo_usuario() {
        return $this->correo_usuario;
    }

    function getEdad_usuario() {
        return $this->edad_usuario;
    }

    function getCodigo_perfil() {
        return $this->codigo_perfil;
    }

    function getFechaNacimiento_usuario() {
        return $this->fechaNacimiento_usuario;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setLogin_usuario($login_usuario) {
        $this->login_usuario = $login_usuario;
    }

    function setPass_usuario($pass_usuario) {
        $this->pass_usuario = $pass_usuario;
    }

    function setNombre_usuario($nombre_usuario) {
        $this->nombre_usuario = $nombre_usuario;
    }

    function setApellido_usuario($apellido_usuario) {
        $this->apellido_usuario = $apellido_usuario;
    }

    function setCorreo_usuario($correo_usuario) {
        $this->correo_usuario = $correo_usuario;
    }

    function setEdad_usuario($edad_usuario) {
        $this->edad_usuario = $edad_usuario;
    }

    function setCodigo_perfil($codigo_perfil) {
        $this->codigo_perfil = $codigo_perfil;
    }

    function setFechaNacimiento_usuario($fechaNacimiento_usuario) {
        $this->fechaNacimiento_usuario = $fechaNacimiento_usuario;
    }

    function __construct($id=NULL, $login=NULL, $pass=NULL, $nombre=NULL, $apellido=NULL, $correo=NULL, $edad=NULL, $codigo=NULL, $fechaNacimiento=NULL) {
        $this->id_usuario = $id;
        $this->login_usuario = $login;
        $this->pass_usuario = md5($pass);
        $this->nombre_usuario = $nombre;
        $this->apellido_usuario = $apellido;
        $this->correo_usuario = $correo;
        $this->edad_usuario = $edad;
        $this->codigo_perfil = $codigo;
        $this->fechaNacimiento_usuario = $fechaNacimiento;
    }
    
    function verificaUsuario() {
        $db = dbconnect();
        $query = "select nombre_usuario from usuarios where login_usuario = ?";
        $sql = $db->prepare($query);
        $sql->bindParam(1, $this->login_usuario);
        $sql->execute();
        if ($sql->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }// Fin VerificaUsuario

    function VerificaAcceso() {
        $db = dbconnect();
        $query = "select nombre_usuario from usuarios where login_usuario=:login and pass_usuario=:pass";
        $sql = $db->prepare($query);
        $sql->bindParam(':login', $this->login_usuario);
        $sql->bindParam(':pass', $this->pass_usuario);
        $sql->execute();
        if ($sql->rowcount() == 1) {
            return true;
        } else {
            return false;
        }
    }// Fin VerificaAcceso
    
    /*function addUsuario() {
        $db = dbconnect();
        $query = " INSERT INTO usuarios SET nombre = ?, apellido = ?, email = ?, usuario =? ,clave =? ,codigo_perfil =?";
        $this->sql = $db->prepare($query);
        $this->sql->bindParam(1, $this->nombre);
        $this->sql->bindParam(2, $this->apellido);
        $this->sql->bindParam(3, $this->email);
        $this->sql->bindParam(4, $this->usuario);
        $this->sql->bindParam(5, $this->clave);
        $this->sql->bindParam(6, $this->codigo_perfil);
        if ($this->sql->execute()) {
            return true;
        } else {
            return false;
        }
    }*/
    
    function agregarUsuario(){
        $db=dbconnect();
        $sqlins="INSERT INTO usuarios (login_usuario,pass_usuario,nombre_usuario,apellido_usuario,correo_usuario,edad_usuario,codigo_perfil,fechaNacimiento_usuario) "
                . "VALUES (:login, :pass, :nombre, :apellido, :correo, :edad, :codigo, :fechaNacimiento)";
        if ($this->VerificaUsuario()){
            echo "Clase Usuario:Agregar: El usuario $this->susuario existe en la base de datos.";
            return false;
        }
        try {
            $queryins=$db->prepare($sqlins);
        }
        catch( PDOException $Exception ) {
            echo "Clase Usuario:ERROR:Preparación Query ".$Exception->getMessage( ).'/'. $Exception->getCode( );
            return false;
        }
        $queryins->bindParam(':login',$this->login_usuario);
        $queryins->bindParam(':pass',$this->pass_usuario);
        $queryins->bindParam(':nombre',$this->nombre_usuario);
        $queryins->bindParam(':apellido',$this->apellido_usuario);
        $queryins->bindParam(':correo',$this->correo_usuario);
        $queryins->bindParam(':edad',$this->edad_usuario);
        $queryins->bindParam(':codigo',$this->codigo_perfil);
        $queryins->bindParam(':fechaNacimiento',$this->fechaNacimiento_usuario);
        try {
                $queryins->execute();
        }
        catch( PDOException $Exception ) {
            echo "Clase Usuario:ERROR:Ejecución Query ".$Exception->getMessage( ).'/'. $Exception->getCode( );
            return false;
        }
        return true;
    }

    function delUsuario() {
        $db = dbconnect();
        $query = "DELETE FROM usuarios WHERE id_usuario=:id_usuario ";
        $this->sql = $db->prepare($query);
        $this->sql->bindParam(1, $this->id_usuario);
        if ($this->sql->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function updUsuario() {
        $db = dbconnect();
        $query = " UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, usuario =? ,clave =? ,codigo_perfil =?  WHERE idadministrador = ?";
        $this->sql = $db->prepare($query);
        $this->sql->bindParam(1, $this->nombre);
        $this->sql->bindParam(2, $this->apellido);
        $this->sql->bindParam(3, $this->email);
        $this->sql->bindParam(4, $this->usuario);
        $this->sql->bindParam(5, $this->clave);
        $this->sql->bindParam(6, $this->codigo_perfil);
        $this->sql->bindParam(7, $this->idadministrador);
        if ($this->sql->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
}// Fin Clase Usuario

?>
