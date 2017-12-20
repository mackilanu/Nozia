-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:3306
-- Tid vid skapande: 11 okt 2017 kl 14:11
-- Serverversion: 5.7.19-0ubuntu0.17.04.1
-- PHP-version: 7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `nozia`
--

DELIMITER $$
--
-- Procedurer
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetch_offers` (IN `p_StartPos` INT, IN `p_Rows` INT)  BEGIN

SELECT * FROM nozia.Offers ORDER BY Uploaded DESC LIMIT p_StartPos, p_Rows;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertOfferCS` (IN `p_CS` INT, IN `p_offer` INT)  BEGIN

INSERT INTO nozia.Offer_CS
(
    CS,
    Offer
)

VALUES
(
       p_CS,
       p_offer
);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_Companies` (IN `p_Category` INT, IN `p_CityState` INT, IN `p_Name` VARCHAR(128), IN `p_password` VARCHAR(128), IN `p_email` VARCHAR(128), IN `p_verify` VARCHAR(128), IN `p_Username` VARCHAR(128), IN `p_orgnr` VARCHAR(32))  BEGIN

INSERT INTO nozia.Companies
(
        Category,
        CityState,
        Name,
        Email,
        Password,
        MailVerify,
        Username,
        Orgnr
)

VALUES
(
        p_Category,
        p_CityState,
        p_Name,
        p_Email,
        p_password,
        p_verify,
        p_Username,
        p_orgnr
        
);


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_Company_file` (IN `p_CompanyID` INT, IN `p_URL` VARCHAR(128), IN `p_Image` VARCHAR(128), IN `p_Caption` VARCHAR(64))  BEGIN

INSERT INTO nozia.Company_files
(
      CompanyID,
      URL,
      Image,
      Caption
)

VALUES
(
       p_CompanyID,
       p_URL,
       p_Image,
       p_Caption
);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_Company_post` (IN `p_Company` INT, IN `p_Caption` VARCHAR(128), IN `p_Message` TEXT)  BEGIN

INSERT INTO nozia.Company_post
(
        Company,
        Caption,
        Message
)

VALUES
(
        p_Company,
        p_Caption,
        p_Message
);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_favourite` (IN `p_UserID` INT, IN `p_CompanyID` INT)  BEGIN

INSERT INTO nozia.Subscriptions
(
       UserID,
       CompanyID            
)

VALUES
(
       p_UserID,
       p_CompanyID
);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_Foretagssida` (IN `p_CompanyID` INT, IN `p_Telefon` VARCHAR(32), IN `p_Adress` VARCHAR(64))  BEGIN

INSERT INTO nozia.Foretagssida
(
     CompanyID,
     Telefon,
     Adress
)

VALUES
(
        p_CompanyID,
        p_Telefon,
        p_Adress
);


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_like` (IN `p_User` INT, IN `p_PostID` INT, IN `p_CompanyID` INT)  BEGIN

INSERT INTO nozia.Likes
(
    User,
    PostID,
    CompanyID
)

VALUES
(
    p_User,
    p_PostID,
    p_CompanyID
);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_MyOffer` (IN `p_user` INT, IN `p_offer` INT)  BEGIN

INSERT INTO nozia.MyOffers
(
       User,
       Offer      
)

VALUES
(
       p_user,
       p_offer
);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_Offer` (IN `p_caption` VARCHAR(64), IN `p_image` VARCHAR(128), IN `p_ShortDes` TEXT, IN `p_startdate` DATE, IN `p_duedate` DATE, IN `p_companyid` INT, IN `p_FromAge` INT, IN `p_ToAge` INT, IN `p_latest` INT, IN `p_Gender` INT)  BEGIN

INSERT INTO nozia.Offers
(
     CompanyID,
     Caption,
     Image,
     ShortDes,
     StartDate,
     DueDate,
     MinAge,
     MaxAge,
     Latest,
     Gender
)

VALUES
(
        p_companyid,
        p_caption,
        p_image,
        p_ShortDes,
        p_startdate,
        p_duedate,
        p_FromAge,
        p_ToAge,
        p_latest,
        p_Gender
        
);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_OnlineOffers` (IN `p_caption` VARCHAR(128), IN `p_trackurl` VARCHAR(256), IN `p_description` TEXT, IN `p_image` VARCHAR(128))  BEGIN

INSERT INTO nozia.OnlineOffers
(
        Caption,
        TrackUrl,
        Description,
        Image,
        type
    
)

VALUES
(
        p_caption,
        p_trackurl,
        p_description,
        p_image,
        0
);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_patchnote` (IN `p_Caption` VARCHAR(128), IN `p_Message` TEXT, IN `p_Date` DATE, IN `p_Version` VARCHAR(32))  BEGIN

INSERT INTO nozia.ReleaseNotes
(
    Caption,
    Message,
    Date,
    Version

)

VALUES
(
    p_Caption,
    p_Message,
    p_Date,
    p_Version
);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_tavlingar` (IN `p_caption` VARCHAR(128), IN `p_trackurl` VARCHAR(256), IN `p_description` TEXT, IN `p_image` VARCHAR(128))  BEGIN

INSERT INTO nozia.OnlineOffers
(
        Caption,
        TrackUrl,
        Description,
        Image,
        type
    
)

VALUES
(
        p_caption,
        p_trackurl,
        p_description,
        p_image,
        1
);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_Traffic` (IN `p_id` INT)  BEGIN

INSERT INTO nozia.UserTraffic
(
    User
)

VALUES
(
       p_id
);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_Users` (IN `p_cs` INT, IN `p_fname` VARCHAR(128), IN `p_gender` INT, IN `P_username` VARCHAR(128), IN `p_password` VARCHAR(256), IN `p_email` VARCHAR(256), IN `p_BirthDay` DATE, IN `p_verify` VARCHAR(128))  BEGIN

INSERT INTO nozia.Users
(
        CS,
        Fname,
        Gender,
        Username,
        Password,
        Email,
        BirthDay,
        MailVerify
    
)

VALUES
(
        p_cs,
        p_fname,
        p_gender,
        p_username,
        p_password,
        p_email,
        p_BirthDay,
        p_verify
);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_AllOffers` ()  SELECT * FROM nozia.Offers ORDER BY Uploaded DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_all_offers` ()  BEGIN

SELECT ID FROM nozia.Offers;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_categories` ()  NO SQL
BEGIN

SELECT CatgoryID, Caption FROM nozia.Categories

ORDER BY Caption ASC;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_checkIfLiked` (IN `p_User` INT)  BEGIN

SELECT * FROM nozia.Likes WHERE User = p_User;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_Companies` ()  BEGIN

SELECT * FROM nozia.Companies;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_CompaniesParams` (IN `p_name` VARCHAR(128))  BEGIN
 SELECT ID, Name FROM nozia.Companies WHERE Name = p_name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_company` (IN `p_id` INT)  BEGIN

SELECT * FROM nozia.Companies WHERE ID = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_CompanyBg` (IN `p_CompanyID` INT)  BEGIN

SELECT Background FROM nozia.Foretagssida WHERE CompanyID = p_CompanyID;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_CompanyEmail` (IN `p_email` VARCHAR(128))  BEGIN

SELECT ID FROM nozia.Companies WHERE Email=p_email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_CompanyIcon` ()  BEGIN

SELECT Icon FROM nozia.Companies;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_companylogin` (IN `p_name` VARCHAR(128), IN `p_password` VARCHAR(128))  BEGIN

SELECT * FROM nozia.Companies WHERE Username = p_name AND Password = p_password;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_companyName` (IN `p_Name` VARCHAR(128))  BEGIN

SELECT Name FROM nozia.Companies WHERE Name = p_Name;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_companyParams` (IN `p_citystate` INT, IN `p_category` INT)  BEGIN

SELECT *  FROM nozia.Companies WHERE Category = p_category AND CityState = p_citystate;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_CompanyUsernames` ()  BEGIN

SELECT Name, ID, Icon FROM nozia.Companies;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_companyVerify` (IN `p_verify` VARCHAR(128))  BEGIN
 SELECT * FROM nozia.Companies WHERE MailVerify = p_verify;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_Company_files` (IN `p_id` INT)  BEGIN

SELECT * FROM nozia.Company_files WHERE CompanyID = p_id;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_company_param` (IN `p_username` INT)  BEGIN

SELECT Username, ID FROM nozia.Companies WHERE Username = p_username;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_company_posts` (IN `p_id` INT)  BEGIN

SELECT * FROM nozia.Company_post WHERE Company = p_id; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_Country` ()  BEGIN

SELECT * FROM nozia.Country;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_CS` ()  BEGIN

SELECT * FROM nozia.CS

ORDER BY CityState ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_CSWithParam` (IN `p_ID` INT(248))  BEGIN

SELECT * FROM nozia.CS WHERE ID = p_ID;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_email` (IN `p_email` VARCHAR(128))  BEGIN

SELECT email FROM nozia.Users WHERE email=p_email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_fav` (IN `p_UserID` INT, IN `p_CompanyID` INT)  BEGIN

SELECT SubID FROM nozia.Subscriptions WHERE UserID = p_UserID AND CompanyID = p_CompanyID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_favs` (IN `p_UserID` INT)  BEGIN

SELECT * FROM nozia.Subscriptions WHERE UserID = p_UserID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_Foretagssida` (IN `p_id` INT)  BEGIN

SELECT * FROM nozia.Foretagssida WHERE CompanyID = p_id;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_foretagssidaNoParams` ()  BEGIN

SELECT * FROM nozia.Foretagssida;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_InsertToMyOffers` (IN `p_name` VARCHAR(128), IN `P_ID` INT)  BEGIN

SELECT * FROM nozia.Offers WHERE Caption = p_name and CompanyID = p_ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_latestoffer` (IN `p_id` INT)  BEGIN

SELECT * FROM nozia.Offers WHERE Latest = 1 AND CompanyID = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_like` (IN `p_User` INT, IN `p_PostID` INT, IN `p_CompanyID` INT)  BEGIN

SELECT ID FROM nozia.Likes WHERE User = p_User AND PostID = p_PostID AND CompanyID = p_CompanyID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_likes_length` (IN `p_id` INT)  BEGIN

SELECT ID FROM nozia.Likes WHERE PostID = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_login` (IN `p_username` VARCHAR(128), IN `p_password` VARCHAR(256))  BEGIN

SELECT * FROM nozia.Users WHERE Username = p_username AND Password = p_password;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_MyOffer` (IN `p_User` INT, IN `p_Offer` INT)  BEGIN

SELECT * FROM nozia.MyOffers WHERE User = p_User AND Offer = p_Offer;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_MyOffers` ()  SELECT * FROM nozia.MyOffers$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_Notes` ()  BEGIN

SELECT * FROM nozia.ReleaseNotes

ORDER BY Date DESC;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_offer` (IN `p_id` INT)  BEGIN

SELECT * FROM nozia.Offers WHERE ID = p_id ORDER BY Uploaded ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_offerImage` (IN `p_id` INT)  BEGIN

SELECT Image FROM nozia.Offers WHERE ID = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_offers` (IN `p_id` INT)  BEGIN

SELECT * FROM nozia.Offers WHERE CompanyID = p_id
ORDER BY Uploaded DESC LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_offerWithParams` (IN `p_CompanyID` INT, IN `p_Caption` VARCHAR(128))  BEGIN

SELECT * FROM nozia.Offers WHERE CompanyID = p_CompanyID AND Caption = p_Caption;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_Offer_CS` (IN `p_CS` INT)  BEGIN

SELECT CS, Offer FROM nozia.Offer_CS WHERE CS = p_CS;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_OnlineOffers` ()  NO SQL
BEGIN

SELECT * FROM nozia.OnlineOffers WHERE type=0;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_tavlingar` ()  BEGIN

SELECT * FROM nozia.OnlineOffers WHERE type=1;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_user` (IN `p_ID` INT)  BEGIN

SELECT * FROM nozia.Users WHERE ID = p_ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_usernames` (IN `p_username` VARCHAR(128))  BEGIN

SELECT Username FROM nozia.Users WHERE Username=p_username;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_UserPw` (IN `p_password` VARCHAR(64), IN `p_id` INT)  BEGIN

SELECT * FROM nozia.Users WHERE ID = p_id AND Password = p_password;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_Users` ()  NO SQL
BEGIN

SELECT * FROM nozia.Users;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_UserWithEmail` (IN `p_email` VARCHAR(128))  SELECT ID FROM nozia.Users WHERE Email= p_email$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_verify` (IN `p_verify` VARCHAR(128))  BEGIN

SELECT *  FROM nozia.Users WHERE MailVerify = p_verify; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `remove_fav` (IN `p_UserID` INT, IN `p_CompanyID` INT)  BEGIN
DELETE FROM nozia.Subscriptions
WHERE UserID = p_UserID AND CompanyID = p_CompanyID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `remove_like` (IN `p_User` INT, IN `p_Offer` INT, IN `p_Company` INT)  BEGIN
DELETE FROM nozia.Likes
WHERE User = p_User AND PostID = p_Offer AND CompanyID = p_Company;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `remove_OnlineOffer` (IN `p_id` INT(4))  BEGIN
DELETE FROM nozia.OnlineOffers
WHERE ID=p_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `test` ()  NO SQL
SELECT * FROM nozia.Users LIMIT 5, 4$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_banner` (IN `p_banner` VARCHAR(128), IN `p_id` INT)  BEGIN
UPDATE nozia.Foretagssida
SET Banner = p_banner
WHERE CompanyID = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_CompanyBackground` (IN `p_Background` VARCHAR(128), IN `p_id` INT)  BEGIN
UPDATE nozia.Foretagssida
SET Background = p_Background
WHERE CompanyID = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_CompanyIcon` (IN `p_Icon` VARCHAR(128), IN `p_CompanyID` INT)  UPDATE nozia.Companies
SET Icon = p_Icon
WHERE ID = p_CompanyID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_company_files` (IN `p_CompanyID` INT, IN `p_url` VARCHAR(128))  DELETE FROM nozia.Company_files
WHERE CompanyID = p_CompanyID AND URL = p_url$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_company_post` (IN `p_caption` VARCHAR(128), IN `p_message` TEXT, IN `p_id` INT)  BEGIN
UPDATE nozia.Company_post
SET Caption = p_caption, Message = p_message
WHERE Company = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_Email` (IN `p_email` VARCHAR(64), IN `p_id` INT)  UPDATE nozia.Users
SET Email = p_email
WHERE ID = p_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_foretagssida` (IN `p_phone` VARCHAR(16), IN `P_Adress` VARCHAR(64), IN `p_Postnr` VARCHAR(32), IN `p_id` INT)  BEGIN
UPDATE nozia.Foretagssida
SET Telefon = p_phone, Adress = p_Adress, Postnr = p_Postnr
WHERE CompanyID = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_latest` (IN `p_id` INT)  NO SQL
BEGIN
UPDATE nozia.Offers
SET Latest = NULL
WHERE CompanyID = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_MyOffer` (IN `p_User` INT, IN `p_Offer` INT)  UPDATE nozia.MyOffers
SET Used = 1
WHERE User = p_User AND Offer = p_Offer$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_Offer` (IN `p_ID` INT, IN `p_CompanyID` INT)  BEGIN

