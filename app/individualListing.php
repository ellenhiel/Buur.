<?php 
    include_once('core/autoload.php');
    include_once('isLoggedIn.inc.php'); 
    $listing = Listing::getListing($_GET['q']);
    $chat = User::getChat($_SESSION['userId']);
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

    <title><?php echo htmlspecialchars($listing['title']); ?></title>
</head>
<body>
    <!-- start top bar -->
    <header>
        <img src="assets/location_dot.png">
        <h2>Red jij dit item?</h2>
        <a href="javascript:javascript:history.go(-1)">
            <img id="exit_icon" src="assets/icons/exit_icon.png">
        </a>
    </header>
    <!-- end top bar -->

    <section id="item_section">
        <div id="item_section_header">
            <img src="profile_pictures/<?php echo User::getProfilePictureById($listing['user_id']); ?>">
            <div>
                <p><?php echo htmlspecialchars(User::getUsernameById($listing['user_id'])); ?> geeft:</p>
                <p><?php echo htmlspecialchars($listing['title']); ?></p>
            </div>
        </div>

        <div id="item_section_image_wrapper">
            <img src="post_uploads/<?php echo htmlspecialchars($listing['listing_image']); ?>">
            <div id="item_section_banner">
                <p>Nog <?php echo htmlspecialchars(User::getAvailableReactions($_SESSION['userId']));?> reacties beschikbaar</p>
            </div>
        </div>

        <div id="item_section_freshness" style="width:<?php echo 100/100* $listing['freshness'];?>%;">
        </div>

        <div id="item_section_location">
            <img src="assets/icons/list_dot.png">
            <p>0.5km van jou verwijderd</p>
        </div>
        <br><br><br><br><br><br><br><br>
        <a href="" data-receiver="<?php echo $listing['user_id']; ?>" id="item_section_reactbtn" onclick="makeChat(event)">Stuur een bericht</a>
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
    <script src="js/makeChat.js"></script>
</body>
</html>