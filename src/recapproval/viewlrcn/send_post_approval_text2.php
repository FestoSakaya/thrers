<?php
$sendTextDate=$mysqli->real_escape_string("<b>$Approvaltoday</b>");
 $sendTextHr=$mysqli->real_escape_string("<b>$recOriginalName</b><br>
	<b>$contacts</b><br>
    <b>$recemail</b>");
$sendText1=$mysqli->real_escape_string("To: $ownername<br><br>
   $institution<br>
   $phone<br><br> 
   <strong>Type:</strong> Annual Renewal<br><br>
   <b>Re:</b> <b>$public_title</b><br><br>
");
 $sendTextStudyTools=$mysqli->real_escape_string("$DocumentsSubmitted");
 $sendText2=$mysqli->real_escape_string("<p>$screeningmessage</p>");

 $sendText3=$mysqli->real_escape_string("Signed,<br><br>
$ReviewerName<br>
For: $recOriginalName,<br>
Date: $Approvaltoday<br><br>

cc: UNCST");