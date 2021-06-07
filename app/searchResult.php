<?php 
    include_once('core/autoload.php');
    include_once('isLoggedIn.inc.php'); 

    if(!empty($_GET)){
        $input = $_GET['q'];
        $listings = Listing::search($input);
    } else {
        header("Location: home.php");
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
            <h1>Zoekresultaten voor "<?php echo $input ?>"</h1>
        </div>

        <div class="section_banner_wrapper">
            <p>Nog <?php echo htmlspecialchars(User::getAvailableReactions($_SESSION['userId']));?> reacties beschikbaar</p> <!-- Should represent current amount of reactions left over -->
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
                        <p>0.5km</p>
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