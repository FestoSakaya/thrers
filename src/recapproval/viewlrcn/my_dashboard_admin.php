<?php $sort=$mysqli->real_escape_string($_GET['sort']);
$vsort=$mysqli->real_escape_string($_GET['vsort']);

if($session_privillage=='recreviewer'){
	
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
	$sqlA2Protocol3="delete from ".$prefix."protocol where owner_id='$ownerid' and id='$id'";
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
<?php 
$sqlstudyFinish2="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and is_sent='0' and assignedto='Not Assigned' order by id desc limit 0,1";
$QuerystudyFinish2 = $mysqli->query($sqlstudyFinish2);
$totalstudyFinish2 = $QuerystudyFinish2->num_rows;
if($totalstudyFinish2){?>
<input name="" type="button" class="search btn" value="Submit New Protocol" onClick="window.location.href='./main.php?option=newsubmission'"/>
<?php }
if(!$totalstudyFinish2){?>
<input name="" type="button" class="search btn" value="Submit New Protocol" onClick="window.location.href='./main.php?option=newsubmission'"/>
<?php }
?>




<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="59%">Find protocols:<br />
    <input type="text" class="form-control" name="searchprotocol" value="<?php echo $_POST['searchprotocol'];?>"></td>
    <td width="4%">&nbsp;</td>
    <td width="22%">
Status:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="status" data-live-search="true" tabindex="-98">
                               <option value="" selected="">All</option>
<option value="Rejected" <?php if($_POST['status']=='Rejected'){?>selected="selected"<?php }?>>Rejected Submissions</option>
<option value="Waiting for Committee" <?php if($_POST['status']=='Waiting for Committee'){?>selected="selected"<?php }?>>Waiting for Committee Review</option>
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
 
                        <?php
$category=$_POST['category'];
$page='./main.php?option=';
$url='dashboard';
$value='&id='.$id;
$searchprotocol=$_POST['searchprotocol'];
$status=$_POST['status'];
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and owner_id='$asrmApplctID' order by id desc");//and conceptm_status='new' 
}
if(!$_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where owner_id='$asrmApplctID' order by id desc");//and conceptm_status='new' 
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
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and owner_id='$asrmApplctID' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}
if(!$_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where owner_id='$asrmApplctID' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}
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
               <table class="table table-striped table-sm" id="customers">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Protocol Title</th>
                            <th>Type</th>
                            <th>REC</th>
                            <th>Last Update</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
