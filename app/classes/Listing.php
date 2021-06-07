<?php
    class Listing {

        private $userId;
        private $title;
        private $picture;
        private $freshness;
        private $date;
        private $category;
        private $listingId;
        

        //Getters/Setters for private variables
        public function setUserid($userId){
            $this->userId = $userId;
        }  

        public function getUserId(){
            return $this->userId;
        }

        public function setTitle($title){
            self::checkTitle($title);
            $this->title = $title;
        }  

        public function getTitle(){
            return $this->title;
        }

        public function setPicture($picture){
            self::checkPicture($picture);
            $this->picture = $picture;
        }  

        public function getPicture(){
            return $this->picture;
        }

        public function setFreshness($freshness){
            $this->freshness = $freshness;
        }  

        public function getFreshness(){
            return $this->freshness;
        }

        public function setDate($date){
            $this->date = $date;
        }  

        public function getDate(){
            return $this->date;
        }

        public function setCategory($category){
            $this->category = $category;
        }

        public function getCategory(){
            return $this->category;
        }

        public function setListingid($listingId){
            $this->listingId = $listingId;
        }  

        public function getListingId(){
            return $this->listingId;
        }

        //Checks for title/picture
        private function checkPicture($picture){
            if ($picture == "") {
                throw new Exception("You need to upload an image.");
            }
        }

        private function checkTitle($title){
            if ($title == "") {
                throw new Exception("Title can not be empty.");
            }
        }

        public function submit(){
            $conn = Database::getConnection();
            $query = $conn->prepare("INSERT INTO listings (user_id, title, listing_image, freshness, date, category) VALUES (:userId, :title, :picture, :freshness, :date, :category)");
            
            $query->bindValue(":userId", $this->userId);
            $query->bindValue(":picture", $this->picture);
            $query->bindValue(":title", $this->title);
            $query->bindValue(":freshness", $this->freshness);
            $query->bindValue(":date", $this->date);
            $query->bindValue(":category", $this->category);

            $result = $query->execute();
            return $result; 
        }

        public static function getListings(){
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT * FROM listings LIMIT 10");
            
            $query->execute();
            $listings = $query->fetchAll();
            
            return $listings;
        }

        public static function getListing($listingId){
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT * FROM listings WHERE id = :listingId");
            
            $query->bindValue(":listingId", $listingId);            
            $query->execute();
            $listings = $query->fetch();
            
            return $listings;
        }

        //Distance still needs to be done
        public static function getListingsByFilters($sortBy, $type, $distance){
            $conn = Database::getConnection();

            if ($sortBy == "recent") {

                if (count($type) == 3) {
                    $query = $conn->prepare("SELECT * FROM listings ORDER BY date DESC LIMIT 100");
                } elseif (count($type) == 2) {
                    $query = $conn->prepare("SELECT * FROM listings WHERE category= ". "'" . $type[0] . "'" ." OR category = ". "'" . $type[1] . "'" ." ORDER BY date DESC LIMIT 100");
                } else {
                    $query = $conn->prepare("SELECT * FROM listings WHERE category= ". "'" . $type[0] . "'" ." ORDER BY date DESC LIMIT 100");
                }

            } else {
                if (count($type) == 3) {
                    $query = $conn->prepare("SELECT * FROM listings ORDER BY freshness DESC LIMIT 100");
                } elseif (count($type) == 2) {
                    $query = $conn->prepare("SELECT * FROM listings WHERE category= ". "'" . $type[0] . "'" ." OR category = ". "'" . $type[1] . "'" ." ORDER BY freshness DESC LIMIT 100");
                } else {
                    $query = $conn->prepare("SELECT * FROM listings WHERE category= ". "'" . $type[0] . "'" ." ORDER BY freshness DESC LIMIT 100");
                }
            }

            $query->execute();
            $listings = $query->fetchAll();

            return $listings;
        }

        public static function getMorePosts($start, $end) {
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT * FROM listings LIMIT ".$start.", ".$end);
            
            $query->execute();
            $listings = $query->fetchAll();
            
            return $listings;
        }

        public static function getMyListings($userId){
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT * FROM listings where user_id = :userId");
            
            $query->bindValue(":userId", $userId);
            $query->execute();
            $listings = $query->fetchAll();
            
            return $listings;
        }

        public function deleteListing(){
            $conn = Database::getConnection();
            $query = $conn->prepare("DELETE FROM listings WHERE id = :listingId and user_id = :userId");

            $query->bindValue(":listingId", $this->getListingId());
            $query->bindValue(":userId", $this->getUserId());
            $result = $query->execute();

            return $result;

        }

        public static function search($input) {
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT * FROM listings WHERE title LIKE CONCAT( '%', :input, '%')");
            
            $query->bindValue(":input", $input);
            $query->execute();
            $listings = $query->fetchAll();
            
            return $listings;
        }

    }
?>