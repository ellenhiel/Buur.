<?php 
    include_once("../core/autoload.php");

    if(!empty($_POST)){
        session_start();
        $userId = $_SESSION['userId'];
        $receiverId = $_POST['receiver'];
        $chat = User::openChat($_SESSION['userId'], $receiverId);

        if(User::chatExists($userId, $receiverId)){
            $chatId = $chat['id'];
            $sender = $receiverId;
            $result = true;
        } else {
            // first make a conversation
            $user = new User();
            $user->setUserId($_SESSION['userId']);
            $user->setReceiverId($receiverId);

            $result1 = $user->makeChat1();
            $result2 = $user->makeChat2();
            
            $chatId = $chat['id'];
            $sender = $receiverId;
        }

        if($result) {
            $response = [
                "sender" => $sender,
                "chatId" => $chatId,
                "status" => "Success"
            ];
        } else if ($result1 && $result2) {
            $response = [
                "sender" => $sender,
                "chatId" => $chatId,
                "status" => "Success"
            ];
        }
        
        header("Content-Type: application/json");
        echo json_encode($response);
    }
?>