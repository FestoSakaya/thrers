<?php
$sqlstudypp="SELECT * FROM ".$prefix."submission where `id`='$id' order by id desc limit 0,1";
$Querystudypp = $mysqli->query($sqlstudypp);
$totalstudypp = $Querystudypp->num_rows;
$rstudypp = $Querystudypp->fetch_array();
$code=$rstudypp['code'];
$owner_id=$rstudypp['owner_id'];
$recAffiliated_id=$rstudypp['recAffiliated_id'];
$transfered_by=$_SESSION['asrmApplctID'];
$protocol_title=$rstudypp['public_title'];

if($_POST['doSaveTransfer']=='Transfer Now' and $_POST['transferto'] and $_POST['transferfrom'] and $id and $owner_id and $code and $recAffiliated_id and $transfered_by and $protocol_title){
	require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 

	$transferto=$mysqli->real_escape_string($_POST['transferto']);
	$transferfrom=$mysqli->real_escape_string($_POST['transferfrom']);
	$protocol_id=$mysqli->real_escape_string($id);
	

///Get Original owner details
$sqlMyUser="SELECT * FROM ".$prefix."user where asrmApplctID='$transferfrom'";
$sqlFUser=$mysqli->query($sqlMyUser);
$recUser=$sqlFUser->fetch_array();
$originalname=$recUser['name'];
$originalemail=$recUser['email'];

//Get new owner details
///Get Original owner details
$sqlMyUser2="SELECT * FROM ".$prefix."user where asrmApplctID='$transferto'";
$sqlFUser2=$mysqli->query($sqlMyUser2);
$recUser2=$sqlFUser2->fetch_array();
$newownername=$recUser2['name'];
$newowneremail=$recUser2['email'];

///Get New Rec Receiver email
$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

$contacts=$recNamew['contacts'];
$recOriginalNamem=$recNamew['name'];
$recemail=$recNamew['recemail'];



///////////////////////Now update the transfer table	
$sqlUsers="SELECT * FROM ".$prefix."submission_transfered where `owner_id`='$owner_id' and main_submission_id='$protocol_id' and transfered_from='$transferfrom' and transfered_to='$transferto' order by id desc limit 0,1";
		$QueryUsers = $mysqli->query($sqlUsers);
		$totalUsers = $QueryUsers->num_rows;
		$rUserInv=$QueryUsers->fetch_array();

	
		if(!$totalUsers){
$sqlA2Protocol="insert into ".$prefix."submission_transfered (`owner_id`,`main_submission_id`,`created`,`code`,`recAffiliated_id`,`transfered_from`,`transfered_to`,`transfered_by`) 

values('$owner_id','$protocol_id',now(),'$code','$recAffiliated_id','$transferfrom','$transferto','$transfered_by')";
$mysqli->query($sqlA2Protocol);
$record_id = $mysqli->insert_id;

if($record_id){
/////////////////Get all Tables to chnage Owner ID
$sqlprotocol_main="update ".$prefix."protocol set `owner_id`='$transferto' where owner_id='$transferfrom' and id='$id' ";
$mysqli->query($sqlprotocol_main);
	
$sqlprotocol_main2="update ".$prefix."protocol_comment set `user_id`='$transferto' where user_id='$transferfrom' and protocol_id='$id' ";
$mysqli->query($sqlprotocol_main2);

$sqlprotocol_main3="update ".$prefix."submission set `owner_id`='$transferto' where owner_id='$transferfrom' and id='$id' ";
$mysqli->query($sqlprotocol_main3);
//////////////////////////////////////////////////////////////////

$sqlprotocol_1="update ".$prefix."clinical_study_methodology set `owner_id`='$transferto' where owner_id='$transferfrom' and protocol_id='$id' ";
$mysqli->query($sqlprotocol_1);		

$sqlprotocol_2="update ".$prefix."collaborating_institutions set `owner_id`='$transferto' where owner_id='$transferfrom' and protocol_id='$id' ";
$mysqli->query($sqlprotocol_2);		

$sqlprotocol_3="update ".$prefix."completeness_check_comments set `owner_id`='$transferto' where owner_id='$transferfrom' and protocol_id='$id' ";
$mysqli->query($sqlprotocol_3);

$sqlprotocol_4="update ".$prefix."determination_of_risk set `owner_id`='$transferto' where owner_id='$transferfrom' and protocol_id='$id' ";
$mysqli->query($sqlprotocol_4);

$sqlprotocol_5="update ".$prefix."deviations set `owner_id`='$transferto' where owner_id='$transferfrom' and protocol_id='$id' ";
$mysqli->query($sqlprotocol_5);

$sqlprotocol_6="update ".$prefix."initial_committee_screening set `owner_id`='$transferto' where owner_id='$transferfrom' and protocol_id='$id' ";
$mysqli->query($sqlprotocol_6);

$sqlprotocol_7="update ".$prefix."monitoring_reports set `owner_id`='$transferto' where owner_id='$transferfrom' and protocol_id='$id' ";
$mysqli->query($sqlprotocol_7);

$sqlprotocol_8="update ".$prefix."other_objectives set `owner_id`='$transferto' where owner_id='$transferfrom' and protocol_id='$id' ";
$mysqli->query($sqlprotocol_8);
////////////////////////////////////////**********************************///////////////////
$sqlprotocol_9="update ".$prefix."publications set `owner_id`='$transferto' where owner_id='$transferfrom' and protocol_id='$id' ";
$mysqli->query($sqlprotocol_9);

$sqlprotocol_10="update ".$prefix."research_project_expenditure set `rstug_user_id`='$transferto' where rstug_user_id='$transferfrom' and rstug_rsch_project_id='$id' ";
$mysqli->query($sqlprotocol_10);

$sqlprotocol_11="update ".$prefix."research_project_expenditure_local set `rstug_user_id`='$transferto' where rstug_user_id='$transferfrom' and rstug_rsch_project_id='$id' ";
$mysqli->query($sqlprotocol_11);




$sqlprotocol_12="update ".$prefix."saes_measures_mitigate_dev set `owner_id`='$transferto' where owner_id='$transferfrom' and protocol_id='$id' ";
$mysqli->query($sqlprotocol_12);

	
$sqlprotocol_13="update ".$prefix."saes_measures_mitigate_dev_b set `owner_id`='$transferto' where owner_id='$transferfrom' and protocol_id='$id' ";
$mysqli->query($sqlprotocol_13);

$sqlprotocol_14="update ".$prefix."study_approvals set `rstug_user_id`='$transferto' where rstug_user_id='$transferfrom' and rstug_rsch_project_id='$id' ";
$mysqli->query($sqlprotocol_14);

$sqlprotocol_15="update ".$prefix."study_description_age set `owner_id`='$transferto' where owner_id='$transferfrom' and protocol_id='$id' ";
$mysqli->query($sqlprotocol_15);

$sqlprotocol_16="update ".$prefix."study_population set `owner_id`='$transferto' where owner_id='$transferfrom' and protocol_id='$id' ";
$mysqli->query($sqlprotocol_16);
////////////////////////////////////////////////////////************************************

$sqlprotocol_17="update ".$prefix."submission_clinical_trial set `owner_id`='$transferto' where owner_id='$transferfrom' and submission_id='$id' ";
$mysqli->query($sqlprotocol_17);

$sqlprotocol_18="update ".$prefix."submission_country set `owner_id`='$transferto' where owner_id='$transferfrom' and submission_id='$id' ";
$mysqli->query($sqlprotocol_18);

$sqlprotocol_19="update ".$prefix."submission_review_sr set `owner_id`='$transferto' where owner_id='$transferfrom' and protocol_id='$id' ";
$mysqli->query($sqlprotocol_19);

$sqlprotocol_20="update ".$prefix."submission_stages set `owner_id`='$transferto' where owner_id='$transferfrom' and protocol_id='$id' ";
$mysqli->query($sqlprotocol_20);	


$sqlprotocol_21="update ".$prefix."submission_task set `owner_id`='$transferto' where owner_id='$transferfrom' and submission_id='$id' ";
$mysqli->query($sqlprotocol_21);

$sqlprotocol_22="update ".$prefix."submission_upload set `user_id`='$transferto' where user_id='$transferfrom' and submission_id='$id' ";
$mysqli->query($sqlprotocol_22);

$sqlprotocol_23="update ".$prefix."team set `owner_id`='$transferto' where owner_id='$transferfrom' and protocol_id='$id' ";
$mysqli->query($sqlprotocol_23);

$sqlprotocol_24="update ".$prefix."updated_sections set `owner_id`='$transferto' where owner_id='$transferfrom' and protocol_id='$id' ";
$mysqli->query($sqlprotocol_24);

//////////////////////////Send email
require_once("viewlrcn/mail_transfer_protocol.php");

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
$mail->addCc($originalemail,$originalname);//
$mail->addBcc($recemail,"REC Administrator");//

$mail->FromName = "$recOriginalNamem"; //From Name -- CHANGE --
$mail->AddAddress($newowneremail, $newownername); //To Address -- CHANGE --$email
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($recemail, "REC Administrator"); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "REC Protocol Transfer - $protocol_title";
$body="$allSentMessage
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end


$message='<p class="success">Protocol <b>'.$protocol_title.'</b> has been transfered <b>'.$newownername.'</b></p>';

}




		}else{$message='<p class="error2">Protocol has not been transfered. Please check fields provided</p>';}
	
	
}///end Transfer Protocol
	
	?>
    
    
    <form action="" method="post" name="regForm" id="regForm" autocomplte="off">


