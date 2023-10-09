<?php

    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "expense_control";

    $conexion = new mysqli($server, $user, $pass, $database);

    if( $conexion -> connect_errno ){
        echo "Algo anda mal, intentalo mas tarde";
    }else {
        echo "Conexion exitosa";
    }

    if( $_SERVER['REQUEST_METHOD'] === 'POST'){
        
        $nombreCompleto = $_POST['nombrecompleto'];
        $email = $_POST['email'];
        $clave = $_POST['clave'];

        $sql = "INSERT INTO registros_sesion (nombre_completo, email, clave)
         VALUES ('$nombreCompleto', '$email', '$clave')";

         if( $conexion -> query($sql)){
            echo "Registro Exitoso";
         }else {
            echo "Registro Fallido";
         }

    }

    $conexion -> close();

?>