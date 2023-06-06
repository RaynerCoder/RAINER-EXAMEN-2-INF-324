<?php
    //http://localhost/inf324/TEMA%202/work/flujo.php?flujo=F1&proceso=P1

    include "conexion.php";

    $flujo = $_POST["valor_flujo"];
    $proceso = $_POST["valor_proceso"];
    $pantalla = $_POST['valor_pantalla'];
    include "pantalla/update." . $pantalla . ".php";


    //SI DA BOTON ANTERIOR
    if (isset($_POST['Anterior'])) {
        $sql = "select * from flujo ";
        $sql .= "where flujo='$flujo' and procesoSiguiente='$proceso'";
        $resultado = mysqli_query($conexion, $sql);
        $registros = mysqli_fetch_array($resultado);
        $procesoAnterior = $registros["proceso"]; //obtencion de la base de datos

        SESSION_START();
        $rol = $_SESSION['usuarioRol'];

        $sql = "select count(*) as cantidad from flujo ";
        $sql .= "where flujo='$flujo' and proceso='$procesoAnterior' and rol='$rol'";
        $resultado = mysqli_query($conexion, $sql);
        $registros = mysqli_fetch_array($resultado);
        $cantidad = $registros["cantidad"]; //obtencion de la base de datos

        if ($cantidad > 0) {
            header("Location: flujo.php?flujo=$flujo&proceso=$procesoAnterior");
        } else {
            header("Location: flujo.php?flujo=$flujo&proceso=$proceso");
        }
    }



    //SI DA BOTON SIGUIENTE
    if (isset($_POST["Siguiente"])) {
        
        $sql = "select * from flujo ";
        $sql .= "where flujo='$flujo' and proceso='$proceso'";
        $resultado = mysqli_query($conexion, $sql);
        $registros = mysqli_fetch_array($resultado);
        $procesoSiguiente = $registros["procesoSiguiente"]; //obtencion de la base de datos

        SESSION_START();
        $rol = $_SESSION['usuarioRol'];

        $sql = "select count(*) as cantidad from flujo ";
        $sql .= "where flujo='$flujo' and proceso='$procesoSiguiente' and rol='$rol'";
        $resultado = mysqli_query($conexion, $sql);
        $registros = mysqli_fetch_array($resultado);
        $cantidad = $registros["cantidad"]; //obtencion de la base de datos


        if ($cantidad > 0 and $procesoSiguiente != 'P11') {
            header("Location: flujo.php?flujo=$flujo&proceso=$procesoSiguiente");
        } else {
            header("Location: flujo.php?flujo=$flujo&proceso=$proceso");
        }
    }


    //
    if (isset($_POST["notificar"])) {

        $ciEstudiante = $_POST['ciEstudiante'];
        $notificacionEstudiante = $_POST['notificaEstudiante'];

        $sql = "update academico.postulante set notificacion='$notificacionEstudiante' ";
        $sql .= "where ci='$ciEstudiante'";
        $resultado = mysqli_query($conexion, $sql);

        header("Location: flujo.php?flujo=$flujo&proceso=$proceso");
    }



    //
    if (isset($_POST["habilita_inhabilita"])) {

        $ciEstudiante = $_POST['ciEstudiante'];
        $estado = $_POST['estaHabilitado'];

        $sql = "update academico.postulante set estado='$estado' ";
        $sql .= "where ci='$ciEstudiante'";
        $resultado = mysqli_query($conexion, $sql);

        if($estado == "inhabilitado"){
            $proceso = "P9";
        }
        header("Location: flujo.php?flujo=$flujo&proceso=$proceso");
    }
    
    
    //SI DA BOTON BANDEJA DE ENTRADA
    if (isset($_POST["BandejaEntrada"])) {
        header("Location: bandejaEntrada.php");
    }


        

?>






















    //NOS DIRIGIMOS A ESA PAGINA (ANTERIOR O SIGUIENTE)
    //header("Location: flujo.php?flujo=$flujo&proceso=$procesoSiguiente");
