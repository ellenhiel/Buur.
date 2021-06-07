<?php 
    include_once('core/autoload.php');
    include_once('isLoggedIn.inc.php'); 
    $messagesLeft = User::getMessagesLeft($_GET['q']);
    $messagesRight = User::getMessagesRight($_GET['q']);
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

    <title>chat</title>
</head>
<body>
    <!-- start top bar -->
    <header>
        <img src="assets/location_dot.png">
        <h2><?php echo htmlspecialchars(User::getUsernameById($_GET['b']));?></h2>
        <img id="exit_icon" src="assets/icons/exit_icon.png">
    </header>
    <!-- end top bar -->

    <!-- Start chat messages section -->
    <section class="messenger_section">
        <!-- Example incoming message -->
        <?php foreach($messagesLeft as $messageLeft): ?>
        <?php foreach($messagesRight as $messageRight): ?>
        <?php if(strtotime($messageLeft['time']) < strtotime($messageRight['time'])): ?>
        
            <div class="incoming_message_wrapper">
             <img src="profile_pictures/<?php echo User::getProfilePictureById($_GET['b']); ?>">
            <div data-origin="incoming">
                <p>
                    <?php echo htmlspecialchars($messageLeft['message']); ?>
                </p>
            </div>
        </div>

        <?php else: ?>
        <!-- Example outgoing message -->
        <div data-origin="outgoing">
            <p>
                <?php echo htmlspecialchars($messageRight['message']); ?>
            </p>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php endforeach; ?>
    </section>
    <!-- End chat messages section -->
    
    <!-- Start message input section -->
    <section id="chat_section">
        <form action="" method="POST">
            <input type="text" name="message" placeholder="Type je bericht hier...">
            <input type="submit" data-receiver="<?php echo $_GET['b']; // better put here userid person from receiver?>" value="Verstuur" class="sendBtn">
        </form>  
    </section>
    <!-- end message input section -->

    <!-- start bottom navigation -->
    <nav>
        <a href="home.php"><img src="assets/icons/home_icon.png"></a>
        <a href="search.php"><img src="assets/icons/search_icon.png"></a>
        <a href="upload.php"><img src="assets/icons/plus_icon.png"></a>
        <a href="chats.php"><img src="assets/icons/message_icon.png"></a>
        <a href="profile.php"><img src="assets/icons/profile_icon.png"></a>
    </nav>
    <!-- end bottom navigation -->
    <script src="js/sendMessage.js"></script>
</body>
</html>