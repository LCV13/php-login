<?php

    session_start();

    session_unset(); #quita la sesion

    session_destroy();# destruye la sesion

    header('Location:  /php-login');

?>