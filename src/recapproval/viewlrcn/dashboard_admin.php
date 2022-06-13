<?php $sort=$mysqli->real_escape_string($_GET['sort']);
$vsort=$mysqli->real_escape_string($_GET['vsort']);
if($session_privillage=='administrator'){?>
<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="55%">Find protocols:<br />
    <input type="text" class="form-control" name="searchprotocol" value="<?php echo $_POST['searchprotocol'];?>"></td>
     <td width="11%">
Search by Type:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="type" data-live-search="true" tabindex="-98">
<option value="">Please Select</option>
<?php
$sqlClinicalcv4 = "select * FROM ".$prefix."categories order by rstug_categoryName asc";//and conceptm_status='new' 
$resultClinicalcv4 = $mysqli->query($sqlClinicalcv4);
while($rClinicalcv4=$resultClinicalcv4->fetch_array()){
?>
<option value="<?php echo $rClinicalcv4['rstug_categoryID'];?>" <?php if($rClinicalcv4['rstug_categoryID']==$_POST['type']){?>selected="selected"<?php }?>><?php echo $rClinicalcv4['rstug_categoryName'];?></option>
<?php }?>
</select>

                                
   </td>
    <td width="11%">
Search by REC:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="recID" data-live-search="true" tabindex="-98">
<option value="">Please Select</option>
<?php
$sqlClinicalcv2 = "select * FROM ".$prefix."list_rec_affiliated order by name asc";//and conceptm_status='new' 
$resultClinicalcv2 = $mysqli->query($sqlClinicalcv2);
while($rClinicalcv2=$resultClinicalcv2->fetch_array()){
?>
<option value="<?php echo $rClinicalcv2['id'];?>" <?php if($rClinicalcv2['id']==$_POST['recID']){?>selected="selected"<?php }?>><?php echo $rClinicalcv2['name'];?></option>
<?php }?>
</select>

                                
   </td>

    <td width="16%">
Status:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="status" data-live-search="true" tabindex="-98">
                                <option value="" selected="">All</option>
 <option value="Rejected" <?php if($_POST['status']=='Rejected'){?>selected="selected"<?php }?>>Rejected Submissions</option>
<option value="Waiting for Committee" <?php if($_POST['status']=='Waiting for Committee'){?>selected="selected"<?php }?>>Waiting for Committee Review</option>
<option value="Approved" <?php if($_POST['status']=='Approved'){?>selected="selected"<?php }?>>Approved Submissions</option>

<option value="Scheduled for Review" <?php if($_POST['status']=='Scheduled for Review'){?>selected="selected"<?php }?>>Assigned Submissions</option>

<option value="Pending Final Submission" <?php if($_POST['status']=='Pending Final Submission'){?>selected="selected"<?php }?>>New Submissions</option>
          </select>
                                
   </td>
   
   <td width="7%"><br /><input type="submit" name="doSearch" id="button" class="search btn" value="Search" /></td>
  </tr>
</table>
</form>

<div class="number allprotocols">        
         <a href="exportdata.php">EXPORT DATA</a></div>



<div class="card-header d-flex align-items-center">
                      <h3 class="h4">Submitted Protocols </h3>
</div>
                    <div class="card-body">


                        <?php
$category=$_POST['category'];
$page='./main.php?option=';
$url='dashboard';
$value='&id='.$id;
$searchprotocol=$_POST['searchprotocol'];
$status=$_POST['status'];
$recID=$_POST['recID'];
$type=$_POST['type'];
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['status'] and $_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses')  and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and status='$status' order by id desc");//and conceptm_status='new' }
}
if($_POST['status'] and !$_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and status='$status' order by id desc");//and conceptm_status='new' }
}
if(!$_POST['status'] and $_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by id desc");//and conceptm_status='new' }
}

if($_POST['status'] and $_POST['recID']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where status='$status' and recAffiliated_id='$recID' order by id desc");//and conceptm_status='new' }
}
if(!$_POST['status'] and $_POST['recID']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and recAffiliated_id='$recID' order by id desc");//and conceptm_status='new' }
}
if(!$_POST['status'] and $_POST['type']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and clinical_trial_type='$type' order by id desc");//and conceptm_status='new' }
}

