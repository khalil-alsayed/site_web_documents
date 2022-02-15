<?php
$mysqli = new mysqli("mariadb", "EDF", "edf", "EDF");
$mysqli->set_charset("utf8");
$name = basename($_FILES["monfichier"]["name"]);
$type = $_FILES["monfichier"]["type"];
$taille = basename($_FILES["monfichier"]["size"]);
$target_dir = "uploads/";
$target_file = $target_dir.basename($_FILES["monfichier"]["name"]);
if (isset($_FILES["monfichier"]) && $_FILES["monfichier"]["error"] == 0) {
    if ($_FILES["monfichier"]["size"] <= 1000000) {
        $infosfichier = pathinfo($_FILES["monfichier"]["name"]);
        $extension_upload = $infosfichier["extension"];
        $extensions_autorisees = array("jpg", "jpeg", "gif", "png");
        
        if (in_array($extension_upload, $extensions_autorisees)) {
            move_uploaded_file($_FILES["monfichier"]["tmp_name"], $target_file);
            $requete = "INSERT INTO documents (nom,types,taille,paths) VALUES ('$name','$type','$taille','$target_file')";
            $resultat = $mysqli->query($requete);
            echo "l'envoi a bien été effectué !";   
        }
    }
}
else {
    echo "error";
}
