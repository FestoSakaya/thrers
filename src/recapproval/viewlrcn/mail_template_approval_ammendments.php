<?php
//This research is considered <b>$riskLevel</b>.<br><br>
$allSentMessage="<img src='".$base_url."/files/headers/$rec_header' /><br><br>	
      
<b>Re:</b> <b>$public_title</b><br></td>
  </tr>
  
  <tr>
    <td colspan='2' align='left' valign='top'><p>I am pleased to inform you that at the <strong>$MeetingNumber</strong> convened meeting on <strong>$Meetingdate,</strong> the $recOriginalName voted to approve the changes to the above referenced study.  </p>

<p>Please note that the approval of the research is valid until <b> $endofproject.</b>. <b>The approved changes to the study include;</b>	</p>
<b>$screening</b>	
	

<p>As Principal  Investigator of the research, you are responsible for fulfilling the  following requirements of approval:</p>
<ol start='1' type='1'>
  <li>All co-investigators must be kept informed of the status of the research.</li>
  <li>Changes, amendments, and addenda to the protocol or the consent form must be submitted to the REC for re-review and approval <strong><u>prior</u></strong> to the activation of the changes.</li>
  <li>Reports of unanticipated problems involving risks to participants or any new information which could change the risk benefit: ratio must be submitted to the REC. </li>
  <li>Only approved consent forms are to be used in the enrollment of participants.  All consent forms signed by participants and/or witnesses should be retained on file.  The REC may conduct audits of all study records, and consent documentation may be part of such audits.</li>
  <li>Continuing review application must be submitted to the REC <u>eight weeks</u> prior to the expiration date of <strong>$endofproject</strong> in order to continue the study beyond the approved period<strong>.</strong> Failure to submit a continuing review application in a timely fashion may result in suspension or termination of the study.</li>
  <li>The REC application number assigned to the research should be cited in any correspondence with the REC of record. </li>
  <li>You are required to notify the Uganda National Council for Science and Technology (UNCST) for final clearance to undertake the study in Uganda.  </li>
</ol>

	 
The following is the list of all documents approved in  this application by $recOriginalName:<br><br>

<table border='1' cellspacing='3' cellpadding='3' align='left' width='100%'>
  <tr>
    <td width='30' valign='top'>&nbsp;</td>
    <td width='295'><strong>Document Title</strong></td>
    <td width='137'><strong>Language</strong></td>
    <td width='97'><strong>Version</strong></td>
    <td width='102'><strong>Version Date</strong></td>
  </tr>
  $DocumentsSubmitted
</table>
 
    </td>
  </tr>
  <tr><td colspan='2'>
Signed,<br><br>
$ReviewerName<br>
For: $recOriginalName,<br>
Date: $Approvaltoday<br><br>
cc: UNCST  
  </td></tr>
  
</table>
";?>