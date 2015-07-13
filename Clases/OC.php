<?php

class OC{
    private $id_oc;
    private $fecha_emision;
    private $total_oc;
    private $estado;
    private $id_usuario;
    
    function getId_oc() {
        return $this->id_oc;
    }

    function getFecha_emision() {
        return $this->fecha_emision;
    }

    function getTotal_oc() {
        return $this->total_oc;
    }

    function getEstado() {
        return $this->estado;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function setId_oc($id_oc) {
        $this->id_oc = $id_oc;
    }

    function setFecha_emision($fecha_emision) {
        $this->fecha_emision = $fecha_emision;
    }

    function setTotal_oc($total_oc) {
        $this->total_oc = $total_oc;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function __construct($id=NULL, $fecha=NULL, $total=NULL, $est=NULL, $id_us=NULL) {
        $this->id_oc = $id;
        $this->fecha_emision = $fecha;
        $this->total_oc = $total;
        $this->estado = $est;
        $this->id_usuario = $id_us;
    }
    
    function Selecciona(){		
        if (!$this->querysel){
        $db=dbconnect();
            $sqlsel="select id_oc,fecha_emision, total_oc, estado from orden_compras";
            $this->querysel=$db->prepare($sqlsel);
            $this->querysel->execute();
        }
        $registro = $this->querysel->fetch();
        if ($registro){
            return new self($registro['id_oc'], $registro['fecha_emision'], $registro['total_oc'], $registro['estado']);			
        }
        else {
            return false;
        }//Fin else
    }// Fin Selecciona()
    
    function Agregar(){
        $db=dbconnect();
        $sqlins="INSERT INTO orden_compras (fecha_emision,total_oc,estado) VALUES (:fecha, :total, :estado)";
        $this->queryins=$db->prepare($sqlins);
        $this->queryins->bindParam(':fecha',$this->fecha_emision);
        $this->queryins->bindParam(':total',$this->total_oc);
        $this->queryins->bindParam(':estado',$this->estado);
        return $this->queryins->execute();
    }// Fin funcion Agregar
        
    function Elimina($id){
        $db=dbconnect();
        $sqldel="delete from orden_compras where id_oc=:id";
        $querydel=$db->prepare($sqldel);
        $querydel->bindParam(':id',$id);
        $valaux=$querydel->execute();
        return $valaux;
    }// Fin Elimina
}
?>
