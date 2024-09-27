<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Innova</title>
  <link rel="stylesheet" href="CSS/TOS.css">
  <link rel="stylesheet" href="CSS/Entry.css">
</head>
<body>
    <form method="POST" action="./validateSignUp.php">
    <h1>
        Направете корисничка сметка!
    </h1>
        <div class="inputfield">
            <input type="text" name="email" id="EMAIL_ID" required>
            <span class="labeline" id="emailLabel">Email address</span>
        </div>
        <div class="inputfield">
            <input type="text" name="username" id="USERNAME_ID" required>
            <span class="labeline" id="userLabel">Username</span>
        </div>
        <div class="inputfield">
            <input type="password" name="password" id="PASSWORD_ID" required>
            <span class="labeline" id="passwordLabel">Password</span>
        </div>
        <div>
            <button id="continue" type="submit">Продолжете</button>
            <p>Имате веќе корисничка сметка? <a href="./Log In.php">Sign in</a></p>
        </div>
    </form>

    <div class="TOSContainer">
        <h5><a href="./Information/">Контакт</a></h5>
        <h5>|</h5>
        <h5><a href="./Information/">За нас</a></h5>
        <h5>|</h5>
        <h5><a href="./Information/">Политика на приватност</a></h5>
    </div>


    <?php

function GetEmail()
{
    if(!empty($_GET['email']))
    {
        $email = "\"".$_GET['email']."\"";

        echo
        "
            <script>
                var email = {$email};
                document.getElementById(\"EMAIL_ID\").value=email;
            </script>
        ";
    }
}

function GetUsername()
{
    if(!empty($_GET['username']))
    {
        $username = "\"".$_GET['username']."\"";

        echo
        "
            <script>
                var username = {$username};
                document.getElementById(\"USERNAME_ID\").value=username;
            </script>
        ";
    }
}

if(empty($_GET['error']))
    exit();

$error = $_GET["error"];

switch($error)
{
    case 'INVALID_EMAIL':
        echo '
            <script>
                document.getElementById("EMAIL_ID").style.border="1px solid red";
                document.getElementById("EMAIL_ID").placeholder="Enter your Email Address";
                document.getElementById("emailLabel").style.display = "none";
            </script>
        ';
        break;
    case 'INVALID_USERNAME':
         echo '
            <script>
                document.getElementById("USERNAME_ID").style.border="1px solid red";
                document.getElementById("USERNAME_ID").placeholder="Enter your username";
                document.getElementById("userLabel").style.display = "none";
            </script>
        ';
        GetEmail();
        break;
    case 'INVALID_PASSWORD':
        echo '
            <script>
                document.getElementById("PASSWORD_ID").style.border="1px solid red";
                document.getElementById("PASSWORD_ID").placeholder="Enter your password";
                document.getElementById("passwordLabel").style.display = "none";
            </script>
        ';
        GetEmail();
        GetUsername();
        break;
    case 'USERNAME_TAKEN':
        echo '
            <script>
                document.getElementById("USERNAME_ID").style.borderColor = "red";
                document.getElementById("userLabel").style.display = "none";
                document.getElementById("USERNAME_ID").placeholder="Username is already taken!";
            </script>
        ';

        GetEmail();
        break;
    case 'EMAIL_TAKEN':
        echo '
            <script>
                document.getElementById("EMAIL_ID").style.borderColor = "red";
                document.getElementById("emailLabel").style.display = "none";
                document.getElementById("EMAIL_ID").placeholder="Email address is already used!";
            </script>
        ';
        GetUsername();
        break;
    default:
        break;
}
?>

</body>
</html>