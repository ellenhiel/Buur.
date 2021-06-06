<?php 
    include_once('core/autoload.php');
    include_once('isLoggedIn.inc.php'); 
    include_once('posting.inc.php');
?>

<?php 
    if(isset($postOK)) {
        header('Location: home.php');
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

    <title>Upload</title>
</head>
<body>
    <!-- start top bar -->
    <header>
        <img src="assets/location_dot.png">
        <h2>Voeg iets toe</h2>
        <a href="javascript:javascript:history.go(-1)">
            <img id="exit_icon" src="assets/icons/exit_icon.png">
        </a>
    </header>
    <!-- end top bar -->

    <?php if(isset($error)): ?>
        <?php echo($error) ?>
    <?php endif; ?>

    <section class="upload_section">
        <form action="" method="post" enctype="multipart/form-data">

            <div id="image_input_wrapper">
                <label for="image_input">
                    <img id="imagePreview" for="image_input" src="assets/icons/camera_icon.png">
                </label>
                <input type="file" name="image_input" id="image_input" accept="image/png, image/jpeg"/>
            </div>

            <div>
                <label for="titel">Titel</label>
                <input type="text" id="titel" name="title" placeholder="bv. 2 wortels">
            </div>

            <div>
                <label for="quality">Versheid</label>
                <input type="range" id="quality" name="quality" min="0" max="100" step="1" >
            </div>

            <div id="upload_radio">
                <label>Categorie</label>
                <div>
                    <input type="radio" name="category" id="groenten" value="groenten" checked="checked">
                    <label for="groenten">Groenten</label>
                </div>
                <div>
                    <input type="radio" name="category" id="fruit" value="fruit">
                    <label for="fruit">Fruit</label>
                </div>
                <div>
                    <input type="radio" name="category" id="andere" value="andere">
                    <label for="andere">Andere</label>
                </div>
            </div>
            <br><br><br><br><br>
            <input type="image" src="assets/icons/checkmark_white.png" alt="Submit" id="btn_submit">

        </form>
    </section>

    <!-- start bottom navigation -->
    <nav>
        <a href="home.php"><img src="assets/icons/home_icon.png"></a>
        <a href="search.html"><img src="assets/icons/search_icon.png"></a>
        <a href="upload.php"><img src="assets/icons/plus_icon.png"></a>
        <a href="chats.php"><img src="assets/icons/message_icon.png"></a>
        <a href="profile.php"><img src="assets/icons/profile_icon.png"></a>
    </nav>
    <!-- end bottom navigation -->

    <script src="js/imagePreview.js"></script>
</body>
</html>