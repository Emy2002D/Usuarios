<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/Metodopago.css" /> 
    <title>Confirmación de Pedido</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=ATxv5XHX_DF4Z0c8m-iEv3tWX8JSmCqiV-2EK0eQTyCblq4wZeeht2rbDaAgTY4uEOyouAJ0jetba3Im"></script>
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <h1>Cris's Pizza</h1>
                <ul>
                    <li><a href="cerrar_sesion.php">Adios</a></li> 
                </ul>
            </div>
            </nav>
    </header>

    <section id="confirmacion-pago">
        <div class="containerrr">
            <h2>Confirmación de Pedido</h2>
            <p>Tu pedido se ha realizado con éxito. A continuación, el resumen de tu compra:</p>

            <ul>
                <?php
                // Muestra los detalles del pedido 
                session_start();  // Inicia la sesión 
                if (isset($_SESSION["carrito"]) && !empty($_SESSION["carrito"])) {
                    foreach ($_SESSION["carrito"] as $item) {
                        echo "<li>{$item['nombre']} - $ {$item['precio']}</li>";
                    }
                }
                ?>
            </ul>

            <p>Selecciona tu método de pago:</p>
<form action="procesar_pago.php" method="post">
    <label>
        <input type="radio" name="metodo_pago" value="tarjeta_credito" required>
        Tarjeta de Crédito
    </label>
    <div id="tarjeta_credito_form" style="display: none;">
        <label for="numero_tarjeta">Número de Tarjeta:</label>
        <input type="text" id="numero_tarjeta" name="numero_tarjeta" required>

        <label for="nombre_tarjeta">Nombre en la Tarjeta:</label>
        <input type="text" id="nombre_tarjeta" name="nombre_tarjeta" required>

        <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
        <input type="text" id="fecha_vencimiento" name="fecha_vencimiento" placeholder="MM/AA" required>

        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv" required>
    </div>

    <label>
        <input type="radio" name="metodo_pago" value="efectivo" required>
        Pago en Efectivo
    </label>

    <!-- Mostrar formulario específico para tarjeta de crédito solo si está seleccionado -->
    <div id="paypal-button-container"></div>

    <!-- Confirma el pago -->
    <button type="button" onclick="confirmarPago()">Confirmar Pago</button>
</form>
                
    <script>
        function confirmarPago() {
            var metodoPago = $("input[name='metodo_pago']:checked").val();

            if (metodoPago === "tarjeta_credito") {
                // datos de la tarjeta de credito
                paypal.Buttons({
                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: '500.00' 
                                }
                            }]
                        });
                    },
                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(details) {
                            alert('¡Pago completado por ' + details.payer.name.given_name + '!');
                            window.location.href = 'menu.php'; // Redirige a menu.php
                        });
                    }
                }).render('#paypal-button-container');
            }
        }
    </script>
    <footer>
        <div class="containerr">
            <p>&copy; 2023 Criss Pizza. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
