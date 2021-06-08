<?php 
    include_once('core/autoload.php');
    include_once('isLoggedIn.inc.php'); 
    $listings = Listing::getListings();

    if (!empty($_GET)) {
        $sortBy = $_GET["sortBy"];
        $type = $_GET["type"];
        $distance = $_GET["distance"];
        
        $listings = Listing::getListingsByFilters($sortBy, $type, $distance);
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

    <!-- start overlay div -->
    <div id="filter_overlay" class="overlay">
        <div class="filter_header">
            <h2>Filters</h2>
            <img id="filter_close_icon" src="assets/icons/exit_white_icon.png">
        </div>

        <form id="filter_form" action="" method="get">

            <div class="filter_section">
                <h2>Sorteer op</h2>

                <div>
                    <?php if(empty($_GET) || $_GET["sortBy"] == "recent"): ?>
                        <input type="radio" id="afstand" name="sortBy" value="recent" checked="checked">
                    <?php else: ?>
                        <input type="radio" id="afstand" name="sortBy" value="recent">
                    <?php endif; ?>
                    <label for="recent">Recent</label>
                </div>
                
                <div>
                    <?php if(!empty($_GET) && $_GET["sortBy"] == "versheid"): ?>
                        <input type="radio" id="versheid" name="sortBy" value="versheid" checked="checked">
                    <?php else: ?>
                        <input type="radio" id="versheid" name="sortBy" value="versheid">
                    <?php endif; ?>
                    <label for="versheid">Versheid</label>
                </div>
            
            </div>

            <div class="filter_section">
                <h2>Toon enkel</h2>
                
                <div>
                    <?php if(empty($_GET) || in_array("fruit", $_GET["type"])): ?>
                        <input type="checkbox" id="fruit" name="type[]" value="fruit" checked="check">
                    <?php else: ?>
                        <input type="checkbox" id="fruit" name="type[]" value="fruit">
                    <?php endif; ?>
                    <label for="fruit">Fruit</label>
                </div>
                
                <div>
                    <?php if(empty($_GET) || in_array("groenten", $_GET["type"])): ?>
                        <input type="checkbox" id="groenten" name="type[]" value="groenten" checked="check">
                    <?php else: ?>
                        <input type="checkbox" id="groenten" name="type[]" value="groenten">
                    <?php endif; ?>
                    <label for="groenten">Groenten</label>
                </div>

                <div>
                    <?php if(empty($_GET) || in_array("andere", $_GET["type"])): ?>
                        <input type="checkbox" id="andere" name="type[]" value="andere" checked="check">
                    <?php else: ?>
                        <input type="checkbox" id="andere" name="type[]" value="andere">
                    <?php endif; ?>
                    <label for="andere">Andere</label>
                </div>
            </div>

            <div class="filter_section">
                <div class="distance_slider_header">
                    <h2>Maximum afstand</h2>
                    <?php if(isset($_GET["distance"])): ?>
                        <h3><span id="range_output"><?php echo($_GET["distance"]); ?></span> km</h3> <!-- Moet de accurate afstand weergeven -->
                    <?php else: ?>
                        <h3><span id="range_output">20</span> km</h3> <!-- Moet de accurate afstand weergeven -->
                    <?php endif; ?>
                </div>
                
                <div>
                    <?php if(isset($_GET["distance"])): ?>
                        <input id="range_slider" type="range" min="1" max="40" id="max_afstand" name="distance" value="<?php echo($_GET["distance"]); ?>">
                    <?php else: ?>
                        <input id="range_slider" type="range" min="1" max="40" id="max_afstand" name="distance" value="20">
                    <?php endif; ?>
                </div>
            </div>

            <input type="submit" value="Toepassen">            
        </form>

    </div>

    <section>
        <div class="section_header_wrapper">
            <h1>In de buurt</h1>
            <img id="filter_icon" src="assets/icons/filter_icon.png">
        </div>

        <div class="section_banner_wrapper">
            <p>Nog <?php echo htmlspecialchars(User::getAvailableReactions($_SESSION['userId']));?> reacties beschikbaar</p> <!-- Should represent current amount of reactions left over -->
        </div>
        
        <!-- All posts go in this section -->
        <section id="posts_section">

            <?php foreach($listings as $listing): ?>
            <!-- Single post start -->
            <a href="individualListing.php?q=<?php echo $listing['id'] ?>">
                <div class="post_wrapper">

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
                </div>
            </a>
            <!-- Single post end -->
            <?php endforeach; ?>

        </section>
        <!-- End of all posts -->
        
        <a href="#" id="show_more_btn">Toon meer</a>

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