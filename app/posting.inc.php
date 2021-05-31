<?php
    $userId = $_SESSION['userId'];
    var_dump($userId);
    var_dump($_FILES['image_input']['tmp_name']);
    var_dump($_POST['title']);
    var_dump($_POST['quality']);
    var_dump(date("Y-m-d H:i:s"));

    if(!empty($_POST)) {
        try {
            /*$currentDirectory = getcwd();
            $uploadDirectory = "/post_uploads/"; //Directory where posted image will be located

            $finalFileName = $userId."_post_".date("YmdHis").".jpg";

            if($_FILES["image_input"]["type"] != "image/png"){
                $fileName = $finalFileName;
            } else {
                $fileName = $userId."_post_".date("YmdHis").".png";
            }
            
            $fileTmpName  = $_FILES['image_input']['tmp_name'];*/

            $listing = new Listing();
            $listing->setUserId($userId);
            $listing->setPicture(/*$finalFileName*/ $_FILES['image_input']['tmp_name']); 
            $listing->setTitle($_POST['title']);
            $listing->setFreshness($_POST['quality']);
            $listing->setDate(date("Y-m-d H:i:s"));

            $listing->submit();  

            /*$fileSaveQuality = 60; 

            $uploadPath = $currentDirectory . $uploadDirectory . $fileName;

            move_uploaded_file($fileTmpName, $uploadPath);

            if($_FILES["image_input"]["type"] != "image/png"){
                $imageToResize = imagecreatefromjpeg("post_uploads/".$fileName);
            } else {
                $imageToResize = imagecreatefrompng("post_uploads/".$fileName);
                unlink("post_uploads/".$fileName);
            }

            imagejpeg($imageToResize, 'post_uploads/'.$finalFileName, $fileSaveQuality);
            imageDestroy($imageToResize);*/

            $postOK = true;
        } catch (Throwable $e) {
            $error = $e->getMessage();
        }
    }