<?php
$submittedprotocol_id=$mysqli->real_escape_string($_POST['submittedprotocol_id']);
$applicantID=$mysqli->real_escape_string($_POST['applicantID']);
$subjectCall=$mysqli->real_escape_string($_POST['subjectCall']);
$MainrecAffiliated_c=$mysqli->real_escape_string($_POST['MainrecAffiliated_c']);
$public_title_main=$mysqli->real_escape_string($_POST['public_title_main']);

$categoryChunks3 = explode("|", $reviewerID);

$chop1="$categoryChunks3[0]";
$chop2="$categoryChunks3[1]";
$chop3="$categoryChunks3[2]";
$chop4="$categoryChunks3[3]";
$chop5="$categoryChunks3[4]";

$queryConceptLogsExist="select * from ".$prefix."submission_review_sr where (id='$chop1' || id='$chop2' || id='$chop3' || id='$chop4' || id='$chop5')";
$rsConceptLogsExist=$mysqli->query($queryConceptLogsExist);
$sqSubmissionExist = $rsConceptLogsExist->fetch_array();
$Mreviewer_id=$sqSubmissionExist['reviewer_id'];
// and asrmApplctID!='$Mreviewer_id'
$sqlReviewer_a="SELECT * FROM ".$prefix."user  where recAffiliated_id='$recAffiliated_idREC' and privillage='recreviewer' and asrmApplctID!='$chop1' and asrmApplctID!='$chop2' and asrmApplctID!='$chop3' and asrmApplctID!='$chop4' and asrmApplctID!='$chop5' order by asrmApplctID asc";
$QueryReviewer_a=$mysqli->query($sqlReviewer_a);
while($sqReviewer_a = $QueryReviewer_a->fetch_array()){
$assignedtoName=$sqReviewer_a['name'];
$cfnreviewerTertiary=$sqReviewer_a['asrmApplctID'];

$assignedtoName_a=$sqReviewer_a['name'];
$usrm_email_a=$sqReviewer_a['email'];

$queryConceptLogs="select * from ".$prefix."submission_review_sr where protocol_id='$submittedprotocol_id' and reviewer_id='$cfnreviewerTertiary' and reviewStatus='Pending'  and reviewFor='protocol' order by id desc";
$rsConceptLogs=$mysqli->query($queryConceptLogs);
$rTotalConceptLogs=$rsConceptLogs->num_rows;



if(!$rTotalConceptLogs){//$subject and 
$sqlA2rr="insert into ".$prefix."submission_review_sr (`asrmApplctID`,`protocol_id`,`owner_id`,`reviewer_id`,`reviewDate`,`recstatus`,`protocolStage`,`reviewtype`,`subject`,`recAffiliated_c`,`reviewFor`,`conflictofInterest`,`sent_email`) 

values('$cfnreviewerTertiary','$submittedprotocol_id','$asrmApplctID_user','$cfnreviewerTertiary',now(),'new','stage1','Tertiary','$subjectCall','$MainrecAffiliated_c','protocol','none','No')";
$mysqli->query($sqlA2rr);
}



//Hide, Scron job will email to all of them
$mail = new PHPMailer(true); //important
$mail->IsSMTP(); // set mailer to use SMTP
$mail->Port = "587"; // SMTP Port
$mail->CharSet =  "utf-8";
$mail->Host = "$usmtpHost"; // specify SMTP server//nemesis.eahd.or.ug mailhost02.cfi.co.ug
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->SMTPSecure = 'tls';
$mail->SMTPDebug = 0;


$mail->Username = "uncstuncstapps@gmail.com"; // SMTP username -- CHANGE --
$mail->Password = "lpupvbvillxraaey"; // SMTP password -- CHANGE --
$mail->setFrom("uncstuncstapps@gmail.com", "Admin");

$mail->FromName = "REC - $recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($usrm_email_a, $assignedtoName_a); //To Address -- CHANGE --
$mail->AddReplyTo($usrm_email_a, $assignedtoName_a); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "$subject - Protocol for Review";
$body="<div style='background-color:#F6F9FC;color:#525f7f; width:100%;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Ubuntu,sans-serif;font-size:16px;line-height:24px; margin:0;outline:none;padding:15px;'>
    <table border='0' cellpadding='0' cellspacing='0' height='100%' style='table-layout:fixed' width='100%'>
        <tbody>
            <tr>
                <td align='center' valign='top'>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout:fixed;max-width:900px;'>
                        <tbody>    
                            <tr>
                                <td align='center' valign='top'>
                                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='background-color:#0C5CBE;color:#ffffff;border-radius:5px 5px 0 0;table-layout:fixed'>
                                        <tbody>
                                            <tr>
                                                <td align='center' style='padding-bottom:15px;text-transform:uppercase;padding-top:30px' valign='middle'>
                                                    <h1 style='color:white;text-align:center;font-size:24px;line-height:1.2em;max-width:100%;vertical-align:middle;word-wrap:break-word'>
                                                     Protocol for Review</h1>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>  
                            <tr>
                                <td align='center' style='background-color:#ffffff;border-radius:0 0 5px 5px;' valign='top'>
                                    <table border='0' cellpadding='0' cellspacing='0' style='table-layout:fixed' width='85%'>
                                        <tbody>
                                            <tr>
                                                <td align='left' valign='top' style='padding-bottom:30px;padding-top:40px;color: #525f7f;font-weight:400;'>

Dear $assignedtoName_a !<br><br>
<b>RE: $subjectCall - $cfnreviewerTertiary</b><br><br>
A protocol, '<b>$public_title_main</b>' has been assigned to you for review as <b>Tertiary Reviewer</b>. Please <a href='".$base_url."/'>Click here</a>  to access the protocol.<br><br>
$subjectCall<br>
Do not hesitate to contact us on the adress below incase of any difficulties accessing the system.<br>

Thank you,
<br><br>

Best Regards<br>
$contacts
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
</div>";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end






}
?>