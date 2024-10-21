<?php
 include_once 'include/init.php';

 unset($_SESSION['user']);
 $_SESSION["notification"]['deconnexion'] = ['type' => 'success', 'content' => 'Vous êtes bien deconnecté'];
 header("location:" . URL . "index.php");


 header("Location:". URL . "connexion.php");