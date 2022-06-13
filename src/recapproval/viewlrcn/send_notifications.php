<?php
$sendTextDate=$mysqli->real_escape_string("<b>$Approvaltoday</b>");
 $sendTextHr=$mysqli->real_escape_string("<b>$recOriginalName</b><br>
	<b>$contacts</b><br>
    <b>$recemail</b>");
$sendText1=$mysqli->real_escape_string("To: $ownername<br><br>
   $institution<br>
   $phone<br><br> 
   <strong>Type:</strong> Safety and Other Notifications<br><br>
   <b>Re:</b> <b>$public_title</b><br><br>
");
// $sendTextStudyTools=$mysqli->real_escape_string("$DocumentsSubmitted");
 $sendText2=$mysqli->real_escape_string("$messageSent<br><br>");

 $sendText3=$mysqli->real_escape_string("
$signedby<br>
For: $recOriginalName,<br>
Date: $Approvaltoday<br><br>");