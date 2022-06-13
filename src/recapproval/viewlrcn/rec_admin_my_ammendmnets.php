<?php 	
if($category=='dashboardDel' and $id){
	$ownerid=$_SESSION['asrmApplctID'];
	//Remove this submission
	$sqlUsers="SELECT * FROM ".$prefix."submission where `owner_id`='$ownerid' and id='$id' and is_sent='0'";
		$QueryUsers = $mysqli->query($sqlUsers);
		$totalUsers = $QueryUsers->num_rows;
		$rUserInv=$QueryUsers->fetch_array();
	if($totalUsers){
	$sqlA2Protocol2="delete from ".$prefix."submission where owner_id='$ownerid' and id='$id'";
	$mysqli->query($sqlA2Protocol2);
	//////////////////////////////////////////////
	$sqlA2Protocol3="delete from ".$prefix."protocol where owner_id='$ownerid' and protocol_id='$id'";
	$mysqli->query($sqlA2Protocol3);
	
	//////////////////////////////////////////////
	$sqlA2Protocol4="delete from ".$prefix."team where owner_id='$ownerid' and protocol_id='$id'";
	$mysqli->query($sqlA2Protocol4);
	
	//////////////////////////////////////////////
	$sqlA2Protocol5="delete from ".$prefix."submission_country where owner_id='$ownerid' and submission_id='$id'";
	$mysqli->query($sqlA2Protocol5);
	
	//////////////////////////////////////////////
	$sqlA2Protocol6="delete from ".$prefix."research_project_expenditure where rstug_user_id='$ownerid' and rstug_rsch_project_id='$id'";
	$mysqli->query($sqlA2Protocol6);
	
	//////////////////////////////////////////////
	$sqlA2Protocol7="delete from ".$prefix."research_project_expenditure_local where rstug_user_id='$ownerid' and rstug_rsch_project_id='$id'";
	$mysqli->query($sqlA2Protocol7);
	
		//////////////////////////////////////////////
	$sqlA2Protocol8="delete from ".$prefix."submission_task where owner_id='$ownerid' and submission_id='$id'";
	$mysqli->query($sqlA2Protocol8);
	
	//////////////////////////////////////////////
	$sqlA2Protocol8="delete from ".$prefix."submission_upload where user_id='$ownerid' and submission_id='$id'";
	$mysqli->query($sqlA2Protocol8);
	
	//////////////////////////////////////////////
	$sqlA2Protocol9="delete from ".$prefix."collaborating_institutions where owner_id='$ownerid' and protocol_id='$id'";
	$mysqli->query($sqlA2Protocol9);
	
	//////////////////////////////////////////////
	$sqlA2Protocol10="delete from ".$prefix."submission_stages where owner_id='$ownerid' and protocol_id='$id'";
	$mysqli->query($sqlA2Protocol10);
	
	//////////////////////////////////////////////
	$sqlA2Protocol11="delete from ".$prefix."study_population where owner_id='$ownerid' and protocol_id='$id'";
	$mysqli->query($sqlA2Protocol11);
	
	
	echo $message='<p class="failed">Dear '.$session_fullname.', protocol has been deleted.</p>';

	}
	
	}?>
<form action="" method="post" name="regForm" id="regForm" autocomplte="off">



<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="59%">Find Ammendmnets:<br />
    <input type="text" class="form-control" name="searchprotocol" value="<?php echo $_POST['searchprotocol'];?>"></td>
    <td width="4%">&nbsp;</td>
    <td width="22%">
Status:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="status" data-live-search="true" tabindex="-98">
                               <option value="" selected="">All</option>
<option value="Rejected" <?php if($_POST['status']=='Rejected'){?>selected="selected"<?php }?>>Rejected Submissions</option>
<option value="Waiting for Committee" <?php if($_POST['status']=='Waiting for Committee'){?>selected="selected"<?php }?>>Waiting for Committee</option>
<option value="Approved" <?php if($_POST['status']=='Approved'){?>selected="selected"<?php }?>>Approved Submissions</option>

<option value="Scheduled for Review" <?php if($_POST['status']=='Scheduled for Review'){?>selected="selected"<?php }?>>Assigned Submissions</option>

<option value="Pending" <?php if($_POST['status']=='Scheduled for Review'){?>selected="selected"<?php }?>>New Submissions</option>
          </select>
                                
   </td>

   <td width="6%"><br /><input type="submit" name="doSearch" id="button" class="search btn" value="Search" /></td>
  </tr>
</table>
</form>
<script>
   function popitup(url) 
   {
    newwindow=window.open(url,'name','height=600,width=950,screenX=400,screenY=350');
    if (window.focus) {newwindow.focus()}
    return false;
   }
   </script> 
<div class="card-header d-flex align-items-center">
                      <h3 class="h4">My Protocols </h3>
</div>
                    <div class="card-body">
                    
                    
                   
               <table class="table table-striped table-sm" id="customers">
                        <thead>
                          <tr>
                            <th width="201">RefNo</th>
                            <th width="201">Project Title </th>
                            <th width="149">PI</th>
                            <th width="149">Language</th>
                            <th width="136">Submission Date</th>
                          
                            <th width="42">Status</th>
                            <th width="167">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
