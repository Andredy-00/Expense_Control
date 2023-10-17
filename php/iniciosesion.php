<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "expense_control";

    $conexion = new mysqli($server, $user, $pass, $database);

    // Verificar conexion
    if( $conexion -> connect_errno ){
        echo "Algo anda mal, intentalo mas tarde";
    }else {
        echo "Conexion Exitosa";
    }

    if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
        
        $email = $_POST['email'];
        $clave = md5($_POST['clave']);
        $validarEmail = $conexion -> query("SELECT * FROM registros_sesion WHERE email='$email'");
        $validarClave = $conexion -> query("SELECT * FROM registros_sesion WHERE clave='$clave'");

        if( $validarEmail -> num_rows > 0 && $validarClave -> num_rows > 0 ){
            header('location: ../views/main.html');
        }else{
            header('location: ../views/index.html');
        }
    }

    $conexion -> close();

?>