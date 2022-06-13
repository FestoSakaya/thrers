<?php
$sendTextDate=$mysqli->real_escape_string("<b>$Approvaltoday</b>");
 $sendTextHr=$mysqli->real_escape_string("<b>$recOriginalName</b><br>
	<b>$contacts</b><br>
    <b>$recemail</b>");
$sendText1=$mysqli->real_escape_string("To: $ownername<br><br>
   $institution<br>
   $phone<br><br> 
   <strong>Type:</strong> $type_of_review<br><br>
   <b>Re:</b> <b>$public_title</b><br><br>
");
 $sendTextStudyTools=$mysqli->real_escape_string("$DocumentsSubmitted");
 $sendText2=$mysqli->real_escape_string("This is to inform you that the <b>$recOriginalName</b> at its <strong>$MeetingNumber</strong> held on <b>$Meetingdate</b> reviewed the $type_of_review of the above-named study. The committee noted the following that need to be addressed;<br><br>
$screeningmessage<br><br>");

 $sendText3=$mysqli->real_escape_string("Signed,<br><br>
$ReviewerName<br>
For: $recOriginalName,<br>
Date: $Approvaltoday<br><br>

cc: UNCST");