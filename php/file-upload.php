<?php

$mysqli = new mysqli("mariadb", "EDF", "edf", "EDF");
$mysqli->set_charset("utf8");
if (isset($_POST["submit"])) {
    // Set image placement folder
    $target_dir = "img_dir/";
    // Get file path
    $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
    $name = basename($_FILES["fileUpload"]["name"]);
    $type = $_FILES["fileUpload"]["type"];
    $taille = basename($_FILES["fileUpload"]["size"]);

    // Get file extension
    $imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Allowed file types
    $allowd_file_ext = array("jpg", "jpeg", "png","gif");

    if (!file_exists($_FILES["fileUpload"]["tmp_name"])) {
        $resMessage = array(
            "status" => "alert-danger",
            "message" => "Select image to upload."
        );
    } else if (!in_array($imageExt, $allowd_file_ext)) {
        $resMessage = array(
            "status" => "alert-danger",
            "message" => "Allowed file formats .jpg, .jpeg and .png."
        );
    } else if ($_FILES["fileUpload"]["size"] > 2097152) {
        $resMessage = array(
            "status" => "alert-danger",
            "message" => "File is too large. File size should be less than 2 megabytes."
        );
    } else if (file_exists($target_file)) {
        $resMessage = array(
            "status" => "alert-danger",
            "message" => "File already exists."
        );
    } else {
        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
            $requete = "INSERT INTO documents (nom,types,taille,paths) VALUES ('$name','$type','$taille','$target_file')";
            $resultat = $mysqli->query($requete);
            if ($resultat) {
                $resMessage = array(
                    "status" => "alert-success",
                    "message" => "Image uploaded successfully."
                );
            }
        } else {
            $resMessage = array(
                "status" => "alert-danger",
                "message" => "Image coudn't be uploaded."
            );
        }
    }
}
?>
