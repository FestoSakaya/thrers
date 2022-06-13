<?php
//This research is considered <b>$riskLevel</b>.<br><br>
$allSentMessage="<div style='background-color:#F6F9FC;color:#525f7f; width:100%;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Ubuntu,sans-serif;font-size:16px;line-height:24px; margin:0;outline:none;padding:15px;'>
    <table border='0' cellpadding='0' cellspacing='0' height='100%' style='table-layout:fixed' width='100%'>
        <tbody>
            <tr>
                <td align='center' valign='top'>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout:fixed;max-width:900px;'>
                        <tbody>    
                            <tr>
                                <td align='center' valign='top'>
                                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='background-color:#ffffff;color:#ffffff;border-radius:5px 5px 0 0;table-layout:fixed'>
                                        <tbody>
                                            <tr>
                                                <td align='center' style='padding-bottom:15px;text-transform:uppercase;padding-top:30px' valign='middle'>
                                             
											 <img src='".$base_url."/files/headers/$rec_header' />
											 
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>  
                            <tr>
                                <td align='center' style='background-color:#ffffff;border-radius:0 0 5px 5px;' valign='top'>
                                    <table border='0' cellpadding='0' cellspacing='0' style='table-layout:fixed' width='100%'>
                                        <tbody>
                                            <tr>
                                                <td align='left' valign='top' style='padding-bottom:30px;padding-top:40px;color: #525f7f;font-weight:400;'>

<table width='100%' border='0'>
  <tr>
    <td width='64%' align='left' valign='top'>
    $recOriginalName<br>
	$contacts<br>
    $recemail
    
    </td>
    <td width='36%' align='left' valign='top'><b>$Approvaltoday</b></td>
  </tr>
  <tr>
    <td colspan='2' align='left' valign='top'><p align='center'><b>REC APPROVAL NOTICE</b></p></td>
  </tr>
  <tr>
    <td colspan='2' align='left' valign='top'>
   To: $ownername<br><br>
   $institution<br>
   $phone<br><br> 
   <strong>Type:</strong> Initial Review<br><br>

      
<b>Re:</b> <b>$protocolCode:  $public_title, $ProtocolVersion, $DateofProposal</b><br><br></td>
  </tr>
  <tr>
    <td colspan='2' align='left' valign='top'>$reviewText<br>
    
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
	  
    </td>
  </tr>
  <tr><td colspan='2'>
Signed,<br><br>
<img src='".$base_url."/files/signatures/$signature' /><br>
$ReviewerName<br>
For: $recOriginalName,<br>
Date: $Approvaltoday<br><br>

cc: UNCST
  
  </td></tr>
  
</table>

                                                </td>
                                            </tr>          
                                              
                                         
                                        </tbody>
                                    </table>    
                                </td>
                            </tr>
                            <tr>
                                <td align='left' valign='top'>
                                    <table border='0' cellpadding='0' cellspacing='0' style='table-layout:fixed' width='100%'>
                                        <tbody>
                                            <tr>
                                                <td align='center' valign='top'>
                                                    <table border='0' cellpadding='0' cellspacing='0' style='padding-top:15px;padding-bottom:30px;table-layout:fixed' width='100%'>
                                                        <tbody>
                                                            <tr>
                                                                <td align='center' colspan='3' style='font-size:12px;line-height:1.5;padding-top:20px'>
                                                                    Copyright © $year Uganda National Concil for Science and Technology -UNCST. <span>All rights reserved.</span>
                                                                </td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>";?>