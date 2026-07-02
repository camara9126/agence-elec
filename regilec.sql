-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 02 juil. 2026 à 15:35
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `regilec`
--

-- --------------------------------------------------------

--
-- Structure de la table `achats`
--

CREATE TABLE `achats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(255) NOT NULL,
  `fournisseur_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `statut` enum('annule','recu') NOT NULL DEFAULT 'recu',
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `achats`
--

INSERT INTO `achats` (`id`, `reference`, `fournisseur_id`, `total`, `statut`, `note`, `created_at`, `updated_at`) VALUES
(2, 'ACH-AXLZZ7', 2, 525000.00, 'recu', 'Conditions commerciales:\r\nConditions de paiement : 100 % à la livraison par chèque ou espèces\r\nPour les paiements par chèque, les marchandises ne seront livrables qu\'une fois le chèque encaissé', '2026-07-01 08:39:20', '2026-07-01 08:39:20');

-- --------------------------------------------------------

--
-- Structure de la table `achat_details`
--

CREATE TABLE `achat_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `achat_id` bigint(20) UNSIGNED NOT NULL,
  `designation` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `achat_details`
--

INSERT INTO `achat_details` (`id`, `achat_id`, `designation`, `quantite`, `prix_unitaire`, `total`, `created_at`, `updated_at`) VALUES
(1, 2, 'cable ethernet', 10, 30000.00, 300000.00, '2026-07-01 08:39:20', '2026-07-01 08:39:20'),
(2, 2, 'fil conducteur', 15, 15000.00, 225000.00, '2026-07-01 08:39:20', '2026-07-01 08:39:20');

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `telephone`, `email`, `adresse`, `created_at`, `updated_at`) VALUES
(1, 'Oumar Ndiaye', '7765437893', 'ndiaye1903oumar@gmail.com', NULL, '2026-06-29 10:59:55', '2026-06-29 10:59:55'),
(2, 'ousseynou diop', '76845092', NULL, NULL, '2026-06-29 12:52:51', '2026-06-29 12:52:51'),
(3, 'Aida Wade', '776003468', 'wadebusiness@gmail.com', NULL, '2026-06-29 12:54:04', '2026-07-01 13:06:32'),
(4, 'fatou kane', '78845922', 'fashion2.0@gmail.com', NULL, '2026-06-29 12:54:40', '2026-06-29 12:54:40');

-- --------------------------------------------------------

--
-- Structure de la table `contrats`
--

CREATE TABLE `contrats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `contenu` longtext NOT NULL,
  `date` date NOT NULL,
  `statut` tinyint(1) NOT NULL DEFAULT 1,
  `editeur` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contrats`
--

INSERT INTO `contrats` (`id`, `titre`, `reference`, `contenu`, `date`, `statut`, `editeur`, `created_at`, `updated_at`) VALUES
(1, 'Contrat test', 'REF-1782902121', '<p>Ce modèle reproduit fidèlement votre devis avec :</p><ul><li><strong>En-tête complet</strong> avec toutes les coordonnées de l\'entreprise</li><li><strong>Informations client</strong> structurées</li><li><strong>Tableau des produits</strong> avec colonnes Designation, Quantité, Prix unitaire et Prix total</li><li><strong>Totaux calculés</strong> (Total matériel, Main d\'œuvre, Total HTVA)</li><li><strong>Montant en lettres</strong></li><li><strong>Signature</strong></li><li><strong>Conditions commerciales</strong> et notes</li><li><strong>Design responsive</strong> pour mobile et impression</li></ul><p>Le design est épuré, professionnel et utilise une palette sobre (noir, blanc, gris) comme le PDF original. Le tableau est bien structuré avec des totaux mis en évidence.</p>', '2026-07-01', 1, 'Amadou Camara', '2026-07-01 09:35:21', '2026-07-01 09:35:21');

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

CREATE TABLE `devis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(255) NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `statut` enum('en_attente','valide','refuse') NOT NULL DEFAULT 'en_attente',
  `date_devis` date NOT NULL,
  `date_expiration` date DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `objet` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `devis`
--

