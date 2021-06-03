<?php 
    include_once('core/autoload.php');
    include_once('isLoggedIn.inc.php'); 
    $chats = User::getChats($_SESSION['userId']);
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

    <title>Chats</title>
</head>
<body>
    <!-- start top bar -->
    <header>
        <img src="assets/location_dot.png">
        <h2>Mijn berichten</h2>
    </header>
    <!-- end top bar -->

    <section class="messages_section">

        <?php foreach($chats as $chat): ?>
        <!-- Start chats -->
        <a href="chat.php?q=<?php echo $chat['id']; ?>?&b=<?php echo $chat['sender_id']; ?>" class="message_wrapper">
            <img class="user_image" src="profile_pictures/<?php echo User::getProfilePictureById($chat['sender_id']); ?>">
            <h3><?php echo htmlspecialchars(User::getUsernameById($chat['sender_id'])); ?></h3>
            <img class="delete_image" src="assets/icons/trash_icon.png" data-chat="<?php echo $chat['id']; ?>">
        </a>

        <div class="divider"></div>
        <!-- End chats -->
        <?php endforeach; ?>

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
    <script src="js/deleteChat.js"></script>
</body>
</html>