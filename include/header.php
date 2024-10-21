<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Five Arena - Réservation de five</title>
    <link rel="shortcut icon" href="<?= URL; ?>images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= URL; ?>css/reset.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="<?= URL; ?>css/style.css">
    <script src="https://kit.fontawesome.com/81e489c8c5.js" crossorigin="anonymous"></script>
</head>

<body>
    <header id="header" class="bg-image pt-40 pb-40">
        <div class="container mb-50">
            <div class="row ai-center">
                <div id="logo" class="cadre">
                    <img src="<?=URL;?>images/logo-fa.png" alt="Logo five Arena">
                </div>
                <nav id="nav" class="cadre">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="">Nos terrains</a></li>
                        <li><a href="">Contact</a></li>
                        <?php if (isConnect()): ?>
                            <li><a href="<?=URL;?>compte.php?action=index">Mon espace perso</a></li>
                        <?php endif; ?>
                        <?php if (isAdmin()): ?>
                            <li><a href="<?= URL;?>dashboard/index.php">Back Office</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <div id="sign">
                    <?php if (isConnect()): ?>
                        <a class="btn btn-blue col-6 " href="<?=URL;?>deconnexion.php">Deconnexion</a>
                    <?php else: ?>
                        <a class="btn btn-blue  col-6" href="<?=URL;?>inscription.php">Inscription </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="container">

            <div class="row jc-between">
                <div class="col-4">
                    <div id="headlines">
                        <h1 class="white pb-30">Five Arena : Reservez votre terrains</h1>
                        <p class="white pb-30">Reservez sur plus de 200 terrains disponible </p>
                    </div>
                </div>
                <div class="col-4">
                    <div id="search-terrain" class="cadre">
                        <h2 class="mb-30">Rechercher votre terrains</h2>
                        <form action="" class="form">
                            <div>
                                <select name="type_surface" class="full">
                                    <option value="">Séléctionnez le type de surface</option>
                                    <option value="">Pelouse</option>
                                    <option value="">Béton</option>
                                </select>
                            </div>
                            <div>
                                <input type="date" name="date" class="full">
                            </div>
                            <button type="submit" class="btn btn-yellow full">Rechercher</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>