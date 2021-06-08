<?php 
    include_once('core/autoload.php');
    include_once('isLoggedIn.inc.php'); 

    $allMessages = User::getAllMessages($_GET['q'], $_GET['b']);
    $chatIds = User::getChatIdByReceiverSender($_GET['q'], $_GET['b']);
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
        <a href="javascript:javascript:history.go(-1)">
            <img id="exit_icon" src="assets/icons/exit_icon.png">
        </a>
    </header>
    <!-- end top bar -->

    <!-- Start chat messages section -->
    <section class="messenger_section">

        
        <?php foreach($allMessages as $message): ?>
            <?php if($message["chat_id_sender"] != substr($_GET["q"], 0, -1)): ?>

                    <!-- Example incoming message -->
                    <div class="incoming_message_wrapper">
                        <img src="profile_pictures/<?php echo User::getProfilePictureById($_GET['b']); ?>">
                        <div data-origin="incoming">
                            <p>
                                <?php echo htmlspecialchars($message['message']); ?>
                            </p>
                        </div>
                    </div>

                <?php else: ?>

                    <!-- Example outgoing message -->
                    <div data-origin="outgoing">
                        <p>
                            <?php echo htmlspecialchars($message['message']); ?>
                        </p>
                    </div>
                <?php endif; ?>
        <?php endforeach; ?>
        <br>
    </section>
    <!-- End chat messages section -->
    <form action="" method="post">
        <input id="markAsSaved" type="submit" value="Markeer als gered" data-chat-sender="<?php echo(substr($_GET["q"], 0, -1)); ?>" data-chat-receiver="<?php echo($_GET["b"]); ?>">
    </form>

        <br><br><br><br><br><br><br><br>
    
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
    <script src="js/markAsSaved.js"></script>
</body>
</html>