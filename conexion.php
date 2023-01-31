<?php
//Ejecuta la conexión al servidor cada que esta se requiera
    function conectar() {

        $server = "localhost";
        $user = "root";    
        $password = "";
        $dataBase = "contactos";
        
        $con = mysqli_connect($server, $user, $password);
        if (!$con) {
            die("Conexion Fallida: " . mysqli_connect_error() . "<br>");
        } else {
            echo "";
        }
        
        mysqli_select_db($con, $dataBase);
        if (!$dataBase) {
            die ("Conexion fallida con la base de datos" . mysqli_connect_error() . "<br>");
        } else {
            echo "";
        }
        
        return $con;
        
    }
    
?>