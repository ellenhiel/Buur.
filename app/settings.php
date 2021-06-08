<?php 
    include_once('core/autoload.php');
    include_once('isLoggedIn.inc.php'); 

    $userId = $_SESSION['userId'];

    if(!empty($_FILES["pfp_input"]['tmp_name'])) {
        try {
            $currentDirectory = getcwd();
            $uploadDirectory = "/profile_pictures/"; //Directory where image will be located

            $finalFileName = $userId."_picture_".date("YmdHis").".jpg";

            if($_FILES["pfp_input"]["type"] != "image/png"){
                $fileName = $finalFileName;
            } else {
                $fileName = $userId."_picture_".date("YmdHis").".jpg";
            }
            
            $fileTmpName  = $_FILES['pfp_input']['tmp_name'];
            
            $user = new User;
            $user->setPicture($fileName); // $fileName // $_POST['pfp_input']
            $user->setUserId($userId);

            $user->changePicture();
            header("Location: profile.php");

            $fileSaveQuality = 80; 

            $uploadPath = $currentDirectory . $uploadDirectory . $fileName;

            move_uploaded_file($fileTmpName, $uploadPath);

            if($_FILES["pfp_input"]["type"] != "image/png"){
                $imageToResize = imagecreatefromjpeg("profile_pictures/".$fileName);
            } else {
                $imageToResize = imagecreatefrompng("profile_pictures/".$fileName);
                unlink("profile_pictures/".$fileName);
            }

            imagejpeg($imageToResize, 'profile_pictures/'.$finalFileName, $fileSaveQuality);
            imageDestroy($imageToResize);
        }

        catch (Throwable $e) {
            $error = $e->getMessage();
        }
    }     
    
    if(!empty($_POST['username'])) {
        try {
            $user = new User;
            $user->setUsername($_POST['username']);
            $user->setUserId($userId);

            $user->changeUsername();
            header("Location: profile.php");
        }

        catch (Throwable $e) {
            $error = $e->getMessage();
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

    <title>Settings</title>
</head>
<body>
    <!-- start top bar -->
    <header class="green_header">
        <h2>Instellingen</h2>
        <a href="profile.php"><img id="exit_icon" src="assets/icons/exit_white_icon.png"></a>
    </header>
    <!-- end top bar -->

    <?php if(isset($error)): ?>
        <?php echo($error) ?>
    <?php endif; ?>

    <section class="profile_edit_section">
        <form action="" method="post" enctype="multipart/form-data">

            <div id="pfp_input_wrapper">
                <label for="pfp_input">
                    <img id="pfp_preview" for="pfp_input" src="profile_pictures/<?php echo User::getProfilePictureById($userId); ?>"> <!--Default needs to be current users pfp-->
                    <p id="label_text">Verander profielfoto</p>
                </label>
                <input type="file" name="pfp_input" id="pfp_input" accept="image/png, image/jpeg"/>
            </div>

            <div>
                <label for="username">Gebruikersnaam</label>
                <input type="text" id="username" name="username" value="<?php echo User::getUsernameById($userId); ?> " placeholder="type hier je gebruikersnaam"> <!-- Default value needs to be the current users username -->
            </div>

            <input type="image" src="assets/icons/checkmark_white.png" alt="Submit" id="submit_button">
        </form>
    </section>

    <a href="premium.html" id="get_premium_button">Word nu premium!</a>
    <a href="logout.php" id="logout_button">Afmelden</a>

</body>
</html>