while($rProjects=$result->fetch_array()){
$owner_id=$rProjects['owner_id'];
$main_submission_id=$rProjects['protocol_id'];
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
///Protocol Number//protocol
$sqlprotocol = "select * from ".$prefix."protocol where id='$main_submission_id'";
$resultprotocol = $mysqli->query($sqlprotocol);
$sqprotocol = $resultprotocol->fetch_array();

////Get REC
$recAffiliated_id=$rProjects['recAffiliated_id'];
$sqlSRREC = "select * from ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$resultSSSREC = $mysqli->query($sqlSRREC);
$sqUserddRREC = $resultSSSREC->fetch_array();

////
$clinical_trial_type=$rProjects['clinical_trial_type'];
$sqlSRREC2 = "select * from ".$prefix."categories where rstug_categoryID='$clinical_trial_type'";
$resultSSSREC2 = $mysqli->query($sqlSRREC2);
$sqUserddRREC2 = $resultSSSREC2->fetch_array();

///Halted Protocols
$sqlSRREC3 = "select * from ".$prefix."appeal_halted_studies where protocol_id='$main_submission_id' order by id desc";
$resultSSSREC3 = $mysqli->query($sqlSRREC3);
$sqUserddRREC3 = $resultSSSREC3->fetch_array();

///check if approval letter exists
$sqlApproval = "select * from ".$prefix."study_approvals where rstug_rsch_project_id='$main_submission_id' order by id desc";
$resultApproval = $mysqli->query($sqlApproval);
$totalStudyApproval = $resultApproval->num_rows;
/*$rProjects['status']=='Conditional Approval | Needs Minor Revisions'
$rProjects['status']=='Conditional Approval'
$rProjects['status']=='Request for Responses'*/
if($rProjects['status']=='Conditional Approval | Needs Minor Revisions' || $rProjects['status']=='Conditional Approval' || $rProjects['status']=='Request for Responses'and $rProjects['newresubmission']=='0'){

$sqlApproval_update = "update ".$prefix."submission set is_sent='0' where id='$main_submission_id' and owner_id='$owner_id'";
$mysqli->query($sqlApproval_update);	

$sqlApproval_updatem = "update ".$prefix."submission_stages set status='new' where protocol_id='$main_submission_id' and owner_id='$owner_id'";
$mysqli->query($sqlApproval_updatem);	
}

	?>
                          <tr>
                            <td scope="row"><?php echo $sqprotocol['code'];?> </td>
                            <td><h3 class="h4"><?php echo $rProjects['public_title'];?></h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small></td>
                            <td><?php if($rProjects['is_clinical_trial']==1){?><span class="label label-warning">Clinical Trial</span> <?php }?>
  <?php if($rProjects['is_clinical_trial']==0){?><span class="label label-primary"><?php echo $sqUserddRREC2['rstug_categoryName'];?></span> <?php }?>                          
                            
                            </td>
                            <td><?php echo $sqUserddRREC['name'];?></td>
                            
                            <td><?php echo $rProjects['updated'];?></td>
                            
                            <td><?php if($rProjects['status']=='Approved'){?>
						
							
							<?php }else{echo $rProjects['status'];}?>
                            
                            <?php if($totalStudyApproval and $rProjects['status']=='Approved'){?><br />
							<a href="<?php echo $base_url;?>studyapproval.php?rmd_id=<?php echo md5($rProjects['code']);?>" target="_blank"><span class="label label-sec3">Download REC Approval Letter</span></a><?php }?>
                            
                             <?php if($totalStudyApproval and $rProjects['status']=='Conditional Approval'){?><br /><br />
							<a href="<?php echo $base_url;?>studyapproval.php?rmd_id=<?php echo md5($rProjects['code']);?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?>   
                            
                            <?php if($totalStudyApproval and $rProjects['status']=='Request for Responses'){?><br /><br />
							<a href="<?php echo $base_url;?>studyapprovalres.php?rmd_id=<?php echo md5($rProjects['code']);?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?>
                            
                         <?php if($totalStudyApproval and $rProjects['status']=='Conditional Approval | Needs Minor Revisions'){?><br /><br />
							<a href="<?php echo $base_url;?>studyapproval.php?rmd_id=<?php echo md5($rProjects['code']);?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?> 
                            
                            
                             <?php if($rProjects['recruitment_status_id']==1 and $rProjects['status']=='Approved at UNCST'){?><span class="label label-secwarning">+ STUDY HALTED</span><?php }?> 
                             <div style="margin-bottom:6px;"></div>
                             
<?php if($rProjects['recruitment_status_id']==1 and $sqUserddRREC3['status']=='Pending' and $sqUserddRREC3['appealSubmitted']=='No'){?>                             
<input id="go" type="button" value="MAKE AN APPEAL" onclick="window.open('<?php echo $base_url;?>haltstudiesappeal.php?id=<?php echo $rProjects['id'];?>&act=<?php echo $sqUserddRREC3['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errormm3" >
<?php }?> 
                
  <?php if($rProjects['recruitment_status_id']==1 and $sqUserddRREC3['status']=='Pending' and $sqUserddRREC3['appealSubmitted']=='Yes'){?>                             
<input id="go" type="button" value="APPEALED" onclick="window.open('<?php echo $base_url;?>viewappeal.php?id=<?php echo $rProjects['id'];?>&act=<?php echo $sqUserddRREC3['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errormm3" >

<?php }?>                           
                            
                            </td>
                            <td><a href="./main.php?option=viewsubmission&id=<?php echo $rProjects['id'];?>"><span class="label label-primary">+ View Submission</span></a><div style="margin-bottom:6px;"></div>
                            
   
   
                            
                       

<?php if($rProjects['status']=='Pending Final Submission'){?><a href="./main.php?option=submission&id=<?php echo $rProjects['id'];?>" style="color:#06F; font-weight:bold;">+ Edit Submission</a>
			<div style="margin-bottom:6px;"></div>
            
            
            				
		<a href="./main.php?option=dashboardDel&id=<?php echo $rProjects['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">+ Delete Submission</a>					
							
							<?php }?>
                            
   
   
   <?php if($rProjects['is_sent']=='1' and $rProjects['status']!='Approved'){?><a href="./main.php?option=WithdrawSubmission&id=<?php echo $rProjects['id'];?>" style="color:#06F; font-weight:bold;" onclick="return confirm('Please note; Withdrawing this Submission will prevent REC Admin from proceeding with approval process. Do you wish to continue?');"><span class="label label-secwarning">Withdraw Submission</span></a><?php }?>  
   
   
                            
      <?php if(($rProjects['CompletenessCheck']=='Rejected' || $rProjects['CompletenessCheck']=='Approved' || $rProjects['CompletenessCheck']=='Pending' and $rProjects['status']!='Pending Final Submission') and $rProjects['is_sent']=='0'){?><a href="./main.php?option=submissionCheck&id=<?php echo $rProjects['id'];?>" style="color:#06F; font-weight:bold;"><span class="label label-secwarning">+ Update Submission</span></a><?php }?>                      
                            
  
  <?php if($rProjects['changeofreview']=='Yes'){?><a href="./main.php?option=viewsubmission&id=<?php echo $rProjects['id'];?>" style="color:#06F; font-weight:bold;" onclick="return confirm('Type of review changed, do you wish to make an appeal? Click OK to proceed or CANCEL to ignore.');"><span class="label label-secwarning">+ Type of review changed</span></a><?php }?>    
                           
 
 <a href="./main.php?option=CommentsSubm&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">+ View Comments</span></a>
<br /> 



<div style="margin-bottom:6px;"></div>
<a href="print.php?pr=<?php echo $rProjects['id'];?>" target="_blank"><span class="label label-sec4">+ Print Submission</span><br /></a>
<div style="margin-bottom:6px;"></div>
<?php
 if($rProjects['status']=='Approved'){?>


<div style="margin-bottom:6px;"></div>
<?php /*?><a href="./main.php?option=ApplyAmmendments/<?php echo $rProjects['id'];?>/" style="color:#06F; font-weight:bold;"><span class="label label-secwarning">Apply for Ammendments</span></a>


<a href="./main.php?option=AnnualRenualMa/<?php echo $rProjects['id'];?>/"><span class="label label-sec2">Renewals</span></a>
<div style="margin-bottom:6px;"></div>

<a href="./main.php?option=mysaes/<?php echo $rProjects['id'];?>/"><span class="label label-sec2">SAEs</span></a>

<div style="margin-bottom:6px;"></div>
<a href="./main.php?option=MyDeviations/<?php echo $rProjects['id'];?>/"><span class="label label-sec2">Deviations</span></a>
<div style="margin-bottom:6px;"></div>

<a href="./main.php?option=MyNotifications/<?php echo $rProjects['id'];?>/"><span class="label label-sec2">Safety and Other Notifications </span></a>
<div style="margin-bottom:6px;"></div>
<a href="./main.php?option=MyFinalReport/<?php echo $rProjects['id'];?>/"><span class="label label-warning">Closeout Report</span></a>
<?php */?>
                            
                            <?php }?>

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


<?php //} ///end registration information check
}
