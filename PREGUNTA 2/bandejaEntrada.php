<?php
    include "conexion.php";
    include_once "template/cabecera.php";

    SESSION_START();
    $usuarioActivo = $_SESSION['usuarioSesion'];
    $ci = $_SESSION['usuarioCI'];
    $rol = $_SESSION['usuarioRol'];


    $sql="select * from flujousuario ";
    $sql.="where usuario='".$usuarioActivo."' ";
    //$sql.="and fechafin is null ";
    $resultado=mysqli_query($conexion, $sql);
?>

<table class="table">
    <thead>
        <tr>
            <th>FLUJO</th>
            <th>PROCESO</th>
            <th>OPERACION</th>
        </tr>
    </thead>

    <tbody>
        <?php
            while($registro = mysqli_fetch_array($resultado)){
                echo "<tr>";
                echo "<td>".$registro['flujo']."</td>";
                echo "<td>".$registro['proceso']."</td>";
                echo "<th>";
                echo "<a class='btn btn-primary' href='flujo.php?flujo=".$registro['flujo']."&proceso=".$registro['proceso']."' role='button' type='submit'> Dirigirse </a>";
                echo "</th>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<form action="index.php"><input type="submit" value="Cerrar Sesion" name="cerrar"></form>

<?php
    include_once "template/pie.php";
?>

