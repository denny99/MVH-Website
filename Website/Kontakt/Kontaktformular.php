<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unbenanntes Dokument</title>
</head>

<body>
<?php
// wenn das Formular übermittelt wurde
if(isset($_POST['abschicken'])){
  while(list($feld,$wert)=each($_POST)){
    // übermittelte Inhalte "entschärfen"
    $wert=preg_replace("/(content-type:|bcc:|cc:|to:|from:)/im", "",$wert);
    $$feld=$wert;
    // die übermittelten Variablen werden zum "Text der Email" zusammengefasst
    if($feld!="abschicken") $mailnachricht.=ucfirst($feld).": $wert\n";
  }
  $mailnachricht.="\nDatum/Zeit: ". date("d.m.Y H:i:s");
  // Überprüfen ob alle Pflichtfelder gefüllt sind
  empty($nachname) ? $err[] = "<p>- Bitte den Nachnamen angeben.</p>" : false;
  empty($vorname) ? $err[] = "<p>- Bitte den Vornamen angeben.</p>" : false;
  empty($email) ? $err[] = "<p>- Bitte die Email-Adresse angeben.</p>" : false;
  empty($text) ? $err[] = "<p>- Welchen Wunsch haben Sie? Bitte den Text eingeben.</p>" : false;
  // wenn nicht, werden die Fehlermeldungen ausgegeben und das "halbgefüllte" Formular angezeigt
  if(!empty($err)) {
    echo "<p>Bitte korrigieren Sie folgende Fehler:</p>";
    foreach($err as $fehler){
      echo $fehler;
    } ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table width="100%" border="0" cellpadding="3" cellspacing="1">
    <tr><td width="140" align="right">*Nachname:</td><td align="left"><input type="text" name="nachname" value="<?php echo $nachname; ?>" style="width:100%;" /></td></tr>
    <tr><td align="right">*Vorname:</td><td align="left"><input type="text" name="vorname" value="<?php echo $vorname; ?>" style="width:100%" /></td></tr>
    <tr><td align="right">Firma:</td><td align="left"><input type="text" name="firma" value="<?php echo $firma; ?>" style="width:100%" /></td></tr>
    <tr><td align="right">Postanschrift:</td><td align="left"><input type="text" name="strasse" value="<?php echo $strasse; ?>" style="width:100%" /></td></tr>
    <tr><td align="right">Telefon:</td><td align="left"><input type="text" name="telefon" value="<?php echo $telefon; ?>" style="width:100%" /></td></tr>
    <tr><td align="right">*E-Mail:</td><td align="left"><input type="text" name="email" value="<?php echo $email; ?>" style="width:100%" /></td></tr>
    <tr><td colspan="2"><textarea rows="12"  style="width:100%" name="text"><?php echo $text; ?></textarea></td><td> </td></tr>
    <tr><td colspan="2" align="left" nowrap><br /><input type="reset" value="Formular l&ouml;schen" style="width:49%" />  <input type="submit" name="abschicken" class="button" value="Formular absenden" style="width:49%" /></td></tr>
    </table>
    </form>
    <p>*Pflichtfelder</p>
<?php    // sind keine Fehler vorhanden, wird die Email versendet
  } else {
    $mailbetreff="Kontaktformular ".$_SERVER['HTTP_HOST'];
    // HIER DIE EMPFÄNGER EMAIL-ADRESSE ANPASSEN!!!       
    echo (mail("adresse@domain.tld", $mailbetreff, $mailnachricht, "From: $email")) ? "<p>Vielen Dank für Ihre eMail!</p>": "<p>Ein Fehler ist aufgetreten!</p>";
  }
// das Formular welches als erstes dem Besucher angezeigt wird
} else { ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <table width="100%" border="0" cellpadding="3" cellspacing="1">
    <tr><td width="140" align="right">*Nachname:</td><td align="left"><input type="text" name="nachname" value="" style="width:100%;" /></td></tr>
    <tr><td align="right">*Vorname:</td><td align="left"><input type="text" name="vorname" value="" style="width:100%" /></td></tr>
    <tr><td align="right">Firma:</td><td align="left"><input type="text" name="firma" value="" style="width:100%" /></td></tr>
    <tr><td align="right">Postanschrift:</td><td align="left"><input type="text" name="strasse" value="" style="width:100%" /></td></tr>
    <tr><td align="right">Telefon:</td><td align="left"><input type="text" name="telefon" value="" style="width:100%" /></td></tr>
    <tr><td align="right">*E-Mail:</td><td align="left"><input type="text" name="email" value="" style="width:100%" /></td></tr>
    <tr><td colspan="2"><textarea rows="12"  style="width:100%" name="text"></textarea></td><td> </td></tr>
    <tr><td colspan="2" align="left" nowrap><br /><input type="reset" value="Formular l&ouml;schen" style="width:49%" />  <input type="submit" name="abschicken" value="Formular absenden" style="width:49%" /></td></tr>
    </table>
    </form>
    <p>*Pflichtfelder</p>
    <br />
    <br />
    <br />
    <br /><!-- bitte lassen Sie diesen Link sichtbar auf Ihrer Seite. Danke! -->
    <p style="text-align:right;font:normal 10px Verdana, Arial, Helvetica, sans-serif;"><a href="http://www.easy-bytes.de/" target="_blank">Easy Bytes Webdesign</a></p>
<?php
}
?>
</body>
</html>