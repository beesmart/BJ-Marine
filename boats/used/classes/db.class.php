<?
//This document reads the XML files and saves the data to the database, it also handles database requests from the other documents.
class db {

//Enter database details here
public $Hostname = "localhost";
public $Username = "wizard_bjxml";
public $Password = "sGTPvyfGrP";
public $Database = "wizard_bjxml"; 

//-------------------------No need to edit below this line------------------------

public $Connection;

		//Connect to Database
		public function __construct() {
			$this->Connection = mysqli_connect($this->Hostname, $this->Username, $this->Password, $this->Database) or die("Database error");
		}
		
		//Disconnect from Database
		public function __destruct() {
			@mysqli_free_result($result);
			mysqli_close( $this->Connection );
		}
		
		//Sanitise String
		public function sanitise($string){
			if(get_magic_quotes_gpc()) $string = stripslashes($string);
			return mysqli_real_escape_string($this->Connection, $string);
		}
		
		//Query Database
        public function db_query($Query) {
       		$result = mysqli_query( $this->Connection, $Query );
			return $result;
        }    	
    	
    	//Get result
    	public function db_rs($result) 
    	{
    		return ( @mysqli_fetch_array($result) );
    	}
    	
    	//Get number of rows
    	public function db_rows($result)
    	{
    		return ( mysqli_num_rows ($result) );
    	}
    	
    	//Get row
    	public function db_row($result)
    	{
    		return ( mysqli_fetch_row ($result) );
    	}
    	
    	//Convert feet
    	public function convert_feet($measurement)
    	{
			$feet = (int)$measurement;
			$inches = $measurement - $feet;
			$inches = $inches * 12;
			$inches = round($inches);
			$measurement = $feet . "' " . $inches . "\"";
    		return $measurement;
    	}
    	
    	//Google Currency Converter
    	public function currency($from_Currency, $to_Currency, $amount) {
 
        $amount = urlencode($amount);
        $from_Currency = urlencode($from_Currency);
        $to_Currency = urlencode($to_Currency);
        $url = "http://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";
        $ch = curl_init();
        $timeout = 0;
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $rawdata = curl_exec($ch);
        curl_close($ch);
       
        $data = explode('bld>', $rawdata);
        $data = explode($to_Currency, $data[1]);
 
        return round($data[0], 2);
		}	
		
		//Google Rate Finder
    	public function findrate($from_Currency, $to_Currency, $amount) {
 
        $amount = urlencode($amount);
        $from_Currency = urlencode($from_Currency);
        $to_Currency = urlencode($to_Currency);
        $url = "http://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";
        $ch = curl_init();
        $timeout = 0;
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $rawdata = curl_exec($ch);
        curl_close($ch);
       
        $data = explode('bld>', $rawdata);
        $data = explode($to_Currency, $data[1]);
 
        return $data[0];
		}
		
		//Length Units Converter
    	public function units($to_unit, $amount) {
    	if ($to_unit == "metres"){
    		$times = 0.3048;
    	} else {
    		$times = 3.2808399;
 		}
        $data = $amount * $times;
        return round($data, 2);
		}		
	
