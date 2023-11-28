<?php
session_start();

if (isset($_POST["vaciar_carrito"])) {
    // Vaciar el carrito
    unset($_SESSION["carrito"]);
}

header("Location: menu.php");
exit();
?>
