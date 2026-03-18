<?php

session_start();

$_SESSION = [];

session_destroy();


$_SESSION['message'] = 'Вы успешно вышли'

        header("Location: ../login.php");
        exit();