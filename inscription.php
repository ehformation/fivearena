<?php
include_once 'include/init.php';

$emailError = "";
$nomError = "";
$prenomError = "";
$telError = "";
$passError = "";
if (isset($_POST["bouton"])) {
    $email = $_POST["email"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $tel = $_POST["tel"];
    $pass = $_POST["pass"];
    $confirm = $_POST["confirm"];
    $id_role = 2;
    // je creer une variable qui permet de verifier sit otu s'est bien passer avec les informations entrer dans la base de donnée 
    $access = true;
    if (empty($email)) {
        $access = false;
        $emailError = "<p class='messageError'>Veuillez saisir votre adresse email</p>";
    } else {
        // je verifie maintenant si l'email est valide 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $access = false;
            $emailError = "<p class='messageError'>Votre email n'est pas conforme</p>";
        } else {
            // je verifie ensuite si l'email n'est pas déja associé a un compte donc je fais une requette 
            $pdoStatement = $pdo->prepare('SELECT * FROM user where email=:email');
            $pdoStatement->bindParam(':email', $email, PDO::PARAM_STR);
            $pdoStatement->execute();
            $searchUser =  $pdoStatement->fetch();
            if ($searchUser) {
                $access = false;
                $emailError = '<p class="messageError">Cet email est déjà associé à un compte</p>';
            }
        }
    }
    if (empty($nom)) {
        $access = false;
        $nomError = "<p class='messageError'>Veuillez saisir votre nom</p>";
    } else {
        if (strlen($nom) < 2 || strlen($nom) > 100) {
            $access = false;
            $nomError = "<p class='messageError'>Veuillez saisir un nom entre 2 et 100 caractères</p>";
        }
    }
    if (empty($prenom)) {
        $access = false;
        $prenomError = "<p class='messageError'>Veuillez saisir votre prenom</p>";
    } else {
        if (strlen($prenom) < 2 || strlen($prenom) > 100) {
            $access = false;
            $prenomError = "<p class='messageError'>Veuillez saisir un prenom entre 2 et 100 caractères</p>";
        }
    }
    if (empty($tel)) {
        $access = false;
        $telError = "<p class='messageError'>Veuillez saisir votre tel</p>";
    } else {
        if (strlen($tel) < 9 || strlen($tel) > 20) {
            $access = false;
            $telError = "<p class='messageError'>Veuillez saisir un tel d'au moins 9 et d'au plus 20 chiffres</p>";
        }
        if (empty($pass) || empty($confirm)) {
            $access = false;
            $passError = "<p class='messageError'>Veuillez saisir votre mot de passe</p>";
        } else {
            if ($pass != $confirm) {
                $access = false;
                $passError = "<p class='messageError'>Les mots de passe ne sont pas identiques</p>";
            } else {
                if (strlen($pass) < 6) {
                    $access = false;
                    $passError = "<p class='messageError'>Le mot de passe doit contenir au moins 6 caractères</p>";
                }
            }
        }

        // requette avec exec 
        //   $pdo->exec("INSERT INTO user (email, pass, nom, prenom, tel, id_role) VALUES ('$email', '$pass', '$nom', '$prenom', '$tel', 2)");
        if ($access) {
            // 1ère étape : Préparation de la requête
            $pdoStatement = $pdo->prepare('INSERT INTO user (email, pass, nom, prenom, tel, id_role) VALUES (:email, :pass, :nom, :prenom, :tel, :id_role)');
            // 2e étape : Association des marqueurs à leurs valeurs et leurs types
            $pdoStatement->bindParam(':email', $email, PDO::PARAM_STR);
            // on veut maintenant hasher le mdp 
            $hashPassword = password_hash($pass, PASSWORD_BCRYPT);
            $pdoStatement->bindParam(':pass', $hashPassword, PDO::PARAM_STR);
            $pdoStatement->bindParam(':nom', $nom, PDO::PARAM_STR);
            $pdoStatement->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $pdoStatement->bindParam(':tel', $tel, PDO::PARAM_STR);
            $pdoStatement->bindValue(':id_role', 2, PDO::PARAM_INT);


            // 3e étape : Exécution de la requête
            $pdoStatement->execute();
            header("Location:". URL . "connexion.php");
        }
    }
}



include_once "include/header.php";

?>
<div id="search-terrain" class="cadre col-12" ">
    <h2 class=" mb-30 jc-center center">Inscription</h2>
    <form action="" class="form col-4 m-auto" method="post">
        <label for="email">Email <span class="red">*</span></label>
        <input type="text" id="email" name="email" placeholder="Entrez votre email" class="full">
        <?= $emailError ?>
        <label for="nom">Nom <span class="red">*</span></label>
        <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" class="full">
        <?= $nomError ?>
        <label for="prenom">Prenom <span class="red">*</span></label>
        <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prenom" class="full">
        <?= $prenomError ?>
        <label for="tel">Tel <span class="red">*</span></label>
        <input type="tel" id="tel" name="tel" placeholder="Entrez votre tel" class="full">
        <?= $telError ?>
        <label for="pass">Mot de passe <span class="red">*</span></label>
        <input type="password" id="pass" name="pass" placeholder="Entrez votre mot de passe" class="full">
        <?= $passError ?>
        <label for="confirm-password">Confirmation de votre mot de passe <span class="red">*</span> </label>
        <input type="password" id="confirm-password" name="confirm" placeholder="Confirmer le mot de passe" class="full">
        <?= $passError ?>
        <input type="submit" name="bouton" value="Inscription" class="btn btn-yellow full">
    </form>
    <?php
    include_once("include/footer.php")
    ?>
</div>