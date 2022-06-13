<?php
$sendTextDate=$mysqli->real_escape_string("<b>$Approvaltoday</b>");
 $sendTextHr=$mysqli->real_escape_string("<b>$recOriginalName</b><br>
	<b>$contacts</b><br>
    <b>$recemail</b>");
$sendText1=$mysqli->real_escape_string("To: $ownername<br><br>
   $institution<br>
   $phone<br><br> 
   <strong>Type:</strong> Protocol Amendment<br><br>
   <b>Re:</b> <b>$public_title</b><br><br>
");
 $sendTextStudyTools=$mysqli->real_escape_string("$DocumentsSubmitted");
 $sendText2=$mysqli->real_escape_string("This is to inform you that the <b>$recOriginalName</b> held on <b>$Meetingdate</b> reviewed the Amendment of the above-named study and granted conditional approval. The committee however noted the following that need to be addressed;<br><br>
	
$screeningmessage<br><br>
	
Note: You are requested to address the above comments within 4 weeks<br>");

 $sendText3=$mysqli->real_escape_string("
$signedby<br>
For: $recOriginalName,<br>
Date: $Approvaltoday<br><br>");