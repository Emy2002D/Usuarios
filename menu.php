<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "hola";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

$pizzas = array();

$sql = "SELECT * FROM pizzas";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pizzas[] = $row;
        }
    } else {
        echo "No hay pizzas disponibles en este momento.";
    }
} else {
    echo "Error al ejecutar la consulta: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bambino Pizza - Menú</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <style>
        #carrito {
            position: fixed;
            top: 0;
            right: 0;
            width: 300px;
            background-color: #f9f9f9;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        #carrito h2 {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .carrito-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .carrito-list li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <h1>Cris's Pizza</h1>
                <ul>
                    <li><a href="vista.html">Inicio</a></li>
                    <li><a href="menu.php">Menú</a></li>                    
                    <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <section id="menu">
        <div class="container">
            <h2>Nuestro Menú</h2>
            <ul class="menu-list">
                <?php foreach ($pizzas as $pizza) { ?>
                <li>
                    <img src="images/<?php echo $pizza['imagen']; ?>" alt="<?php echo $pizza['nombre']; ?>">
                    <h3><?php echo $pizza['nombre']; ?></h3>
                    <p><?php echo $pizza['descripcion']; ?></p>
                    <span>$<?php echo $pizza['precio']; ?></span>
                    <form action="agregar_al_carrito.php" method="post">
                        <input type="hidden" name="producto_id" value="<?php echo $pizza['id']; ?>">
                        <input type="hidden" name="producto_nombre" value="<?php echo $pizza['nombre']; ?>">
                        <input type="hidden" name="producto_precio" value="<?php echo $pizza['precio']; ?>">
                        <button type="submit" name="agregar_al_carrito">Agregar al carrito</button>
                    </form>
                </li>
                <?php } ?>
            </ul>
        </div>
    </section>
    
<!-- Carrito de Compras -->
<section id="carrito">
    <div class="container">
        <h2>Carrito de Compras</h2>
        <ul class="carrito-list">
            <?php
            if (isset($_SESSION["carrito"]) && !empty($_SESSION["carrito"])) {
                foreach ($_SESSION["carrito"] as $item) {
                    echo "<li>{$item['nombre']} - $ {$item['precio']}</li>";
                }
                echo '<li><form action="vaciar_carrito.php" method="post"><button type="submit" name="vaciar_carrito">Vaciar Carrito</button></form></li>';
            } else {
                echo "<li>El carrito está vacío</li>";
            }
            ?>
        </ul>
        <form action="realizar_pago.php" method="post">
            <button type="submit" name="pagar">Pagar</button>
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
