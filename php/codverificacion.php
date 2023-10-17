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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        // Verificar si el correo electrónico existe
        $email = $_POST['email'];
        $resultado = $conexion->query("SELECT * FROM registros_sesion WHERE email = '$email'");

        if ($resultado->num_rows > 0) {
            // Generar un código de verificación único
            $codigo = bin2hex(random_bytes(10));

            // Enviar el código de verificación al correo electrónico del usuario
            mail($email, 'Código de verificación', "Tu código de verificación es: $codigo");

            header('location: ../views/cambiopass.html');
    }else {
        echo 'Este correo electrónico no está registrado.';
    }

  }
}
?>