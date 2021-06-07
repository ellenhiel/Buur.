<?php include_once("../core/autoload.php"); 

    if (!empty($_POST)) {
        if ($_POST["filters"] == "0") {
            $result = Listing::getMorePosts($_POST["postStart"], $_POST["postEnd"]);
            $filters = "no";
        } else {
            $result = Listing::getMorePostsFilter($_POST["postStart"], $_POST["postEnd"], $_POST["filters"]);
            $filters = "yes";
        }

        for ($i=0; $i < count($result) ; $i++) { 
            array_push($result[$i], User::getProfilePictureById($result[$i][1]));
        }

        $response = [
            "action" => "get more posts",
            "status" => "big goddamn succes bois",
            "result" => $result,
            "filters" => $filters
        ];

        header("Content-Type: application/json");
        echo json_encode($response);
    }
?>