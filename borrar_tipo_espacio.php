




  <?php

eliminartipo($_GET['id']);
function eliminartipo($id)
{   
    require_once './conexion.php';
    $sentencia = "DELETE FROM tipos_espacio WHERE id='".$id."' ";
    $conexion->query($sentencia) or die ("Error al eliminar".mysqli_error($conexion));
}



?>
  
  <script type="text/javascript">
    alert("tipo de espacio eliminado");
    window.location.href='tipos_espacios.php';
    </script>
