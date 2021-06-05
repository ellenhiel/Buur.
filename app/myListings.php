<?php
    include_once('core/autoload.php');
    include_once('isLoggedIn.inc.php'); 
    $listings = Listing::getMyListings($_SESSION['userId']);
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

    <title>myListings</title>
</head>
<body>
    <!-- start top bar -->
    <header>
        <img src="assets/location_dot.png">
        <h2>Mijn zoekertjes</h2>
    </header>
    <!-- end top bar -->
    
    <section id="listings_section">
        
        <?php foreach ($listings as $listing): ?>
        <!-- start single listing -->
        <div class="listing_wrapper">
            <img class="listing_img" src="post_uploads/<?php echo $listing['listing_image']; ?>">
            <h2><?php echo $listing['title']; ?></h2>
            <div class="listing_buttons reactie_button">
                <p id="reactie_title">Reacties</p>
                <img src="assets/icons/message_white_icon.png">
            </div>
            <div class="listing_buttons verwijder_button" data-listing="<?php echo $listing['id']; ?>">
                <p id="verwijder_title">Verwijder</p>
                <img src="assets/icons/trash_white_icon.png">
            </div>
        </div>
        <!-- end single listing -->
        <?php endforeach; ?>   

    </section>

    <a href="upload.php" id="add_listing_button">Voeg meer zoekertjes toe!</a>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <!-- start bottom navigation -->
    <nav>
        <a href="home.php"><img src="assets/icons/home_icon.png"></a>
        <a href="search.html"><img src="assets/icons/search_icon.png"></a>
        <a href="upload.php"><img src="assets/icons/plus_icon.png"></a>
        <a href="chats.php"><img src="assets/icons/message_icon.png"></a>
        <a href="profile.php"><img src="assets/icons/profile_icon.png"></a>
    </nav>
    <!-- end bottom navigation -->
    
    <script src="js/deleteListing.js"></script>
</body>
</html>