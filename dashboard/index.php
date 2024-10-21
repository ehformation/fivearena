<?php
    include '../include/init.php';

    if (!isAdmin()) {
        header("Location:" . URL . "index.php");
    }

    if (isset($_SESSION['notification'])  && isset($_SESSION['notification']['connexion']) ) {
        $notification = "<p class='p-10 white col-6 mx-auto ai-center bg-" . $_SESSION['notification']['connexion']['type'] .  "' >" . $_SESSION['notification']['connexion']['content'] . "</p>";
    }


    include '../include/header.php';
?>

    <h1 id="h1">Back office</h1>

    <?= $notification; ?>



<?php
    include '../include/footer.php';

    unset($_SESSION['notification']['connexion']);
