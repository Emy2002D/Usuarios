<?php
// guardar_pedido.php

// Verifica si se está recibiendo una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Obtén el monto y productos del POST
    $monto = $_POST["monto"];
    $productos = $_POST["productos"];

    // Obtén el ID de usuario y nombre de la sesión (asumiendo que ya iniciaste la sesión)
    session_start();
    $usuario_id = $_SESSION["usuario_id"];
    $nombre_cliente = obtenerNombreUsuario($usuario_id);

    // Realiza la conexión a la base de datos (ajusta según tus credenciales)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hola";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la conexión a la base de datos
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Prepara la consulta SQL para insertar el pedido en la tabla 'pedidos'
    $sql = "INSERT INTO pedidos (usuario_id, nombre_cliente, monto, productos) 
            VALUES ('$usuario_id', '$nombre_cliente', '$monto', '$productos')";

    // Ejecuta la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Pedido guardado correctamente en la base de datos";
    } else {
        echo "Error al guardar el pedido: " . $conn->error;
    }

    // Cierra la conexión a la base de datos
    $conn->close();
} else {
    // Si no es una solicitud POST, redirige a algún lugar apropiado
    header("Location: error.php");
    exit();
}

function obtenerNombreUsuario($usuario_id) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hola";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT nombre FROM usuarios WHERE id = '$usuario_id'";

    // Ejecuta la consulta
    $result = $conn->query($sql);

    // Verifica si se encontró el usuario y obtén el nombre
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre_usuario = $row["nombre"];
    } else {
        // Si no se encuentra el usuario, puedes manejarlo de alguna manera apropiada
        $nombre_usuario = "Usuario no encontrado";
    }

    // Cierra la conexión a la base de datos
    $conn->close();

    // Retorna el nombre del usuario
    return $nombre_usuario;
}

?>
