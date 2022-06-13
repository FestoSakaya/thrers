<?php if($session_privillage=='administrator'){?><button id="myBtn">User Accounts </button>
<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="59%">Find Users:<br />
    <input type="text" class="form-control" name="searchname"></td>
    <td width="4%">&nbsp;</td>
    <td width="22%">
Status:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="name" data-live-search="true" tabindex="-98">
                                <option value="" selected="">All</option>
                                <option value="S" selected="selected">User</option>
          </select>
                                
   </td>

   <td width="6%"><br /><input type="submit" name="button" id="button" class="search btn" value="Search" /></td>
  </tr>
</table>
</form>

<?php
if($_POST['doTeam']=='Save' and $_POST['name'] and $_POST['email']){

require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 
	$name=$mysqli->real_escape_string($_POST['name']);
	$country_id=$mysqli->real_escape_string($_POST['countryid']);
	$email=$mysqli->real_escape_string($_POST['email']);
	$password=md5($mysqli->real_escape_string($_POST['pwd']));
	$pwdNot=$mysqli->real_escape_string($_POST['pwd']);
	$username=$mysqli->real_escape_string($_POST['username']);
	$institution=$mysqli->real_escape_string($_POST['institution']);
	$recName=$mysqli->real_escape_string($_POST['recName']);
	$privillage=$mysqli->real_escape_string($_POST['privillage']);
	
$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

	$contacts=$recNamew['contacts'];
	$recOriginalName=$recNamew['name'];
	
$usr_ip = md5($_SERVER['REMOTE_ADDR']);
$md5pass = md5($_POST['pwd']);
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$activ_code = rand(1000,9999);
	
	$sqlInvestigators="SELECT * FROM ".$prefix."user where `username`='$username' and email='$email' and recAffiliated_id='$recAffiliated_idTo' order by asrmApplctID desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	if($totalInvestigators){
	$message='<p class="error">Your account was not created, already exists</p>';	
	}
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."user (`country_id`,`created`,`updated`,`email`,`password`,`username`,`is_active`,`name`,`institution`,`hashcode`,`first_access`,`privillage`,`profile`,`recAffiliated_id`,`rstug_md5_id`,`rstug_act_code`) 

values('$country_id',now(),now(),'$email','$password','$username','1','$name','$institution','','0','$privillage','','$recAffiliated_idTo','','$activ_code')";
$mysqli->query($sqlA2);
$md5_id = $mysqli->insert_id;

$message='<p class="success">Account has been created and email sent to $email</p>';


///Now Send mail
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
//$mail->addCc('uncstuncstapps@gmail.com','Activation Link from UNCST');//
//$mail->addBcc('mawandammoses@gmail.com','Activation Link from UNCST');//

$mail->FromName = "UNCST"; //From Name -- CHANGE --
$mail->AddAddress($email, $name); //To Address -- CHANGE --
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "REC Admin Account";
$body="
Dear $name !<br><br>
An account has been created for you. You will use these logins whenever to log into the system. Below are your login details;<br><br>
Username: $username<br>
Password: $pwdNot<br>
<a href='".$base_url."/'>Click here to login</a><br><br>

Best Regards<br>
Uganda National Council for Science and Technology<br>

";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end
		}
	
}


if($category=='ActivateUser' and $id){

$sqlChceckMembersNew2="update ".$prefix."user set is_active='1' where  asrmApplctID='$id'";
$mysqli->query($sqlChceckMembersNew2);//status='notallowedaccess'
$message='<div class="error2">Details were removed.</div>';
echo $message='<div class="error2">Account has been Activated</div>';	
}



if($category=='DeActivateUser' and $id){

$sqlChceckMembersNew2="update ".$prefix."user set is_active='0' where  asrmApplctID='$id'";
$mysqli->query($sqlChceckMembersNew2);//status='notallowedaccess'
echo $message='<div class="error2">Account has been De-activated</div>';
	
}

