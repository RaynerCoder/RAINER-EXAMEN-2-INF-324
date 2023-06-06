<!-- 
    PROCESO 4
-->

<?php
    SESSION_START();
    $ci = $_SESSION['usuarioCI'];
    
    $sql = "select * from academico.usuario ";
    $sql.= "where ci='$ci'";
    $resultado = mysqli_query($conexion, $sql);
    $registros = mysqli_fetch_array($resultado);
    $imagen = $registros["documentoPos"];
  
?>


<small>PROCESO 4</small>
<h2>Entregar Documentos</h2>
<input type="file" name="imagen" accept="image/png, .jpeg, .jpg, image/gif"><br><br>

<img src="data:image/jpeg;base64,<?php echo base64_encode($imagen); ?>" alt="Subir Documentos" width="200" heiht="200" /><br><br><br>