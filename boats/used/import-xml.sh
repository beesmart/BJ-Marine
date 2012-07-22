echo `date` "Importing boats" >> /home/wizard/public_html/bjmarine.net/used-boats/import.log

curl -o /home/wizard/public_html/bjmarine.net/used-boats/bjmarine.xml "https://services.boatwizard.com/bridge/events/7a9188d1-f232-4c7e-bb27-39cb1b4162ef/boats?status=on" >> import.log 
SUCCESS=$?
echo $SUCCESS
if [ $SUCCESS -ne 0 ]; then
echo "Data Download failed. Exiting"
exit $SUCCESS
fi

php /home/wizard/public_html/bjmarine.net/used-boats/import-local-xml.php >> /home/wizard/public_html/bjmarine.net/used-boats/import.log

