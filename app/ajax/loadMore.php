<?php include_once("../core/autoload.php"); 
    session_start();

    if (!empty($_POST)) {

        $filtersArray = explode(',',$_POST["filters"]);
        $distance = $filtersArray[1];
        $finalResult = [];

        if ($_POST["filters"] == "0") {
            $result = Listing::getMorePosts($_POST["postStart"], $_POST["postEnd"]);
            $filters = "no";
        } else {
            $result = Listing::getMorePostsFilter($_POST["postStart"], $_POST["postEnd"], $_POST["filters"]);
            $filters = "yes";
        }

        for ($i=0; $i < count($result) ; $i++) {
            if (getDistance($_SESSION["lat"], $_SESSION["lon"], $result[$i]["latitude"], $result[$i]["longitude"]) < $distance) {
                array_push($finalResult, $result[$i]);
                array_push($finalResult[$i], User::getProfilePictureById($result[$i][1]));
            }
        }

        $response = [
            "action" => "get more posts",
            "status" => "big goddamn succes bois",
            "result" => $finalResult,
            "filters" => $filters
        ];

        header("Content-Type: application/json");
        echo json_encode($response);
    }

    function getDistance($lat1, $lon1, $lat2, $lon2){
        $pi80 = M_PI / 180; 
        $lat1 *= $pi80; 
        $lon1 *= $pi80; 
        $lat2 *= $pi80; 
        $lon2 *= $pi80; 
        $r = 6372.797; // mean radius of Earth in km 
        $dlat = $lat2 - $lat1; 
        $dlon = $lon2 - $lon1; 
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2); 
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a)); 
        $km = $r * $c; 
        return round($km, 1); 
    }
?>