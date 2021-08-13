<?php
//require_once './conexion.php';

eliminartipo($_GET['id']);
function eliminartipo($id)
{
  require_once './conexion.php';
  $sentencia = "DELETE FROM tipos_espacio WHERE id='" . $id . "' ";
  $conexion->query($sentencia) or die("Error al eliminar" );
}



?>

<script type="text/javascript">
  alert("tipo de espacio eliminado");
  window.location.href = 'tipo_espacios';
</script>