if($category=='ActivateAbstractsUser' and $id){

$sqlChceckMembersNew2="update ".$prefix."user set accessAbstracts='Yes' where  asrmApplctID='$id'";
$mysqli->query($sqlChceckMembersNew2);//status='notallowedaccess'
$message='<div class="error2">Details were removed.</div>';
echo $message='<div class="error2">Account has been Activated to access all abstracts/publications</div>';	
}



if($category=='DeActivateAbstractsUser' and $id){

$sqlChceckMembersNew2="update ".$prefix."user set accessAbstracts='No' where  asrmApplctID='$id'";
$mysqli->query($sqlChceckMembersNew2);//status='notallowedaccess'
echo $message='<div class="error2">Account has been De-activated from accessing all abstracts/publications</div>';
	
}

if($category=='DeluserAccounts' and $id){

$sqlChceckMembersNew2="delete from ".$prefix."user  where  asrmApplctID='$id'";
$mysqli->query($sqlChceckMembersNew2);//status='notallowedaccess'

$sqlA2Protocol="delete from ".$prefix."submission where owner_id='$id'";
$mysqli->query($sqlA2Protocol);

$sqlA2Protocol33="delete from ".$prefix."study_population where owner_id='$id'";
$mysqli->query($sqlA2Protocol33);

$sqlA2Protocol44="delete from ".$prefix."determination_of_risk  where owner_id='$id'";
$mysqli->query($sqlA2Protocol44);

$sqlStageDone="delete from ".$prefix."submission_stages where `owner_id`='$id'";
$QueryStgCompleted = $mysqli->query($sqlStageDone);
//update tema
$sqlTeam="delete from ".$prefix."team where `owner_id`='$id'";
$mysqli->query($sqlTeam);

$sqlPopulation="delete from ".$prefix."study_population where `owner_id`='$id' ";
$mysqli->query($sqlPopulation);




echo $message='<div class="error2">Account has been Removed</div>';
	
}
?>

<div class="card-header d-flex align-items-center">
                      <h3 class="h4">REC User Accounts </h3>
</div>
                    <div class="card-body">
                <table class="table table-striped table-sm" id="customers">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Institution</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Access Abstracts</th>
                            <th>Active</th>
                            <th>&nbsp;</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
$category=$_POST['category'];
$page='main.php?';
$url='userAccounts';
$value='&id='.$id;
//$value='listuserauthorised';
$name=$_POST['searchname'];
$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['searchname']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."user where privillage!='recadmin' and privillage!='recreviewer' and (name like '%$name%' OR email like '%$name%') order by asrmApplctID desc");//and conceptm_status='new'
}
if(!$_POST['searchname']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."user where privillage!='recadmin' and privillage!='recreviewer' order by asrmApplctID desc");//and conceptm_status='new'
}
$row = $query -> fetch_array(MYSQLI_NUM);
$total_pages = $row[0];

/* Setup vars for query. */
//$targetpage = $page.$url.$value; 
$targetpage = $page.$url.$value; 	//your file name  (the name of this file)
$limitm = 100;
//how many items to show per page
/*Extract Last Value from a link*/
$page = $_GET['page'];
								//how many items to show per page
if($page) 
$start = ($page - 1) * $limitm; 			//first item to display on this page
else
$start = 0;	
if($_POST['searchname']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."user where privillage!='recadmin' and privillage!='recreviewer' and (name like '%$name%' OR email like '%$name%') order by asrmApplctID desc LIMIT $start, $limitm";//and conceptm_status='new' 
$result = $mysqli->query($sql);
}
if(!$_POST['searchname']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."user where privillage!='recadmin' and privillage!='recreviewer' order by asrmApplctID desc LIMIT $start, $limitm";//and conceptm_status='new' 
$result = $mysqli->query($sql);
}

