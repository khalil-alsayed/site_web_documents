<?php

$mysqli = new mysqli("mariadb", "UU", "UU", "UU");
$id = $_GET['id'];
if (isset($_POST['submit'])) {
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $requete = "INSERT INTO UU (nom, prenom) VALUES('$nom','$prenom')";
  $resultat = $mysqli->query($requete);
  if ($resultat) {
    $mysqli->close(); // Close connection
    header("location:insert.php"); // redirects to all records page
    exit;
  } else {
    echo "Error insert record";
  }
}


?>
<html>

<head>
  <title>Add information in Database</title>
  <style>
    body {
      text-align: center;
      background-image: url("splash.webp");
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
</head>
<h3>Ajouter des information dans la base des données</h3>

<body>

  <form method="POST">
    Nom : <input type="text" name="nom" placeholder="Entrez le nom" Required>
    <br />
    Prenom : <input type="text" name="prenom" placeholder="Entrez le prenom" Required>
    <br />
    <input type="submit" name="submit" value="Submit">
  </form>

</body>

</html>