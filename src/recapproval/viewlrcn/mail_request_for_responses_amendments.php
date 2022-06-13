<?php
$Approvaltoday2=date("d/m/Y");
$allSentMessageConditional="<img src='".$base_url."/files/headers/$rec_header' /><br><br>
Dear $ownername,<br><br>
      
<b>Re:</b> <b>$public_title</b><br><br>

This is to inform you that the <b>$recOriginalName</b> at its <strong>$MeetingNumber</strong> held on <b>$Meetingdate</b> reviewed the Amendment of the above-named study. The committee noted the following that need to be addressed;<br><br>

$screeningmessage<br><br>	
Note: You are requested to address the above comments within 4 weeks<br>

Yours Sincerely <br> 
$signedby<br>
For: $recOriginalName,<br>
";?>