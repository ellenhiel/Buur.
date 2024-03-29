<?php

    class User {

        private $userId;
        private $username;
        private $password;
        private $picture;
        private $email;
        private $premium = 0;
        private $reactions = 0;
        private $chatId;
        private $receiverId;
        private $message;
        private $listingId;

        const MIN_USERNAME = 5; //Minimum amount of username characters
        const MAX_USERNAME = 20; //Maximum amount of username characters

        const MIN_PASSWORD = 5; //Minimum amount of password characters
        const MAX_PASSWORD = 200; //Maximum amount of password characters
        const MIN_CAPITAL = 1; //Minimum amount of capital characters    
        const MAX_BIO = 350;  //Maximum amount of bio characters   

        const COST_PASSWORD = 12; //Cost amount for password hashing

        
        //Getters/Setters for private variables
        public function setUserId($userId){
            $this->userId = $userId;
        }

        public function getUserId(){
            return $this->userId;
        }

        public function setUsername($username){
            self::checkUsername($username);

            $this->username = $username;
        }

        public function getUsername(){
            return $this->username;
        }

        public function setPicture($picture){
            self::checkPicture($picture);
            $this->picture = $picture;
        }  

        public function getPicture(){
            return $this->picture;
        }

        //Checks for title/picture
        private function checkPicture($picture){
            if ($picture == "") {
                throw new Exception("You need to upload an image.");
            }
        }

        public function setChatId($chatId){
            $this->chatId = $chatId;
        }

        public function getChatId(){
            return $this->chatId;
        }

        public function setReceiverId($receiverId){
            $this->receiverId = $receiverId;
        }

        public function getReceiverId(){
            return $this->receiverId;
        }

        public function setMessage($message){
            $this->message = $message;
        }

        public function getMessage(){
            return $this->message;
        }

        public function setDate($date){
            $this->date = $date;
        }

        public function getDate(){
            return $this->date;
        }

        public function setListingId($listingId){
            $this->listingId = $listingId;
        }

        public function getListingId(){
            return $this->listingId;
        }

        public static function getUserIdByEmail($email){
            $conn = Database::getConnection(); 
            $query = $conn->prepare("SELECT id FROM users WHERE email = :email");
            
            $query->bindValue(":email", $email);
            $query->execute();
            $email = $query->fetch();
            
            return $email['id'];
        }

        public static function getUsernameById($userId){
            $conn = Database::getConnection(); 
            $query = $conn->prepare("SELECT username FROM users WHERE id = :userId");
            
            $query->bindValue(":userId", $userId);
            $query->execute();
            $id = $query->fetch();
            
            return $id['username'];
        }

        public static function getProfilePictureById($userId){
            $conn = Database::getConnection(); 
            $query = $conn->prepare("SELECT profile_picture FROM users WHERE id = :userId");
            
            $query->bindValue(":userId", $userId);
            $query->execute();
            $id = $query->fetch();
            
            return $id['profile_picture'];
        }

        public static function canLogin($email, $password) {
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT * FROM users WHERE email = :email");
            
            $query->bindValue(":email", $email);
            $query->execute();

            $user = $query->fetch();
            $hash = $user['password'];

            if(!$user) {
                return false;
            }
            
            if(password_verify($password, $hash)) {
                return true;
            } else {
                return false;
            }
        }

        public function setPassword($password){
            self::checkPassword($password);
            
            $options = [
                'cost' => self::COST_PASSWORD,
            ];

            $password = password_hash($password, PASSWORD_BCRYPT, $options);

            $this->password = $password;
            return $this;
        }

        public function getPassword(){
            return $this->password;
        }

        public function setEmail($email){
            self::checkEmail($email);

            $this->email = $email;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setPremium($premium){
            $this->premium = $premium;
        }

        public function getPremium(){
            return $this->premium;
        }

        public function setReactions($reactions){
            $this->reactions = $reactions;
        }

        public function getReactions(){
            return $this->reactions;
        }

        public static function getAvailableReactions($userId) {
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT * FROM users WHERE id = :userId");
            
            $query->bindValue(":userId", $userId);
            $query->execute();
            $reactions = $query->fetch();

            return $reactions['reactions'];
        }

        public static function getSavedProducts($userId) {
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT * FROM users WHERE id = :userId");
            
            $query->bindValue(":userId", $userId);
            $query->execute();
            $reactions = $query->fetch();

            return $reactions['products_saved'];
        }

        //Checkers for password/username/email
        private function checkPassword($password){
            if($password == ""){
                throw new Exception("Password cannot be empty.");
            }

            if(strpos($password, " ")){
                throw new Exception("Password cannot contain blank spaces.");
            }

            if(strlen($password) > self::MAX_PASSWORD){
                throw new Exception("Password can only be ". self::MAX_PASSWORD ." characters long.");
            }

            if(strlen($password) < self::MIN_PASSWORD){
                throw new Exception("Password must be at least ". self::MIN_PASSWORD ." characters.");
            }

            if(strlen(preg_replace('![^A-Z]+!', '', $password)) < self::MIN_CAPITAL){
                throw new Exception("Password must contain at least ". self::MIN_CAPITAL ." capital letter.");
            }
        }

        private function checkUsername($username){
            if($username == ""){
                throw new Exception("Username cannot be empty.");
            }

            if(strpos($username, " ")){
                throw new Exception("Username cannot contain blank spaces.");
            }

            if(strlen($username) > self::MAX_USERNAME){
                throw new Exception("Usernames can only be ". self::MAX_USERNAME ." characters long");
            }

            if(strlen($username) < self::MIN_USERNAME){
                throw new Exception("Usernames must be at least ". self::MIN_USERNAME ." characters");
            }

            if($this->usernameExists($username)){
                throw new Exception("This username is taken.");
            }
        }

        private function checkEmail($email){
            if(empty($email)){
                throw new Exception("Email cannot be empty.");
            }

            if(!strpos($email, "@") || !strpos($email, ".") || strpos($email, " ") ){
                throw new Exception("Email is invalid");
            }

            if($this->emailExists($email)){
                throw new Exception("This email has already been registered.");
            }
        }

        //Helper function for checkUsername
        private function usernameExists($username){ 
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT id FROM users WHERE username = :username");

            $query->bindValue(":username", $username);            
            $query->execute();
            $result = $query->fetch();

            if(!$result){
                return False;
            } else {
                return True;
            }
        }

        public function save(){
            $conn = Database::getConnection();
            $query = $conn->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
            
            $query->bindValue(":username", $this->username);
            $query->bindValue(":password", $this->password);
            $query->bindValue(":email", $this->email);

            $result=$query->execute();
            return $result;
        }

        //Helper function for checkEmail
        private function emailExists($email){ 
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT id FROM users WHERE email = :email");

            $query->bindValue(":email", $email);            
            $query->execute();
            $result = $query->fetch();

            if(!$result){
                return False;
            } else {
                //Return false if the result is the users own email
                if (!empty($this->userId)) {
                    if ($result['id'] == $this->userId) {
                        return False;
                    }
                }
                return True;
            }
        }

        public static function getChats($userId) {
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT * FROM chat WHERE receiver_id = :userId");
            
            $query->bindValue(":userId", $userId);
            $query->execute();
            $result = $query->fetchAll();

            return $result;
        }

        public static function getChat($userId) {
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT * FROM chat WHERE receiver_id = :userId");
            
            $query->bindValue(":userId", $userId);
            $query->execute();
            $result = $query->fetch();

            return $result;
        }

        public static function openChat($userId, $receiverId) {
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT * FROM chat WHERE receiver_id = :userId AND sender_id = :receiverId");
            
            $query->bindValue(":userId", $userId);
            $query->bindValue(":receiverId", $receiverId);
            $query->execute();
            $result = $query->fetch();

            return $result;
        }

        public static function chatExists($userId, $receiverId) {
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT * FROM chat WHERE receiver_id = :userId AND sender_id = :receiverId");
            
            $query->bindValue(":userId", $userId);
            $query->bindValue(":receiverId", $receiverId);
            $query->execute();
            $result = $query->fetch();

            if($result) {
                return true;
            } else {
                return false;
            }
        }

        public function deleteChat(){
            $conn = Database::getConnection();
            $query = $conn->prepare("DELETE FROM chat WHERE id = :chatId and receiver_id = :userId");

            $query->bindValue(":chatId", $this->getChatId());
            $query->bindValue(":userId", $this->getUserId());
            $result = $query->execute();

            return $result;
        }

        public static function markAsSaved($sender, $receiver) {
            //Remove chat from chat table
            $conn = Database::getConnection();
            $query = $conn->prepare("DELETE FROM chat where receiver_id = :receiver AND sender_id = :sender OR receiver_id = :sender AND sender_id = :receiver");

            $query->bindValue(":sender", $sender);
            $query->bindValue(":receiver", $receiver);
            $result = $query->execute();

            //Increase product score counter
            $conn = Database::getConnection();
            $query = $conn->prepare("UPDATE users SET products_saved = products_saved + 1 WHERE id = :sender OR id = :receiver");

            $query->bindValue(":sender", $sender);
            $query->bindValue(":receiver", $receiver);
            $result = $query->execute();

            //Remove the messages from the chats table
            $conn = Database::getConnection();
            $query = $conn->prepare("DELETE FROM chats WHERE chat_id_sender = :sender AND chat_id_receiver = :receiver OR chat_id_sender = :receiver AND chat_id_receiver = :sender");

            $query->bindValue(":sender", $sender);
            $query->bindValue(":receiver", $receiver);
            $result = $query->execute();

            //Decrease amount reactions counter from receiver
            $conn = Database::getConnection();
            $query = $conn->prepare("UPDATE users SET reactions = reactions - 1 WHERE id = :receiver");

            $query->bindValue(":receiver", $receiver);
            $result = $query->execute();

            return $result;
        }

        // get all messages of a given receiver and sender id
        public static function getAllMessages($rightId, $leftId) {
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT * FROM `chats` WHERE chat_id_sender = :leftId AND chat_id_receiver = :rightId OR chat_id_receiver = :leftId AND chat_id_sender = :rightId ORDER BY time ASC");
            
            $query->bindValue(":rightId", $rightId);
            $query->bindValue(":leftId", $leftId);
            $query->execute();
            $result = $query->fetchAll();

            return $result;
        }

        public static function getChatIdByReceiverSender($sender, $receiver){
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT id FROM `chat` WHERE receiver_id = :receiver AND sender_id = :sender  OR receiver_id = :sender AND sender_id = :receiver");
            
            $query->bindValue(":sender", $sender);
            $query->bindValue(":receiver", $receiver);
            $query->execute();
            $result = $query->fetchAll();

            return $result;
        }

        public function changeUsername() {
            $conn = Database::getConnection();
            $query = $conn->prepare("UPDATE users SET username = :username WHERE id = :userId");
    
            $query->bindValue(":username", $this->username);
            $query->bindValue(":userId", $this->userId);
            $result = $query->execute();
            
            return $result;
        }

        public function changePicture() {
            $conn = Database::getConnection();
            $query = $conn->prepare("UPDATE users SET profile_picture = :picture WHERE id = :userId");
    
            $query->bindValue(":picture", $this->picture);
            $query->bindValue(":userId", $this->userId);
            $result = $query->execute();
            
            return $result;
        }

        public function makeChat1(){ // when someone starts a convo
            $conn = Database::getConnection();
            $query = $conn->prepare("INSERT INTO chat (receiver_id, sender_id, listing_id, owner_id) VALUES (:userId, :receiverId, :listingId, :ownerId)");
            
            $query->bindValue(":userId", $this->userId);
            $query->bindValue(":receiverId", $this->receiverId);
            $query->bindValue(":listingId", $this->listingId);
            $query->bindValue(":ownerId", $this->receiverId);

            $result = $query->execute();

            return $result;
        }

        public function makeChat2(){ // when someone starts a convo
            $conn = Database::getConnection();
            $query = $conn->prepare("INSERT INTO chat (receiver_id, sender_id, listing_id, owner_id) VALUES (:receiverId, :userId, :listingId, :ownerId)");
            
            $query->bindValue(":userId", $this->userId);
            $query->bindValue(":receiverId", $this->receiverId);
            $query->bindValue(":listingId", $this->listingId);
            $query->bindValue(":ownerId", $this->receiverId);

            $result = $query->execute();

            return $result;
        }

        public function makeMessage(){
            $conn = Database::getConnection();
            $query = $conn->prepare("INSERT INTO chats (chat_id_sender, chat_id_receiver, message, time) VALUES (:userId, :receiverId, :message, :date)");
            
            $query->bindValue(":userId", $this->userId);
            $query->bindValue(":receiverId", $this->receiverId);
            $query->bindValue(":message", $this->message);
            $query->bindValue(":date", $this->date);

            $result = $query->execute();

            return $result;
        }

        public static function getListingIdChats($listingId, $userId) {
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT * FROM chat WHERE listing_id = :listingId AND receiver_id = :userId");
            
            $query->bindValue(":listingId", $listingId);
            $query->bindValue(":userId", $userId);
            $query->execute();
            $result = $query->fetchAll();

            return $result;
        }

        public static function getTitleByListingId($listingId) {
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT title FROM listings WHERE id = :listingId");
            
            $query->bindValue(":listingId", $listingId);
            $query->execute();
            $result = $query->fetch();

            return $result['title'];
        }

        public static function isOwner($listingId, $userId){
            $conn = Database::getConnection();
            $query = $conn->prepare("SELECT owner_id FROM `chat`WHERE listing_id= :listingId LIMIT 1");
            
            $query->bindValue(":listingId", $listingId);
            $query->execute();
            $result = $query->fetch();

            if($result["owner_id"] == $userId) {
                return true;
            } else {
                return false;
            }
        }

    }

?>