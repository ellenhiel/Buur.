<?php 
    include_once('core/autoload.php');
    include_once('isLoggedIn.inc.php'); 
    $listing = Listing::getListing($_GET['q']);
    $chat = User::getChat($_SESSION['userId']);

    //Fancy algo for getting distance from 2 geo points
    function getDistance($lat1, $lon1, $lat2, $lon2){
        $pi80 = M_PI / 180; 
        $lat1 *= $pi80; 
        $lon1 *= $pi80; 
        $lat2 *= $pi80; 
        $lon2 *= $pi80; 
        $r = 6372.797; // mean radius of Earth in km 
        $dlat = $lat2 - $lat1; 
        $dlon = $lon2 - $lon1; 
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2); 
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a)); 
        $km = $r * $c; 
        return round($km, 1); 
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
                <?php if(User::getAvailableReactions($_SESSION['userId']) == 1): ?>
                    <p>Nog <?php echo htmlspecialchars(User::getAvailableReactions($_SESSION['userId']));?> reactie beschikbaar</p> <!-- Should represent current amount of reactions left over -->
                <?php else: ?>
                    <p>Nog <?php echo htmlspecialchars(User::getAvailableReactions($_SESSION['userId']));?> reacties beschikbaar</p> <!-- Should represent current amount of reactions left over -->
                <?php endif; ?> 
            </div>
        </div>

        <div id="item_section_freshness" style="width:<?php echo 100/100* $listing['freshness'];?>%;">
        </div>

        <div id="item_section_location">
            <img src="assets/icons/list_dot.png">
            <p><?php echo(getDistance($listing["longitude"], $listing["latitude"], $_SESSION["lon"], $_SESSION["lat"])) ?>km van jou verwijderd</p>
        </div>
        <br><br><br><br><br><br><br><br>
        <?php if($listing['user_id'] != $_SESSION['userId'] && User::getAvailableReactions($_SESSION['userId']) != 0): ?>
            <a href="" data-receiver="<?php echo $listing['user_id']; ?>" data-listing="<?php echo $listing['id']; ?>" id="item_section_reactbtn" onclick="makeChat(event); makeChat(event);">Stuur een bericht</a>
        <?php elseif(User::getAvailableReactions($_SESSION['userId']) == 0): ?>
            <a href="premium.html" id="item_section_reactbtn">Meer reacties nodig?</a>
        <?php endif; ?>
        
    </section>

    <!-- start bottom navigation -->
    <nav>
        <a href="home.php"><img src="assets/icons/home_icon.png"></a>
        <a href="search.php"><img src="assets/icons/search_icon.png"></a>
        <a href="upload.php"><img src="assets/icons/plus_icon.png"></a>
        <a href="chats.php"><img src="assets/icons/message_icon.png"></a>
        <a href="profile.php"><img src="assets/icons/profile_icon.png"></a>
    </nav>
    <!-- end bottom navigation -->
    <script src="js/makeChat.js"></script>
</body>
</html>