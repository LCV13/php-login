<?php
    session_start();

    require 'database.php';

    if (isset($_SESSION['user_id'])) {#si existe la sesion del usuario
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;#En esta variable se van a almacenar los datos. Se inicia con el valor null

    if (count($results) > 0) {#si los datos son mayores a cero, o sea, si no estan vacios...
        $user = $results;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <!--Custom CSS-->
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Welcome to your app</title>
</head>
<body>
    
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?> <!--Si los datos no estan vacios-->
    <br>Welcome. <?= $user['email'] ?> <!--Se muestra un mensaje de bienvenida con el correo-->
    <br>You are Successfully Logged In 
    <a href="logout.php">logout</a>

    <?php else:  ?>
    <h1>Please Login or SignUp</h1>

    <a href="login.php">Login</a> or
    <a href="signup.php">SignUp</a>
    <?php endif; ?>
</body>
</html>