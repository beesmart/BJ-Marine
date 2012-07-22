<?php 
// ------- IMPORTANT ----- Only run this file once!
//This document creates 6 mysql database tables for the XMl system - boatdetails, descriptions, images, videos, features, engines. All are linked by BoatID
require("../classes/db.class.php");
$db = new db();

//Create Boat Details Table
$query = "CREATE TABLE boatdetails (
 BoatID int(10) NOT NULL,
 Added date NOT NULL,
 NewUsed char(4) character set utf8 default NULL,
 Make varchar(100) character set utf8 NOT NULL,
 Model varchar(100) character set utf8 NOT NULL,
 MakeModel varchar(200) character set utf8 NOT NULL,
 Length_ft float NOT NULL,
 Length_mt float NOT NULL,
 LOA float default NULL,
 LOAUnit varchar(10) character set utf8 default NULL,
 LWL float default NULL,
 LWLUnit varchar(10) character set utf8 default NULL,
 Year year(4) NOT NULL,
 Price int(11) NOT NULL,
 PriceCurrency char(3) character set utf8 NOT NULL,
 TaxStatus varchar(20) character set utf8 NOT NULL,
 Fuel varchar(15) character set utf8 NOT NULL,
 HullMaterial varchar(20) character set utf8 NOT NULL,
 Keel varchar(15) character set utf8 NOT NULL,
 Designer varchar(50) character set utf8 default NULL,
 Builder varchar(50) character set utf8 default NULL,
 Name varchar(50) character set utf8 default NULL,
 Status varchar(15) character set utf8 default NULL,
 Coop char(5) character set utf8 default NULL,
 Category varchar(50) character set utf8 NOT NULL,
 Class varchar(50) character set utf8 NOT NULL,
 Description text character set utf8 NOT NULL,
 LocationCountry char(100) character set utf8 NOT NULL,
 LocationCity varchar(40) character set utf8 NOT NULL,
 LocationState varchar(20) character set utf8 default NULL,
 Company varchar(30) character set utf8 NOT NULL,
 OfficeID mediumint(9) default NULL,
 BrokerName varchar(30) character set utf8 NOT NULL,
 BrokerEmail varchar(40) character set utf8 NOT NULL,
 BrokerTel varchar(20) character set utf8 NOT NULL,
 BrokerFax varchar(20) character set utf8 default NULL,
 Beam float default NULL,
 BeamUnit varchar(10) character set utf8 default NULL,
 BridgeClearance float default NULL,
 BridgeClearanceUnit varchar(10) character set utf8 default NULL,
 MinDraft float default NULL,
 MinDraftUnit varchar(10) character set utf8 default NULL,
 MaxDraft float default NULL,
 MaxDraftUnit varchar(10) character set utf8 default NULL,
 CabinHeadroom float default NULL,
 CabinHeadroomUnit varchar(10) character set utf8 default NULL,
 Freeboard float default NULL,
 FreeboardUnit varchar(10) character set utf8 default NULL,
 DryWeight float default NULL,
 DryWeightUnit varchar(10) character set utf8 default NULL,
 Ballast float default NULL,
 BallastUnit varchar(10) character set utf8 default NULL,
 Displacement float default NULL,
 DisplacementUnit varchar(10) character set utf8 default NULL,
 CruisingSpeed smallint(6) default NULL,
 CruisingSpeedUnit varchar(10) character set utf8 default NULL,
 MaxSpeed smallint(6) default NULL,
 MaxSpeedUnit varchar(10) character set utf8 default NULL,
 FuelTankCap smallint(6) default NULL,
 FuelTankCapUnit varchar(10) character set utf8 default NULL,
 FuelTankNo tinyint(4) default NULL,
 WaterTankCap smallint(6) default NULL,
 WaterTankCapUnit varchar(10) character set utf8 default NULL,
 WaterTankNo tinyint(4) default NULL,
 HoldingTankCap smallint(6) default NULL,
 HoldingTankCapUnit varchar(10) character set utf8 default NULL,
 HoldingTankNo tinyint(4) default NULL,
 SingleBerthNo tinyint(4) default NULL,
 DoubleBerthNo tinyint(4) default NULL,
 TwinBerthNo tinyint(4) default NULL,
 CabinNo tinyint(4) default NULL,
 BathroomNo tinyint(4) default NULL,
 HeadNo tinyint(4) default NULL,
 PRIMARY KEY  (BoatID),
 FULLTEXT KEY MakeModel (MakeModel)
)";
$result = $db->db_query($query);
if (!$result) die ("Database access failed");

//Create Descriptions Table
$query = "CREATE TABLE descriptions (
	BoatID INT NOT NULL,
	AddTitle VARCHAR(150) CHARACTER SET utf8 NOT NULL,
	AddDescription TEXT CHARACTER SET utf8 NOT NULL
		)";
	
$result = $db->db_query($query);
if (!$result) die ("Database access failed");

//Create Images Table
$query = "CREATE TABLE images (
	BoatID INT NOT NULL,
	ImageURL VARCHAR(100) CHARACTER SET utf8 NOT NULL,
	ImageRanking CHAR(2) CHARACTER SET utf8 NOT NULL,
	ImageTitle VARCHAR(150) CHARACTER SET utf8 NOT NULL
		)";
	
$result = $db->db_query($query);
if (!$result) die ("Database access failed");

//Create Videos Table
$query = "CREATE TABLE videos (
	BoatID INT NOT NULL,
	VideoURL VARCHAR(150) CHARACTER SET utf8 NOT NULL,
	VideoTitle VARCHAR(150) CHARACTER SET utf8 NOT NULL,
	VideoThumb VARCHAR(100) CHARACTER SET utf8 NOT NULL,
	VideoEmbed TEXT CHARACTER SET utf8 NOT NULL
		)";
	
$result = $db->db_query($query);
if (!$result) die ("Database access failed");

//Create Features Table
$query = "CREATE TABLE features (
	BoatID INT NOT NULL,
	Feature VARCHAR(100) CHARACTER SET utf8 NOT NULL,
	FeatureDetails VARCHAR(250) CHARACTER SET utf8 NOT NULL
		)";

$result = $db->db_query($query);
if (!$result) die ("Database access failed");

//Create Features Table
$query = "CREATE TABLE currencies (
 currency char(3) NOT NULL default '',
 rate float NOT NULL default '0',
 PRIMARY KEY  (currency)
)";

$result = $db->db_query($query);
if (!$result) die ("Database access failed");

//Create Engines Table
$query = "CREATE TABLE engines (
	BoatID INT NOT NULL,
	EngineMake VARCHAR(100) CHARACTER SET utf8 NOT NULL,
	EngineModel VARCHAR(100) CHARACTER SET utf8 NOT NULL,
	EngineYear YEAR NOT NULL,
	EngineFuel VARCHAR(20) CHARACTER SET utf8 NOT NULL,
	EngineNo CHAR(2) CHARACTER SET utf8 NOT NULL,
	DriveType VARCHAR(30) CHARACTER SET utf8 NOT NULL,
	TotalPower SMALLINT NOT NULL,
	TotalPowerUnit VARCHAR(10) CHARACTER SET utf8 NOT NULL,
	PropellerType VARCHAR(30) CHARACTER SET utf8 NOT NULL,
	EngineHours SMALLINT NOT NULL
		)";
	
$result = $db->db_query($query);
if (!$result){ 
	die ("Database access failed");
}else{ 
	echo "Tables created successfully";
}

?>
