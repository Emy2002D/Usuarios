<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Registro.css">
    <title>Bambino Pizza - Registro</title>
</head>
<body>
    <section id="register">
        <div class="container">
            <h2>Registro</h2>
            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $name = $_POST["name"];
                $lastname = $_POST["lastname"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $phone = $_POST["phone"];
                $colonia = $_POST["colonia"];
                $municipio = $_POST["municipio"];
                $codigo_postal = $_POST["codigo_postal"];

                // Validaciones
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<p>Error: El correo electrónico no es válido.</p>";
                } elseif (empty($name) || empty($lastname) || empty($password) || empty($phone) || empty($colonia) || empty($municipio) || empty($codigo_postal)) {
                    echo "<p>Error: Todos los campos son obligatorios.</p>";
                } else {
                    // Conexión a la base de datos
                    $conn = new mysqli("localhost", "root", "", "hola");

                    if ($conn->connect_error) {
                        die("Error de conexión: " . $conn->connect_error);
                    }

                    // Hash de la contraseña
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Inserción en la base de datos
                    $sql = "INSERT INTO usuarios (nombre, apellido, correo, contrasena, telefono, colonia, municipio, codigo_postal)
                            VALUES ('$name', '$lastname', '$email', '$hashed_password', '$phone', '$colonia', '$municipio', '$codigo_postal')";

                    if ($conn->query($sql) === TRUE) {
                        echo "<p>Registro exitoso. Ahora puedes <a href='login.php'>iniciar sesión</a>.</p>";
                    } else {
                        echo "<p>Error al registrar el usuario: " . $conn->error . "</p>";
                    }

                    $conn->close();
                }
            }
            ?>
            <form action="registro.php" method="POST">
              

<label for="name">Nombre:</label>
    <input type="text" id="name" name="name" required>

    <label for="lastname">Apellido:</label>
    <input type="text" id="lastname" name="lastname" required>

    <label for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>

    <label for="phone">Teléfono:</label>
    <input type="tel" id="phone" name="phone" required>

    <label for="colonia">Colonia:</label>
    <input type="text" id="colonia" name="colonia" required>

    <label for="municipio">Municipio:</label>
    <input type="text" id="municipio" name="municipio" required>

    <label for="codigo-postal">Código Postal:</label>
    <input type="text" id="codigo-postal" name="codigo_postal" required>  
                <button type="submit">Registrarme</button><br><br>
                <a href="login.php">Regresarme al inicio</a>
            </form>
        </div>
    </section>

    <script src="js/scripts.js"></script>
</body>
</html>



