<?php
    session_start();
    if($_SESSION["logado"] != true){
        header("Location: areaLogin.php");
        exit;
    }

    session_destroy();
    session_unset();
    header("Location: areaLogin.php");
?>