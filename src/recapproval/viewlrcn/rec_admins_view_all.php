<?php if($session_privillage=='administrator'){?>
<!--<button id="myBtn">Add a REC</button>-->
<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="59%">Find Admins:<br />
    <input type="text" class="form-control"></td>
    <td width="4%">&nbsp;</td>
    <td width="22%">
Status:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="status" data-live-search="true" tabindex="-98">
                                <option value="" selected="">All</option>
                                <option value="S">Active</option>
                                <option value="R">Suspended</option>
          </select>
                                
   </td>
   <td width="9%"> <br /><input name="" type="button" class="btn-warning btn" value="Export to CSV"/></td>
   <td width="6%"><br /><input type="submit" name="button" id="button" class="search btn" value="Search" /></td>
  </tr>
</table>

<?php
if($_POST['doTeam']=='Save' and $_POST['name']){

require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 
	$name=$mysqli->real_escape_string($_POST['name']);
	
	
	$code=$mysqli->real_escape_string($_POST['code']);
	$contacts=$mysqli->real_escape_string($_POST['contacts']);
	$recemail=$mysqli->real_escape_string($_POST['recemail']);
	$recChairName=$mysqli->real_escape_string($_POST['recChairName']);
	$recchairEmail=$mysqli->real_escape_string($_POST['recchairEmail']);
	$accroname=$mysqli->real_escape_string($_POST['accroname']);

	
$usr_ip = md5($_SERVER['REMOTE_ADDR']);
$md5pass = md5($_POST['pwd']);
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$activ_code = rand(1000,9999);
	
	$sqlInvestigators="SELECT * FROM ".$prefix."list_rec_affiliated where `name`='$name' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	if($totalInvestigators){
	$message='<p class="error">'.$name.' was not created, already exists</p>';	
	}
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."list_rec_affiliated (`created`,`updated`,`name`,`slug`,`status`,`code`,`contacts`,`recemail`,`recChairName`,`recchairEmail`,`accroname`,`recNo`,`bankName`,`BranchName`,`payAmount`,`currency`) 

values(now(),now(),'$name','$name','1','$code','$contacts','$recemail','$recChairName','$recchairEmail','$accroname','$recNo','$bankName','$BranchName','$payAmount','$currency')";
$mysqli->query($sqlA2);
$md5_id = $mysqli->insert_id;

$message='<p class="success">Account for '.$name.' has been created</p>';


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
$mail->AddAddress('uncstuncstapps@gmail.com', $code); //To Address -- CHANGE --
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo("uncstuncstapps@gmail.com", $code); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "$name-$code";
$body="
Dear UNCST !<br><br>
A new REC <b>$name</b> has been created on National Research Information Management System : NRIMS<br><br>

Code: $code<br>
Rec Name: $name<br>
Contacts: $contacts<br>
Email: $recemail<br>
Rec Chair: $recChairName<br>
Email for Rec Chair: $recchairEmail<br><br>

Best Regards<br>
Uganda National Council for Science and Technology<br>

";
$mail->MsgHTML($body);

if(!$mail->Send()){
echo "Mailer Error: " . $mail->ErrorInfo;
}///end
		}
	
}?>

<div class="card-header d-flex align-items-center">
                      <h3 class="h4">REC User Accounts </h3>
</div>
                    <div class="card-body">
                    <?php if($message){?><div class="success"><?php echo $message;?></div><?php }?>
                    
              
                        <?php
$category=$_POST['category'];
$page='./main.php?option=';
$url='AccreditedRECs';
$value='&id='.$id;
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."list_rec_affiliated order by id desc");//and conceptm_status='new' 
$row = $query -> fetch_array(MYSQLI_NUM);
$total_pages = $row[0];

/* Setup vars for query. */
//$targetpage = $page.$url.$value; 
$targetpage = $page.$url.$value; 	//your file name  (the name of this file)
$limitm = 15;
//how many items to show per page
/*Extract Last Value from a link*/
$page = $_GET['page'];
								//how many items to show per page
