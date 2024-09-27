<?php

    session_start();

    if(empty($_POST['email']) || empty($_POST['password']))
    {
        header("Location: /Log In.php");
        exit();
    }

    require 'connect.php';

    $res = $conn->query('SELECT * FROM Users WHERE email="'.$_POST['email'].'";');

    if($res->num_rows <= 0)
    {
        header("Location: /Log In.php?error=INVALID_EMAIL");
        exit();
    }

    $pswd = $res->fetch_assoc()['password'];

    if($_POST['password'] != $pswd)
    {
        header("Location: /Log In.php?error=INVALID_PASSWORD");
        exit();

    }

    $_SESSION['email'] = $_POST['email'];
    header("Location: /Home.html");
?>