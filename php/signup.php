<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>


<!DOCTYPE html>
<html>
  <head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'> 
  </head>


  <!--<body>
    <form action="signup.php" method="POST">
      <input name="email" type="text" placeholder="Enter your email">
      <input name="password" type="password" placeholder="Enter your Password">
      <input name="confirm_password" type="password" placeholder="Confirm Password">
      <input type="submit" value="Submit">
    </form>
  </body>-->


  
<body>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <!--<h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>-->

    
    <div class="container-form sign-up">
        <div class="welcome-back">
            <div class="message">
                <h2>Bienvenido a UANFILMS</h2>
                <p>Si ya tienes una cuenta por favor inicia sesión aquí!</p>
                <button class="sign-up-btn">Iniciar Sesión</button>
            </div>
        </div>

        <form action="signup.php" class="formulario" method="POST">
            <br>
            <h2 class="create-account">Crear una cuenta</h2>
            <br>
            <p class="cuenta-gratis">Digite sus datos</p>
            <input name="email" type="text" placeholder="Email">
            <input name="password" type="password" placeholder="Contraseña">
            <input class="button" type="submit" value="Registrarse">
        </form>
        

    </div>
    <div class="container-form sign-in">
        <form class="formulario">
            <h2 class="create-account">Iniciar Sesión</h2>
            <p class="cuenta-gratis">¿Aún no tienes una cuenta?</p>
            <input type="email" placeholder="Email">
            <input type="password" placeholder="Contraseña">
            <input type="submit" value="Iniciar Sesión">
        </form>
        <div class="welcome-back">
            <div class="message">
                <br>
                <br>
                <br>
                <br>
                <br>
                <h2>Bienvenido de nuevo</h2>
                <p>Si aún no tienes una cuenta, por favor regístrese aquí</p>
                <button class="sign-in-btn">Registrarse</button>
            </div>
        </div>
    </div>
    <script src="../script.js"></script>
</body>
</html>