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
      echo '<span style="color: #eee"> Usuario creado correctamente</span>';
    } else {
      echo '<span style="color: #eee"> Lo sentimos el usuario no existe </span>';
    }
  }
?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
  </head>

  <body style="background-color: #14161E;">

    <?php require 'header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1 style="color: #eee">Regístrese</h1>
    <span style="color: #eee">o <a href="login.php" style="color: #eee">Inicie sesión</a></span>

    <form action="signup.php" method="POST">
      <input name="email" type="text" placeholder="Enter your email">
      <input name="password" type="password" placeholder="Enter your Password">
      <input type="submit" value="Registrarse">
    </form>

  </body>
</html>