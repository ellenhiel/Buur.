<?php include_once("../core/autoload.php");
    if(!empty($_POST)){
        session_start();
        $clickedChat = $_POST["clickedChat"]; // chat_id

        if ($clickedChat) {
            $chat = new User();
            $chat->setChatId($clickedChat);
            $chat->setUserId($_SESSION['userId']);

            $result = $chat->deleteChat();

            $action = "delete";
        } else {}

        if($result){
            $response = [
                "action" => $action,
                "status" => "Success"
            ];
        }
        header("Content-Type: application/json");
        echo json_encode($response);
    }