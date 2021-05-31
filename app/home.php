
<?php 
    include_once('core/autoload.php');
    include_once('isLoggedIn.inc.php'); 
;?>
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
            <h1>In de buurt</h1>
            <img src="assets/icons/filter_icon.png">
        </div>

        <div class="section_banner_wrapper">
            <p>Nog <?php echo htmlspecialchars(User::getAvailableReactions($_SESSION['userId']));?> reacties beschikbaar</p> <!-- Should represent current amount of reactions left over -->
        </div>
        
        <!-- All posts go in this section -->
        <section id="posts_section">


            <!-- Single post start -->
            <div class="post_wrapper">

                <div class="image_wrapper"> <!-- Post image goes here -->
                    <img src="post_uploads/kiwis.jpg">
                </div>

                <div class="info_wrapper"> <!-- Post info goes here (name, distance, freshness) -->
                    <h3>Kiwi's!</h3>

                    <div class= "location_wrapper">
                        <img src="assets/location_dot.png">
                        <p>0.5km</p>
                    </div>
                    
                    <img src="assets/PNG/progressBar.png">
                </div>

                <div class="user_wrapper"> <!-- Post owner goes here -->
                    <img src="profile_pictures/woman.jpg">
                </div>

            </div>
            <!-- Single post end -->

            <div class="post_wrapper">

                <div class="image_wrapper"> <!-- Post image goes here -->
                    <img src="post_uploads/kiwis.jpg">
                </div>

                <div class="info_wrapper"> <!-- Post info goes here (name, distance, freshness) -->
                    <h3>Kiwi's!</h3>

                    <div class= "location_wrapper">
                        <img src="assets/location_dot.png">
                        <p>0.5km</p>
                    </div>
                    
                    <img src="assets/PNG/progressBar.png">
                </div>

                <div class="user_wrapper"> <!-- Post owner goes here -->
                    <img src="profile_pictures/woman.jpg">
                </div>

            </div>

            <div class="post_wrapper">

                <div class="image_wrapper"> <!-- Post image goes here -->
                    <img src="post_uploads/kiwis.jpg">
                </div>

                <div class="info_wrapper"> <!-- Post info goes here (name, distance, freshness) -->
                    <h3>Kiwi's!</h3>

                    <div class= "location_wrapper">
                        <img src="assets/location_dot.png">
                        <p>0.5km</p>
                    </div>
                    
                    <img src="assets/PNG/progressBar.png">
                </div>

                <div class="user_wrapper"> <!-- Post owner goes here -->
                    <img src="profile_pictures/woman.jpg">
                </div>

            </div>

            <div class="post_wrapper">

                <div class="image_wrapper"> <!-- Post image goes here -->
                    <img src="post_uploads/kiwis.jpg">
                </div>

                <div class="info_wrapper"> <!-- Post info goes here (name, distance, freshness) -->
                    <h3>Kiwi's!</h3>

                    <div class= "location_wrapper">
                        <img src="assets/location_dot.png">
                        <p>0.5km</p>
                    </div>
                    
                    <img src="assets/PNG/progressBar.png">
                </div>

                <div class="user_wrapper"> <!-- Post owner goes here -->
                    <img src="profile_pictures/woman.jpg">
                </div>

            </div>

        </section>
        <!-- End of all posts -->

        <a href="#" id="show_more_btn">Toon meer</a>

    </section>

    <!-- start bottom navigation -->
    <nav>
        <a href="home.php"><img src="assets/icons/home_icon.png"></a>
        <a href="search.html"><img src="assets/icons/search_icon.png"></a>
        <a href="upload.html"><img src="assets/icons/plus_icon.png"></a>
        <a href="chats.html"><img src="assets/icons/message_icon.png"></a>
        <a href="profile.html"><img src="assets/icons/profile_icon.png"></a>
    </nav>
    <!-- end bottom navigation -->
</body>
</html>