INSERT INTO `devis` (`id`, `reference`, `client_id`, `total`, `statut`, `date_devis`, `date_expiration`, `note`, `created_at`, `updated_at`, `objet`) VALUES
(2, 'DEV-WIW0SH', 3, 490000.00, 'valide', '2026-06-30', '2026-07-06', NULL, '2026-06-29 13:01:46', '2026-06-30 08:51:16', NULL),
(3, 'DEV-O9OUOB', 2, 700000.00, 'valide', '2026-06-30', '2026-07-07', NULL, '2026-06-30 08:52:31', '2026-06-30 08:54:01', NULL),
(9, 'DEV-UT2IDQ', 2, 50000.00, 'valide', '2026-06-30', '2026-07-30', NULL, '2026-06-30 10:32:38', '2026-06-30 10:33:12', NULL),
(11, 'DEV-8NEEKX', 2, 85000.00, 'en_attente', '2026-06-30', '2026-07-30', NULL, '2026-06-30 10:50:14', '2026-06-30 10:50:14', NULL),
(12, 'DEV-ZJOPEN', 2, 75000.00, 'valide', '2026-07-01', '2026-07-30', NULL, '2026-06-30 10:51:02', '2026-07-01 11:26:13', 'Fourniture et pose de dispositif de surveillance de l\'énergie sous branchement');

-- --------------------------------------------------------

--
-- Structure de la table `devis_details`
--

CREATE TABLE `devis_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `devis_id` bigint(20) UNSIGNED NOT NULL,
  `designation` varchar(255) NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `devis_details`
--

INSERT INTO `devis_details` (`id`, `devis_id`, `designation`, `service_id`, `quantite`, `prix_unitaire`, `total`, `created_at`, `updated_at`) VALUES
(4, 2, '', 1, 3, 35000.00, 105000.00, '2026-06-30 08:51:16', '2026-06-30 08:51:16'),
(5, 2, '', 1, 10, 35000.00, 350000.00, '2026-06-30 08:51:16', '2026-06-30 08:51:16'),
(6, 2, '', 1, 1, 35000.00, 35000.00, '2026-06-30 08:51:16', '2026-06-30 08:51:16'),
(7, 3, '', 1, 20, 35000.00, 700000.00, '2026-06-30 08:52:31', '2026-06-30 08:52:31'),
(8, 9, 'installation reseau', NULL, 1, 50000.00, 50000.00, '2026-06-30 10:32:38', '2026-06-30 10:32:38'),
(9, 11, 'installation reseau', NULL, 1, 25000.00, 25000.00, '2026-06-30 10:50:14', '2026-06-30 10:50:14'),
(10, 11, 'maintenance', NULL, 2, 30000.00, 60000.00, '2026-06-30 10:50:14', '2026-06-30 10:50:14'),
(15, 12, 'installation reseau', NULL, 1, 45000.00, 45000.00, '2026-07-01 11:26:13', '2026-07-01 11:26:13'),
(16, 12, 'maintenance informatique', NULL, 1, 30000.00, 30000.00, '2026-07-01 11:26:13', '2026-07-01 11:26:13');

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `taux_tva` decimal(5,2) NOT NULL DEFAULT 18.00,
  `ninea` varchar(255) DEFAULT NULL,
  `rib` varchar(255) DEFAULT NULL,
  `rccm` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom`, `telephone`, `email`, `adresse`, `logo`, `taux_tva`, `ninea`, `rib`, `rccm`, `created_at`, `updated_at`) VALUES
(1, 'regilec', '77 565 41 22', 'contact@regilec.com', 'DOUGAR OUEST VILLA N.687 ROUTE DE MBOUR X CROISEMENT YENN', 'logo/1782737613Regilec.png', 18.00, '0124 933 76 1R1', 'SN1170100425154944400304', 'SN.DKR.2025.A 37523', '2026-06-29 12:41:51', '2026-06-29 11:53:33');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `statut` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `nom`, `telephone`, `email`, `adresse`, `statut`, `created_at`, `updated_at`) VALUES
(2, 'senelec', NULL, NULL, NULL, 1, '2026-07-01 08:39:20', '2026-07-01 08:39:20');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_29_093613_create_services_table', 1),
(5, '2026_06_29_093614_create_contrats_table', 1),
(6, '2026_06_29_093630_create_clients_table', 1),
(7, '2026_06_29_093632_create_devis_table', 1),
(8, '2026_06_29_093643_create_devis_details_table', 1),
(9, '2026_06_29_122722_create_entreprises_table', 2),
(10, '2026_06_30_120951_create_fournisseurs_table', 3),
(11, '2026_06_30_121004_create_achats_table', 3),
(12, '2026_06_30_121122_create_achat_details_table', 3),
(13, '2026_07_01_113155_add_column_to_devis_table', 4),
(14, '2026_07_01_135230_create_ventes_table', 5),
(15, '2026_07_01_135236_create_vente_items_table', 6),
(16, '2026_07_01_135627_create_paiements_table', 7),
(17, '2026_07_01_135636_create_recettes_table', 7);

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

