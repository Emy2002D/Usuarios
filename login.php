<?php
session_start();

if (isset($_SESSION["nombre_usuario"])) {
    header("Location: vista.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once "conexion.php";

    $correo = $_POST["correo"];
    $password = $_POST["password"];

    $sql = "SELECT id, nombre, contrasena FROM usuarios WHERE correo = '$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["contrasena"])) {
            $_SESSION["nombre_usuario"] = $row["nombre"]; 
            header("Location: vista.html");
            exit();
        } else {
            $error_message = "Contraseña incorrecta";
            $_SESSION["error_message"] = $error_message;
        }
    } else {
        $error_message = "Usuario no encontrado";
        $_SESSION["error_message"] = $error_message;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/c9f5871d83.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="CSS/Estilos.css" /> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Login</title>


</head>
<body>
  <div class="back"></div>
  <div class="login">
    <div class="content">
      <p>Cris's Pizza</p>
    </div>
    <div class="home">
      <div class="account">
        <h2>Login</h2> 
      </div>
      <?php if (!empty($error_message)) { ?>
        <div class="error-message"><?php echo $error_message; ?></div>
      <?php } ?>
      <form action="login.php" method="POST">        
        <div class="input">
          <i class="fa-solid fa-envelope"></i>
          <input type="text" name="correo" class="input-mail" autocomplete="off" required>
          <label for="input">Email</label>
        </div>
        <div class="input">
          <i class="fa-solid fa-lock"></i>
          <input type="password" name="password" class="input-mail" autocomplete="off" required>
          <label for="input">Password</label>
          <button type="button" class="show-password-button" onclick="togglePasswordVisibility()">Show</button>
        </div>

        <div class="input">
          <input type="submit" class="button" value="Log in">
        </div>
      </form>

      <div class="log">
        <p>¿Aún no tienes una cuenta?</p><br>
        <a href="registro.php">Regístrate aquí</a>
      </div>
    </div>
  </div>

  <script>
    function togglePasswordVisibility() {
      const passwordInput = document.querySelector('input[name="password"]');
      const passwordButton = document.querySelector('.show-password-button');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordButton.textContent = 'Hide';
      } else {
        passwordInput.type = 'password';
        passwordButton.textContent = 'Show';
      }
    }

    const backgrounds = [
      'images/login.jpg',   
      'images/Pizzalove.jpg',  
      'images/fondo5.jpeg',  
    ];

    let currentBackground = 1;

    function changeBackground() {
      currentBackground = (currentBackground + 1) % backgrounds.length;
      document.body.style.backgroundImage = `url('${backgrounds[currentBackground]}')`;
    }

    setInterval(changeBackground, 2000);
  </script>
</body>
</html>
