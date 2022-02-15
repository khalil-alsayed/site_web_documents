<!DOCTYPE html>
<html>

<head>
  <title>Display all records from Database</title>
  <style>
    body {

      text-align: center;
      background-image: url("splash.webp");


      background-repeat: no-repeat;
      background-size: cover;
    }

    table.center {
      margin-left: auto;
      margin-right: auto;
    }

    table,
    th,
    td {
      border: 1px solid black;
      border-collapse: collapse;
    }
  </style>
</head>

<body>

  <h2>Formulaire fichier unique</h2>


  <table class="center">
    <tr>
      <th>Id</th>
      <th>Nom</th>
      <th>Prenom</th>
      <th>Changer</th>
      <th>supprimer</th>
    </tr>

    <?php


    $mysqli = new mysqli("mariadb", "UU", "UU", "UU");


    if (!$mysqli) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $requete = "SELECT * FROM UU";
    $resultat = $mysqli->query($requete); // fetch data from database

    while ($ligne = $resultat->fetch_object()) {
    ?>
      <tr>
        <td><?php echo $ligne->id; ?></td>
        <td><?php echo $ligne->nom; ?></td>
        <td><?php echo $ligne->prenom; ?></td>
        <td><a href="edit.php?id=<?php echo $ligne->id; ?>">changer</a></td>
        <td><a href="delete.php?id=<?php echo $ligne->id; ?>">supprimer</a></td>

      </tr>
    <?php
    }

    ?>
    <a href="ajouter.php?id=<?php echo $ligne->id; ?>">Ajouter</a>
  </table>

</body>

</html>