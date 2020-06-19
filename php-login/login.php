<?php 

    session_start(); #se inicializa la sesion desdpues de la verificacion y el almacenamiento de los datos. Ahora se puede usar la sesion

    require 'database.php';

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
    
        $message = '';

        if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){#verifica si la contraseña con la que se inicia sesion es igual a la del registro. Si es asi, entonces...
            $_SESSION['user_id'] = $results['id'];#entonces que almacene los datos en la sesion
            header("Location: /php-login");
        }else{
            $message = "Sorry, those credentials do not match";#se muestra este mensaje si no existe el usuario ni la contraseña es correcta
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Login</title>
</head>
<body>
    <?php
        require 'partials/header.php' #requiero el header en todos las secciones
    ?>

    <h1>Login</h1>
    <span>or <a href="signup.php">SignUp</a></span>

    <?php  if(!empty($message)): ?>
    <p><?= $message ?></p>
    <?php endif; ?>

<form action="login.php" method="POST">
    <input type="text" name="email" placeholder="Enter your email">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="Send">
</form>
</body>
</html>