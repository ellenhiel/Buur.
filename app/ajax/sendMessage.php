<?php include_once("../core/autoload.php");

    if(!empty($_POST)){
        session_start();
        $message = $_POST['message']; // text comment
        $receiverId = $_POST['receiver']; // receiver id

        if (!empty($message)) {
            $user = new User();
            $user->setUserId($_SESSION['userId']);
            $user->setReceiverId($receiverId);
            $user->setMessage($message);
            $user->setDate(date("Y-m-d H:i:s"));

            $result1 = $user->makeMessage1();
            $result2 = $user->makeMessage2();

            $text = $message;
        }

        if($result1 && $result2){
            $response = [
                "input" => $text,
                "status" => "Success"
            ];
        } 
        
        header("Content-Type: application/json");
        echo json_encode($response);
    }
?>