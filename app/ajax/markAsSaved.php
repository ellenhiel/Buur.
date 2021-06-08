<?php include_once("../core/autoload.php");?>
<?php
    if(!empty($_POST)){
        $receiver = $_POST["receiver"];
        $sender = $_POST["sender"];
        
        User::markAsSaved($sender, $receiver);

        $response = [
            "status" => "Success"
        ];

        header("Content-Type: application/json");
        echo json_encode($response);
    }
?>