$category=$_POST['category'];
$page='./main.php?option=';
$url='MyAmmendmentsREC';
$value='';
$searchprotocol=$_POST['searchprotocol'];
$status=$_POST['status'];
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."ammendments  where (listchanges like '%$searchprotocol%' OR rstug_UNCSTRefNumber like '%$searchprotocol%') and recAffiliated_id='$recAffiliated_id' order by id desc");//and conceptm_status='new' 
}


if(!$_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."ammendments  where recAffiliated_id='$recAffiliated_id' order by id desc");//and conceptm_status='new' 

}

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
$start = 0;

if($_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS datesubmitted FROM ".$prefix."ammendments  where (listchanges like '%$searchprotocol%' OR rstug_UNCSTRefNumber like '%$searchprotocol%') and recAffiliated_id='$recAffiliated_id' order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//'Pending','reviewed','Approved','Rejected'

if(!$_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS datesubmitted FROM ".$prefix."ammendments  where recAffiliated_id='$recAffiliated_id'  order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//'Pending','reviewed','Approved','Rejected'


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
} ?>
 <div class="nav_purgination" style="margin-bottom:10px;">
<?php echo $pagination;?>
<div class="clear"></div>

</div><!--end purgination section-->
<?php 
while($rProjects=$result->fetch_array()){
$owner_id=$rProjects['owner_id'];
$protocol_id=$rProjects['protocol_id'];
$amendment_id=$rProjects['id'];

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
///Protocol Number//protocol
$sqlprotocol = "select * from ".$prefix."submission where protocol_id='$protocol_id'";
$resultprotocol = $mysqli->query($sqlprotocol);
$sqprotocol = $resultprotocol->fetch_array();

$sqlSMeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_id' and meetingFor='Amendments' order by id desc";
$resultSMeeting = $mysqli->query($sqlSMeeting);
$sqUserMeeting = $resultSMeeting->fetch_array();

$sqlApproval = "select * from ".$prefix."study_post_approvals where renewal_id='$amendment_id' order by id desc";
$resultApproval = $mysqli->query($sqlApproval);
$totalStudyApproval = $resultApproval->num_rows;

$sqlComments = "select * FROM ".$prefix."initial_committee_screening where screeningFor='Amendments' and renewal_id='$amendment_id' order by id desc LIMIT 0,1";
$QueryComments = $mysqli->query($sqlComments);
$totalComments = $QueryComments->num_rows;
	?>
                          <tr>
                            <td><?php if($rProjects['ammendType']=='manual'){echo $rProjects['refNo'];}?>
 <?php if($rProjects['ammendType']=='online'){echo $rProjects['refNo'];}?></td>
 
                            <td><h3 class="h4">                            
 <?php if($rProjects['ammendType']=='manual'){echo $rProjects['protocol_title'];}?>
 <?php if($rProjects['ammendType']=='online'){echo $sqprotocol['public_title'];}?>
                            
                            </h3></td>
                            <td><?php echo $sqUserdd['name'];?></td>
                           <td>
						   
                           <div style="height:200px; overflow:scroll; width:300px;">
                           
                          <?php
$code=$rProjects['code'];
$sqlstudy="SELECT * FROM ".$prefix."ammendments_documents where `owner_id`='$owner_id' and amendment_id='$amendment_id' order by id desc";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
?>               
              <table class="table table-striped table-sm" id="customerss">
                  <thead>
                          <tr>
                            <th>Type</th>
                            <th>Language</th>
                            <th>Version</th>
                            <th>Date</th>

                          </tr>
                        </thead>
                        <tbody>
            <?php while($rstudy = $Querystudy->fetch_array()){
				$protocol_id=$rstudy['protocol_id'];


				?>
                          <tr>
                          
                            <td><?php if($rstudy['fileAttachment']){?><a href="./files/uploads/<?php echo $rstudy['fileAttachment'];?>" target="_blank" style="color:#06F;"><?php if($rstudy['atype']=='otherattachment'){echo $rstudy['otherattachment'];}else{echo $rstudy['atype'];}?></a><?php }?></td>
                            
                            <td><?php echo $rstudy['aLanguage'];?></td>
                            <td><?php echo $rstudy['aVersion'];?></td>
                            <td><?php echo $rstudy['aDate'];?></td>
                            </tr>
               
               <?php }?>
                        </tbody>
                      </table>  
                      </div>     
                           
                           
                           
                           
                           
                           
                           
                           </td>
                            <td><?php echo $rProjects['datesubmitted'];?></td>
                          
                            
                            <td><?php if($rProjects['status']){?><span class="label label-primary"><?php echo $rProjects['status'];?></span><br /><?php }?>
                            
<?php if($rProjects['CompletenessCheck']!='Pending'){?><span class="label label-warning"><?php echo "Completeness Check: ".$rProjects['CompletenessCheck'];}?></span>
                            </td>
                            <td>                            
                
<a href="./main.php?option=viewAmmendments&id=<?php echo $rProjects['id'];?>"><span class="label label-primary">+ View Submission</span></a><div style="margin-bottom:6px;"></div>

<?php if($totalComments){?><a href="./main.php?option=viewAmendmentsComments&id=<?php echo $rProjects['id'];?>"><span class="label label-primary">+ View Comments</span></a><div style="margin-bottom:6px;"></div><?php }?>
                           
                           
                <div style="margin-bottom:6px;"></div>  
                
  
  <?php if($totalStudyApproval){?><a href="./main.php?option=ReverseAmendmentFinalDecision&id=<?php echo $rProjects['id'];?>" style="color:#06F; font-weight:bold;" onclick="return confirm('Do you want to Reverse Final Decision already taken?');"><span class="label label-sec2">Reverse Final Decision</span></a>
	<div style="margin-bottom:6px;"></div>
	<?php }?> 
                           
<?php 
if(($rProjects['assignedto']=='Not Assigned' || $rProjects['assignedto']=='') and ($rProjects['status']=='Submitted' || $rProjects['status']=='Scheduled for Review') and ($rProjects['paymentProof']=='Paid' || $rProjects['paymentProof']=='Review Pending Payment' || $rProjects['paymentProof']=='Payment Waiver') and $rProjects['CompletenessCheck']=='Approved' ){?><a href="./main.php?option=ConfirmAmmendments&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Assign Reviewers</span></a><div style="margin-bottom:6px;"></div><?php } //$rProjects['paymentProof'] and?>  

<?php 
if(($rProjects['assignedto']=='Assigned') and ($rProjects['status']=='Submitted' || $rProjects['status']=='Scheduled for Review') and ($rProjects['paymentProof']=='Paid' || $rProjects['paymentProof']=='Review Pending Payment' || $rProjects['paymentProof']=='Payment Waiver') and $rProjects['CompletenessCheck']=='Approved' ){?><a href="./main.php?option=ConfirmAmmendments&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Re-Assign Reviewers</span></a><div style="margin-bottom:6px;"></div><?php } //$rProjects['paymentProof'] and?>  
  
  <?php 
if(($rProjects['assignedto']=='Not Assigned' || $rProjects['assignedto']=='') and $rProjects['status']=='Submitted' and ($rProjects['paymentProof']=='Not Paid' || $rProjects['paymentProof']=='')){?><a href="./main.php?option=AmmendmnetConfirmPayment&id=<?php echo $rProjects['id'];?>"><span class="label label-secwarning">Confirm Payment</span></a><div style="margin-bottom:6px;"></div><?php } //$rProjects['paymentProof'] and?> 
                  
<?php //and $rProjects['assignedto']=='Assigned' 
	if($rProjects['status']!='Approved' and $rProjects['CompletenessCheck']=='Approved' and ($rProjects['paymentProof']=='Paid' || $rProjects['paymentProof']=='Review Pending Payment' || $rProjects['paymentProof']=='Payment Waiver' and $rProjects['assignedto']=='Assigned' )){ //$sqUserMeeting['meetingStatus']=='conducted' and ?>
  <a href="./main.php?option=DecisionAmmendments&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Make Final Decision</span></a><div style="margin-bottom:6px;"></div><?php }?> 
  
<?php  
	if($rProjects['status']!='Approved' and $rProjects['status']!='Rejected' and $rProjects['status']!='Conditional Approval' and $rProjects['status']!='Request for Responses' and $rProjects['status']!='Resubmit' and $rProjects['CompletenessCheck']=='Pending' and ($rProjects['paymentProof']=='Paid' || $rProjects['paymentProof']=='Review Pending Payment' || $rProjects['paymentProof']=='Payment Waiver')){ //$sqUserMeeting['meetingStatus']=='conducted' and ?>
  <a href="./main.php?option=AmdCompletenessCheck&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Completeness check</span></a><div style="margin-bottom:6px;"></div><?php }?> 
  
  
  <?php if($totalStudyApproval and $rProjects['status']=='Approved'){?><br />
							<a href="<?php echo $base_url;?>amendmentapproval.php?rmd_id=<?php echo md5($rProjects['code']);?>" target="_blank"><span class="label label-sec3">Download REC Approval Letter</span></a><?php }?>
                            
                             <?php if($totalStudyApproval and $rProjects['status']=='Conditional Approval'){?><br /><br />
							<a href="<?php echo $base_url;?>amendmentresubmit.php?rmd_id=<?php echo md5($rProjects['code']);?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?>   
                            
                             <?php if($totalStudyApproval and $rProjects['status']=='Request for Responses'){?><br /><br />
							<a href="<?php echo $base_url;?>amendmentresubmit.php?rmd_id=<?php echo md5($rProjects['code']);?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?> 
                     <?php if($totalStudyApproval and $rProjects['status']=='Resubmit'){?><br /><br />
							<a href="<?php echo $base_url;?>amendmentresubmit.php?rmd_id=<?php echo md5($rProjects['code']);?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?>  
                     <?php if($totalStudyApproval and $rProjects['status']=='Rejected'){?><br /><br />
							<a href="<?php echo $base_url;?>amendmentresubmit.php?rmd_id=<?php echo md5($rProjects['code']);?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?>         
                            


                            
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
