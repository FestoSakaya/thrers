<?php
$Approvaltoday2=date("d/m/Y");
$allSentMessageConditional="<img src='".$base_url."/files/headers/$rec_header' /><br><br>
Dear $ownername,<br><br>
      
<b>Re:</b> <b>$public_title</b><br><br>

This is to inform you that the <b>$recOriginalName</b> held on <b>$Meetingdate</b> reviewed the initial submission of the above-named study and granted conditional approval. The committee however noted the following that need to be addressed;<br><br>	
$screeningmessage<br><br>	
Note: You are requested to address the above comments within 4 weeks<br>

<table width='100%' border='0' class='customers'>
<tr>
    <th width='6%' valign='top' bgcolor='#0099FF' style='padding:3px; color:#FFFFFF;'><p><strong>No. </strong></p></th>
    <th width='17%' valign='top' bgcolor='#0099FF' style='padding:3px; color:#FFFFFF;'><p><strong>Document Title</strong></p></th>
    <th width='30%' valign='top' bgcolor='#0099FF' style='padding:3px; color:#FFFFFF;'><p><strong>Language</strong></p></th>
    <th width='22%' valign='top' bgcolor='#0099FF' style='padding:3px; color:#FFFFFF;'><p><strong>Version Number</strong></p></th>
    <th width='13%' valign='top' bgcolor='#0099FF' style='padding:3px; color:#FFFFFF;'><p><strong>Version Date</strong></p></th>
  </tr>
$DocumentsSubmitted
</table><br><br>

Yours Sincerely <br> 
$signedby<br>
For: $recOriginalName,<br>
";?>