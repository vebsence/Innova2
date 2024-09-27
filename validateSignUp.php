<?php

    if($_SERVER["REQUEST_METHOD"] === "POST")
    {

        if(empty($_POST['email']))
        {
            header("Location: /Sign Up.php?error=INVALID_EMAIL");
            exit();
        }

        if(empty($_POST['username']))
        {
            header("Location: /Sign Up.php?error=INVALID_USERNAME&email=".$_POST['email']);
            exit();
        } 

        if(empty($_POST["password"]))
        {
            header("Location: /Sign Up.php?error=INVALID_PASSWORD&email=".$_POST['email']."&username=".$_POST['username']);
            exit();
        }

        require 'connect.php';
        
        $input_name = $_POST['username'];
        $input_email = $_POST['email'];
        $input_password = $_POST['password'];

        $res = $conn->query('SELECT * FROM Users WHERE Username="'.$input_name.'";');

        if($res->num_rows >= 1)
        {
            header("Location: /Sign Up.php?error=USERNAME_TAKEN&email=".$_POST['email']."&username=".$_POST['username']);
            exit();
        }

        $res = $conn->query('SELECT * FROM Users WHERE Email="'.$input_email.'"');

        if($res->num_rows >= 1)
        {
            header("Location: /Sign Up.php?error=EMAIL_TAKEN&email=".$_POST['email']."&username=".$_POST['username']);
            exit();
        }

        try
        {
            $conn->query('INSERT INTO Users (Username, Email, Password) VALUES ("'.$input_name.'", "'.$input_email.'", "'.$input_password.'");');
        } catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
    else
    {
        header("Location: /register.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./CSS/validateSignUp.css">
        <title>Successful Registration</title>
    </head>
    <body>
        <div class="register-content">
            <img src="image/green_tick_icon.png" alt="Green Tick Icon" width=250 height=250>
            <h1>You have successfully registered</h1>
            <p>You may now log in</p>
            <a href="Log In.php">Log In</a>
        </div>
    </body>
</html>