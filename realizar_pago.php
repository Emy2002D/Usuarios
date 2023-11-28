<?php
session_start();

if (isset($_POST["pagar"])) {
    $total = 0;
?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/pago.css">
        <title>Realizar Pago</title>
    
    </head>
    <body>
    <header>
        <nav>
            <div class="container">
                <h1>Cris's Pizza</h1>
                <ul>
                    <li><a href="menu.php">Menú</a></li>  
                    <li><a href="menu.php">Regresa</a></li>                  
                    <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </nav>
    </header>

        <section id="resumen-pago">
            <div class="containerrr">
                <h2>Resumen de Pago</h2>
                <ul>
                    <?php
                    if (isset($_SESSION["carrito"]) && !empty($_SESSION["carrito"])) {
                        foreach ($_SESSION["carrito"] as $item) {
                            echo "<li>{$item['nombre']} - $ {$item['precio']}</li>";
                            $total += $item['precio'];
                        }
                    }
                    ?>
                </ul>

                <p>Total a Pagar: $ <?php echo number_format($total, 2); ?></p>
                <form action="procesar_pago.php" method="post">
                <button type="submit" name="confirmar_pago">Confirmar Pago</button>
                </form>
            </div>
        </section>

        <footer>
        <div class="containerr">
            <p>&copy; 2023 Criss Pizza. Todos los derechos reservados.</p>
        </div>
    </footer>
    </body>
    </html>

    <?php
}
?>
