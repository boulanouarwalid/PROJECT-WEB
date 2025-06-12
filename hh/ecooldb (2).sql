-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2025 at 08:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecooldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Nomcomplet` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `teliphone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `Nomcomplet`, `email`, `password`, `role`, `teliphone`, `created_at`, `updated_at`) VALUES
(1, 'lebhir walid', 'walid.lebhir@acadimie.com', 'walid2004@', 'Admin', '+121789856431', NULL, '2025-04-23 14:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `affectations`
--

CREATE TABLE `affectations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `annee_universitaire` varchar(9) NOT NULL,
  `status` enum('brouillon','confirmée','archivée') NOT NULL,
  `prof_id` bigint(20) UNSIGNED NOT NULL,
  `ue_id` bigint(20) UNSIGNED NOT NULL,
  `affecter_par` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `heures_cm` int(11) NOT NULL DEFAULT 0,
  `heures_td` int(11) NOT NULL DEFAULT 0,
  `heures_tp` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `affectations`
--

INSERT INTO `affectations` (`id`, `annee_universitaire`, `status`, `prof_id`, `ue_id`, `affecter_par`, `created_at`, `updated_at`, `type`, `heures_cm`, `heures_td`, `heures_tp`) VALUES
(8, '2025', 'confirmée', 26, 20, 26, '2025-05-24 09:02:37', '2025-05-24 09:02:37', 'cour', 0, 0, 0),
(9, '2025', 'confirmée', 34, 21, 34, '2025-05-24 09:30:50', '2025-05-24 09:30:50', 'cour', 0, 0, 0),
(10, '2025', 'confirmée', 37, 24, 37, '2025-05-24 09:30:57', '2025-05-24 09:30:57', 'cour', 0, 0, 0),
(11, '2025', 'confirmée', 26, 23, 26, '2025-05-24 09:31:05', '2025-05-24 09:31:05', 'cour', 0, 0, 0),
(12, '2025', 'confirmée', 33, 22, 33, '2025-05-24 09:31:13', '2025-05-24 09:31:13', 'cour', 0, 0, 0),
(14, '2025', 'confirmée', 35, 26, 35, '2025-05-24 09:35:56', '2025-05-24 09:35:56', 'cour', 0, 0, 0),
(60, '2025-2026', 'brouillon', 62, 218, 34, '2025-06-12 17:49:25', '2025-06-12 17:49:25', 'cours', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `annonces`
--

CREATE TABLE `annonces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `service` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `tail` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `annonces`
--

INSERT INTO `annonces` (`id`, `titre`, `Description`, `service`, `file`, `name`, `type`, `tail`, `created_at`, `updated_at`) VALUES
(10, 'anonces6', 'anonces', 'Administration', 'Anonces/vTDE9gHDFgyAQ5KGayoeZDtbEY0Ocj0I6DVlgcfo.pdf', 'LEBHIR_WALID_CV.pdf', 'application/pdf', 259305, '2025-05-05 11:02:00', '2025-05-05 11:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Nomfile` varchar(255) NOT NULL,
  `Objectif` text NOT NULL,
  `pathfile` varchar(255) NOT NULL,
  `service` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `tail` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `charge_horaires`
--

CREATE TABLE `charge_horaires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `affectation_id` bigint(20) UNSIGNED NOT NULL,
  `volume_horaire` int(11) NOT NULL,
  `completed_hours` int(11) NOT NULL DEFAULT 0,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0,
  `commentaires` text DEFAULT NULL,
  `heures_semaine` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date DEFAULT NULL,
  `groupe_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contraintes_enseignants`
--

CREATE TABLE `contraintes_enseignants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enseignant_id` bigint(20) UNSIGNED NOT NULL,
  `jour` enum('lundi','mardi','mercredi','jeudi','vendredi','samedi') NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `raison` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contraintes_salles`
--

CREATE TABLE `contraintes_salles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `salle_id` bigint(20) UNSIGNED NOT NULL,
  `jour` enum('lundi','mardi','mercredi','jeudi','vendredi','samedi') NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `raison` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deparetement_maths`
--

CREATE TABLE `deparetement_maths` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idProf` int(11) NOT NULL,
  `Nomprof` varchar(255) NOT NULL,
  `NomModule` varchar(255) NOT NULL,
  `feliere` varchar(255) NOT NULL,
  `niveaux` varchar(255) NOT NULL,
  `NombreHeurs` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deparetement_maths`
--

INSERT INTO `deparetement_maths` (`id`, `idProf`, `Nomprof`, `NomModule`, `feliere`, `niveaux`, `NombreHeurs`, `created_at`, `updated_at`) VALUES
(12, 17, 'lebhir', 'js', 'tdia', 'Gi2', 20, '2025-04-20 08:06:41', '2025-04-20 08:06:41'),
(13, 21, 'alouiI', 'c', 'geni informatique', 'Gi1', 20, '2025-04-22 11:39:11', '2025-04-22 11:39:11');

-- --------------------------------------------------------

--
-- Table structure for table `departements`
--

CREATE TABLE `departements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `specialite` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departements`
--

INSERT INTO `departements` (`id`, `nom`, `specialite`, `created_at`, `updated_at`) VALUES
(1, 'Mathematique/informatique', 'etude mathematique et Recherche en informatique ', '2025-05-04 11:21:39', '2025-05-04 11:21:39'),
(2, 'physique', 'physique ,Energitique et Recherche dans dommaina geni civil ', '2025-05-04 11:25:39', '2025-05-04 11:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `emploi_du_temps`
--

CREATE TABLE `emploi_du_temps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ue_id` bigint(20) UNSIGNED NOT NULL,
  `enseignant_id` bigint(20) UNSIGNED NOT NULL,
  `salle_id` bigint(20) UNSIGNED NOT NULL,
  `type_seance` enum('cours','td','tp') NOT NULL,
  `groupe` int(11) DEFAULT NULL,
  `jour` enum('lundi','mardi','mercredi','jeudi','vendredi','samedi') NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `semestre` enum('S1','S2','S3','S4','S5','S6') NOT NULL,
  `annee_universitaire` varchar(9) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `niveau_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `filieres`
--

CREATE TABLE `filieres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `departement_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `filieres`
--

INSERT INTO `filieres` (`id`, `nom`, `departement_id`, `created_at`, `updated_at`) VALUES
(16, 'génie Mathematique', 1, '2025-05-18 12:36:33', '2025-05-18 12:36:33'),
(17, 'geni infus', 2, '2025-05-19 09:34:12', '2025-05-19 09:34:12'),
(18, 'genie civil', 2, '2025-05-24 09:00:26', '2025-05-24 09:00:26'),
(19, 'génie energitique', 2, '2025-05-24 09:00:49', '2025-05-24 09:00:49'),
(20, 'genie eaux et enverement', 2, '2025-05-24 09:01:14', '2025-05-24 09:01:14'),
(21, 'genie informatique', 1, '2025-05-24 09:33:12', '2025-05-24 09:33:12'),
(22, 'ingenieur des donnes', 1, '2025-05-24 09:33:31', '2025-05-24 09:33:31'),
(23, 'inteligence artificiel (Ai)', 1, '2025-05-24 09:33:51', '2025-05-24 09:33:51');

-- --------------------------------------------------------

--
-- Table structure for table `groupes`
--

CREATE TABLE `groupes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `niveau_id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groupe_enseignements`
--

CREATE TABLE `groupe_enseignements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `affectation_id` bigint(20) UNSIGNED NOT NULL,
  `groupe_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `historique_charges`
--

CREATE TABLE `historique_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heures_totales` int(11) NOT NULL,
  `heures_cm` int(11) NOT NULL DEFAULT 0,
  `heures_td` int(11) NOT NULL DEFAULT 0,
  `heures_tp` int(11) NOT NULL DEFAULT 0,
  `annee_universitaire` varchar(9) NOT NULL,
  `prof_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_03_22_135313_create_utilisateurs_table', 1),
(6, '2025_03_22_224243_add_timestamps_to_utilisateurs', 2),
(7, '2025_03_27_235339_create__responsabilite', 3),
(8, '2025_03_30_025951_create_admins_table', 4),
(9, '2025_04_04_214213_create_deparetement_maths_table', 5),
(10, '2025_04_05_022859_add_columns_to_utilisateurs', 6),
(11, '2025_04_13_112549_create_annonces_table', 7),
(12, '2025_04_17_181550_add_prenomprof_to_responsabilite', 8),
(13, '2025_04_26_120926_add__email_personelle_and_statu_to_utilisateurs', 9),
(14, '2025_05_01_091012_create_departements_table', 10),
(15, '2025_05_01_091054_create_filieres_table', 10),
(16, '2025_05_01_091124_create_ues_table', 10),
(17, '2025_05_01_091149_create_affectations_table', 10),
(18, '2025_05_01_091243_create_historique_charges_table', 11),
(19, '2025_05_07_151413_modify_responsable_id_in_ues_table', 12),
(20, '2025_05_09_151352_create_archives_table', 13),
(21, '2025_05_09_204259_add_type_to_affectations', 14),
(22, '2025_05_11_083857_add_id_f_to_responsabilite', 15),
(23, '2025_05_11_083922_add_id_d_to_responsabilite', 15),
(24, '2025_05_11_092203_update_idf_default_value_in_your_table_name', 16),
(25, '2025_05_11_094541_modify_id_d_column_in_responsabilite_table', 17),
(26, '2025_05_11_095247_remove_id_d_from_responsabilite', 18),
(27, '2025_05_11_095343_remove_id_f_from_responsabilite', 19),
(28, '2025_05_11_095856_add_columns_to_table_name', 1),
(29, '2025_05_14_083526_create_specialites_table', 20),
(30, '2025_05_27_165244_y', 21),
(31, '2025_05_27_165323_salles', 21),
(32, '2025_05_27_165342_emploi_du_temps', 21),
(33, '2025_05_27_165401_contraintes_salles', 21),
(34, '2025_05_27_165438_contraintes_enseignants', 21),
(35, '2025_05_27_165439_contraintes_enseignants', 21),
(36, '2025_05_27_165532_contraintes_enseignants', 21),
(37, '2025_05_27_172117_charge_horaires', 21),
(38, '2025_05_27_172350_add_nom_colonne_to_nom_table', 21),
(39, '2025_05_27_172450_add_niveau_id__to_ues', 21),
(40, '2025_06_01_183315_note', 22),
(41, '2025_06_01_185558_add_niveaux_id_emploi_du_temps', 23),
(42, '2025_06_01_221356_wishes', 24),
(43, '2025_06_09_181718_add_status_in_notes_table', 25),
(44, '2025_06_09_201722_add_nullable_to_responsable_id_to_table_ues', 26),
(45, '2025_06_16_101142_create_wishes_table', 27),
(46, '2024_06_13_000000_add_heures_columns_to_affectations_table', 28),
(47, '2025_06_12_174722_add_heures_columns_to_affectations_table', 28);

-- --------------------------------------------------------

--
-- Table structure for table `niveaux`
--

CREATE TABLE `niveaux` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `filiere_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `niveaux`
--

INSERT INTO `niveaux` (`id`, `nom`, `filiere_id`, `created_at`, `updated_at`) VALUES
(1, 'INFO1', 16, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(2, 'INFO2', 16, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(3, 'INFO3', 16, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(4, 'DATA1', 17, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(5, 'DATA2', 17, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(6, 'DATA3', 17, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(7, 'TDIA1', 23, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(8, 'TDIA2', 23, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(9, 'TDIA3', 23, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(10, 'GC1', 18, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(11, 'GC2', 18, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(12, 'GC3', 18, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(13, 'GEER1', 18, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(14, 'GEER2', 18, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(15, 'GEER3', 18, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(16, 'GEE1', 19, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(17, 'GEE2', 19, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(18, 'GEE3', 19, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(19, 'GM1', 20, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(20, 'GM2', 20, '2025-05-21 17:32:33', '2025-05-21 17:32:33'),
(21, 'GM3', 20, '2025-05-21 17:32:33', '2025-05-20 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ue_id` bigint(20) UNSIGNED NOT NULL,
  `session_type` enum('normal','rattrapage') NOT NULL,
  `academic_year` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `professor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','published','archived') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `responsabilite`
--

CREATE TABLE `responsabilite` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idProf` int(11) NOT NULL,
  `Nomprof` varchar(255) NOT NULL,
  `CIN` varchar(255) NOT NULL,
  `Responsabilite` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `prenomprof` varchar(255) NOT NULL,
  `idf` bigint(20) UNSIGNED DEFAULT NULL,
  `idd` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `responsabilite`
--

INSERT INTO `responsabilite` (`id`, `idProf`, `Nomprof`, `CIN`, `Responsabilite`, `created_at`, `updated_at`, `prenomprof`, `idf`, `idd`) VALUES
(46, 31, 'mohamadi', 'HE67895', 'chef de departement', '2025-05-11 09:58:55', '2025-05-11 09:58:55', 'badilah', NULL, 2),
(55, 36, 'boudawi', 'ZE78893', 'Cordinateur', '2025-05-18 12:36:58', '2025-05-18 12:36:58', 'badali', 16, 1),
(57, 34, 'mousaid', 'XZ56989', 'Cordinateur', '2025-05-23 21:45:37', '2025-05-23 21:45:37', 'ibrahim', 23, 1),
(59, 35, 'raji', 'GB78452', 'Cordinateur', '2025-05-24 09:34:13', '2025-05-24 09:34:13', 'oualid', 22, 1),
(61, 21, 'aloui', 'GB78543', 'chef de departement', '2025-05-24 10:55:04', '2025-05-24 10:55:04', 'anas', NULL, 1),
(62, 48, 'bouanouar', 'AE87654', 'Cordinateur', '2025-06-01 16:33:54', '2025-06-01 16:33:54', 'walid', 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `salles`
--

CREATE TABLE `salles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `type` enum('amphi','salle_td','salle_tp') NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `capacite` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `specialites`
--

CREATE TABLE `specialites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `idDepartement` bigint(20) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specialites`
--

INSERT INTO `specialites` (`id`, `Nom`, `idDepartement`, `description`, `created_at`, `updated_at`) VALUES
(2, 'reseaux informatique', 1, 'reseaux informatique et adrministration reseaux et telicomunication', '2025-05-15 07:43:41', '2025-05-15 07:43:41'),
(3, 'data science', 1, 'etude des sciences des donnes et analyse des donnes', '2025-05-15 07:45:31', '2025-05-15 07:45:31'),
(4, 'Ai (integence Artificielle )', 1, 'machine learning', '2025-05-15 07:46:11', '2025-05-15 07:46:11'),
(5, 'data Analysise', 1, 'analyse des donnes et science de desision', '2025-05-15 07:46:41', '2025-05-15 07:46:41'),
(6, 'data Analysise', 1, 'analyse des donnes et science de desision', '2025-05-15 07:46:42', '2025-05-15 07:46:42'),
(9, 'génie civil', 2, 'construction et conception', '2025-05-15 08:07:08', '2025-05-15 08:07:08'),
(10, 'analyse Mathematique', 1, 'analyse mathematique', '2025-05-15 08:07:57', '2025-05-15 08:07:57'),
(11, 'science des materieux', 2, 'resistance des materieux', '2025-05-15 09:01:36', '2025-05-15 09:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `ues`
--

CREATE TABLE `ues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL,
  `heures_cm` int(11) NOT NULL DEFAULT 0,
  `heures_td` int(11) NOT NULL DEFAULT 0,
  `heures_tp` int(11) NOT NULL DEFAULT 0,
  `semestre` enum('S1','S2','S3','S4','S5','S6') NOT NULL,
  `annee_universitaire` varchar(9) NOT NULL,
  `est_vacant` tinyint(1) NOT NULL,
  `groupes_td` int(11) NOT NULL DEFAULT 0,
  `groupes_tp` int(11) NOT NULL DEFAULT 0,
  `filiere_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `responsable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `niveau_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ues`
--

INSERT INTO `ues` (`id`, `nom`, `code`, `heures_cm`, `heures_td`, `heures_tp`, `semestre`, `annee_universitaire`, `est_vacant`, `groupes_td`, `groupes_tp`, `filiere_id`, `department_id`, `responsable_id`, `created_at`, `updated_at`, `niveau_id`) VALUES
(20, 'resistanat des materieux', 'khZ.18', 12, 7, 3, 'S2', '2024-2025', 1, 2, 2, 18, 2, 0, '2025-05-24 09:02:24', '2025-05-24 09:02:24', NULL),
(21, 'energie solaire', 'E4G.19', 13, 6, 3, 'S3', '2024-2025', 1, 3, 2, 19, 2, 0, '2025-05-24 09:27:46', '2025-05-24 09:27:46', NULL),
(22, 'batimenet energitique', 'Fob.18', 12, 7, 0, 'S3', '2024-2025', 1, 0, 2, 18, 2, 0, '2025-05-24 09:28:33', '2025-05-24 09:28:33', NULL),
(23, 'calite des produits', 'z03.20', 11, 7, 2, 'S3', '2024-2025', 1, 2, 1, 20, 2, 0, '2025-05-24 09:29:15', '2025-05-24 09:29:15', NULL),
(24, 'routes', 'dEz.18', 10, 8, 2, 'S4', '2024-2025', 1, 2, 1, 18, 2, 0, '2025-05-24 09:30:00', '2025-05-24 09:30:00', NULL),
(25, 'langague C avance', 'ClR.21', 12, 2, 8, 'S1', '2024-2025', 1, 2, 1, 21, 1, 0, '2025-05-24 09:34:57', '2025-05-24 09:34:57', NULL),
(26, 'Archetecture des ordinateurs', 'y6f.21', 10, 7, 3, 'S1', '2024-2025', 1, 2, 2, 21, 1, 0, '2025-05-24 09:35:49', '2025-05-24 09:35:49', NULL),
(27, 'base de donnes', 'gV2.21', 11, 6, 5, 'S1', '2024-2025', 1, 2, 2, 21, 1, 0, '2025-05-24 09:36:50', '2025-05-24 09:36:50', NULL),
(28, 'reseaux informatique', '8Gt.21', 13, 10, 4, 'S1', '2024-2025', 1, 2, 2, 21, 1, 0, '2025-05-24 09:37:35', '2025-05-24 09:37:35', NULL),
(29, 'Architecture des ordinateurs', 'PHY-1-001', 26, 16, 16, 'S1', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(30, ' Langage C avancé et structures de données', 'PHY-1-002', 26, 16, 18, 'S1', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(31, 'Recherche opérationnelle et théorie des graphes', 'PHY-1-003', 26, 24, 12, 'S1', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(32, 'Systèmes d’Information et Bases de Données Relationnelles', 'PHY-1-004', 26, 24, 12, 'S1', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(33, 'Réseaux informatiques', 'PHY-1-005', 26, 18, 14, 'S1', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(34, 'Culture and Art skills', 'PHY-1-006', 26, 10, 0, 'S1', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(35, 'Langues Etrangéres (Français)', 'PHY-1-007', 20, 6, 3, 'S1', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(36, 'Langues Etrangéres (Anglais)', 'PHY-1-008', 20, 6, 3, 'S1', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(37, 'Architecture Logicielle et UML', 'PHY-2-009', 26, 16, 10, 'S2', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(38, 'Web1 : Technologies de Web et PHP5', 'PHY-2-010', 26, 10, 16, 'S2', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(39, 'Programmation Orientée Objet C++', 'PHY-2-011', 26, 16, 10, 'S2', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(40, 'Linux et programmation systéme', 'PHY-2-012', 26, 16, 10, 'S2', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(41, 'Algorithmique Avancée et complexité', 'PHY-2-013', 26, 26, 4, 'S2', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(42, 'Prompt ingeniering for developpers', 'PHY-2-014', 26, 26, 6, 'S2', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(43, 'Langues,Communication et TIC -fr', 'PHY-2-015', 20, 6, 3, 'S2', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(44, 'Langues,Communication et TIC- Ang', 'PHY-2-016', 20, 6, 3, 'S2', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(45, 'Python pour les sciences de données ', 'PHY-3-017', 28, 0, 36, 'S3', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(46, 'Programmation Java Avancée ', 'PHY-3-018', 24, 8, 32, 'S3', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(47, 'Langues et Communication -FR ', 'PHY-3-019', 21, 0, 11, 'S3', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(48, 'Langues et Communication- Ang', 'PHY-3-020', 21, 10, 0, 'S3', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(49, 'Langues et Communication- Espagnol', 'PHY-3-021', 21, 10, 0, 'S3', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(50, 'Linux et programmation système ', 'PHY-3-022', 21, 16, 27, 'S3', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(51, 'Administration des Bases de données Avancées ', 'PHY-3-023', 26, 4, 34, 'S3', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(52, 'Administration réseaux et systèmes ', 'PHY-3-024', 27, 15, 22, 'S3', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(53, 'Entreprenariat 2  - Contrôle gestion', 'PHY-4-025', 21, 18, 0, 'S4', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(54, 'Entreprenariat 2  -Marketing fondamental', 'PHY-4-026', 25, 0, 0, 'S4', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(55, 'Machine Learning ', 'PHY-4-027', 21, 20, 23, 'S4', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(56, 'Gestion de projet ', 'PHY-4-028', 16, 6, 16, 'S4', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(57, 'Génie logiciel  ', 'PHY-4-029', 12, 6, 0, 'S4', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(58, 'Crypto-systèmes', 'PHY-4-030', 15, 10, 4, 'S4', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(59, 'sécurité Informatique ', 'PHY-4-031', 15, 10, 10, 'S4', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(60, 'Frameworks Java EE avancés', 'PHY-4-032', 15, 10, 4, 'S4', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(61, '.Net ', 'PHY-4-033', 15, 10, 10, 'S4', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(62, 'Web 2 : Applications Web modernes ', 'PHY-4-034', 21, 15, 28, 'S4', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(63, 'Système embarqué et temps réel   ', 'PHY-5-035', 25, 25, 14, 'S5', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(64, 'Développement des applications mobiles ', 'PHY-5-036', 28, 0, 36, 'S5', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(65, 'Virtualisation', 'PHY-5-037', 10, 4, 12, 'S5', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(66, 'Cloud Computing ', 'PHY-5-038', 12, 8, 18, 'S5', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(67, 'Analyse et conception des systèmes décisionnels  ', 'PHY-5-039', 28, 12, 24, 'S5', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(68, 'Enterprise Resource Planning ERP ', 'PHY-5-040', 22, 12, 30, 'S5', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(69, 'Ingénierie logicielle, Qualité, Test et Intégration ', 'PHY-5-041', 21, 18, 25, 'S5', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(70, 'Ingénierie de l’information et des connaissances  ', 'PHY-5-042', 28, 12, 24, 'S5', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(71, 'Business Intelligence & Veille Stratégique', 'PHY-5-043', 24, 16, 24, 'S5', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(72, 'Data Mining  ', 'PHY-5-044', 26, 14, 24, 'S5', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(73, 'Entreprenariat 3 -RH', 'PHY-5-045', 30, 0, 0, 'S5', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(74, 'Entreprenariat 3 - Gestion financiere', 'PHY-5-046', 18, 16, 0, 'S5', '2025-2026', 1, 0, 0, 17, 2, NULL, '2025-06-09 19:18:06', '2025-06-09 19:18:06', NULL),
(218, 'Systèmes d’Information et Bases de Données Relationnelles', 'ETU-1-004', 26, 24, 12, 'S1', '2025-2026', 1, 0, 0, 23, 1, 62, '2025-06-12 16:04:00', '2025-06-12 17:49:25', NULL),
(219, 'Réseaux informatiques', 'ETU-1-005', 26, 18, 14, 'S1', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(220, 'Culture and Art skills', 'ETU-1-006', 26, 10, 0, 'S1', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(221, 'Langues Etrangéres (Français)', 'ETU-1-007', 20, 6, 3, 'S1', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(222, 'Langues Etrangéres (Anglais)', 'ETU-1-008', 20, 6, 3, 'S1', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(223, 'Architecture Logicielle et UML', 'ETU-2-009', 26, 16, 10, 'S2', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(224, 'Web1 : Technologies de Web et PHP5', 'ETU-2-010', 26, 10, 16, 'S2', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(225, 'Programmation Orientée Objet C++', 'ETU-2-011', 26, 16, 10, 'S2', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(226, 'Linux et programmation systéme', 'ETU-2-012', 26, 16, 10, 'S2', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(227, 'Algorithmique Avancée et complexité', 'ETU-2-013', 26, 26, 4, 'S2', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(228, 'Prompt ingeniering for developpers', 'ETU-2-014', 26, 26, 6, 'S2', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(229, 'Langues,Communication et TIC -fr', 'ETU-2-015', 20, 6, 3, 'S2', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(230, 'Langues,Communication et TIC- Ang', 'ETU-2-016', 20, 6, 3, 'S2', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(231, 'Python pour les sciences de données ', 'ETU-3-017', 28, 0, 36, 'S3', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(232, 'Programmation Java Avancée ', 'ETU-3-018', 24, 8, 32, 'S3', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(233, 'Langues et Communication -FR ', 'ETU-3-019', 21, 0, 11, 'S3', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(234, 'Langues et Communication- Ang', 'ETU-3-020', 21, 10, 0, 'S3', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(235, 'Langues et Communication- Espagnol', 'ETU-3-021', 21, 10, 0, 'S3', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(236, 'Linux et programmation système ', 'ETU-3-022', 21, 16, 27, 'S3', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(237, 'Administration des Bases de données Avancées ', 'ETU-3-023', 26, 4, 34, 'S3', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(238, 'Administration réseaux et systèmes ', 'ETU-3-024', 27, 15, 22, 'S3', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(239, 'Entreprenariat 2  - Contrôle gestion', 'ETU-4-025', 21, 18, 0, 'S4', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(240, 'Entreprenariat 2  -Marketing fondamental', 'ETU-4-026', 25, 0, 0, 'S4', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(241, 'Machine Learning ', 'ETU-4-027', 21, 20, 23, 'S4', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(242, 'Gestion de projet ', 'ETU-4-028', 16, 6, 16, 'S4', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(243, 'Génie logiciel  ', 'ETU-4-029', 12, 6, 0, 'S4', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(244, 'Crypto-systèmes', 'ETU-4-030', 15, 10, 4, 'S4', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(245, 'sécurité Informatique ', 'ETU-4-031', 15, 10, 10, 'S4', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(246, 'Frameworks Java EE avancés', 'ETU-4-032', 15, 10, 4, 'S4', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(247, '.Net ', 'ETU-4-033', 15, 10, 10, 'S4', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(248, 'Web 2 : Applications Web modernes ', 'ETU-4-034', 21, 15, 28, 'S4', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(249, 'Système embarqué et temps réel   ', 'ETU-5-035', 25, 25, 14, 'S5', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(250, 'Développement des applications mobiles ', 'ETU-5-036', 28, 0, 36, 'S5', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(251, 'Virtualisation', 'ETU-5-037', 10, 4, 12, 'S5', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(252, 'Cloud Computing ', 'ETU-5-038', 12, 8, 18, 'S5', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(253, 'Analyse et conception des systèmes décisionnels  ', 'ETU-5-039', 28, 12, 24, 'S5', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(254, 'Enterprise Resource Planning ERP ', 'ETU-5-040', 22, 12, 30, 'S5', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(255, 'Ingénierie logicielle, Qualité, Test et Intégration ', 'ETU-5-041', 21, 18, 25, 'S5', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(256, 'Ingénierie de l’information et des connaissances  ', 'ETU-5-042', 28, 12, 24, 'S5', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(257, 'Business Intelligence & Veille Stratégique', 'ETU-5-043', 24, 16, 24, 'S5', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(258, 'Data Mining  ', 'ETU-5-044', 26, 14, 24, 'S5', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(259, 'Entreprenariat 3 -RH', 'ETU-5-045', 30, 0, 0, 'S5', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL),
(260, 'Entreprenariat 3 - Gestion financiere', 'ETU-5-046', 18, 16, 0, 'S5', '2025-2026', 1, 0, 0, 23, 1, NULL, '2025-06-12 16:04:00', '2025-06-12 16:04:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
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

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `data_nissance` date NOT NULL,
  `Email` varchar(255) NOT NULL,
  `role` text NOT NULL,
  `ville` text NOT NULL,
  `password` varchar(20) NOT NULL,
  `deparetement` varchar(255) NOT NULL,
  `specialite` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Numeroteliphone` varchar(255) NOT NULL,
  `CIN` varchar(255) NOT NULL,
  `emailPersonelle` varchar(255) NOT NULL,
  `Statu` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `firstName`, `lastName`, `data_nissance`, `Email`, `role`, `ville`, `password`, `deparetement`, `specialite`, `created_at`, `updated_at`, `Numeroteliphone`, `CIN`, `emailPersonelle`, `Statu`) VALUES
(21, 'anas', 'aloui', '1989-01-12', 'anas.aloui@acadimie.com', 'profiseur', 'rabat', 'ali1234@', 'Mathematique/informatique', 'geni logicielle', '2025-04-05 02:57:37', '2025-05-27 08:26:09', '0675331100', 'GB78543', '', 1),
(22, 'mehdi', 'beradaa', '1992-12-30', 'mehdi.berada@acadimie.com', 'profiseur', 'fes', 'J6rtF4uBoa', 'Choisie une departement', 'thermo dynamique', '2025-04-05 03:04:38', '2025-05-18 12:32:33', '0789561112', 'GB78903', '', 1),
(26, 'mohamed', 'bikouz', '2000-08-02', 'mohamed.bikouz@acadimie.com', 'profiseur', 'Nador', 'g1bcxqgTdl', 'physique', 'thermo chimie', '2025-04-13 19:41:24', '2025-04-13 19:41:24', '0766981972', 'SX27375', '', 1),
(30, 'mohamed', 'Ribati', '1991-12-10', 'mohamed.Ribati@acadimie.com', 'profiseur', 'fes', 'aQF23FBgds', 'Mathematique/informatique', 'reseaux', '2025-05-05 07:23:06', '2025-05-05 07:23:06', '0678543212', 'AE67543', 'mohamed.Ribati@gmail.com', 1),
(31, 'badilah', 'mohamadi', '1983-02-10', 'badilah.mohamadi@acadimie.com', 'profiseur', 'casa', 'aXxhMhWnIW', 'physique', 'géologie interne', '2025-05-05 07:24:30', '2025-05-05 07:24:30', '0756341278', 'HE67895', 'badilah.mohamadi@gmail.com', 1),
(32, 'ali', 'abdlah', '1991-10-22', 'ali.abdlah@acadimie.com', 'profiseur', 'kenitra', 'HmfUpc5J7O', 'Mathematique/informatique', 'data Analysise', '2025-05-15 08:58:50', '2025-05-15 08:58:50', '0710146731', 'GB78984', 'ali12@gmail.com', 1),
(33, 'simohamed', 'bnali', '1989-10-12', 'simohamed.bnali@acadimie.com', 'profiseur', 'rabat', 'NHgucfgiwj', 'physique', 'génie civil', '2025-05-15 09:00:49', '2025-05-15 09:00:49', '0656334512', 'GB6753', 'Bnali@gmail.com', 1),
(34, 'ibrahim', 'mousaid', '1990-01-02', 'ibrahim.mousaid@acadimie.com', 'profiseur', 'Nador', 'y2VLnZVJno', 'physique', 'science des materieux', '2025-05-15 09:02:50', '2025-05-15 09:02:50', '0678453211', 'XZ56989', 'mousaid12@gmail.com', 1),
(35, 'oualid', 'raji', '1984-06-22', 'oualid.raji@acadimie.com', 'profiseur', 'rabat', 'DmYVRSIElo', 'Mathematique/informatique', 'reseaux informatique', '2025-05-15 09:19:11', '2025-05-15 09:19:11', '0634661024', 'GB78452', 'raji23@gmail.com', 1),
(36, 'badali', 'boudawi', '1991-05-12', 'badali.boudawi@acadimie.com', 'profiseur', 'EL Hociema', 'GI3l1xKyqz', 'Mathematique/informatique', 'Ai (integence Artificielle )', '2025-05-16 23:15:40', '2025-05-16 23:15:40', '0789005634', 'ZE78893', 'boudawi12@gmail.com', 1),
(37, 'faouzi', 'bomehdi', '1982-11-22', 'faouzi.bomehdi@acadimie.com', 'profiseur', 'casa', 'p6h38kQicU', 'physique', 'génie civil', '2025-05-16 23:18:08', '2025-05-16 23:18:08', '0623102200', 'GB78982', 'faouziB56@gmail.com', 1),
(49, 'anas', 'abdlah', '1992-07-22', 'anas.abdlah@acadimie.com', 'profiseur', 'fes', 'KaNSHWpZwy', 'Mathematique/informatique', 'reseaux informatique', '2025-06-01 16:29:18', '2025-06-01 16:29:18', '0798675432', 'GH78654', 'anas68363@gmail.Com', 1),
(51, 'mouad', 'doom', '1992-02-12', 'mouad.doom@acadimie.com', 'profiseur', 'casa', 'Z7DMCHFUoO', 'Mathematique/informatique', 'Ai (integence Artificielle )', '2025-06-01 19:42:59', '2025-06-01 19:42:59', '0787651122', 'TH78353', 'mouad@gmail.com', 1),
(52, 'mouad', 'doom', '1992-02-12', 'mouad.doom@acadimie.com', 'profiseur', 'casa', 'nCX3s9KR9m', 'Mathematique/informatique', 'Ai (integence Artificielle )', '2025-06-01 19:43:42', '2025-06-01 19:43:42', '0787651122', 'TH78353', 'mouad@gmail.com', 1),
(62, 'walid', 'boulanouar', '0001-01-01', 'walid.boulanouar@academiq.ma', 'vacataire', 'Casablanca', 'KsaznZfiWv', 'Mathematique/informatique', 'physique', '2025-06-12 16:29:12', '2025-06-12 16:29:12', '0668300363', 'dsadas', 'walidwalido1691999@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishes`
--

CREATE TABLE `wishes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ue_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('Responsable','Intervenant','Supplementaire','Autre') NOT NULL,
  `message` text DEFAULT NULL,
  `status` enum('en attent','accepetee','refusee') NOT NULL DEFAULT 'en attent',
  `response` text DEFAULT NULL,
  `responded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `responded_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affectations`
--
ALTER TABLE `affectations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `affectations_prof_id_foreign` (`prof_id`),
  ADD KEY `affectations_ue_id_foreign` (`ue_id`),
  ADD KEY `affectations_affecter_par_foreign` (`affecter_par`);

--
-- Indexes for table `annonces`
--
ALTER TABLE `annonces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charge_horaires`
--
ALTER TABLE `charge_horaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `charge_horaires_affectation_id_foreign` (`affectation_id`),
  ADD KEY `charge_horaires_groupe_id_foreign` (`groupe_id`);

--
-- Indexes for table `contraintes_enseignants`
--
ALTER TABLE `contraintes_enseignants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contraintes_enseignants_enseignant_id_foreign` (`enseignant_id`);

--
-- Indexes for table `contraintes_salles`
--
ALTER TABLE `contraintes_salles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contraintes_salles_salle_id_foreign` (`salle_id`);

--
-- Indexes for table `deparetement_maths`
--
ALTER TABLE `deparetement_maths`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emploi_du_temps`
--
ALTER TABLE `emploi_du_temps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emploi_du_temps_ue_id_foreign` (`ue_id`),
  ADD KEY `emploi_du_temps_enseignant_id_foreign` (`enseignant_id`),
  ADD KEY `emploi_du_temps_salle_id_foreign` (`salle_id`),
  ADD KEY `emploi_du_temps_niveau_id_foreign` (`niveau_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `filieres`
--
ALTER TABLE `filieres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filieres_departement_id_foreign` (`departement_id`);

--
-- Indexes for table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupes_niveau_id_foreign` (`niveau_id`);

--
-- Indexes for table `groupe_enseignements`
--
ALTER TABLE `groupe_enseignements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupe_enseignements_affectation_id_foreign` (`affectation_id`),
  ADD KEY `groupe_enseignements_groupe_id_foreign` (`groupe_id`);

--
-- Indexes for table `historique_charges`
--
ALTER TABLE `historique_charges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historique_charges_prof_id_foreign` (`prof_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `niveaux`
--
ALTER TABLE `niveaux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `niveaux_filiere_id_foreign` (`filiere_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_professor_id_foreign` (`professor_id`),
  ADD KEY `notes_ue_id_academic_year_session_type_index` (`ue_id`,`academic_year`,`session_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `responsabilite`
--
ALTER TABLE `responsabilite`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `responsabilite_idprof_unique` (`idProf`),
  ADD KEY `responsabilite_idf_foreign` (`idf`);

--
-- Indexes for table `salles`
--
ALTER TABLE `salles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salles_department_id_foreign` (`department_id`);

--
-- Indexes for table `specialites`
--
ALTER TABLE `specialites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialites_iddepartement_foreign` (`idDepartement`);

--
-- Indexes for table `ues`
--
ALTER TABLE `ues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ues_filiere_id_foreign` (`filiere_id`),
  ADD KEY `ues_department_id_foreign` (`department_id`),
  ADD KEY `ues_responsable_id_foreign` (`responsable_id`),
  ADD KEY `ues_niveau_id_foreign` (`niveau_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishes`
--
ALTER TABLE `wishes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishes_user_id_foreign` (`user_id`),
  ADD KEY `wishes_ue_id_foreign` (`ue_id`),
  ADD KEY `wishes_responded_by_foreign` (`responded_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `affectations`
--
ALTER TABLE `affectations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `annonces`
--
ALTER TABLE `annonces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `charge_horaires`
--
ALTER TABLE `charge_horaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contraintes_enseignants`
--
ALTER TABLE `contraintes_enseignants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contraintes_salles`
--
ALTER TABLE `contraintes_salles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deparetement_maths`
--
ALTER TABLE `deparetement_maths`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emploi_du_temps`
--
ALTER TABLE `emploi_du_temps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filieres`
--
ALTER TABLE `filieres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groupe_enseignements`
--
ALTER TABLE `groupe_enseignements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `historique_charges`
--
ALTER TABLE `historique_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `niveaux`
--
ALTER TABLE `niveaux`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responsabilite`
--
ALTER TABLE `responsabilite`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `salles`
--
ALTER TABLE `salles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specialites`
--
ALTER TABLE `specialites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ues`
--
ALTER TABLE `ues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `wishes`
--
ALTER TABLE `wishes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `affectations`
--
ALTER TABLE `affectations`
  ADD CONSTRAINT `affectations_affecter_par_foreign` FOREIGN KEY (`affecter_par`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `affectations_prof_id_foreign` FOREIGN KEY (`prof_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `affectations_ue_id_foreign` FOREIGN KEY (`ue_id`) REFERENCES `ues` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `charge_horaires`
--
ALTER TABLE `charge_horaires`
  ADD CONSTRAINT `charge_horaires_affectation_id_foreign` FOREIGN KEY (`affectation_id`) REFERENCES `affectations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `charge_horaires_groupe_id_foreign` FOREIGN KEY (`groupe_id`) REFERENCES `groupe_enseignements` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `contraintes_enseignants`
--
ALTER TABLE `contraintes_enseignants`
  ADD CONSTRAINT `contraintes_enseignants_enseignant_id_foreign` FOREIGN KEY (`enseignant_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contraintes_salles`
--
ALTER TABLE `contraintes_salles`
  ADD CONSTRAINT `contraintes_salles_salle_id_foreign` FOREIGN KEY (`salle_id`) REFERENCES `salles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `emploi_du_temps`
--
ALTER TABLE `emploi_du_temps`
  ADD CONSTRAINT `emploi_du_temps_enseignant_id_foreign` FOREIGN KEY (`enseignant_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emploi_du_temps_niveau_id_foreign` FOREIGN KEY (`niveau_id`) REFERENCES `niveaux` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emploi_du_temps_salle_id_foreign` FOREIGN KEY (`salle_id`) REFERENCES `salles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emploi_du_temps_ue_id_foreign` FOREIGN KEY (`ue_id`) REFERENCES `ues` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `filieres`
--
ALTER TABLE `filieres`
  ADD CONSTRAINT `filieres_departement_id_foreign` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `groupes`
--
ALTER TABLE `groupes`
  ADD CONSTRAINT `groupes_niveau_id_foreign` FOREIGN KEY (`niveau_id`) REFERENCES `niveaux` (`id`);

--
-- Constraints for table `groupe_enseignements`
--
ALTER TABLE `groupe_enseignements`
  ADD CONSTRAINT `groupe_enseignements_affectation_id_foreign` FOREIGN KEY (`affectation_id`) REFERENCES `affectations` (`id`),
  ADD CONSTRAINT `groupe_enseignements_groupe_id_foreign` FOREIGN KEY (`groupe_id`) REFERENCES `groupes` (`id`);

--
-- Constraints for table `historique_charges`
--
ALTER TABLE `historique_charges`
  ADD CONSTRAINT `historique_charges_prof_id_foreign` FOREIGN KEY (`prof_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `niveaux`
--
ALTER TABLE `niveaux`
  ADD CONSTRAINT `niveaux_filiere_id_foreign` FOREIGN KEY (`filiere_id`) REFERENCES `filieres` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_professor_id_foreign` FOREIGN KEY (`professor_id`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `notes_ue_id_foreign` FOREIGN KEY (`ue_id`) REFERENCES `ues` (`id`);

--
-- Constraints for table `responsabilite`
--
ALTER TABLE `responsabilite`
  ADD CONSTRAINT `responsabilite_idf_foreign` FOREIGN KEY (`idf`) REFERENCES `filieres` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salles`
--
ALTER TABLE `salles`
  ADD CONSTRAINT `salles_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departements` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `specialites`
--
ALTER TABLE `specialites`
  ADD CONSTRAINT `specialites_iddepartement_foreign` FOREIGN KEY (`idDepartement`) REFERENCES `departements` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ues`
--
ALTER TABLE `ues`
  ADD CONSTRAINT `ues_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ues_filiere_id_foreign` FOREIGN KEY (`filiere_id`) REFERENCES `filieres` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ues_niveau_id_foreign` FOREIGN KEY (`niveau_id`) REFERENCES `niveaux` (`id`);

--
-- Constraints for table `wishes`
--
ALTER TABLE `wishes`
  ADD CONSTRAINT `wishes_responded_by_foreign` FOREIGN KEY (`responded_by`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `wishes_ue_id_foreign` FOREIGN KEY (`ue_id`) REFERENCES `ues` (`id`),
  ADD CONSTRAINT `wishes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
