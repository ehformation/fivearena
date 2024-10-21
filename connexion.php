<?php
include_once 'include/init.php';

$emailError = "";
$passError = "";
if (isset($_POST["bouton"])) {
    $email = $_POST["email"];
    $pass = $_POST["pass"];
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
            // Je veux maintenant recuperer l'utilisateur en base de donnée  
            $pdoStatement = $pdo->prepare('SELECT * FROM user where email=:email');
            $pdoStatement->bindParam(':email', $email, PDO::PARAM_STR);
            $pdoStatement->execute();
            $user =  $pdoStatement->fetch();
            if (!$user) {
                $access = false;
                $emailError = "<p class='messageError'>Cet email n'est pas associé à un compte</p>";
            } else {
                // on verifie mtn le mdp 
                if (empty($pass)) {
                    $access = false;
                    $passError = "<p class='messageError'>Veuillez entrer votre mot de passe </p>";
                } else {
                    $verified_pass = password_verify($pass, $user['pass']);

                    if (!$verified_pass) {
                        $access = false;
                        $passError = "<p class='messageError'>L'email ou le mot de passe est incorrecte+ </p>";
                    }
                }
            }
        }
    }
    if ($access) {
        $_SESSION["user"] = $user;
        $_SESSION["notification"]['connexion'] = ['type' => 'success', 'content' => 'Vous êtes bien connecté'];
        // je veux differencier la connexion de l'administrateur a celui d'un simple utilisateur 
        if (isAdmin()) {
            header("Location:" . URL . "dashboard/index.php");
        } else {
            header("Location:" . URL . "index.php");
        }
    }
}
if (isset($_SESSION['notification']) && isset($_SESSION['notification']['deconnexion'])) {
    $notification = "<p class='col-12 ta-center bg-" . $_SESSION['notification']['deconnexion']['type'] . "'>" . $_SESSION['notification']['deconnexion']['content'] . "</p>";
}



include_once "include/header.php";
echo $notification;
?>
<div id="search-terrain" class="cadre col-12" ">
    <h2 class=" mb-30 jc-center center">Connexion</h2>
    <form action="" class="form col-4 m-auto" method="post">
        <label for="email">Email <span class="red">*</span></label>
        <input type="text" id="email" name="email" placeholder="Entrez votre email" class="full">
        <?= $emailError ?>
        <label for="pass">Mot de passe<span class="red">*</span></label>
        <input type="password" id="pass" name="pass" placeholder="Entrez votre mot de passe" class="full">
        <?= $passError ?>
        <input type="submit" name="bouton" value="Connexion" class="btn btn-yellow full">
    </form>
</div>

<?php
include_once("include/footer.php");
unset($_SESSION['notification']['deconnexion']);