/* Setup page vars for display. */
if ($page == 0) $page = 1;					//if no page var is given, default to 1.
$prev = $page - 1;							//previous page is page - 1
$next = $page + 1;							//next page is page + 1
$lastpage = ceil($total_pages/$limitm);		//lastpage is = total pages / items per page, rounded up.
$lpm1 = $lastpage - 1;						//last page minus 1

/* 
Now we apply our rules and draw the pagination object. 
We're actually saving the code to a variable in case we want to draw it more than once.
*/
$pagination = "";
if($lastpage > 1)
{	
$pagination .= "<div class=\"pagination\">";
//previous button
if ($page > 1) 
$pagination.= "<a href=\"$targetpage&page=$prev\">&laquo;previous</a>";
else
$pagination.= "<span class=\"disabled\">&laquo;previous</span>";	

//pages	
if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
{	
for ($counter = 1; $counter <= $lastpage; $counter++)
{
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
}
}
elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
{
//close to beginning; only hide later pages
if($page < 1 + ($adjacents * 2))		
{
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
{
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
}
$pagination.= "...";
$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
}
//in middle; hide some front and some back
elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
{
$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
$pagination.= "...";
for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
{
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
}
$pagination.= "...";
$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
}
//close to end; only hide early pages
else
{
$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
$pagination.= "...";
for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
{
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
}
}
}

//next button
if ($page < $counter - 1) 
$pagination.= "<a href=\"$targetpage&page=$next\">next&raquo;</a>";
else
$pagination.= "<span class=\"disabled\">next&raquo;</span>";
$pagination.= "</div>";		
} 
while($rProjects=$result->fetch_array()){
$country_id=$rProjects['country_id'];

$sqlSRR = "select * from ".$prefix."list_country where id='$country_id'";
$resultSSS = $mysqli->query($sqlSRR);
$rCountry = $resultSSS->fetch_array();
	?>
                          <tr>
                            <td><?php echo $rProjects['name'];?></td>
                            <td><?php echo $rProjects['institution'];?></td>
                            <td><?php echo $rProjects['email'];?></td>
                            <td><?php echo $rProjects['username'];?></td>
                            <td>
							
							<?php if($rProjects['accessAbstracts']=='No'){?>
<span class="m-status m-status--wide cfx-watch"><a href="./main.php?option=ActivateAbstractsUser&id=<?php echo $rProjects['asrmApplctID'];?>" onClick="return confirm('Are you sure you want <?php echo $rProjects['name'];?> to Access All Abstracts/Publications?');">         <span class="cfx-watch-label">NO ACCESS</span>
        <span class="cfx-watch-switch"></span></a> </span><br /><?php }?>
                                                    
<?php if($rProjects['accessAbstracts']=='Yes'){?>
<span class="m-status m-status--wide cfx-watch active"><a href="./main.php?option=DeActivateAbstractsUser&id=<?php echo $rProjects['asrmApplctID'];?>" onClick="return confirm('Are you sure you want to limit  <?php echo $rProjects['name'];?> from accessing All Abstracts/Publications?');">        <span class="cfx-watch-label">HAS ACCESS&nbsp;</span>
        <span class="cfx-watch-switch"></span></a></span><?php }?>
        
        </td>
        
        
                            <td>
                            
                            <?php if($rProjects['is_active']=='0'){?>
<span class="m-status m-status--wide cfx-watch"><a href="./main.php?option=ActivateUser&id=<?php echo $rProjects['asrmApplctID'];?>" onClick="return confirm('Are you sure you want to Activate <?php echo $rProjects['name'];?>?');">         <span class="cfx-watch-label">OFF</span>
        <span class="cfx-watch-switch"></span></a> </span><br /><?php }?>
                                                    
<?php if($rProjects['is_active']=='1'){?>
<span class="m-status m-status--wide cfx-watch active"><a href="./main.php?option=DeActivateUser&id=<?php echo $rProjects['asrmApplctID'];?>" onClick="return confirm('Are you sure you want to De-Activate <?php echo $rProjects['name'];?>?');">        <span class="cfx-watch-label">ON&nbsp;</span>
        <span class="cfx-watch-switch"></span></a></span><?php }?>
                            
                            
                            
                            </td>
                            <td><a href="./main.php?option=UpdateUser&id=<?php echo $rProjects['asrmApplctID'];?>" class="m-status-green" style="padding:5px;">Update</a>
                            
                            <div style=" margin-bottom:10px; width:100%;"></div>
                            
                            <a href="./main.php?option=reusePassword&id=<?php echo $rProjects['asrmApplctID'];?>" class="m-status-green" style="padding:5px;" >UsePassword</a>
                            <div style="margin-bottom:10px; width:100%;"></div>
                            
                            
                          <a href="./main.php?option=DeluserAccounts&id=<?php echo $rProjects['asrmApplctID'];?>" class="m-status-red" style="padding:7px;"  onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                            </td>
                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
              </div>

 
 
	  <div class="nav_purgination">
<?php echo $pagination;?>
<div class="clear"></div>

</div><!--end purgination section-->



<!-- The Modal -->
<div id="myModal" class="modal" style="margin-top:53px;">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>Add Users</strong></h3>
    </div>
    <div class="modal-body" style="height:300px; overflow:scroll;">

 <form action="" method="post" name="regForm" id="regForm" >
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Full Name:</label>
<div class="col-sm-10">
<input type="text" name="name" id="investigator" class="form-control  required" value="">
</div>
</div>
                        
                        
   <div class="form-group row">
<label class="col-sm-2 form-control-label">Institution:</label>
<div class="col-sm-10">
<input type="text" name="institution" id="institution" class="form-control  required" value="">
<input type="hidden" name="recAffiliated_id" id="recAffiliated_id" class="form-control  required" value="<?php echo $recAffiliated_id;?>">
</div>
</div>                      
 
   <div class="form-group row">
<label class="col-sm-2 form-control-label">Email:</label>
<div class="col-sm-10">
<input type="text" name="email" id="email" class="form-control  required email" value="">
</div>
</div>

 <div class="form-group row">
<label class="col-sm-2 form-control-label">Username:</label>
<div class="col-sm-10">
<input type="text" name="username" id="username" class="form-control  required" value="">
</div>
</div>

 <div class="form-group row">
<label class="col-sm-2 form-control-label">Password:</label>
<div class="col-sm-10">
<input type="password" name="pwd" id="pwd" class="form-control  required" value="">
</div>
</div>

           <div class="form-group row">
<label class="col-sm-2 form-control-label">Privillage:</label>
<div class="col-sm-10">
<select name="privillage" id="privillage" class="form-control  required">
<option value="">Please Select</option>
<option value="investigator">Investigator</option>
<option value="secretary">Secretary</option>
<option value="membercommittee">Member Committee</option>
<option value="Administrator">administrator</option>
<option value="UHNRO">UHRO Member</option>
<option value="monitoring">Monitoring Member</option>
</select>
</div>
</div>           
                        
    <div class="form-group row">
<label class="col-sm-2 form-control-label">Country:</label>
<div class="col-sm-10">
<select name="countryid" id="countryid" class="form-control  required">
<option value="800">Uganda</option>
<?php
$sqlCountrycv = "select * FROM ".$prefix."list_country order by name asc";//and conceptm_status='new' 
$resultCountrycv = $mysqli->query($sqlCountrycv);
while($rCountrycv=$resultCountrycv->fetch_array()){
?>
<option value="<?php echo $rCountrycv['id'];?>" <?php if($rCountrycv['id']==800){?>selected="selected"<?php }?>><?php echo $rCountrycv['name'];?></option>
<?php }?>
</select>
</div>
</div>    
       <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doTeam" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
                                          
     </form>                   
    </div>
    </div>
    </div><!--End Reviewer-->
<?php }//end Admin
