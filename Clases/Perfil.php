<?php
class Perfil {
    private $id_perfil;
    private $descripcion_perfil;
    
    function getId_perfil() {
        return $this->id_perfil;
    }

    function getDescripcion_perfil() {
        return $this->descripcion_perfil;
    }

    function setId_perfil($id_perfil) {
        $this->id_perfil = $id_perfil;
    }

    function setDescripcion_perfil($descripcion_perfil) {
        $this->descripcion_perfil = $descripcion_perfil;
    }

    function __construct($id_perfil=NULL, $descripcion_perfil=NULL) {
        $this->id_perfil = $id_perfil;
        $this->descripcion_perfil = $descripcion_perfil;
    }

    function leer() {
        $query = "SELECT  id_perfil, descripcion_perfil FROM perfil ORDER BY descripcion_perfil";
        $sql = $this->connect->prepare($query);
        $sql->execute();
        return $sql;
    }// Fin leer

    function buscarPorId() {
        $query = "SELECT descripcion_perfil FROM perfil WHERE id_perfil = ? limit 0,1";
        $sql = $this->connect->prepare($query);
        $sql->bindParam(1, $this->id_perfil);
        $sql->execute();
        $fila = $sql->fetch(PDO::FETCH_ASSOC);
        $this->descripcion_perfil = $fila['descripcion_perfil'];
    }// Fin Buscar por id
}
?>
