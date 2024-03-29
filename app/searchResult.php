<?php 
    include_once('core/autoload.php');
    include_once('isLoggedIn.inc.php'); 

    if(!empty($_GET)){
        $input = $_GET['q'];
        $listings = Listing::search($input);
    } else {
        header("Location: home.php");
    }

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

    <title>Home</title>
</head>
<body>
    <!-- start top bar -->
    <header>
        <img src="assets/location_dot.png">
        <h2>Startpagina</h2>
    </header>
    <!-- end top bar -->

    <section>
        <div class="section_header_wrapper">
            <?php if(!empty($listings)): ?>
                <h1>Zoekresultaten voor "<?php echo $input ?>"</h1>
            <?php else: ?>
                <div id="noResultsPage">
                    <h1>Er zijn geen zoekresultaten voor "<?php echo $input ?>"</h1>
                    <a id="noResultsLink" href="search.php">Klik hier om opnieuw te proberen</a>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- All posts go in this section -->
        <section id="posts_section">

            <?php foreach($listings as $listing): ?>
            <!-- Single post start -->
            <a href="individualListing.php?q=<?php echo $listing['id'] ?>"><div class="post_wrapper">

                <div class="image_wrapper"> <!-- Post image goes here -->
                    <img src="post_uploads/<?php echo $listing['listing_image'] ?>">
                </div>

                <div class="info_wrapper"> <!-- Post info goes here (name, distance, freshness) -->
                    <h3><?php echo $listing['title']; ?></h3>

                    <div class= "location_wrapper">
                        <img src="assets/location_dot.png">
                        <p><?php echo(getDistance($listing["longitude"], $listing["latitude"], $_SESSION["lon"], $_SESSION["lat"])) ?>km</p>
                    </div>
                    <span style="width:<?php echo 150/100* $listing['freshness'];?>px;"></span>
                </div>

                <div class="user_wrapper"> <!-- Post owner goes here -->
                    <img src="profile_pictures/<?php echo User::getProfilePictureById($listing['user_id']); ?>">
                </div>
            </div></a>
            <!-- Single post end -->
            <?php endforeach; ?>

        </section>
        <!-- End of all posts -->
        
        <?php if(empty($_GET)): ?>
            <a href="#" id="show_more_btn">Toon meer</a>
        <?php else:?>
            <br><br><br><br><br><br>
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

    <script src="js/filterOverlay.js"></script>
    <script src="js/showMore.js"></script>
</body>
</html>