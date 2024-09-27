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
    <h1>
        Добредојдовте назад!
    </h1>
        <form action="./validateLogIn.php" method="POST">
        <div class="inputfield">
            <input type="text" name="email" id="EMAIL_ID" required>
            <span class="labeline" id="emailLabel">Email address</span>
        </div>
        <div class="inputfield">
            <input type="password" name="password" id="PASSWORD_ID" required>
            <span class="labeline" id="passwordLabel">Password</span>
        </div>

        <div>
            <button id="continue" type="sumbit">Продолжете</button>
            <p>Немате корисничка сметка? <a href="./Sign Up.php">Sign up</a></p>
        </div>
    </form>

    <div class="TOSContainer">
        <h5><a href="./Information/Contact.html">Контакт</a></h5>
        <h5>|</h5>
        <h5><a href="./Information/">За нас</a></h5>
        <h5>|</h5>
        <h5><a href="./Information/">Политика на приватност</a></h5>
    </div>

    <?php

            if(!empty($_GET['error']))
            {
                switch($_GET['error'])
                {
                    case 'INVALID_EMAIL':
                        echo '
                            <script>
                                document.getElementById("EMAIL_ID").style.border = "1px solid red";
                                document.getElementById("EMAIL_ID").placeholder = "That email doesn\'t exist!";
                                document.getElementById("emailLabel").style.display = "none"; 
                            </script>
                        ';
                        break;
                    case 'INVALID_PASSWORD':
                        echo '
                            <script>
                                document.getElementById("PASSWORD_ID").style.border = "1px solid red";
                                document.getElementById("PASSWORD_ID").placeholder = "Incorrect Password!";
                                document.getElementById("passwordLabel").style.display = "none"; 
                            </script>
                        ';
                        break;
                    default:
                        break;
                }
            }
        ?>
</body>
</html>