if($page) 
$start = ($page - 1) * $limitm; 			//first item to display on this page
else
$start = 0;								//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."list_rec_affiliated order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
$result = $mysqli->query($sql);

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
?>


 <div class="nav_purgination" style="padding-bottom:10px;">
<?php echo $pagination;?>
<div class="clear"></div>

</div>

 <table width="100%" class="table table-striped table-sm" id="customers">
                        <thead>
                          <tr>
                            <th width="42%">Name</th>
                            <th width="42%">Contacts</th>
                            <th width="16%">Members</th>
                          </tr>
                        </thead>
                        <tbody>


<?php 
while($rProjects=$result->fetch_array()){
$country_id=$rProjects['country_id'];
$recAffiliated_id=$rProjects['id'];

$sqlSRR = "select * from ".$prefix."list_country where id='$country_id'";
$resultSSS = $mysqli->query($sqlSRR);
$rCountry = $resultSSS->fetch_array();
$header=strlen($rProjects['recheader']);

//'','','','','','','','','','','','','communityrepresentative'
$sqlUser = "SELECT * FROM ".$prefix."user where recAffiliated_id='$recAffiliated_id' and (privillage!='investigator' and privillage!='administrator' and privillage!='superadmin' and privillage!='UHNRO' and privillage!='monitoring' and privillage!='recreviewer')";
$queryUser = $mysqli->query($sqlUser);
$totalUser = $queryUser->num_rows;

$sqlUser2 = "SELECT * FROM ".$prefix."user where recAffiliated_id='$recAffiliated_id' and (privillage='recreviewer')";
$queryUser2 = $mysqli->query($sqlUser2);
$totalUser2 = $queryUser2->num_rows;
	?>
                          <tr>
                            <td><?php echo $rProjects['name'];?></td>
                            <td><?php echo $rProjects['contacts'];?></td>
                            <td><a href="./main.php?option=recadmins&id=<?php echo $rProjects['id'];?>">View All Members [<?php echo $totalUser;?>]</a><br />
                          <a href="./main.php?option=recReviewersall&id=<?php echo $rProjects['id'];?>">View All Reviewers [<?php echo $totalUser2;?>]</a>
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
<div id="myModal" class="modal" style="margin-top:60px;">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>Add a REC</strong></h3>
    </div>
    <div class="modal-body" style="height:300px; overflow:scroll;">

 <form action="" method="post" name="regForm" id="regForm" >
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Name:</label>
<div class="col-sm-10">

<textarea name="name" cols="" rows="" class="form-control  required"></textarea>
</div>
</div>
                        
                        
   <div class="form-group row">
<label class="col-sm-2 form-control-label">Code:</label>
<div class="col-sm-10">
<input type="text" name="code" id="code" class="form-control  required" value="">
</div>
</div> 

   <div class="form-group row">
<label class="col-sm-2 form-control-label">Contacts:</label>
<div class="col-sm-10">
<textarea name="contacts" cols="" rows="" class="form-control  required"></textarea>
</div>
</div> 


<div class="form-group row">
<label class="col-sm-2 form-control-label">Email:</label>
<div class="col-sm-10">
<input type="text" name="recemail" id="recemail" class="form-control  required email" value="">
</div>
</div> 


<div class="form-group row">
<label class="col-sm-2 form-control-label">REC Chair:</label>
<div class="col-sm-10">
<input type="text" name="recChairName" id="recChairName" class="form-control  required" value="">
</div>
</div>  

<div class="form-group row">
<label class="col-sm-2 form-control-label">Accroname:</label>
<div class="col-sm-10">
<input type="text" name="accroname" id="accroname" class="form-control  required" value="">
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 form-control-label">Email for REC Chair:</label>
<div class="col-sm-10">
<input type="text" name="recchairEmail" id="recchairEmail" class="form-control  required email" value="">
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
