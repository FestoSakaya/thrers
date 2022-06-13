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
 $sendText2=$mysqli->real_escape_string("This is to invite you for a face to face meeting to present the above mentioned study proposal to the <b>$recOriginalName</b>. The <strong>$MeetingNumber</strong> meeting is scheduled for <b>$meeting_set_date</b> at <b>$meetingplace</b>. <br><br>
For any further details please do not hesitate to contact the REC admin 
<br><br>");

 $sendText3=$mysqli->real_escape_string("
$signedby<br>
For: $recOriginalName,<br>
Date: $Approvaltoday<br><br>");