DELETE FROM nozia.Offers
WHERE ID = p_ID AND CompanyID = p_CompanyID;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_Pw` (IN `p_pw` VARCHAR(128), IN `p_id` INT)  BEGIN
UPDATE nozia.Users
SET Password = p_pw
WHERE ID = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_TextColor` (IN `p_TextColor` VARCHAR(16), IN `p_CompanyID` INT)  UPDATE nozia.Foretagssida
SET TextColor = p_TextColor
WHERE CompanyID = p_CompanyID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_verifyCompany` (IN `p_mailverify` VARCHAR(128))  UPDATE nozia.Companies
SET Verify = 1
WHERE MailVerify = p_mailverify$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_verifyUser` (IN `p_mailverify` VARCHAR(128))  UPDATE nozia.Users
SET verify = 1
WHERE MailVerify = p_mailverify$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tabellstruktur `Categories`
--

CREATE TABLE `Categories` (
  `CatgoryID` int(11) NOT NULL,
  `Caption` varchar(128) NOT NULL,
  `Description` varchar(256) NOT NULL,
  `URL` varchar(256) DEFAULT 'test.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `Categories`
--

INSERT INTO `Categories` (`CatgoryID`, `Caption`, `Description`, `URL`) VALUES
(2, 'Hälsa', 'Hälsoprodukter', 'icons/health.png'),
(3, 'Restaurang', 'Restaurangerbjudanden', 'icons/restaurant.png'),
(4, 'Sport', 'Sportföretag', 'icons/sport.png'),
(5, 'Kläder', 'Klädesföretag', 'icons/clothes.png'),
(6, 'Fitness', 'Fitnessföretag', 'icons/fitness.png\r\n'),
(7, 'Böcker', 'Bokföretag', 'icons/books.png'),
(8, 'Leksaker', 'Leksaker', 'icons/toys.png'),
(9, 'All-butik', 'Butiker med stor variation', 'icons/all_butik.png'),
(10, 'Smycken', 'Smyckesföretag', 'icons/jewelry.png'),
(11, 'Skor', 'Skoföretag', 'icons/shoes.png'),
(12, 'Café', 'kafeér', 'icons/cafe.png'),
(13, 'Beauty', 'Skönhetsföretag', 'icons/beauty.png'),
(14, 'Hem och inredning', 'Hem och inredningsföretag', 'icons/home_and_furniture.png'),
(15, 'Underhållning', 'Underhållningsföretag', 'icons/entertainment.png'),
(16, 'Godis', 'Godisföretag', 'icons/candy.png'),
(17, 'Baby', 'Baby', 'icons/baby.png'),
(18, 'Teknik', 'Teknikföretag', 'icons/technics.png'),
(19, 'Mat', 'Mat', 'icons/food 1.png'),
(20, 'Frisör', 'Frisörsalonger', 'icons/hair_salon.png'),
(21, 'Tobak', 'Tobak', 'icons/tobacco.png'),
(22, 'Online-erbjudanden', 'Bläddra bland olika online-erbjudanden', 'icons/online_offers.png'),
(23, 'Tävlingar', 'Bläddra bland olika tävlingar', 'icons/competitions.png'),
(24, 'Väskor', 'Väskor', 'icons/bags.png');

-- --------------------------------------------------------

--
-- Tabellstruktur `Companies`
--

CREATE TABLE `Companies` (
  `Category` int(11) DEFAULT NULL,
  `ID` int(11) NOT NULL COMMENT 'Företagets ID',
  `CityState` int(11) NOT NULL,
  `Name` varchar(128) NOT NULL COMMENT 'Namnet på företaget',
  `Orgnr` varchar(32) NOT NULL,
  `Username` varchar(128) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `Description` varchar(256) DEFAULT NULL COMMENT 'En kort beskrivning av företaget',
  `Icon` varchar(128) NOT NULL,
  `Paid` int(11) NOT NULL DEFAULT '0' COMMENT '0 = No 1=Yes',
  `MailVerify` varchar(128) NOT NULL,
  `Verify` int(11) NOT NULL DEFAULT '0' COMMENT '0 = no 1 = yes',
  `RegisterDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `Companies`
--

INSERT INTO `Companies` (`Category`, `ID`, `CityState`, `Name`, `Orgnr`, `Username`, `Password`, `Email`, `Description`, `Icon`, `Paid`, `MailVerify`, `Verify`, `RegisterDate`) VALUES
(14, 35, 3, 'Åslanda Handelsträdgård ', '590202-6273', 'Bråten', 'e4a1e5f0f3e6f06d951d0201703fe431e3362bccbdd147332d70228b7a76a4fa', 'rolandgubben@gmail.com', NULL, '59d754f77c94e5.69750396.jpg', 0, 's4NhtoVMpBcsWJ2pGBT4g11ibt5Co7zM', 1, '2017-04-10 12:31:58'),
(9, 45, 106, 'hejsan', '1111111111', 'hejan', 'e4a1e5f0f3e6f06d951d0201703fe431e3362bccbdd147332d70228b7a76a4fa', 'marcus.andersson15@itgksd.se', NULL, '', 0, '2RWUeteAdZj0cO4s0NXiEd9Oy4z0KOhM', 0, '2017-10-01 14:46:06'),
(5, 48, 3, 'HM', '1234567891', 'soren', '2be4d9bbeb574e8cea7b600ae61683dbf0f47e7189ab968e416554a4b34c5050', 'sorenjohansson@outlook.com', NULL, '59d750d9beec40.87043985.png', 0, 'VQhkk8YWG4aYsN7WJivkU0jgFoo0bjU7', 0, '2017-10-01 14:57:03'),
(18, 49, 3, 'Teknikmagasinet', '1234567892', 'teknikmagasinet', '2be4d9bbeb574e8cea7b600ae61683dbf0f47e7189ab968e416554a4b34c5050', 'sushi7@live.se', NULL, '', 0, 'euX7z6d7s21050TRAgloVxNR7gI1JvSY', 0, '2017-10-02 21:37:32'),
(10, 50, 3, 'Guldfynd', '1234567892', 'Gfynd', '2be4d9bbeb574e8cea7b600ae61683dbf0f47e7189ab968e416554a4b34c5050', 'guldfynd@gmail.com', NULL, '59d751755ee335.66857594.png', 0, 'DBVZL3ORxVha2J4fxWA2yGz7CCONCpKf', 0, '2017-10-02 22:07:00'),
(7, 51, 3, 'bokus', '1234567893', 'bokus', '2be4d9bbeb574e8cea7b600ae61683dbf0f47e7189ab968e416554a4b34c5050', 'bokus@bokus.se', NULL, '59d7548031ea49.13879666.png', 0, 'vSJkomv8XuPt3xrXOjWrDYPH7638y2u3', 0, '2017-10-02 22:25:38'),
(4, 52, 3, 'Intersport', '1234567894', 'intsp', '2be4d9bbeb574e8cea7b600ae61683dbf0f47e7189ab968e416554a4b34c5050', 'intersport@intersport.se', NULL, '59d7542ab0f7f6.19016514.png', 0, 'lre96mWo2tfVORPUmoOuxCpaANAJ6Cys', 0, '2017-10-02 22:37:29'),
(19, 53, 3, 'ICA', '1234567895', 'ica', '2be4d9bbeb574e8cea7b600ae61683dbf0f47e7189ab968e416554a4b34c5050', 'ica@ica.se', NULL, '59d7526eeefa29.72523891.png', 0, '3NB99yxc2N8RFXL1lzwTbV4LJFvPh4hl', 0, '2017-10-02 22:45:43'),
(14, 54, 3, 'IKEA', '1234567899', 'ikea', '2be4d9bbeb574e8cea7b600ae61683dbf0f47e7189ab968e416554a4b34c5050', 'ikea@ikea.se', NULL, '59d753b7c26443.38973972.jpg', 0, '7II5weS6OI5AjlPmKEwZ7GBPcUmT9F8h', 0, '2017-10-02 22:56:38');

-- --------------------------------------------------------

--
-- Tabellstruktur `CompanyDivision`
--

CREATE TABLE `CompanyDivision` (
  `ID` int(11) NOT NULL,
  `Company` int(11) NOT NULL,
  `DivName` varchar(64) NOT NULL COMMENT 'Namnet på "subföretaget"',
  `CS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `CompanyUsers`
--

CREATE TABLE `CompanyUsers` (
  `ID` int(11) NOT NULL,
  `Company` int(11) NOT NULL,
  `Username` varchar(128) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `Priviledge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `Company_files`
--

CREATE TABLE `Company_files` (
  `ID` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `Caption` varchar(64) NOT NULL,
  `URL` varchar(128) NOT NULL,
  `Image` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `Company_files`
--

INSERT INTO `Company_files` (`ID`, `CompanyID`, `Caption`, `URL`, `Image`) VALUES
(24, 35, 'Test', 'sasas', 'sasasa');

-- --------------------------------------------------------

--
-- Tabellstruktur `Company_post`
--

CREATE TABLE `Company_post` (
  `ID` int(11) NOT NULL,
  `Company` int(11) NOT NULL,
  `Caption` varchar(128) NOT NULL,
  `Message` text NOT NULL,
  `Posted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `Company_post`
--

INSERT INTO `Company_post` (`ID`, `Company`, `Caption`, `Message`, `Posted`) VALUES
(12, 35, 'Nu har vi stängt ute i Åslanda', 'Finns dock på torget Onsdagar och Lördagar när vädret tillåter och som alltid kan du nå mig på telefon, nummret hittar du högre upp på min sida, vi tar 39:-st för ljungen men om du är medlem i NOZIA så får du 4 st för 100:- God Jakt', '2017-10-04 11:27:44'),
(19, 45, 'Välkommen till Nozia!', 'Här kan ditt företag ange information om kommande händelser inom företaget, eller varför inte ett välkomstmedelande?', '2017-10-01 16:46:06'),
(20, 48, 'Välkommen till Nozia!', 'Här kan ditt företag ange information om kommande händelser inom företaget, eller varför inte ett välkomstmedelande?', '2017-10-01 16:57:03'),
(21, 49, 'Välkommen till Nozia!', 'Här kan ditt företag ange information om kommande händelser inom företaget, eller varför inte ett välkomstmedelande?', '2017-10-02 23:37:32'),
(22, 50, 'Välkommen till Nozia!', 'Här kan ditt företag ange information om kommande händelser inom företaget, eller varför inte ett välkomstmedelande?', '2017-10-03 00:07:00'),
(23, 51, 'Välkommen till Nozia!', 'Här kan ditt företag ange information om kommande händelser inom företaget, eller varför inte ett välkomstmedelande?', '2017-10-03 00:25:38'),
(24, 52, 'Välkommen till Nozia!', 'Här kan ditt företag ange information om kommande händelser inom företaget, eller varför inte ett välkomstmedelande?', '2017-10-03 00:37:29'),
(25, 53, 'Välkommen till Nozia!', 'Här kan ditt företag ange information om kommande händelser inom företaget, eller varför inte ett välkomstmedelande?', '2017-10-03 00:45:43'),
(26, 54, 'Välkommen till Nozia!', 'Här kan ditt företag ange information om kommande händelser inom företaget, eller varför inte ett välkomstmedelande?', '2017-10-03 00:56:38');

-- --------------------------------------------------------

--
-- Tabellstruktur `Country`
--

CREATE TABLE `Country` (
  `id` int(11) NOT NULL,
  `Country` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `Country`
--

INSERT INTO `Country` (`id`, `Country`) VALUES
(1, 'Sverige'),
(2, 'Norge');

-- --------------------------------------------------------

--
-- Tabellstruktur `CS`
--

CREATE TABLE `CS` (
  `ID` int(11) NOT NULL COMMENT 'Användarens personliga id',
  `Country` int(11) NOT NULL DEFAULT '1',
  `CityState` varchar(64) COLLATE utf8_swedish_ci NOT NULL COMMENT 'Avser kommuner som finns i Sverige'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `CS`
--

INSERT INTO `CS` (`ID`, `Country`, `CityState`) VALUES
(3, 1, 'Årjäng'),
(4, 1, 'Eda'),
(5, 1, 'Strömstad'),
(6, 1, 'Säffle'),
(7, 1, 'Arvika'),
(8, 1, 'Bengtsfors'),
(9, 1, 'Hammarö'),
(10, 1, 'Karlstad'),
(11, 1, 'Filipstad'),
(12, 1, 'Forshaga'),
(13, 1, 'Grums'),
(14, 1, 'Torsby'),
(15, 1, 'Karlskoga'),
(16, 1, 'Hagfors'),
(17, 1, 'Kristinehamn'),
(18, 1, 'Degerfors'),
(19, 1, 'Sunne'),
(20, 1, 'Storfors'),
(23, 1, 'Karlshamn'),
(24, 1, 'Karlskrona'),
(25, 1, 'Olofström'),
(26, 1, 'Ronneby'),
(102, 1, 'Ale'),
(103, 1, 'Alingsås '),
(104, 1, 'Alvesta'),
(105, 1, 'Aneby'),
(106, 1, 'Arboga'),
(107, 1, 'Arjeplog'),
(108, 1, 'Arvidsjaur'),
(109, 1, 'Avesta'),
(110, 1, 'Askersund'),
(111, 1, 'Berg'),
(112, 1, 'Bjurholm'),
(113, 1, 'Bjuv'),
(114, 1, 'Boden'),
(115, 1, 'Bollebygd'),
(116, 1, 'Bollnäs'),
(117, 1, 'Borlänge'),
(118, 1, 'Borgholm'),
(119, 1, 'Borås'),
(120, 1, 'Botkyrka'),
(121, 1, 'Boxholm'),
(122, 1, 'Bromölla'),
(123, 1, 'Bräcke'),
(124, 1, 'Burlöv'),
(125, 1, 'Båstad'),
(200, 1, 'Dals-Ed'),
(201, 1, 'Dorotea'),
(202, 1, 'Danderyd'),
(203, 1, 'Ekerö'),
(204, 1, 'Eksjö'),
(205, 1, 'Emmaboda'),
(206, 1, 'Enköping'),
(207, 1, 'Eskilstuna'),
(208, 1, 'Eslöv'),
(209, 1, 'Essunga'),
(210, 1, 'Fagersta'),
(211, 1, 'Falkenberg'),
(212, 1, 'Falköping'),
(213, 1, 'Falun'),
(214, 1, 'Finspång'),
(215, 1, 'Flen'),
(216, 1, 'Färgelanda'),
(217, 1, 'Gagnef'),
(218, 1, 'Gislaved'),
(219, 1, 'Gnesta'),
(220, 1, 'Gnosjö'),
(221, 1, 'Gotland'),
(222, 1, 'Grästorp'),
(223, 1, 'Gullspång'),
(224, 1, 'Gällivare'),
(225, 1, 'Gävle'),
(226, 1, 'Göteborg'),
(227, 1, 'Götene'),
(228, 1, 'Habo'),
(229, 1, 'Hallsberg'),
(230, 1, 'Halmstad'),
(231, 1, 'Hallstahammar'),
(232, 1, 'Haninge'),
(233, 1, 'Haparanda'),
(234, 1, 'Heby'),
(235, 1, 'Hedemora'),
(236, 1, 'Helsingborg'),
(237, 1, 'Herrljunga'),
(238, 1, 'Hjo'),
(239, 1, 'Hofors'),
(240, 1, 'Huddinge'),
(241, 1, 'Hudiksvall'),
(242, 1, 'Hultsfred'),
(243, 1, 'Hylte'),
(244, 1, 'Håbo'),
(245, 1, 'Hällefors'),
(246, 1, 'Härjedalen'),
(247, 1, 'Härnösand'),
(248, 1, 'Härryda'),
(249, 1, 'Hässleholm'),
(250, 1, 'Högsby'),
(251, 1, 'Höganäs'),
(252, 1, 'Hörby'),
(253, 1, 'Höör'),
(254, 1, 'Jokkmokk'),
(321, 1, 'Jönköping'),
(322, 1, 'Järfälla'),
(323, 1, 'Kalix'),
(324, 1, 'Kalmar'),
(325, 1, 'Karlsborg'),
(326, 1, 'Katrineholm'),
(327, 1, 'Kinda'),
(328, 1, 'Kiruna'),
(329, 1, 'Kil'),
(330, 1, 'lippan'),
(331, 1, 'Kramfors'),
(332, 1, 'Knivsta'),
(333, 1, 'Krokom'),
(334, 1, 'Kristianstad'),
(335, 1, 'Kumla'),
(336, 1, 'Kungsbacka'),
(337, 1, 'Kungsör'),
(338, 1, 'Kungälv'),
(339, 1, 'Kävlinge'),
(340, 1, 'Köping'),
(341, 1, 'Laholm'),
(342, 1, 'Landskrona'),
(343, 1, 'Lekeberg'),
(344, 1, 'Laxå'),
(345, 1, 'Leksand'),
(346, 1, 'Lerum'),
(347, 1, 'Lessebo'),
(348, 1, 'Lidingö'),
(349, 1, 'Lilla Edet'),
(350, 1, 'Lidköping'),
(351, 1, 'Lindesberg'),
(352, 1, 'Linköping'),
(353, 1, 'Ljungby'),
(354, 1, 'Ljusdal'),
(355, 1, 'Ljusnarsberg'),
(356, 1, 'Lomma'),
(357, 1, 'Ludvika'),
(358, 1, 'Luleå'),
(359, 1, 'Lund'),
(360, 1, 'Lycksele'),
(361, 1, 'Lysekil'),
(362, 1, 'Malmö'),
(363, 1, 'Malung'),
(364, 1, 'Malå'),
(365, 1, 'Mariestad'),
(366, 1, 'Mark'),
(367, 1, 'Markaryd'),
(368, 1, 'Mellerud'),
(369, 1, 'Mjölby'),
(370, 1, 'Mora'),
(371, 1, 'Mullsjö'),
(372, 1, 'Motala'),
(373, 1, 'Munkedal'),
(374, 1, 'Mölndal'),
(395, 1, 'Mönsterås'),
(396, 1, 'Mörbylånga'),
(397, 1, 'Nora'),
(398, 1, 'Nacka'),
(399, 1, 'Norberg'),
(400, 1, 'Nordanstig'),
(401, 1, 'Nordmaling'),
(402, 1, 'Norrköping'),
(403, 1, 'Norrtälje'),
(404, 1, 'Norsjö'),
(405, 1, 'Nybro'),
(406, 1, 'Nykvarn'),
(407, 1, 'Nyköping'),
(408, 1, 'Nynäshamn'),
(409, 1, 'Nässjö'),
(410, 1, 'Ockelbo'),
(411, 1, 'Orsa'),
(412, 1, 'Orust'),
(413, 1, 'Osby'),
(434, 1, 'Oskarshamn'),
(435, 1, 'Ovanåker'),
(436, 1, 'Oxelösund'),
(437, 1, 'Pajala'),
(438, 1, 'Partille'),
(439, 1, 'Perstorp'),
(440, 1, 'Piteå'),
(441, 1, 'Ragunda'),
(442, 1, 'Rättvik'),
(443, 1, 'Robertsfors'),
(444, 1, 'Sala'),
(445, 1, 'Salem'),
(446, 1, 'Sandviken'),
(447, 1, 'Sigtuna'),
(448, 1, 'Simrishamn'),
(449, 1, 'Sjöbo'),
(450, 1, 'Skara'),
(451, 1, 'Skellefteå'),
(452, 1, 'Skinnskatteberg'),
(492, 1, 'Skurup'),
(493, 1, 'Skövde'),
(494, 1, 'Smedjebacken'),
(495, 1, 'Sollefteå'),
(496, 1, 'Sollentuna'),
(497, 1, 'Solna'),
(498, 1, 'Sorsele'),
(499, 1, 'Sotenäs'),
(500, 1, 'Staffanstorp'),
(501, 1, 'Stenungsund'),
(502, 1, 'Stockholm'),
(503, 1, 'Storuman'),
(504, 1, 'Strängnäs'),
(505, 1, 'Sundbyberg'),
(506, 1, 'Sundsvall'),
(507, 1, 'Svalöv'),
(508, 1, 'Surahammar'),
(509, 1, 'Svedala'),
(531, 1, 'Svenljunga'),
(532, 1, 'Säter'),
(533, 1, 'Sävsjö'),
(534, 1, 'Söderhamn'),
(535, 1, 'Söderköping'),
(536, 1, 'Södertälje'),
(537, 1, 'Sölvesborg'),
(538, 1, 'Tanum'),
(539, 1, 'Tibro'),
(540, 1, 'Tidaholm'),
(541, 1, 'Tierp'),
(542, 1, 'Timrå'),
(543, 1, 'Tingsryd'),
(544, 1, 'Tjörn'),
(545, 1, 'Tomelilla'),
(546, 1, 'Torsås'),
(547, 1, 'Tranemo'),
(548, 1, 'Tranås'),
(549, 1, 'Trelleborg'),
(570, 1, 'Trollhättan'),
(571, 1, 'Trosa'),
(572, 1, 'Tyresö'),
(573, 1, 'Täby'),
(574, 1, 'Töreboda'),
(575, 1, 'Uddevalla'),
(576, 1, 'Ulricehamn'),
(577, 1, 'Upplands-Bro'),
(578, 1, 'Uppl. Väsby'),
(579, 1, 'Uppsala'),
(580, 1, 'Uppvidinge'),
(581, 1, 'Umeå'),
(582, 1, 'Vadstena'),
(583, 1, 'Vaggeryd'),
(584, 1, 'Valdemarsvik'),
(585, 1, 'Vallentuna'),
(586, 1, 'Vansbro'),
(587, 1, 'Vara'),
(588, 1, 'Varberg'),
(589, 1, 'Vaxholm'),
(590, 1, 'Vellinge'),
(591, 1, 'Vetlanda'),
(592, 1, 'Vilhelmina'),
(593, 1, 'Vimmerby'),
(594, 1, 'Vindeln'),
(595, 1, 'Vingåker'),
(596, 1, 'Vårgårda'),
(597, 1, 'Vänersborg'),
(598, 1, 'Vännäs'),
(599, 1, 'Värmdö'),
(600, 1, 'Värnamo'),
(601, 1, 'Västervik'),
(602, 1, 'Västerås'),
(603, 1, 'äxjö'),
(604, 1, 'Ydre'),
(605, 1, 'Ystad'),
(606, 1, 'Ånge'),
(607, 1, 'Åre'),
(608, 1, 'Åsele'),
(609, 1, 'Åstorp'),
(610, 1, 'Åtvidaberg'),
(611, 1, 'Älvdalen'),
(612, 1, 'Älvkarleby'),
(613, 1, 'Ängelholm'),
(614, 1, 'Älmhult'),
(615, 1, 'Älvsbyn'),
(616, 1, 'Öckerö'),
(617, 1, 'Ödeshög'),
(618, 1, 'Örebro'),
(619, 1, 'Örkelljunga'),
(620, 1, 'Örnsköldsvik'),
(621, 1, 'Östersund'),
(622, 1, 'Österåker'),
(623, 1, 'Östhammar'),
(624, 1, 'Ö. Göinge'),
(625, 1, 'Överkalix'),
(626, 1, 'Övertorneå');

-- --------------------------------------------------------

--
-- Tabellstruktur `FavouriteCompany`
--

CREATE TABLE `FavouriteCompany` (
  `ID` int(11) NOT NULL,
  `User` int(11) NOT NULL,
  `Company` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `Foretagssida`
--

CREATE TABLE `Foretagssida` (
  `ID` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `Banner` varchar(128) DEFAULT NULL,
  `Background` varchar(128) DEFAULT NULL,
  `Icon` varchar(128) DEFAULT 'images/icons/silhouette.png',
  `Slogan` text,
  `TextColor` varchar(16) DEFAULT NULL,
  `Telefon` varchar(16) DEFAULT NULL,
  `Adress` varchar(64) DEFAULT NULL,
  `Postnr` varchar(32) DEFAULT NULL,
  `Exist` int(11) NOT NULL DEFAULT '0' COMMENT '0 = No 1=Yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `Foretagssida`
--

INSERT INTO `Foretagssida` (`ID`, `CompanyID`, `Banner`, `Background`, `Icon`, `Slogan`, `TextColor`, `Telefon`, `Adress`, `Postnr`, `Exist`) VALUES
(28, 35, '59d754ef7ad208.29795088.png', '59d754fd37a7e7.71731950.jpg', 'images/58eb7f7262e1b3.17754775.jpg', NULL, NULL, '070-677 25 54', 'Åslanda Bråten 67291', 'rolandgubben@gmail.com', 0),
(35, 45, NULL, NULL, 'images/icons/silhouette.png', NULL, NULL, '0748541564', 'Baldersvägen 10', NULL, 0),
(36, 48, '59d750d485dfe0.76260138.png', '59d750df0c4153.36020193.jpg', 'images/icons/silhouette.png', NULL, NULL, '0704568228', 'Stockholm Box 123', 'hmoffers@hm.se', 0),
(37, 49, NULL, NULL, 'images/icons/silhouette.png', NULL, NULL, '0704568228', 'Åslanda Bråten', NULL, 0),
(38, 50, '59d75170bd90e8.58472605.png', '59d7517bcceeb2.12509555.png', 'images/icons/silhouette.png', NULL, NULL, '070 456 12 78', 'Storgatan 23', 'guldfynd@guldfynd.se', 0),
(39, 51, '59d7547aaab0c7.02250753.png', '59d75483897ad4.57669246.jpg', 'images/icons/silhouette.png', NULL, NULL, '0704567823', 'Tvärgatan 8', 'bokus@bokus.se', 0),
(40, 52, '59d75427202c57.75317779.jpg', '59d7542ea116d6.39583944.jpg', 'images/icons/silhouette.png', NULL, NULL, '0705689127', 'Sveavägen 4', 'intsp@intsp', 0),
(41, 53, '59d751d17d0fb4.73309657.png', '59d75273e91f41.74725318.jpg', 'images/icons/silhouette.png', NULL, NULL, '0704568945', 'Köpgatan 3', 'ica@ica.se', 0),
(42, 54, '59d753b1f0cee8.52489897.png', '59d753bc766af6.05945021.jpg', 'images/icons/silhouette.png', NULL, NULL, '0704582145', 'vägen 1', 'ikea@ikea.se', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `Likes`
--

CREATE TABLE `Likes` (
  `ID` int(11) NOT NULL,
  `User` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `Likes`
--

INSERT INTO `Likes` (`ID`, `User`, `PostID`, `CompanyID`) VALUES
(149, 116, 163, 35),
(151, 116, 165, 35),
(164, 116, 180, 35),
(165, 116, 179, 51),
(166, 116, 178, 52),
(167, 116, 177, 54),
(168, 116, 176, 53),
(169, 116, 175, 50),
(170, 116, 174, 48);

-- --------------------------------------------------------

--
-- Tabellstruktur `MyOffers`
--

CREATE TABLE `MyOffers` (
  `ID` int(11) NOT NULL,
  `User` int(11) NOT NULL,
  `Offer` int(11) NOT NULL,
  `Used` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0= Not used 1= Used'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `MyOffers`
--

INSERT INTO `MyOffers` (`ID`, `User`, `Offer`, `Used`) VALUES
(1164, 106, 163, 0),
(1165, 111, 163, 0),
(1166, 116, 163, 0),
(1167, 117, 163, 0),
(1168, 119, 163, 0),
(1169, 122, 163, 0),
(1170, 123, 163, 0),
(1171, 124, 163, 0),
(1172, 125, 163, 0),
(1173, 126, 163, 0),
(1174, 128, 163, 0),
(1175, 129, 163, 0),
(1176, 130, 163, 0),
(1177, 131, 163, 0),
(1178, 132, 163, 0),
(1179, 133, 163, 0),
(1180, 134, 163, 0),
(1181, 135, 163, 0),
(1182, 136, 163, 0),
(1183, 137, 163, 0),
(1184, 138, 163, 0),
(1185, 139, 163, 0),
(1186, 140, 163, 0),
(1187, 142, 163, 0),
(1188, 143, 163, 0),
(1189, 144, 163, 0),
(1190, 145, 163, 0),
(1191, 146, 163, 0),
(1220, 106, 165, 0),
(1221, 111, 165, 0),
(1222, 116, 165, 0),
(1223, 117, 165, 0),
(1224, 119, 165, 0),
(1225, 122, 165, 0),
(1226, 123, 165, 0),
(1227, 124, 165, 0),
(1228, 125, 165, 0),
(1229, 126, 165, 0),
(1230, 128, 165, 0),
(1231, 129, 165, 0),
(1232, 130, 165, 0),
(1233, 131, 165, 0),
(1234, 132, 165, 0),
(1235, 133, 165, 0),
(1236, 134, 165, 0),
(1237, 135, 165, 0),
(1238, 136, 165, 0),
(1239, 137, 165, 0),
(1240, 138, 165, 0),
(1241, 139, 165, 0),
(1242, 140, 165, 0),
(1243, 142, 165, 0),
(1244, 143, 165, 0),
(1245, 144, 165, 0),
(1246, 145, 165, 0),
(1247, 146, 165, 0),
(1472, 106, 174, 0),
(1473, 111, 174, 0),
(1474, 116, 174, 1),
(1475, 117, 174, 0),
(1476, 119, 174, 0),
(1477, 122, 174, 0),
(1478, 123, 174, 0),
(1479, 124, 174, 0),
(1480, 125, 174, 0),
(1481, 126, 174, 0),
(1482, 128, 174, 0),
(1483, 129, 174, 0),
(1484, 130, 174, 0),
(1485, 131, 174, 0),
(1486, 132, 174, 0),
(1487, 133, 174, 0),
(1488, 134, 174, 0),
(1489, 135, 174, 0),
(1490, 136, 174, 0),
(1491, 137, 174, 0),
(1492, 138, 174, 0),
(1493, 139, 174, 0),
(1494, 140, 174, 0),
(1495, 142, 174, 0),
(1496, 143, 174, 0),
(1497, 144, 174, 0),
(1498, 145, 174, 0),
(1499, 146, 174, 0),
(1500, 106, 175, 0),
(1501, 111, 175, 0),
(1502, 116, 175, 0),
(1503, 117, 175, 0),
(1504, 119, 175, 0),
(1505, 122, 175, 0),
(1506, 123, 175, 0),
(1507, 124, 175, 0),
(1508, 125, 175, 0),
(1509, 126, 175, 0),
(1510, 128, 175, 0),
(1511, 129, 175, 0),
(1512, 130, 175, 0),
(1513, 131, 175, 0),
(1514, 132, 175, 0),
(1515, 133, 175, 0),
(1516, 134, 175, 0),
(1517, 135, 175, 0),
(1518, 136, 175, 0),
(1519, 137, 175, 0),
(1520, 138, 175, 0),
(1521, 139, 175, 0),
(1522, 140, 175, 0),
(1523, 142, 175, 0),
(1524, 143, 175, 0),
(1525, 144, 175, 0),
(1526, 145, 175, 0),
(1527, 146, 175, 0),
(1528, 106, 176, 0),
(1529, 111, 176, 0),
(1530, 116, 176, 0),
(1531, 117, 176, 0),
(1532, 119, 176, 0),
(1533, 122, 176, 0),
(1534, 123, 176, 0),
(1535, 124, 176, 0),
(1536, 125, 176, 0),
(1537, 126, 176, 0),
(1538, 128, 176, 0),
(1539, 129, 176, 0),
(1540, 130, 176, 0),
(1541, 131, 176, 0),
(1542, 132, 176, 0),
(1543, 133, 176, 0),
(1544, 134, 176, 0),
(1545, 135, 176, 0),
(1546, 136, 176, 0),
(1547, 137, 176, 0),
(1548, 138, 176, 0),
(1549, 139, 176, 0),
(1550, 140, 176, 0),
(1551, 142, 176, 0),
(1552, 143, 176, 0),
(1553, 144, 176, 0),
(1554, 145, 176, 0),
(1555, 146, 176, 0),
(1556, 106, 177, 0),
(1557, 111, 177, 0),
(1558, 116, 177, 0),
(1559, 117, 177, 0),
(1560, 119, 177, 0),
(1561, 122, 177, 0),
(1562, 123, 177, 0),
(1563, 124, 177, 0),
(1564, 125, 177, 0),
(1565, 126, 177, 0),
(1566, 128, 177, 0),
(1567, 129, 177, 0),
(1568, 130, 177, 0),
(1569, 131, 177, 0),
(1570, 132, 177, 0),
(1571, 133, 177, 0),
(1572, 134, 177, 0),
(1573, 135, 177, 0),
(1574, 136, 177, 0),
(1575, 137, 177, 0),
(1576, 138, 177, 0),
(1577, 139, 177, 0),
(1578, 140, 177, 0),
(1579, 142, 177, 0),
(1580, 143, 177, 0),
(1581, 144, 177, 0),
(1582, 145, 177, 0),
(1583, 146, 177, 0),
(1584, 106, 178, 0),
(1585, 111, 178, 0),
(1586, 116, 178, 1),
(1587, 117, 178, 0),
(1588, 119, 178, 0),
(1589, 122, 178, 0),
(1590, 123, 178, 0),
(1591, 124, 178, 0),
(1592, 125, 178, 0),
(1593, 126, 178, 0),
(1594, 128, 178, 0),
(1595, 129, 178, 0),
(1596, 130, 178, 0),
(1597, 131, 178, 0),
(1598, 132, 178, 0),
(1599, 133, 178, 0),
(1600, 134, 178, 0),
(1601, 135, 178, 0),
(1602, 136, 178, 0),
(1603, 137, 178, 0),
(1604, 138, 178, 0),
(1605, 139, 178, 0),
(1606, 140, 178, 0),
(1607, 142, 178, 0),
(1608, 143, 178, 0),
(1609, 144, 178, 0),
(1610, 145, 178, 0),
(1611, 146, 178, 0),
(1612, 106, 179, 0),
(1613, 111, 179, 0),
(1614, 116, 179, 1),
(1615, 117, 179, 0),
(1616, 119, 179, 0),
(1617, 122, 179, 0),
(1618, 123, 179, 0),
(1619, 124, 179, 0),
(1620, 125, 179, 0),
(1621, 126, 179, 0),
(1622, 128, 179, 0),
(1623, 129, 179, 0),
(1624, 130, 179, 0),
(1625, 131, 179, 0),
(1626, 132, 179, 0),
(1627, 133, 179, 0),
(1628, 134, 179, 0),
(1629, 135, 179, 0),
(1630, 136, 179, 0),
(1631, 137, 179, 0),
(1632, 138, 179, 0),
(1633, 139, 179, 0),
(1634, 140, 179, 0),
(1635, 142, 179, 0),
(1636, 143, 179, 0),
(1637, 144, 179, 0),
(1638, 145, 179, 0),
(1639, 146, 179, 0),
(1640, 106, 180, 0),
(1641, 111, 180, 0),
(1642, 116, 180, 1),
(1643, 117, 180, 0),
(1644, 119, 180, 0),
(1645, 122, 180, 0),
(1646, 123, 180, 0),
(1647, 124, 180, 0),
(1648, 125, 180, 0),
(1649, 126, 180, 0),
(1650, 128, 180, 0),
(1651, 129, 180, 0),
(1652, 130, 180, 0),
(1653, 131, 180, 0),
(1654, 132, 180, 0),
(1655, 133, 180, 0),
(1656, 134, 180, 0),
(1657, 135, 180, 0),
(1658, 136, 180, 0),
(1659, 137, 180, 0),
(1660, 138, 180, 0),
(1661, 139, 180, 0),
(1662, 140, 180, 0),
(1663, 142, 180, 1),
(1664, 143, 180, 0),
(1665, 144, 180, 0),
(1666, 145, 180, 0),
(1667, 146, 180, 0),
(1668, 147, 163, 0),
(1669, 147, 165, 0),
(1670, 147, 180, 0),
(1671, 147, 174, 0),
(1672, 147, 175, 0),
(1673, 147, 179, 0),
(1674, 147, 178, 0),
(1675, 147, 176, 0),
(1676, 147, 177, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `Offers`
--

CREATE TABLE `Offers` (
  `ID` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `Caption` varchar(128) NOT NULL,
  `Image` varchar(64) NOT NULL,
  `Gender` int(11) NOT NULL COMMENT '1 = män, 2 = kvinnor 3 = alla',
  `ShortDes` text NOT NULL COMMENT 'Kort beskrivning',
  `StartDate` date DEFAULT NULL,
  `DueDate` date DEFAULT NULL,
  `MinAge` int(11) DEFAULT NULL,
  `MaxAge` int(11) DEFAULT NULL,
  `Latest` int(11) DEFAULT NULL COMMENT '1 = yes 0 = no. Determines which offer is the latest',
  `Uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `Offers`
--

INSERT INTO `Offers` (`ID`, `CompanyID`, `Caption`, `Image`, `Gender`, `ShortDes`, `StartDate`, `DueDate`, `MinAge`, `MaxAge`, `Latest`, `Uploaded`) VALUES
(163, 35, 'Välkommen till Åslanda handelsträdgård!', '59d0fdd78c9171.03385147.jpeg', 1, 'Nu får du 3 blommor till priset av 2!', '2017-10-01', '2017-10-31', 10, 29, 1, '2017-10-01 14:38:15'),
(165, 35, 'Tja Martin', '59d297d4857675.77301570.png', 1, 'Va fan vill du!???', '2017-10-02', '2017-10-31', 10, 99, 1, '2017-10-02 19:47:32'),
(174, 48, 'JUL Erbjudande', '59d7510729b898.10452419.png', 3, 'Nu har du chansen att fynda fram till sista December 2017. Alla som är med i NOZIA får nämligen 20% på alla kläder. GOD JUL & GOTT NYTT ÅR', '2017-10-06', '2017-12-31', 18, 99, 1, '2017-10-06 09:46:47'),
(175, 50, 'Ringa in det som är viktigast för dig!', '59d751a23e01a7.44929542.jpg', 3, 'Den mest romantiska tiden om året, snön ligger vit, brasan sprakar och vintermörkret lägger sig, köp dina ringar hos oss så bjuder vi på en fin present på bröllopet!', '2017-10-06', '2017-12-31', 18, 99, 1, '2017-10-06 09:49:22'),
(176, 53, 'Frukt! Här va det frukt!', '59d7529dba2dd4.92266458.jpg', 3, 'Vitaminer, gott och nyttigt, passa på at köp billig frukt till bästa kvalité!', '2017-10-06', '2017-12-31', 18, 99, 1, '2017-10-06 09:53:33'),
(177, 54, 'Ny TV?', '59d753de9e1a29.60914611.jpg', 3, 'Då ska du ha en ny TV hylla. Vad är det som är så specielt med den här? Jo den kostar bara 595:- FYNDA!', '2017-10-06', '2017-12-31', 18, 99, 1, '2017-10-06 09:58:54'),
(178, 52, 'Ut och Spring!', '59d7544e4c1637.18691275.jpg', 3, 'Snart kommer snön med skidsäsongen i släptåg, se till att du är i form innan dess, just nu har vi 30% på alla löparskor!', '2017-10-06', '2017-12-31', 18, 99, 1, '2017-10-06 10:00:46'),
(179, 51, 'Årets julklapp?', '59d754a43e2364.71892714.jpg', 3, 'Knappast, men vad kan ge dig så mycket olika äventyr och vishet som en bok, ge bort en i julklapp. P.S se till att pärmen är hård, ingen gillar mjuka paket ;)', '2017-10-06', '2017-12-31', 18, 99, 1, '2017-10-06 10:02:12'),
(180, 35, 'Säsongen är slut!', '59d7552315b463.06284937.jpg', 3, 'Men jag finns på torget i Årjäng på Onsdagar och lördagar om vädret tillåter, jag har höstens blommor och färska grönsaker lokalt producerat!', '2017-10-06', '2017-12-31', 18, 99, 1, '2017-10-06 10:04:19');

-- --------------------------------------------------------

--
-- Tabellstruktur `Offer_CS`
--

CREATE TABLE `Offer_CS` (
  `ID` int(11) NOT NULL,
  `Offer` int(11) NOT NULL,
  `CS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `Offer_CS`
--

INSERT INTO `Offer_CS` (`ID`, `Offer`, `CS`) VALUES
(92, 163, 10),
(93, 163, 3),
(95, 165, 10),
(103, 174, 3),
(104, 175, 3),
(105, 176, 3),
(106, 177, 3),
(107, 178, 3),
(108, 179, 3),
(109, 180, 3);

-- --------------------------------------------------------

--
-- Tabellstruktur `OnlineOffers`
--

CREATE TABLE `OnlineOffers` (
  `Caption` varchar(128) NOT NULL,
  `TrackUrl` varchar(256) NOT NULL,
  `Description` text NOT NULL,
  `ID` int(11) NOT NULL,
  `Image` varchar(64) NOT NULL,
  `type` int(2) NOT NULL COMMENT '0 = Online erbjudande 1= Tävling',
  `Inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `OnlineOffers`
--

INSERT INTO `OnlineOffers` (`Caption`, `TrackUrl`, `Description`, `ID`, `Image`, `type`, `Inserted`) VALUES
('Allt i hemmet', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6094', 'Få 8 nr av Allt i hemmet + 2 fina bäddset för endast kr 299! Spara 871 kr.', 65, 'images/5887497f4d5f40.98673053.jpg', 0, '2017-01-25 14:48:14'),
('Allt om Vin', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6090', '6 nr Allt Om Vin+ exklusivt välkomstpaket - totalt värde 1100 kr! ', 66, 'images/588749dad4fed5.81351030.jpg', 0, '2017-01-25 14:48:14'),
('mama', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6095', '5 nr av Mama + härliga produkter från Dermalogica- spara i allt 891 kr ', 67, 'images/58874a2a4c6951.26388312.jpg', 0, '2017-01-25 14:48:14'),
('Allt om Mat', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6083', '6 nr Allt Om Mat + 2 Lempi-glas från Iittala - spara 370 kr! ', 68, 'images/58874a5517aa64.02486163.jpg', 0, '2017-01-25 14:48:14'),
('Cashmio spela & vinn', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5949', 'Testa Sveriges gladaste Casino - Cashmio!', 69, 'images/58874aff0972a6.92723468.jpg', 0, '2017-01-25 14:48:14'),
('Refunder.se - Få pengar tillbaka på dina köp', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6071', 'Få pengar tillbaka när du shoppar - Refunder.se', 70, 'images/58874b36ea37d2.54153645.jpg', 0, '2017-01-25 14:48:14'),
('Basic Travel holiday houses', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5881', 'Basic Travel holiday houses: book your dream house here', 71, 'images/58874b7d937851.98515080.jpg', 0, '2017-01-25 14:48:14'),
('Family Living', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6066', '4 nr av Family living + lyxigt grytunderlägg - bara 149kr!', 72, 'images/58874bac4c7240.57306266.jpg', 0, '2017-01-25 14:48:14'),
('Teknikens Värld + överlevnadslåda med praktiska verktyg + rutig pläd', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6065', 'Teknikens Värld 4nr + välkomstgåva för bara 99kr', 73, 'images/58874bfc54fc46.86288529.jpg', 0, '2017-01-25 14:48:14'),
('Tävla om en drömresa till Los Angeles MED LA LA LAND', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6026', 'Vinn en resa till LA med LA LA Land och Hotels.com', 74, 'images/58874c376b7f89.91450646.jpg', 0, '2017-01-25 14:48:14'),
('OsloSkinLab - färre rynkor', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5955', 'Smidigare hud på ett enkelt och riskfritt sätt? Ja tack! ', 75, 'images/58874c56368563.13161798.jpg', 0, '2017-01-25 14:48:14'),
('Damernas Värld', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6058', '5 nummer av Damernas värld + ögonskugga från bareMinerals 199:-', 76, 'images/58874c7c5e89a7.61883221.jpg', 0, '2017-01-25 14:48:14'),
('ToppHälsa', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6055', '5 nr ToppHälsa + härligt yogakit för 149 kr - totalt värde 1075 kr!', 77, 'images/58874ca7d1b4f5.55388270.jpg', 0, '2017-01-25 14:48:14'),
('VeckoRevyn', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6057', 'Få 5 nr av VeckoRevyn + schampo & balsam från Maria Nila - bara 199 kr!', 78, 'images/58874d5382f949.10000719.jpg', 0, '2017-01-25 14:48:14'),
('Bonnier korsord', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6052', 'Få 30% när du köper 5 valfria korsordstidningar.', 79, 'images/58874d79dbafd8.46152079.jpg', 0, '2017-01-25 14:48:14'),
('Sköna hem', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6053', '6 nr Sköna Hem + 2 muggar från Rörstrand – spara 529 kr!', 80, 'images/58874e6c1a89d4.43605729.jpg', 0, '2017-01-25 14:48:14'),
('STYLEBY', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6054', 'Få 4 nr av STYLEBY + lyxiga produkter från Maria Nila för bara 299 kr!', 81, 'images/58874e957a5116.97189882.jpg', 0, '2017-01-25 14:48:14'),
('amelia', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6059', '7 nr av amelia + ekologiskt produktpaket från Estelle & Thild - bara 199 kr', 82, 'images/58875c734b2ce2.49609354.jpg', 0, '2017-01-25 14:48:14'),
('I FORM', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6040', 'Beställ 4 nummer av I FORM och få en Kari Traa t-shirt och tights', 83, 'images/58875cb6dc4dd0.58950411.jpg', 0, '2017-01-25 14:48:14'),
('I FORM + Cutter&Slicer', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6032', '4 nummer av I FORM + Cutter&Slicer för endast 149,00 kr + 49,50 kr i porto och exp. Totalt 198,50 kr.', 84, 'images/588768ad6c4011.92671385.jpg', 0, '2017-01-25 14:48:14'),
('Aktiv Träning + Träningströja', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6013', 'Beställ Aktiv Träning och få en träningströja från Craft eller Kari Traa!', 85, 'images/588768d71cc391.69769341.jpg', 0, '2017-01-25 14:48:14'),
('Aktiv Träning + Craft Prime löparjacka', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=6006', 'Beställ Aktiv Träning och få en löpartröja från Craft Prime!', 86, 'images/588769126860d8.04536463.jpg', 0, '2017-01-25 14:48:14'),
('Disneyklubben', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5973', 'Skapa Disney-magi hemma!', 87, 'images/58876937d82d74.46532582.jpg', 0, '2017-01-25 14:48:14'),
('Allt om Historia + Chill Factor Nano jacka', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5993', 'Få 2 nummer av Allt om Historia + Chill Factor Nano jacka för 59,50 kr', 88, 'images/58876a1816a038.81278047.jpg', 0, '2017-01-25 14:48:14'),
('National Geographic + Bluetooth-hörlurar', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5982', 'Bluetooth-hörlurar + 3 nummer av National Geographic för endast 99,50 kr.', 89, 'images/58876a4ea56241.13117759.jpg', 0, '2017-01-25 14:48:14'),
('Tara', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5976', '5 nummer av Tara + lyxigt paket från Clarins för bara 199kr - totalt värde 1087 kr!', 98, 'images/588884d7687075.83529497.jpg', 0, '2017-01-25 14:48:14'),
('Vi Föräldrar', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5974', '5 nr av Vi Föräldrar + mysig filt & kaninskallra - bara 159kr!', 99, 'images/58888956187369.91194258.jpg', 0, '2017-01-25 14:48:14'),
('Släkthistoria', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5970', 'Beställ 3 nummer av Släkthistoria + Chill Factor Multifunktionsjacka för endast 99,50 kr.', 100, 'images/5888897b0a0ee3.43864868.jpg', 0, '2017-01-25 14:48:14'),
('Populär Historia', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5967', 'Beställ 2 nummer av Populär Historia + Bluetooth-hörlurar för endast 69,50 kr.', 101, 'images/5888899fb3e565.82686086.jpg', 0, '2017-01-25 14:48:14'),
('Elitsinglar', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5957', 'Elitsinglar representerar en helt ny form av matchmaking.', 102, 'images/588889cf01b574.41436282.jpg', 0, '2017-01-25 14:48:14'),
('Hembakat', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5947', ' 4 nr Hembakat + 2 Margretheskålar för bara 249!', 103, 'images/588889f19fef44.39842861.jpg', 0, '2017-01-25 14:48:14'),
('PowerBall Lottery by Lottoday', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5781', 'Powerball is one of the largest lotteries in the world', 104, '', 0, '2017-01-25 14:48:14'),
('101 nya idéer', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5936', 'Få 3 nr av ”101 nya idéer” + boken Mormorsrutor för endast 129kr!', 105, 'images/58888a7cdeab92.56861527.jpg', 0, '2017-01-25 14:48:14'),
('Allt om Trädgård', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5920', 'Få 4 nr av Allt om Trädgård  + praktiska gåvor för endast 98 kr + frakt', 106, 'images/58888aa45dfc30.19388278.jpg', 0, '2017-01-25 14:48:14'),
('bonprix.se', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5378', 'Prisvärt dammode i bonprix nätbutik!', 107, '', 0, '2017-01-25 14:48:14'),
('Illustrerad Vetenskap', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5911', 'Virtual Reality 3D-glasögon + Illustrerad Vetenskap för endast 69,50 kr', 108, 'images/58888afb2b1e44.39112374.jpg', 0, '2017-01-25 14:48:14'),
('I FORM', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5903', 'Beställ 4 nummer av I FORM och få Active Fit tights för endast 149,00 kr.', 109, 'images/58888b2aaa4617.34517669.jpg', 0, '2017-01-25 14:48:14'),
('Next Love', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5887', 'Next Love är en dating site som hjälper frånskilda och singelföräldrar att finna och skapa långsiktiga och givande förhållanden. ', 110, '', 0, '2017-01-25 14:48:14'),
('Aktiv Träning', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5861', 'Beställ Aktiv Träning och få en vinterträningsdpaket med LED-reflexer', 111, 'images/58888bc1484d78.92014572.jpg', 0, '2017-01-25 14:48:14'),
('Klassiska Bilar', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5854', '4 nummer av Klassiska bilar ', 112, 'images/58888bea0d55d8.71328624.jpg', 0, '2017-01-25 14:48:14'),
('Kamratposten', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5820', 'Få 9 nr av Kamratposten för bara 198 kr!', 113, 'images/58888c0c326152.42927692.jpg', 0, '2017-01-25 14:48:14'),
('Gör Det Själv', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5800', 'Beställ 2 nummer av Gör Det Själv og få en Nano Soft Shell jacka', 114, 'images/58888c32920fd2.53288635.jpg', 0, '2017-01-25 14:48:14'),
('PC-tidningen', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5794', 'PC-tidningen + Hawk M15 Drone', 115, 'images/58888c5329da50.99309634.jpg', 0, '2017-01-25 14:48:14'),
('Winorama', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5762', 'Winorama is a brand new online casino site.', 116, '', 0, '2017-01-25 14:48:14'),
('Digital FOTO', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5752', '2 nr av Bonnier Digital FOTO + Fotoväska eller Drone för 49,00 kr + 39,50 kr i porto och exp. Totalt 88,50 kr.', 117, 'images/58888ca674cf40.02738276.jpg', 0, '2017-01-25 14:48:14'),
('Zmarta.se', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=3815', 'Zmarta tips innan du lånar', 118, 'images/58888cd02b09a5.36380832.jpg', 0, '2017-01-25 14:48:14'),
('Tara', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5717', '5 nummer av Tara + skinnhandskar + leopardsjal för bara 149kr + porto', 119, 'images/58888cf4664b88.47823664.jpg', 0, '2017-01-25 14:48:14'),
('Bellabingo', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5037', 'Du får 100kr gratis att spela bingo med', 120, '', 0, '2017-01-25 14:48:14'),
('DanSmokes', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5599', 'Bli rökfri för alltid', 121, '', 0, '2017-01-25 14:48:14'),
('Lantliv', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5710', '6 nr av Lantliv för bara 249 kr + doftljus från Voluspa + porto & exp. avgift 39 kr.', 122, 'images/58888e9f203b96.45948784.jpg', 1, '2017-01-25 14:48:14'),
('Digital FOTO', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5691', 'Bluetooth-hörlura + 2 eller 8 nummer av Digital FOTO', 123, 'images/58888ec2e59bf8.23778965.jpg', 1, '2017-01-25 14:48:14'),
('National Geographic', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5671', 'Hasaki Omakase-knivset + 2 nummer av National Geographic för endast 49,50 kr.', 124, 'images/588893a821c0f0.45085226.jpg', 0, '2017-01-25 14:48:14'),
('Hem & Antik', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5665', '3nr av Hem & Antik + vacker skål från Rörstrand för endast 129 kr + porto!', 125, 'images/588893d3a13218.20683463.jpg', 0, '2017-01-25 14:48:14'),
('Gobokens bokklubb', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5664', 'Supersött välkomstpaket till din baby', 126, 'images/58889592b46451.50308176.jpg', 0, '2017-01-25 14:48:14'),
('Tara', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5651', '5 nummer av Tara + lyxiga produkter från The Body Shop för bara 149kr - totalt värde 520 kr!', 127, 'images/5888a7ae3365e9.39608430.jpg', 0, '2017-01-25 14:48:14'),
('Gör Det Själv', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5603', ' Beställ 2 nummer av Gör Det Själv og få en NOVAPLUS borrskruvdragare för 89,00 kr.!', 129, 'images/5888a80a622663.75238310.jpg', 0, '2017-01-25 14:48:14'),
('Kickerz', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=3469', 'Barn läser bättre med Kickerz!', 130, 'images/5888a859965c74.35734144.jpg', 0, '2017-01-25 14:48:14'),
('Ageras.se', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5595', 'Behöver du hjälp med årsredovisningen? - Ageras hjälper dig', 131, 'images/5888aeeb4beff4.70674806.png', 0, '2017-01-25 14:48:14'),
('Gobokens bokklubb', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5591', 'Gå med i Goboken och få et välkomstpaket utan extra kostnad.', 132, 'images/5888af22d13724.70513218.jpg', 0, '2017-01-25 14:48:14'),
('Amelia', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5589', 'Just nu: 7 nr av amelia + boken Fest på 30 min - spara 318 kr', 133, 'images/5888af473dedd0.66197302.jpg', 0, '2017-01-25 14:48:14'),
('PC-tidningen', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5584', 'Få ett par smarta Bluetooth-hörlurar + 3 eller 6 nummer av PC TIDNINGEN!', 134, 'images/5888af76d77c25.53275396.jpg', 0, '2017-01-25 14:48:14'),
('Allt i hemmet', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5564', 'Få 6 nr av Allt i hemmet + fint välkomstpaket för endast kr 159! Spara 681 kr.', 135, 'images/5888af9b96e635.61675298.png', 0, '2017-01-25 14:48:14'),
('Illustrerad Vetenskap', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5541', 'Få et Wi-Fi övervakningskamera + 2 nummer av Illustrerad vetenskap för endast 79,50 kr', 136, 'images/5888afc00913a0.89145936.jpg', 0, '2017-01-25 14:48:14'),
('Gård & Torp', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5535', 'Få 5 nr av Gård & Torp + 2 muggar från Rörstrand för bara 199 kr!', 139, 'images/5888f6eabc67c3.55746983.jpg', 0, '2017-01-25 19:05:14'),
('Illustrerad Vetenskap', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5531', 'Få en Taiga Pine fiberjacka  + 2 nummer av Illustrerad vetenskap för endast 59,50 kr', 140, 'images/5888f712ddcec7.77752971.jpg', 0, '2017-01-25 19:05:54'),
('Fokuslån - Låna', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5519', 'Lånet med fokus på dina behov', 141, 'images/5888f9989c12e5.43697701.jpg', 0, '2017-01-25 19:16:40'),
('Ambassador Watches', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5502', 'Ambassadorwatches.com is a new, swedish watch brand with focus on details.', 142, 'images/588936ad15ed08.45947651.jpg', 0, '2017-01-25 23:37:17'),
('Grönt te & GlucoTrim', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5500', 'Gå ned i vikt med Grönt te & GlucoTrim+ - just nu 600 kr rabatt!', 143, 'images/588936d995f077.49609010.jpg', 0, '2017-01-25 23:38:01'),
('Tara', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5498', '5 nummer av Tara + snygg Ceannisväska & lyxpaket från Clarins - bara 149 kr!', 144, 'images/58893704a944e9.43486313.jpg', 0, '2017-01-25 23:38:44'),
('Mama', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5497', '6 nr av Mama + snyggt yogalinne + bodylotion & showergel  - spara i allt 589 kr ', 145, 'images/58893726a0c593.31325530.jpg', 0, '2017-01-25 23:39:18'),
('Gör Det Själv', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5487', '2 nr av Gör Det Själv + 180 grader linjelaser för 89,00 kr + 49,00 kr. i porto och exp. Totalt 138,00 kr.\r\n', 146, 'images/5889376328dad8.98744827.jpg', 0, '2017-01-25 23:40:19'),
('I FORM', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5459', 'Beställ 4 nummer av I FORM och få en Kari Traa svala träningströja', 147, 'images/5889379012c794.90007489.jpg', 0, '2017-01-25 23:41:04'),
('Digital FOTO', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5477', 'Snygg klocka med inbyggd kamera + 2 eller 8 nummer av Digital FOTO', 148, 'images/588937b2004021.81474921.jpg', 0, '2017-01-25 23:41:38'),
('Aktiv Träning', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5473', 'Beställ Aktiv Träning och få en löpartröja från Active Fit!', 149, 'images/588937d20b4746.77438785.jpg', 0, '2017-01-25 23:42:10'),
('Freesmoke.se', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5469', 'E-cigarett för 0 kr – ENDAST idag!', 150, 'images/58893814265c36.30453216.jpg', 0, '2017-01-25 23:43:16'),
('Vitacea', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5370', 'Testa svensktillverkat kosttilskott - Vitacea. Få 50% rabatt.', 151, 'images/58893858ce6a58.25014138.png', 0, '2017-01-25 23:44:24'),
('Ribella SE', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5372', 'Långt hår på 5 minuter - se sommarens erbjudande', 152, 'images/5889388a1c0282.36924425.jpg', 0, '2017-01-25 23:45:14'),
('NanoKredit', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5367', 'Nanokredit: Tryggt, tydligt och enkelt', 153, 'images/588938a929c260.74643719.jpg', 0, '2017-01-25 23:45:45'),
('NanoFlex', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5366', 'Låna 500-10.000 kr. i 15-90 dagar.', 154, '', 0, '2017-01-25 23:46:20'),
('Allt om Trädgård', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5357', '4 nummer av Allt om Trädgård', 155, 'images/588938f27d2636.75702569.jpg', 0, '2017-01-25 23:46:58'),
('BookBeat SE', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5311', 'Njut av en god bok genom mobilen med BookBeat! Lyssna fritt i 2 veckor!', 156, 'images/5889391e98d124.16656641.png', 0, '2017-01-25 23:47:42'),
('iGame Sweden', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5293', 'Enarmad bandit, poker, casino? iGame har nått för ALLA', 157, 'images/58893941272c89.25602588.jpg', 0, '2017-01-25 23:48:17'),
('Knivbrev', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5292', 'Få dina knivar slipade snabbt och professionellt med Knivbrev', 158, 'images/5889397a28de22.33186949.jpg', 0, '2017-01-25 23:49:14'),
('Match.com', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=5205', 'Med match.com kan du helt kostnadsfritt hitta singlar i ditt område', 159, 'images/588939a0658650.72563083.jpg', 0, '2017-01-25 23:49:52'),
('bostadsfinder.se', 'https://online.adservicemedia.dk/cgi-bin/click.pl?pid=14140&cid=4894', 'Sök gratis bland 30.000 lediga bostäder', 160, 'images/5889df43ba8d00.76119493.jpg', 0, '2017-01-26 11:36:35'),
('Digital ocean', 'https://m.do.co/c/56be244e1ebb', 'Få 100 kronor när du skapar ett konto hos DigitalOcean!', 182, 'images/588d11b3be0820.08392693.png', 0, '2017-01-28 21:48:35'),
('test', 'www.google.se', 'Detta är ett test', 183, '', 0, '2017-02-17 14:03:10');

-- --------------------------------------------------------

--
-- Tabellstruktur `Payments`
--

CREATE TABLE `Payments` (
  `ID` int(11) NOT NULL,
  `CompanyDivision` int(11) NOT NULL,
  `Paid` tinyint(1) NOT NULL,
  `Type` int(11) NOT NULL,
  `PaidDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `ReleaseNotes`
--

CREATE TABLE `ReleaseNotes` (
  `ID` int(11) NOT NULL,
  `Caption` varchar(128) NOT NULL,
  `Message` text NOT NULL,
  `Date` date NOT NULL,
  `Version` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `ReleaseNotes`
--

INSERT INTO `ReleaseNotes` (`ID`, `Caption`, `Message`, `Date`, `Version`) VALUES
(1, 'Test', 'Ett testmeddelande', '2017-09-23', '1.0'),
(2, 'Nytt!', 'Nya grejer vettu', '2017-09-24', '1.01');

-- --------------------------------------------------------

--
-- Tabellstruktur `ShoppingBag`
--

CREATE TABLE `ShoppingBag` (
  `User` int(11) NOT NULL,
  `Offer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `Subscriptions`
--

CREATE TABLE `Subscriptions` (
  `SubID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `SubDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `Subscriptions`
--

INSERT INTO `Subscriptions` (`SubID`, `UserID`, `CompanyID`, `SubDate`) VALUES
(67, 144, 48, '2017-10-02 19:44:10'),
(70, 144, 35, '2017-10-02 20:50:19'),
(78, 142, 52, '2017-10-10 14:09:46'),
(79, 142, 53, '2017-10-10 14:09:52'),
(80, 116, 35, '2017-10-10 14:13:15');

-- --------------------------------------------------------

--
-- Tabellstruktur `Users`
--

CREATE TABLE `Users` (
  `ID` int(11) NOT NULL,
  `CS` int(11) NOT NULL,
  `Fname` varchar(128) DEFAULT NULL,
  `Gender` int(11) NOT NULL COMMENT '1= Man 2 = Kvinna 3 = Övrigt',
  `Username` varchar(128) DEFAULT NULL,
  `Password` varchar(256) DEFAULT NULL,
  `Email` varchar(256) DEFAULT NULL,
  `BirthDay` date NOT NULL,
  `verify` varchar(128) NOT NULL DEFAULT '0' COMMENT '0 = No 1=Yes',
  `MailVerify` varchar(128) DEFAULT NULL,
  `Priviledge` int(11) DEFAULT '0' COMMENT '0 = standard user 1=admin',
  `RegisteredDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `Users`
--

INSERT INTO `Users` (`ID`, `CS`, `Fname`, `Gender`, `Username`, `Password`, `Email`, `BirthDay`, `verify`, `MailVerify`, `Priviledge`, `RegisteredDate`) VALUES
(106, 7, 'Johan', 1, 'johlun', '557a14a34c36e2b9170c57332c64b86de5a907655fcafcaa85d1134aa64bf0c6', 'lundgren.johan@yahoo.se', '1999-02-09', '1', 'eCzQGPw4OMws2NVzMQdN5zC43pm2mZzs', 0, '2017-02-15 09:31:02'),
(111, 7, 'Daniel', 1, 'daniel', '75e3436b6f355eda9571b9a2672af6584221c6874b75aa4236b4286226de8921', 'daniel.windhede@monocodigo.se', '1999-09-19', '1', 'bho06kE30pntSq9ziOhxSMrUH9HUHJ6s', 0, '2017-03-14 17:13:13'),
(116, 10, 'Marcus', 1, 'mackilanu', 'd39b70b4f7d51ded5f13ff04c4ca9ca7c4a7c45eeb21bd39d218e5492321243b', 'mackilanu@gmail.coms', '1999-11-14', '1', 'fxXAmm7wyu7kDdXHF7mh5JsmAp6ElftB', 0, '2017-03-27 15:49:49'),
(117, 3, 'Gitte ', 2, 'GitteChristensen ', 'fd0e44fece6d076623b6823cdea487a8922542632bb83435c34025e27a507363', 'lovemamma1@hotmail.com', '1991-01-16', '1', 'yyFbmYj3BGWjoJjga6YUegKuaVThykc8', 0, '2017-03-29 13:57:09'),
(119, 10, 'David', 1, 'davidsteijner', '252959d9a83610015e736279867af57c3fbcf839c686b4b5fac732c2d802527e', 'david@steijner.com', '1988-04-02', '1', 'P4uSMQmpaszu9z7luTgbg8yNR0pI0xu1', 0, '2017-03-31 16:32:32'),
(122, 9, 'Peter', 1, 'Peter62', 'b6569d01a96510afbc9ae6f0e93f10b7bff35b052a9d48a84f5ee1d4350f769e', 'peter.gockis@gmail.com', '1962-06-07', '1', 'YTthgRb615k7pmbmqdsNNQmUl0ftLEMQ', 0, '2017-04-02 15:15:32'),
(123, 10, 'johanna', 2, 'johannis', '860b632195b1d34a448f8b00863c291edbe7aeb1b7831232e55752e81c9853b1', 'johannandersson86@gmail.com', '1986-03-01', '1', 'W0wqa175ppM4EfYUDMLvQF1tZuU9seDJ', 0, '2017-04-02 15:49:01'),
(124, 10, 'linus', 1, 'linuser', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', 'linus.eriksson15@itgksd.se', '1999-12-07', '1', 'OXoulkY2ejozB92h1DgQtgeq7WGuWTHE', 0, '2017-04-06 08:56:48'),
(125, 3, 'Johan', 1, 'bobo89', '4ca128e02ebf7169c2f824f5532a4aedaa705fd92fe47f1dfeeb8a2a9f3a1dce', 'bobo1989@hotmail.se', '1989-12-06', '0', 'pKbQc7QJTDk4Inkay7t3JPWb1xf5Zx2Q', 0, '2017-04-06 09:52:07'),
(126, 335, 'Teresa ', 2, 'Teresa', '7c56f671039853db69e12acad572da9c2a367496606117bade690d4f290125ea', 'Agnetanykanen@hotmail.com', '1986-03-14', '1', 'KsjduatF5hkrTeWFvxG0kmhsRkeoq9Iw', 0, '2017-04-07 10:25:55'),
(128, 3, 'Peter ', 1, 'Artaxinho', 'a6145d5b62a7799de4d365c9fe8ceafc4599f4d25cb1a1290c255b7ecda029b7', 'peterknarvik@hotmail.com', '1990-09-02', '1', 'XA3gV9QoO9aegHcdvt8VPj6Ouuqq3rYh', 0, '2017-04-11 20:25:37'),
(129, 3, 'Marcus ', 1, 'NoTech ', '9f4c121d60cf553ad8e1b73f6c02ad2689b454075712d1665f72685bc93044c2', 'crazy.marcus1@gmail.com', '1991-01-12', '1', 'YyQe2k5unDVP0bdK9z1tOpyu0dnH7lJD', 0, '2017-04-13 00:28:22'),
(130, 3, 'Mikael Johansson', 1, 'Agielpower', '9dab7520865a5ebfb0765e5fd56eb95d94e453c0636c0d5ca67d9cf4c0c50cd7', 'agiel@macmail.se', '1980-01-03', '1', 'eJVV5DUpglRu0n0E3VQeCToriAgv79Tb', 0, '2017-04-13 07:09:37'),
(131, 102, 'Luth', 1, 'Sebastian', '55887bb78bbfd70aa0f9a6aed501df3f1cba2495f39f47ce796658701292e9fb', 'sebastian.gredin@hotmail.com', '1994-03-28', '1', 'pL9IUIWXDeA7EulK7hslIOtL7PNI6eFZ', 0, '2017-04-13 14:37:48'),
(132, 102, 'Annika', 2, 'Ankaquack', '769d0bf9de119fbb7ee67b761c0a8cf812d447c10673c7f18856b5a87804cf30', 'ankanquack7@gmail.com', '1983-07-06', '1', 'aeNxbQfHeWPiSH3Kq8wRXZvQDjHrFuI2', 0, '2017-04-14 04:53:21'),
(133, 102, 'Ricky', 1, 'RickyKlasson', 'e139f1595d457abd92d91413476e92d7c8df6fad5c6d1afab76c69dcc4cecb5d', 'mrklasson@gmail.com', '1994-04-28', '1', '4MapvrUF1JbQbL1oEj16NhzzIUtBxatI', 0, '2017-04-14 07:17:41'),
(134, 10, 'Henrik', 1, 'henkek', '5870a50d70797b5e032e3789ac5a76fa55a3549cc6d5e8aa949f33c4bd5bb4c2', 'henke@mail.org', '1985-05-29', '0', 'iPpjWjoK32e4mXKL22P2yz05ipAqwaTw', 0, '2017-04-15 17:25:45'),
(135, 102, 'Mikael', 3, 'miky00', 'e4a1e5f0f3e6f06d951d0201703fe431e3362bccbdd147332d70228b7a76a4fa', 'magetrue@gmail.com', '1969-04-04', '1', 'QjrS9UgUk8v7Y3INijQBJ95nF7NIXfu1', 0, '2017-04-19 23:02:43'),
(136, 9, 'Marcus', 1, 'hejasn', 'e4a1e5f0f3e6f06d951d0201703fe431e3362bccbdd147332d70228b7a76a4fa', 'wowpower@outlook.com', '1999-11-14', '0', 'iDLvUK182VN7y8v5oHxq8z54l81Khzxp', 0, '2017-04-23 10:59:28'),
(137, 105, 'Marcus', 1, 'jheuoijio', 'e4a1e5f0f3e6f06d951d0201703fe431e3362bccbdd147332d70228b7a76a4fa', 'jios@hjeo.se', '1999-11-14', '0', '5YkN6YRDrJixbRA47qhclrgB5WrkIghN', 0, '2017-04-23 11:28:47'),
(138, 9, 'Albin', 1, 'SOLIDDD', '9cd7843461960c250072172747c1ca7bf9c48cca46ebb494effcfcdf311c489b', 'albinkristiansson19@hotmail.com', '1999-03-15', '1', '7qFUozBIYOEBmueatHx9DvCY7zdncHTI', 0, '2017-04-23 14:19:42'),
(139, 9, 'Måns ', 1, 'Månsiboy ', '1a7e3faefc7bdbeb6a8d6abeec6de25e4e56fa6e3635a80d496e2053d54dd565', 'manskristiansson11@hotmail.com', '2001-02-25', '1', 'TDwtUO2nshtFqm7YzKQAPzWP3rl0Gzkt', 0, '2017-04-23 14:19:43'),
(140, 102, 'Hyacint', 3, 'Hyacint', 'b5a44d1b5ea8e41be5297fa051b74d642a9d44be1fee1c7116a37dd19b145688a', 'hyacintienburk@gmail.com', '1980-01-01', '0', 'w8KjD48PxHf8kZrDXyYg2zAsGStL4vNH', 0, '2017-04-24 13:53:10'),
(142, 3, 'Sören', 1, 'Sorenito', '2be4d9bbeb574e8cea7b600ae61683dbf0f47e7189ab968e416554a4b34c5050', 'ceonozia@gmail.com', '1982-12-08', '1', 'ZetSu0npRx7x7vZbZhMQp1EkUGUDmmmX', 0, '2017-04-24 15:52:20'),
(143, 241, 'Evelina ', 2, 'EVEnation', '20723444547a202975986bcfc3cf84e883523b2159bd0c8c6e20339aa529a325', 'evenation2@live.se', '1992-02-14', '0', 'YLkNL2TPWrcjw1GpxiGGDBNMCUbQavpl', 0, '2017-04-25 14:49:30'),
(144, 10, 'Martin', 1, 'Martin', '2527823bfc49b53b6bf7d59e0dde8f78db10337345c441a26b3bc50dbf7c0f57', 'marre9904@gmail.com', '1999-04-27', '1', '425GunP0g2Q9fwn0LPM9gCwCnvsfPtytFcX13Q6pVA05qnEyoFThqWmDiaGafhSYmjVY1K3ijDpADi21ewahSZt6sQQDSH9ydrACBRZ6rSSN7jb2M6nDmarvmhjQgEsV', 0, '2017-09-21 20:15:33'),
(145, 104, 'Marcus', 1, 'hejsanb', 'd39b70b4f7d51ded5f13ff04c4ca9ca7c4a7c45eeb21bd39d218e5492321243b', 'mackilanu@sasa.se', '2017-01-01', '0', 'HQAYhoNAE8fhU6hNt4XbB9W0T1U0TuehuE0XXgKbdNsjStZt6N4cLWAa4KCRxa4kdurfxPOPZTxZpz9WFnjJDLoihVLk2iPLGTlTyowABdsRnWym7nDW5jtJdSkOmeV9', 0, '2017-09-23 15:11:54'),
(146, 7, 'Linda', 2, 'lindanilsson', 'ee04a5eca5c45ad31075d6f2e7deb331347223b656245b014ad8c2d035c404f1', 'lindanilsson_88@hotmail.com', '1988-12-13', '1', 'SjRB3jfmZcYBSeBiRyOdEMvybovs5y5Qh1XEosS9GLMNvwlNcP3Nq8po5nrOgMHhbkTfUGH2OTnRir4iXHkeuVUr5lZ81lsZzmPyl0GeSbkSAzNEQxv2UvGa2wjFaWLg', 0, '2017-09-27 10:50:21'),
(147, 103, 'Marcus', 1, 'hejsan', 'e4a1e5f0f3e6f06d951d0201703fe431e3362bccbdd147332d70228b7a76a4fa', 'marcus.skoghall@hotmail.com', '2017-01-01', '0', 'KQMqkgO4LEpyPYRz4JTrZocw4eZ8VRkW9HkZR9quVkMygFqlnibZxHtxMLoPd7Yhd4vUv8Hc5xV1GrLxR4DY0V7UMZluzZDcKhmnJShIpQhqVGZDGyl6kS7yNqqIIwXH', 0, '2017-10-11 11:20:58');

-- --------------------------------------------------------

--
-- Tabellstruktur `UserTraffic`
--

CREATE TABLE `UserTraffic` (
  `ID` int(11) NOT NULL,
  `User` int(11) NOT NULL,
  `LoginTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `UserTraffic`
--

INSERT INTO `UserTraffic` (`ID`, `User`, `LoginTime`) VALUES
(4, 116, '2017-08-27 12:45:02'),
(5, 116, '2017-08-27 13:42:48'),
(6, 116, '2017-08-27 14:56:44'),
(7, 116, '2017-08-27 16:52:06'),
(8, 116, '2017-08-27 17:40:55'),
(9, 116, '2017-08-27 17:42:21'),
(10, 116, '2017-08-27 18:18:50'),
(11, 142, '2017-09-07 19:00:48'),
(12, 142, '2017-09-07 19:02:08'),
(13, 116, '2017-09-07 19:17:21'),
(14, 116, '2017-09-07 19:19:22'),
(15, 116, '2017-09-07 19:22:14'),
(16, 116, '2017-09-07 19:24:29'),
(17, 116, '2017-09-07 19:26:45'),
(18, 116, '2017-09-08 11:02:19'),
(19, 116, '2017-09-08 14:28:30'),
(20, 116, '2017-09-11 07:11:53'),
(21, 116, '2017-09-15 11:47:21'),
(22, 116, '2017-09-21 08:32:31'),
(23, 142, '2017-09-21 08:34:34'),
(24, 142, '2017-09-21 09:35:18'),
(25, 142, '2017-09-21 09:46:47'),
(26, 116, '2017-09-21 09:56:43'),
(27, 116, '2017-09-21 14:16:20'),
(28, 116, '2017-09-21 14:27:33'),
(29, 116, '2017-09-21 14:40:57'),
(30, 116, '2017-09-21 19:21:04'),
(31, 144, '2017-09-21 20:16:44'),
(32, 142, '2017-09-21 21:47:50'),
(33, 116, '2017-09-22 20:41:04'),
(34, 116, '2017-09-23 15:11:21'),
(35, 116, '2017-09-23 16:06:32'),
(36, 142, '2017-09-23 20:16:41'),
(37, 116, '2017-09-24 13:29:04'),
(38, 116, '2017-09-24 13:32:22'),
(39, 116, '2017-09-24 13:48:51'),
(40, 142, '2017-09-24 14:31:55'),
(41, 116, '2017-09-25 08:38:15'),
(42, 142, '2017-09-25 11:14:13'),
(43, 142, '2017-09-25 11:16:51'),
(44, 142, '2017-09-25 18:23:45'),
(45, 116, '2017-09-25 18:29:52'),
(46, 142, '2017-09-25 18:49:02'),
(47, 116, '2017-09-25 18:49:21'),
(48, 116, '2017-09-25 19:05:50'),
(49, 116, '2017-09-25 19:39:55'),
(50, 116, '2017-09-25 20:32:05'),
(51, 116, '2017-09-25 20:33:55'),
(52, 116, '2017-09-26 19:53:34'),
(53, 116, '2017-09-27 08:04:35'),
(54, 142, '2017-09-27 09:37:02'),
(55, 142, '2017-09-28 13:47:43'),
(56, 116, '2017-09-28 13:55:55'),
(57, 116, '2017-09-28 14:51:31'),
(58, 116, '2017-09-28 16:41:57'),
(59, 142, '2017-09-28 16:42:21'),
(60, 116, '2017-09-28 17:12:42'),
(61, 142, '2017-09-28 17:38:55'),
(62, 142, '2017-09-28 17:48:28'),
(63, 116, '2017-09-28 17:48:48'),
(64, 142, '2017-09-28 17:50:02'),
(65, 116, '2017-09-28 18:03:23'),
(66, 116, '2017-09-28 18:06:01'),
(67, 116, '2017-09-28 18:13:00'),
(68, 116, '2017-09-28 18:15:50'),
(69, 116, '2017-09-28 18:19:22'),
(70, 116, '2017-09-28 18:27:55'),
(71, 116, '2017-09-28 19:41:26'),
(72, 116, '2017-09-28 20:17:56'),
(73, 116, '2017-09-28 20:19:39'),
(74, 116, '2017-09-28 20:26:02'),
(75, 116, '2017-09-28 21:45:50'),
(76, 116, '2017-09-28 21:54:15'),
(77, 116, '2017-09-28 22:21:17'),
(78, 116, '2017-09-28 22:21:56'),
(79, 116, '2017-09-29 07:48:05'),
(80, 116, '2017-09-29 07:56:36'),
(81, 142, '2017-09-29 08:05:52'),
(82, 142, '2017-09-29 09:01:46'),
(83, 146, '2017-09-29 09:36:30'),
(84, 116, '2017-09-29 09:36:37'),
(85, 116, '2017-09-29 09:58:35'),
(86, 116, '2017-09-29 10:13:19'),
(87, 116, '2017-09-29 10:13:36'),
(88, 142, '2017-09-29 10:25:58'),
(89, 116, '2017-09-29 10:54:34'),
(90, 116, '2017-09-29 11:11:33'),
(91, 116, '2017-09-29 11:40:32'),
(92, 142, '2017-09-29 12:27:11'),
(93, 116, '2017-09-29 13:00:33'),
(94, 116, '2017-09-29 13:19:03'),
(95, 116, '2017-09-29 13:25:17'),
(96, 142, '2017-09-29 13:44:49'),
(97, 116, '2017-09-29 14:03:16'),
(98, 116, '2017-09-29 14:04:13'),
(99, 116, '2017-09-29 14:05:56'),
(100, 116, '2017-09-29 14:07:00'),
(101, 116, '2017-09-29 15:16:06'),
(102, 116, '2017-09-29 15:20:37'),
(103, 116, '2017-09-29 15:24:42'),
(104, 142, '2017-09-29 15:54:33'),
(105, 116, '2017-09-29 15:55:27'),
(106, 116, '2017-09-29 17:03:51'),
(107, 116, '2017-09-29 17:09:23'),
(108, 116, '2017-09-29 17:11:10'),
(109, 116, '2017-09-29 17:42:51'),
(110, 142, '2017-09-29 18:05:12'),
(111, 116, '2017-09-29 20:15:18'),
(112, 116, '2017-09-29 21:12:58'),
(113, 116, '2017-09-29 21:13:25'),
(114, 116, '2017-09-29 21:24:17'),
(115, 116, '2017-09-29 21:33:55'),
(116, 116, '2017-09-29 21:34:07'),
(117, 116, '2017-09-29 22:17:35'),
(118, 116, '2017-09-29 22:47:24'),
(119, 116, '2017-09-30 10:12:30'),
(120, 116, '2017-09-30 10:13:10'),
(121, 116, '2017-09-30 10:13:30'),
(122, 116, '2017-09-30 10:15:38'),
(123, 116, '2017-09-30 10:18:42'),
(124, 116, '2017-09-30 10:26:59'),
(125, 116, '2017-09-30 10:27:28'),
(126, 116, '2017-09-30 10:28:16'),
(127, 116, '2017-09-30 10:28:46'),
(128, 116, '2017-09-30 10:30:23'),
(129, 116, '2017-09-30 10:31:27'),
(130, 116, '2017-09-30 10:32:31'),
(131, 116, '2017-09-30 10:46:46'),
(133, 116, '2017-09-30 12:14:38'),
(134, 116, '2017-09-30 13:53:41'),
(135, 116, '2017-09-30 14:41:55'),
(136, 116, '2017-09-30 16:01:52'),
(137, 142, '2017-09-30 18:43:03'),
(138, 142, '2017-09-30 18:43:45'),
(139, 116, '2017-09-30 20:20:52'),
(140, 142, '2017-09-30 23:15:59'),
(141, 142, '2017-10-01 11:41:45'),
(142, 116, '2017-10-01 13:21:45'),
(143, 116, '2017-10-01 13:43:23'),
(144, 142, '2017-10-01 13:43:23'),
(145, 142, '2017-10-01 14:30:18'),
(146, 116, '2017-10-01 14:38:28'),
(147, 142, '2017-10-01 15:09:54'),
(148, 116, '2017-10-01 15:09:56'),
(149, 116, '2017-10-01 15:11:41'),
(150, 116, '2017-10-01 15:16:26'),
(151, 142, '2017-10-01 15:17:01'),
(152, 116, '2017-10-01 15:22:39'),
(153, 116, '2017-10-01 16:31:34'),
(154, 142, '2017-10-01 19:45:00'),
(155, 116, '2017-10-02 06:57:59'),
(156, 116, '2017-10-02 07:33:31'),
(157, 116, '2017-10-02 07:51:04'),
(158, 144, '2017-10-02 10:46:58'),
(159, 144, '2017-10-02 10:47:32'),
(160, 116, '2017-10-02 10:48:29'),
(161, 116, '2017-10-02 16:46:27'),
(162, 116, '2017-10-02 19:06:46'),
(163, 144, '2017-10-02 19:08:06'),
(164, 116, '2017-10-02 19:46:12'),
(165, 116, '2017-10-02 19:47:45'),
(166, 116, '2017-10-02 19:50:02'),
(167, 116, '2017-10-02 21:48:00'),
(168, 142, '2017-10-02 21:51:06'),
(169, 142, '2017-10-02 21:59:27'),
(170, 142, '2017-10-02 22:00:32'),
(171, 142, '2017-10-02 22:22:06'),
(172, 142, '2017-10-02 22:33:46'),
(173, 142, '2017-10-02 22:42:57'),
(174, 142, '2017-10-02 22:55:10'),
(175, 142, '2017-10-02 23:02:56'),
(176, 142, '2017-10-02 23:06:12'),
(177, 116, '2017-10-03 07:57:46'),
(178, 116, '2017-10-03 08:09:10'),
(179, 116, '2017-10-03 09:07:08'),
(180, 142, '2017-10-03 09:26:59'),
(181, 142, '2017-10-03 09:27:30'),
(182, 142, '2017-10-03 09:48:15'),
(183, 116, '2017-10-03 12:26:27'),
(184, 142, '2017-10-03 13:05:52'),
(185, 146, '2017-10-03 13:13:50'),
(186, 116, '2017-10-03 15:24:44'),
(187, 146, '2017-10-03 16:18:46'),
(188, 146, '2017-10-03 16:22:40'),
(189, 146, '2017-10-03 16:24:15'),
(190, 146, '2017-10-03 17:31:04'),
(191, 142, '2017-10-03 22:44:49'),
(192, 116, '2017-10-04 07:11:42'),
(193, 116, '2017-10-04 07:46:42'),
(194, 116, '2017-10-04 08:26:35'),
(195, 116, '2017-10-04 09:24:26'),
(196, 116, '2017-10-04 09:25:47'),
(197, 116, '2017-10-04 09:28:11'),
(198, 116, '2017-10-04 10:05:49'),
(199, 142, '2017-10-04 10:12:34'),
(200, 116, '2017-10-04 10:23:38'),
(201, 116, '2017-10-04 13:31:01'),
(202, 116, '2017-10-04 13:32:57'),
(203, 116, '2017-10-04 13:33:59'),
(204, 116, '2017-10-04 16:28:04'),
(205, 116, '2017-10-04 17:22:26'),
(206, 116, '2017-10-04 17:24:09'),
(207, 116, '2017-10-04 18:02:45'),
(208, 116, '2017-10-05 07:27:49'),
(209, 116, '2017-10-05 07:42:02'),
(210, 116, '2017-10-05 07:52:34'),
(211, 116, '2017-10-05 07:53:14'),
(212, 116, '2017-10-05 18:13:59'),
(213, 116, '2017-10-06 06:39:45'),
(214, 142, '2017-10-06 10:04:29'),
(215, 116, '2017-10-06 10:15:17'),
(216, 116, '2017-10-06 16:04:31'),
(217, 116, '2017-10-06 19:20:45'),
(218, 142, '2017-10-07 07:38:10'),
(219, 116, '2017-10-07 11:27:06'),
(220, 142, '2017-10-07 21:03:50'),
(221, 116, '2017-10-08 13:21:21'),
(222, 116, '2017-10-08 14:51:41'),
(223, 116, '2017-10-09 10:52:10'),
(224, 142, '2017-10-10 14:09:35'),
(225, 116, '2017-10-10 14:11:55'),
(226, 116, '2017-10-10 16:47:52'),
(227, 116, '2017-10-10 17:23:07'),
(228, 116, '2017-10-10 19:07:35'),
(229, 116, '2017-10-10 19:07:52'),
(230, 142, '2017-10-11 08:20:19'),
(231, 116, '2017-10-11 08:21:07'),
(232, 116, '2017-10-11 08:28:14'),
(233, 142, '2017-10-11 09:41:14'),
(234, 116, '2017-10-11 09:54:21'),
(235, 116, '2017-10-11 13:14:05'),
(236, 116, '2017-10-11 13:18:51'),
(237, 142, '2017-10-11 13:28:32'),
(238, 116, '2017-10-11 13:28:33'),
(239, 116, '2017-10-11 14:00:02');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`CatgoryID`);

--
-- Index för tabell `Companies`
--
ALTER TABLE `Companies`
  ADD PRIMARY KEY (`ID`,`CityState`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `Category` (`Category`),
  ADD KEY `CityState` (`CityState`);

--
-- Index för tabell `CompanyDivision`
--
ALTER TABLE `CompanyDivision`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Company` (`Company`),
  ADD KEY `CS` (`CS`);

--
-- Index för tabell `CompanyUsers`
--
ALTER TABLE `CompanyUsers`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Company` (`Company`);

--
-- Index för tabell `Company_files`
--
ALTER TABLE `Company_files`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CompanyID` (`CompanyID`),
  ADD KEY `CompanyID_2` (`CompanyID`);

--
-- Index för tabell `Company_post`
--
ALTER TABLE `Company_post`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Company` (`Company`);

--
-- Index för tabell `Country`
--
ALTER TABLE `Country`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `CS`
--
ALTER TABLE `CS`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CityState` (`CityState`),
  ADD KEY `Country` (`Country`);

--
-- Index för tabell `FavouriteCompany`
--
ALTER TABLE `FavouriteCompany`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User` (`User`),
  ADD KEY `Company` (`Company`);

--
-- Index för tabell `Foretagssida`
--
ALTER TABLE `Foretagssida`
  ADD PRIMARY KEY (`ID`,`CompanyID`),
  ADD KEY `CompanyID` (`CompanyID`);

--
-- Index för tabell `Likes`
--
ALTER TABLE `Likes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User` (`User`),
  ADD KEY `PostID` (`PostID`),
  ADD KEY `CompanyID` (`CompanyID`);

--
-- Index för tabell `MyOffers`
--
ALTER TABLE `MyOffers`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Offer` (`Offer`),
  ADD KEY `User` (`User`);

--
-- Index för tabell `Offers`
--
ALTER TABLE `Offers`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CompanyID` (`CompanyID`);

--
-- Index för tabell `Offer_CS`
--
ALTER TABLE `Offer_CS`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CS` (`CS`),
  ADD KEY `Offer` (`Offer`);

--
-- Index för tabell `OnlineOffers`
--
ALTER TABLE `OnlineOffers`
  ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `Payments`
--
ALTER TABLE `Payments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CompanyDivision` (`CompanyDivision`);

--
-- Index för tabell `ReleaseNotes`
--
ALTER TABLE `ReleaseNotes`
  ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `ShoppingBag`
--
ALTER TABLE `ShoppingBag`
  ADD KEY `Offer` (`Offer`),
  ADD KEY `User` (`User`);

--
-- Index för tabell `Subscriptions`
--
ALTER TABLE `Subscriptions`
  ADD PRIMARY KEY (`SubID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `CompanyID` (`CompanyID`);

--
-- Index för tabell `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`ID`,`CS`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `CS` (`CS`);

--
-- Index för tabell `UserTraffic`
--
ALTER TABLE `UserTraffic`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User` (`User`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `Categories`
--
ALTER TABLE `Categories`
  MODIFY `CatgoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT för tabell `Companies`
--
ALTER TABLE `Companies`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Företagets ID', AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT för tabell `CompanyDivision`
--
ALTER TABLE `CompanyDivision`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `CompanyUsers`
--
ALTER TABLE `CompanyUsers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `Company_files`
--
ALTER TABLE `Company_files`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT för tabell `Company_post`
--
ALTER TABLE `Company_post`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT för tabell `Country`
--
ALTER TABLE `Country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT för tabell `CS`
--
ALTER TABLE `CS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Användarens personliga id', AUTO_INCREMENT=627;
--
-- AUTO_INCREMENT för tabell `FavouriteCompany`
--
ALTER TABLE `FavouriteCompany`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `Foretagssida`
--
ALTER TABLE `Foretagssida`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT för tabell `Likes`
--
ALTER TABLE `Likes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;
--
-- AUTO_INCREMENT för tabell `MyOffers`
--
ALTER TABLE `MyOffers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1677;
--
-- AUTO_INCREMENT för tabell `Offers`
--
ALTER TABLE `Offers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT för tabell `Offer_CS`
--
ALTER TABLE `Offer_CS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT för tabell `OnlineOffers`
--
ALTER TABLE `OnlineOffers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;
--
-- AUTO_INCREMENT för tabell `Payments`
--
ALTER TABLE `Payments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `ReleaseNotes`
--
ALTER TABLE `ReleaseNotes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT för tabell `Subscriptions`
--
ALTER TABLE `Subscriptions`
  MODIFY `SubID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT för tabell `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
--
-- AUTO_INCREMENT för tabell `UserTraffic`
--
ALTER TABLE `UserTraffic`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;
--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `Companies`
--
ALTER TABLE `Companies`
  ADD CONSTRAINT `Companies_ibfk_3` FOREIGN KEY (`Category`) REFERENCES `Categories` (`CatgoryID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Companies_ibfk_4` FOREIGN KEY (`CityState`) REFERENCES `CS` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restriktioner för tabell `CompanyDivision`
--
ALTER TABLE `CompanyDivision`
  ADD CONSTRAINT `CompanyDivision_ibfk_1` FOREIGN KEY (`Company`) REFERENCES `Companies` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `CompanyUsers`
--
ALTER TABLE `CompanyUsers`
  ADD CONSTRAINT `CompanyUsers_ibfk_1` FOREIGN KEY (`Company`) REFERENCES `Companies` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `Company_files`
--
ALTER TABLE `Company_files`
  ADD CONSTRAINT `Company_files_ibfk_1` FOREIGN KEY (`CompanyID`) REFERENCES `Companies` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `Company_post`
--
ALTER TABLE `Company_post`
  ADD CONSTRAINT `Company_post_ibfk_1` FOREIGN KEY (`Company`) REFERENCES `Companies` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `CS`
--
ALTER TABLE `CS`
  ADD CONSTRAINT `CS_ibfk_1` FOREIGN KEY (`Country`) REFERENCES `Country` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restriktioner för tabell `FavouriteCompany`
--
ALTER TABLE `FavouriteCompany`
  ADD CONSTRAINT `FavouriteCompany_ibfk_1` FOREIGN KEY (`Company`) REFERENCES `Companies` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FavouriteCompany_ibfk_2` FOREIGN KEY (`User`) REFERENCES `Users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `Foretagssida`
--
ALTER TABLE `Foretagssida`
  ADD CONSTRAINT `Foretagssida_ibfk_1` FOREIGN KEY (`CompanyID`) REFERENCES `Companies` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `Likes`
--
ALTER TABLE `Likes`
  ADD CONSTRAINT `Likes_ibfk_1` FOREIGN KEY (`User`) REFERENCES `Users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Likes_ibfk_2` FOREIGN KEY (`PostID`) REFERENCES `Offers` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Likes_ibfk_3` FOREIGN KEY (`CompanyID`) REFERENCES `Companies` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `MyOffers`
--
ALTER TABLE `MyOffers`
  ADD CONSTRAINT `MyOffers_ibfk_6` FOREIGN KEY (`User`) REFERENCES `Users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `MyOffers_ibfk_7` FOREIGN KEY (`Offer`) REFERENCES `Offers` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `Offers`
--
ALTER TABLE `Offers`
  ADD CONSTRAINT `Offers_ibfk_1` FOREIGN KEY (`CompanyID`) REFERENCES `Companies` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `Offer_CS`
--
ALTER TABLE `Offer_CS`
  ADD CONSTRAINT `Offer_CS_ibfk_1` FOREIGN KEY (`CS`) REFERENCES `CS` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Offer_CS_ibfk_2` FOREIGN KEY (`Offer`) REFERENCES `Offers` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `Payments`
--
ALTER TABLE `Payments`
  ADD CONSTRAINT `Payments_ibfk_1` FOREIGN KEY (`CompanyDivision`) REFERENCES `Companies` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `ShoppingBag`
--
ALTER TABLE `ShoppingBag`
  ADD CONSTRAINT `ShoppingBag_ibfk_1` FOREIGN KEY (`User`) REFERENCES `Users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ShoppingBag_ibfk_2` FOREIGN KEY (`Offer`) REFERENCES `Offers` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `Subscriptions`
--
ALTER TABLE `Subscriptions`
  ADD CONSTRAINT `Subscriptions_ibfk_1` FOREIGN KEY (`CompanyID`) REFERENCES `Companies` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Subscriptions_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `Users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`CS`) REFERENCES `CS` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Restriktioner för tabell `UserTraffic`
--
ALTER TABLE `UserTraffic`
  ADD CONSTRAINT `UserTraffic_ibfk_1` FOREIGN KEY (`User`) REFERENCES `Users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
