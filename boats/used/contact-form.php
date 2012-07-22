<? 
$title     = $_POST['title'];
$name     = $_POST['name'];
$phone    = $_POST['phone'];
$email    = $_POST['email'];
$interested    = $_POST['interested'];
$destination    = $_POST['destination'];
$comments = $_POST['comments'];
$url = $_POST['url'];
$error_msg = "";
$msg = "";

if($name){
	$msg .= "Name: \t $name \n";
}

if($phone){
	$msg .= "Phone: \t $phone \n";
}

if(!$email){
	$error_msg .= "Your email \n";
}
if($email){
	if(!preg_match("/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\._\-]+\.[a-zA-Z]{2,4}/", $email)){
		echo "\n<br>That is not a valid email address.  Please <a href=\"javascript:history.back()\">return</a> to the previous page and try again.\n<br>";
		exit;
	}			
	$msg .= "Email: \t $email \n";
}

if($interested){
	$msg .= "Interested In: \t $interested \n";
}

if($comments){
	$msg .= "Comments: \t $comments \n";
}

$url.="&sent=yes";

$sender_email="";

if(!isset($name)){
	if($name == ""){
		$sender_name="Web Customer";
	}
}else{
	$sender_name=$name;
}
if(!isset($email)){
	if($email == ""){
		$sender_email="info@bjmarine.net";
	}
}else{
	$sender_email=$email;
}
if($error_msg != ""){
	echo "You didn't fill in these required fields:<br>"
	.nl2br($error_msg) .'<br>Please <a href="javascript:history.back()">return</a> to the previous page and try again.';
	exit;
}
$mailheaders  = "MIME-Version: 1.0\r\n";
$mailheaders .= "Content-type: text/plain; charset=iso-8859-1\r\n";
$mailheaders .= "From: $sender_name <$sender_email>\r\n";
$mailheaders .= "Reply-To: $sender_email <$sender_email>\r\n"; 
mail("380-bjmarinesite@bwleadmanager.com, sales@bjmarine.net, janderson@boats.com, $destination","BJ Marine Brokerage Enquiry",stripslashes($msg), $mailheaders);
header("Location: $url");  
?>