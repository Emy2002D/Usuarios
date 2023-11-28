<?php
session_start();

if (isset($_POST['agregar_al_carrito'])) {
    // Obtener información del producto seleccionado
    $producto_id = $_POST['producto_id'];
    $producto_nombre = $_POST['producto_nombre'];
    $producto_precio = $_POST['producto_precio'];

    // Crear un array para representar el producto
    $producto = array(
        'id' => $producto_id,
        'nombre' => $producto_nombre,
        'precio' => $producto_precio
    );

    // Agregar el producto al carrito en la sesión
    $_SESSION["carrito"][] = $producto;

    // Redirigir de vuelta a la página del menú
    header("Location: menu.php");
    exit();
}else {
    // Si se intenta acceder directamente a este archivo sin enviar datos del formulario, redirige al menú
    header("Location: menu.php");
    exit();
}
?>
