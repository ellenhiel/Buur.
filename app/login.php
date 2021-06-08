<?php 
    include_once('core/autoload.php');
    session_start();
    
    if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
      header("Location: home.php");   
    }

    if(!empty($_POST)) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        if(User::canLogin($email, $password)) {
            $_SESSION['email'] = $email;
            $_SESSION['loggedIn'] = true;
            $_SESSION['userId'] = User::getUserIdByEmail($email);
            $_SESSION['lon'] = $_POST["userLon"];
            $_SESSION['lat'] = $_POST["userLat"];

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

    <p id="locationError">De applicatie heeft je locatie nodig om te starten <br>Je kan dit aanzetten in de applicatie settings</p>
    
    <section class="login_registration_section">
        <form id="formLogin" action="" method="post" onsubmit="submitPost(event)">

            <div>
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="bv. buur@gmail.com">
            </div>

            <div>
                <label for="password">Wachtwoord</label>
                <input type="password" id="password" name="password" placeholder="************">
            </div>

            <input type="hidden" id="userLon" name="userLon"></input>
            <input type="hidden" id="userLat" name="userLat"></input>

            <input type="submit" name="logIn" id="btn_submit" value="inloggen">

        </form>
    
        <a href="registration.php">Nog geen account? <br> Registreer hier</a>
    </section>

    <script src="js/sessionLocation.js"></script>
</body>
</html>