<?php
session_start();
if (isset($_POST['valider'])) {
   if (!empty($_POST['nom'])&&!empty($_POST['phone'])&&!empty($_POST['marque'])&&!empty($_POST['model'])&&!empty($_POST['prix'])) {
    $nom=htmlspecialchars($_POST['nom']);
    $phone=htmlspecialchars($_POST['phone']);
    $marque=htmlspecialchars($_POST['marque']);
    $model=htmlspecialchars($_POST['model']);
    echo"votre nom est de :".$nom."</br>";
    echo"votre numéro est de :".$phone."</br>";
    echo"la marque choisi est de :".$marque."</br>";
    echo"le model choisit est de  :".$model."</br>";
   }
}
try {
    $serveur="localhost";
    $login="root";
    $pass="";
    $connexion = new PDO ("mysql:host=$serveur;",$login,$pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo" connection établi "."</br>";
    $sql="CREATE DATABASE IF NOT EXISTS PANIERS";
    $connexion->exec($sql);
    echo"la base de donnée panier est créer"."</br>";
    $connexion->exec("use PANIERS");
    $sql="CREATE TABLE IF NOT EXISTS commande(
     id_commande INT AUTO_INCREMENT PRIMARY KEY,
     nom VARCHAR(50) NOT NULL,
     phone INT  NOT NULL,
     marque VARCHAR(50) NOT NULL,
     model VARCHAR(50) NOT NULL
    )";
    $connexion->exec($sql);
    echo"votre table commande est crée dans la base de donée paniers"."</br>";
    $connexion->exec("use PANIERS");
   $sql="INSERT INTO commande(nom,phone,marque,model)VALUE(:nom,:phone,:marque,:model)";
   $sql=$connexion->prepare($sql);
   $sql->execute([
     ":nom"=>$nom,
     ":phone"=>$phone,
     ":marque"=>$marque,
     ":model"=>$model
   ]);
   echo" votre comande est inserer dans la table commande de la base de donnée";
} catch (PDOException $e) {
    echo"il y a une erreur quelque part".$e->getMessage();
}
?>
