<?php if($session_privillage=='investigator'){
	
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
<input name="" type="button" class="search dropbtn2" value="Click to submit SAEs" onClick="window.location.href='./main.php?option=SAEsManual'"/>




<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="59%">Find SAEs:<br />
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
                    
                    <?php
	if($category=='SAEDel' and $id){
	$ownerid=$_SESSION['asrmApplctID'];
	//Remove this submission
	$sqlUsers="SELECT * FROM ".$prefix."saes where `owner_id`='$ownerid' and id='$id' and status='Pending'";
		$QueryUsers = $mysqli->query($sqlUsers);
		$totalUsers = $QueryUsers->num_rows;
		$rUserInv=$QueryUsers->fetch_array();
	if($totalUsers){
	$sqlA2Protocol2="delete from ".$prefix."saes where `owner_id`='$ownerid' and id='$id' and status='Pending'";
	$mysqli->query($sqlA2Protocol2);
	
	echo $message='<p class="failed">Dear '.$session_fullname.', SAE has been deleted.</p>';

	}
	
	}
	?>
               <table width="100%" class="table table-striped table-sm" id="customers">
                        <thead>
                          <tr>
                            <th width="6%">#</th>
                            <th width="37%">Protocol Title</th>
                            <th width="12%">Date of Birth</th>
                            <th width="7%">Gender</th>
                            <th width="15%">Submission Date</th>
                            <th width="9%">Status</th>
                            <th width="14%">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php

$category=$_POST['category'];
$page='main.php?';
$url='mysaes';
$value='&id='.$id;
$searchprotocol=$_POST['searchprotocol'];
$status=$_POST['status'];
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."saes where (ArticleBeignStudied like '%$searchprotocol%' OR RouteOfAdministration like '%$searchprotocol%' OR DescripitionOfTheEvent like '%$searchprotocol%') and owner_id='$asrmApplctID' order by id desc");//and conceptm_status='new' 
}
if(!$_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."saes where owner_id='$asrmApplctID' order by id desc");//and conceptm_status='new' 
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
$sql = "select *,DATE_FORMAT(`datesubmitted`,'%d/%m/%Y %H:%s:%i') AS datesubmitted FROM ".$prefix."saes where (ArticleBeignStudied like '%$searchprotocol%' OR RouteOfAdministration like '%$searchprotocol%' OR DescripitionOfTheEvent like '%$searchprotocol%') and owner_id='$asrmApplctID' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}
if(!$_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`datesubmitted`,'%d/%m/%Y %H:%s:%i') AS datesubmitted FROM ".$prefix."saes where owner_id='$asrmApplctID' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
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
} 
while($rProjects=$result->fetch_array()){
$owner_id=$rProjects['owner_id'];
$main_submission_id=$rProjects['protocol_id'];
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
///Protocol Number//protocol
$sqlprotocol = "select * from ".$prefix."submission where id='$main_submission_id'";
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
	?>
                          <tr>
                            <td scope="row"><?php echo $sqprotocol['code'];?> </td>
                            <td><h3 class="h4"><?php 
							if($rProjects['ammendType']=='manual'){
							echo $rProjects['public_title'];
							}
							if($rProjects['ammendType']=='online'){
							echo $sqprotocol['public_title'];
							}
							?>
                            
                            
                            </h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small></td>
                            <td><?php echo $rProjects['date_of_birth'];?>    
                            
                            </td>
                            <td><?php echo $rProjects['gender'];?></td>
                            
                            <td><?php echo $rProjects['datesubmitted'];?></td>
                            
                            <td><?php if($rProjects['status']=='Approved'){echo "Approved";}else{echo $rProjects['status'];}?></td>
                            <td><a href="./main.php?option=viewSAEs&id=<?php echo $rProjects['id'];?>"><span class="label label-primary">+ View Submission</span></a><div style="margin-bottom:6px;"></div>
                            
                            
        
  <?php if($rProjects['status']=='Pending' and $rProjects['ammendType']=='manual'){?><a href="./main.php?option=SAEsManual&id=<?php echo $rProjects['id'];?>" style="color:#06F; font-weight:bold;">+ Edit Submission</a>
			<div style="margin-bottom:6px;"></div>
            <?php }?>
            
            
            <?php if($rProjects['status']=='Pending' and $rProjects['ammendType']=='online'){?><a href="./main.php?option=SAEsOnline&id=<?php echo $rProjects['id'];?>" style="color:#06F; font-weight:bold;">+ Edit Submission</a>
			<div style="margin-bottom:6px;"></div>
            <?php }?>
            
            
 <?php if($rProjects['status']=='Pending'){?>				
		<a href="./main.php?option=SAEDel&id=<?php echo $rProjects['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">+ Delete Submission</a>					
							
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
