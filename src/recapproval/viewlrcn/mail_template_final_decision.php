<?php
//This research is considered <b>$riskLevel</b>.<br><br>
$allSentMessage="<img src='".$base_url."/files/headers/$rec_header' /><br><br>				 
Dear $ownername,<br><br>     
<b>Re:</b> <b>$public_title</b><br><br>
 $reviewText<br>
Approval of the research is for the period of <b>$Approvaltoday </b>to<b> $endofproject.</b><br><br>

   
As Principal  Investigator of the research, you are responsible for fulfilling the  following requirements of approval:<br>
      <ol start='1' type='1'>
        <li>All co-investigators must be kept informed of the status of the research.</li>
        <li>Changes, amendments, and addenda to the protocol or the consent form must be submitted to the REC for re-review and approval <strong><u>prior</u></strong> to the activation of the changes.</li>

        <li>Reports of unanticipated problems involving risks to participants or any new information which could change the risk benefit: ratio must be submitted to the REC. </li>
        <li>Only approved consent forms are to be used in the enrollment of participants. All consent forms signed by participants and/or witnesses should be retained on file. The REC may conduct audits of all study records, and consent documentation may be part of such audits.</li>
        <li>Continuing review application must be submitted to the REC <b>eight weeks</b> prior to the expiration date of <b>$endofproject</b> in order to continue the study beyond the approved period. Failure to submit a continuing review application in a timely fashion may result in suspension or termination of the study. </li>
        <li>The REC application number assigned to the research should be cited in any correspondence with the REC of record. </li>
        <li>You are required to register the research protocol with the Uganda National Council for Science and Technology (UNCST) for final clearance to undertake the study in Uganda.  </li>
      </ol>
      <p>The following is the list of all documents approved in  this application by $recOriginalName:</p>
<p>&nbsp;</p>
      <table border='1' cellspacing='0' cellpadding='0' align='left' width='100%'>
	   <tr>
          <td width='30' valign='top'><p>&nbsp;</p></td>
          <td width='295'><p align='center'><strong>Document Title</strong></p></td>
          <td width='137'><p align='center'><strong>Language</strong></p></td>
          <td width='97'><p align='center'><strong>Version</strong></p></td>
          <td width='102'><p align='center'><strong>Version Date</strong></p></td>
        </tr>
		$DocumentsSubmitted
	  </table>
	  
<br><br>
$signedby<br>
For: $recOriginalName,<br>
";?>