CREATE TABLE `paiements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vente_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `entreprise_id` bigint(20) UNSIGNED DEFAULT NULL,
  `montant` decimal(15,2) NOT NULL,
  `mode_paiement` enum('cash','wave','orange_money','banque','autre') NOT NULL,
  `reference` varchar(255) NOT NULL,
  `date_paiement` date DEFAULT NULL,
  `statut` enum('valide','annule') NOT NULL DEFAULT 'valide',
  `motif` text DEFAULT NULL,
  `annule_par` bigint(20) UNSIGNED DEFAULT NULL,
  `annule_le` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `paiements`
--

INSERT INTO `paiements` (`id`, `vente_id`, `user_id`, `entreprise_id`, `montant`, `mode_paiement`, `reference`, `date_paiement`, `statut`, `motif`, `annule_par`, `annule_le`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 1, 879100.00, 'cash', 'PAY-1782993038', '2026-07-02', 'valide', NULL, NULL, NULL, '2026-07-02 10:50:38', '2026-07-02 10:50:38');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

CREATE TABLE `recettes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(255) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `montant` decimal(15,2) NOT NULL,
  `date_recette` date NOT NULL,
  `paiement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mode_paiement` enum('cash','orange_money','wave','banque','autre') NOT NULL,
  `statut` enum('recu','annule') NOT NULL DEFAULT 'recu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recettes`
--

INSERT INTO `recettes` (`id`, `user_id`, `reference`, `libelle`, `description`, `montant`, `date_recette`, `paiement_id`, `mode_paiement`, `statut`, `created_at`, `updated_at`) VALUES
(1, 1, 'REC-1782989969', 'Paiement vente VNT-1782989969', NULL, 64900.00, '2026-07-02', NULL, 'cash', 'recu', '2026-07-02 09:59:29', '2026-07-02 09:59:29'),
(2, 1, 'REC-1782993038', 'Paiement vente VNT-1782993038', NULL, 879100.00, '2026-07-02', 2, 'cash', 'recu', '2026-07-02 10:50:38', '2026-07-02 10:50:38');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `prix` decimal(15,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `statut` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `reference`, `nom`, `slug`, `description`, `prix`, `image`, `statut`, `created_at`, `updated_at`) VALUES
(1, 'REF-1782734963', 'Audit & Qualité Réseau', 'audit-qualite-reseau', 'Campagnes de mesures approfondies et traçabilité complète pour identifier les failles masquées de vos installations.\r\n Collecte de données massives: Déploiement d\'analyseurs de réseau électrique haut de gamme (type AWD 300 ACREL) générant plus d\'un million de points de mesures en temps réel.\r\n Cartographie des consommations: Analyse fine des profils de charge pour identifier les équipements énergivores (ciblages prioritaires des systèmes de climatisation et motorisations industrielles).\r\n Expertise sécurité: Diagnostic des câbles sous-dimensionnés et détection précoce des échauffements anormaux derrière les cloisons pour prévenir tout départ de feu.', 1000.00, 'imgService/1782909879serv1.png', 1, '2026-06-29 11:09:23', '2026-07-01 11:44:39'),
(2, 'REF-1782909770', 'Compensation Réactive', 'compensation-reactive', 'Une solution clé en main performante pour éliminer définitivement vos surcoûts d\'énergie.', 1000.00, 'imgService/1782909770serv2.png', 1, '2026-07-01 11:42:50', '2026-07-01 11:42:50'),
(3, 'REF-1782909923', 'Travaux Neufs & TGBT', 'travaux-neufs-tgbt', 'Conception et mise en service d\'infrastructures de distribution robustes et durables.', 1000.00, 'imgService/1782909923serv3.png', 1, '2026-07-01 11:45:23', '2026-07-01 11:45:23');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bLMmbeh7bSLYPv0Z83eoTeoJzHeHjYj1kNCriIBU', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVkdxWGtiY2ROUFFvQWpqTUtLSnVxMVJhSmptb0dGaVdWWUlnQTlvOCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDYvZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjk6ImRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1782914793),
('nm8md2DMJJ6sFrV3cHzpjxTZGLCtWZiDITbyJJh2', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMHVhT25GYTBlYXJqTmxBY0x6NU9jWkxsT3p6dk1kNWdsQXhCWTdJdCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwNS9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1782995262);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Amadou Camara', 'contact@regilec.com', NULL, '$2y$12$yIhQEiwykAE0Hx173K8HiuCkpNJBDylJi1.9kLKGTWfnFtP6POoDa', NULL, '2026-06-29 08:56:13', '2026-06-29 08:56:13');

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

