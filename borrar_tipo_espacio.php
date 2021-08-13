<?php
//require_once './conexion.php';

eliminartipo($_GET['id']);
function eliminartipo($id)
  {  
    require './conexion.php';
    $conexion->query("CALL tipo($id)") or die ("Error al eliminar");
  }


?>

<script type="text/javascript">
  alert("tipo de espacio eliminado");
  window.location.href = 'tipo_espacios';
</script>