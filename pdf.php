<?php
include ("librerias.php");
         $oProd = new productos();
          $datos = $oProd->eer();
           
$sql = '<page><table class="table table-hover table-responsive table-bordered">
    <tr>
       <td>id</td>
       <td>Descripcion</td>
       <td>Precio</td>
       <td>Unidad</td>
       <td align="center">Guardar</td>
   </tr>';
   while ($valor = $datos->fetch(PDO::FETCH_ASSOC)) {
       echo "<tr>";
       echo "<td>$valor[id_producto]</td>";
       echo "<td>$valor[descripcion]</td>";
       echo "<td>$valor[precio]</td>";
       echo "<td>$valor[unidad]</td>";
       echo "</tr>";
   }
echo '</table></page>';
    require_once(dirname(__FILE__).'/modulos/html2pdf/html2pdf.class.php');
    $html2pdf = new HTML2PDF('P','LETTER','es');
    $html2pdf->WriteHTML($sql);
    $html2pdf->Output('productos.pdf','D');
?>