<?php
//Recibe los datos del front y ejecuta la consulta SQL para guardarlos en la base de datos
    include "conexion.php";  
    date_default_timezone_set("America/Bogota");
    
    $cont_nombre = $_POST['cont_nombre'];
    $cont_apellido = $_POST['cont_apellido'];
    $cont_tel = $_POST['cont_tel'];
    $cont_telsec = $_POST['cont_telsec'];

    $con = conectar();
    $insert = "INSERT INTO contacto (cont_nombre, cont_apellido, cont_tel, cont_telsec) VALUES('$cont_nombre', '$cont_apellido', '$cont_tel', '$cont_telsec')";
    
    $log = mysqli_query($con,$insert);
    $id = mysqli_insert_id($con);

    $respuestaValidacion = array();
    $respuestaValidacion["respuesta"] = $log;
    $respuestaValidacion["respuesta1"] = $insert;
    $respuestaValidacion["idRegistro"] = $id;
    //Retorna una respuesta de confimación al front

   //Convertimos el array a JSON y lo imprimimos para que pueda recuperarlo el JS
   $respuesta = json_encode($respuestaValidacion);
   echo $respuesta;
?>
