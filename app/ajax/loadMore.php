<?php include_once("../core/autoload.php"); 

    if (!empty($_POST)) {
        
        $result = Listing::getMorePosts($_POST["postStart"], $_POST["postEnd"]);

        for ($i=0; $i < count($result) ; $i++) { 
            array_push($result[$i], User::getProfilePictureById($result[$i][1]));
        }

        $response = [
            "action" => "get more posts",
            "status" => "big goddamn succes bois",
            "result" => $result
        ];

        header("Content-Type: application/json");
        echo json_encode($response);
    }
?>