<?php
if (isset($_POST['valider'])) {
    if (!empty($_POST['nom']) && !empty($_POST['email']) 
    && !empty($_POST['pass']) && !empty($_POST['confirm'])){
    $nom=htmlspecialchars($_POST['nom']);
    $email=htmlspecialchars($_POST['email']);
    $pass= htmlspecialchars($_POST['pass']);
    $confirm= htmlspecialchars($_POST['confirm']);;
    echo"votre nom est :".$nom."</br>";
    echo"votre email est :".$email."</br>";
    echo"votre mot de passe est :".$pass."</br>";
    echo"votre confirmation est :".$confirm."</br>";

    }
 }
 try {
    $serveur = "localhost";
    $login ="root";
    $password="";
    $connexion = new PDO("mysql:host=$serveur;bdname;",$login,$password);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo"la connexion a la base de données est effectuer avec succés"."</br>";
    $mysql="CREATE DATABASE IF NOT EXISTS internauts";
    $connexion->exec($mysql);
    echo"votre base données est créer"."</br>";
    $connexion->exec("use internauts");
    $mysql="CREATE TABLE IF NOT EXISTS internaut(
      id INT AUTO_INCREMENT PRIMARY KEY,
      NOM VARCHAR (50) NOT NULL,
      email VARCHAR(100)NOT NULL,
      pass VARCHAR(75) NOT NULL,
      confirm VARCHAR(75)NOT NULL
)";
    $connexion->exec($mysql);
    echo"votre table est créer dans la base de données"."</br>";

    $mysql="INSERT INTO internaut(nom,email,pass,confirm)VALUE(:nom,:email,:pass,:confirm)";
    $mysql=$connexion->prepare($mysql);
    $mysql->execute([
       ':nom'=>$nom,
       ':email'=>$email,
       ':pass'=>$pass,
       ':confirm'=>$confirm
    ]);
    echo"l'insertion est fait avec succès sur la table internaut";

 } catch (\PDOException $e) {
    echo"error for your try ".$e->getMessage();
 }
?>