-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2022 at 03:38 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nrims_tanzania`
--

-- --------------------------------------------------------

--
-- Table structure for table `apvr_abstracts`
--

CREATE TABLE `apvr_abstracts` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `recAffiliated_id` int(255) NOT NULL,
  `fileAttachment` varchar(255) NOT NULL,
  `created` varchar(50) NOT NULL,
  `status` enum('Submitted','Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `assignedto` enum('Not Assigned','Assigned') NOT NULL DEFAULT 'Not Assigned',
  `title` varchar(255) NOT NULL,
  `category` enum('Publications','Abstract') NOT NULL DEFAULT 'Abstract',
  `details` text NOT NULL,
  `PermissiontopublishAbstract` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_ammendments`
--

CREATE TABLE `apvr_ammendments` (
  `id` int(11) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` varchar(255) NOT NULL,
  `recAffiliated_id` int(255) NOT NULL,
  `listchanges` longtext NOT NULL,
  `atype` varchar(255) NOT NULL,
  `fileAttachment` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `status` enum('New','Pending','Approved','Rejected','Submitted','Scheduled for Review','Conditional Approval','Resubmit') NOT NULL DEFAULT 'Pending',
  `assignedto` enum('Not Assigned','Assigned') NOT NULL DEFAULT 'Not Assigned',
  `period` varchar(50) NOT NULL,
  `end_of_project` varchar(50) NOT NULL,
  `aLanguage` varchar(150) NOT NULL,
  `aVersion` varchar(100) NOT NULL,
  `aDate` varchar(50) NOT NULL,
  `code` varchar(150) NOT NULL,
  `ReasonforAmendment` text NOT NULL,
  `changestostudyDistricts` text NOT NULL,
  `ChangestoConsentForm` varchar(10) NOT NULL,
  `ChangestodataCollectionTool` varchar(10) NOT NULL,
  `ChangestoProtocol` varchar(10) NOT NULL,
  `Attachnewconsentform` varchar(255) NOT NULL,
  `Attachnewtool` varchar(255) NOT NULL,
  `Attachnewprotocol` varchar(255) NOT NULL,
  `paymentProof` enum('Not Paid','Paid','Not Confirmed','Review Pending Payment','Payment Waiver') NOT NULL DEFAULT 'Not Paid',
  `is_sent` int(11) NOT NULL DEFAULT 0,
  `public_title_amendment` text NOT NULL,
  `ammendType` enum('online','manual') NOT NULL DEFAULT 'online',
  `protocol_title` text NOT NULL,
  `refNo` varchar(255) NOT NULL,
  `CompletenessCheck` enum('Approved','Rejected','Pending') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_ammendments_documents`
--

CREATE TABLE `apvr_ammendments_documents` (
  `id` int(11) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `recAffiliated_id` int(255) NOT NULL,
  `listchanges` longtext NOT NULL,
  `atype` text NOT NULL,
  `fileAttachment` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `status` enum('Pending','Approved','Rejected','Submitted','Scheduled for Review') NOT NULL DEFAULT 'Pending',
  `assignedto` enum('Not Assigned','Assigned') NOT NULL DEFAULT 'Not Assigned',
  `period` varchar(50) NOT NULL,
  `end_of_project` varchar(50) NOT NULL,
  `aLanguage` varchar(150) NOT NULL,
  `aVersion` varchar(100) NOT NULL,
  `aDate` varchar(50) NOT NULL,
  `code` varchar(150) NOT NULL,
  `ReasonforAmendment` text NOT NULL,
  `changestostudyDistricts` text NOT NULL,
  `ChangestoConsentForm` varchar(10) NOT NULL,
  `ChangestodataCollectionTool` varchar(10) NOT NULL,
  `ChangestoProtocol` varchar(10) NOT NULL,
  `Attachnewconsentform` varchar(255) NOT NULL,
  `Attachnewtool` varchar(255) NOT NULL,
  `Attachnewprotocol` varchar(255) NOT NULL,
  `paymentProof` enum('Not Paid','Paid','Not Confirmed','Review Pending Payment','Payment Waiver') NOT NULL DEFAULT 'Not Paid',
  `is_sent` int(11) NOT NULL,
  `ammendType` enum('online','manual') NOT NULL DEFAULT 'online',
  `protocol_title` text NOT NULL,
  `refNo` varchar(255) NOT NULL,
  `amendment_id` int(255) NOT NULL,
  `otherattachment` varchar(255) NOT NULL,
  `includedon_approval` enum('No','Yes') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_annual_stages`
--

CREATE TABLE `apvr_annual_stages` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `annual_id` int(255) NOT NULL,
  `protocol_information` int(11) NOT NULL,
  `status_of_participants` int(11) NOT NULL,
  `literature` int(11) NOT NULL,
  `future_plans` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `status` enum('new','completed') NOT NULL DEFAULT 'new',
  `payment_proof` int(11) NOT NULL,
  `ammendType` enum('online','manual') NOT NULL DEFAULT 'online',
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_appeal_halted_studies`
--

CREATE TABLE `apvr_appeal_halted_studies` (
  `id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `halted_by` int(255) NOT NULL,
  `reasonsforhalting` longtext NOT NULL,
  `appealReason` longtext NOT NULL,
  `dateHaulted` varchar(50) NOT NULL,
  `status` enum('Pending','Appeal Accepted','Rejected','Fowarded','Scheduled for Review','Submitted') NOT NULL DEFAULT 'Pending',
  `committeDecision` text NOT NULL,
  `appealDate` varchar(50) NOT NULL,
  `appealSubmitted` enum('No','Yes') NOT NULL DEFAULT 'No',
  `assignedto` varchar(50) NOT NULL,
  `reasonAfterReview` longtext NOT NULL,
  `reviewedOn` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_attendences`
--

CREATE TABLE `apvr_attendences` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `recAffiliated_id` int(255) NOT NULL,
  `DocumentName` varchar(255) NOT NULL,
  `Version` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Attachment` varchar(255) NOT NULL,
  `docDate` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_categories`
--

CREATE TABLE `apvr_categories` (
  `rstug_categoryID` int(255) NOT NULL,
  `rstug_categoryName` varchar(255) NOT NULL,
  `rstugshort1` varchar(50) NOT NULL,
  `rstugshort2` varchar(50) NOT NULL,
  `rstugNo` int(255) NOT NULL,
  `publish` enum('No','Yes') NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_categories`
--

INSERT INTO `apvr_categories` (`rstug_categoryID`, `rstug_categoryName`, `rstugshort1`, `rstugshort2`, `rstugNo`, `publish`) VALUES
(1, 'Medical and Health Sciences', 'HS', 'ES', 312, 'Yes'),
(2, 'Social Science', 'SS', 'ES', 269, 'Yes'),
(3, 'Natural Sciences', 'NS', 'ES', 80, 'Yes'),
(5, 'Agricultural Sciences', 'AS', 'ES', 40, 'Yes'),
(6, 'Engineering and Technology', 'SIR', 'ES', 15, 'Yes'),
(9, 'Humanities', 'H', 'ES', 0, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_clinical_study_methodology`
--

CREATE TABLE `apvr_clinical_study_methodology` (
  `id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `general_procedures` longtext NOT NULL,
  `owner_id` int(11) NOT NULL,
  `analysis_plan` longtext NOT NULL,
  `ethical_considerations` longtext NOT NULL,
  `interventions` longtext NOT NULL,
  `primary_outcome` longtext NOT NULL,
  `secondary_outcome` longtext NOT NULL,
  `inclusion_criteria` longtext NOT NULL,
  `exclusion_criteria` longtext NOT NULL,
  `is_sent` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_clinical_study_methodology`
--

INSERT INTO `apvr_clinical_study_methodology` (`id`, `protocol_id`, `general_procedures`, `owner_id`, `analysis_plan`, `ethical_considerations`, `interventions`, `primary_outcome`, `secondary_outcome`, `inclusion_criteria`, `exclusion_criteria`, `is_sent`) VALUES
(4120, 4104, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 6793, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `apvr_clinical_study_methodology2`
--

CREATE TABLE `apvr_clinical_study_methodology2` (
  `id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `general_procedures` longtext NOT NULL,
  `owner_id` int(11) NOT NULL,
  `analysis_plan` longtext NOT NULL,
  `ethical_considerations` longtext NOT NULL,
  `interventions` longtext NOT NULL,
  `primary_outcome` longtext NOT NULL,
  `secondary_outcome` longtext NOT NULL,
  `inclusion_criteria` longtext NOT NULL,
  `exclusion_criteria` longtext NOT NULL,
  `is_sent` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_clinical_study_methodology_archive`
--

CREATE TABLE `apvr_clinical_study_methodology_archive` (
  `id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `general_procedures` longtext NOT NULL,
  `owner_id` int(11) NOT NULL,
  `analysis_plan` longtext NOT NULL,
  `ethical_considerations` longtext NOT NULL,
  `interventions` longtext NOT NULL,
  `primary_outcome` longtext NOT NULL,
  `secondary_outcome` longtext NOT NULL,
  `inclusion_criteria` longtext NOT NULL,
  `exclusion_criteria` longtext NOT NULL,
  `is_sent` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_collaborating_institutions`
--

CREATE TABLE `apvr_collaborating_institutions` (
  `id` int(11) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `institutioncode` varchar(100) NOT NULL,
  `protocol_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `DataSharingAgreement` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_completeness_check_comments`
--

CREATE TABLE `apvr_completeness_check_comments` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `reviewer_id` int(255) NOT NULL,
  `chcomments` text NOT NULL,
  `chdate` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_completeness_check_comments`
--

INSERT INTO `apvr_completeness_check_comments` (`id`, `owner_id`, `protocol_id`, `reviewer_id`, `chcomments`, `chdate`, `status`) VALUES
(3488, 6793, 4104, 6794, '', '2022-06-11 15:56:59', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_completeness_check_comments_amendment`
--

CREATE TABLE `apvr_completeness_check_comments_amendment` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `reviewer_id` int(255) NOT NULL,
  `chcomments` text NOT NULL,
  `chdate` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `amendment_id` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_configuration`
--

CREATE TABLE `apvr_configuration` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activemenu` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `apvr_configuration`
--

INSERT INTO `apvr_configuration` (`id`, `created`, `updated`, `key`, `value`, `description`, `activemenu`) VALUES
(2, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'committee.name', 'Research Ethics Committee Approval', 'Committee Name', ''),
(3, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'committee.prefix', 'REC', 'Committee Prefix Code', ''),
(4, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'committee.email', 'info@uncst.go.ug', 'Committee Contact', ''),
(5, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'committee.address', 'Plot 6, Kimera Road, Ntinda | P.O.Box 6884, Kampala Uganda', 'Committee Address', ''),
(6, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'committee.phones', '+256 414 705500<br>+256 414 234579', 'Committee Phone Numbers', ''),
(7, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'recaptcha.secret', '6LdtCiITAAAAACON37pbmsAo1hjEUAjqz33rB-5r', 'Google ReCaptcha Secret Key', ''),
(8, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'committee.description', '<p>The National Guidelines for Research Involving Humans as Research Participants July 2014, provide a national framework for harnessing the benefits of research while ensuring that the rights, interests, values and welfare of people who take part in the research are not compromised. It is a requirement in the guidelines for all Research Ethics Committees (RECs) operating in Uganda to be accredited by UNCST. These guidelines outline the process of REC accreditation in Uganda.</p>\r\n<p>Accreditation of RECs is within  Section 4 of the National Guidelines for Research Involving Humans as Research Participants published by UNCST in July 2014, which requires all RECs operating in Uganda to be accredited by UNCST. The Accreditation is valid for three (3) years and is subject to the RECs’ continuing compliance with all applicable national standards and guidelines for RECs in Uganda, and to any additional stipulations or guidelines that may be provided by the UNCST.</p>', 'Committee Description', ''),
(9, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'committee.logourl', '/bundles/proethos2core/img/recuncst.png', 'Committee Logo Image URL', '');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_decision_status`
--

CREATE TABLE `apvr_decision_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `actionfor` enum('both','reviewers','endreview','na') NOT NULL DEFAULT 'both'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_decision_status`
--

INSERT INTO `apvr_decision_status` (`id`, `name`, `actionfor`) VALUES
(1, 'Approved', 'both'),
(2, 'Rejected', 'both'),
(3, 'Conditional Approval | Needs Minor Revisions', 'both'),
(4, 'Resubmit | Needs Major Revisions', 'both'),
(5, 'Needs Minor Revisions', 'reviewers'),
(6, 'Needs Major Revisions', 'reviewers'),
(7, 'Request for Responses', 'na'),
(8, 'Invitation to a VIVA', 'both'),
(9, 'Recommended for Approval', 'reviewers');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_determination_of_risk`
--

CREATE TABLE `apvr_determination_of_risk` (
  `id` int(11) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `Humanexposure` varchar(5) NOT NULL,
  `Humangenetics` varchar(5) NOT NULL,
  `StemCells` varchar(5) NOT NULL,
  `Fetaltissue` varchar(5) NOT NULL,
  `Investigationalnewdrug` varchar(5) NOT NULL,
  `Investigationalnewdevice` varchar(5) NOT NULL,
  `Existingdataavailable` varchar(5) NOT NULL,
  `ExistingdataNotavailable` varchar(5) NOT NULL,
  `storedsamples` varchar(5) NOT NULL,
  `transferofspecimen` varchar(5) NOT NULL,
  `Observation` varchar(5) NOT NULL,
  `recordedInfo` varchar(5) NOT NULL,
  `sensitiveaspects` varchar(5) NOT NULL,
  `recordedInfobeRecorded` varchar(5) NOT NULL,
  `recordedaboutindividual` varchar(5) NOT NULL,
  `updatedon` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_determination_of_risk`
--

INSERT INTO `apvr_determination_of_risk` (`id`, `owner_id`, `protocol_id`, `Humanexposure`, `Humangenetics`, `StemCells`, `Fetaltissue`, `Investigationalnewdrug`, `Investigationalnewdevice`, `Existingdataavailable`, `ExistingdataNotavailable`, `storedsamples`, `transferofspecimen`, `Observation`, `recordedInfo`, `sensitiveaspects`, `recordedInfobeRecorded`, `recordedaboutindividual`, `updatedon`, `status`) VALUES
(4066, 6793, 4104, 'Yes', 'Yes', 'No', 'No', 'Yes', 'Yes', 'No', 'No', 'No', 'Yes', 'Yes', 'Yes', 'No', 'No', 'No', '2022-06-11', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_determination_of_risk_archive`
--

CREATE TABLE `apvr_determination_of_risk_archive` (
  `id` int(11) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `Humanexposure` varchar(5) NOT NULL,
  `Humangenetics` varchar(5) NOT NULL,
  `StemCells` varchar(5) NOT NULL,
  `Fetaltissue` varchar(5) NOT NULL,
  `Investigationalnewdrug` varchar(5) NOT NULL,
  `Investigationalnewdevice` varchar(5) NOT NULL,
  `Existingdataavailable` varchar(5) NOT NULL,
  `ExistingdataNotavailable` varchar(5) NOT NULL,
  `storedsamples` varchar(5) NOT NULL,
  `transferofspecimen` varchar(5) NOT NULL,
  `Observation` varchar(5) NOT NULL,
  `recordedInfo` varchar(5) NOT NULL,
  `sensitiveaspects` varchar(5) NOT NULL,
  `recordedInfobeRecorded` varchar(5) NOT NULL,
  `recordedaboutindividual` varchar(5) NOT NULL,
  `updatedon` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_deviations`
--

CREATE TABLE `apvr_deviations` (
  `deviationID` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `recAffiliated_id` int(255) NOT NULL,
  `PDDateofoccurrence` varchar(50) NOT NULL,
  `PDDescriptionofdeviation` text NOT NULL,
  `Rootcauseofdeviation` text NOT NULL,
  `Correctiveactiontaken` text NOT NULL,
  `Measurestomitigatedeviation` text NOT NULL,
  `PVDateofoccurrence` varchar(50) NOT NULL,
  `PVDescriptionofdeviation` text NOT NULL,
  `parta` text NOT NULL,
  `partaOther` text NOT NULL,
  `partb` text NOT NULL,
  `Rootcauseofviolation_b` text NOT NULL,
  `Correctiveaction_b` text NOT NULL,
  `Measurestomitigateviolation_b` text NOT NULL,
  `updatedon` varchar(50) NOT NULL,
  `status` enum('New','Pending','Approved','Rejected','Submitted','Scheduled for Review','Conditional Approval','Resubmit') NOT NULL DEFAULT 'Pending',
  `assignedto` enum('Not Assigned','Assigned') NOT NULL DEFAULT 'Not Assigned',
  `is_sent` int(11) NOT NULL,
  `paymentProof` enum('Not Paid','Paid','Not Confirmed','Review Pending Payment','Payment Waiver') NOT NULL DEFAULT 'Not Paid',
  `paymentAttachment` text NOT NULL,
  `protocol_title` varchar(255) NOT NULL,
  `ammendType` enum('online','manual') NOT NULL DEFAULT 'online',
  `renewal_id` int(255) NOT NULL,
  `CompletenessCheck` enum('Approved','Rejected','Pending') NOT NULL DEFAULT 'Pending',
  `chosen` enum('Both','Deviation','Violation') NOT NULL DEFAULT 'Both'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_districts`
--

CREATE TABLE `apvr_districts` (
  `districtm_id` int(11) NOT NULL,
  `districtm_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_districts`
--

INSERT INTO `apvr_districts` (`districtm_id`, `districtm_name`) VALUES
(1, 'Buikwe'),
(2, 'Bukomansimbi'),
(3, 'Butambala'),
(4, 'Buvuma'),
(5, 'Gomba'),
(6, 'Kalangala'),
(7, 'Kalungu'),
(8, 'Kampala'),
(9, 'Kayunga'),
(10, 'Kiboga'),
(11, 'Kyankwanzi'),
(12, 'Luweero'),
(13, 'Lwengo'),
(14, 'Lyantonde'),
(15, 'Masaka'),
(16, 'Mityana'),
(17, 'Mpigi'),
(18, 'Mubende'),
(19, 'Mukono'),
(20, 'Nakaseke'),
(21, 'Nakasongola'),
(22, 'Rakai'),
(23, 'Sembabule'),
(24, 'Wakiso'),
(25, 'Amuria'),
(26, 'Budaka'),
(27, 'Bududa'),
(28, 'Bugiri'),
(29, 'Bukedea'),
(30, 'Bukwa'),
(31, 'Bulambuli'),
(32, 'Busia'),
(33, 'Butaleja'),
(34, 'Buyende'),
(35, 'Iganga'),
(36, 'Jinja'),
(37, 'Kaberamaido'),
(38, 'Kaliro'),
(39, 'Kamuli'),
(40, 'Kapchorwa'),
(41, 'Katakwi'),
(42, 'Kibuku'),
(43, 'Kumi'),
(44, 'Kween'),
(45, 'Luuka'),
(46, 'Manafwa'),
(47, 'Mayuge'),
(48, 'Mbale'),
(49, 'Namayingo'),
(50, 'Namutumba'),
(51, 'Ngora'),
(52, 'Pallisa'),
(53, 'Serere'),
(54, 'Sironko'),
(55, 'Soroti'),
(56, 'Tororo'),
(57, 'Abim'),
(58, 'Adjumani'),
(59, 'Agago'),
(60, 'Alebtong'),
(61, 'Amolatar'),
(62, 'Amudat'),
(63, 'Amuru'),
(64, 'Apac'),
(65, 'Arua'),
(66, 'Dokolo'),
(67, 'Gulu'),
(68, 'Kaabong'),
(69, 'Kitgum'),
(70, 'Koboko'),
(71, 'Kole'),
(72, 'Kotido'),
(73, 'Lamwo'),
(74, 'Lira'),
(75, 'Maracha'),
(76, 'Moroto'),
(77, 'Moyo'),
(78, 'Nakapiripirit'),
(79, 'Napak'),
(80, 'Nebbi'),
(81, 'Nwoya'),
(82, 'Otuke'),
(83, 'Oyam'),
(84, 'Pader'),
(85, 'Yumbe'),
(86, 'Zombo'),
(87, 'Buhweju'),
(88, 'Buliisa'),
(89, 'Bundibugyo'),
(90, 'Bushenyi'),
(91, 'Hoima'),
(92, 'Ibanda'),
(93, 'Isingiro'),
(94, 'Kabale'),
(95, 'Kabarole'),
(96, 'Kamwenge'),
(97, 'Kanungu'),
(98, 'Kasese'),
(99, 'Kibaale'),
(100, 'Kiruhura'),
(101, 'Kiryandongo'),
(102, 'Kisoro'),
(103, 'Kyegegwa'),
(104, 'Kyenjojo'),
(105, 'Masindi'),
(106, 'Mbarara'),
(107, 'Mitooma'),
(108, 'Ntoroko'),
(109, 'Ntungamo'),
(110, 'Rubirizi'),
(111, 'Rukungiri'),
(112, 'Sheema'),
(113, 'Not Applicable (N/A)'),
(114, 'pakwach'),
(115, 'Kyotera'),
(116, 'Central Region'),
(117, 'Western Region'),
(118, 'Eastern Region'),
(119, 'Northern Region'),
(120, 'All Districts');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_document`
--

CREATE TABLE `apvr_document` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filepath` varchar(1023) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_document_role`
--

CREATE TABLE `apvr_document_role` (
  `document_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_education_history`
--

CREATE TABLE `apvr_education_history` (
  `rstug_educn_id` int(255) NOT NULL,
  `rstug_user_id` int(255) NOT NULL,
  `rstug_educn_university` varchar(255) NOT NULL,
  `rstug_educn_designation` varchar(255) NOT NULL,
  `rstug_educn_year` int(50) NOT NULL,
  `completionyear` varchar(20) NOT NULL,
  `rstug_educn_period` varchar(255) NOT NULL,
  `rstug_ammend` int(11) NOT NULL,
  `rstug_Synched` int(11) NOT NULL,
  `teamMemberID` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_education_history`
--

INSERT INTO `apvr_education_history` (`rstug_educn_id`, `rstug_user_id`, `rstug_educn_university`, `rstug_educn_designation`, `rstug_educn_year`, `completionyear`, `rstug_educn_period`, `rstug_ammend`, `rstug_Synched`, `teamMemberID`) VALUES
(13110, 6793, 'vaAVSASAF', 'vaAVSASAF', 2017, '2021', 'vaAVSASAF', 0, 0, 8644);

-- --------------------------------------------------------

--
-- Table structure for table `apvr_employment_details`
--

CREATE TABLE `apvr_employment_details` (
  `rstug_employment_id` int(255) NOT NULL,
  `rstug_user_id` int(255) NOT NULL,
  `rstug_institution` varchar(255) NOT NULL,
  `rstug_designation` varchar(255) NOT NULL,
  `rstug_year` int(10) NOT NULL,
  `completionyear` varchar(10) NOT NULL,
  `rstug_period` varchar(50) NOT NULL,
  `rstug_ammend` int(11) NOT NULL,
  `teamMemberID` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_employment_details`
--

INSERT INTO `apvr_employment_details` (`rstug_employment_id`, `rstug_user_id`, `rstug_institution`, `rstug_designation`, `rstug_year`, `completionyear`, `rstug_period`, `rstug_ammend`, `teamMemberID`) VALUES
(8330, 6793, 'vaAVSASAF', 'vaAVSASAF', 2020, '2022', '2', 0, 8644);

-- --------------------------------------------------------

--
-- Table structure for table `apvr_ext_translations`
--

CREATE TABLE `apvr_ext_translations` (
  `id` int(11) NOT NULL,
  `locale` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `foreign_key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_faq`
--

CREATE TABLE `apvr_faq` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_final_reports`
--

CREATE TABLE `apvr_final_reports` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `recAffiliated_id` int(255) NOT NULL,
  `fileAttachment` varchar(255) NOT NULL,
  `created` varchar(50) NOT NULL,
  `status` enum('Submitted','Pending','Approved','Rejected','Scheduled for Review') NOT NULL DEFAULT 'Pending',
  `assignedto` enum('Not Assigned','Assigned') NOT NULL DEFAULT 'Not Assigned',
  `ammendType` enum('online','manual') NOT NULL DEFAULT 'online',
  `protocol_title` text NOT NULL,
  `CompletenessCheck` enum('Approved','Rejected','Pending') NOT NULL DEFAULT 'Pending',
  `is_sent` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `approved_date` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_final_reports_attachments`
--

CREATE TABLE `apvr_final_reports_attachments` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `recAffiliated_id` int(255) NOT NULL,
  `fileAttachment` varchar(255) NOT NULL,
  `created` varchar(50) NOT NULL,
  `notification_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_help`
--

CREATE TABLE `apvr_help` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_initial_committee_screening`
--

CREATE TABLE `apvr_initial_committee_screening` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `screening` text NOT NULL,
  `draftopinion` varchar(255) NOT NULL,
  `recAffiliated_id` int(11) NOT NULL,
  `reviewer_id` int(255) NOT NULL,
  `screeningFor` enum('protocol','AnnualRenewal','Amendments','SAEs','Deviations','Notifications','CloseOutReport','HaltedAppeal') NOT NULL DEFAULT 'protocol',
  `completionStatus` enum('Pending','Completed') NOT NULL DEFAULT 'Pending',
  `collectiveDecision` enum('No','Yes') NOT NULL DEFAULT 'No',
  `ammendType` enum('online','manual') NOT NULL DEFAULT 'online',
  `renewal_id` int(255) NOT NULL,
  `public_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_initial_committee_screening`
--

INSERT INTO `apvr_initial_committee_screening` (`id`, `owner_id`, `protocol_id`, `created`, `updated`, `screening`, `draftopinion`, `recAffiliated_id`, `reviewer_id`, `screeningFor`, `completionStatus`, `collectiveDecision`, `ammendType`, `renewal_id`, `public_title`) VALUES
(10010, 6793, 4104, '2022-06-11 15:57:14', '2022-06-11 15:57:14', 'TEst', '', 0, 6794, 'protocol', 'Completed', 'Yes', 'online', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_list_clinical_trial_name`
--

CREATE TABLE `apvr_list_clinical_trial_name` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_list_country`
--

CREATE TABLE `apvr_list_country` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `apvr_list_country`
--

INSERT INTO `apvr_list_country` (`id`, `created`, `updated`, `code`, `name`) VALUES
(1, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'AF', 'Afghanistan'),
(2, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'AX', 'Aland Islands'),
(3, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'AL', 'Albania'),
(4, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'DZ', 'Algeria'),
(5, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'AS', 'American Samoa'),
(6, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'AD', 'Andorra'),
(7, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'AO', 'Angola'),
(8, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'AI', 'Anguilla'),
(9, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'AQ', 'Antarctica'),
(10, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'AG', 'Antigua & Barbuda'),
(11, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'AR', 'Argentina'),
(12, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'AM', 'Armenia'),
(13, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'AW', 'Aruba'),
(14, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'AC', 'Ascension Island'),
(15, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'AU', 'Australia'),
(16, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'AT', 'Austria'),
(17, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'AZ', 'Azerbaijan'),
(18, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BS', 'Bahamas'),
(19, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BH', 'Bahrain'),
(20, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BD', 'Bangladesh'),
(21, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BB', 'Barbados'),
(22, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BY', 'Belarus'),
(23, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BE', 'Belgium'),
(24, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BZ', 'Belize'),
(25, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BJ', 'Benin'),
(26, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BM', 'Bermuda'),
(27, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BT', 'Bhutan'),
(28, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BO', 'Bolivia'),
(29, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BA', 'Bosnia & Herzegovina'),
(30, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BW', 'Botswana'),
(31, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BR', 'Brazil'),
(32, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'IO', 'British Indian Ocean Territory'),
(33, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'VG', 'British Virgin Islands'),
(34, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BN', 'Brunei'),
(35, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BG', 'Bulgaria'),
(36, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BF', 'Burkina Faso'),
(37, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BI', 'Burundi'),
(38, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'KH', 'Cambodia'),
(39, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'CM', 'Cameroon'),
(40, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'CA', 'Canada'),
(41, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'IC', 'Canary Islands'),
(42, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'CV', 'Cape Verde'),
(43, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BQ', 'Caribbean Netherlands'),
(44, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'KY', 'Cayman Islands'),
(45, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'CF', 'Central African Republic'),
(46, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'EA', 'Ceuta & Melilla'),
(47, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'TD', 'Chad'),
(48, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'CL', 'Chile'),
(49, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'CN', 'China'),
(50, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'CX', 'Christmas Island'),
(51, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'CC', 'Cocos (Keeling) Islands'),
(52, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'CO', 'Colombia'),
(53, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'KM', 'Comoros'),
(54, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'CG', 'Congo - Brazzaville'),
(55, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'CD', 'Congo - Kinshasa'),
(56, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'CK', 'Cook Islands'),
(57, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'CR', 'Costa Rica'),
(59, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'HR', 'Croatia'),
(60, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'CU', 'Cuba'),
(62, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'CY', 'Cyprus'),
(63, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'CZ', 'Czech Republic'),
(64, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'DK', 'Denmark'),
(65, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'DG', 'Diego Garcia'),
(67, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'DM', 'Dominica'),
(68, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'DO', 'Dominican Republic'),
(69, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'EC', 'Ecuador'),
(71, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'SV', 'El Salvador'),
(72, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'GQ', 'Equatorial Guinea'),
(73, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'ER', 'Eritrea'),
(74, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'EE', 'Estonia'),
(75, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'ET', 'Ethiopia'),
(76, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'FK', 'Falkland Islands'),
(77, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'FO', 'Faroe Islands'),
(78, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'FJ', 'Fiji'),
(79, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'FI', 'Finland'),
(80, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'FR', 'France'),
(81, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'GF', 'French Guiana'),
(82, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'PF', 'French Polynesia'),
(83, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'TF', 'French Southern Territories'),
(89, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'GI', 'Gibraltar'),
(98, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'GW', 'Guinea-Bissau'),
(107, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'IR', 'Iran'),
(108, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'IQ', 'Iraq'),
(109, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'IE', 'Republic of Ireland'),
(111, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'IL', 'Israel'),
(112, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'IT', 'Italy'),
(113, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'JM', 'Jamaica'),
(114, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'JP', 'Japan'),
(116, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'JO', 'Jordan'),
(117, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'KZ', 'Kazakhstan'),
(118, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'KE', 'Kenya'),
(120, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'XK', 'Kosovo'),
(121, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'KW', 'Kuwait'),
(122, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'KG', 'Kyrgyzstan'),
(123, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'LA', 'Laos'),
(124, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'LV', 'Latvia'),
(125, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'LB', 'Lebanon'),
(126, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'LS', 'Lesotho'),
(127, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'LR', 'Liberia'),
(128, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'LY', 'Libya'),
(131, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'LU', 'Luxembourg'),
(133, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'MK', 'Macedonia'),
(134, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'MG', 'Madagascar'),
(135, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'MW', 'Malawi'),
(136, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'MY', 'Malaysia'),
(139, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'MT', 'Malta'),
(141, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'MQ', 'Martinique'),
(142, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'MR', 'Mauritania'),
(143, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'MU', 'Mauritius'),
(144, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'YT', 'Mayotte'),
(145, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'MX', 'Mexico'),
(146, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'FM', 'Micronesia'),
(147, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'MD', 'Moldova'),
(148, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'MC', 'Monaco'),
(149, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'MN', 'Mongolia'),
(150, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'ME', 'Montenegro'),
(151, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'MS', 'Montserrat'),
(152, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'MA', 'Morocco'),
(153, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'MZ', 'Mozambique'),
(166, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'KP', 'North Korea'),
(172, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'PS', 'Palestinian'),
(179, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'PL', 'Poland'),
(180, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'PT', 'Portugal'),
(181, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'PR', 'Puerto Rico'),
(185, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'RU', 'Russia'),
(186, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'RW', 'Rwanda'),
(195, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'SG', 'Singapore'),
(196, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'SX', 'Sint Maarten'),
(199, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'SB', 'Solomon Islands'),
(201, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'ZA', 'South Africa'),
(203, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'KR', 'South Korea'),
(204, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'SS', 'South Sudan'),
(205, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'ES', 'Spain'),
(206, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'LK', 'Sri Lanka'),
(207, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'BL', 'St. Barthélemy'),
(208, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'SH', 'St. Helena'),
(209, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'KN', 'St. Kitts & Nevis'),
(210, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'LC', 'St. Lucia'),
(211, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'MF', 'St. Martin'),
(214, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'SD', 'Sudan'),
(217, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'SZ', 'Swaziland'),
(218, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'SE', 'Sweden'),
(219, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'CH', 'Switzerland'),
(220, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'SY', 'Syria'),
(221, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'TW', 'Taiwan'),
(222, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'TJ', 'Tajikistan'),
(223, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'TZ', 'Tanzania'),
(224, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'TH', 'Thailand'),
(229, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'TT', 'Trinidad & Tobago'),
(230, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'TA', 'Tristan da Cunha'),
(233, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'TM', 'Turkmenistan'),
(234, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'TC', 'Turks & Caicos Islands'),
(237, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'VI', 'U.S. Virgin Islands'),
(240, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'AE', 'United Arab Emirates'),
(241, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'GB', 'United Kingdom'),
(246, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'VA', 'Vatican City'),
(247, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'VE', 'Venezuela'),
(248, '2016-06-21 14:32:00', '2016-06-21 14:32:00', 'VN', 'Vietnam'),
(254, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'GUF', 'French Guiana'),
(258, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'PYF', 'French Polynesia'),
(260, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'ATF', 'French Southern Territories'),
(262, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'DJI', 'Djibouti'),
(266, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'GAB', 'Gabon'),
(268, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'GEO', 'Georgia'),
(270, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'GMB', 'Gambia'),
(276, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'DEU', 'Germany'),
(288, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'GHA', 'Ghana'),
(292, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'GIB', 'Gibraltar'),
(296, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'KIR', 'Kiribati'),
(300, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'GRC', 'Greece'),
(304, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'GRL', 'Greenland'),
(308, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'GRD', 'Grenada'),
(312, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'GLP', 'Guadeloupe'),
(316, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'GUM', 'Guam'),
(320, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'GTM', 'Guatemala'),
(324, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'GIN', 'Guinea'),
(328, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'GUY', 'Guyana'),
(332, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'HTI', 'Haiti'),
(340, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'HND', 'Honduras'),
(344, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'HKG', 'Hong Kong'),
(348, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'HUN', 'Hungary'),
(352, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'ISL', 'Iceland'),
(356, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'IND', 'India'),
(360, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'IDN', 'Indonesia'),
(384, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'CIV', 'Côte d\'Ivoire'),
(408, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'PRK', 'North Korea'),
(410, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'KOR', 'South Korea'),
(418, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'LAO', 'Lao People\'s Democratic Republic'),
(422, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'LBN', 'Lebanon'),
(440, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'LTU', 'Lithuania'),
(442, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'LUX', 'Luxembourg'),
(446, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'MAC', 'Macao'),
(466, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'MLI', 'Mali'),
(512, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'OMN', 'Oman'),
(516, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'NAM', 'Namibia'),
(520, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'NRU', 'Nauru'),
(524, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'NPL', 'Nepal'),
(528, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'NLD', 'Netherlands'),
(531, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'CUW', 'Curaçao'),
(535, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'BES', 'Bonaire, Sint Eustatius and Saba'),
(540, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'NCL', 'New Caledonia'),
(548, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'VUT', 'Vanuatu'),
(554, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'NZL', 'New Zealand'),
(558, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'NIC', 'Nicaragua'),
(562, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'NER', 'Niger'),
(566, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'NGA', 'Nigeria'),
(578, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'NOR', 'Norway'),
(586, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'PAK', 'Pakistan'),
(591, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'PAN', 'Panama'),
(598, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'PNG', 'Papua New Guinea'),
(600, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'PRY', 'Paraguay'),
(604, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'PER', 'Peru'),
(608, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'PHL', 'Philippines'),
(626, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'TLS', 'Timor-Leste'),
(634, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'QAT', 'Qatar'),
(642, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'ROU', 'Romania'),
(662, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'LCA', 'Saint Lucia'),
(674, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'SMR', 'San Marino'),
(682, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'SAU', 'Saudi Arabia'),
(686, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'SEN', 'Senegal'),
(688, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'SRB', 'Serbia'),
(690, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'SYC', 'Seychelles'),
(694, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'SLE', 'Sierra Leone'),
(703, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'SVK', 'Slovakia'),
(705, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'SVN', 'Slovenia'),
(706, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'SOM', 'Somalia'),
(710, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'ZAF', 'South Africa'),
(716, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'ZWE', 'Zimbabwe'),
(732, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'ESH', 'Western Sahara'),
(744, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'SJM', 'Svalbard and Jan Mayen'),
(768, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'TGO', 'Togo'),
(772, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'TKL', 'Tokelau'),
(776, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'TON', 'Tonga'),
(788, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'TUN', 'Tunisia'),
(792, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'TUR', 'Turkey'),
(795, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'TKM', 'Turkmenistan'),
(796, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'TCA', 'Turks and Caicos Islands'),
(798, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'TUV', 'Tuvalu'),
(800, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'UGA', 'Uganda'),
(804, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'UKR', 'Ukraine'),
(818, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'EGY', 'Egypt'),
(831, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'GGY', 'Guernsey'),
(832, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'JEY', 'Jersey'),
(840, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'US', 'United States of America'),
(850, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'VIR', 'Virgin Islands (U.S.)'),
(858, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'URY', 'Uruguay'),
(860, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'UZB', 'Uzbekistan'),
(882, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'WSM', 'Samoa'),
(887, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'YEM', 'Yemen'),
(894, '2016-05-20 11:29:00', '2016-05-20 11:29:00', 'ZMB', 'Zambia'),
(895, '2020-11-05 00:00:00', '2020-11-05 00:00:00', 'na', 'N/A'),
(896, '2021-07-01 00:00:00', '2021-07-01 00:00:00', 'ES', 'Eswatini'),
(897, '2021-07-01 00:00:00', '2021-07-01 00:00:00', 'NC', 'Nicaragua');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_list_districts`
--

CREATE TABLE `apvr_list_districts` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `apvr_list_districts`
--

INSERT INTO `apvr_list_districts` (`id`, `created`, `updated`, `code`, `name`) VALUES
(1, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Buikwe'),
(2, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Bukomansimbi'),
(3, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Butambala'),
(4, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Buvuma'),
(5, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Gomba'),
(6, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kalangala'),
(7, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kalungu'),
(8, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kampala'),
(9, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kayunga'),
(10, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kiboga'),
(11, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kyankwanzi'),
(12, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Luweero'),
(13, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Lwengo'),
(14, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Lyantonde'),
(15, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Masaka'),
(16, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Mityana'),
(17, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Mpigi'),
(18, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Mubende'),
(19, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Mukono'),
(20, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Nakaseke'),
(21, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Nakasongola'),
(22, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Rakai'),
(23, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Ssembabule'),
(24, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Wakiso'),
(25, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Amuria'),
(26, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Budaka'),
(27, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Bududa'),
(28, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Bugiri'),
(29, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Bukedea'),
(30, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Bukwa'),
(31, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Bulambuli'),
(32, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Busia'),
(33, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Butaleja'),
(34, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Buyende'),
(35, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Iganga'),
(36, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Jinja'),
(37, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kaberamaido'),
(38, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kaliro'),
(39, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kamuli'),
(40, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kapchorwa'),
(41, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Katakwi'),
(42, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kibuku'),
(43, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kumi'),
(44, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kween'),
(45, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Luuka'),
(46, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Manafwa'),
(47, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Mayuge'),
(48, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Mbale'),
(49, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Namayingo'),
(50, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Namutumba'),
(51, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Ngora'),
(52, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Pallisa'),
(53, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Serere'),
(54, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Sironko'),
(55, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Soroti'),
(56, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Tororo'),
(57, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Abim'),
(58, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Adjumani'),
(59, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Agago'),
(60, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Alebtong'),
(61, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Amolatar'),
(62, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Amudat'),
(63, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Amuru'),
(64, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Apac'),
(65, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Arua'),
(66, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Dokolo'),
(67, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Gulu'),
(68, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kaabong'),
(69, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kitgum'),
(70, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Koboko'),
(71, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kole'),
(72, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kotido'),
(73, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Lamwo'),
(74, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Lira'),
(75, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Maracha'),
(76, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Moroto'),
(77, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Moyo'),
(78, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Nakapiripirit'),
(79, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Napak'),
(80, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Nebbi'),
(81, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Nwoya'),
(82, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Otuke'),
(83, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Oyam'),
(84, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Pader'),
(85, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Yumbe'),
(86, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Zombo'),
(87, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Buhweju'),
(88, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Buliisa'),
(89, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Bundibugyo'),
(90, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Bushenyi'),
(91, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Hoima'),
(92, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Ibanda'),
(93, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Isingiro'),
(94, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kabale'),
(95, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kabarole'),
(96, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kamwenge'),
(97, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kanungu'),
(98, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kasese'),
(99, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kibaale'),
(100, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kiruhura'),
(101, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kiryandongo'),
(102, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kisoro'),
(103, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kyegegwa'),
(104, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kyenjojo'),
(105, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Masindi'),
(106, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Mbarara'),
(107, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Mitooma'),
(108, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Ntoroko'),
(109, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Ntungamo'),
(110, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Rubirizi'),
(111, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Rukungiri'),
(112, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Sheema'),
(113, '2021-05-03 00:00:00', '2021-05-03 00:00:00', '', 'pakwach'),
(114, '2021-05-21 00:00:00', '2021-05-21 00:00:00', '', 'All Districts'),
(115, '2021-05-21 00:00:00', '2021-05-21 00:00:00', '', 'Central Region'),
(116, '2021-05-21 00:00:00', '2021-05-21 00:00:00', '', 'Northern Region'),
(117, '2021-05-21 00:00:00', '2021-05-21 00:00:00', '', 'Western Region'),
(118, '2021-05-21 00:00:00', '2021-05-21 00:00:00', '', 'Eastern Region'),
(119, '2018-07-07 00:00:00', '2018-07-07 00:00:00', '', 'Kyotera');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_list_gender`
--

CREATE TABLE `apvr_list_gender` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `display` enum('No','Yes') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `apvr_list_gender`
--

INSERT INTO `apvr_list_gender` (`id`, `created`, `updated`, `name`, `slug`, `status`, `display`) VALUES
(1, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'N/A', 'n-a', 5, 'Yes'),
(2, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'Male', 'male', 2, 'Yes'),
(3, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'Female', 'female', 3, 'Yes'),
(4, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'All', 'all', 1, 'Yes'),
(5, '2019-03-06 00:00:00', '2019-03-06 00:00:00', 'Transgender', '', 4, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_list_monitoring_action`
--

CREATE TABLE `apvr_list_monitoring_action` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_list_recruitment_status`
--

CREATE TABLE `apvr_list_recruitment_status` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_list_rec_affiliated`
--

CREATE TABLE `apvr_list_rec_affiliated` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contacts` text COLLATE utf8_unicode_ci NOT NULL,
  `recemail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `recChairName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `recchairEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `accroname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `recNo` int(255) NOT NULL,
  `bankName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `BranchName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payAmount` double NOT NULL,
  `currency` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `recheader` text COLLATE utf8_unicode_ci NOT NULL,
  `shortaddress` text COLLATE utf8_unicode_ci NOT NULL,
  `published` enum('No','Yes') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `apvr_list_rec_affiliated`
--

INSERT INTO `apvr_list_rec_affiliated` (`id`, `created`, `updated`, `name`, `slug`, `status`, `code`, `contacts`, `recemail`, `recChairName`, `recchairEmail`, `accroname`, `recNo`, `bankName`, `BranchName`, `payAmount`, `currency`, `recheader`, `shortaddress`, `published`) VALUES
(24, '2019-01-14 00:00:00', '0000-00-00 00:00:00', 'TEST UNCST REC (Testing Purposes Only)', '', 0, 'UNCST', 'Test UNCST REC<br>\r\nPlot 6, Kimera Road, Ntinda\r\nP.O.Box 6884, Kampala Uganda<br>\r\nTel: +256 414 7055004, +256 414 234579<br>\r\nEmail: info@uncst.go.ug<br>\r\nWebsite: www.uncst.go.ug', 'mawandammoses@yahoo.com', 'Collins Mwesigwa', 'mwesigwa.collins@gmail.com', 'UNCST', 150, '', '', 0, '', 'uncst_uncst-headed.jpg', 'Plot 6, Kimera Road, Ntinda\r\nP.O.Box 6884, Kampala Uganda<br>\r\nTel: +256 414 7055004, +256 414 234579<br>\r\nEmail: info@uncst.go.ug<br>\r\nWebsite: www.uncst.go.ug', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_list_role`
--

CREATE TABLE `apvr_list_role` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_meeting`
--

CREATE TABLE `apvr_meeting` (
  `id` int(11) NOT NULL,
  `created` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `public_title` text COLLATE utf8_unicode_ci NOT NULL,
  `recAffiliated_id` int(11) NOT NULL,
  `meetingStatus` enum('pending','conducted') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `meetingFor` enum('protocol','AnnualRenewal','Amendments','SAEs','Deviations','Notifications','CloseOutReport') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'protocol',
  `meetingCode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ammendType` enum('online','manual') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'online'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_meeting_invitees`
--

CREATE TABLE `apvr_meeting_invitees` (
  `id` int(11) NOT NULL,
  `meeting_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `user_invited` int(255) NOT NULL,
  `created` datetime NOT NULL,
  `meetingstatus` enum('Pending','Closed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_mlogs`
--

CREATE TABLE `apvr_mlogs` (
  `id` int(255) NOT NULL,
  `lg_action` varchar(255) NOT NULL,
  `lg_user` varchar(100) NOT NULL,
  `lg_user_level` varchar(50) NOT NULL,
  `logdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_mlogs`
--

INSERT INTO `apvr_mlogs` (`id`, `lg_action`, `lg_user`, `lg_user_level`, `logdate`) VALUES
(122920, 'Mush Makanga updated protocol, Bibliography Information', 'Mush Makanga', '', '2022-06-11 15:30:51'),
(122921, 'Mush Makanga updated protocol', 'Mush Makanga', '', '2022-06-11 15:31:36'),
(122922, 'Mush Makanga updated protocol', 'Mush Makanga', '', '2022-06-11 15:32:19'),
(122923, 'Mush Makanga updated protocol', 'Mush Makanga', '', '2022-06-11 15:33:03'),
(122924, 'Mush Makanga updated protocol', 'Mush Makanga', '', '2022-06-11 15:33:03'),
(122925, 'Mush Makanga updated protocol', 'Mush Makanga', '', '2022-06-11 15:33:07'),
(122926, 'Mush Makanga updated protocol', 'Mush Makanga', '', '2022-06-11 15:33:50'),
(122927, 'Mush Makanga updated protocol, Bibliography Information', 'Mush Makanga', '', '2022-06-11 15:37:46'),
(122928, 'Mush Makanga updated protocol, Bibliography Information', 'Mush Makanga', '', '2022-06-11 15:38:10'),
(122929, 'Mush Makanga updated protocol, Bibliography Information', 'Mush Makanga', '', '2022-06-11 15:38:45'),
(122930, 'Mush Makanga updated protocol, Bibliography Information', 'Mush Makanga', '', '2022-06-11 15:38:49'),
(122931, 'Mwesigwa Collins added created new protocol', 'Mwesigwa Collins', '', '2022-06-11 15:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_monitoring_reports`
--

CREATE TABLE `apvr_monitoring_reports` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `recAffiliated_id` int(255) NOT NULL,
  `DocumentName` varchar(255) NOT NULL,
  `Version` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Attachment` varchar(255) NOT NULL,
  `docDate` varchar(50) NOT NULL,
  `manualTitle` text NOT NULL,
  `date_report_sent` varchar(20) NOT NULL,
  `date_ofmonitoring_response` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_municipalities`
--

CREATE TABLE `apvr_municipalities` (
  `municipalitityID` int(11) NOT NULL,
  `districtID` int(11) NOT NULL,
  `municipalitityName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_municipalities`
--

INSERT INTO `apvr_municipalities` (`municipalitityID`, `districtID`, `municipalitityName`) VALUES
(1, 1, 'Buikwe'),
(2, 1, 'Kawolo'),
(3, 1, 'Lugazi Tc'),
(4, 1, 'Najja'),
(5, 1, 'Najjembe'),
(6, 1, 'Ngogwe'),
(7, 1, 'Njeru Tc'),
(8, 1, 'Nkokonjeru Tc'),
(9, 1, 'Nyenga'),
(10, 1, 'Ssi-bukunja'),
(11, 1, 'Wakisi'),
(12, 2, 'Bigasa'),
(13, 2, 'Butenga'),
(14, 2, 'Kibinge'),
(15, 2, 'Kitanda'),
(16, 3, 'Budde'),
(17, 3, 'Bulo'),
(18, 3, 'Kalamba'),
(19, 3, 'Kibibi'),
(20, 3, 'Ngando'),
(21, 4, 'Bugaya'),
(22, 4, 'Busamuzi'),
(23, 4, 'Bweema'),
(24, 4, 'Nairambi'),
(25, 5, 'Kabulasoke'),
(26, 5, 'Kyegonza'),
(27, 5, 'Maddu'),
(28, 5, 'Mpenja'),
(29, 6, 'Bubeke'),
(30, 6, 'Bufumira'),
(31, 6, 'Bujjumba'),
(32, 6, 'Kalangala Tc'),
(33, 6, 'Kyamuswa'),
(34, 6, 'Mazinga'),
(35, 6, 'Mugoye'),
(36, 7, 'Bukulula'),
(37, 7, 'Kalungu'),
(38, 7, 'Kyamuliibwa'),
(39, 7, 'Lukaya Tc'),
(40, 7, 'Lwabenge'),
(41, 8, 'Central Division'),
(42, 8, 'Kawempe Division'),
(43, 8, 'Makindye Division'),
(44, 8, 'Nakawa Division'),
(45, 8, 'Rubaga Division'),
(46, 9, 'Bbaale'),
(47, 9, 'Busana'),
(48, 9, 'Galiraaya'),
(49, 9, 'Kangulumira'),
(50, 9, 'Kayonza'),
(51, 9, 'Kayunga'),
(52, 9, 'Kayunga Tc'),
(53, 9, 'Nazigo'),
(54, 10, 'Bukomero'),
(55, 10, 'Dwaniro'),
(56, 10, 'Kapeke'),
(57, 10, 'Kibiga'),
(58, 10, 'Kiboga Tc'),
(59, 10, 'Lwamata'),
(60, 10, 'Muwanga'),
(61, 11, 'Bamunanika'),
(62, 11, 'Bombo Tc'),
(63, 11, 'Butuntumula'),
(64, 11, 'Kalagala'),
(65, 11, 'Kamira'),
(66, 11, 'Katikamu'),
(67, 11, 'Kikyusa'),
(68, 11, 'Luwero'),
(69, 11, 'Luwero Tc'),
(70, 11, 'Makulubita'),
(71, 11, 'Nyimbwa'),
(72, 11, 'Wobulenzi Tc'),
(73, 11, 'Zirobwe'),
(74, 12, 'Kisekka'),
(75, 12, 'Kyazanga'),
(76, 12, 'Lwengo'),
(77, 12, 'Malongo'),
(78, 12, 'Ndagwe'),
(79, 14, 'Kaliiro'),
(80, 14, 'Kasagama'),
(81, 14, 'Kinuuka'),
(82, 14, 'Lyantonde'),
(83, 14, 'Lyantonde Tc'),
(84, 14, 'Mpumudde'),
(85, 15, 'Bukakata'),
(86, 15, 'Buwunga'),
(87, 15, 'Kabonera'),
(88, 15, 'Katwe/butego'),
(89, 15, 'Kimanya/kyabakuza'),
(90, 15, 'Kkingo'),
(91, 15, 'Kyanamukaaka'),
(92, 15, 'Mukungwe'),
(93, 15, 'Nyendo/senyange'),
(94, 16, 'Bulera'),
(95, 16, 'Busimbi'),
(96, 16, 'Butayunja'),
(97, 16, 'Kakindu'),
(98, 16, 'Kikandwa'),
(99, 16, 'Maanyi'),
(100, 16, 'Malangala'),
(101, 16, 'Mityana Tc'),
(102, 16, 'Ssekanyonyi'),
(103, 17, 'Buwama'),
(104, 17, 'Kamengo'),
(105, 17, 'Kiringente'),
(106, 17, 'Kituntu'),
(107, 17, 'Mpigi'),
(108, 17, 'Mpigi Tc'),
(109, 17, 'Muduma'),
(110, 17, 'Nkozi'),
(111, 18, 'Bagezza'),
(112, 18, 'Bukuya'),
(113, 18, 'Butoloogo'),
(114, 18, 'Kasambya'),
(115, 18, 'Kassanda'),
(116, 18, 'Kiganda'),
(117, 18, 'Kitenga'),
(118, 18, 'Kiyuni'),
(119, 18, 'Madudu'),
(120, 18, 'Mubende Tc'),
(121, 18, 'Myanzi'),
(122, 19, 'Goma'),
(123, 19, 'Kasawo'),
(124, 19, 'Kimenyedde'),
(125, 19, 'Kkome Islands'),
(126, 19, 'Kyampisi'),
(127, 19, 'Mukono Tc'),
(128, 19, 'Nabaale'),
(129, 19, 'Nagojje'),
(130, 19, 'Nakisunga'),
(131, 19, 'Nama'),
(132, 19, 'Ntenjeru'),
(133, 19, 'Ntunda'),
(134, 19, 'Seeta-namuganga'),
(135, 20, 'Kapeeka'),
(136, 20, 'Kasangombe'),
(137, 20, 'Kikamulo'),
(138, 20, 'Nakaseke'),
(139, 20, 'Ngoma'),
(140, 20, 'Semuto'),
(141, 20, 'Wakyato'),
(142, 21, 'Kakooge'),
(143, 21, 'Kalongo'),
(144, 21, 'Kalungi'),
(145, 21, 'Lwabyata'),
(146, 21, 'Lwampanga'),
(147, 21, 'Nabiswera'),
(148, 21, 'Nakasongola Tc'),
(149, 21, 'Nakitoma'),
(150, 21, 'Wabinyonyi'),
(151, 22, 'Byakabanda'),
(152, 22, 'Ddwaniro'),
(153, 22, 'Kabira'),
(154, 22, 'Kacheera'),
(155, 22, 'Kagamba (buyamba)'),
(156, 22, 'Kakuuto'),
(157, 22, 'Kalisizo'),
(158, 22, 'Kasaali'),
(159, 22, 'Kasasa'),
(160, 22, 'Kibanda'),
(161, 22, 'Kifamba'),
(162, 22, 'Kirumba'),
(163, 22, 'Kyalulangira'),
(164, 22, 'Kyebe'),
(165, 23, 'Lugusulu'),
(166, 23, 'Lwebitakuli'),
(167, 23, 'Lwemiyaga'),
(168, 23, 'Mateete'),
(169, 23, 'Mijwala'),
(170, 23, 'Ntusi'),
(171, 23, 'Sembabule Tc'),
(172, 24, 'Busukuma'),
(173, 24, 'Division A'),
(174, 24, 'Division B'),
(175, 24, 'Gombe'),
(176, 24, 'Kakiri'),
(177, 24, 'Kasanje'),
(178, 24, 'Katabi'),
(179, 24, 'Kira'),
(180, 24, 'Masulita'),
(181, 24, 'Nabweru'),
(182, 24, 'Namayumba'),
(183, 24, 'Nangabo'),
(184, 25, 'Abarilela'),
(185, 25, 'Acowa'),
(186, 25, 'Asamuk'),
(187, 25, 'Kapelebyong'),
(188, 25, 'Kuju'),
(189, 25, 'Morungatuny'),
(190, 25, 'Obalanga'),
(191, 25, 'Orungo'),
(192, 25, 'Wera'),
(193, 26, 'Budaka'),
(194, 26, 'Iki-iki'),
(195, 26, 'Kaderuna'),
(196, 26, 'Kameruka'),
(197, 26, 'Kamonkoli'),
(198, 26, 'Lyama'),
(199, 26, 'Naboa'),
(200, 27, 'Bubiita'),
(201, 27, 'Bududa'),
(202, 27, 'Bukibokolo'),
(203, 27, 'Bukigai'),
(204, 27, 'Bulucheke'),
(205, 27, 'Bumayoka'),
(206, 27, 'Bushika'),
(207, 28, 'Budhaya'),
(208, 28, 'Bugiri Tc'),
(209, 28, 'Bulesa'),
(210, 28, 'Bulidha'),
(211, 28, 'Buluguyi'),
(212, 28, 'Buwunga'),
(213, 28, 'Iwemba'),
(214, 28, 'Kapyanga'),
(215, 28, 'Muterere'),
(216, 28, 'Nabukalu'),
(217, 28, 'Nankoma'),
(218, 29, 'Bukedea'),
(219, 29, 'Kachumbala'),
(220, 29, 'Kidongole'),
(221, 29, 'Kolir'),
(222, 29, 'Malera'),
(223, 30, 'Bukwa'),
(224, 30, 'Chesower'),
(225, 30, 'Kabei'),
(226, 30, 'Suam'),
(227, 31, 'Buginyanya'),
(228, 31, 'Bukhalu'),
(229, 31, 'Bulago'),
(230, 31, 'Bulegeni'),
(231, 31, 'Buluganya'),
(232, 31, 'Bunambutye'),
(233, 31, 'Masiira'),
(234, 31, 'Muyembe'),
(235, 31, 'Sisiyi'),
(236, 32, 'Buhehe'),
(237, 32, 'Bulumbi'),
(238, 32, 'Busia Tc'),
(239, 32, 'Busitema'),
(240, 32, 'Buteba'),
(241, 32, 'Dabani'),
(242, 32, 'Lumino'),
(243, 32, 'Lunyo'),
(244, 32, 'Masaba'),
(245, 32, 'Masafu'),
(246, 33, 'Budumba'),
(247, 33, 'Busaba'),
(248, 33, 'Busolwe'),
(249, 33, 'Butaleja'),
(250, 33, 'Kachonga'),
(251, 33, 'Nawanjofu'),
(252, 33, 'Nazimasa'),
(253, 34, 'Bugaya'),
(254, 34, 'Buyende'),
(255, 34, 'Kagulu'),
(256, 34, 'Kidera'),
(257, 34, 'Nkondo'),
(258, 35, 'Bulamagi'),
(259, 35, 'Buyanga'),
(260, 35, 'Ibulanku'),
(261, 35, 'Iganga Tc'),
(262, 35, 'Makuutu'),
(263, 35, 'Nabitende'),
(264, 35, 'Nakalama'),
(265, 35, 'Nakigo'),
(266, 35, 'Namalemba'),
(267, 35, 'Nambale'),
(268, 35, 'Namungalwe'),
(269, 35, 'Nawandala'),
(270, 36, 'Budondo'),
(271, 36, 'Busedde'),
(272, 36, 'Butagaya'),
(273, 36, 'Buwenge'),
(274, 36, 'Buwenge Tc'),
(275, 36, 'Buyengo'),
(276, 36, 'Central Division'),
(277, 36, 'Kakira'),
(278, 36, 'Mafubira'),
(279, 36, 'Masese/walukuba'),
(280, 36, 'Mpumudde/kimaka'),
(281, 37, 'Alwa'),
(282, 37, 'Anyara'),
(283, 37, 'Bululu'),
(284, 37, 'Kaberamaido'),
(285, 37, 'Kaberamaido Tc'),
(286, 37, 'Kalaki'),
(287, 37, 'Kobulubulu'),
(288, 37, 'Ochero'),
(289, 37, 'Otuboi'),
(290, 38, 'Bumanya'),
(291, 38, 'Gadumire'),
(292, 38, 'Namugongo'),
(293, 38, 'Namwiwa'),
(294, 38, 'Nawaikoke'),
(295, 39, 'Balawoli'),
(296, 39, 'Bugulumbya'),
(297, 39, 'Bulopa'),
(298, 39, 'Butansi'),
(299, 39, 'Kamuli Tc'),
(300, 39, 'Kisozi'),
(301, 39, 'Kitayunjwa'),
(302, 39, 'Mbulamuti'),
(303, 39, 'Nabwigulu'),
(304, 39, 'Namasagali'),
(305, 39, 'Namwendwa'),
(306, 39, 'Nawanyago'),
(307, 39, 'Wankole'),
(308, 40, 'Chema'),
(309, 40, 'Kapchorwa Tc'),
(310, 40, 'Kaptanya'),
(311, 40, 'Kaserem'),
(312, 40, 'Kawowo'),
(313, 40, 'Sipi'),
(314, 40, 'Tegeres'),
(315, 41, 'Kapujan'),
(316, 41, 'Katakwi'),
(317, 41, 'Katakwi Tc'),
(318, 41, 'Magoro'),
(319, 41, 'Ngariam'),
(320, 41, 'Omodoi'),
(321, 41, 'Ongongoja'),
(322, 41, 'Toroma'),
(323, 41, 'Usuk'),
(324, 42, 'Bulangira'),
(325, 42, 'Buseta'),
(326, 42, 'Kadama'),
(327, 42, 'Kagumu'),
(328, 42, 'Kibuku'),
(329, 42, 'Kirika'),
(330, 42, 'Tirinyi'),
(331, 43, 'Atutur'),
(332, 43, 'Kanyum'),
(333, 43, 'Kumi'),
(334, 43, 'Kumi Tc'),
(335, 43, 'Mukongoro'),
(336, 43, 'Nyero'),
(337, 43, 'Ongino'),
(338, 44, 'Benet'),
(339, 44, 'Binyiny'),
(340, 44, 'Kaproron'),
(341, 44, 'Kwanyiny'),
(342, 44, 'Ngenge'),
(343, 45, 'Bukanga'),
(344, 45, 'Bukooma'),
(345, 45, 'Bulongo'),
(346, 45, 'Ikumbya'),
(347, 45, 'Irongo'),
(348, 45, 'Nawampiti'),
(349, 45, 'Waibuga'),
(350, 46, 'Bubutu'),
(351, 46, 'Bugobero'),
(352, 46, 'Bumbo'),
(353, 46, 'Bumwoni'),
(354, 46, 'Bupoto'),
(355, 46, 'Butiru'),
(356, 46, 'Buwabwala'),
(357, 46, 'Buwagogo'),
(358, 46, 'Kaato'),
(359, 46, 'Sibanga'),
(360, 47, 'Baitambogwe'),
(361, 47, 'Buwaaya'),
(362, 47, 'Immanyiro'),
(363, 47, 'Kigandalo'),
(364, 47, 'Kityerera'),
(365, 47, 'Malongo'),
(366, 47, 'Mayuge Tc'),
(367, 48, 'Bufumbo'),
(368, 48, 'Bukonde'),
(369, 48, 'Bukyiende'),
(370, 48, 'Bungokho'),
(371, 48, 'Bungokho-mutoto'),
(372, 48, 'Busano'),
(373, 48, 'Busiu'),
(374, 48, 'Busoba'),
(375, 48, 'Industrial Division'),
(376, 48, 'Nakaloke'),
(377, 48, 'Namanyonyi'),
(378, 48, 'Northern Division'),
(379, 48, 'Wanale'),
(380, 48, 'Wanale Division'),
(381, 49, 'Banda'),
(382, 49, 'Buswale'),
(383, 49, 'Buyinja'),
(384, 49, 'Mutumba'),
(385, 49, 'Sigulu Islands'),
(386, 50, 'Bulange'),
(387, 50, 'Ivukula'),
(388, 50, 'Kibaale'),
(389, 50, 'Magada'),
(390, 50, 'Namutumba'),
(391, 50, 'Nsinze'),
(392, 51, 'Kapir'),
(393, 51, 'Kobwin'),
(394, 51, 'Mukura'),
(395, 51, 'Ngora'),
(396, 52, 'Agule'),
(397, 52, 'Apopong'),
(398, 52, 'Butebo'),
(399, 52, 'Gogonyo'),
(400, 52, 'Kabwangasi'),
(401, 52, 'Kakoro'),
(402, 52, 'Kameke'),
(403, 52, 'Kamuge'),
(404, 52, 'Kasodo'),
(405, 52, 'Kibale'),
(406, 52, 'Pallisa'),
(407, 52, 'Pallisa Tc'),
(408, 52, 'Petete'),
(409, 52, 'Puti-puti'),
(410, 53, 'Atiira'),
(411, 53, 'Bugondo'),
(412, 53, 'Kadungulu'),
(413, 53, 'Kateta'),
(414, 53, 'Kyere'),
(415, 53, 'Olio'),
(416, 53, 'Pingire'),
(417, 54, 'Buhugu'),
(418, 54, 'Bukhulo'),
(419, 54, 'Bumasifwa'),
(420, 54, 'Busulani'),
(421, 54, 'Butandiga'),
(422, 54, 'Buteza'),
(423, 54, 'Buwalasi'),
(424, 54, 'Buyobo'),
(425, 54, 'Sironko Tc'),
(426, 54, 'Zesui'),
(427, 55, 'Arapai'),
(428, 55, 'Asuret'),
(429, 55, 'Eastern Division'),
(430, 55, 'Gweri'),
(431, 55, 'Kamuda'),
(432, 55, 'Katine'),
(433, 55, 'Northern Division'),
(434, 55, 'Soroti'),
(435, 55, 'Tubur'),
(436, 55, 'Western Division'),
(437, 56, 'Eastern Division'),
(438, 56, 'Iyolwa'),
(439, 56, 'Kirewa'),
(440, 56, 'Kisoko'),
(441, 56, 'Kwapa'),
(442, 56, 'Mella'),
(443, 56, 'Merikit'),
(444, 56, 'Molo'),
(445, 56, 'Mukuju'),
(446, 56, 'Mulanda'),
(447, 56, 'Nabuyoga'),
(448, 56, 'Nagongera'),
(449, 56, 'Osukuru'),
(450, 56, 'Paya'),
(451, 56, 'Petta'),
(452, 56, 'Rubongi'),
(453, 56, 'Western Division'),
(454, 57, 'Abim'),
(455, 57, 'Alerek'),
(456, 57, 'Lotukei'),
(457, 57, 'Morulem'),
(458, 57, 'Nyakwae'),
(459, 58, 'Adjumani Tc'),
(460, 58, 'Adropi'),
(461, 58, 'Ciforo'),
(462, 58, 'Dzaipi'),
(463, 58, 'Ofua'),
(464, 58, 'Pakelle'),
(465, 59, 'Adilang'),
(466, 59, 'Agago Tc'),
(467, 59, 'Arum'),
(468, 59, 'Kalongo Tc'),
(469, 59, 'Kotomor'),
(470, 59, 'Lamiyo'),
(471, 59, 'Lapono'),
(472, 59, 'Lira Palwo'),
(473, 59, 'Lukole'),
(474, 59, 'Omiya Pachwa'),
(475, 59, 'Omot'),
(476, 59, 'Paimol'),
(477, 59, 'Parabongo'),
(478, 59, 'Patongo'),
(479, 59, 'Patongo Tc'),
(480, 59, 'Wol'),
(481, 60, 'Abako'),
(482, 60, 'Aloi'),
(483, 60, 'Amugo'),
(484, 60, 'Apala'),
(485, 60, 'Omoro'),
(486, 61, 'Aputi'),
(487, 61, 'Awelo'),
(488, 61, 'Muntu'),
(489, 61, 'Namasale'),
(490, 62, 'Amudat'),
(491, 62, 'Karita'),
(492, 62, 'Loroo'),
(493, 63, 'Amuru'),
(494, 63, 'Atiak'),
(495, 63, 'Lamogi'),
(496, 63, 'Pabbo'),
(497, 64, 'Abongomola'),
(498, 64, 'Aduku'),
(499, 64, 'Akokoro'),
(500, 64, 'Apac'),
(501, 64, 'Apac Tc'),
(502, 64, 'Cegere'),
(503, 64, 'Chawente'),
(504, 64, 'Ibuje'),
(505, 64, 'Inomo'),
(506, 64, 'Nambieso'),
(507, 65, 'Adumi'),
(508, 65, 'Ajia'),
(509, 65, 'Arivu'),
(510, 65, 'Aroi'),
(511, 65, 'Arua Hill'),
(512, 65, 'Dadamu'),
(513, 65, 'Logiri'),
(514, 65, 'Manibe'),
(515, 65, 'Offaka'),
(516, 65, 'Ogoko'),
(517, 65, 'Okollo'),
(518, 65, 'Oli River'),
(519, 65, 'Oluko'),
(520, 65, 'Pajulu'),
(521, 65, 'Rhino Camp'),
(522, 65, 'Rigbo'),
(523, 65, 'Uleppi'),
(524, 65, 'Vurra'),
(525, 66, 'Agwata'),
(526, 66, 'Batta'),
(527, 66, 'Dokolo'),
(528, 66, 'Kangai'),
(529, 66, 'Kwera'),
(530, 67, 'Awach'),
(531, 67, 'Bar-dege'),
(532, 67, 'Bobi'),
(533, 67, 'Bungatira'),
(534, 67, 'Koro'),
(535, 67, 'Lakwana'),
(536, 67, 'Lalogi'),
(537, 67, 'Laroo'),
(538, 67, 'Layibi'),
(539, 67, 'Odek'),
(540, 67, 'Ongako'),
(541, 67, 'Paicho'),
(542, 67, 'Palaro'),
(543, 67, 'Patiko'),
(544, 67, 'Pece'),
(545, 68, 'Kaabong'),
(546, 68, 'Kaabong Tc'),
(547, 68, 'Kalapata'),
(548, 68, 'Kapedo'),
(549, 68, 'Karenga'),
(550, 68, 'Kathile'),
(551, 68, 'Lolelia'),
(552, 68, 'Loyoro'),
(553, 68, 'Sidok'),
(554, 69, 'Kitgum Matidi'),
(555, 69, 'Kitgum Tc'),
(556, 69, 'Labongo Akwang'),
(557, 69, 'Labongo Amida'),
(558, 69, 'Labongo Layamo'),
(559, 69, 'Lagoro'),
(560, 69, 'Mucwini'),
(561, 69, 'Namokora'),
(562, 69, 'Omiya Anyima'),
(563, 69, 'Orom'),
(564, 70, 'Koboko Tc'),
(565, 70, 'Kuluba'),
(566, 70, 'Lobule'),
(567, 70, 'Ludara'),
(568, 70, 'Midia'),
(569, 71, 'Aboke'),
(570, 71, 'Akalo'),
(571, 71, 'Alito'),
(572, 71, 'Ayer'),
(573, 71, 'Bala'),
(574, 72, 'Kacheri'),
(575, 72, 'Kotido'),
(576, 72, 'Kotido Tc'),
(577, 72, 'Nakapelimoru'),
(578, 72, 'Panyangara'),
(579, 72, 'Rengen'),
(580, 73, 'Agoro'),
(581, 73, 'Lokung'),
(582, 73, 'Madi Opei'),
(583, 73, 'Padibe East'),
(584, 73, 'Padibe West'),
(585, 73, 'Palabek Gem'),
(586, 73, 'Palabek Kal'),
(587, 73, 'Palabek Ogili'),
(588, 73, 'Paloga'),
(589, 74, 'Adekokwok'),
(590, 74, 'Adyel'),
(591, 74, 'Amach'),
(592, 74, 'Aromo'),
(593, 74, 'Barr'),
(594, 74, 'Central'),
(595, 74, 'Lira'),
(596, 74, 'Ogur'),
(597, 74, 'Ojwina'),
(598, 74, 'Railway'),
(599, 75, 'Aii-vu'),
(600, 75, 'Beleafe'),
(601, 75, 'Katrini'),
(602, 75, 'Kijomoro'),
(603, 75, 'Nyadri'),
(604, 75, 'Odupi'),
(605, 75, 'Oleba'),
(606, 75, 'Oluffe'),
(607, 75, 'Oluvu'),
(608, 75, 'Omugo'),
(609, 75, 'Tara'),
(610, 75, 'Uriama'),
(611, 75, 'Yivu'),
(612, 76, 'Katikekile'),
(613, 76, 'Nadunget'),
(614, 76, 'Northern Division'),
(615, 76, 'Rupa'),
(616, 76, 'Southern Division'),
(617, 76, 'Tapac'),
(618, 77, 'Aliba'),
(619, 77, 'Dufile'),
(620, 77, 'Gimara'),
(621, 77, 'Itula'),
(622, 77, 'Lefori'),
(623, 77, 'Metu'),
(624, 77, 'Moyo'),
(625, 77, 'Moyo Tc'),
(626, 78, 'Kakomongole'),
(627, 78, 'Lolachat'),
(628, 78, 'Loregae'),
(629, 78, 'Lorengedwat'),
(630, 78, 'Moruita'),
(631, 78, 'Nabilatuk'),
(632, 78, 'Nakapiripirit Tc'),
(633, 78, 'Namalu'),
(634, 79, 'Iriiri'),
(635, 79, 'Lokopo'),
(636, 79, 'Lopei'),
(637, 79, 'Lotome'),
(638, 79, 'Matany'),
(639, 79, 'Ngoleriet'),
(640, 80, 'Akworo'),
(641, 80, 'Erussi'),
(642, 80, 'Kucwiny'),
(643, 80, 'Nebbi'),
(644, 80, 'Nebbi Tc'),
(645, 80, 'Nyaravur'),
(646, 80, 'Pakwach'),
(647, 80, 'Pakwach Tc'),
(648, 80, 'Panyango'),
(649, 80, 'Panyimur'),
(650, 80, 'Parombo'),
(651, 80, 'Wadelai'),
(652, 81, 'Alero'),
(653, 81, 'Anaka'),
(654, 81, 'Koch Goma'),
(655, 81, 'Purongo'),
(656, 82, 'Adwari'),
(657, 82, 'Okwang'),
(658, 82, 'Olilim'),
(659, 82, 'Orum'),
(660, 83, 'Aber'),
(661, 83, 'Acaba'),
(662, 83, 'Iceme'),
(663, 83, 'Loro'),
(664, 83, 'Minakulu'),
(665, 83, 'Ngai'),
(666, 83, 'Otwal'),
(667, 84, 'Acholibur'),
(668, 84, 'Angagura'),
(669, 84, 'Atanga'),
(670, 84, 'Awere'),
(671, 84, 'Kilak'),
(672, 84, 'Laguti'),
(673, 84, 'Lapul'),
(674, 84, 'Latanya'),
(675, 84, 'Ogom'),
(676, 84, 'Pader'),
(677, 84, 'Pader Tc'),
(678, 84, 'Pajule'),
(679, 84, 'Puranga'),
(680, 85, 'Apo'),
(681, 85, 'Drajani'),
(682, 85, 'Kei'),
(683, 85, 'Kuru'),
(684, 85, 'Midigo'),
(685, 85, 'Odravu'),
(686, 85, 'Romogi'),
(687, 85, 'Yumbe Tc'),
(688, 86, 'Atyak'),
(689, 86, 'Jangokoro'),
(690, 86, 'Kango'),
(691, 86, 'Nyapea'),
(692, 86, 'Paidha'),
(693, 86, 'Paidha Tc'),
(694, 86, 'Zeu'),
(695, 88, 'Biiso'),
(696, 88, 'Budongo'),
(697, 88, 'Buliisa'),
(698, 89, 'Bubandi'),
(699, 89, 'Bubukwanga'),
(700, 89, 'Bundibugyo Tc'),
(701, 89, 'Busaru'),
(702, 89, 'Harugali'),
(703, 89, 'Kasitu'),
(704, 89, 'Nduguto'),
(705, 90, 'Bumbaire'),
(706, 90, 'Bushenyi-ishaka Tc'),
(707, 90, 'Kakanju'),
(708, 90, 'Katerera'),
(709, 90, 'Katunguru'),
(710, 90, 'Kichwamba'),
(711, 90, 'Kyabugimbi'),
(712, 90, 'Kyamuhunga'),
(713, 90, 'Kyeizoba'),
(714, 90, 'Nyabubare'),
(715, 90, 'Ryeru'),
(716, 91, 'Bugambe'),
(717, 91, 'Buhanika'),
(718, 91, 'Buhimba'),
(719, 91, 'Buseruka'),
(720, 91, 'Busiisi'),
(721, 91, 'Hoima Tc'),
(722, 91, 'Kabwoya'),
(723, 91, 'Kigorobya'),
(724, 91, 'Kigorobya Tc'),
(725, 91, 'Kitoba'),
(726, 91, 'Kiziranfumbi'),
(727, 91, 'Kyabigambire'),
(728, 91, 'Kyangwali'),
(729, 92, 'Bisheshe'),
(730, 92, 'Ibanda Tc'),
(731, 92, 'Ishongororo'),
(732, 92, 'Kicuzi'),
(733, 92, 'Kikyenkye'),
(734, 92, 'Nyabuhikye'),
(735, 92, 'Nyamarebe'),
(736, 92, 'Rukiri'),
(737, 93, 'Birere'),
(738, 93, 'Endinzi'),
(739, 93, 'Kabingo'),
(740, 93, 'Kabuyanda'),
(741, 93, 'Kashumba'),
(742, 93, 'Kikagate'),
(743, 93, 'Masha'),
(744, 93, 'Ngarama'),
(745, 93, 'Nyakitunda'),
(746, 93, 'Rugaaga'),
(747, 94, 'Bubare'),
(748, 94, 'Bufundi'),
(749, 94, 'Buhara'),
(750, 94, 'Bukinda'),
(751, 94, 'Hamurwa'),
(752, 94, 'Ikumba'),
(753, 94, 'Kabale Central'),
(754, 94, 'Kabale Northern'),
(755, 94, 'Kabale Southern'),
(756, 94, 'Kaharo'),
(757, 94, 'Kamuganguzi'),
(758, 94, 'Kamwezi'),
(759, 94, 'Kashambya'),
(760, 94, 'Kitumba'),
(761, 94, 'Kyanamira'),
(762, 94, 'Maziba'),
(763, 94, 'Muko'),
(764, 95, 'Buheesi'),
(765, 95, 'Bukuku'),
(766, 95, 'Busoro'),
(767, 95, 'Eastern'),
(768, 95, 'Hakibaale'),
(769, 95, 'Karambi'),
(770, 95, 'Kibiito'),
(771, 95, 'Kicwamba'),
(772, 95, 'Kisomoro'),
(773, 95, 'Mugusu'),
(774, 95, 'Ruteete'),
(775, 95, 'Rwiimi'),
(776, 95, 'Southern'),
(777, 95, 'Western'),
(778, 96, 'Bwiizi'),
(779, 96, 'Kahunge'),
(780, 96, 'Kamwenge'),
(781, 96, 'Kamwenge Tc'),
(782, 96, 'Kicheche'),
(783, 96, 'Mahyoro'),
(784, 96, 'Nkoma'),
(785, 96, 'Ntara'),
(786, 96, 'Nyabbani'),
(787, 97, 'Kambuga'),
(788, 97, 'Kanungu Tc'),
(789, 97, 'Kanyantorogo'),
(790, 97, 'Kayonza'),
(791, 97, 'Kihiihi'),
(792, 97, 'Kirima'),
(793, 97, 'Mpungu'),
(794, 97, 'Nyamirama'),
(795, 97, 'Rugyeyo'),
(796, 97, 'Rutenga'),
(797, 98, 'Bugoye'),
(798, 98, 'Bwera'),
(799, 98, 'Ihandiro'),
(800, 98, 'Karambi'),
(801, 98, 'Karusandara'),
(802, 98, 'Kasese Tc'),
(803, 98, 'Katwe Kabatoro Tc'),
(804, 98, 'Kilembe'),
(805, 98, 'Kisinga'),
(806, 98, 'Kitholhu'),
(807, 98, 'Kitswamba'),
(808, 98, 'Kyabarungira'),
(809, 98, 'Kyarumba'),
(810, 98, 'Kyondo'),
(811, 98, 'L. Katwe'),
(812, 98, 'Mahango'),
(813, 98, 'Maliba'),
(814, 98, 'Muhokya'),
(815, 98, 'Munkunyu'),
(816, 98, 'Nyakiyumbu'),
(817, 98, 'Rukoki'),
(818, 100, 'Bwamiramira'),
(819, 100, 'Bwanswa'),
(820, 100, 'Bwikara'),
(821, 100, 'Kagadi'),
(822, 100, 'Kakindo'),
(823, 100, 'Kasambya'),
(824, 100, 'Kibaale Tc'),
(825, 100, 'Kiryanga'),
(826, 100, 'Kisiita'),
(827, 100, 'Kyanaisoke'),
(828, 100, 'Kyebando'),
(829, 100, 'Mabaale'),
(830, 101, 'Kigumba'),
(831, 101, 'Kiryandongo'),
(832, 101, 'Masindi Port'),
(833, 101, 'Mutunda'),
(834, 102, 'Bukimbiri'),
(835, 102, 'Busanza'),
(836, 102, 'Chahi'),
(837, 102, 'Kanaba'),
(838, 102, 'Kirundo'),
(839, 102, 'Kisoro Tc'),
(840, 102, 'Muramba'),
(841, 102, 'Murora'),
(842, 102, 'Nyabwishenya'),
(843, 102, 'Nyakabande'),
(844, 102, 'Nyakinama'),
(845, 102, 'Nyarubuye'),
(846, 102, 'Nyarusiza'),
(847, 102, 'Nyundo'),
(848, 103, 'Hapuyo'),
(849, 103, 'Kakabara'),
(850, 103, 'Kasule'),
(851, 103, 'Kyegegwa'),
(852, 103, 'Mpara'),
(853, 104, 'Bufunjo'),
(854, 104, 'Bugaaki'),
(855, 104, 'Butiiti'),
(856, 104, 'Katoke'),
(857, 104, 'Kihuura'),
(858, 104, 'Kyarusozi'),
(859, 104, 'Kyenjojo Tc'),
(860, 104, 'Nyankwanzi'),
(861, 104, 'Nyantungo'),
(862, 105, 'Bwijanga'),
(863, 105, 'Karujubu'),
(864, 105, 'Kimengo'),
(865, 105, 'Masindi Tc'),
(866, 105, 'Miirya'),
(867, 105, 'Nyangahya'),
(868, 105, 'Pakanyi'),
(869, 106, 'Bubaare'),
(870, 106, 'Bugamba'),
(871, 106, 'Bukiro'),
(872, 106, 'Kagongi'),
(873, 106, 'Kakiika'),
(874, 106, 'Kakoba'),
(875, 106, 'Kamukuzi'),
(876, 106, 'Kashare'),
(877, 106, 'Mwizi'),
(878, 106, 'Ndaija'),
(879, 106, 'Nyakayojo'),
(880, 106, 'Nyamitanga'),
(881, 106, 'Rubaya'),
(882, 106, 'Rubindi'),
(883, 106, 'Rugando'),
(884, 107, 'Bitereko'),
(885, 107, 'Kabira'),
(886, 107, 'Kanyabwanga'),
(887, 107, 'Kashenshero'),
(888, 107, 'Kiyanga'),
(889, 107, 'Mitooma'),
(890, 107, 'Mutara'),
(891, 108, 'Kanara'),
(892, 108, 'Karugutu'),
(893, 108, 'Rwebisengo'),
(894, 109, 'Bwongyera'),
(895, 109, 'Ihunga'),
(896, 109, 'Itojo'),
(897, 109, 'Kayonza'),
(898, 109, 'Kibatsi'),
(899, 109, 'Ngoma'),
(900, 109, 'Ntungamo'),
(901, 109, 'Ntungamo Tc'),
(902, 109, 'Nyabihoko'),
(903, 109, 'Nyakyera'),
(904, 109, 'Rubaare'),
(905, 109, 'Rugarama'),
(906, 109, 'Ruhaama'),
(907, 109, 'Rukoni'),
(908, 109, 'Rweikiniro'),
(909, 111, 'Bugangari'),
(910, 111, 'Buhunga'),
(911, 111, 'Buyanja'),
(912, 111, 'Bwambara'),
(913, 111, 'Kagunga'),
(914, 111, 'Kebisoni'),
(915, 111, 'Nyakagyeme'),
(916, 111, 'Nyakishenyi'),
(917, 111, 'Nyarushanje'),
(918, 111, 'Ruhinda'),
(919, 111, 'Rukungiri Tc'),
(920, 87, 'Bisya'),
(921, 87, 'Buhweju'),
(922, 87, 'Butale'),
(923, 87, 'Kansenene'),
(924, 87, 'Karungu'),
(925, 87, 'Katara'),
(926, 87, 'Kibimba'),
(927, 87, 'Nsika'),
(928, 87, 'Rugongo'),
(929, 87, 'Nyakashaka'),
(930, 87, 'Rukiri'),
(931, 87, 'Rukondo'),
(932, 87, 'Rwengwe'),
(933, 24, 'Nsangi'),
(934, 24, 'Ssisa'),
(935, 24, 'Wakiso Town'),
(936, 24, 'Ssabagabo-makindye'),
(937, 24, 'Entebbe Municipality'),
(938, 24, 'Nansana Town'),
(944, 113, 'Jonam'),
(945, 99, 'Bwamiramira'),
(946, 99, 'Bwanswa'),
(947, 99, 'Bwikara'),
(948, 99, 'Kagadi'),
(949, 99, 'Kakindo'),
(950, 99, 'Kasambya'),
(951, 99, 'Kibaale Tc'),
(952, 99, 'Kiryanga'),
(953, 99, 'Kisiita'),
(954, 99, 'Kyanaisoke'),
(955, 99, 'Kyebando'),
(956, 99, 'Mabaale'),
(957, 99, 'Matale'),
(958, 99, 'Mpeefu'),
(959, 99, 'Mugarama'),
(960, 99, 'Muhoro'),
(961, 99, 'Nalweyo'),
(962, 99, 'Nkooko'),
(963, 99, 'Rugashari'),
(964, 119, 'Kyotera Municipality'),
(965, 119, 'Kalisizo');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_municipality_subcounties`
--

CREATE TABLE `apvr_municipality_subcounties` (
  `subCountyID` int(11) NOT NULL,
  `districtID` int(11) NOT NULL,
  `municipalitityID` int(11) NOT NULL,
  `subcountyName` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_municipality_subcounties`
--

INSERT INTO `apvr_municipality_subcounties` (`subCountyID`, `districtID`, `municipalitityID`, `subcountyName`) VALUES
(1, 57, 1, 'Atunga'),
(2, 57, 1, 'Kiru'),
(3, 57, 1, 'Kalakala'),
(4, 57, 1, 'Wiawer'),
(5, 57, 1, 'Kanu'),
(6, 57, 2, 'Loyoroit'),
(7, 57, 2, 'Kem'),
(8, 57, 2, 'Abim'),
(9, 57, 2, 'Kiru'),
(10, 57, 2, 'Adilang'),
(11, 57, 2, 'Lokapel'),
(12, 57, 2, 'Lolito'),
(13, 57, 2, 'Orwamuge'),
(14, 57, 2, 'Adea'),
(15, 57, 3, 'Achangali'),
(16, 57, 3, 'Awach'),
(17, 57, 3, 'Oporoth'),
(18, 57, 4, 'Adea'),
(19, 57, 4, 'Angolebwal'),
(20, 57, 4, 'Aremo'),
(21, 57, 4, 'Katabok'),
(22, 57, 5, 'Opopongo'),
(23, 57, 5, 'Oreta'),
(24, 57, 5, 'Pupukamuya'),
(25, 57, 5, 'Rogom'),
(26, 58, 6, 'Biyaya'),
(27, 58, 6, 'Central'),
(28, 58, 6, 'Cesia'),
(29, 58, 7, 'Esia'),
(30, 58, 7, 'Jihwa'),
(31, 58, 7, 'Lajopi'),
(32, 58, 7, 'Marindi'),
(33, 58, 7, 'Omi'),
(34, 58, 7, 'Openzinzi'),
(35, 58, 8, 'Gulinya'),
(36, 58, 8, 'Kiraba'),
(37, 58, 8, 'Loa'),
(38, 58, 8, 'Maaji'),
(39, 58, 8, 'Mugi'),
(40, 58, 8, 'Okangali'),
(41, 58, 8, 'Opejo'),
(42, 58, 9, 'Ajugopi'),
(43, 58, 9, 'Arinyapi'),
(44, 58, 9, 'Elegu'),
(45, 58, 9, 'Liri'),
(46, 58, 9, 'Logoangwa'),
(47, 58, 9, 'Mgbwere'),
(48, 58, 9, 'Miniki'),
(49, 58, 10, 'Bacere'),
(50, 58, 10, 'Itirikwa'),
(51, 58, 10, 'Odu'),
(52, 58, 10, 'Subbe'),
(53, 58, 10, 'Tianyu'),
(54, 58, 10, 'Zoka'),
(55, 58, 10, 'Ataboo Central'),
(56, 58, 10, 'Boroli'),
(57, 58, 10, 'Fuda'),
(58, 58, 10, 'Lewa'),
(59, 58, 10, 'Meliaderi'),
(60, 58, 10, 'Pereci'),
(61, 58, 10, 'Zoka Fr'),
(62, 57, 1, 'Kyotera Municipality');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_notifications`
--

CREATE TABLE `apvr_notifications` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `recAffiliated_id` int(255) NOT NULL,
  `fileAttachment` varchar(255) NOT NULL,
  `created` varchar(50) NOT NULL,
  `status` enum('Submitted','Pending','Approved','Rejected','Scheduled for Review') NOT NULL DEFAULT 'Pending',
  `assignedto` enum('Not Assigned','Assigned') NOT NULL DEFAULT 'Not Assigned',
  `period` int(11) NOT NULL,
  `end_of_project` varchar(50) NOT NULL,
  `ammendType` enum('online','manual') NOT NULL DEFAULT 'online',
  `public_title` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_notifications_attachments`
--

CREATE TABLE `apvr_notifications_attachments` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `recAffiliated_id` int(255) NOT NULL,
  `fileAttachment` varchar(255) NOT NULL,
  `created` varchar(50) NOT NULL,
  `notification_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_other_objectives`
--

CREATE TABLE `apvr_other_objectives` (
  `id` int(11) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `objective` text NOT NULL,
  `created` varchar(50) NOT NULL DEFAULT '',
  `objectivetype` enum('Main Objective','Specific Objective') NOT NULL DEFAULT 'Specific Objective'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_other_objectives`
--

INSERT INTO `apvr_other_objectives` (`id`, `owner_id`, `protocol_id`, `objective`, `created`, `objectivetype`) VALUES
(15773, 6793, 4104, 'Specific Objective 9th March 2022-3', '2022-06-11 15:31:36', 'Main Objective');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_protocol`
--

CREATE TABLE `apvr_protocol` (
  `id` int(255) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `main_submission_id` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meeting_id` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `monitoring_action_id` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `migrated_id` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `reject_reason` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `committee_screening` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `opinion_required` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_informed` datetime DEFAULT NULL,
  `updated_in` datetime DEFAULT NULL,
  `revised_in` datetime DEFAULT NULL,
  `decision_in` datetime DEFAULT NULL,
  `monitoring_action_next_date` datetime DEFAULT NULL,
  `period` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `recAffiliated_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `end_of_project` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `changeofreview` enum('No','Yes','appeal') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'appeal',
  `reasonsforappeal` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `attachacadimcpaper` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `antiplagiarism` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Comments_at_Completion` enum('No','Yes') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `Date_Comments_sent_to_Researcher` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `protocol_review_date` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `worked_on` enum('No','Yes') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `comments_response_date` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `apvr_protocol`
--

INSERT INTO `apvr_protocol` (`id`, `owner_id`, `main_submission_id`, `meeting_id`, `monitoring_action_id`, `created`, `updated`, `migrated_id`, `code`, `status`, `reject_reason`, `committee_screening`, `opinion_required`, `date_informed`, `updated_in`, `revised_in`, `decision_in`, `monitoring_action_next_date`, `period`, `recAffiliated_id`, `end_of_project`, `changeofreview`, `reasonsforappeal`, `attachacadimcpaper`, `antiplagiarism`, `Comments_at_Completion`, `Date_Comments_sent_to_Researcher`, `protocol_review_date`, `worked_on`, `comments_response_date`) VALUES
(4104, 6793, '4104', '', 'Approved', '2022-06-11 15:26:17', '2022-06-11 15:39:23', '', 'UNCST-2022-150', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2022-06-11 15:56:59', '2022-06-11 15:58:09', '0000-00-00 00:00:00', '', '24', '11/06/2023', 'appeal', NULL, '', '', 'Yes', NULL, '2022-06-11 15:56:59', 'No', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `apvr_protocol_archive`
--

CREATE TABLE `apvr_protocol_archive` (
  `id` int(255) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `main_submission_id` int(11) DEFAULT NULL,
  `meeting_id` int(11) DEFAULT NULL,
  `monitoring_action_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `migrated_id` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `reject_reason` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `committee_screening` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `opinion_required` int(11) DEFAULT NULL,
  `date_informed` datetime DEFAULT NULL,
  `updated_in` datetime DEFAULT NULL,
  `revised_in` datetime DEFAULT NULL,
  `decision_in` datetime DEFAULT NULL,
  `monitoring_action_next_date` datetime DEFAULT NULL,
  `period` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `recAffiliated_id` int(11) NOT NULL,
  `end_of_project` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `changeofreview` enum('No','Yes','appeal') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'appeal',
  `reasonsforappeal` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_protocol_comment`
--

CREATE TABLE `apvr_protocol_comment` (
  `id` int(11) NOT NULL,
  `protocol_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `is_confidential` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_protocol_comment_rec`
--

CREATE TABLE `apvr_protocol_comment_rec` (
  `id` int(11) NOT NULL,
  `protocol_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `is_confidential` tinyint(1) NOT NULL,
  `reviewer_id` int(255) NOT NULL,
  `recAffiliated_id` int(11) NOT NULL,
  `recstatus` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_protocol_history`
--

CREATE TABLE `apvr_protocol_history` (
  `id` int(11) NOT NULL,
  `protocol_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_protocol_revision`
--

CREATE TABLE `apvr_protocol_revision` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `protocol_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `answered` tinyint(1) NOT NULL,
  `is_final_revision` tinyint(1) NOT NULL,
  `decision` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `social_value` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `sscientific_validity` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `fair_participant_selection` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `favorable_balance` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `informed_consent` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `respect_for_participants` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_comments` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `suggestions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_publications`
--

CREATE TABLE `apvr_publications` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `title` text NOT NULL,
  `citation` text NOT NULL,
  `created` varchar(50) NOT NULL,
  `teamMemberID` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_renewals`
--

CREATE TABLE `apvr_renewals` (
  `id` int(255) NOT NULL,
  `protocol_id` int(11) DEFAULT NULL,
  `recAffiliated_id` int(255) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `Briefrationale` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `GeneralResearchObjective` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `StudyMethods` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_sent` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `Approvedsamplesize_Number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Approvedsamplesize_Remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `Screened_Number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Screened_Remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `Enrolled_Number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Enrolled_Remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `Withdrawn_Number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Withdrawn_Remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `Terminated_Number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Terminated_Remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `Losttofollowup_Number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Losttofollowup_Remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `Died_Number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Died_Remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `ApprovedSampleSizeSpecimens_Number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ApprovedSampleSizeSpecimens_Remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `SamplesAnalyzed_Number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `SamplesAnalyzed_Remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `WithdrawnConsent_Number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `WithdrawnConsent_Remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Pending','Approved','rejected','fowarded','new','Scheduled for Review','submitted','Conditional Approval','Resubmit') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `paymentProof` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_of_payment` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `paymentStatus` enum('Not Paid','Paid','Not Confirmed','Review Pending Payment','Payment Waiver') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Not Paid',
  `assignedto` enum('Not Assigned','Assigned') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Not Assigned',
  `period` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `end_of_project` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `conflictofInterest` enum('yes','no','none') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'none',
  `conflictReason` text COLLATE utf8_unicode_ci NOT NULL,
  `ammendType` enum('online','manual') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'online',
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `public_title` text COLLATE utf8_unicode_ci NOT NULL,
  `CompletenessCheck` enum('Approved','Rejected','Pending') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `refNo` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_renewals_attachments`
--

CREATE TABLE `apvr_renewals_attachments` (
  `id` int(255) NOT NULL,
  `renewal_id` int(255) NOT NULL,
  `recAffiliated_id` int(11) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `attachment_file` text NOT NULL,
  `attachment_date` varchar(50) NOT NULL,
  `othername` varchar(255) NOT NULL,
  `includedon_approval` enum('No','Yes') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_renewals_literature`
--

CREATE TABLE `apvr_renewals_literature` (
  `id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `annual_id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `BriefDescription` text NOT NULL,
  `Implicationonresearch` text NOT NULL,
  `updatedon` datetime NOT NULL,
  `is_sent` int(11) NOT NULL,
  `ammendType` enum('online','manual') NOT NULL DEFAULT 'online',
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_renewals_summary`
--

CREATE TABLE `apvr_renewals_summary` (
  `id` int(255) NOT NULL,
  `protocol_id` int(255) DEFAULT NULL,
  `annual_id` int(255) NOT NULL,
  `owner_id` int(255) DEFAULT NULL,
  `AdverseEvents` text DEFAULT NULL,
  `summaryProtocolDeviations` text DEFAULT NULL,
  `SummarySiteActivities` text DEFAULT NULL,
  `Challenges` text DEFAULT NULL,
  `is_sent` int(11) NOT NULL,
  `updatedon` datetime DEFAULT NULL,
  `FuturePlans` text NOT NULL,
  `ammendType` enum('online','manual') NOT NULL DEFAULT 'online',
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_research_project_expenditure`
--

CREATE TABLE `apvr_research_project_expenditure` (
  `rstug_expenditure_id` int(255) NOT NULL,
  `rstug_rsch_project_id` int(255) NOT NULL,
  `rstug_user_id` int(255) NOT NULL,
  `rstug_personnel_year1` double NOT NULL,
  `rstug_personnel_year2` double NOT NULL,
  `rstug_personnel_year3` double NOT NULL,
  `rstug_personnel_year4` double NOT NULL,
  `rstug_personnel_year5` double NOT NULL,
  `rstug_personnel_total` double NOT NULL,
  `rstug_travel_year1` double NOT NULL,
  `rstug_travel_year2` double NOT NULL,
  `rstug_travel_year3` double NOT NULL,
  `rstug_travel_year4` double NOT NULL,
  `rstug_travel_year5` double NOT NULL,
  `rstug_travel_total` double NOT NULL,
  `rstug_materials_year1` double NOT NULL,
  `rstug_materials_year2` double NOT NULL,
  `rstug_materials_year3` double NOT NULL,
  `rstug_materials_year4` double NOT NULL,
  `rstug_materials_year5` double NOT NULL,
  `rstug_materials_total` double NOT NULL,
  `rstug_adminstration_year1` double NOT NULL,
  `rstug_adminstration_year2` double NOT NULL,
  `rstug_adminstration_year3` double NOT NULL,
  `rstug_adminstration_year4` double NOT NULL,
  `rstug_adminstration_year5` double NOT NULL,
  `rstug_adminstration_total` double NOT NULL,
  `rstug_results_year1` double NOT NULL,
  `rstug_results_year2` double NOT NULL,
  `rstug_results_year3` double NOT NULL,
  `rstug_results_year4` double NOT NULL,
  `rstug_results_year5` double NOT NULL,
  `rstug_results_total` double NOT NULL,
  `rstug_other_year1` double NOT NULL,
  `rstug_other_year2` double NOT NULL,
  `rstug_other_year3` double NOT NULL,
  `rstug_other_year4` double NOT NULL,
  `rstug_other_year5` double NOT NULL,
  `rstug_other_total` double NOT NULL,
  `rstug_contigency_year1` double NOT NULL,
  `rstug_contigency_year2` double NOT NULL,
  `rstug_contigency_year3` double NOT NULL,
  `rstug_contigency_year4` double NOT NULL,
  `rstug_contigency_year5` double NOT NULL,
  `rstug_contigency_total` double NOT NULL,
  `rstug_reimbursement_year1` double NOT NULL,
  `rstug_reimbursement_year2` double NOT NULL,
  `rstug_reimbursement_year3` double NOT NULL,
  `rstug_reimbursement_year4` double NOT NULL,
  `rstug_reimbursement_year5` double NOT NULL,
  `rstug_reimbursement_total` double NOT NULL,
  `rstug_expd_process_status` enum('Pending','Completed') NOT NULL,
  `projm_status` enum('closed','fapplication') NOT NULL,
  `rstug_ammend` int(11) NOT NULL,
  `rstug_Synched` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_research_project_expenditure`
--

INSERT INTO `apvr_research_project_expenditure` (`rstug_expenditure_id`, `rstug_rsch_project_id`, `rstug_user_id`, `rstug_personnel_year1`, `rstug_personnel_year2`, `rstug_personnel_year3`, `rstug_personnel_year4`, `rstug_personnel_year5`, `rstug_personnel_total`, `rstug_travel_year1`, `rstug_travel_year2`, `rstug_travel_year3`, `rstug_travel_year4`, `rstug_travel_year5`, `rstug_travel_total`, `rstug_materials_year1`, `rstug_materials_year2`, `rstug_materials_year3`, `rstug_materials_year4`, `rstug_materials_year5`, `rstug_materials_total`, `rstug_adminstration_year1`, `rstug_adminstration_year2`, `rstug_adminstration_year3`, `rstug_adminstration_year4`, `rstug_adminstration_year5`, `rstug_adminstration_total`, `rstug_results_year1`, `rstug_results_year2`, `rstug_results_year3`, `rstug_results_year4`, `rstug_results_year5`, `rstug_results_total`, `rstug_other_year1`, `rstug_other_year2`, `rstug_other_year3`, `rstug_other_year4`, `rstug_other_year5`, `rstug_other_total`, `rstug_contigency_year1`, `rstug_contigency_year2`, `rstug_contigency_year3`, `rstug_contigency_year4`, `rstug_contigency_year5`, `rstug_contigency_total`, `rstug_reimbursement_year1`, `rstug_reimbursement_year2`, `rstug_reimbursement_year3`, `rstug_reimbursement_year4`, `rstug_reimbursement_year5`, `rstug_reimbursement_total`, `rstug_expd_process_status`, `projm_status`, `rstug_ammend`, `rstug_Synched`) VALUES
(3258, 4104, 6793, 10, 0, 0, 0, 0, 10, 10, 0, 0, 0, 0, 10, 12, 0, 0, 0, 0, 12, 20, 0, 0, 0, 0, 20, 30, 0, 0, 0, 0, 30, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Completed', 'closed', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `apvr_research_project_expenditure_archive`
--

CREATE TABLE `apvr_research_project_expenditure_archive` (
  `rstug_expenditure_id` int(255) NOT NULL,
  `rstug_rsch_project_id` int(255) NOT NULL,
  `rstug_user_id` int(255) NOT NULL,
  `rstug_personnel_year1` double NOT NULL,
  `rstug_personnel_year2` double NOT NULL,
  `rstug_personnel_year3` double NOT NULL,
  `rstug_personnel_year4` double NOT NULL,
  `rstug_personnel_year5` double NOT NULL,
  `rstug_personnel_total` double NOT NULL,
  `rstug_travel_year1` double NOT NULL,
  `rstug_travel_year2` double NOT NULL,
  `rstug_travel_year3` double NOT NULL,
  `rstug_travel_year4` double NOT NULL,
  `rstug_travel_year5` double NOT NULL,
  `rstug_travel_total` double NOT NULL,
  `rstug_materials_year1` double NOT NULL,
  `rstug_materials_year2` double NOT NULL,
  `rstug_materials_year3` double NOT NULL,
  `rstug_materials_year4` double NOT NULL,
  `rstug_materials_year5` double NOT NULL,
  `rstug_materials_total` double NOT NULL,
  `rstug_adminstration_year1` double NOT NULL,
  `rstug_adminstration_year2` double NOT NULL,
  `rstug_adminstration_year3` double NOT NULL,
  `rstug_adminstration_year4` double NOT NULL,
  `rstug_adminstration_year5` double NOT NULL,
  `rstug_adminstration_total` double NOT NULL,
  `rstug_results_year1` double NOT NULL,
  `rstug_results_year2` double NOT NULL,
  `rstug_results_year3` double NOT NULL,
  `rstug_results_year4` double NOT NULL,
  `rstug_results_year5` double NOT NULL,
  `rstug_results_total` double NOT NULL,
  `rstug_other_year1` double NOT NULL,
  `rstug_other_year2` double NOT NULL,
  `rstug_other_year3` double NOT NULL,
  `rstug_other_year4` double NOT NULL,
  `rstug_other_year5` double NOT NULL,
  `rstug_other_total` double NOT NULL,
  `rstug_contigency_year1` double NOT NULL,
  `rstug_contigency_year2` double NOT NULL,
  `rstug_contigency_year3` double NOT NULL,
  `rstug_contigency_year4` double NOT NULL,
  `rstug_contigency_year5` double NOT NULL,
  `rstug_contigency_total` double NOT NULL,
  `rstug_reimbursement_year1` double NOT NULL,
  `rstug_reimbursement_year2` double NOT NULL,
  `rstug_reimbursement_year3` double NOT NULL,
  `rstug_reimbursement_year4` double NOT NULL,
  `rstug_reimbursement_year5` double NOT NULL,
  `rstug_reimbursement_total` double NOT NULL,
  `rstug_expd_process_status` enum('Pending','Completed') NOT NULL,
  `projm_status` enum('closed','fapplication') NOT NULL,
  `rstug_ammend` int(11) NOT NULL,
  `rstug_Synched` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_research_project_expenditure_local`
--

CREATE TABLE `apvr_research_project_expenditure_local` (
  `rstug_expenditure_id` int(255) NOT NULL,
  `rstug_rsch_project_id` int(255) NOT NULL,
  `rstug_user_id` int(255) NOT NULL,
  `rstug_personnel_year1` double NOT NULL,
  `rstug_personnel_year2` double NOT NULL,
  `rstug_personnel_year3` double NOT NULL,
  `rstug_personnel_year4` double NOT NULL,
  `rstug_personnel_year5` double NOT NULL,
  `rstug_personnel_total` double NOT NULL,
  `rstug_travel_year1` double NOT NULL,
  `rstug_travel_year2` double NOT NULL,
  `rstug_travel_year3` double NOT NULL,
  `rstug_travel_year4` double NOT NULL,
  `rstug_travel_year5` double NOT NULL,
  `rstug_travel_total` double NOT NULL,
  `rstug_materials_year1` double NOT NULL,
  `rstug_materials_year2` double NOT NULL,
  `rstug_materials_year3` double NOT NULL,
  `rstug_materials_year4` double NOT NULL,
  `rstug_materials_year5` double NOT NULL,
  `rstug_materials_total` double NOT NULL,
  `rstug_adminstration_year1` double NOT NULL,
  `rstug_adminstration_year2` double NOT NULL,
  `rstug_adminstration_year3` double NOT NULL,
  `rstug_adminstration_year4` double NOT NULL,
  `rstug_adminstration_year5` double NOT NULL,
  `rstug_adminstration_total` double NOT NULL,
  `rstug_results_year1` double NOT NULL,
  `rstug_results_year2` double NOT NULL,
  `rstug_results_year3` double NOT NULL,
  `rstug_results_year4` double NOT NULL,
  `rstug_results_year5` double NOT NULL,
  `rstug_results_total` double NOT NULL,
  `rstug_other_year1` double NOT NULL,
  `rstug_other_year2` double NOT NULL,
  `rstug_other_year3` double NOT NULL,
  `rstug_other_year4` double NOT NULL,
  `rstug_other_year5` double NOT NULL,
  `rstug_other_total` double NOT NULL,
  `rstug_contigency_year1` double NOT NULL,
  `rstug_contigency_year2` double NOT NULL,
  `rstug_contigency_year3` double NOT NULL,
  `rstug_contigency_year4` double NOT NULL,
  `rstug_contigency_year5` double NOT NULL,
  `rstug_contigency_total` double NOT NULL,
  `rstug_reimbursement_year1` double NOT NULL,
  `rstug_reimbursement_year2` double NOT NULL,
  `rstug_reimbursement_year3` double NOT NULL,
  `rstug_reimbursement_year4` double NOT NULL,
  `rstug_reimbursement_year5` double NOT NULL,
  `rstug_reimbursement_total` double NOT NULL,
  `rstug_expd_process_status` enum('Pending','Completed') NOT NULL,
  `projm_status` enum('closed','fapplication') NOT NULL,
  `rstug_ammend` int(11) NOT NULL,
  `rstug_Synched` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_research_project_expenditure_local`
--

INSERT INTO `apvr_research_project_expenditure_local` (`rstug_expenditure_id`, `rstug_rsch_project_id`, `rstug_user_id`, `rstug_personnel_year1`, `rstug_personnel_year2`, `rstug_personnel_year3`, `rstug_personnel_year4`, `rstug_personnel_year5`, `rstug_personnel_total`, `rstug_travel_year1`, `rstug_travel_year2`, `rstug_travel_year3`, `rstug_travel_year4`, `rstug_travel_year5`, `rstug_travel_total`, `rstug_materials_year1`, `rstug_materials_year2`, `rstug_materials_year3`, `rstug_materials_year4`, `rstug_materials_year5`, `rstug_materials_total`, `rstug_adminstration_year1`, `rstug_adminstration_year2`, `rstug_adminstration_year3`, `rstug_adminstration_year4`, `rstug_adminstration_year5`, `rstug_adminstration_total`, `rstug_results_year1`, `rstug_results_year2`, `rstug_results_year3`, `rstug_results_year4`, `rstug_results_year5`, `rstug_results_total`, `rstug_other_year1`, `rstug_other_year2`, `rstug_other_year3`, `rstug_other_year4`, `rstug_other_year5`, `rstug_other_total`, `rstug_contigency_year1`, `rstug_contigency_year2`, `rstug_contigency_year3`, `rstug_contigency_year4`, `rstug_contigency_year5`, `rstug_contigency_total`, `rstug_reimbursement_year1`, `rstug_reimbursement_year2`, `rstug_reimbursement_year3`, `rstug_reimbursement_year4`, `rstug_reimbursement_year5`, `rstug_reimbursement_total`, `rstug_expd_process_status`, `projm_status`, `rstug_ammend`, `rstug_Synched`) VALUES
(3258, 4104, 6793, 30, 0, 0, 0, 0, 30, 20, 0, 0, 0, 0, 20, 10, 0, 0, 0, 0, 10, 20, 0, 0, 0, 0, 20, 30, 0, 0, 0, 0, 30, 0, 0, 0, 0, 0, 0, 20, 0, 0, 0, 0, 20, 10, 0, 0, 0, 0, 10, 'Completed', 'closed', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `apvr_research_project_expenditure_local_archive`
--

CREATE TABLE `apvr_research_project_expenditure_local_archive` (
  `rstug_expenditure_id` int(255) NOT NULL,
  `rstug_rsch_project_id` int(255) NOT NULL,
  `rstug_user_id` int(255) NOT NULL,
  `rstug_personnel_year1` double NOT NULL,
  `rstug_personnel_year2` double NOT NULL,
  `rstug_personnel_year3` double NOT NULL,
  `rstug_personnel_year4` double NOT NULL,
  `rstug_personnel_year5` double NOT NULL,
  `rstug_personnel_total` double NOT NULL,
  `rstug_travel_year1` double NOT NULL,
  `rstug_travel_year2` double NOT NULL,
  `rstug_travel_year3` double NOT NULL,
  `rstug_travel_year4` double NOT NULL,
  `rstug_travel_year5` double NOT NULL,
  `rstug_travel_total` double NOT NULL,
  `rstug_materials_year1` double NOT NULL,
  `rstug_materials_year2` double NOT NULL,
  `rstug_materials_year3` double NOT NULL,
  `rstug_materials_year4` double NOT NULL,
  `rstug_materials_year5` double NOT NULL,
  `rstug_materials_total` double NOT NULL,
  `rstug_adminstration_year1` double NOT NULL,
  `rstug_adminstration_year2` double NOT NULL,
  `rstug_adminstration_year3` double NOT NULL,
  `rstug_adminstration_year4` double NOT NULL,
  `rstug_adminstration_year5` double NOT NULL,
  `rstug_adminstration_total` double NOT NULL,
  `rstug_results_year1` double NOT NULL,
  `rstug_results_year2` double NOT NULL,
  `rstug_results_year3` double NOT NULL,
  `rstug_results_year4` double NOT NULL,
  `rstug_results_year5` double NOT NULL,
  `rstug_results_total` double NOT NULL,
  `rstug_other_year1` double NOT NULL,
  `rstug_other_year2` double NOT NULL,
  `rstug_other_year3` double NOT NULL,
  `rstug_other_year4` double NOT NULL,
  `rstug_other_year5` double NOT NULL,
  `rstug_other_total` double NOT NULL,
  `rstug_contigency_year1` double NOT NULL,
  `rstug_contigency_year2` double NOT NULL,
  `rstug_contigency_year3` double NOT NULL,
  `rstug_contigency_year4` double NOT NULL,
  `rstug_contigency_year5` double NOT NULL,
  `rstug_contigency_total` double NOT NULL,
  `rstug_reimbursement_year1` double NOT NULL,
  `rstug_reimbursement_year2` double NOT NULL,
  `rstug_reimbursement_year3` double NOT NULL,
  `rstug_reimbursement_year4` double NOT NULL,
  `rstug_reimbursement_year5` double NOT NULL,
  `rstug_reimbursement_total` double NOT NULL,
  `rstug_expd_process_status` enum('Pending','Completed') NOT NULL,
  `projm_status` enum('closed','fapplication') NOT NULL,
  `rstug_ammend` int(11) NOT NULL,
  `rstug_Synched` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_reviewers`
--

CREATE TABLE `apvr_reviewers` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `reviewer_id` int(255) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_saes`
--

CREATE TABLE `apvr_saes` (
  `id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `recAffiliated_id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `date_of_birth` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `ArticleBeignStudied` varchar(255) NOT NULL,
  `OnSetDate` varchar(50) NOT NULL,
  `ArticleParticipantReceived` longtext NOT NULL,
  `RouteOfAdministration` longtext NOT NULL,
  `EventResultedin` varchar(255) NOT NULL,
  `CauseOfDeath` varchar(255) NOT NULL,
  `DateOfAdmission` varchar(50) NOT NULL,
  `DescripitionOfTheEvent` longtext NOT NULL,
  `TreatmentOfEvent` longtext NOT NULL,
  `ConcomitantMedicalProblems` text NOT NULL,
  `EventRelatedToStudy` varchar(255) NOT NULL,
  `EventAbateAfterStopping` varchar(5) NOT NULL,
  `EventOutCome` text NOT NULL,
  `CorrectiveActionUndertaken` longtext NOT NULL,
  `AttachEvienceofcorrective` varchar(255) NOT NULL,
  `datesubmitted` varchar(20) NOT NULL,
  `status` enum('Pending','Approved','Rejected','Fowarded','Scheduled for Review','Submitted') NOT NULL DEFAULT 'Pending',
  `assignedto` enum('Not Assigned','Assigned') NOT NULL DEFAULT 'Not Assigned',
  `ammendType` enum('online','manual') NOT NULL DEFAULT 'online',
  `code` varchar(255) NOT NULL,
  `public_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_saes_measures_mitigate_dev`
--

CREATE TABLE `apvr_saes_measures_mitigate_dev` (
  `id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `sae_id` int(255) NOT NULL,
  `Measurestomitigatedeviation` text NOT NULL,
  `created` varchar(50) NOT NULL,
  `renewal_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_saes_measures_mitigate_dev_b`
--

CREATE TABLE `apvr_saes_measures_mitigate_dev_b` (
  `id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `sae_id` int(255) NOT NULL,
  `Measurestomitigatedeviation` text NOT NULL,
  `created` varchar(50) NOT NULL,
  `renewal_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_study_approvals`
--

CREATE TABLE `apvr_study_approvals` (
  `id` int(255) NOT NULL,
  `rstug_user_id` int(255) NOT NULL,
  `rstug_rsch_project_id` int(255) NOT NULL,
  `refNo` varchar(150) NOT NULL,
  `approvalMain` text NOT NULL,
  `approvalText1` longtext NOT NULL,
  `approvalText2` longtext NOT NULL,
  `approvalText3` text NOT NULL,
  `dateupdated` varchar(50) NOT NULL,
  `rmd_id` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `totaldocs` int(11) NOT NULL,
  `DateApproved` varchar(80) NOT NULL,
  `studyTools` text NOT NULL,
  `whosigns` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_study_approvals_copy`
--

CREATE TABLE `apvr_study_approvals_copy` (
  `id` int(255) NOT NULL,
  `rstug_user_id` int(255) NOT NULL,
  `rstug_rsch_project_id` int(255) NOT NULL,
  `refNo` varchar(150) NOT NULL,
  `approvalMain` text NOT NULL,
  `approvalText1` longtext NOT NULL,
  `approvalText2` longtext NOT NULL,
  `approvalText3` text NOT NULL,
  `dateupdated` varchar(50) NOT NULL,
  `rmd_id` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `totaldocs` int(11) NOT NULL,
  `DateApproved` varchar(80) NOT NULL,
  `studyTools` text NOT NULL,
  `whosigns` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_study_approvals_copy2`
--

CREATE TABLE `apvr_study_approvals_copy2` (
  `id` int(255) NOT NULL,
  `rstug_user_id` int(255) NOT NULL,
  `rstug_rsch_project_id` int(255) NOT NULL,
  `refNo` varchar(150) NOT NULL,
  `approvalMain` text NOT NULL,
  `approvalText1` longtext NOT NULL,
  `approvalText2` longtext NOT NULL,
  `approvalText3` text NOT NULL,
  `dateupdated` varchar(50) NOT NULL,
  `rmd_id` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `totaldocs` int(11) NOT NULL,
  `DateApproved` varchar(80) NOT NULL,
  `studyTools` text NOT NULL,
  `whosigns` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_study_description_age`
--

CREATE TABLE `apvr_study_description_age` (
  `id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `MinimumAge` int(11) NOT NULL,
  `MaximumAge` int(11) NOT NULL,
  `Duration` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `is_sent` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_study_population`
--

CREATE TABLE `apvr_study_population` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `ProposedInclusionCriteria` varchar(30) NOT NULL,
  `VulnerableGroups` varchar(150) NOT NULL,
  `VulnerableGroupsOther` varchar(255) NOT NULL,
  `TypeofStudy` varchar(150) NOT NULL,
  `TypeofStudyOther` varchar(255) NOT NULL,
  `ConsentProcess` varchar(100) NOT NULL,
  `ConsentProcessOther` varchar(100) NOT NULL,
  `ProposedSamplesize` varchar(100) NOT NULL,
  `Readinglevel` varchar(100) NOT NULL,
  `updatedon` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `getValunalableGroups` varchar(150) NOT NULL,
  `getTypeofStudy` varchar(150) NOT NULL,
  `getConsentProcess` varchar(150) NOT NULL,
  `getReadingLevel` varchar(150) NOT NULL,
  `CommunityEngagementplan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_study_population`
--

INSERT INTO `apvr_study_population` (`id`, `owner_id`, `protocol_id`, `ProposedInclusionCriteria`, `VulnerableGroups`, `VulnerableGroupsOther`, `TypeofStudy`, `TypeofStudyOther`, `ConsentProcess`, `ConsentProcessOther`, `ProposedSamplesize`, `Readinglevel`, `updatedon`, `status`, `getValunalableGroups`, `getTypeofStudy`, `getConsentProcess`, `getReadingLevel`, `CommunityEngagementplan`) VALUES
(4067, 6793, 4104, '', 'Foetuses.Prisoners.Other.', '', 'Cross-sectional/Survey.', '', 'Written.', '', '', 'Primary', '2022-06-11', 'completed', 'Other IDDI', '', '', '', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_study_population_archive`
--

CREATE TABLE `apvr_study_population_archive` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `ProposedInclusionCriteria` varchar(30) NOT NULL,
  `VulnerableGroups` varchar(150) NOT NULL,
  `VulnerableGroupsOther` varchar(255) NOT NULL,
  `TypeofStudy` varchar(150) NOT NULL,
  `TypeofStudyOther` varchar(255) NOT NULL,
  `ConsentProcess` varchar(100) NOT NULL,
  `ConsentProcessOther` varchar(100) NOT NULL,
  `ProposedSamplesize` varchar(100) NOT NULL,
  `Readinglevel` varchar(100) NOT NULL,
  `updatedon` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `getValunalableGroups` varchar(150) NOT NULL,
  `getTypeofStudy` varchar(150) NOT NULL,
  `getConsentProcess` varchar(150) NOT NULL,
  `getReadingLevel` varchar(150) NOT NULL,
  `CommunityEngagementplan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_study_post_approvals`
--

CREATE TABLE `apvr_study_post_approvals` (
  `id` int(255) NOT NULL,
  `rstug_user_id` int(255) NOT NULL,
  `rstug_rsch_project_id` int(255) NOT NULL,
  `refNo` varchar(150) NOT NULL,
  `approvalMain` text NOT NULL,
  `approvalText1` longtext NOT NULL,
  `approvalText2` longtext NOT NULL,
  `approvalText3` text NOT NULL,
  `dateupdated` varchar(50) NOT NULL,
  `rmd_id` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `totaldocs` int(11) NOT NULL,
  `DateApproved` varchar(80) NOT NULL,
  `studyTools` text NOT NULL,
  `whosigns` int(11) NOT NULL,
  `renewal_id` int(255) NOT NULL,
  `public_title` text NOT NULL,
  `recAffiliated_id` int(11) NOT NULL,
  `ptype` enum('AnnualRenewal','Amendments','SAEs','Deviations','Notifications','CloseOutReport') NOT NULL,
  `comment_text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_study_post_approvals_copy`
--

CREATE TABLE `apvr_study_post_approvals_copy` (
  `id` int(255) NOT NULL,
  `rstug_user_id` int(255) NOT NULL,
  `rstug_rsch_project_id` int(255) NOT NULL,
  `refNo` varchar(150) NOT NULL,
  `approvalMain` text NOT NULL,
  `approvalText1` longtext NOT NULL,
  `approvalText2` longtext NOT NULL,
  `approvalText3` text NOT NULL,
  `dateupdated` varchar(50) NOT NULL,
  `rmd_id` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `totaldocs` int(11) NOT NULL,
  `DateApproved` varchar(80) NOT NULL,
  `studyTools` text NOT NULL,
  `whosigns` int(11) NOT NULL,
  `renewal_id` int(255) NOT NULL,
  `public_title` text NOT NULL,
  `recAffiliated_id` int(11) NOT NULL,
  `ptype` enum('AnnualRenewal','Amendments','SAEs','Deviations','Notifications','CloseOutReport') NOT NULL,
  `comment_text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_submission`
--

CREATE TABLE `apvr_submission` (
  `id` int(255) NOT NULL,
  `protocol_id` int(11) DEFAULT NULL,
  `original_submission_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `recruitment_status_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_translation` tinyint(1) NOT NULL,
  `number` int(11) NOT NULL,
  `public_title` text COLLATE utf8_unicode_ci NOT NULL,
  `scientific_title` varchar(510) COLLATE utf8_unicode_ci NOT NULL,
  `title_acronym` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_clinical_trial` tinyint(1) NOT NULL,
  `is_sent` tinyint(1) NOT NULL,
  `abstract` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `justification` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `goals` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `study_design` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `health_condition` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `sample_size` int(11) DEFAULT NULL,
  `minimum_age` int(11) DEFAULT NULL,
  `maximum_age` int(11) DEFAULT NULL,
  `recruitment_init_date` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `general_procedures` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `analysis_plan` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `ethical_considerations` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `clinical_trial_secondary` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `funding_source` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `primary_sponsor` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_sponsor` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `bibliography` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `sscientific_contact` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `prior_ethical_approval` tinyint(1) DEFAULT NULL,
  `clinical_trial_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `approvaletter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Draft',
  `recAffiliated_id` int(11) NOT NULL,
  `type_of_review` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `protocol_academic_type` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `protocol_academic` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PACTR_number` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `involve_Human_participants` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `drug_related_clinical_trial` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `independentstudy` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `independentstudy_refNo` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `institutionCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `recstatus` enum('Pending','reviewed','Approved','Rejected') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `assignedto` enum('Assigned','Not Assigned') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Not Assigned',
  `totalReviers` int(11) NOT NULL,
  `meeting_status` enum('Pending','Meeting Scheduled','Completed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `paymentStatus` enum('Not Paid','Paid','Not Confirmed','Review Pending Payment','Payment Waiver') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Not Paid',
  `paymentProof` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `minimum_age_period` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `maximum_age_period` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Employer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EstimatedRecruitmentDate` date NOT NULL,
  `steps` int(11) NOT NULL,
  `type_of_payment` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payments_comment` text COLLATE utf8_unicode_ci NOT NULL,
  `objective_1` text COLLATE utf8_unicode_ci NOT NULL,
  `objective_2` longtext COLLATE utf8_unicode_ci NOT NULL,
  `PrimarySponsorCountry` int(11) NOT NULL,
  `PrimarySponsorInstitution` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SecondarySponsorCountry` int(11) NOT NULL,
  `SecondarySponsorInstitution` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `review_category` enum('Initial Review','Continuing Review') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Initial Review',
  `riskLevel` enum('No Greater than Minimal Risk','Minor Increase over Minimal Risk','Moderate Risk','High Risk') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Moderate Risk',
  `reviewer_id` int(255) NOT NULL,
  `invoiceName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shtname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `end_of_project` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `CompletenessCheck` enum('Approved','Rejected','Pending') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `changeofreview` enum('No','Yes','appeal') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `duplicates` enum('No','Yes') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `reasonsforhalting` text COLLATE utf8_unicode_ci NOT NULL,
  `appealHalting` text COLLATE utf8_unicode_ci NOT NULL,
  `appeals` enum('No','Yes') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `end_of_project2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rstug_Synched` enum('No','Yes') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `recmd_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DaysToExpiry` int(11) NOT NULL,
  `newresubmission` int(11) NOT NULL,
  `worked_on` enum('No','Yes') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `apvr_submission`
--

INSERT INTO `apvr_submission` (`id`, `protocol_id`, `original_submission_id`, `owner_id`, `gender_id`, `recruitment_status_id`, `created`, `updated`, `language`, `is_translation`, `number`, `public_title`, `scientific_title`, `title_acronym`, `is_clinical_trial`, `is_sent`, `abstract`, `keywords`, `introduction`, `justification`, `goals`, `study_design`, `health_condition`, `sample_size`, `minimum_age`, `maximum_age`, `recruitment_init_date`, `general_procedures`, `analysis_plan`, `ethical_considerations`, `clinical_trial_secondary`, `funding_source`, `primary_sponsor`, `secondary_sponsor`, `bibliography`, `sscientific_contact`, `prior_ethical_approval`, `clinical_trial_type`, `approvaletter`, `status`, `recAffiliated_id`, `type_of_review`, `protocol_academic_type`, `protocol_academic`, `PACTR_number`, `involve_Human_participants`, `drug_related_clinical_trial`, `independentstudy`, `independentstudy_refNo`, `institutionCode`, `recstatus`, `assignedto`, `totalReviers`, `meeting_status`, `paymentStatus`, `paymentProof`, `minimum_age_period`, `maximum_age_period`, `Employer`, `Position`, `EstimatedRecruitmentDate`, `steps`, `type_of_payment`, `payments_comment`, `objective_1`, `objective_2`, `PrimarySponsorCountry`, `PrimarySponsorInstitution`, `SecondarySponsorCountry`, `SecondarySponsorInstitution`, `review_category`, `riskLevel`, `reviewer_id`, `invoiceName`, `code`, `shtname`, `end_of_project`, `CompletenessCheck`, `changeofreview`, `duplicates`, `reasonsforhalting`, `appealHalting`, `appeals`, `end_of_project2`, `rstug_Synched`, `recmd_id`, `DaysToExpiry`, `newresubmission`, `worked_on`) VALUES
(4104, 4104, 0, 6793, 0, 0, '2022-06-11 15:26:18', '2022-06-11 15:39:23', 'en', 1, 1, 'test project', 'test project', '', 1, 1, 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 'Protocol Summary Protocol Summary Protocol Summary Updated', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', '', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', 0, 0, 0, '2022-06', '', '', '', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.', '', 'sasdasbdbasd', '', '', '', 0, '5', '', 'Approved', 24, 'Regular Review', '', 'Non-Academic', '', 'No', 'No', 'No', '', 'No', 'Pending', 'Not Assigned', 0, 'Completed', 'Paid', '6793testmain.pdf', '', '', NULL, NULL, '0000-00-00', 0, 'Cash Deposit', '', '', '', 800, 'basbdasbd', 800, '', 'Initial Review', 'Moderate Risk', 6794, '', '', '', '11/06/2023', 'Approved', 'No', 'No', '', '', 'No', '11/06/2023', 'No', '', 0, 1, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_submission_archive`
--

CREATE TABLE `apvr_submission_archive` (
  `pid` int(255) NOT NULL,
  `id` int(255) NOT NULL,
  `protocol_id` int(11) DEFAULT NULL,
  `original_submission_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `recruitment_status_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_translation` tinyint(1) NOT NULL,
  `number` int(11) NOT NULL,
  `public_title` text COLLATE utf8_unicode_ci NOT NULL,
  `scientific_title` varchar(510) COLLATE utf8_unicode_ci NOT NULL,
  `title_acronym` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_clinical_trial` tinyint(1) NOT NULL,
  `is_sent` tinyint(1) NOT NULL,
  `abstract` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `justification` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `goals` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `study_design` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `health_condition` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `sample_size` int(11) DEFAULT NULL,
  `minimum_age` int(11) DEFAULT NULL,
  `maximum_age` int(11) DEFAULT NULL,
  `recruitment_init_date` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `general_procedures` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `analysis_plan` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `ethical_considerations` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `clinical_trial_secondary` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `funding_source` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `primary_sponsor` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondary_sponsor` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `bibliography` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `sscientific_contact` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `prior_ethical_approval` tinyint(1) DEFAULT NULL,
  `clinical_trial_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `approvaletter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Draft',
  `recAffiliated_id` int(11) NOT NULL,
  `type_of_review` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `protocol_academic_type` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `protocol_academic` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PACTR_number` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `involve_Human_participants` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `drug_related_clinical_trial` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `independentstudy` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `independentstudy_refNo` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `institutionCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `recstatus` enum('Pending','reviewed','Approved','Rejected') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `assignedto` enum('Assigned','Not Assigned') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Not Assigned',
  `totalReviers` int(11) NOT NULL,
  `meeting_status` enum('Pending','Meeting Scheduled','Completed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `paymentStatus` enum('Not Paid','Paid','Not Confirmed','Review Pending Payment','Payment Waiver') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Not Paid',
  `paymentProof` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `minimum_age_period` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `maximum_age_period` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Employer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EstimatedRecruitmentDate` date NOT NULL,
  `steps` int(11) NOT NULL,
  `type_of_payment` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payments_comment` text COLLATE utf8_unicode_ci NOT NULL,
  `objective_1` text COLLATE utf8_unicode_ci NOT NULL,
  `objective_2` longtext COLLATE utf8_unicode_ci NOT NULL,
  `PrimarySponsorCountry` int(11) NOT NULL,
  `PrimarySponsorInstitution` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SecondarySponsorCountry` int(11) NOT NULL,
  `SecondarySponsorInstitution` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `review_category` enum('Initial Review','Continuing Review') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Initial Review',
  `riskLevel` enum('No Greater than Minimal Risk','Minor Increase over Minimal Risk','Moderate Risk','High Risk') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Moderate Risk',
  `reviewer_id` int(255) NOT NULL,
  `invoiceName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shtname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `end_of_project` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `CompletenessCheck` enum('Approved','Rejected','Pending') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `changeofreview` enum('No','Yes','appeal') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `duplicates` enum('No','Yes') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `reasonsforhalting` text COLLATE utf8_unicode_ci NOT NULL,
  `appealHalting` text COLLATE utf8_unicode_ci NOT NULL,
  `appeals` enum('No','Yes') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `end_of_project2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rstug_Synched` enum('No','Yes') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `recmd_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DaysToExpiry` int(11) NOT NULL,
  `date_of_action` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_submission_clinical_trial`
--

CREATE TABLE `apvr_submission_clinical_trial` (
  `id` int(11) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `clinical_trial_name_id` int(11) DEFAULT NULL,
  `submission_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `NewClinicalRegistry` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_submission_clinical_trial_archive`
--

CREATE TABLE `apvr_submission_clinical_trial_archive` (
  `id` int(11) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `clinical_trial_name_id` int(11) DEFAULT NULL,
  `submission_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `NewClinicalRegistry` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_submission_cost`
--

CREATE TABLE `apvr_submission_cost` (
  `id` int(11) NOT NULL,
  `owner_id` int(255) DEFAULT NULL,
  `submission_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_cost` double DEFAULT NULL,
  `total_cost` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_submission_country`
--

CREATE TABLE `apvr_submission_country` (
  `id` int(11) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `district_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `participants` int(11) NOT NULL,
  `Municipality` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SubCounty` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Parish` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Duration` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Durationperiod` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Numberofsamples` text COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `MinimumAge` int(11) NOT NULL,
  `MaximumAge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `apvr_submission_country`
--

INSERT INTO `apvr_submission_country` (`id`, `owner_id`, `submission_id`, `country_id`, `district_id`, `created`, `updated`, `participants`, `Municipality`, `SubCounty`, `Parish`, `Duration`, `Durationperiod`, `Numberofsamples`, `gender`, `MinimumAge`, `MaximumAge`) VALUES
(10226, 6793, 4104, 3, 0, '2022-06-11 15:32:01', '2022-06-11 15:32:01', 109, '', '', '', '10', 'Days', '', '2', 7, 100);

-- --------------------------------------------------------

--
-- Table structure for table `apvr_submission_review_sr`
--

CREATE TABLE `apvr_submission_review_sr` (
  `id` int(11) NOT NULL,
  `asrmApplctID` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `reviewer_id` int(255) NOT NULL,
  `reviewDate` datetime NOT NULL,
  `recstatus` varchar(50) NOT NULL,
  `protocolStage` enum('stage1','stage2','stage3') NOT NULL DEFAULT 'stage1',
  `reviewtype` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `recAffiliated_c` int(255) NOT NULL,
  `reviewFor` enum('protocol','AnnualRenewal','Amendments','SAEs','Deviations','Notifications','CloseOutReport','HaltedAppeal') NOT NULL DEFAULT 'protocol',
  `conflictofInterest` enum('yes','no','none','not') NOT NULL DEFAULT 'none',
  `conflictReason` text NOT NULL,
  `reviewStatus` enum('Pending','Completed') NOT NULL DEFAULT 'Pending',
  `reassigned` enum('No','Yes') NOT NULL DEFAULT 'No',
  `ammendType` enum('online','manual') NOT NULL DEFAULT 'online',
  `renewal_id` int(255) NOT NULL,
  `public_title` text NOT NULL,
  `sent_email` enum('No','Yes') NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_submission_stages`
--

CREATE TABLE `apvr_submission_stages` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `protocol_information` int(11) NOT NULL,
  `protocol_team` int(11) NOT NULL,
  `protocol_details` int(11) NOT NULL,
  `study_description` int(11) NOT NULL,
  `RecruitmentCountries` int(11) NOT NULL,
  `registry` int(11) NOT NULL,
  `budget` int(11) NOT NULL,
  `study_work_plan` int(11) NOT NULL,
  `bibliography` int(11) NOT NULL,
  `filem` int(11) NOT NULL,
  `payments` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `status` enum('new','completed') NOT NULL DEFAULT 'new',
  `study_population` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_submission_stages`
--

INSERT INTO `apvr_submission_stages` (`id`, `owner_id`, `protocol_id`, `protocol_information`, `protocol_team`, `protocol_details`, `study_description`, `RecruitmentCountries`, `registry`, `budget`, `study_work_plan`, `bibliography`, `filem`, `payments`, `dateCreated`, `status`, `study_population`) VALUES
(4238, 6793, 4104, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2022-06-11 15:26:18', 'completed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `apvr_submission_task`
--

CREATE TABLE `apvr_submission_task` (
  `id` int(11) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `init` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `apvr_submission_task`
--

INSERT INTO `apvr_submission_task` (`id`, `owner_id`, `submission_id`, `created`, `updated`, `description`, `init`, `end`) VALUES
(4040, 6793, 4104, '2022-06-11 15:34:12', '2022-06-11 15:34:12', '6793testmain.pdf', '1970-01-01', '1970-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_submission_task_archive`
--

CREATE TABLE `apvr_submission_task_archive` (
  `id` int(11) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `init` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_submission_transfered`
--

CREATE TABLE `apvr_submission_transfered` (
  `id` int(255) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `main_submission_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recAffiliated_id` int(11) NOT NULL,
  `transfered_from` int(255) NOT NULL,
  `transfered_to` int(255) NOT NULL,
  `transfered_by` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_submission_upload`
--

CREATE TABLE `apvr_submission_upload` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `submission_id` int(11) DEFAULT NULL,
  `upload_type_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filepath` varchar(1023) COLLATE utf8_unicode_ci NOT NULL,
  `submission_number` int(11) NOT NULL,
  `is_monitoring_action` tinyint(1) NOT NULL,
  `Version` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Language` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `DateofProposal` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `othername` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `new_old` enum('old','new') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'old',
  `includedon_approval` enum('No','Yes') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `includedon_approvalRenewal` enum('No','Yes') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `apvr_submission_upload`
--

INSERT INTO `apvr_submission_upload` (`id`, `user_id`, `submission_id`, `upload_type_id`, `created`, `updated`, `filename`, `filepath`, `submission_number`, `is_monitoring_action`, `Version`, `Language`, `DateofProposal`, `othername`, `new_old`, `includedon_approval`, `includedon_approvalRenewal`) VALUES
(44192, 6793, 4104, 1, '2022-06-11 15:37:46', '2022-06-11 15:37:46', '6793test2.pdf', '', 0, 0, 'v2', 'English', '2016-01-03', '', 'old', 'Yes', 'No'),
(44193, 6793, 4104, 28, '2022-06-11 15:38:09', '2022-06-11 15:38:09', '6793test1.pdf', '', 0, 0, 'v1', 'English', '2022-01-08', '', 'old', 'Yes', 'No'),
(44194, 6793, 4104, 3, '2022-06-11 15:38:45', '2022-06-11 15:38:45', '6793testmain.pdf', '', 0, 0, 'v2', 'Lunyolo', '2022-02-04', '', 'old', 'Yes', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_submission_upload_archive`
--

CREATE TABLE `apvr_submission_upload_archive` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `submission_id` int(11) DEFAULT NULL,
  `upload_type_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filepath` varchar(1023) COLLATE utf8_unicode_ci NOT NULL,
  `submission_number` int(11) NOT NULL,
  `is_monitoring_action` tinyint(1) NOT NULL,
  `Version` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Language` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `DateofProposal` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `othername` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_submission_user`
--

CREATE TABLE `apvr_submission_user` (
  `submission_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_team`
--

CREATE TABLE `apvr_team` (
  `id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `name` varchar(150) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `countryid` int(11) NOT NULL,
  `project_role` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `rstug_Synched` int(11) NOT NULL,
  `requiredEducation` enum('No','Yes') NOT NULL DEFAULT 'No',
  `requiredEmployment` enum('No','Yes') NOT NULL DEFAULT 'No',
  `requiredPublication` enum('No','Yes') NOT NULL DEFAULT 'No',
  `education` int(11) NOT NULL DEFAULT 0,
  `employment` int(11) NOT NULL DEFAULT 0,
  `publications` int(11) NOT NULL DEFAULT 0,
  `GCPtraining` varchar(255) NOT NULL,
  `Telephone` varchar(100) NOT NULL,
  `qualification` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_team`
--

INSERT INTO `apvr_team` (`id`, `protocol_id`, `owner_id`, `name`, `institution`, `email`, `created`, `countryid`, `project_role`, `status`, `rstug_Synched`, `requiredEducation`, `requiredEmployment`, `requiredPublication`, `education`, `employment`, `publications`, `GCPtraining`, `Telephone`, `qualification`) VALUES
(8644, 4104, 6793, 'Mush Makanga', 'sandansdnasndsa', 'mmawanda@safri.ac.ug', '2022-06-11 15:26:18', 14, 'Principal Investigator', 'completed', 1, 'Yes', 'Yes', 'Yes', 1, 1, 0, '', '666666666666666', 'bbbb');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_team_archive`
--

CREATE TABLE `apvr_team_archive` (
  `id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `name` varchar(150) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `countryid` int(11) NOT NULL,
  `project_role` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `rstug_Synched` int(11) NOT NULL,
  `requiredEducation` enum('No','Yes') NOT NULL DEFAULT 'No',
  `requiredEmployment` enum('No','Yes') NOT NULL DEFAULT 'No',
  `requiredPublication` enum('No','Yes') NOT NULL DEFAULT 'No',
  `education` int(11) NOT NULL DEFAULT 0,
  `employment` int(11) NOT NULL DEFAULT 0,
  `publications` int(11) NOT NULL DEFAULT 0,
  `GCPtraining` varchar(255) NOT NULL,
  `Telephone` varchar(100) NOT NULL,
  `qualification` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_updated_sections`
--

CREATE TABLE `apvr_updated_sections` (
  `id` int(255) NOT NULL,
  `owner_id` int(255) NOT NULL,
  `protocol_id` int(255) NOT NULL,
  `protocol_information` int(11) NOT NULL,
  `protocol_team` int(11) NOT NULL,
  `protocol_details` int(11) NOT NULL,
  `study_description` int(11) NOT NULL,
  `RecruitmentCountries` int(11) NOT NULL,
  `registry` int(11) NOT NULL,
  `budget` int(11) NOT NULL,
  `study_work_plan` int(11) NOT NULL,
  `bibliography` int(11) NOT NULL,
  `attachments` int(11) NOT NULL,
  `payments` int(11) NOT NULL,
  `study_population` int(11) NOT NULL,
  `dateupdated` date NOT NULL,
  `status` enum('pending','submitted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_upload_type`
--

CREATE TABLE `apvr_upload_type` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `apvr_upload_type`
--

INSERT INTO `apvr_upload_type` (`id`, `created`, `updated`, `name`, `slug`, `status`) VALUES
(1, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'Protocol', 'protocol', 1),
(2, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'Site Specific Protocol', 'site-specific-protocol', 1),
(3, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'Informed Consent forms', 'informed-consent-forms', 1),
(11, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'Investigator Brochure', 'investigator-brochure', 1),
(27, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'Case Report Forms', 'case-report-forms', 1),
(28, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'Data collection tools', 'data-collection-tools', 1),
(29, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 'REC forms', 'rec-forms', 1),
(30, '2019-01-16 00:00:00', '2019-01-16 00:00:00', 'Prior Ethical Approval', 'prior-ethical-approval', 1),
(31, '2021-01-04 00:00:00', '2021-01-04 00:00:00', 'Informed Consent Waiver', 'Informed-Consent-Waiver', 1);

-- --------------------------------------------------------

--
-- Table structure for table `apvr_upload_type_extension`
--

CREATE TABLE `apvr_upload_type_extension` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `extension` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_upload_type_upload_type_extension`
--

CREATE TABLE `apvr_upload_type_upload_type_extension` (
  `uploadtype_id` int(11) NOT NULL,
  `uploadtypeextension_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_user`
--

CREATE TABLE `apvr_user` (
  `asrmApplctID` int(11) NOT NULL,
  `country_id` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `institution` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hashcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_access` tinyint(1) NOT NULL,
  `privillage` enum('investigator','secretary','membercommittee','memberadhoc','administrator','recadmin','recreviewer','rechairperson','revicechairperson','superadmin','UHNRO','monitoring','communityrepresentative','recitadmin') COLLATE utf8_unicode_ci NOT NULL,
  `profile` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `recAffiliated_id` int(11) NOT NULL,
  `rstug_md5_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rstug_act_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rstug_first_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rstug_middle_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rstug_surname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rstug_nin_passport` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rstug_title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rstug_placeofbirth` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `rstug_district` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idtype` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `reviewerTitle` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `userConfirmation` enum('new','returning') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'new',
  `userConfirmationLink` text COLLATE utf8_unicode_ci NOT NULL,
  `authorized` enum('No','Yes') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `accessAbstracts` enum('No','Yes') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `signatures` text COLLATE utf8_unicode_ci NOT NULL,
  `authorisedtosign` enum('No','Yes') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No',
  `rstug_oldpassword` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `apvr_user`
--

INSERT INTO `apvr_user` (`asrmApplctID`, `country_id`, `created`, `updated`, `email`, `password`, `username`, `is_active`, `name`, `institution`, `hashcode`, `first_access`, `privillage`, `profile`, `recAffiliated_id`, `rstug_md5_id`, `rstug_act_code`, `rstug_first_name`, `rstug_middle_name`, `rstug_surname`, `rstug_nin_passport`, `rstug_title`, `rstug_placeofbirth`, `rstug_district`, `phone`, `idtype`, `reviewerTitle`, `userConfirmation`, `userConfirmationLink`, `authorized`, `accessAbstracts`, `signatures`, `authorisedtosign`, `rstug_oldpassword`) VALUES
(1, '800', '2019-04-06 00:00:00', '2019-04-06 00:00:00', 'cmwesigwa@gmail.com', '0c5f4df56ced48d10b1070657f54a00c', 'cmwesigwa@@', 1, 'Mwesigwa Collins', 'Uganda National Council for Science and Technology', NULL, 0, 'administrator', '', 24, '', '05fe2a81bc6cd341a5ca02b592603db0', NULL, NULL, NULL, '', '', '', '', '', '', '', 'new', '', 'No', 'No', '', 'Yes', ''),
(6793, '14', '2022-06-11 14:38:47', '2022-06-11 14:38:47', 'mmawanda@safri.ac.ug', '913619e58f80a548bccc6c6a1ce1b1b4', 'mmawanda@safri.ac.ug', 1, 'Mush Makanga', 'sandansdnasndsa', '', 0, 'investigator', 'uncst_Mush285374751_580458943387256_3090167318662993883_n.jpg', 0, 'f5e536083a438cec5b64a4954abc17f1', '9513', 'Mush', '', 'Makanga', '5345545456546', 'Prof.', 'DASFSAFDS', '', '9999009', '', '', 'new', '', 'No', 'No', '', 'No', ''),
(6794, '800', '2022-06-11 15:51:47', '2022-06-11 15:51:47', 'musa@gmail.com', '355d19971672a4b73f7c0e67ffae2892', 'musa6793', 1, 'musa musa', 'musa', '', 0, 'recadmin', '', 24, '', '1629', 'musa', '', 'musa', '', '', '2022-06-11', '', '888888888888888', '', '', 'new', '', 'No', 'No', '', 'No', '');

-- --------------------------------------------------------

--
-- Table structure for table `apvr_user_role`
--

CREATE TABLE `apvr_user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_web_content`
--

CREATE TABLE `apvr_web_content` (
  `id` int(11) NOT NULL,
  `category` enum('about','content_left_top','content_middle_top','content_right_top','content_left_bottom','content_middle_bottom','content_right_bottom') NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `linktext` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `imaged` varchar(255) DEFAULT NULL,
  `summary` longtext DEFAULT NULL,
  `details` longtext DEFAULT NULL,
  `publish` enum('No','Yes') DEFAULT 'Yes',
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_web_content`
--

INSERT INTO `apvr_web_content` (`id`, `category`, `title`, `linktext`, `link`, `icon`, `imaged`, `summary`, `details`, `publish`, `rank`) VALUES
(1, 'about', 'About NRIMS', NULL, NULL, NULL, NULL, '<p>This is an online platform that supports the National Regulatory Agencies; NDA/UNHRO/UNCST and Research Ethics Committees in the regulatory oversight of clinical research to be carried in the country. </p>\r\n\r\n<p>The system provides efficient reviews of research and provides the researcher with an interface with the regulatory agencies in the data capture, data management, data validation, quality control and overall regulatory compliance to clinical research management processes.</p>', 'This is an online platform that supports the National Regulatory Agencies; NDA/UNHRO/UNCST and Research Ethics Committees in the regulatory oversight of clinical research to be carried in the country. The system provides efficient reviews of research and provides the researcher with an interface with the regulatory agencies in the data capture, data management, data validation, quality control and overall regulatory compliance to clinical research management processes', 'Yes', 0),
(2, 'content_left_top', 'Research Ethics Committees (RECs) Approval', NULL, './recapproval', NULL, NULL, 'RECs are established in or by an organization to conduct initial and continuing review of research projects with the primary goal of protecting rights and welfare of research participants. REC approval is sought prior to submission to UNCST.', 'RECs are established in or by an organization to conduct initial and continuing review of research projects with the primary goal of protecting rights and welfare of research participants. REC approval is sought prior to submission to UNCST.', 'Yes', 1),
(3, 'content_middle_top', 'UNCST Research Permit', NULL, './research', NULL, NULL, '<p>All persons intending to carry out research in Uganda shall register their research activities with UNCST and obtain a UNCST research registration permit. UNCST is a one-stop point that registers and, in liaison with the Research Secretariat in the office of the President, clears all research intended to be carried out in Uganda.</p>', '<p>All persons intending to carry out research in Uganda shall register their research activities with UNCST and obtain a UNCST research registration permit. UNCST is a one-stop point that registers and, in liaison with the Research Secretariat in the office of the President, clears all research intended to be carried out in Uganda. in so doing, UNCST registers and issues research registration permits for the purpose of carrying out research in Uganda. The research registration permit is to facilitate conduct of research in the country and covers the entire duration of the research project.</p>\r\n\r\n<p>Additionally, UNCST grants permits for the approval for the shipment of samples for research for future use and analysis to other laboratories abroad.</p>', 'Yes', 1),
(4, 'content_right_top', 'NDA Approval', NULL, NULL, NULL, NULL, '<p>NDA regulates safety, quality, efficacy, handling and use of drugs or drug related products and devices in research. It is the responsibility of each trial sponsor and/or researcher to obtain such authorization certificate for all experimental drugs/devices, irrespective of whether the drug/device has previously been licensed for use in humans or not.</p>', '<p>NDA regulates safety, quality, efficacy, handling and use of drugs or drug related products and devices in research. It is the responsibility of each trial sponsor and/or researcher to obtain such authorization certificate for all experimental drugs/devices, irrespective of whether the drug/device has previously been licensed for use in humans or not. Researchers must file a copy of the NDA certificate authorizing the importation and/or use of the trial drug/device in Uganda with the relevant REC and UNCST. NDA shall also verify the continued use and eventual disposal of unused trial drug/device.</p>', 'Yes', 1),
(5, 'content_left_bottom', 'UNHRO Repository', NULL, NULL, NULL, NULL, '<p>UNHRO was established by act of parliament 2011 with a mandate to provide policy and ethical guidelines, national co-ordination and regulation of all health research in the country. In executing this function, UNHRO collaborates with UNCST to register all research protocols related to health. This registration process is done centrally at UNCST. Currently the institution receives and disseminates research findings and results as the Organisation deems fit.</p>', NULL, 'Yes', 2),
(6, 'content_middle_bottom', 'Office of the president', NULL, NULL, NULL, NULL, 'The office of the president provides security clearances to the study districts for all research to be done in the country. This clearance is done by UNCST on behalf of the researcher.', NULL, 'Yes', 2);

-- --------------------------------------------------------

--
-- Table structure for table `apvr_web_menus`
--

CREATE TABLE `apvr_web_menus` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(100) DEFAULT NULL,
  `menu_link` varchar(255) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_web_menus`
--

INSERT INTO `apvr_web_menus` (`id`, `menu_name`, `menu_link`, `rank`) VALUES
(1, 'Home', '', 1),
(2, 'REC Approval', 'recapproval', 3),
(3, 'Apply for UNCST Research Permit', 'recapproval', 4),
(4, 'NDA Approval', 'recapproval', 5),
(5, 'About the Portal', 'about', 2);

-- --------------------------------------------------------

--
-- Table structure for table `apvr_web_partners`
--

CREATE TABLE `apvr_web_partners` (
  `id` int(11) NOT NULL,
  `partnerName` varchar(255) NOT NULL,
  `partnerLogo` varchar(255) NOT NULL,
  `partnerLink` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apvr_web_slider`
--

CREATE TABLE `apvr_web_slider` (
  `id` int(11) NOT NULL,
  `rimage` varchar(255) NOT NULL,
  `rank` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `btntext` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apvr_web_slider`
--

INSERT INTO `apvr_web_slider` (`id`, `rimage`, `rank`, `title`, `text`, `btntext`, `link`) VALUES
(1, 'main3.jpg', 1, 'National Research Information Management System (NRIMS)', 'REC Approval', 'Apply for REC Approval', './recapproval/'),
(2, 'clintrial_2017.jpg', 2, 'National Research Information Management System (NRIMS)', 'Apply for UNCST Research Permit', 'Get Research Approval', './research/'),
(3, 'main3.jpg', 3, 'National Research Information Management System (NRIMS)', 'NDA Approval', 'Apply Now', '#');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apvr_abstracts`
--
ALTER TABLE `apvr_abstracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_ammendments`
--
ALTER TABLE `apvr_ammendments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_ammendments_documents`
--
ALTER TABLE `apvr_ammendments_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_annual_stages`
--
ALTER TABLE `apvr_annual_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_appeal_halted_studies`
--
ALTER TABLE `apvr_appeal_halted_studies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_attendences`
--
ALTER TABLE `apvr_attendences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_categories`
--
ALTER TABLE `apvr_categories`
  ADD PRIMARY KEY (`rstug_categoryID`);

--
-- Indexes for table `apvr_clinical_study_methodology`
--
ALTER TABLE `apvr_clinical_study_methodology`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_clinical_study_methodology2`
--
ALTER TABLE `apvr_clinical_study_methodology2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_clinical_study_methodology_archive`
--
ALTER TABLE `apvr_clinical_study_methodology_archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_collaborating_institutions`
--
ALTER TABLE `apvr_collaborating_institutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_completeness_check_comments`
--
ALTER TABLE `apvr_completeness_check_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_completeness_check_comments_amendment`
--
ALTER TABLE `apvr_completeness_check_comments_amendment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_configuration`
--
ALTER TABLE `apvr_configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_decision_status`
--
ALTER TABLE `apvr_decision_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_determination_of_risk`
--
ALTER TABLE `apvr_determination_of_risk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_determination_of_risk_archive`
--
ALTER TABLE `apvr_determination_of_risk_archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_deviations`
--
ALTER TABLE `apvr_deviations`
  ADD PRIMARY KEY (`deviationID`);

--
-- Indexes for table `apvr_districts`
--
ALTER TABLE `apvr_districts`
  ADD PRIMARY KEY (`districtm_id`),
  ADD UNIQUE KEY `cidm_country_name` (`districtm_name`);

--
-- Indexes for table `apvr_document`
--
ALTER TABLE `apvr_document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_document_role`
--
ALTER TABLE `apvr_document_role`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `apvr_education_history`
--
ALTER TABLE `apvr_education_history`
  ADD PRIMARY KEY (`rstug_educn_id`);

--
-- Indexes for table `apvr_employment_details`
--
ALTER TABLE `apvr_employment_details`
  ADD PRIMARY KEY (`rstug_employment_id`);

--
-- Indexes for table `apvr_ext_translations`
--
ALTER TABLE `apvr_ext_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_faq`
--
ALTER TABLE `apvr_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_final_reports`
--
ALTER TABLE `apvr_final_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_final_reports_attachments`
--
ALTER TABLE `apvr_final_reports_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_help`
--
ALTER TABLE `apvr_help`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_initial_committee_screening`
--
ALTER TABLE `apvr_initial_committee_screening`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_list_clinical_trial_name`
--
ALTER TABLE `apvr_list_clinical_trial_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_list_country`
--
ALTER TABLE `apvr_list_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_list_districts`
--
ALTER TABLE `apvr_list_districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_list_gender`
--
ALTER TABLE `apvr_list_gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_list_monitoring_action`
--
ALTER TABLE `apvr_list_monitoring_action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_list_recruitment_status`
--
ALTER TABLE `apvr_list_recruitment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_list_rec_affiliated`
--
ALTER TABLE `apvr_list_rec_affiliated`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_list_role`
--
ALTER TABLE `apvr_list_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_meeting`
--
ALTER TABLE `apvr_meeting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_meeting_invitees`
--
ALTER TABLE `apvr_meeting_invitees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_mlogs`
--
ALTER TABLE `apvr_mlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_monitoring_reports`
--
ALTER TABLE `apvr_monitoring_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_municipalities`
--
ALTER TABLE `apvr_municipalities`
  ADD PRIMARY KEY (`municipalitityID`);

--
-- Indexes for table `apvr_municipality_subcounties`
--
ALTER TABLE `apvr_municipality_subcounties`
  ADD PRIMARY KEY (`subCountyID`);

--
-- Indexes for table `apvr_notifications`
--
ALTER TABLE `apvr_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_notifications_attachments`
--
ALTER TABLE `apvr_notifications_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_other_objectives`
--
ALTER TABLE `apvr_other_objectives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_protocol`
--
ALTER TABLE `apvr_protocol`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_protocol_archive`
--
ALTER TABLE `apvr_protocol_archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_protocol_comment`
--
ALTER TABLE `apvr_protocol_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_protocol_comment_rec`
--
ALTER TABLE `apvr_protocol_comment_rec`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_protocol_history`
--
ALTER TABLE `apvr_protocol_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_protocol_revision`
--
ALTER TABLE `apvr_protocol_revision`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_publications`
--
ALTER TABLE `apvr_publications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_renewals`
--
ALTER TABLE `apvr_renewals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_renewals_attachments`
--
ALTER TABLE `apvr_renewals_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_renewals_literature`
--
ALTER TABLE `apvr_renewals_literature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_renewals_summary`
--
ALTER TABLE `apvr_renewals_summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_research_project_expenditure`
--
ALTER TABLE `apvr_research_project_expenditure`
  ADD PRIMARY KEY (`rstug_expenditure_id`);

--
-- Indexes for table `apvr_research_project_expenditure_archive`
--
ALTER TABLE `apvr_research_project_expenditure_archive`
  ADD PRIMARY KEY (`rstug_expenditure_id`);

--
-- Indexes for table `apvr_research_project_expenditure_local`
--
ALTER TABLE `apvr_research_project_expenditure_local`
  ADD PRIMARY KEY (`rstug_expenditure_id`);

--
-- Indexes for table `apvr_research_project_expenditure_local_archive`
--
ALTER TABLE `apvr_research_project_expenditure_local_archive`
  ADD PRIMARY KEY (`rstug_expenditure_id`);

--
-- Indexes for table `apvr_reviewers`
--
ALTER TABLE `apvr_reviewers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_saes`
--
ALTER TABLE `apvr_saes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_saes_measures_mitigate_dev`
--
ALTER TABLE `apvr_saes_measures_mitigate_dev`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_saes_measures_mitigate_dev_b`
--
ALTER TABLE `apvr_saes_measures_mitigate_dev_b`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_study_approvals`
--
ALTER TABLE `apvr_study_approvals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_study_approvals_copy`
--
ALTER TABLE `apvr_study_approvals_copy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_study_approvals_copy2`
--
ALTER TABLE `apvr_study_approvals_copy2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_study_description_age`
--
ALTER TABLE `apvr_study_description_age`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_study_population`
--
ALTER TABLE `apvr_study_population`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_study_population_archive`
--
ALTER TABLE `apvr_study_population_archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_study_post_approvals`
--
ALTER TABLE `apvr_study_post_approvals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_study_post_approvals_copy`
--
ALTER TABLE `apvr_study_post_approvals_copy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_submission`
--
ALTER TABLE `apvr_submission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_submission_archive`
--
ALTER TABLE `apvr_submission_archive`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `apvr_submission_clinical_trial`
--
ALTER TABLE `apvr_submission_clinical_trial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_submission_clinical_trial_archive`
--
ALTER TABLE `apvr_submission_clinical_trial_archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_submission_cost`
--
ALTER TABLE `apvr_submission_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_submission_country`
--
ALTER TABLE `apvr_submission_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_submission_review_sr`
--
ALTER TABLE `apvr_submission_review_sr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_submission_stages`
--
ALTER TABLE `apvr_submission_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_submission_task`
--
ALTER TABLE `apvr_submission_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_submission_task_archive`
--
ALTER TABLE `apvr_submission_task_archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_submission_transfered`
--
ALTER TABLE `apvr_submission_transfered`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_submission_upload`
--
ALTER TABLE `apvr_submission_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_submission_upload_archive`
--
ALTER TABLE `apvr_submission_upload_archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_submission_user`
--
ALTER TABLE `apvr_submission_user`
  ADD PRIMARY KEY (`submission_id`);

--
-- Indexes for table `apvr_team`
--
ALTER TABLE `apvr_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_team_archive`
--
ALTER TABLE `apvr_team_archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_updated_sections`
--
ALTER TABLE `apvr_updated_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_upload_type`
--
ALTER TABLE `apvr_upload_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_upload_type_extension`
--
ALTER TABLE `apvr_upload_type_extension`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_user`
--
ALTER TABLE `apvr_user`
  ADD PRIMARY KEY (`asrmApplctID`);

--
-- Indexes for table `apvr_web_content`
--
ALTER TABLE `apvr_web_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_web_menus`
--
ALTER TABLE `apvr_web_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apvr_web_slider`
--
ALTER TABLE `apvr_web_slider`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apvr_abstracts`
--
ALTER TABLE `apvr_abstracts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `apvr_ammendments`
--
ALTER TABLE `apvr_ammendments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

--
-- AUTO_INCREMENT for table `apvr_ammendments_documents`
--
ALTER TABLE `apvr_ammendments_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2159;

--
-- AUTO_INCREMENT for table `apvr_annual_stages`
--
ALTER TABLE `apvr_annual_stages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `apvr_appeal_halted_studies`
--
ALTER TABLE `apvr_appeal_halted_studies`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `apvr_attendences`
--
ALTER TABLE `apvr_attendences`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `apvr_categories`
--
ALTER TABLE `apvr_categories`
  MODIFY `rstug_categoryID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `apvr_clinical_study_methodology`
--
ALTER TABLE `apvr_clinical_study_methodology`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4121;

--
-- AUTO_INCREMENT for table `apvr_clinical_study_methodology2`
--
ALTER TABLE `apvr_clinical_study_methodology2`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_clinical_study_methodology_archive`
--
ALTER TABLE `apvr_clinical_study_methodology_archive`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2340;

--
-- AUTO_INCREMENT for table `apvr_collaborating_institutions`
--
ALTER TABLE `apvr_collaborating_institutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1024;

--
-- AUTO_INCREMENT for table `apvr_completeness_check_comments`
--
ALTER TABLE `apvr_completeness_check_comments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3489;

--
-- AUTO_INCREMENT for table `apvr_completeness_check_comments_amendment`
--
ALTER TABLE `apvr_completeness_check_comments_amendment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `apvr_configuration`
--
ALTER TABLE `apvr_configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `apvr_decision_status`
--
ALTER TABLE `apvr_decision_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `apvr_determination_of_risk`
--
ALTER TABLE `apvr_determination_of_risk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4067;

--
-- AUTO_INCREMENT for table `apvr_determination_of_risk_archive`
--
ALTER TABLE `apvr_determination_of_risk_archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_deviations`
--
ALTER TABLE `apvr_deviations`
  MODIFY `deviationID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `apvr_districts`
--
ALTER TABLE `apvr_districts`
  MODIFY `districtm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `apvr_document`
--
ALTER TABLE `apvr_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_document_role`
--
ALTER TABLE `apvr_document_role`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_education_history`
--
ALTER TABLE `apvr_education_history`
  MODIFY `rstug_educn_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13111;

--
-- AUTO_INCREMENT for table `apvr_employment_details`
--
ALTER TABLE `apvr_employment_details`
  MODIFY `rstug_employment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8331;

--
-- AUTO_INCREMENT for table `apvr_ext_translations`
--
ALTER TABLE `apvr_ext_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_faq`
--
ALTER TABLE `apvr_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_final_reports`
--
ALTER TABLE `apvr_final_reports`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `apvr_final_reports_attachments`
--
ALTER TABLE `apvr_final_reports_attachments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `apvr_help`
--
ALTER TABLE `apvr_help`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_initial_committee_screening`
--
ALTER TABLE `apvr_initial_committee_screening`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10011;

--
-- AUTO_INCREMENT for table `apvr_list_clinical_trial_name`
--
ALTER TABLE `apvr_list_clinical_trial_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_list_country`
--
ALTER TABLE `apvr_list_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=898;

--
-- AUTO_INCREMENT for table `apvr_list_districts`
--
ALTER TABLE `apvr_list_districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `apvr_list_gender`
--
ALTER TABLE `apvr_list_gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `apvr_list_monitoring_action`
--
ALTER TABLE `apvr_list_monitoring_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_list_recruitment_status`
--
ALTER TABLE `apvr_list_recruitment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_list_rec_affiliated`
--
ALTER TABLE `apvr_list_rec_affiliated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `apvr_list_role`
--
ALTER TABLE `apvr_list_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_meeting`
--
ALTER TABLE `apvr_meeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3578;

--
-- AUTO_INCREMENT for table `apvr_meeting_invitees`
--
ALTER TABLE `apvr_meeting_invitees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_mlogs`
--
ALTER TABLE `apvr_mlogs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122932;

--
-- AUTO_INCREMENT for table `apvr_monitoring_reports`
--
ALTER TABLE `apvr_monitoring_reports`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `apvr_municipalities`
--
ALTER TABLE `apvr_municipalities`
  MODIFY `municipalitityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=966;

--
-- AUTO_INCREMENT for table `apvr_municipality_subcounties`
--
ALTER TABLE `apvr_municipality_subcounties`
  MODIFY `subCountyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `apvr_notifications`
--
ALTER TABLE `apvr_notifications`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `apvr_notifications_attachments`
--
ALTER TABLE `apvr_notifications_attachments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `apvr_other_objectives`
--
ALTER TABLE `apvr_other_objectives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15774;

--
-- AUTO_INCREMENT for table `apvr_protocol`
--
ALTER TABLE `apvr_protocol`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4105;

--
-- AUTO_INCREMENT for table `apvr_protocol_archive`
--
ALTER TABLE `apvr_protocol_archive`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2217;

--
-- AUTO_INCREMENT for table `apvr_protocol_comment`
--
ALTER TABLE `apvr_protocol_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `apvr_protocol_comment_rec`
--
ALTER TABLE `apvr_protocol_comment_rec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_protocol_history`
--
ALTER TABLE `apvr_protocol_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_protocol_revision`
--
ALTER TABLE `apvr_protocol_revision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_publications`
--
ALTER TABLE `apvr_publications`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3191;

--
-- AUTO_INCREMENT for table `apvr_renewals`
--
ALTER TABLE `apvr_renewals`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `apvr_renewals_attachments`
--
ALTER TABLE `apvr_renewals_attachments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=568;

--
-- AUTO_INCREMENT for table `apvr_renewals_literature`
--
ALTER TABLE `apvr_renewals_literature`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `apvr_renewals_summary`
--
ALTER TABLE `apvr_renewals_summary`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `apvr_research_project_expenditure`
--
ALTER TABLE `apvr_research_project_expenditure`
  MODIFY `rstug_expenditure_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3259;

--
-- AUTO_INCREMENT for table `apvr_research_project_expenditure_archive`
--
ALTER TABLE `apvr_research_project_expenditure_archive`
  MODIFY `rstug_expenditure_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2318;

--
-- AUTO_INCREMENT for table `apvr_research_project_expenditure_local`
--
ALTER TABLE `apvr_research_project_expenditure_local`
  MODIFY `rstug_expenditure_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3259;

--
-- AUTO_INCREMENT for table `apvr_research_project_expenditure_local_archive`
--
ALTER TABLE `apvr_research_project_expenditure_local_archive`
  MODIFY `rstug_expenditure_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2318;

--
-- AUTO_INCREMENT for table `apvr_reviewers`
--
ALTER TABLE `apvr_reviewers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_saes`
--
ALTER TABLE `apvr_saes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `apvr_saes_measures_mitigate_dev`
--
ALTER TABLE `apvr_saes_measures_mitigate_dev`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `apvr_saes_measures_mitigate_dev_b`
--
ALTER TABLE `apvr_saes_measures_mitigate_dev_b`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `apvr_study_approvals`
--
ALTER TABLE `apvr_study_approvals`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2469;

--
-- AUTO_INCREMENT for table `apvr_study_approvals_copy`
--
ALTER TABLE `apvr_study_approvals_copy`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391;

--
-- AUTO_INCREMENT for table `apvr_study_approvals_copy2`
--
ALTER TABLE `apvr_study_approvals_copy2`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=514;

--
-- AUTO_INCREMENT for table `apvr_study_description_age`
--
ALTER TABLE `apvr_study_description_age`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2306;

--
-- AUTO_INCREMENT for table `apvr_study_population`
--
ALTER TABLE `apvr_study_population`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4068;

--
-- AUTO_INCREMENT for table `apvr_study_population_archive`
--
ALTER TABLE `apvr_study_population_archive`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2318;

--
-- AUTO_INCREMENT for table `apvr_study_post_approvals`
--
ALTER TABLE `apvr_study_post_approvals`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `apvr_study_post_approvals_copy`
--
ALTER TABLE `apvr_study_post_approvals_copy`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `apvr_submission`
--
ALTER TABLE `apvr_submission`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4105;

--
-- AUTO_INCREMENT for table `apvr_submission_archive`
--
ALTER TABLE `apvr_submission_archive`
  MODIFY `pid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2226;

--
-- AUTO_INCREMENT for table `apvr_submission_clinical_trial`
--
ALTER TABLE `apvr_submission_clinical_trial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `apvr_submission_clinical_trial_archive`
--
ALTER TABLE `apvr_submission_clinical_trial_archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2212;

--
-- AUTO_INCREMENT for table `apvr_submission_cost`
--
ALTER TABLE `apvr_submission_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_submission_country`
--
ALTER TABLE `apvr_submission_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10227;

--
-- AUTO_INCREMENT for table `apvr_submission_review_sr`
--
ALTER TABLE `apvr_submission_review_sr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18310;

--
-- AUTO_INCREMENT for table `apvr_submission_stages`
--
ALTER TABLE `apvr_submission_stages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4239;

--
-- AUTO_INCREMENT for table `apvr_submission_task`
--
ALTER TABLE `apvr_submission_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4041;

--
-- AUTO_INCREMENT for table `apvr_submission_task_archive`
--
ALTER TABLE `apvr_submission_task_archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2319;

--
-- AUTO_INCREMENT for table `apvr_submission_transfered`
--
ALTER TABLE `apvr_submission_transfered`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `apvr_submission_upload`
--
ALTER TABLE `apvr_submission_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44195;

--
-- AUTO_INCREMENT for table `apvr_submission_upload_archive`
--
ALTER TABLE `apvr_submission_upload_archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2540;

--
-- AUTO_INCREMENT for table `apvr_submission_user`
--
ALTER TABLE `apvr_submission_user`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_team`
--
ALTER TABLE `apvr_team`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8645;

--
-- AUTO_INCREMENT for table `apvr_team_archive`
--
ALTER TABLE `apvr_team_archive`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2504;

--
-- AUTO_INCREMENT for table `apvr_updated_sections`
--
ALTER TABLE `apvr_updated_sections`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4437;

--
-- AUTO_INCREMENT for table `apvr_upload_type`
--
ALTER TABLE `apvr_upload_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `apvr_upload_type_extension`
--
ALTER TABLE `apvr_upload_type_extension`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apvr_user`
--
ALTER TABLE `apvr_user`
  MODIFY `asrmApplctID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6795;

--
-- AUTO_INCREMENT for table `apvr_web_content`
--
ALTER TABLE `apvr_web_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `apvr_web_menus`
--
ALTER TABLE `apvr_web_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `apvr_web_slider`
--
ALTER TABLE `apvr_web_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