<span class="label search">Transfer this protocol. Please search email your are transfering to:</span><br />
    <input type="text" name="searchemail" value="<?php echo $_POST['searchemail'];?>" style="border:1px solid #158cba; width:60%; padding:6px; float:left;" placeholder="Search Email Here";/>
<input type="submit" name="doSearch" id="button" class="search btn" value="Search" />
    
    
   <br /> <br />  <br /> 
</form>

<?php if($message){ echo $message.'<br><br>';
echo '<meta http-equiv="REFRESH" content="2;url='.$base_url.'/main.php?option=TransferaProtocol">';
echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';


 }?>

<?php
$searchemail=$_POST['searchemail'];
if($searchemail){
?>
<form action="" method="post" name="regForm" id="regForm" autocomplte="off">

Transfer From<br />
<select name="transferfrom" style="padding:5px;width:60%;" class="required">
<?php
$sqlSRR2 = "select * from ".$prefix."user where asrmApplctID='$owner_id' order by asrmApplctID asc";
$resultSSS2 = $mysqli->query($sqlSRR2);
while($sqUserdd2 = $resultSSS2->fetch_array()){?>
<option value="<?php echo $sqUserdd2['asrmApplctID'];?>"><?php echo $sqUserdd2['name'];?> (<?php echo $sqUserdd2['email'];?>)</option>
<?php }?>

</select>

<br /><br />

Transfer To<br />

<select name="transferto" style="padding:5px;width:60%;" class="required">
<option value="">Please Select from list</option>
<?php
$sqlSRR2 = "select * from ".$prefix."user where email like '%$searchemail%' order by asrmApplctID asc";
$resultSSS2 = $mysqli->query($sqlSRR2);
while($sqUserdd2 = $resultSSS2->fetch_array()){?>
<option value="<?php echo $sqUserdd2['asrmApplctID'];?>"><?php echo $sqUserdd2['name'];?> (<?php echo $sqUserdd2['email'];?>)</option>
<?php }?>

</select>
<br /><br />
Protocol<br />

<textarea name="public_title" cols="" rows="" style="width:60%;" disabled="disabled"><?php echo $rstudypp['public_title'];?></textarea>
 
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveTransfer" type="submit"  class="btn btn-primary" value="Transfer Now"/>

                          </div>
                        </div>
   <?php }?>
   
</form>


