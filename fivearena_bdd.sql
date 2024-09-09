-- Création de la table des rôles
CREATE TABLE `rôle` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(100) NOT NULL
);

-- Création de la table des utilisateurs
CREATE TABLE `user` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(100) UNIQUE NOT NULL,
    `pass` VARCHAR(255) NOT NULL,
    `nom` VARCHAR(100) NOT NULL,
    `prenom` VARCHAR(100) NOT NULL,
    `tel` VARCHAR(20) NOT NULL,
    `id_role` INT NOT NULL,
    FOREIGN KEY (`id_role`) REFERENCES `rôle`(`id`)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
);

-- Création de la table des terrains
CREATE TABLE `terrain` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(100) NOT NULL,
    `prix` VARCHAR(10) NOT NULL,
    `adresse` TEXT NOT NULL,
    `description` TEXT NOT NULL,
    `image` TEXT NOT NULL,
    `surface` ENUM('pelouse', 'beton', 'sable', 'synthetique') NOT NULL,
    `options` TEXT NOT NULL
);

-- Création de la table des réservations
CREATE TABLE `reservation` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `dateheure` DATETIME NOT NULL,
    `status` ENUM('en attente', 'confirmé', 'annulé', 'en cours', 'terminé') NOT NULL,
    `id_user` INT,
    `id_terrain` INT NOT NULL,
    FOREIGN KEY (`id_user`) REFERENCES `user`(`id`)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    FOREIGN KEY (`id_terrain`) REFERENCES `terrain`(`id`)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
);