if(!$_POST['doSearch']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') order by id desc");//and conceptm_status='new' }
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

if($_POST['status'] and $_POST['searchprotocol']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses')  and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and status='$status' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if($_POST['status'] and !$_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and status='$status' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if(!$_POST['status'] and $_POST['searchprotocol']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if($_POST['status'] and $_POST['recID']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where status='$status' and recAffiliated_id='$recID' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

 if(!$_POST['status'] and $_POST['type']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and clinical_trial_type='$type' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}


if(!$_POST['status'] and $_POST['recID']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and recAffiliated_id='$recID' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if(!$_POST['doSearch']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
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
               <table width="100%" class="table table-striped table-sm"  id="customers">
                        <thead>
                          <tr>
                            <th width="6%">#</th>
                            <th width="27%">Protocol Title</th>
                            <th width="20%">PI</th>
                            <th width="20%">Email</th>
                            <th width="20%">Telephone</th>
                            <th width="8%">Actions</th>
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

$sqlApproval = "select * from ".$prefix."study_approvals where rstug_rsch_project_id='$main_submission_id' order by id desc";
$resultApproval = $mysqli->query($sqlApproval);
$totalStudyApproval = $resultApproval->num_rows;
$sqStudyApproval = $resultApproval->fetch_array();
	?>
                          <tr>
                            <td scope="row"><?php echo $sqprotocol['code'];?> </td>
                            <td><h3 class="h4"><?php echo $rProjects['public_title'];?></h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small></td>
                            <td>
  <?php echo $sqUserdd['name'];?>
  <?php /*?><?php if($rProjects['is_clinical_trial']==1){?><span class="label label-warning">Clinical Trial</span> <?php }?>
  <?php if($rProjects['is_clinical_trial']==0){?><span class="label label-primary"><?php echo $sqUserddRREC2['rstug_categoryName'];?></span> <?php }?><?php */?>
                              
                              
                            </td>
                             <td><?php echo $sqUserdd['email'];?></td>
                             <td><?php echo $sqUserdd['phone'];?></td>
                             
                             
   <td>
   
   
   
   <a href="./main.php?option=viewsubmission&id=<?php echo $rProjects['id'];?>"><span class="label label-primary">+ View Submission Details</span></a>
   <div style="width:100%; height:5px;"></div>
          <?php /*?>  <?php if($rProjects['status']){?><a href="./main.php?option=submissionUpSecond/<?php echo $rProjects['id'];?>/"><img src="./img/icon2.png" border="0" title="Edit Submission"/></a>
                            <a href=""><img src="./img/icon3.png" border="0" title="Delete Protocol"/></a><?php }?><?php */?>
 <?php if($totalStudyApproval and $rProjects['status']=='Approved'){?><a href="<?php echo $base_url;?>studyapproval.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download REC Approval Letter</span></a><?php }?> 
 
  <?php if($totalStudyApproval and $rProjects['status']=='Conditional Approval'){?><br /><br />
							<a href="<?php echo $base_url;?>studyapproval.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?> 
                            
   <?php if($totalStudyApproval and $rProjects['status']=='Request for Responses'){?><br /><br />
							<a href="<?php echo $base_url;?>studyapprovalres.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?>                            
                            
                            
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
<?php }//end Admin
if($session_privillage=='superadmin'){?>
<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="59%">Find protocols:<br />
    <input type="text" class="form-control" name="searchprotocol" value="<?php echo $_POST['searchprotocol'];?>"></td>
    <td width="4%">&nbsp;</td>
    
      <td width="22%">
Search by REC:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="recID" data-live-search="true" tabindex="-98">
<option value="">Please Select</option>
<?php
$sqlClinicalcv2 = "select * FROM ".$prefix."list_rec_affiliated order by name asc";//and conceptm_status='new' 
$resultClinicalcv2 = $mysqli->query($sqlClinicalcv2);
while($rClinicalcv2=$resultClinicalcv2->fetch_array()){
?>
<option value="<?php echo $rClinicalcv2['id'];?>" <?php if($rClinicalcv2['id']==$_POST['recID']){?>selected="selected"<?php }?>><?php echo $rClinicalcv2['name'];?></option>
<?php }?>
</select>

                                
   </td>
   
   
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

<div class="card-header d-flex align-items-center">
                      <h3 class="h4">Submitted Protocols </h3>
</div>
                    <div class="card-body">
                    

                        <?php
$category=$_POST['category'];
$page='./main.php?option=';
$url='dashboard';
$value='&id='.$id;
$searchprotocol=$_POST['searchprotocol'];
$recID=$_POST['recID'];
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['status'] and $_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses')  and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and status='$status' order by id desc");//and conceptm_status='new' }
}
if($_POST['status'] and !$_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses') and status='$status' order by id desc");//and conceptm_status='new' }
}
if(!$_POST['status'] and $_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses') and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by id desc");//and conceptm_status='new' }
}

if($_POST['status'] and $_POST['recID']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and status='$status' and recAffiliated_id='$recID' order by id desc");//and conceptm_status='new' }
}

if(!$_POST['doSearch']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') order by id desc");//and conceptm_status='new' }
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

if($_POST['status'] and $_POST['searchprotocol']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses')  and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and status='$status' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if($_POST['status'] and !$_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and status='$status' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if(!$_POST['status'] and $_POST['searchprotocol']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if($_POST['status'] and $_POST['recID']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and status='$status' and recAffiliated_id='$recID' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}


if(!$_POST['doSearch']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
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
}?>
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

$sqlApproval = "select * from ".$prefix."study_approvals where rstug_rsch_project_id='$main_submission_id' order by id desc";
$resultApproval = $mysqli->query($sqlApproval);
$totalStudyApproval = $resultApproval->num_rows;
$sqStudyApproval = $resultApproval->fetch_array();
	?>
                          <tr>
                            <td scope="row"><?php echo $sqprotocol['code'];?> </td>
                            <td><h3 class="h4"><?php echo $rProjects['public_title'];?></h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small>
                            
                            
                            
                            </td>
                            <td><?php if($rProjects['is_clinical_trial']==1){?><span class="label label-warning">Clinical Trial</span> <?php }?>
  <?php if($rProjects['is_clinical_trial']==0){?><span class="label label-primary"><?php echo $sqUserddRREC2['rstug_categoryName'];?></span> <?php }?></td>
   <td><?php echo $sqUserddRREC['name'];?></td>
                            <td><?php echo $rProjects['updated'];?></td>
                            <td>
<?php if($rProjects['status']=='Approved'){echo '<span class="label label label-warning">Approved, pending UNCST approval</span>';


}else{echo $rProjects['status'];}?>
                            
                            
                             <?php if($totalStudyApproval and $rProjects['status']=='Approved'){?><br />
							<a href="<?php echo $base_url;?>studyapproval.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download REC Approval Letter</span></a><?php }?>
                            
                             <?php if($totalStudyApproval and $rProjects['status']=='Conditional Approval'){?><br /><br />
							<a href="<?php echo $base_url;?>studyapproval.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?>   
                            
                             <?php if($totalStudyApproval and $rProjects['status']=='Request for Responses'){?><br /><br />
							<a href="<?php echo $base_url;?>studyapprovalres.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?> 
                            </td>
                            <td><a href="./main.php?option=viewsubmission&id=<?php echo $rProjects['id'];?>">+ VIEW</a><br />
                            <div style="margin-bottom:6px;"></div>
<a href="print.php?pr=<?php echo $rProjects['id'];?>" target="_blank">+ PRINT<br /></a>
                          <?php /*?>  <?php if($rProjects['status']){?><a href="./main.php?option=submissionUpSecond/<?php echo $rProjects['id'];?>/"><img src="./img/icon2.png" border="0" title="Edit Submission"/></a>
                            <a href=""><img src="./img/icon3.png" border="0" title="Delete Protocol"/></a><?php }?><?php */?>
                            
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
<?php }//end Superadmin

if($session_privillage=='investigator'){
	
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
//if($totalstudyFinish2){?>
<?php /*?><input name="" type="button" class="search btn" value="Submit New Protocol" onClick="window.location.href='./main.php?option=submission'"/><?php */?>
<?php //}
//if(!$totalstudyFinish2){?>
<input name="" type="button" class="search btn" value="Submit New Protocol" onClick="window.location.href='./main.php?option=newsubmission'"/>

<!--<input name="" type="button" class="search btn" value="Research Guidelines" onClick="window.location.href='https://www.uncst.go.ug/details.php?option=smenu&id=13&Policies Guidelines Regulations.html','_blank'"/>-->
<a href="https://www.uncst.go.ug/details.php?option=smenu&id=13&Policies Guidelines Regulations.html" target="_blank" class="search btn" style="color:#ffffff;">Research Guidelines</a>

<?php //}
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
$sqStudyApproval = $resultApproval->fetch_array();
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
							<a href="<?php echo $base_url;?>studyapproval.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download REC Approval Letter</span></a><?php }?>
                            
                             <?php if($totalStudyApproval and $rProjects['status']=='Conditional Approval'){?><br /><br />
							<a href="<?php echo $base_url;?>studyapproval.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?>   
                            
                            <?php if($totalStudyApproval and $rProjects['status']=='Request for Responses'){?><br /><br />
							<a href="<?php echo $base_url;?>studyapprovalres.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?>
                            
                         <?php if($totalStudyApproval and $rProjects['status']=='Conditional Approval | Needs Minor Revisions'){?><br /><br />
							<a href="<?php echo $base_url;?>studyapproval.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?> 
                            
                            
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
                            
   
   
                            
                       

<?php if($rProjects['status']=='Pending Final Submission'){?><a href="./main.php?option=editsubmission&id=<?php echo $rProjects['id'];?>" style="color:#06F; font-weight:bold;">+ Edit Submission</a>
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
///Commiitte Member Review
if($session_privillage=='membercommittee' || $session_privillage=='communityrepresentative'){?>
<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
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

<div class="card-header d-flex align-items-center">
                      <h3 class="h4">Submitted Protocols </h3>
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
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses') and recstatus!='Pending' and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by id desc");//and conceptm_status='new' 
}
if(!$_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses') and recstatus!='Pending' order by id desc");//and conceptm_status='new' 
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
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses') and recstatus!='Pending' and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}
if(!$_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses') and recstatus!='Pending' order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
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

////
$clinical_trial_type=$rProjects['clinical_trial_type'];
$sqlSRREC2 = "select * from ".$prefix."categories where rstug_categoryID='$clinical_trial_type'";
$resultSSSREC2 = $mysqli->query($sqlSRREC2);
$sqUserddRREC2 = $resultSSSREC2->fetch_array();


$sqlApproval = "select * from ".$prefix."study_approvals where rstug_rsch_project_id='$main_submission_id' order by id desc";
$resultApproval = $mysqli->query($sqlApproval);
$totalStudyApproval = $resultApproval->num_rows;
$sqStudyApproval = $resultApproval->fetch_array();
	?>
                          <tr>
                            <td scope="row"><?php echo $sqprotocol['code'];?> </td>
                            <td><h3 class="h4"><?php echo $rProjects['public_title'];?></h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small></td>
                            <td><?php if($rProjects['is_clinical_trial']==1){?><span class="label label-warning">Clinical Trial</span> <?php }?>
  <?php if($rProjects['is_clinical_trial']==0){?><span class="label label-primary"><?php echo $sqUserddRREC2['rstug_categoryName'];?></span> <?php }?></td>
                            <td><?php echo $rProjects['updated'];?></td>
                            <td><?php if($rProjects['status']=='Approved'){echo "Approved";}else{echo $rProjects['status'];}?></td>
                            <td><a href="./main.php?option=viewsubmission&id=<?php echo $rProjects['id'];?>"></a>

<?php if($rProjects['status']!='Approved' and $rProjects['status']!='Draft' ){?><a href="./main.php?option=initialCommitteeReview&id=<?php echo $rProjects['id'];?>"></a><?php }?>
<br />
<a href="print.php?pr=<?php echo $rProjects['id'];?>" target="_blank"><span class="label label-primary">+ Print Submission</span></a>
<div style="width:100%; height:5px;"></div>


 <?php if($totalStudyApproval and $rProjects['status']=='Approved'){?><a href="<?php echo $base_url;?>studyapproval.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download REC Approval Letter</span></a><?php }?> 
 
  <?php if($totalStudyApproval and $rProjects['status']=='Conditional Approval'){?><br /><br />
							<a href="<?php echo $base_url;?>studyapproval.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?>  
                             
       <?php if($totalStudyApproval and $rProjects['status']=='Request for Responses'){?><br /><br />
							<a href="<?php echo $base_url;?>studyapprovalres.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?>                        
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
<?php }//end Admin
//REC ADMIN
if($session_privillage=='recadmin' || $session_privillage=='rechairperson' || $session_privillage=='revicechairperson'){
	

if($category=='AddToHalted' and $id){

$sqlChceckMembersNew2="update ".$prefix."submission set recruitment_status_id='1' where  id='$id'";
$mysqli->query($sqlChceckMembersNew2);//status='notallowedaccess'
echo $message='<div class="error2">Study has been added to Halted Submissions</div>';

logaction("$session_fullname added protocol $id to Halted Submissions");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=dashboard">';
}



if($category=='RemoveFromHalted' and $id){

$sqlChceckMembersNew2="update ".$prefix."submission set recruitment_status_id='0' where  id='$id'";
$mysqli->query($sqlChceckMembersNew2);//status='notallowedaccess'
echo $message='<div class="error2">Study has been removed from Halted Submissions</div>';
logaction("$session_fullname removed protocol $id from Halted Submissions");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=dashboard">';	
}
	
	?>



<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
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
<!--   <td width="9%"> <br /><input name="" type="button" class="btn-warning btn" value="Export to CSV"/></td>-->
   <td width="6%"><br /><input type="submit" name="doSearch" id="button" class="search btn" value="Search" /></td>
  </tr>
</table>
</form>


<div class="card-header d-flex align-items-center">
                      <h3 class="h4">Submitted Protocols</h3>
</div>
                    <div class="card-body">
                    


                        <?php
$category=$_POST['category'];
$page='./main.php?option=';
$url='dashboard';
$value='';
$searchprotocol=$_POST['searchprotocol'];
$status=$_POST['status'];
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['status'] and $_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses' OR status='Rejected') and recAffiliated_id='$recAffiliated_id' and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and status='$status' order by id desc");//and conceptm_status='new' 
}

if($_POST['status'] and !$_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses' OR status='Rejected') and recAffiliated_id='$recAffiliated_id' and  status='$status' order by id desc");//and conceptm_status='new' 
}

if(!$_POST['status'] and $_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses' OR status='Rejected') and recAffiliated_id='$recAffiliated_id' and  (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by id desc");//and conceptm_status='new' 

}



if(!$_POST['doSearch']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='0' OR is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses' OR status='Rejected') and recAffiliated_id='$recAffiliated_id' order by id desc");//and conceptm_status='new' 

}
/*$total_pages = $mysqli->fetch_array($mysqli->query($query));echo "Test";
$rFListss2=$query->fetch_array();*/
$row = $query -> fetch_array(MYSQLI_NUM);
$total_pages = $row[0];

/* Setup vars for query. */
//$targetpage = $page.$url.$value; 
$targetpage = $page.$url.$value; 	//your file name  (the name of this file)
$limitm = 15;
//how many items to show per page
/*Extract Last Value from a link*/
//$RequestURI=end(explode("/", $_SERVER['REQUEST_URI']));
//$page = preg_replace('/\D/', '', $RequestURI);
$page = $_GET['page'];


								//how many items to show per page
if($page) 
$start = ($page - 1) * $limitm; 			//first item to display on this page
else
$start = 0;

if($_POST['status'] and $_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='0' OR is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses' OR status='Rejected')  and recAffiliated_id='$recAffiliated_id' and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and status='$status' order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//'Pending','reviewed','Approved','Rejected'

if($_POST['status'] and !$_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='0' OR is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses' OR status='Rejected')  and recAffiliated_id='$recAffiliated_id' and status='$status' order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//'Pending','reviewed','Approved','Rejected'

if(!$_POST['status'] and $_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='0' OR is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses' OR status='Rejected')  and recAffiliated_id='$recAffiliated_id' and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//'Pending','reviewed','Approved','Rejected'

if(!$_POST['doSearch']){
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='0' OR is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses' OR status='Rejected')  and recAffiliated_id='$recAffiliated_id' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

$result = $mysqli->query($sql);


/* Setup page vars for display. */
if ($page == 0) $page = 1;					//if no page var is given, default to 1.

$prev = $page - 1;						//previous page is page - 1
$next = $page + 1;							//next page is page + 1
$lastpage = ceil($total_pages/$limitm);
		//lastpage is = total pages / items per page, rounded up.
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

$sqlSMeeting = "select * from ".$prefix."meeting where protocol_id='$main_submission_id'  and meetingFor='protocol' order by id desc";
$resultSMeeting = $mysqli->query($sqlSMeeting);
$sqUserMeeting = $resultSMeeting->fetch_array();
///Protocol Number//protocol
$sqlprotocol = "select * from ".$prefix."protocol where id='$main_submission_id'";
$resultprotocol = $mysqli->query($sqlprotocol);
$sqprotocol = $resultprotocol->fetch_array();
$newcode=$sqprotocol['code'];
$shtname=$sqUserdd['name'];

if(!$rProjects['code']){
$sqlprotocol = "update ".$prefix."submission set code='$newcode',shtname='$shtname' where id='$main_submission_id'";
//$mysqli->query($sqlprotocol);	
}
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

$sqlpReviewr = "select * from ".$prefix."submission_review_sr where owner_id='$owner_id' and protocol_id='$main_submission_id'";
$resultReviewr = $mysqli->query($sqlpReviewr);
$sqprotocolReviewr = $resultReviewr->fetch_array();

$sqlpRevisions = "select * from ".$prefix."submission_archive where owner_id='$owner_id' and protocol_id='$main_submission_id'";
$resultRevisions = $mysqli->query($sqlpRevisions);
$TotalRevisions = $resultRevisions->num_rows;

$sqlApproval = "select * from ".$prefix."study_approvals where rstug_rsch_project_id='$main_submission_id' order by id desc";
$resultApproval = $mysqli->query($sqlApproval);
$totalStudyApproval = $resultApproval->num_rows;
$sqStudyApproval = $resultApproval->fetch_array();
	?>
                          <tr>
                            <td scope="row"><?php echo $sqprotocol['code'];?> </td>
                            <td><h3 class="h4"><?php echo $rProjects['public_title'];?></h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small><br />
      
<b style="color:#F90;"><?php echo $rProjects['type_of_review'];?> </b>     
      <br />                      
                            
<?php if($TotalRevisions){?> <a href="<?php echo $base_url;?>main.php?option=RECRevisions&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Revisions [<?php echo $TotalRevisions;?>]</span></a>   <?php }?>                
                            </td>
                            <td><?php if($rProjects['is_clinical_trial']==1){?><span class="label label-warning">Clinical Trial</span> <?php }?>
  <?php if($rProjects['is_clinical_trial']==0){?><span class="label label-primary"><?php echo $sqUserddRREC2['rstug_categoryName'];?></span> <?php }?></td>
   <td><?php echo $sqUserddRREC['name'];?></td>
                            <td><?php echo $rProjects['updated'];?></td>
                            <td>
			<?php //if($rProjects['status']=='completeness check'){echo "Completeness Check"; echo "<br>";}?>
            
            <?php if($rProjects['status']=='Pending Final Submission' || $rProjects['is_sent']==0){echo "<span class='label label label-warning'>Pending Final Submission by PI</span>"; echo "<br>";}?>
            
            				
<?php if($rProjects['meeting_status']=='Meeting Scheduled' || $rProjects['meeting_status']=='Pending'){?><?php echo $rProjects['assignedto'];}else{?><?php //echo $rProjects['status'];?>
                            
<?php if($rProjects['status']=='Approved'){echo '<span class="label label label-warning">Approved</span>';}else{echo '<b style="color:#796AEE;">'.$rProjects['status'].'</b>';}  }?>

<?php /*?><?php if($rProjects['assignedto']=='Assigned' and $rProjects['status']!='Approved' and $rProjects['status']!='Conditional Approval' and !$totalStudyApproval){?><br /><a href="./main.php?option=AssignReviewers/<?php echo $rProjects['id'];?>/"><span class="label label-sec2">Re-Assign Reviewers</span></a><div style="margin-bottom:6px;"></div>  <?php }?> || $totalStudyApproval <?php */?>

<?php if(($rProjects['assignedto']=='Assigned' || $rProjects['assignedto']=='Not Assigned') and $rProjects['status']!='Approved' and $rProjects['is_sent']==1){?><br /><a href="./main.php?option=ReAssignReviewers&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Re-Assign Reviewers</span></a><div style="margin-bottom:6px;"></div>  <?php }?>

<?php /*?><?php if($rProjects['totalReviers']>=1 and $rProjects['status']!='Approved'){?><br /><a href="./main.php?option=ReAssignReviewers/<?php echo $rProjects['id'];?>/"><span class="label label-sec2">Re-Assign Reviewers</span></a><div style="margin-bottom:6px;"></div>  <?php }?><?php */?>



 <?php if($totalStudyApproval and $rProjects['status']=='Approved'){?><br /><br />
							<a href="<?php echo $base_url;?>studyapproval.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download REC Approval Letter</span></a><?php }?>
                            
 <?php if($totalStudyApproval and $rProjects['status']=='Conditional Approval'){?><br /><br />
							<a href="<?php echo $base_url;?>studyapproval.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?> 
                            
  <?php if($totalStudyApproval and $rProjects['status']=='Request for Responses'){?><br /><br />
							<a href="<?php echo $base_url;?>studyapprovalres.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?>                                                      
                            
                          <?php /*?><?php if($rProjects['assignedto']){?> 
                        
                           <button id="myBtn">View Reviewers </button><?php }?><?php */?>
                           
                           <hr />
                           <?php if($rProjects['recruitment_status_id']=='1' and $rProjects['status']=='Approved' and $rProjects['status']=='Approved at UNCST'){?>
<input id="go" type="button" value="STUDY HALTED" onclick="window.open('<?php echo $base_url;?>haltstudies.php?id=<?php echo $rProjects['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errormm3" >
      
        <?php }?>
                                                    
<?php if($rProjects['recruitment_status_id']=='0' and $rProjects['status']=='Approved' and $rProjects['status']=='Approved at UNCST'){?>

<input id="go" type="button" value="STUDY ONGOING" onclick="window.open('<?php echo $base_url;?>haltstudies.php?id=<?php echo $rProjects['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errormm4" >

<?php }?>
                           
                           
                            </td>
                            <td>
  
  <?php if($rProjects['is_sent']==0 and $rProjects['status']!='Approved'){?><a href="./main.php?option=ResubmitAllowedProtocol&id=<?php echo $rProjects['id'];?>"><span class="label label-primary" onclick="return confirm('Are you sure you want to proceed?');">Allow PI to Re-submit</span></a><div style="margin-bottom:6px;"></div><?php }?>
  
    <?php if(($rProjects['is_sent']=='1' || $rProjects['is_sent']=='0') and ($rProjects['CompletenessCheck']=='Approved' || $rProjects['CompletenessCheck']=='Rejected') and $rProjects['assignedto']=='Assigned'){?><a href="./main.php?option=ReverseFinalDecision&id=<?php echo $rProjects['id'];?>" style="color:#06F; font-weight:bold;" onclick="return confirm('Do you want to Reverse Final Decision already taken?');"><span class="label label-primary">Reverse Final Decision</span></a>
	<div style="margin-bottom:6px;"></div>
	<?php }?> 
    
  
   <?php if($rProjects['is_sent']=='1' and $rProjects['CompletenessCheck']=='Approved' and $rProjects['assignedto']!='Assigned'){?><a href="./main.php?option=ReverseCompCheckDecision&id=<?php echo $rProjects['id'];?>" style="color:#06F; font-weight:bold;" onclick="return confirm('Do you want to Reverse Final Decision already taken?');"><span class="label label-primary">Reverse CompletenessCheck Decision</span></a>
	<div style="margin-bottom:6px;"></div>
	<?php }?>
    
    
  <a href="./main.php?option=viewsubmissionrec&id=<?php echo $rProjects['id'];?>"><span class="label label-sec">View Submission</span></a>
<div style="margin-bottom:6px;"></div>
 <a href="./main.php?option=viewcomments&id=<?php echo $rProjects['id'];?>"><span class="label label-sec">View Comments</span></a>                        
   <div style="margin-bottom:6px;"></div>                         
<?php 
if($rProjects['assignedto']=='Not Assigned' and $rProjects['status']!='Draft' and $rProjects['paymentProof'] and $rProjects['paymentStatus']=='Paid' || $rProjects['paymentStatus']=='Review Pending Payment' || $rProjects['paymentStatus']=='Payment Waiver' and $rProjects['CompletenessCheck']=='Approved' and !$rProjects['totalReviers']){?><a href="./main.php?option=AssignReviewers&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Assign Reviewers</span></a><div style="margin-bottom:6px;"></div><?php }?>



<?php if($rProjects['paymentProof'] and $rProjects['paymentStatus']=='Not Paid'  and $rProjects['is_sent']==1){?><a href="./main.php?option=ConfirmPayment&id=<?php echo $rProjects['id'];?>"><span class="label label-secwarning">Update Payment Status</span></a><div style="margin-bottom:6px;"></div><?php }?>




 <?php if($rProjects['assignedto']=='Not Assigned' and $rProjects['status']!='Draft' and $rProjects['paymentProof'] and $rProjects['CompletenessCheck']!='Approved' and $rProjects['status']!='Conditional Approval' and $rProjects['status']!='Request for Responses' and ($rProjects['paymentStatus']=='Paid' || $rProjects['paymentStatus']=='Review Pending Payment' || $rProjects['paymentStatus']=='Payment Waiver') and $rProjects['is_sent']==1 and $rProjects['newresubmission']<=0){?><a href="./main.php?option=CompletenessCheck&id=<?php echo $rProjects['id'];?>"><span class="label label-secwarning">Completeness check</span></a><div style="margin-bottom:6px;"></div><?php }?> 


  
  <?php 
//$sqUserMeeting['meetingStatus']=='conducted' and 
//Assigned
  if(($rProjects['type_of_review']=='Exempt' || $rProjects['type_of_review']=='Expedited Review' || $rProjects['type_of_review']=='Fast Track'  || $rProjects['type_of_review']=='Regular Review') and $rProjects['status']!='Approved' and  $rProjects['CompletenessCheck']=='Pending' || ($rProjects['status']=='Conditional Approval' || $rProjects['status']=='Request for Responses' || $rProjects['status']=='Waiting for Committee' || $rProjects['status']=='Conditional Approval | Needs Minor Revisions') and ($rProjects['paymentStatus']=='Paid' || $rProjects['paymentStatus']=='Review Pending Payment' || $rProjects['paymentStatus']=='Payment Waiver') and $rProjects['assignedto']=='Not Assigned' and $rProjects['is_sent']==1 and $rProjects['newresubmission']>=1){?><a href="./main.php?option=CompletenessCheck&id=<?php echo $rProjects['id'];?>"><span class="label label-secwarning">Completeness check</span></a><div style="margin-bottom:6px;"></div><?php }?> 

    <?php 

	//Final decission should not be made unless the meeting has taken place (Except for Expedited or Fast Track, - Expedited do not go through meetings) || Expedited Review, Fast Track... $sqprotocolReviewr['recstatus']!='Pending' and $rProjects['status']!='Approved' and (
	
	//echo $sqUserMeeting['meetingStatus'];// removed for noe
	if($sqUserMeeting['meetingStatus']=='conducted' and $rProjects['type_of_review']=='Exempt' || $rProjects['type_of_review']=='Fast Track' || $rProjects['type_of_review']=='Regular Review' and $rProjects['type_of_review']!='Expedited Review' and $rProjects['status']!='Approved' and  $rProjects['CompletenessCheck']=='Approved'){?>
  <a href="./main.php?option=initialCommitteeReview&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Make Final Decision</span></a><div style="margin-bottom:6px;"></div><?php }
  
  /*echo $rProjects['CompletenessCheck'];
  //Rejected but had conditional approval
  if($sqUserMeeting['meetingStatus']=='conducted' and $rProjects['type_of_review']=='Exempt' || $rProjects['type_of_review']=='Fast Track' || $rProjects['type_of_review']=='Regular Review' and $rProjects['type_of_review']!='Expedited Review' and $rProjects['status']!='Approved' and  $rProjects['CompletenessCheck']=='Rejected' and $rProjects['status']=='Conditional Approval' || $rProjects['status']=='Request for Responses'){?>
  <a href="./main.php?option=initialCommitteeReview/<?php echo $rProjects['id'];?>/"><span class="label label-sec2">Make Final Decision</span></a><div style="margin-bottom:6px;"></div><?php }*/
  
//Regular Review

  if($rProjects['type_of_review']=='Expedited Review' and $rProjects['status']!='Approved' and  $rProjects['CompletenessCheck']=='Approved' and $rProjects['is_sent']==1){?>
  <a href="./main.php?option=initialCommitteeReview&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Make Final Decision</span></a><div style="margin-bottom:6px;"></div><?php }
  

if($rProjects['status']=='Conditional Approval' and $sqUserMeeting['meetingStatus']!='conducted' and $rProjects['type_of_review']=='Exempt' || $rProjects['type_of_review']=='Fast Track' || $rProjects['type_of_review']=='Regular Review' and $rProjects['type_of_review']!='Expedited Review' and $rProjects['status']!='Approved' and  $rProjects['CompletenessCheck']=='Approved' and $rProjects['is_sent']==1){?>
  <a href="./main.php?option=initialCommitteeReview&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Make Final Decision</span></a><div style="margin-bottom:6px;"></div><?php }
  if($rProjects['status']=='Scheduled for Review' || $rProjects['status']=='completeness check' and $sqUserMeeting['meetingStatus']!='conducted' and $rProjects['type_of_review']=='Exempt' || $rProjects['type_of_review']=='Fast Track' || $rProjects['type_of_review']=='Regular Review' and $rProjects['type_of_review']!='Expedited Review' and $rProjects['status']!='Approved' and  $rProjects['CompletenessCheck']=='Approved' and $rProjects['is_sent']==1){?>
  <a href="./main.php?option=initialCommitteeReview&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Make Final Decision</span></a><div style="margin-bottom:6px;"></div><?php }
  
  
    if($rProjects['status']=='Request for Responses' and $sqUserMeeting['meetingStatus']!='conducted' and $rProjects['type_of_review']=='Expedited Review' and $rProjects['status']!='Approved' and $rProjects['is_sent']==1){?>
  <a href="./main.php?option=initialCommitteeReview&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Make Final Decision</span></a><div style="margin-bottom:6px;"></div><?php }
  
  ?>

<a href="print.php?pr=<?php echo $rProjects['id'];?>" target="_blank"><span class="label label-sec3">+ PRINT</span></a>
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
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>Reviewers</strong></h3>
    </div>
    <div class="modal-body">


<?php
$sqlCountrycv = "select * FROM ".$prefix."submission_review_sr order by id asc";//and conceptm_status='new' 
$resultCountrycv = $mysqli->query($sqlCountrycv);
while($rCountrycv=$resultCountrycv->fetch_array()){
$reviewer_id=$rCountrycv['reviewer_id'];
$sqlUser = "select * FROM ".$prefix."user where asrmApplctID='$reviewer_id'";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUser);
$rUser=$resultUser->fetch_array();
?>
<?php echo $rUser['name'];?><br />
<?php }?>          
                
    </div>
    </div>
    </div><!--End Reviewer-->








<?php }//end Admin




if($session_privillage=='recitadmin'){
	

if($category=='AddToHalted' and $id){

$sqlChceckMembersNew2="update ".$prefix."submission set recruitment_status_id='1' where  id='$id'";
$mysqli->query($sqlChceckMembersNew2);//status='notallowedaccess'
echo $message='<div class="error2">Study has been added to Halted Submissions</div>';

logaction("$session_fullname added protocol $id to Halted Submissions");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
 echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=dashboard">';
}



if($category=='RemoveFromHalted' and $id){

$sqlChceckMembersNew2="update ".$prefix."submission set recruitment_status_id='0' where  id='$id'";
$mysqli->query($sqlChceckMembersNew2);//status='notallowedaccess'
echo $message='<div class="error2">Study has been removed from Halted Submissions</div>';
logaction("$session_fullname removed protocol $id from Halted Submissions");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
 echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=dashboard">';	
}
	
	?>



<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
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
<!--   <td width="9%"> <br /><input name="" type="button" class="btn-warning btn" value="Export to CSV"/></td>-->
   <td width="6%"><br /><input type="submit" name="doSearch" id="button" class="search btn" value="Search" /></td>
  </tr>
</table>
</form>


<div class="card-header d-flex align-items-center">
                      <h3 class="h4">Submitted Protocols</h3>
</div>
                    <div class="card-body">
                    


                        <?php
$category=$_POST['category'];
$page='./main.php?option=';
$url='dashboard';
$value='';
$searchprotocol=$_POST['searchprotocol'];
$status=$_POST['status'];
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['status'] and $_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and recAffiliated_id='$recAffiliated_id' and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and status='$status' order by id desc");//and conceptm_status='new' 
}

if($_POST['status'] and !$_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and recAffiliated_id='$recAffiliated_id' and  status='$status' order by id desc");//and conceptm_status='new' 
}

if(!$_POST['status'] and $_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and recAffiliated_id='$recAffiliated_id' and  (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by id desc");//and conceptm_status='new' 

}



if(!$_POST['doSearch']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and recAffiliated_id='$recAffiliated_id' order by id desc");//and conceptm_status='new' 
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

if($_POST['status'] and $_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses')  and recAffiliated_id='$recAffiliated_id' and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and status='$status' order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//'Pending','reviewed','Approved','Rejected'

if($_POST['status'] and !$_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses')  and recAffiliated_id='$recAffiliated_id' and status='$status' order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//'Pending','reviewed','Approved','Rejected'

if(!$_POST['status'] and $_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses')  and recAffiliated_id='$recAffiliated_id' and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by id desc LIMIT $start, $limitm";//and conceptm_status='new' 
}//'Pending','reviewed','Approved','Rejected'

if(!$_POST['doSearch']){
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses')  and recAffiliated_id='$recAffiliated_id' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
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

$sqlSMeeting = "select * from ".$prefix."meeting where protocol_id='$main_submission_id'  and meetingFor='protocol' order by id desc";
$resultSMeeting = $mysqli->query($sqlSMeeting);
$sqUserMeeting = $resultSMeeting->fetch_array();
///Protocol Number//protocol
$sqlprotocol = "select * from ".$prefix."protocol where id='$main_submission_id'";
$resultprotocol = $mysqli->query($sqlprotocol);
$sqprotocol = $resultprotocol->fetch_array();
$newcode=$sqprotocol['code'];
$shtname=$sqUserdd['name'];

if(!$rProjects['code']){
$sqlprotocol = "update ".$prefix."submission set code='$newcode',shtname='$shtname' where id='$main_submission_id'";
//$mysqli->query($sqlprotocol);	
}
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

$sqlpReviewr = "select * from ".$prefix."submission_review_sr where owner_id='$owner_id' and protocol_id='$main_submission_id'";
$resultReviewr = $mysqli->query($sqlpReviewr);
$sqprotocolReviewr = $resultReviewr->fetch_array();

$sqlpRevisions = "select * from ".$prefix."submission_archive where owner_id='$owner_id' and protocol_id='$main_submission_id'";
$resultRevisions = $mysqli->query($sqlpRevisions);
$TotalRevisions = $resultRevisions->num_rows;

$sqlApproval = "select * from ".$prefix."study_approvals where rstug_rsch_project_id='$main_submission_id' order by id desc";
$resultApproval = $mysqli->query($sqlApproval);
$totalStudyApproval = $resultApproval->num_rows;
$sqStudyApproval = $resultApproval->fetch_array();
	?>
                          <tr>
                            <td scope="row"><?php echo $sqprotocol['code'];?> </td>
                            <td><h3 class="h4"><?php echo $rProjects['public_title'];?></h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small><br />
                            
                            
<?php if($TotalRevisions){?> <a href="<?php echo $base_url;?>main.php?option=RECRevisions&id=<?php echo $rProjects['id'];?>"><span class="label label-sec2">Revisions [<?php echo $TotalRevisions;?>]</span></a>   <?php }?>                
                            </td>
                            <td><?php if($rProjects['is_clinical_trial']==1){?><span class="label label-warning">Clinical Trial</span> <?php }?>
  <?php if($rProjects['is_clinical_trial']==0){?><span class="label label-primary"><?php echo $sqUserddRREC2['rstug_categoryName'];?></span> <?php }?></td>
   <td><?php echo $sqUserddRREC['name'];?></td>
                            <td><?php echo $rProjects['updated'];?></td>
                            <td>
							
<?php if($rProjects['meeting_status']=='Meeting Scheduled' || $rProjects['meeting_status']=='Pending'){?><?php echo $rProjects['assignedto'];}else{?><?php //echo $rProjects['status'];?>
                            
<?php if($rProjects['status']=='Approved'){echo '<span class="label label label-warning">Approved, pending UNCST approval</span>';}else{echo '<b style="color:#796AEE;">'.$rProjects['status'].'</b>';}  }?>

 <?php if($totalStudyApproval and $rProjects['status']=='Approved'){?><br /><br />
							<a href="<?php echo $base_url;?>studyapproval.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download REC Approval Letter</span></a><?php }?>
                            
                             <?php if($totalStudyApproval and $rProjects['status']=='Conditional Approval'){?><br /><br />
							<a href="<?php echo $base_url;?>studyapproval.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?>   

                            <?php if($totalStudyApproval and $rProjects['status']=='Request for Responses'){?><br /><br />
							<a href="<?php echo $base_url;?>studyapprovalres.php?rmd_id=<?php echo $sqStudyApproval['rmd_id'];?>" target="_blank"><span class="label label-sec3">Download Letter</span></a><?php }?> 
                           
                            </td>
                            <td>
                       

<a href="print.php?pr=<?php echo $rProjects['id'];?>" target="_blank"><span class="label label-sec3">+ PRINT</span></a>
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

<?php }//end IT Admin






//mawanda
//REC ADMIN
if($session_privillage=='recreviewer'){
	///Declare conflict of interest
	if($_GET['confdata']=='yes'){}
	

	
	
	?>
<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
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
                      <h3 class="h4">Protocols for Review</h3>
</div>
                    <div class="card-body">
 
<!--end purgination section-->
               <table class="table table-striped table-sm" id="customers">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Protocol Title</th>
                            <th>Type</th>
                            <th>REC</th>
                            <th>
     <?php if($sort=='udate'){?>
<a href="main.php?option=dashboard&sort=ddate" style="color:#ffffff;">Last Update <img src="images/upm.png"/></a>
<?php }?>

<?php if($sort=='ddate'){?>
<a href="main.php?option=dashboard&sort=udate" style="color:#ffffff;">Last Update <img src="images/down.png" /></a>
<?php }?>


<?php if($sort!='udate' and $sort!='ddate'){?>
<a href="main.php?option=dashboard&sort=udate" style="color:#ffffff;">Last Update <img src="images/upm.png"/></a>
<?php }?>                       
                            </th>
                            <th>
<?php if($sort=='ustatus'){?>
<a href="main.php?option=dashboard&sort=dstatus" style="color:#ffffff;">Status<img src="images/upm.png"/></a>
<?php }?>

<?php if($sort=='dstatus'){?>
<a href="main.php?option=dashboard&sort=ustatus" style="color:#ffffff;">Status<img src="images/down.png" /></a>
<?php }?>


<?php if($sort!='ustatus' and $sort!='dstatus'){?>
<a href="main.php?option=dashboard&sort=ustatus" style="color:#ffffff;">Status<img src="images/upm.png"/></a>
<?php }?></th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
///make a limit
$limitm=50;
$currLimit=$vsort;
$limitno=($currLimit)?$currLimit:$limitm;

//view a specific number
$selectedDefault=10;
$currSelected=$vsort;
$selected=($currSelected)?$currSelected:$selectedDefault;

//sort by
$sortDefault="ddate";//default name
$currSorted=$sort;
$sorted=($currSorted)?$currSorted:$sortDefault;


if($sorted=="ddate"){
$sortby="reviewDate desc";//name //projm_finalsubDate
}

if($sorted=="udate"){
$sortby="reviewDate asc";//name //projm_finalsubDate
}
//////////////////////////////////////////////////////////////////////////////////////////////
if($sorted=="dstatus"){
$sortby="recstatus desc";//name
}

if($sorted=="ustatus"){
$sortby="recstatus asc";//name
}


$category=$_POST['category'];
$page='./main.php?option=';
$url='dashboard';
//$value='&id='.$id;
$value='&id='.$id.'&vsort='.$vsort.'&sort='.$sort;
$searchprotocol=$_POST['searchprotocol'];
$status=$_POST['status'];
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['searchprotocol']){
	
$query = $mysqli->query("select COUNT(*) as num FROM apvr_submission_review_sr,apvr_submission where  apvr_submission_review_sr.protocol_id=apvr_submission.id and apvr_submission_review_sr.reviewer_id='$asrmApplctID' and reviewFor='protocol' and (apvr_submission.public_title like '%$searchprotocol%' OR apvr_submission.code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by apvr_submission_review_sr.id desc");//and conceptm_status='new' $sortby
}
if(!$_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission_review_sr where reviewer_id='$asrmApplctID' and reviewFor='protocol' order by $sortby");//and conceptm_status='new'
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
	
	/* Setup vars for query. */
	//$targetpage = $page.$url.$value; 
	//$targetpage = $page.$url.$value; 	//your file name  (the name of this file)
	

	
	//how many items to show per page
	//$page = $mysqli->real_escape_string($_GET['page']);
	if($page) 
		$start = ($page - 1) * $limitno; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
								//how many items to show per page
if($page) 
$start = ($page - 1) * $limitm; 			//first item to display on this page
else
$start = 0;

if($_POST['searchprotocol']){								//if no page var is given, set start to 0
$sql = "select * FROM apvr_submission_review_sr,apvr_submission where  apvr_submission_review_sr.protocol_id=apvr_submission.id and apvr_submission_review_sr.reviewer_id='$asrmApplctID' and reviewFor='protocol' and (apvr_submission.public_title like '%$searchprotocol%' OR apvr_submission.code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by apvr_submission_review_sr.id desc LIMIT $start, $limitm";//$sortby LIMIT $start, $limitnoand conceptm_status='new'
//
}
if(!$_POST['searchprotocol']){								//if no page var is given, set start to 0
$sql = "select * FROM ".$prefix."submission_review_sr where  reviewer_id='$asrmApplctID' and reviewFor='protocol' order by $sortby LIMIT $start, $limitm";//and conceptm_status='new'
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

</div>
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

///submission_review_sr
$sqlReview = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created  from ".$prefix."submission where protocol_id='$main_submission_id'";
$resultReview = $mysqli->query($sqlReview);
$totalReview = $resultReview->num_rows;
$sqReview = $resultReview->fetch_array();

////Get REC
$recAffiliated_c=$rProjects['recAffiliated_c'];
$sqlSRREC = "select * from ".$prefix."list_rec_affiliated where id='$recAffiliated_c'";
$resultSSSREC = $mysqli->query($sqlSRREC);
$sqUserddRREC = $resultSSSREC->fetch_array();

////
$clinical_trial_type=$sqReview['clinical_trial_type'];
$sqlSRREC2 = "select * from ".$prefix."categories where rstug_categoryID='$clinical_trial_type'";
$resultSSSREC2 = $mysqli->query($sqlSRREC2);
$sqUserddRREC2 = $resultSSSREC2->fetch_array();
//echo '|'.$rProjects['id'];
	?>
                          <tr>
                            <td scope="row"><?php echo $sqprotocol['code'];?> </td>
                            <td><h3 class="h4"><?php echo $sqReview['public_title'];?></h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small></td>
                            <td><?php if($sqReview['is_clinical_trial']==1){?><span class="label label-warning">Clinical Trial</span> <?php }?>
  <?php if($sqReview['is_clinical_trial']==0){?><span class="label label-primary"><?php echo $sqUserddRREC2['rstug_categoryName'];?></span> <?php }?>                          </td>
   <td><?php echo $sqUserddRREC['name'];?></td>
                            <td><?php echo $sqReview['updated'];?></td>
                            <td>
							<?php if(!$totalReview){?>Waiting for Committee Review<?php }?>
							<?php if($totalReview){?><?php echo $rProjects['recstatus'];?> <?php }?>
                            
							</td>
                            <td>
<?php
//|| $rProjects['recstatus']=='Needs Minor Revisions'  || $rProjects['recstatus']=='Conditional Approval'   || $rProjects['recstatus']=='NotReviewed'

if(($rProjects['recstatus']=='Pending' || $rProjects['recstatus']=='new' || $rProjects['recstatus']=='NotReviewed' || $rProjects['recstatus']=='Needs Minor Revisions' || $rProjects['recstatus']=='Conditional Approval') and $rProjects['conflictofInterest']=='no'){?><a href="./main.php?option=RecinitialCommitteeReview&id=<?php echo $sqReview['id'];?>&srid=<?php echo $rProjects['id'];?>" style=" color:#ffffff;" class="label label-sec4">Review Submission</a><br />

<?php } ?>

<?php /*?><?php
if($rProjects['conflictofInterest']!='none'){?><br /><a href="./main.php?option=RecinitialCommitteeReview&id=<?php echo $sqReview['id'];?>&srid=<?php echo $rProjects['id'];?>" style=" color:#ffffff;" class="label label-sec4">Update Comments</a><br />

<?php } ?><?php */?>

<?php if($rProjects['conflictofInterest']=='none' and $rProjects['recstatus']=='Pending' || $rProjects['recstatus']=='new' || $rProjects['recstatus']=='NotReviewed' || $rProjects['recstatus']=='Needs Minor Revisions' || $rProjects['recstatus']=='Conditional Approval'){?>
<div style="margin-bottom:6px;"></div>

<input id="go" type="button" value="Click to Confirm Availability to Review" onclick="window.open('<?php echo $base_url;?>conflict.php?id=<?php echo $rProjects['id'];?>','popUpWindow','height=500, width=700, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm3" >


<?php }?>


<div style="margin-bottom:6px;"></div>


<a href="print.php?pr=<?php echo $sqReview['id'];?>" target="_blank"  class="label label-primary" style=" color:#ffffff; padding-left:15px; padding-right:13px;">View /Print Submission</a>

<?php if($rProjects['conflictofInterest']!='none'){?>
<div style="margin-bottom:6px;"></div>
<a href="./main.php?option=reviewercomments&id=<?php echo $sqReview['id'];?>" class="label label-primary" style=" color:#ffffff; padding-left:15px; padding-right:13px;">View Comments</a>
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
<?php }//end Admin

if($session_privillage=='UHNRO'){?>
<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="55%">Find protocols:<br />
    <input type="text" class="form-control" name="searchprotocol" value="<?php echo $_POST['searchprotocol'];?>"></td>
     <td width="11%">
Search by Type:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="type" data-live-search="true" tabindex="-98">
<option value="">Please Select</option>
<?php
$sqlClinicalcv4 = "select * FROM ".$prefix."categories order by rstug_categoryName asc";//and conceptm_status='new' 
$resultClinicalcv4 = $mysqli->query($sqlClinicalcv4);
while($rClinicalcv4=$resultClinicalcv4->fetch_array()){
?>
<option value="<?php echo $rClinicalcv4['rstug_categoryID'];?>" <?php if($rClinicalcv4['rstug_categoryID']==$_POST['type']){?>selected="selected"<?php }?>><?php echo $rClinicalcv4['rstug_categoryName'];?></option>
<?php }?>
</select>

                                
   </td>
    <td width="11%">
Search by REC:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="recID" data-live-search="true" tabindex="-98">
<option value="">Please Select</option>
<?php
$sqlClinicalcv2 = "select * FROM ".$prefix."list_rec_affiliated order by name asc";//and conceptm_status='new' 
$resultClinicalcv2 = $mysqli->query($sqlClinicalcv2);
while($rClinicalcv2=$resultClinicalcv2->fetch_array()){
?>
<option value="<?php echo $rClinicalcv2['id'];?>" <?php if($rClinicalcv2['id']==$_POST['recID']){?>selected="selected"<?php }?>><?php echo $rClinicalcv2['name'];?></option>
<?php }?>
</select>

                                
   </td>

    <td width="16%">
Status:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="status" data-live-search="true" tabindex="-98">
                                <option value="" selected="">All</option>
 <option value="Rejected" <?php if($_POST['status']=='Rejected'){?>selected="selected"<?php }?>>Rejected Submissions</option>
<option value="Waiting for Committee" <?php if($_POST['status']=='Waiting for Committee'){?>selected="selected"<?php }?>>Waiting for Committee Review</option>
<option value="Approved" <?php if($_POST['status']=='Approved'){?>selected="selected"<?php }?>>Approved Submissions</option>

<option value="Scheduled for Review" <?php if($_POST['status']=='Scheduled for Review'){?>selected="selected"<?php }?>>Assigned Submissions</option>

<option value="Pending Final Submission" <?php if($_POST['status']=='Pending Final Submission'){?>selected="selected"<?php }?>>New Submissions</option>
          </select>
                                
   </td>
   
   <td width="7%"><br /><input type="submit" name="doSearch" id="button" class="search btn" value="Search" /></td>
  </tr>
</table>
</form>

<div class="card-header d-flex align-items-center">
                      <h3 class="h4">Submitted Protocols </h3>
</div>
                    <div class="card-body">
                    
            
                        <?php
$category=$_POST['category'];
$page='./main.php?option=';
$url='dashboard';
$value='&id='.$id;
$searchprotocol=$_POST['searchprotocol'];
$status=$_POST['status'];
$recID=$_POST['recID'];
$type=$_POST['type'];
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['status'] and $_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses')  and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and status='$status' and is_clinical_trial='1' order by id desc");//and conceptm_status='new' }
}
if($_POST['status'] and !$_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and status='$status' and is_clinical_trial='1' order by id desc");//and conceptm_status='new' }
}
if(!$_POST['status'] and $_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and is_clinical_trial='1' order by id desc");//and conceptm_status='new' }
}

if($_POST['status'] and $_POST['recID']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where status='$status' and recAffiliated_id='$recID' and is_clinical_trial='1' order by id desc");//and conceptm_status='new' }
}
if(!$_POST['status'] and $_POST['recID']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and recAffiliated_id='$recID' and is_clinical_trial='1' order by id desc");//and conceptm_status='new' }
}
if(!$_POST['status'] and $_POST['type']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and clinical_trial_type='$type' and is_clinical_trial='1' order by id desc");//and conceptm_status='new' }
}

if(!$_POST['doSearch']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses') and is_clinical_trial='1' order by id desc");//and conceptm_status='new' }
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

if($_POST['status'] and $_POST['searchprotocol']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses')  and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and status='$status' and is_clinical_trial='1' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if($_POST['status'] and !$_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses') and status='$status' and is_clinical_trial='1' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if(!$_POST['status'] and $_POST['searchprotocol']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses') and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and is_clinical_trial='1' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if($_POST['status'] and $_POST['recID']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where status='$status' and recAffiliated_id='$recID' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

 if(!$_POST['status'] and $_POST['type']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and clinical_trial_type='$type' and is_clinical_trial='1' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}


if(!$_POST['status'] and $_POST['recID']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval'  OR status='Request for Responses') and recAffiliated_id='$recID'  and is_clinical_trial='1' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if(!$_POST['doSearch']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and is_clinical_trial='1'  order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
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
               <table width="100%" class="table table-striped table-sm"  id="customers">
                        <thead>
                          <tr>
                            <th width="6%">#</th>
                            <th width="27%">Protocol Title</th>
                            <th width="20%">PI</th>
                            <th width="8%">Actions</th>
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
	?>
                          <tr>
                            <td scope="row"><?php echo $sqprotocol['code'];?> </td>
                            <td><h3 class="h4"><?php echo $rProjects['public_title'];?></h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small></td>
                            <td>
  <?php echo $sqUserdd['name'];?>
  <?php /*?><?php if($rProjects['is_clinical_trial']==1){?><span class="label label-warning">Clinical Trial</span> <?php }?>
  <?php if($rProjects['is_clinical_trial']==0){?><span class="label label-primary"><?php echo $sqUserddRREC2['rstug_categoryName'];?></span> <?php }?><?php */?>
                              
                              
                            </td>
   <td><a href="./main.php?option=viewsubmission&id=<?php echo $rProjects['id'];?>" style="color:#039; font-weight:bold;">+ VIEW</a>
          <?php /*?>  <?php if($rProjects['status']){?><a href="./main.php?option=submissionUpSecond/<?php echo $rProjects['id'];?>/"><img src="./img/icon2.png" border="0" title="Edit Submission"/></a>
                            <a href=""><img src="./img/icon3.png" border="0" title="Delete Protocol"/></a><?php }?><?php */?>
                            
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
<?php }//end UHNRO


if($session_privillage=='monitoring' || $session_privillage=='secretary' ){?>
<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="59%">Find protocols:<br />
    <input type="text" class="form-control" name="searchprotocol" value="<?php echo $_POST['searchprotocol'];?>"></td>
    <td width="4%">&nbsp;</td>
    
      <td width="22%">
Search by REC:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="recID" data-live-search="true" tabindex="-98">
<option value="">Please Select</option>
<?php
$sqlClinicalcv2 = "select * FROM ".$prefix."list_rec_affiliated order by name asc";//and conceptm_status='new' 
$resultClinicalcv2 = $mysqli->query($sqlClinicalcv2);
while($rClinicalcv2=$resultClinicalcv2->fetch_array()){
?>
<option value="<?php echo $rClinicalcv2['id'];?>" <?php if($rClinicalcv2['id']==$_POST['recID']){?>selected="selected"<?php }?>><?php echo $rClinicalcv2['name'];?></option>
<?php }?>
</select>

                                
   </td>
   
   
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

<div class="card-header d-flex align-items-center">
                      <h3 class="h4">Submitted Protocols </h3>
</div>
                    <div class="card-body">
                    
        
                        <?php
$category=$_POST['category'];
$page='./main.php?option=';
$url='dashboard';
$value='&id='.$id;
$searchprotocol=$_POST['searchprotocol'];
$recID=$_POST['recID'];
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
if($_POST['status'] and $_POST['searchprotocol']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses')  and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and status='$status' order by id desc");//and conceptm_status='new' }
}
if($_POST['status'] and !$_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and status='$status' order by id desc");//and conceptm_status='new' }
}
if(!$_POST['status'] and $_POST['searchprotocol']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by id desc");//and conceptm_status='new' }
}

if($_POST['status'] and $_POST['recID']){	
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and status='$status' and recAffiliated_id='$recID' order by id desc");//and conceptm_status='new' }
}

if(!$_POST['doSearch']){
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') order by id desc");//and conceptm_status='new' }
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

if($_POST['status'] and $_POST['searchprotocol']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses')  and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') and status='$status' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if($_POST['status'] and !$_POST['searchprotocol']){							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and status='$status' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if(!$_POST['status'] and $_POST['searchprotocol']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and (public_title like '%$searchprotocol%' OR code like '%$searchprotocol%' OR shtname like '%$searchprotocol%') order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}

if($_POST['status'] and $_POST['recID']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') and status='$status' and recAffiliated_id='$recID' order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
}


if(!$_POST['doSearch']){						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (is_sent='1' OR status='Conditional Approval' OR status='Request for Responses') order by id desc LIMIT $start, $limitm";//and conceptm_status='new'
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
}?>
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
	?>
                          <tr>
                            <td scope="row"><?php echo $sqprotocol['code'];?> </td>
                            <td><h3 class="h4"><?php echo $rProjects['public_title'];?></h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small>
                            
                            
                            
                            </td>
                            <td><?php if($rProjects['is_clinical_trial']==1){?><span class="label label-warning">Clinical Trial</span> <?php }?>
  <?php if($rProjects['is_clinical_trial']==0){?><span class="label label-primary"><?php echo $sqUserddRREC2['rstug_categoryName'];?></span> <?php }?></td>
   <td><?php echo $sqUserddRREC['name'];?></td>
                            <td><?php echo $rProjects['updated'];?></td>
                            <td><?php if($rProjects['status']=='Approved'){echo "Approved";}else{echo $rProjects['status'];}?></td>
                            <td><a href="./main.php?option=viewsubmission&id=<?php echo $rProjects['id'];?>">+ VIEW</a><br />
                            <div style="margin-bottom:6px;"></div>
<a href="print.php?pr=<?php echo $rProjects['id'];?>" target="_blank">+ PRINT<br /></a>
                          <?php /*?>  <?php if($rProjects['status']){?><a href="./main.php?option=submissionUpSecond/<?php echo $rProjects['id'];?>/"><img src="./img/icon2.png" border="0" title="Edit Submission"/></a>
                            <a href=""><img src="./img/icon3.png" border="0" title="Delete Protocol"/></a><?php }?><?php */?>
                            
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
<?php }//end Monitoring