    	//Run import
    	public function run_import($filename){
			$xml = simplexml_load_file($filename, 'SimpleXMLElement', LIBXML_NOCDATA) or die ("Unable to load XML file!");
			$records = $xml->VehicleRemarketing;
			
			foreach( $records as $record ) 
			{ 	
				if($record->VehicleRemarketingBoatLineItem->SalesStatus != "Delete"){
					//Declare and empty variables
					$BoatID = $Added = $NewUsed = $Make = $Model = $Length = $LengthUnit = $LOA = $LOAUnit = $LWL = $LWLUnit = $Year = $Price = $PriceCurrency = $TaxStatus = $Fuel = $HullMaterial = $Keel = $Designer = $Builder = $Name = $Status = $Coop = $Category = $Class = $Description = $LocationCountry = $LocationCity = $LocationState = $Company = $OfficeID = $BrokerName = $BrokerEmail = $BrokerTel = $BrokerFax = $Beam = $BeamUnit = $BridgeClearance = $BridgeClearanceUnit = $MinDraft = $MinDraftUnit = $MaxDraft = $MaxDraftUnit = $CabinHeadroom = $CabinHeadroomUnit = $Freeboard = $FreeboardUnit = $DryWeight = $DryWeightUnit = $Ballast = $BallastUnit = $Displacement = $DisplacementUnit = $CruisingSpeed = $CruisingSpeedUnit = $MaxSpeed = $MaxSpeedUnit = $FuelTankCap = $FuelTankCapUnit =$FuelTankNo = $WaterTankCap = $WaterTankCapUnit = $WaterTankNo = $HoldingTankCap = $HoldingTankCapUnit = $HoldingTankNo = $SingleBerthNo = $DoubleBerthNo = $TwinBerthNo = $CabinNo = $BathroomNo = $HeadNo = "";
					
					//Populate Boat Details from XML
					$BoatID = $record->VehicleRemarketingHeader->DocumentIdentificationGroup->DocumentIdentification->DocumentID;
					$Added = $record->VehicleRemarketingBoatLineItem->ItemReceivedDate;
					$NewUsed = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->SaleClassCode;
					$Make = addslashes($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->MakeString);
					$Model = addslashes($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->Model);
					$MakeModel = $Make . " " . $Model;
					
					//Loop through Length Nodes
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatLengthGroup){
						$processlengths = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatLengthGroup;
					  	foreach($processlengths as $processlength)
						{
							if ($processlength->BoatLengthCode == "Nominal Length"){
								if($processlength->BoatLengthMeasure){
									$Length = $processlength->BoatLengthMeasure;
									$LengthUnit = $processlength->BoatLengthMeasure[0]->attributes();
									if($LengthUnit == "meter"){
										$Length_mt = $Length;
										$Length_ft = $this->units('feet', $Length);
									} else if($LengthUnit == "feet"){
										$Length_ft = $Length;
										$Length_mt = $this->units('metres', $Length);
									}
								}
							} else if ($processlength->BoatLengthCode == "Length At Water Line"){
								if($processlength->BoatLengthMeasure){
									$LWL = $processlength->BoatLengthMeasure;
									$LWLUnit = $processlength->BoatLengthMeasure[0]->attributes();
								}
							} else if ($processlength->BoatLengthCode == "Length Overall"){
								if($processlength->BoatLengthMeasure){
									$LOA = $processlength->BoatLengthMeasure;
									$LOAUnit = $processlength->BoatLengthMeasure[0]->attributes();
								}
							}
						}
					}
					
					$Year = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->ModelYear;
					$Price = $record->VehicleRemarketingBoatLineItem->PricingABIE->Price->ChargeAmount;
					$PriceCurrency = $record->VehicleRemarketingBoatLineItem->PricingABIE->Price->ChargeAmount[0]->attributes();
					$TaxStatus = $record->VehicleRemarketingBoatLineItem->Tax->TaxStatusCode;
					
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingEngineLineItem->VehicleRemarketingEngine->FuelTypeCode){
						$Fuel = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingEngineLineItem->VehicleRemarketingEngine->FuelTypeCode;
					}
					
					$HullMaterial = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->Hull->BoatHullMaterialCode;
					
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatKeelCode){
						$Keel = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatKeelCode;
					}
					
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DesignerName){
						$Designer = addslashes($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DesignerName);
					}
					
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BuilderName){
						$Builder = addslashes($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BuilderName);
					}
					
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatName){
						$Name = addslashes($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatName);
					}
					
					$Status = $record->VehicleRemarketingBoatLineItem->SalesStatus;	
					//Encapsulated elements with a dash			
					$Coop = $record->VehicleRemarketingBoatLineItem->{'Co-OpIndicator'};
					$Category = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatCategoryCode;
					$Class = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BoatClassGroup;
					$Description = addslashes(utf8_decode($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->GeneralBoatDescription));
					$LocationCountry = $record->VehicleRemarketingBoatLineItem->Location->LocationAddress->CountryID;
					require("includes/countries.php");
					
					if($record->VehicleRemarketingBoatLineItem->Location->LocationAddress->CityName){				
						$LocationCity = addslashes($record->VehicleRemarketingBoatLineItem->Location->LocationAddress->CityName);
					}
					
					//Encapsulated elements with a dash
					if($record->VehicleRemarketingBoatLineItem->Location->LocationAddress->{'StateOrProvinceCountrySub-DivisionID'}){
						$LocationState = $record->VehicleRemarketingBoatLineItem->Location->LocationAddress->{'StateOrProvinceCountrySub-DivisionID'};				
					}
					
					$Company = addslashes($record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->CompanyName);
					$OfficeID = $record->VehicleRemarketingBoatLineItem->DealerParty->PartyID;
					
					if($record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PrimaryContact->PersonName){
						$BrokerName = addslashes($record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PrimaryContact->PersonName);
					}
					
					$BrokerEmail = addslashes($record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PrimaryContact->URICommunication->CompleteNumber);
					$BrokerTel = addslashes($record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PrimaryContact->TelephoneCommunication->CompleteNumber);
					
					if($record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PrimaryContact->FaxCommunication->CompleteNumber){
						$BrokerFax = addslashes($record->VehicleRemarketingBoatLineItem->DealerParty->SpecifiedOrganization->PrimaryContact->FaxCommunication->CompleteNumber);
					}
					
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BeamMeasure){
						$Beam = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BeamMeasure;
						$BeamUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BeamMeasure[0]->attributes();
					}
					
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BridgeClearanceMeasure){
						$BridgeClearance = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BridgeClearanceMeasure;
						$BridgeClearanceUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BridgeClearanceMeasure[0]->attributes();
					}
					
					//Loop through Draft Measure Nodes
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DraftMeasureGroup){
						$processdrafts = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DraftMeasureGroup;
					  	foreach($processdrafts as $processdraft)
						{
							if ((string) $processdraft->BoatDraftCode == "Drive Up"){
								if($processdraft->DraftMeasure){
									$MinDraft = $processdraft->DraftMeasure;
									$MinDraftUnit = $processdraft->DraftMeasure[0]->attributes();
								}
							} else if ((string) $processdraft->BoatDraftCode == "Max Draft"){
								if($processdraft->DraftMeasure){
									$MaxDraft = $processdraft->DraftMeasure;
									$MaxDraftUnit = $processdraft->DraftMeasure[0]->attributes();
								}
							}				
						}
					}
					
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->CabinHeadroomMeasure){
						$CabinHeadroom = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->CabinHeadroomMeasure;
						$CabinHeadroomUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->CabinHeadroomMeasure[0]->attributes();
					}
					
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->FreeboardMeasure){
						$Freeboard = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->FreeboardMeasure;
						$FreeboardUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->FreeboardMeasure[0]->attributes();
					}
					
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DryWeightMeasure){
						$DryWeight = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DryWeightMeasure;
						$DryWeightUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DryWeightMeasure[0]->attributes();
					}
					
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BallastWeightMeasure){
						$Ballast = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BallastWeightMeasure;
						$BallastUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->BallastWeightMeasure[0]->attributes();
					}
					
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DisplacementMeasure){
						$Displacement = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DisplacementMeasure;
						$DisplacementUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->DisplacementMeasure[0]->attributes();
					}
					
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->CruisingSpeedMeasure){
						$CruisingSpeed = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->CruisingSpeedMeasure;
						$CruisingSpeedUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->CruisingSpeedMeasure[0]->attributes();
					}
					
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->MaximumSpeedMeasure){
						$MaxSpeed = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->MaximumSpeedMeasure;
						$MaxSpeedUnit = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->MaximumSpeedMeasure[0]->attributes();
					}
					
					//Loop through Tank Nodes
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->Tank){
						$processtanks = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->Tank;
					  	foreach($processtanks as $processtank)
						{
							if ((string) $processtank->TankUsageCode == "Fuel"){
								if($processtank->TankCapacityMeasure){
									$FuelTankCap = $processtank->TankCapacityMeasure;
									$FuelTankCapUnit = $processtank->TankCapacityMeasure[0]->attributes();
									if ($processtank->TankCountNumeric){
										$FuelTankNo = $processtank->TankCountNumeric;
									} else {
										$FuelTankNo = 1;
									}
								}	
							} else if ((string) $processtank->TankUsageCode == "Water"){
								if($processtank->TankCapacityMeasure){
									$WaterTankCap = $processtank->TankCapacityMeasure;
									$WaterTankCapUnit = $processtank->TankCapacityMeasure[0]->attributes();
									if ($processtank->TankCountNumeric){
										$WaterTankNo = $processtank->TankCountNumeric;
									} else {
										$WaterTankNo = 1;
									}
								}
							} else if ((string) $processtank->TankUsageCode == "Black Water"){
								if($processtank->TankCapacityMeasure){
									$HoldingTankCap = $processtank->TankCapacityMeasure;
									$HoldingTankCapUnit = $processtank->TankCapacityMeasure[0]->attributes();
									if ($processtank->TankCountNumeric){	
										$HoldingTankNo = $processtank->TankCountNumeric;
									} else {
										$HoldingTankNo = 1;
									}
								}
							}
						}
					}
					
					//Loop through Accommodation Nodes
					if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->Accommodation){
						$processaccomms = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingBoat->Accommodation;
					  	foreach($processaccomms as $processaccomm)
						{
							if ((string) $processaccomm->AccommodationTypeCode == "SingleBerth"){
							$SingleBerthNo = $processaccomm->AccommodationCountNumeric;
							} else if ((string) $processaccomm->AccommodationTypeCode == "DoubleBerth"){
							$DoubleBerthNo = $processaccomm->AccommodationCountNumeric;
							} else if ((string) $processaccomm->AccommodationTypeCode == "TwinBerth"){
							$TwinBerthNo = $processaccomm->AccommodationCountNumeric;
							} else if ((string) $processaccomm->AccommodationTypeCode == "Cabin"){
							$CabinNo = $processaccomm->AccommodationCountNumeric;	
							} else if ((string) $processaccomm->AccommodationTypeCode == "Bathroom"){
							$BathroomNo = $processaccomm->AccommodationCountNumeric;
							} else if ((string) $processaccomm->AccommodationTypeCode == "Head"){
							$HeadNo = $processaccomm->AccommodationCountNumeric;
							}			
						}
					}
					
					//Insert Boat Details, used SET in order to make future addition of fields easier
					$insert = "INSERT INTO boatdetails 
					SET BoatID = '$BoatID',
					Added = '$Added',
					NewUsed = '$NewUsed',
					Make = '$Make',
					Model = '$Model',
					Makemodel = '$MakeModel',
					Length_ft = '$Length_ft',
					Length_mt = '$Length_mt',
					LOA = '$LOA',
					LOAUnit = '$LOAUnit',
					LWL = '$LWL',
					LWLUnit = '$LWLUnit',
					Year = '$Year',
					Price = '$Price',
					PriceCurrency = '$PriceCurrency',
					TaxStatus = '$TaxStatus',
					Fuel = '$Fuel',
					HullMaterial = '$HullMaterial',
					Keel = '$Keel',
					Designer = '$Designer',
					Builder = '$Builder',
					Name = '$Name',
					Status = '$Status',
					Coop = '$Coop',
					Category = '$Category',
					Class = '$Class',
					Description = '$Description',
					LocationCountry = '$LocationCountry',
					LocationCity = '$LocationCity',
					LocationState = '$LocationState',
					Company = '$Company',
					OfficeID = '$OfficeID',
					BrokerName = '$BrokerName',
					BrokerEmail = '$BrokerEmail',
					BrokerTel = '$BrokerTel',
					BrokerFax = '$BrokerFax',
					Beam = '$Beam',
					BeamUnit = '$BeamUnit',
					BridgeClearance = '$BridgeClearance',
					BridgeClearanceUnit = '$BridgeClearanceUnit',
					MinDraft = '$MinDraft',
					MinDraftUnit = '$MinDraftUnit',
					MaxDraft = '$MaxDraft',
					MaxDraftUnit = '$MaxDraftUnit',
					CabinHeadroom = '$CabinHeadroom',
					CabinHeadroomUnit = '$CabinHeadroomUnit',
					Freeboard = '$Freeboard',
					FreeboardUnit = '$FreeboardUnit',
					DryWeight = '$DryWeight',
					DryWeightUnit = '$DryWeightUnit',
					Ballast = '$Ballast',
					BallastUnit = '$BallastUnit',
					Displacement = '$Displacement',
					DisplacementUnit = '$DisplacementUnit',
					CruisingSpeed = '$CruisingSpeed',
					CruisingSpeedUnit = '$CruisingSpeedUnit',
					MaxSpeed = '$MaxSpeed',
					MaxSpeedUnit = '$MaxSpeedUnit',
					FuelTankCap = '$FuelTankCap',
					FuelTankCapUnit = '$FuelTankCapUnit',
					FuelTankNo = '$FuelTankNo',
					WaterTankCap = '$WaterTankCap',
					WaterTankCapUnit = '$WaterTankCapUnit',
					WaterTankNo = '$WaterTankNo',
					HoldingTankCap = '$HoldingTankCap',
					HoldingTankCapUnit = '$HoldingTankCapUnit',
					HoldingTankNo = '$HoldingTankNo',
					SingleBerthNo = '$SingleBerthNo',
					DoubleBerthNo = '$DoubleBerthNo',
					TwinBerthNo = '$TwinBerthNo',
					CabinNo = '$CabinNo',
					BathroomNo = '$BathroomNo',
					HeadNo = '$HeadNo'
					";
					$result = mysqli_query( $this->Connection, $insert );
					
					if ($result == 1 && $record->VehicleRemarketingBoatLineItem->AdditionalDetailDescription){
						//Populate Descriptions from XML
						//Loop through Descriptions Nodes
						//Declare and Clear Variables
						
							$processdescs = $record->VehicleRemarketingBoatLineItem->AdditionalDetailDescription;
						  	foreach($processdescs as $processdesc)
							{
								$AddTitle = $AddDescription = "";
								$AddTitle = addslashes($processdesc->Title);
								$AddDescription = addslashes($processdesc->Description);
								$AddDescription = str_replace("<div>","",$AddDescription);
								$AddDescription = str_replace("</div>","",$AddDescription);
								//Insert Descriptions, used SET in order to make future addition of fields easier
								$insert = "INSERT INTO descriptions 
								SET BoatID = '$BoatID',
								AddTitle = '$AddTitle',	
								AddDescription = '$AddDescription'					
								";
								$result = mysqli_query( $this->Connection, $insert );
								if (!$result){ echo mysql_error(); }
							}
					}
					
					if ($result == 1){
						//Populate Engines from XML
						//Loop through Engines Nodes
						//Declare and Clear Variables
						$EngineMake = $EngineModel = $EngineYear = $EngineFuel = $EngineNo = $DriveType = $TotalPower = $TotalPowerUnit = $PropellerType = $EngineHours = "";
						$EngineNo = 0;
						
						if($record->VehicleRemarketingBoatLineItem->VehicleRemarketingEngineLineItem){
							$processengines = $record->VehicleRemarketingBoatLineItem->VehicleRemarketingEngineLineItem;
						  	foreach($processengines as $processengine)
							{
								$EngineMake = addslashes($processengine->VehicleRemarketingEngine->MakeString);
								$EngineModel = addslashes($processengine->VehicleRemarketingEngine->Model);
								$EngineYear = $processengine->VehicleRemarketingEngine->ModelYear;
								$EngineFuel = $processengine->VehicleRemarketingEngine->FuelTypeCode;
								$EngineNo++;
								$DriveType = $processengine->VehicleRemarketingEngine->DriveTypeCode;
								$TotalPower = $processengine->VehicleRemarketingEngine->TotalEnginePowerQuantity;
								if ($processengine->VehicleRemarketingEngine->TotalEnginePowerQuantity){
									$TotalPowerUnit = $processengine->VehicleRemarketingEngine->TotalEnginePowerQuantity[0]->attributes();
								}
								$PropellerType = $processengine->VehicleRemarketingEngine->PropellerType;
								$EngineHours = $processengine->VehicleRemarketingEngine->TotalEngineHoursNumeric;
							}
						}
						//Insert Engines, used SET in order to make future addition of fields easier
						$insert = "INSERT INTO engines 
						SET BoatID = '$BoatID',
						EngineMake = '$EngineMake',
						EngineModel = '$EngineModel',
						EngineYear = '$EngineYear',
						EngineFuel = '$EngineFuel',
						EngineNo = '$EngineNo',
						DriveType = '$DriveType',
						TotalPower = '$TotalPower',
						TotalPowerUnit = '$TotalPowerUnit',
						PropellerType = '$PropellerType',
						EngineHours = '$EngineHours'				
						";
						$result = mysqli_query( $this->Connection, $insert );
					}
					if ($result == 1){
						//Populate Features from XML
						//Loop through Features Nodes
						
						if($record->VehicleRemarketingBoatLineItem->FeatureGroupDataNode->FeatureDataNode){
							$processfeatures = $record->VehicleRemarketingBoatLineItem->FeatureGroupDataNode->FeatureDataNode;
						  	foreach($processfeatures as $processfeature)
							{
								$Feature = $FeatureDetails = "";
								$Feature = addslashes($processfeature->DataNodeID);
								if ($processfeature->FreeFormTextGroup->Description){
									$FeatureDetails = addslashes(utf8_decode($processfeature->FreeFormTextGroup->Description));
								}
								//Insert Features, used SET in order to make future addition of fields easier
								$insert = "INSERT INTO features 
								SET BoatID = '$BoatID',
								Feature = '$Feature',
								FeatureDetails = '$FeatureDetails'
								";
								$result = mysqli_query( $this->Connection, $insert );
							}
						}	
					}
					if ($result == 1){
						//Populate Images from XML
						//Loop through Images Nodes
						
						if($record->VehicleRemarketingBoatLineItem->ImageAttachmentExtended){
							$processimages = $record->VehicleRemarketingBoatLineItem->ImageAttachmentExtended;
						  	foreach($processimages as $processimage)
							{
								$ImageURL = $ImageRanking = $ImageTitle = "";
								$ImageURL = addslashes($processimage->URI);
								$ImageRanking = addslashes($processimage->UsagePreference->PriorityRankingNumeric);
								if ($processimage->ImageAttachmentTitle){
									$ImageTitle = addslashes(utf8_decode($processimage->ImageAttachmentTitle));
								}
								//Insert Features, used SET in order to make future addition of fields easier
								$insert = "INSERT INTO images 
								SET BoatID = '$BoatID',
								ImageURL = '$ImageURL',
								ImageRanking = '$ImageRanking',
								ImageTitle = '$ImageTitle'
								";
								$result = mysqli_query( $this->Connection, $insert );
							}
						}	
					}
					if ($result == 1){
						//Populate Videos from XML
						//Loop through Videos Nodes
						
						if($record->VehicleRemarketingBoatLineItem->AdditionalMedia->MediaTypeString == "Video" || $record->VehicleRemarketingBoatLineItem->AdditionalMedia->MediaTypeString == "Embedded Video"|| $record->VehicleRemarketingBoatLineItem->AdditionalMedia->MediaTypeString == "Video Brochure"){
							$processvideos = $record->VehicleRemarketingBoatLineItem->AdditionalMedia;
						  	foreach($processvideos as $processvideo)
							{
								$VideoURL = $VideoTitle = $VideoThumb = $VideoEmbed = "";
								$VideoURL = addslashes($processvideo->MediaSourceURI);
								if ($processvideo->MediaAttachmentTitle){
									$VideoTitle = addslashes(utf8_decode($processvideo->MediaAttachmentTitle));
								}
								if ($processvideo->MediaThumbURI){
									$VideoThumb = addslashes($processvideo->MediaThumbURI);
								}
								if ($processvideo->EmbeddedData->DataString){
									$VideoEmbed = addslashes($processvideo->EmbeddedData->DataString);
								}
								//Insert Features, used SET in order to make future addition of fields easier
								$insert = "INSERT INTO videos 
								SET BoatID = '$BoatID',
								VideoURL = '$VideoURL',
								VideoTitle = '$VideoTitle',
								VideoThumb = '$VideoThumb',
								VideoEmbed = '$VideoEmbed'
								";
								$result = mysqli_query( $this->Connection, $insert );
							}
						}	
					}
				}
			}
			return $result;
		}
}

?>