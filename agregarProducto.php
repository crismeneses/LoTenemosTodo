<?php
session_start();
include './librerias.php';
?>
<html>
    <head>
    <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/styles.css">
   <link href="bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/dashboard.css">
   <script src="js/jquery-latest.min.js" type="text/javascript"></script>
</head>
<?php include 'menu.php'; ?>
<div class="container-fluid">    
<!-- Content -->
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      <h1 class="page-header">Productos</h1>
      <div>
        <h3>Agregar Producto</h3>
        <form action="acciones/accAddProducto.php" method="POST">
                Descripción:<br>
                <input type="text" name="descripcion" /></br>
                Precio:<br>
                <input type="text" name="precio" /></br>
                Unidad:<br>
                <input type="text" name="unidad" /></br>
                ID Tipo Producto:<br>
                <input type="text" name="id_prod" /></br>
                <input type="submit" class="btn btn-default" name="agregar" value="Agregar">
        </form></br>
      </div>
      <hr></br>
      <form action="acciones/accDelProducto.php" method="POST">
        <div class="table-responsive">  
            <table class="table table-striped">
                <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="select_all">
                            </th>
                            <th>
                                ID Producto
                            </th>
                            <th>
                                Descripción
                            </th>
                            <th>
                                Precio
                            </th>
                            <th>
                                Unidad
                            </th>
                            <th>
                                ID Tipo Producto
                            </th>
                </thead>
                <body>
                <?php
                    $productos = new Producto();
                    while($prod = $productos->Selecciona()){
                ?>
                <tr>
                        <td>
                            <input type="checkbox" class="checkboxCat" name="prod_seleccionado[]" value="<?=$prod->getId_producto()?>" />
                        </td>
                        <td>
                            <?=$prod->getId_producto()?>
                        </td>
                        <td>
                            <?=$prod->getDescripcion()?>
                        </td>
                        <td>
                            <?=$prod->getPrecio()?>
                        </td>
                        <th>
                            <?=$prod->getUnidad()?>
                        </td>
                        <td>
                            <?=$prod->getId_tipo()?>
                        </td>
                </tr>
                <?php }?>
                </table>
        </div></br>
              <select name="accion">
                <option value="">-- Acciones en lote --</option> 
                <option value="borrar">Eliminar</option>
                </select>
                <input type="submit" class="btn btn-default" name="aplicar" value="Aplicar">
          </form>
      </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery-1.11.0.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script type="text/javascript">
	    $(document).ready(function() {
	        $('#select_all').click(function(event) {  //on click
	            if(this.checked) { // check select status
	                $('.checkboxCat').each(function() { //loop through each checkbox
	                    this.checked = true;  //select all checkboxes with class "checkbox1"              
	                });
	            }else{
	                $('.checkboxCat').each(function() { //loop through each checkbox
	                    this.checked = false; //deselect all checkboxes with class "checkbox1"                      
	                });        
	            }
	        });
	    });
	</script>
</body>
</html>