<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Notice for Withdrawal of Submission</a></li>

</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."submission where id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$public_title=$rstudym['public_title'];
$ProtoclRefNo=$rstudym['code'];
$protocol_idwe=$rstudym['protocol_id'];
$recAffiliated_idREC=$rstudym['recAffiliated_id'];

/////Get Email for REC Admin list_rec_affiliated

if($category=='WithdrawSubmission' and $owner_id and $ProtoclRefNo and $recAffiliated_idREC){
	
$sql_rec = "select * from ".$prefix."list_rec_affiliated where id='$recAffiliated_idREC'";
$result_rec = $mysqli->query($sql_rec);
$sqrec = $result_rec->fetch_array();
$sqrec['name'];
$recemail=$sqrec['recemail'];
$recchairEmail=$sqrec['recchairEmail'];
$recChairName=$sqrec['recChairName'];

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
$Piemail=$sqUserdd['email'];
$PiName=$sqUserdd['name'];
$phone=$sqUserdd['phone'];
$institution=$sqUserdd['institution'];

$update="update ".$prefix."submission set is_sent='0',assignedto='Not Assigned',CompletenessCheck='Pending' where protocol_id='$protocol_idwe' and owner_id='$owner_id'";
$mysqli->query($update);
$sql_stages = "select * from ".$prefix."submission_stages set status='new' where asrmApplctID='$owner_id' and protocol_id='$protocol_idwe'";
$mysqli->query($sql_stages);

/////////////update stages
$updateww="update ".$prefix."submission_stages set status='new' where  	protocol_id='$protocol_idwe' and owner_id='$owner_id'";
$mysqli->query($updateww);





require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");

///Now Send mail
//require_once("viewlrcn/mail_template_assign_reviewers.php");
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
/////////////////////////////Begin Mail Body
//$mail->addCc('mutumba.beth@yahoo.com',$recOriginalName);//
$mail->addBcc('uncstuncstapps@gmail.com',"NRIMS-UNCST");//$mail->addBcc('notifications@uncst.go.ug',"NRIMS-UNCST");

$mail->FromName = "REC - $PiName"; //From Name -- CHANGE --
$mail->AddAddress($Piemail, $PiName); //To Address -- CHANGE --
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($Piemail, $PiName); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Notice for Withdrawal of Submission - $ProtoclRefNo";
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
                                                    Notice for Withdrawal of Submission - $ProtoclRefNo</h1>
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

Dear $recChairName<br><br>

<b>Subject: Notice for Withdrawal of Submission Ref No: $ProtoclRefNo</b><br><br>

This is to notify you that submission : <b>$public_title</b>, Ref No: <b>$ProtoclRefNo</b> has been withdrawn.<br><br>

Thank you,
<br><br>

Best Regards<br>
$Piemail<br>
$PiName<br>
$phone<br>
$institution
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
	//echo "Mailer Error: " . $mail->ErrorInfo;
}///end


echo $message='<p class="success">Thank you, reviewer has been included on this protocol.</p>';





$message='<p class="success">Thank you, action has been sent.</p>';
	echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="1; url='.$base_url.'/main.php?option=dashboard" />';
}
?>
</div>