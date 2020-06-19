<?php 
    require 'database.php';

    $message = '';

    if(!empty($_POST['email']) && !empty($_POST['password'])){#Si los campos que estoy requiriendo(en este caso 'email' y 'password') a traves del metodo post NO estan vacios...
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt-> bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); #password_hash cifra la contraseña
        $stmt->bindParam(':password', $password);


        if($stmt->execute()){
            $message = "Successfully created new user";
        }else{
            $message = "Sorry there must have been an issue creating your account";
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
    <title>Sign Up</title>
</head>
<body>
    <?php
        require 'partials/header.php'
    ?>

    <?php if(!empty($message)): ?>
    <p><?= $message ?></p> <!--Es ?= para que lo interprete-->
    <?php endif; ?>


    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>

    <form action="signup.php" method="post">
        <input type="text" name="email" placeholder="Enter your email">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirm_password" placeholder="Confirm your password">
        <input type="submit" value="Send">
</form>
</body>
</html>