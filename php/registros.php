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

        $validarEmail = $conexion -> query("SELECT * FROM registros_sesion WHERE email='$email'");
        $claveEmcriptada = md5($clave);
        if( $validarEmail -> num_rows > 0 ){
            
            echo "El correo ya se encuentra en uso";

        }else{
            $sql = "INSERT INTO registros_sesion (nombre_completo, email, clave)
            VALUES ('$nombreCompleto', '$email', '$claveEmcriptada')";
   
            if( $conexion -> query($sql)){
               header('location: ../views/index.html');
               exit;
            }else {
               header('location: ../views/registro.html');
            }
        }

    }

    $conexion -> close();

?>