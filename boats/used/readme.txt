***Quickstart Guide for BWWS XML Solution 1.3***

#Changelog version 1.4#
Files changed: setup/create-table.php
New database fields added:
- MakeModel is an additional field with fulltext search which can be used to run a keyword search on Make and Model.
- Length_mt and Length_ft replace Length and Length_Units in order to provide more accurate searching on length
- New table for currencies to aid with price based searches

Files changed: db.class.php
- New function 'Google Rate Finder' added for currency table population
- New code to populate Length_mt, Length_ft and MakeModel added
- New function 'sanitise string' added to increase security and prevent malicious SQL injection
- Added reference to includes/contries.php in order to convert country codes before database insertion

Files changed: import-xml.php
Added code to populate currencies database

Files changed: includes/countries.php
- Changed how the country conversion works so that it converts to readable countries from country code when input to the database.

Files changed: index.php
- Changed all called to $_GET to use the santise function to clear the data before it is used in a db query. eg:
$SearchMake = $_GET['make']; becomes $SearchMake = $db->sanitise($_GET['make']);
- Changed search form to include MakeModel keyword search, you can also use the old Make and Model searches seperately.
- Changed printing of length to use new Length_ft and Length_mt fields
- Moved sidebar below content code for better semantic layout

Files changes: brokerage-boats.css
- Set container to overflow:auto and boat-content to float:left as part of semantic structure changes

This guide assumes that you have already uploaded to package to your server and set up a blank database to be used for the XML listings.
This release comes with one standard template that can be altered using CSS. Additional templates will be provided with future releases.

Step 1 - Open classes/dc.class.php and enter database details
Step 2 - Run setup/create-table.php once in your browser, this will create the 6 tables with all the columns and rows needed to take the data import.
Step 3 - Ensure that the file paths for includes and header content in the following files are correct for your server:
- boat-details.php
- import-xml.php
- index.php
- pdffullspecs.php
Step 4 - Enter spice rack URL's into the import-xml.php file, one URL per line of the array. The numbers in the URL are the office id of each office you need to import.
Step 5 - Run import-xml.php, you should get one a one line response for each URL stating whether the import has run sucessfully.
Step 6 - Navigate to the index of your xml listings folder and you should be able to see the boat listings and use the search and sort functions.

-- These are the basic details needed to get the XML listings system up and running, the following are for futher customisation ---

PDF Full Specs
The current PDF generator will be updated to use the same templating system used in BoatWizard, this is currently still is development and we will provide code updates when available.
- in pdffullspecs.php, edit the footer around line 169, you can edit the background colour and change the text that displays in the footer
- To change the logo used in the pdf, open logo.jpg in your favourite image editor and use this as a basis to paste in a new logo and resave the file.

A raw version of the files working can be found at http://www.boatwizardwebsolutions.co.uk/used-boats-for-sale
This is how the system should look before you apply any site template to the code.
To see what the template system looks like within a site template, go to http://www.williamsandsmithells.co.uk/used-boats-for-sale

For bug reporting, enhancement requests and questions, please contact bpiper@boats.com 
or use the Boatwizardwebsolutions Forum at http://www.boatwizardwebsolutions.com/forum. I have created a new section for XML system support.

