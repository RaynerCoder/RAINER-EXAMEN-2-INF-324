<!-- 
    PROCESO 3
-->
<?php
    SESSION_START();
    $ci = $_SESSION['usuarioCI'];#ci estudiante
    
    //sql 1
    $sql = "select * from academico.usuario ";
    $sql.= "where ci='$ci'";
    $resultado = mysqli_query($conexion, $sql);
    $registros = mysqli_fetch_array($resultado);
    $nombre = $registros["nombre"];   
    
    
    //sql 2
    $sql = "select * from academico.postulante ";
    $sql.= "where ci='$ci'";
    $resultado = mysqli_query($conexion, $sql);
    $registros = mysqli_fetch_array($resultado);
    $matricula = $registros["matricula"];
    $materiaP = $registros["materiaP"];
    $carrera = $registros["carrera"];


?>


<small>PROCESO 3</small>
<h2>Lista de documentos y requisitos a entregar</h2>
<p>Fecha de entrega de documentos del 03 de Noviembre al 03 de Diciembre.</p>

<p>
    a. Nombre:
    <input type="text" name="nombre" value="<?php echo $nombre;?>"><br><br>
    
    b. Matricula universitaria:
    <input type="text" name="matricula" value="<?php echo $matricula;?>"><br><br>

    c. Carrera:
    <input type="text" name="carrera" value="<?php echo $carrera;?>"><br>

    d. Materia a la que postula:
    <input type="text" name="materiaP" value="<?php echo $materiaP;?>"><br>
</p>