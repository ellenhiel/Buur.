<?php 
    include_once('core/autoload.php');
    session_start();
    
    if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
      header("Location: index.php");   
    }

    if(isset($_POST["logIn"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        if(User::canLogin($email, $password)) {
            $_SESSION['email'] = $email;
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = User::getUsernameByEmail($email);

            header("Location: home.php");
        } else {
            $error = "Email or password is incorrect.";
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Font links from google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=RocknRoll+One&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/general.css">

    <title>Log in</title>
</head>
<body>
    <header>
        <img id="nav_logo" src="assets/logo.png">
    </header>
    
    <section class="login_registration_section">
        <form action="" method="post">

            <div>
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="bv. buur@gmail.com">
            </div>

            <div>
                <label for="password">Wachtwoord</label>
                <input type="password" id="password" name="password" placeholder="************">
            </div>

            <input type="submit" name="logIn" id="btn_submit" value="inloggen">

        </form>
    
        <a href="registration.html">Nog geen account? <br> Registreer hier</a>
    </section>
</body>
</html>