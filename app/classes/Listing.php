<?php
    class Listing {

        private $userId;
        private $title;
        private $picture;
        private $freshness;
        private $date;
        

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
            $query = $conn->prepare("INSERT INTO listings (user_id, title, listing_image, freshness, date) VALUES (:userId, :title, :picture, :freshness, :date)");
            
            $query->bindValue(":userId", $this->userId);
            $query->bindValue(":picture", $this->picture);
            $query->bindValue(":title", $this->title);
            $query->bindValue(":freshness", $this->freshness);
            $query->bindValue(":date", $this->date);

            $result = $query->execute();
            return $result; 
        }

        public static function getListings(){
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT * FROM listings");
            
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

    }
?>