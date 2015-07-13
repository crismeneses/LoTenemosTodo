<?php
include_once (PATHAPP.'/lib/db_funciones.php');

class Producto{
    private $id_producto;
    private $descripcion;
    private $precio;
    private $unidad;
    private $id_tipo;
    private $querysel;
            
    function getId_producto() {
        return $this->id_producto;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getUnidad() {
        return $this->unidad;
    }

    function getId_tipo() {
        return $this->id_tipo;
    }

    function setId_producto($id_producto) {
        $this->id_producto = $id_producto;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setUnidad($unidad) {
        $this->unidad = $unidad;
    }

    function setId_tipo($id_tipo) {
        $this->id_tipo = $id_tipo;
    }

    function __construct($id_producto=NULL, $descripcion=NULL, $precio=NULL, $unidad=NULL, $id_tipo=NULL) {
        $this->id_producto = $id_producto;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->unidad = $unidad;
        $this->id_tipo = $id_tipo;
    }
    
    function Selecciona(){		
        if (!$this->querysel){
        $db=dbconnect();
            $sqlsel="select id_producto,descripcion,precio,unidad,id_tipo from productos";
            $this->querysel=$db->prepare($sqlsel);
            $this->querysel->execute();
        }
        $registro = $this->querysel->fetch();
        if ($registro){
            return new self($registro['id_producto'], $registro['descripcion'], $registro['precio'], $registro['unidad'], $registro['id_tipo']);			
        }
        else {
            return false;
        }//Fin else
    }// Fin Selecciona()
    
    function Agregar(){
        $db=dbconnect();
        $sqlins="INSERT INTO productos (descripcion, precio, unidad, id_tipo) VALUES (:descripcion, :precio, :unidad, :tipo)";
        $this->queryins=$db->prepare($sqlins);
        $this->queryins->bindParam(':descripcion',$this->descripcion);
        $this->queryins->bindParam(':precio',$this->precio);
        $this->queryins->bindParam(':unidad',$this->unidad);
        $this->queryins->bindParam(':tipo',$this->id_tipo);
        return $this->queryins->execute();
    }// Fin funcion Agregar
        
    function Elimina($id){
        $db=dbconnect();
        $sqldel="delete from productos where id_producto=:id";
        $querydel=$db->prepare($sqldel);
        $querydel->bindParam(':id',$id);
        $valaux=$querydel->execute();
        return $valaux;
    }// Fin Elimina
    
}// Fin clase Producto
?>
