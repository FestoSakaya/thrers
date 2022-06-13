<?php
$sessionasrmApplctID=$_SESSION['asrmApplctID'];
$sqlstudy="SELECT * FROM ".$prefix."renewals where `owner_id`='$sessionasrmApplctID' and is_sent='0' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];
$protocol_id2=$rstudy['protocol_id'];
//submission_stages
$sqlSub_Stages="SELECT * FROM ".$prefix."annual_stages where `owner_id`='$sessionasrmApplctID' and status='new' and annual_id='$id' order by id desc limit 0,1";
$QuerySub_stages = $mysqli->query($sqlSub_Stages);
$totalSub_Stages = $QuerySub_stages->num_rows;
$rsSubStages = $QuerySub_stages->fetch_array();
?><ul id="countrytabs" class="shadetabs">


<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenual&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['protocol_information']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_information']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</li><?php }?>



<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenualSecond&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['status_of_participants']==1 and $rsSubStages['status_of_participants']==1){?> style="background:green; color:#FFF;" <?php }?>>Literature & Challanges</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['status_of_participants']==1){?> style="background:green; color:#FFF;" <?php }?>>Status of Participants & Specimens</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenualThird&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['literature']==1){?> style="background:green; color:#FFF;" <?php }?>>Literature & Challanges</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['literature']==1){?> style="background:green; color:#FFF;" <?php }?>>Status of Future Plans/Activities</li><?php }?>


<li><a href="#" rel="#default" class="selected" <?php if($rsSubStages['future_plans']==1 and $rsSubStages['future_plans']==1){?> style="background:green; color:#FFF;" <?php }?>>Future Plans/Activities</a></li>

</ul>
<script>
function deleteRow(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable').deleteRow(-1);
	//document.getElementById("myTable").deleteRow(0);
}


function insRow()
{
    console.log( 'hi');
    var x=document.getElementById('POITable');
    var new_row = x.rows[1].cloneNode(true);
    var len = x.rows.length;
    new_row.cells[0].innerHTML = len;
    
    var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
    inp1.id += len;
    inp1.value = '';
	
    var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
    inp2.id += len;
    inp2.value = '';
		
    /*var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
    inp3.id += len;
    inp3.value = '';*/
	
    x.appendChild( new_row );
}

function insRow2()
{
    console.log( 'hi');
    var x=document.getElementById('POITable2');
    var new_row = x.rows[1].cloneNode(true);
    var len = x.rows.length;
    new_row.cells[0].innerHTML = len;
    
    var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
    inp1.id += len;
    inp1.value = '';
	
    var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
    inp2.id += len;
    inp2.value = '';
		
    /*var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
    inp3.id += len;
    inp3.value = '';*/
	
    x.appendChild( new_row );
}
</script>
<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">

<?php
if($category=='FinalRenewalSubmit'){
	////Get Protocol ID
	////Get Protocol ID
	////Get Protocol ID
$sqlstudy="SELECT * FROM ".$prefix."renewals where `id`='$id'  order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$rstudy = $Querystudy->fetch_array();

$public_title=$rstudy['public_title'];
$recAffiliated_idmm=$rstudy['recAffiliated_id'];

$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_idmm'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

$contacts=$recNamew['contacts'];
$recOriginalNamem=$recNamew['name'];
//PI Name
$sqlMyUser="SELECT * FROM ".$prefix."user where asrmApplctID='$asrmApplctID'";
$sqlFUser=$mysqli->query($sqlMyUser);
$recUser=$sqlFUser->fetch_array();
$name=$recUser['name'];
$email=$recUser['email'];

	//FInish submission
$sqlA2Protocol1="update ".$prefix."renewals_summary  set `is_sent`='1' where `owner_id`='$sessionasrmApplctID' and is_sent='0' and annual_id='$id'";
$mysqli->query($sqlA2Protocol1);

$sqlASubmissionStages2="update ".$prefix."annual_stages  set `status`='completed' where `owner_id`='$sessionasrmApplctID' and status='new' and annual_id='$id'";
$mysqli->query($sqlASubmissionStages2);

$sqlASubmissionStages3="update ".$prefix."renewals_literature  set `is_sent`='1' where `owner_id`='$sessionasrmApplctID' and is_sent='0' and annual_id='$id'";
$mysqli->query($sqlASubmissionStages3);

$sqlASubmissionStages4="update ".$prefix."renewals  set `is_sent`='1' where `owner_id`='$sessionasrmApplctID' and is_sent='0' and id='$id'";
$mysqli->query($sqlASubmissionStages4);

require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 


///Now Send mail
require_once("viewlrcn/mail_template_make_final_submission_renewal.php");

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
$mail->addCc('mutumba.beth@yahoo.com',$recOriginalNamem);//
$mail->addBcc('uncstuncstapps@gmail.com',$recOriginalNamem);//

$mail->FromName = "$recOriginalNamem"; //From Name -- CHANGE --
$mail->AddAddress($email, $name); //To Address -- CHANGE --$email
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "REC Protocol Renewal Confirmation - $public_title";
$body="$allSentMessage
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end



$message="<p class='success'>Dear $name !<br><br>
Thank you for your renewal for protocol titled, '<b>$public_title</b>' Your renewal has been submitted on <b>$today</b>.<br /><br />

Best Regards<br>
$contacts<br><br></p>";




echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=AnnualRenualMa&id='.$id.'">';
}



$sqlstudypp="SELECT * FROM ".$prefix."renewals_summary where `owner_id`='$sessionasrmApplctID' and is_sent='0' and annual_id='$id' order by id desc limit 0,1";
$Querystudypp = $mysqli->query($sqlstudypp);
$totalstudypp = $Querystudypp->num_rows;
$rstudypp = $Querystudypp->fetch_array();
if(isset($message)){echo $message;}
?>
                  
</div>

<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>