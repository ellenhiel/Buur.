<?php include_once("../core/autoload.php");
    if(!empty($_POST)){
        session_start();
        $clickedListing = $_POST["clickedListing"]; // listing_id

        if ($clickedListing) {
            $listing = new Listing();
            $listing->setListingId($clickedListing);
            $listing->setUserId($_SESSION['userId']);

            $result = $listing->deleteListing();

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