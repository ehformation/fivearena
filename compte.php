<?php
include_once 'include/init.php';

// si il n'yy a pas d'utilisateur connecté
if (!isConnect()) {
    header("Location:" . URL . "connexion.php");
}
?>
<?php
// page principale du compte 
if (isset($_GET["action"]) && $_GET["action"] == "index") {
    include_once 'include/header.php';
?>
    <h1 id="h1">Mon espace perso</h1>
    <div class="col-4 m-auto ulDataUser">
        <ul>
            <li>Email:<?= $_SESSION['user']['email'] ?></li>
            <li>Nom:<?= $_SESSION['user']['nom'] ?></li>
            <li>Prenom:<?= $_SESSION['user']['prenom'] ?></li>
            <li>Tèlèphone<?= $_SESSION['user']['tel'] ?></li>
        </ul>
    </div>
    <div class="row col-8">
        <div class="col-4">
            <a href="<?= URL; ?>compte.php?action=modifier" class="btn btn-yellow">Modifier mon compte</a>
        </div>
        <div class="col-4">
            <a href="<?= URL; ?>compte.php?action=password" class="btn btn-yellow">Modifier mon mot de passe </a>
        </div>
        <div class="col-4">
            <a href="<?= URL; ?>compte.php?action=delete" class="btn btn-yellow " onclick="return confirm('Etes vous sûr de vouloir supprimer votre compte?')">Supprimer mon compte</a>
        </div>
    </div>

<?php
    include_once 'include/footer.php';
}
// Modifier le compte
if (isset($_GET["action"]) && $_GET["action"] == "modifier") {
    include_once 'include/header.php';
    $emailError = "";
    $nomError = "";
    $prenomError = "";
    $telError = "";
    if (isset($_POST["bouton"])) {
        $email = $_POST["email"];
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $tel = $_POST["tel"];
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
                if ($email != $_SESSION['user']['email']) {
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

            // requette avec exec 
            //   $pdo->exec("INSERT INTO user (email, pass, nom, prenom, tel, id_role) VALUES ('$email', '$pass', '$nom', '$prenom', '$tel', 2)");
            if ($access) {
                // 1ère étape : Préparation de la requête
                $pdoStatement = $pdo->prepare('UPDATE user SET email = :email, nom = :nom, prenom = :prenom, tel = :tel WHERE id = :id');
                // 2e étape : Association des marqueurs à leurs valeurs et leurs types
                $pdoStatement->bindParam(':email', $email, PDO::PARAM_STR);
                $pdoStatement->bindParam(':nom', $nom, PDO::PARAM_STR);
                $pdoStatement->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                $pdoStatement->bindParam(':tel', $tel, PDO::PARAM_STR);
                $pdoStatement->bindValue(':id', $_SESSION["user"]['id'], PDO::PARAM_INT);


                // 3e étape : Exécution de la requête
                $pdoStatement->execute();

                $_SESSION['user']['email'] = $email;
                $_SESSION['user']['nom'] = $nom;
                $_SESSION['user']['prenom'] = $prenom;
                $_SESSION['user']['tel'] = $tel;
                header("Location:" . URL . "compte.php?action=index");
            }
        }
    }

?>
    <a href="compte.php?action=index" class="btn btn-yellow full" class="my-5">Mon espace perso</a>

    <h1 class="center">Modifier le compte</h1>
    <form action="" class="form col-4 m-auto" method="post">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Entrez votre mail" value="<?= $_SESSION['user']['email'] ?>" class="full">
        <?= $emailError ?>
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" value="<?= $_SESSION['user']['nom'] ?>" class="full">
        <?= $nomError ?>
        <label for="prenom">Prenom</label>
        <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prenom" value="<?= $_SESSION['user']['prenom'] ?>" class="full">
        <?= $prenomError ?>
        <label for="tel">Tel</label>
        <input type="tel" id="tel" name="tel" placeholder="Entrez votre tel" value="<?= $_SESSION['user']['tel'] ?>" class="full">
        <?= $telError ?>
        <input type="submit" name="bouton" value="Enregistrer" class="btn btn-yellow full">
    </form>
<?php
    include_once 'include/footer.php';
}
// modifier le mot de passe  
if (isset($_GET["action"]) && $_GET["action"] == "password") {
    include_once 'include/header.php';
    $passwordCurentError = "";
    $passError = "";
    if (isset($_POST["bouton"])) {
        $passwordCurent = $_POST["passwordCurent"];
        $passwordNew = $_POST["passwordNew"];
        $passwordConfirm = $_POST["passwordConfirm"];
        // je creer une variable qui permet de verifier sit otu s'est bien passer avec les informations entrer dans la base de donnée 
        $access = true;
        // je verifie si l'email est valide 
        if (empty($passwordCurent)) {
            $access = false;
            $passwordCurentError = "<p class='messageError'>Veuillez saisir votre mot de passe actuel</p>";
        } else {
            $verificationPassword = password_verify($passwordCurent, $_SESSION['user']['pass']);
            if (!$verificationPassword) {
                $access = false;
                $passwordCurentError = "<p class='messageError'>Le mot de passe que vous aviez entrer est incorrecte </p>";
            } else {
                if (empty($passwordNew) || empty($passwordConfirm)) {
                    $access = false;
                    $passError = "<p class='messageError'>Veuillez saisir votre nouveau mot de passe</p>";
                } else {
                    if ($passwordNew != $passwordConfirm) {
                        $access = false;
                        $passError = "<p class='messageError'>Les mots de passe ne sont pas identiques</p>";
                    } else {
                        if (strlen($passwordNew) < 6) {
                            $access = false;
                            $passError = "<p class='messageError'>Le mot de passe doit contenir au moins 6 caractères</p>";
                        }
                    }
                }
            }
            // requette avec exec 
            //   $pdo->exec("INSERT INTO user (email, pass, nom, prenom, tel, id_role) VALUES ('$email', '$pass', '$nom', '$prenom', '$tel', 2)");
            if ($access) {
                // Je fais maintennant une requette pour mettre a jour le mot de passse
                // 1ère étape : Préparation de la requête
                $pdoStatement = $pdo->prepare('UPDATE user SET pass = :passwordNew WHERE id = :id');
                // 2e étape : Association des marqueurs à leurs valeurs et leurs types
                // on veut maintenant hasher le mdp 
                $hashPassword = password_hash($passwordNew, PASSWORD_BCRYPT);
                $pdoStatement->bindParam(':passwordNew', $hashPassword, PDO::PARAM_STR);
                $pdoStatement->bindValue(':id', $_SESSION["user"]['id'], PDO::PARAM_INT);
                // 3e étape : Exécution de la requête
                $pdoStatement->execute();

                $_SESSION['user']['pass'] = $hashPassword;
                header("Location:" . URL . "compte.php?action=index");
            }
        }
    }
?>
    <a href="compte.php?action=index" class="btn btn-yellow full" class="my-5">Mon espace perso</a>
    <h1 id="h1">Modifier le mot de passe</h1>
    <form action="" class="form col-4 m-auto" method="post">
        <label for="passwordCurent">Mot de passe actuelle </label>
        <input type="password" id="passwordCurent" name="passwordCurent" placeholder="Entrez votre mot de passe" class="full">
        <?= $passwordCurentError ?>
        <label for="passwordNew">Nouveau mot de passe</label>
        <input type="password" id="passwordNew" name="passwordNew" placeholder="Entrez votre mot de passe" class="full">
        <?= $passError ?>
        <label for="passwordConfirm">Confirmation de votre nouveau mot de passe </label>
        <input type="password" id="passwordConfirm" name="passwordConfirm" placeholder="Confirmer le mot de passe" class="full">
        <?= $passError ?>
        <input type="submit" name="bouton" value="Enregistrer" class="btn btn-yellow full">
    </form>
<?php
    include_once 'include/footer.php';
}

//page pour  supprimer le compte  
if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    // je veux supprimer l'utilisateur en bdd
    // 1ère étape : Préparation de la requête
    $pdoStatement = $pdo->prepare('DELETE FROM user WHERE id=:id');
    $pdoStatement->bindValue(':id', $_SESSION["user"]['id'], PDO::PARAM_INT);
    // 3e étape : Exécution de la requête
    $pdoStatement->execute();
    // maintenant je supprime l'utilisateur de la session
    unset($_SESSION['user']);
    // je redirige l'utilisateur vers la page principale 
    header("Location:" . URL . "index.php");
    include_once 'include/footer.php';
}
