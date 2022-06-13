<?php
//This research is considered <b>$riskLevel</b>.<br><br>
$allSentMessage="
<img src='".$base_url."/files/headers/$rec_header' /><br><br>				 
Dear $ownername,<br><br>     
<b>Re:</b> <b>$public_title</b><br><br>

<p>I am pleased to inform you that at the <strong>$MeetingNumber</strong> convened meeting on <strong>$Meetingdate</strong>, the <b>$recOriginalName</b> reviewed the progress report to the above study reference number <strong>$initialReferenceNumber</strong> and found it satisfactory. In this respect, annual renewal of the study is granted. The study was initially approved on <strong>$initialApprovaldate</strong> and expired on <strong>$InitialExpiryDate</strong>.</p>

<p>The Approval of the research is for the period of <b>$Approvaltoday </b>to<b> $endofproject.</b></p>

<p>As Principal  Investigator of the research, you are responsible for fulfilling the  following requirements of approval:</p>
<ol start='1' type='1'>
  <li>All co-investigators must be kept informed of the status of the research.</li>
  <li>Changes, amendments, and addenda to the       protocol or the consent form must be submitted to the REC for re-review       and approval <strong><u>prior</u></strong> to the activation of the changes.</li>
  <li>Reports of unanticipated problems       involving risks to participants or any new information which could change       the risk benefit: ratio must be submitted to the REC. </li>
  <li>Only approved consent forms are to be used       in the enrollment of participants.        All consent forms signed by participants and/or witnesses should be       retained on file.  The REC may conduct       audits of all study records, and consent documentation may be part of such       audits.</li>
  <li>Continuing       review application must be submitted to the REC <u>eight weeks</u> prior to the expiration date of <strong>$endofproject</strong> in order to continue the study beyond the approved period<strong>.</strong>  Failure to submit a continuing review       application in a timely fashion may result in suspension or termination of       the study.  </li>
  <li>The REC application number assigned to the       research should be cited in any correspondence with the REC of record. </li>
  <li>You are required to notify the Uganda National Council for Science and       Technology (UNCST) for final clearance to undertake the study in Uganda.  </li>
</ol>

	  
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