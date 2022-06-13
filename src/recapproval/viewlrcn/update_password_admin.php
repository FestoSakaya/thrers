

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">

<?php
if($_POST['doSaveFirst']=='Save' and $_POST['CurrentPassword']){


	
	$asrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
$CurrentPassword=$mysqli->real_escape_string($_POST['CurrentPassword']);
$pwd=$mysqli->real_escape_string(md5($_POST['pwd']));
$Notpwd=$mysqli->real_escape_string($_POST['pwd']);


$qR33="select * from ".$prefix."user where asrmApplctID='$id'";
$R33=$mysqli->query($qR33);
$Results_T33=$R33->fetch_array();
$username=$Results_T33['username'];
$user_email=$Results_T33['email'];
$fullName=$Results_T33['name'];
$rstug_user_password=$Results_T33['password'];
$rstug_oldpassword=$Results_T33['rstug_oldpassword'];

if($_POST['CurrentPassword']=='KeepoldPassword'){
 $Insert_QR2="update ".$prefix."user set `rstug_oldpassword`='$rstug_user_password',`is_active`='1' where asrmApplctID='$id'";
$cmd_QR2=$mysqli->query($Insert_QR2) ;
}

if($_POST['CurrentPassword']=='RetrieveoldPassword'){
$Insert_QR3="update ".$prefix."user set `password`='$rstug_oldpassword',`is_active`='1' where asrmApplctID='$id'";
$cmd_QR3=$mysqli->query($Insert_QR3) ;

}
///////////////////////////////////
if($_POST['pwd'] and $_POST['CurrentPassword']=='None'){
$Insert_QR="update ".$prefix."user set `password`='$pwd',`is_active`='1' where asrmApplctID='$id'";
$cmd_QR=$mysqli->query($Insert_QR) ;
}

if($_POST['pwd'] and $_POST['CurrentPassword']=='KeepoldPassword' || $_POST['CurrentPassword']=='KeepoldPassword'){
$Insert_QR="update ".$prefix."user set `password`='$pwd',`rstug_oldpassword`='$rstug_user_password',`is_active`='1' where asrmApplctID='$id'";
$cmd_QR=$mysqli->query($Insert_QR) ;
}

if($_POST['emailpassword']=='yes'){
	require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");

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

$mail->FromName = "NRIMS Password Re-set"; //From Name -- CHANGE --
$mail->AddAddress($user_email, $fullName); //$fullNameTo Address -- CHANGE --
$mail->addBcc('uncstuncstapps@gmail.com','NRIMS Password Re-set');
$mail->AddReplyTo($user_email, "NRIMS Password Re-set"); //Reply-To Address -- CHANGE --


$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "NRIMS Password Re-set";
$body="
Dear $fullName, your password with NRIMS has been re-set by Admin.<br>
You can now login, click the link below:<br><br>
Username: $username<br>
Password: $Notpwd<br><br>
$base_url/<br>
<a href='".$base_url."/'>Click to Login</a><br><br>


Best Regards<br>
Uganda National Council for Science and Technology<br>

";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}



}







$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname updated password");

/*echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo("<script>location.href = '$base_url/main.php?option=userAccounts';</script>");*/




}//end post

$sqlstudy="SELECT * FROM ".$prefix."user where asrmApplctID='$id'";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$rstudy['recAffiliated_id'];
?>

<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected" style="background:green; color:#FFF;">Update Account - <?php echo $rstudy['name'];?></a></li>

</ul>
<?php 
if(isset($message)){echo $message;}
?>

<form action="" method="post" name="regForm" id="regForm" autocomplte="off" enctype="multipart/form-data">
      <div class="form-group row success" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Full Name:</label>
<div class="col-sm-10">
<input type="text" name="name" id="investigator" class="form-control  required" value="<?php echo $rstudy['name'];?>" readonly="readonly">
</div>
</div>
                        
                    
 
   <div class="form-group row success">
<label class="col-sm-2 form-control-label">Email:</label>
<div class="col-sm-10">
<input type="text" name="remail" id="email" class="form-control  required email" value="<?php echo $rstudy['email'];?>" readonly="readonly">
</div>
</div>

 <div class="form-group row success">
<label class="col-sm-2 form-control-label">Username:</label>
<div class="col-sm-10">
<input type="text" name="ruser" id="username" class="form-control  required" value="<?php echo $rstudy['username'];?>" readonly="readonly">
</div>
</div>

 <div class="form-group row success">
<label class="col-sm-2 form-control-label">Password:</label>
<div class="col-sm-10">
<input type="password" name="pwd" id="pwd" class="form-control" value="">
</div>
</div>


 <div class="form-group row success">
<label class="col-sm-2 form-control-label">Email Password to User :</label>
<div class="col-sm-10">
<input name="emailpassword" type="radio" value="yes" class="required"/>&nbsp;Yes<br />
                  <input name="emailpassword" type="radio" value="no" class="required" checked="checked"/>&nbsp;No
</div>
</div>

 <div class="form-group row success">
<label class="col-sm-11 form-control-label">Current Password:<br />

<input name="CurrentPassword" type="radio" value="KeepoldPassword" class="required" checked="checked"/> Keep old Password (You will be able to retrieve it back after loging in)<br /><br />
                  <input name="CurrentPassword" type="radio" value="RetrieveoldPassword"  class="required"/> Retrieve old Password (You previously changed user password by clicking on option above, but you want to retrieve it back for user to be able logging in)<br /><br />
                  <input name="CurrentPassword" type="radio" value="None"  class="required"/> None</label>

</div>

     
        
                        <div class="form-group row success">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveFirst" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
   
   </form>
                                     
</div>

<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>