CREATE TABLE `ventes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reference` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `total_tva` decimal(12,2) DEFAULT NULL,
  `total_ttc` decimal(12,2) DEFAULT NULL,
  `statut` enum('payee','impayee','partielle') NOT NULL DEFAULT 'impayee',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ventes`
--

INSERT INTO `ventes` (`id`, `client_id`, `reference`, `date`, `total`, `total_tva`, `total_ttc`, `statut`, `user_id`, `created_at`, `updated_at`) VALUES
(2, NULL, 'VNT-1782993038', '2026-07-02', 745000.00, 134100.00, 879100.00, 'payee', 1, '2026-07-02 10:50:38', '2026-07-02 10:50:38');

-- --------------------------------------------------------

--
-- Structure de la table `vente_items`
--

CREATE TABLE `vente_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vente_id` bigint(20) UNSIGNED NOT NULL,
  `service` varchar(255) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` decimal(10,2) NOT NULL,
  `montant_tva` decimal(10,2) NOT NULL,
  `total_ttc` decimal(10,2) NOT NULL,
  `taux_tva` decimal(10,2) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vente_items`
--

INSERT INTO `vente_items` (`id`, `vente_id`, `service`, `quantite`, `prix_unitaire`, `montant_tva`, `total_ttc`, `taux_tva`, `total`, `created_at`, `updated_at`) VALUES
(3, 2, 'installation reseau', 10, 50000.00, 90000.00, 590000.00, 18.00, 500000.00, '2026-07-02 10:50:38', '2026-07-02 10:50:38'),
(4, 2, 'maintenance', 5, 49000.00, 44100.00, 289100.00, 18.00, 245000.00, '2026-07-02 10:50:38', '2026-07-02 10:50:38');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achats`
--
ALTER TABLE `achats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `achats_reference_unique` (`reference`),
  ADD KEY `achats_fournisseur_id_foreign` (`fournisseur_id`);

--
-- Index pour la table `achat_details`
--
ALTER TABLE `achat_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `achat_details_achat_id_foreign` (`achat_id`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contrats`
--
ALTER TABLE `contrats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contrats_reference_unique` (`reference`);

--
-- Index pour la table `devis`
--
ALTER TABLE `devis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `devis_reference_unique` (`reference`),
  ADD KEY `devis_client_id_foreign` (`client_id`);

--
-- Index pour la table `devis_details`
--
ALTER TABLE `devis_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `designation` (`id`),
  ADD KEY `devis_details_devis_id_foreign` (`devis_id`);

--
-- Index pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paiements_reference_unique` (`reference`),
  ADD KEY `paiements_vente_id_foreign` (`vente_id`),
  ADD KEY `paiements_user_id_foreign` (`user_id`),
  ADD KEY `paiements_entreprise_id_foreign` (`entreprise_id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recettes_reference_unique` (`reference`),
  ADD KEY `recettes_user_id_foreign` (`user_id`),
  ADD KEY `recettes_paiement_id_foreign` (`paiement_id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_reference_unique` (`reference`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ventes_reference_unique` (`reference`),
  ADD KEY `ventes_client_id_foreign` (`client_id`),
  ADD KEY `ventes_user_id_foreign` (`user_id`);

--
-- Index pour la table `vente_items`
--
ALTER TABLE `vente_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vente_items_vente_id_foreign` (`vente_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `achats`
--
ALTER TABLE `achats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `achat_details`
--
ALTER TABLE `achat_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `contrats`
--
ALTER TABLE `contrats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `devis`
--
ALTER TABLE `devis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `devis_details`
--
ALTER TABLE `devis_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `paiements`
--
ALTER TABLE `paiements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `vente_items`
--
ALTER TABLE `vente_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achats`
--
ALTER TABLE `achats`
  ADD CONSTRAINT `achats_fournisseur_id_foreign` FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `achat_details`
--
ALTER TABLE `achat_details`
  ADD CONSTRAINT `achat_details_achat_id_foreign` FOREIGN KEY (`achat_id`) REFERENCES `achats` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `devis`
--
ALTER TABLE `devis`
  ADD CONSTRAINT `devis_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `devis_details`
--
ALTER TABLE `devis_details`
  ADD CONSTRAINT `devis_details_devis_id_foreign` FOREIGN KEY (`devis_id`) REFERENCES `devis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `devis_details_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD CONSTRAINT `paiements_entreprise_id_foreign` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paiements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paiements_vente_id_foreign` FOREIGN KEY (`vente_id`) REFERENCES `ventes` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD CONSTRAINT `recettes_paiement_id_foreign` FOREIGN KEY (`paiement_id`) REFERENCES `paiements` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `recettes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD CONSTRAINT `ventes_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ventes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `vente_items`
--
ALTER TABLE `vente_items`
  ADD CONSTRAINT `vente_items_vente_id_foreign` FOREIGN KEY (`vente_id`) REFERENCES `ventes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
