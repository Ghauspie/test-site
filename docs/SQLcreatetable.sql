CREATE TABLE `product` (
  `id` int unsigned NOT NULL COMMENT 'L\'identifiant de notre produit' AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(64) COLLATE 'armscii8_bin' NOT NULL COMMENT 'Le nom du produit',
  `description` text COLLATE 'armscii8_bin' NULL COMMENT 'La description du produit',
  `picture` varchar(128) COLLATE 'armscii8_bin' NULL COMMENT 'L\'URL de l\'image du produit',
  `price` decimal(10,2) NOT NULL DEFAULT '0' COMMENT 'Le prix du produit',
  `rate` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'L\'avis sur le produit, de 1 à 5',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Le statut du produit (1=dispo, 2=pas dispo)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'La date de création du produit',
  `updated_at` timestamp NULL COMMENT 'La date de la dernière mise à jour du produit',
  `brand` int NOT NULL COMMENT 'La marque (autre entité) du produit',
  `category` int NULL COMMENT 'La catégorie (autre entité) du produit',
);

CREATE TABLE `category` (
  `id` int unsigned NOT NULL COMMENT 'L\'identifiant de la catégorie' AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(64) COLLATE 'armscii8_bin' NOT NULL COMMENT 'Le nom de la catégorie',
  `subtitle` varchar(64) NULL COMMENT 'Le sous-titre/slogan de la catégorie',
  `picture` varchar(128) NULL COMMENT 'L\'URL de l\'image de la catégorie (utilisée en home, par exemple)',
  `home_order` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'L\'ordre d\'affichage de la catégorie sur la home (0=pas affichée en home)',
  `created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'La date de création de la catégorie',
  `updated_at` timestamp NULL COMMENT 'La date de la dernière mise à jour de la catégorie'
);


CREATE TABLE `brand` (
  `id` int unsigned NOT NULL COMMENT 'L\'identifiant de la marque' AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(64) NOT NULL COMMENT 'Le nom de la marque',
  `footer_order` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'L\'ordre d\'affichage de la marque dans le footer (0=pas affichée dans le footer)',
  `created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'La date de création de la marque',
  `updated_at` timestamp NULL COMMENT 'La date de la dernière mise à jour de la marque'
) COLLATE 'armscii8_bin';

CREATE TABLE `type` (
  `id` int unsigned NOT NULL COMMENT 'L\'identifiant du type' AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(64) NOT NULL COMMENT 'Le nom du type',
  `footer_order` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'L\'ordre d\'affichage du type dans le footer (0=pas affichée dans le footer)',
  `created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'La date de création du type',
  `updated_at` timestamp NULL COMMENT 'La date de la dernière mise à jour du type'
) COLLATE 'armscii8_bin'