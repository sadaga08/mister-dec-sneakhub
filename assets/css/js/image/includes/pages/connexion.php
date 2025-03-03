<?php
session_start();
if (isset($_POST['valider'])) {
   if (!empty($_POST['email'])&&!empty($_POST['pass'])) {
     $email=htmlspecialchars($_POST['email']);
     $pass=htmlspecialchars($_POST['pass']);
     echo"votre email est :".$_POST['email']."</br>";
     echo"votre mot de passe est :".password_hash($_POST['pass'],PASSWORD_BCRYPT)."</br>";
   }
   try {
    $serveur="localhost";
    $login="root";
    $pass="";
    $connexion=new PDO("mysql:host=$serveur;bdname;",$login,$pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo"votre connexion est étable avec succès"."</br>";
    $sql="CREATE DATABASE IF NOT EXISTS connexion";
    $connexion->exec($sql);
    echo"votre base de données de connexion est créer"."</br>";
    $connexion->exec("use connexion");
    $sql="CREATE TABLE IF NOT EXISTS membre(
    id_MENBRE INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR (50),
    pass VARCHAR(75)
)";
echo"votre table est créer avec succès"."</br>";
$connexion->exec($sql);

$sql = "INSERT INTO membre(emal, pass)VALUE(:emal,:pass)";
$sql = $connexion->prepare($sql);
$sql->execute([
    ':emal' => $email,
    ':pass' => $pass,
]);
echo "Votre insertion est effectuée avec succès."."</br>";
echo"votre table de menbre est créer dans la base de donnée connexion";
   } catch (PDOException $e) {
    echo"error for your try".$e->getMessage();
   }
}
?>
