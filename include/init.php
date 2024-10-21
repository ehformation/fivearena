<?php
// CLASS / OBJET
// une classe est un regroupement d'informations comprenant des propriétés($variables),des méthodes(functions) et des constantes abordant un sujet 
// on n'utilise pas directement une class(qi est un moule),on génère des objets issu de la class (exemplaire)
// la syntaxe pour generer un objet 
// $Objet =new Class()
session_start();
$pdo = new PDO(
    'mysql:host=localhost;dbname=fivearena', // serveur et le nom de la base données
    'root',// identifiant
    'root', // mot de passe
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // erreur SQL
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', // encodage utf8
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Fetch par défaut
    ]// tableau des options
);

// j'inclus mon ficher function.php
include_once'function.php';

define('URL','http://localhost:8888/fivearena/');
$notification='';

// echo print_r(get_class_methods($pdo));


// les methodes 
// [0] => construct
// [1] => beginTransaction 
// [2] => commit 
// [3] => errorCode 
// [4] => errorInfo 
// [5] => exec (permet de faire insert,update et delete)
// [6] => getAttribute 
// [7] => getAvailableDrivers 
// [8] => inTransaction 
// [9] => lastInsertId 
// [10] => prepare 
// [11] => query (permet de faire les select car il renvoit un jeu de résultats)
// [12] => quote 
// [13] => rollBack 
// [14] => setAttribute




//1e étape : Préparation de la requète 
// $pdoStatement = $pdo->prepare('SELECT * FROM user WHERE id = :idMarqueur');

// 2e étape : Association des marqueurs à leurs valeurs et leurs types
// $id = 3;
// $pdoStatement->bindParam(':idMarqueur', $id, PDO::PARAM_INT);
// On peut aussi faire ca mais la difference c'est que ici on mets directemeent la f*valeur remplie da,s le formulaire alores que le premier il faut forcement mettre dans une variable .
// $pdoStatement->bindValue(':idMarqueur', 3, PDO::PARAM_INT);


// 3e étape : Execution de la requête
// $pdoStatement->execute();


// $user3 = $pdoStatement->fetch();




