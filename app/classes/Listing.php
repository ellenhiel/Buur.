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
            self::checkTitle():
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

    }
?>