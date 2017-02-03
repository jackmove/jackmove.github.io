<?php
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// Kontaktformular.org
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


// Einstellungen

// Ihre E-Mailadresse
$ihre_emailadresse = 'info@wohnen-in-md.de';

// Absender || Muster(From: NAME <EMAIL>) // Beispiel: 'From: Max Mustermann <max@musterdomain.tld>'
$email_absender = 'From: Kontaktformular <system@domain.tld>';

// Betreff
$email_betreffzeile = 'Kontaktformular-Anfrage';



// Hinweismeldungen

#Nicht alle Felder ausgefüllt
$errormessage[0] = 'Fehler, Sie haben nicht alle Felder ausgefüllt:';
#Kein Name eingegeben
$errormessage[1] = '<br />- Ungültiger Name';
#Ungültige E-Mailadresse eingegeben
$errormessage[2] = '<br />- Ungültiger E-Mailadresse';
#Kein Betreff eingegeben
$errormessage[3] = '<br />- Ungültiger Betreff';
#Keine Nachricht eingegeben
$errormessage[4] = '<br />- Ungültige Nachricht';
#Ungültiger Sicherheitscode
$errormessage[5] = '<br />- Ungültiger Sicherheitscode';
#Ungültiger Zeichen (Spamverdacht)
$errormessage[6] = '<br />- Ungültige Zeichen entdeckt';

#Alle Felder sind OK
$okay = 'Vielen Dank für Ihre Nachricht, wir werden Sie demnächst bearbeiten!<br /><br />';





// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


    #######################################
    session_start();
    #######################################


	  if(isset($_POST['submit'])) {
    #######################################

	  $name =       check($_POST['name']);
	  $email =      check($_POST['email']);
	  $betreff =    check($_POST['betreff']);
	  $nachricht =  check($_POST['nachricht']);
	  $homepage =   check($_POST['homepage']);

    #######################################

		$ip = $_SERVER['REMOTE_ADDR'];
		$host = gethostbyaddr($ip);

    #######################################

		$zeit = time();
		$datum = date ("d.m.Y", $zeit);
		$uhrzeit = date ("H:i:s", $zeit);

    #######################################

		$message = '<span style="color:red">' . $errormessage[0];
		
    if($name==''){$message .= $errormessage[1]; $fehler = 1;}
		
    if(!ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,6})$", $email)) {
			$message .= $errormessage[2]; $fehler = 1;}
		
    if($betreff==''){$message .= $errormessage[3]; $fehler = 1;}
		
    if($nachricht==''){$message .= $errormessage[4];	$fehler = 1;}
		
    if($_POST['code']=="" || strtolower($_POST['code'])!=$_SESSION['captcha_code']){
			$message .= $errormessage[5]; $fehler = 1;}
    
    if(ehi_check()!=0){$message .= $errormessage[6];  $fehler = 1;}

		$message .= '</span><br /><br />';

		#######################################

    #######################################
        
        if(!isset($fehler)){
			
        $email_nachricht  = "-- Kontakformularanfrage --\n\nBetreff: $betreff";
        $email_nachricht .= "\nName: $name\nE-Mailadresse: $email\nHomepage: $homepage\n\n";
        $email_nachricht .= "Nachricht:\n$nachricht\n\nIP: $ip\nHost: $host\n";
        $email_nachricht .= "gesendet am $datum um $uhrzeit.";
			 
        // Mail senden
        @mail($ihre_emailadresse, $email_betreffzeile, $email_nachricht, $email_absender);
			
        //Variablen resetten
        $name       = '';
			  $betreff    = '';
			  $email      = '';
			  $nachricht  = '';
		    $homepage   = '';
			
        $meldung=$okay;
  
		    } else {
		    $meldung=$message;
		    }
    #######################################
    #######################################
	} //endissetsubmit
  else{$meldung='';}


// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Kontakt www.wohnen-in-md.de</title>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAApHRTud9R7YjGKuuTrSYPXxQmwNDUS4QIUXfs4n45loMpNIIaaRSU2iLxOkCMhFYlEPBDyh7naou5Ag"
type="text/javascript"></script>
<meta name="description" content="Kontaktm&ouml;glichkeit f&uuml;r wohnen-in-md.de"/>
<meta name="keywords" content="Monteurswohnungen, Wochenendfahrer, Ferienwohungen, Magdeburg, wohnen-in-md.de"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="default.css" rel="stylesheet" type="text/css" media="screen" />
<style type="text/css">
body,td,th{font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;color:#333333;}
body{background-color: #FFFFFF;}
a:link, a:visited, a:active{color:#666666;text-decoration:none;}
a:hover{text-decoration: underline;}
</style>

<script type="text/javascript">
function reload_captcha(){
var nd = new Date();
var src="captcha.php?"+nd;
document.getElementById("captcha").src= src;
}
</script>

</head>

<body>
<div id="header">

  <div id="menu">
    <ul>
      <li class="current_page_item"><a href="http://www.wohnen-in-md.de">Start</a></li>
      <li><a href="http://www.wohnen-in-md.de/bilder.html">Bilder</a></li>
      <li><a href="http://www.wohnen-in-md.de/kontakt.php">Kontakt</a></li>

    </ul>
  </div>
</div>
<div id="page">
  <div id="content">
    <div class="post greenbox">
      <div class="title">
        <h1>Kontaktm&ouml;glichkeit</h1>
      </div>
      <div class="entry">



        <div align="center">
<body>

<p><strong>Kontaktformular:</strong></p>
<form name="kontaktformular" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<table style="width:500px">
<tr><td colspan="2"><?php echo $meldung; ?></td></tr>
<tr>
	<td style="width:150px"><strong>Name:</strong></td>
	<td><input name="name" type="text" value="<?php echo $name;	?>" size="40" maxlength="100" /></td>
</tr>
<tr>
	<td style="width:150px"><strong>E-Mail Adresse:</strong><br /></td>
	<td><input name="email" type="text" id="email" value="<?php echo $email; ?>" size="40" maxlength="100" /></td>
</tr>
<tr>
	<td style="width:150px"><strong>Betreff:</strong></td>
	<td><input name="betreff" type="text"  value="<?php echo $betreff; ?>" size="40" maxlength="50" /></td>
</tr>
<tr>
	<td style="width:150px"><strong>Homepage:</strong></td>
	<td><input name="homepage" type="text"  value="<?php echo $homepage; ?>" size="40" maxlength="50" /></td>
</tr>
<tr>
	<td style="width:150px"><strong>Nachricht:</strong></td>
	<td><textarea name="nachricht" cols="40" rows="10" style="white-space: nowrap;"><?php echo $nachricht;	?></textarea></td>
</tr>
<tr>
<td style="width:150px">&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
<td style="width:150px"><strong>Sicherheitscode:</strong></td>
	<td><img id="captcha" src="captcha.php" alt="captcha" border="1"  /><br />
	<a href="javascript:void(0);" onclick="reload_captcha();">Neuer Code?</a></td>
</tr>
<tr>
	<td style="width:150px"><strong>Sicherheitscode <br />
	wiederholen: </strong></td>
	<td><input name="code" type="text"  size="20" maxlength="50" /></td>
</tr>
<tr>
	<td style="width:150px">&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td style="width:150px">&nbsp;</td>
	<td><input type="submit" value="Abschicken" name="submit" />
	<!-- Hinweis darf nicht entfernt werden! -->
	<p><span style="font-size:10px; font-family:Verdana, Arial, Helvetica, sans-serif">
	&copy; Script Powered by <a target="_blank" href="http://www.kontaktformular.org" title="kostenloses Kontaktformular">kostenloses Kontaktformular</a></span></p>
	<!-- Hinweis darf nicht entfernt werden! --></td>
</tr>
</table>
</form>
 </div>
        <br /><br /><br /><br />
      </div>
      <div class="btm">
        <div class="l">
          <div class="r">

          </div>
        </div>
      </div>
    </div>

  </div>
  <div id="sidebar">
    <ul>
      <li>
        <h2>Men&uuml;</h2>
        <ul>
           <li><a href="http://www.wohnen-in-md.de">Start</a></li>
           <li><a href="http://www.wohnen-in-md.de/bilder.html">Bilder</a></li>
           <li><a href="http://www.wohnen-in-md.de/kontakt.php">Kontakt</a></li>
        </ul>
      </li>

    </ul>
  </div>
</div>
<div style="clear: both;">&nbsp;</div>
<div id="footer">
  <p>&copy;2009 All Rights Reserved. | <a href="http://www.wohnen-in-md.de/impressum.html" rel="nofollow">Impressum</a> &nbsp;&bull;&nbsp; Design by <a target="_blank" href="http://www.freecsstemplates.org/">Free CSS Templates</a></p>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-841646-27");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
<?php 
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 


function check($var){
$varsafe=trim(strip_tags($var));
return $varsafe;
}


function ehi_check(){
$achtung=0;
foreach($_POST as $val){
$pos = strpos(strtolower($val), 'content-type:'); if($pos !== false){$achtung++;}
$pos = strpos(strtolower($val), 'content-type');  if($pos !== false){$achtung++;}
$pos = strpos(strtolower($val), 'bcc:');          if($pos !== false){$achtung++;}
$pos = strpos(strtolower($val), 'bcc');           if($pos !== false){$achtung++;}
} //endforeach
return $achtung;  // wenn Null dann Alles Okay
} 


// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
?>