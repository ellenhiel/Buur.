<?php 
    include_once('core/autoload.php');
    include_once('isLoggedIn.inc.php'); 
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

    <title>Profile</title>
</head>
<body>
    <!-- start top bar -->
    <header>
        <img src="assets/location_dot.png">
        <h2>Mijn profiel</h2>
        <a href="settings.php"><img id="settings_icon" src="assets/icons/settings_icon.png"></a>
    </header>
    <!-- end top bar -->
    
    <div id="user_info_wrapper">
        <img src="profile_pictures/<?php echo User::getProfilePictureById($_SESSION['userId']); ?>">
        <div>
            <h1><?php echo htmlspecialchars(User::getUsernameById($_SESSION['userId'])); ?></h1>
            <br>
            <a href="myListings.php">Mijn zoekertjes</a>
        </div>
    </div>

    <div id="saved_info_wrapper">
        <h2>Jij hebt al</h2>
        <div id="number_saved_wrapper">
            <h1><?php echo User::getSavedProducts($_SESSION['userId']); ?></h1>
            <h2>
            <?php if(User::getSavedProducts($_SESSION['userId']) == "1"): ?>
            product
            <?php else: ?>
            producten
            <?php endif; ?>
             <br> gered</h2>
        </div>
    </div>

    <div id="reactions_info_wrapper">
        <h2>Deze week heb je nog</h2>
        <div id="number_reactions_wrapper">
            <h1><?php echo User::getAvailableReactions($_SESSION['userId']);?>/2</h1>
            <h2>gratis reacties</h2>
        </div>
    </div>

    <a href="premium.html" id="btn_more_reactions">Meer reacties?</a>

    <!-- start bottom navigation -->
    <nav>
        <a href="home.php"><img src="assets/icons/home_icon.png"></a>
        <a href="search.php"><img src="assets/icons/search_icon.png"></a>
        <a href="upload.php"><img src="assets/icons/plus_icon.png"></a>
        <a href="chats.php"><img src="assets/icons/message_icon.png"></a>
        <a href="profile.php"><img src="assets/icons/profile_icon.png"></a>
    </nav>
    <!-- end bottom navigation -->
</body>
</html>