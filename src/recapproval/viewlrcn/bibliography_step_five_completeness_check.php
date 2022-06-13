<?php
//doSaveFive
if($_POST['doSaveFive'] and $_POST['asrmApplctID'] and $id){

	$bibliography=$mysqli->real_escape_string($_POST['bibliography']);
	$sscientific_contact=$mysqli->real_escape_string($_POST['sscientific_contact']);
	$prior_ethical_approval=$mysqli->real_escape_string($_POST['prior_ethical_approval']);
	$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
	$asrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$Employer=$mysqli->real_escape_string($_POST['Employer']);
$Position=$mysqli->real_escape_string($_POST['Position']);

if($_FILES['attachethicalapproval']['name']){
$attachethicalapproval = preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']);
$attachethicalapproval2 = $sasrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$targetw1 = "files/uploads/". basename($sasrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['tmp_name']), $targetw1);

$sqlA2Protocola="update ".$prefix."submission  set `approvaletter`='$attachethicalapproval2' where id='$submission_id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocola);
}

$sqlA2Protocol="update ".$prefix."submission  set `bibliography`='$bibliography',`sscientific_contact`='$sscientific_contact',`prior_ethical_approval`='$prior_ethical_approval',`Employer`='$Employer',`Position`='$Position' where id='$submission_id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol);

//insert into education
for ($i=0; $i < count($_POST['rstug_educn_designation']); $i++) {
$rstug_educn_university=$_POST['rstug_educn_university'][$i];
$rstug_educn_designation=$_POST['rstug_educn_designation'][$i];
$rstug_educn_year=$_POST['rstug_educn_year'][$i];
$rstug_educn_period=($_POST['rstug_educn_period'][$i]);

if(strlen($_POST['rstug_educn_designation'][$i])>=5){
$Insert_QR2="insert into ".$prefix."education_history (`rstug_user_id`,`rstug_educn_university`,`rstug_educn_designation`,`rstug_educn_year`,`rstug_educn_period`,`rstug_ammend`) values ('$asrmApplctID','$rstug_educn_university','$rstug_educn_designation','$rstug_educn_year','$rstug_educn_period','0')";
$mysqli->query($Insert_QR2);
}
}

for ($i=0; $i < count($_POST['year'][$i]); $i++) {
	$current_yearm = date('Y');
$institution=$_POST['institution'][$i];
$designation=$_POST['designation'][$i];
$year=$_POST['year'][$i];
//$period=$_POST['period'][$i];
$period=($current_yearm-$year);

if(strlen($_POST['institution'][$i])>=5){
$Insert_QR2="insert into ".$prefix."employment_details (`rstug_user_id`,`rstug_institution`,`rstug_designation`,`rstug_year`,`rstug_period`,`rstug_ammend`) values ('$asrmApplctID','$institution','$designation','$year','$period','0')";
$inseted=$mysqli->query($Insert_QR2);
}
}


//Insert into Submission Stages
$qRPersoneldTT="select * from ".$prefix."employment_details  where rstug_user_id='$asrmApplctID'";
$RPersoneldTT=$mysqli->query($qRPersoneldTT);

$qRPersoneldSS="select * from ".$prefix."employment_details  where rstug_user_id='$asrmApplctID'";
$RPersoneldSS=$mysqli->query($qRPersoneldSS);


$wm="select * from ".$prefix."submission_stages where  owner_id='$asrmApplctID' and protocol_id='$submission_id' and status='new'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();
if($totalStages and $RPersoneldTT->num_rows and $RPersoneldSS->num_rows){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `bibliography`='1' where `owner_id`='$asrmApplctID' and `protocol_id`='$submission_id'";
$mysqli->query($sqlASubmissionStages);
}

$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname updated protocol, Bibliography Information");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionSixUp&id='.$id.'">';


}//end post



$sqlstudy="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id'  order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];
//submission_stages
$sqlSub_Stages="SELECT * FROM ".$prefix."submission_stages where `owner_id`='$asrmApplctID' and protocol_id='$protocol_id' and status='new' order by id desc limit 0,1";
$QuerySub_stages = $mysqli->query($sqlSub_Stages);
$totalSub_Stages = $QuerySub_stages->num_rows;
$rsSubStages = $QuerySub_stages->fetch_array();
?>
<?php include("viewlrcn/final_button.php");?>
<ul id="countrytabs" class="shadetabs">
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionCheck&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSecondUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionThirdUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=StudyPopulationUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</li><?php }?>

<?php if($rstudy['is_clinical_trial']==1){?>
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFourUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</li><?php }}?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionBudgetUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionScheduleUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</li><?php }?>

<li><a href="#" rel="#default" class="selected"<?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</a></li>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSixUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFinishUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['payments']==1){?> style="background:green; color:#FFF;" <?php }?>>Payments</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['payments']==1){?> style="background:green; color:#FFF;" <?php }?>>Payments</li><?php }?>
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
	
    /*
	
	var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
    inp3.id += len;
    inp3.value = '';
	
	var inp4 = new_row.cells[4].getElementsByTagName('input')[0];
    inp4.id += len;
    inp4.value = '';
	
	new_row.cells[5].getElementsByTagName('input')[0].removeAttribute('style');	
	
	
	var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
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
    inp3.value = '';	new_row.cells[3].getElementsByTagName('input')[0].removeAttribute('style');*/

    x.appendChild( new_row );
}
</script>
<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and protocol_id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
?>
  <!-- Project-->
              <div class="project">
                <div class="row bg-white has-shadow">
                  <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center">
                     <?php if($sqUserdd['profile']){?> <div class="image has-shadow"><img src="files/profile/<?php echo $sqUserdd['profile'];?>" alt="..." class="img-fluid"></div><?php }?>
                      <div class="text">
                        <h3 class="h4">Protocal Title</h3><small><?php echo $rstudym['public_title'];?></small>
                      </div>
                    </div>
                    <div class="project-date"><span class="hidden-sm-down"><h3 class="h4">Author</h3> <?php echo $sqUserdd['name'];?></span></div>
                  </div>
                  <div class="right-col col-lg-6 d-flex align-items-center">
                    <div class="time"><i class="fa fa-clock-o"></i><h3 class="h4">Updated At</h3> <?php echo $rstudym['updated'];?> </div>
                    <!--<div class="comments"><i class="fa fa-comment-o"></i>20</div>-->
                    <div class="project-progress">
                     
                     
    <?php include("viewlrcn/status_log_resubmit.php");?>


                    </div>
                  </div>
                </div>
              </div>
<?php 

if(isset($message)){echo $message;}
?>

<form action="" name="regForm" id="regForm" method="post" enctype="multipart/form-data" autocomplete="off">
    
                        
                        <div class="form-group row">
                        
                        <table width="100%">
                <tr>
<td colspan="2">

<h3 style="font-size:14px;" class="defmf">Employment</h3><hr />
<table width="80%" border="0" id="POITable" class="thhdeaders">
        <tr>
            <th width="6%" style=" display:none;">&nbsp;</th>
            <th width="21%"><strong>Institution (in full)<span class="error3">*</span>
            </strong></th>
            <th width="28%"><strong>Designation <span class="error3">*</span></strong></th>
            <th width="14%"><strong>Year <span class="error3">*</span></strong></th>


            <th width="13%">&nbsp;</th>
            <th width="18%">&nbsp;</th>
        </tr>
        <tr>
            <td style=" display:none;">1</td>
            <td>
<input type="text" name="institution[]" id="vvv" tabindex="4" class="requiremd" minlength="8" style="border:1px solid #7F9DB9;width:160px;background:url(./images/fmbg.jpg);padding:5px;"/>
            </td>
            <td><input type="text" name="designation[]" id="customss2" tabindex="5" class="requiredm" style="border:1px solid #7F9DB9;width:160px;background:url(./images/fmbg.jpg);padding:5px;"/></td>
  
          
  
  
            <td><select name="year[]" id="ssss" class="requiredm" style="border:1px solid #7F9DB9;width:60px;background:url(./images/fmbg.jpg);padding:5px;">
<option value="">Year</option>
<?php
define('DOB_YEAR_START', 1950);

$current_year = date('Y')+0;

for ($count = $current_year; $count >= DOB_YEAR_START; $count--)
{
?>
    <option value="<?php echo $count;?>"><?php echo $count;?></option>
<?php }?>

  </select></td>
       
           
            <td><input type="button" id="delPOIbutton" value="Delete" onClick="deleteRow(this)" style="display:none; font-size:12px;"/></td>
            <td><input type="button" id="addmorePOIbutton" value="Add Rows" onClick="insRow()" style="font-size:12px;"/></td>
        </tr>
       </table>
       
       
       <?php
	   if($category=='submissionFiveEmpRemoveUp'){
$qRDel2="delete from ".$prefix."employment_details where rstug_user_id='$asrmApplctID' and rstug_employment_id='$id'";
$mysqli->query($qRDel2);
}
$qRPersoneld2="select * from ".$prefix."employment_details  where rstug_user_id='$asrmApplctID'";
$RPersoneld2=$mysqli->query($qRPersoneld2);

if($RPersoneld2->num_rows){?>
<table width="80%" border="0" id="customers2"> 

 <tr>
            <th width="27%">Institution (in full)</th>
            <th width="27%">Designation</th>
            <th width="15%">Year</th>
            <th width="16%">Period (Years)</th>
            <th width="15%">&nbsp;</th>
        </tr>
 <?php
while ($rowRows2 = $RPersoneld2->fetch_array())
{ 
	?>

<tr>
            <td id="grid"><?php echo $rowRows2['rstug_institution'];?> </td>
            <td id="grid"><?php echo $rowRows2['rstug_designation'];?> </td>
            <td id="grid"><?php echo $rowRows2['rstug_year'];?> </td>
            <td id="grid"><?php echo $rowRows2['rstug_period'];?> </td>
        
            <td><a href="./main.php?option=submissionFiveEmpRemoveUp&id=<?php echo $rowRows2['rstug_employment_id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
        </tr><?php } ?> 
</table>
<?php } ?> 
   
    
    
    <br />
   
   <h3 style="font-size:14px;" class="defmf">Education</h3> <hr />
    <table width="100%">
                <tr>
<td colspan="2">

<table width="80%" border="0" id="POITable2" class="thhdeaders">
        <tr>
            <th width="2%" style=" display:none;">&nbsp;</th>
            <th width="22%"><strong>Institution (in full)<span class="error3">*</span></strong></th>
            <th width="26%"><strong>Qualification <span class="error3">*</span></strong></th>
            <th width="11%"><strong>Year <span class="error3">*</span></strong></th>
            <th width="24%"><strong>Field of  Specialization <span class="error3">*</span></strong></th>

            <th width="1%">&nbsp;</th>
            <th width="14%">&nbsp;</th>
        </tr>
        <tr>
            <td style=" display:none;">1</td>
            <td>
<input type="text" name="rstug_educn_university[]" id="vvv" tabindex="8" class="requiredm" minlength="5" style="border:1px solid #7F9DB9;width:160px;background:url(./images/fmbg.jpg);padding:5px;"/>
            </td>
            <td><input type="text" name="rstug_educn_designation[]" id="customss2" class="requiredm" minlength="5" style="border:1px solid #7F9DB9;width:160px;background:url(./images/fmbg.jpg);padding:5px;"/></td>
  
          
  
  
            <td><select name="rstug_educn_year[]" id="ssss" class="requiredm" style="border:1px solid #7F9DB9;width:60px;background:url(./images/fmbg.jpg);padding:5px;">
<option value="">Year</option>
<?php
define('DOB_YEAR_START', 1950);

$current_year = date('Y')+0;

for ($count = $current_year; $count >= DOB_YEAR_START; $count--)
{
?>
    <option value="<?php echo $count;?>"><?php echo $count;?></option>
<?php }?>

  </select></td>
              <td>
            <input type="text" name="rstug_educn_period[]" id="ddd" tabindex="5" class="requiredm" style="border:1px solid #7F9DB9;width:160px;background:url(./images/fmbg.jpg);padding:5px;"/>
            </td>
           
            <td><input type="button" id="delPOIbutton" value="Delete" onClick="deleteRow(this)" style="display:none; font-size:12px;"/></td>
            <td><input type="button" id="addmorePOIbutton" value="Add Rows" onClick="insRow2()" style="font-size:12px;"/></td>
        </tr>
        </table>
        
        
        
             <?php
if($category=='submissionFiveRemoveUp'){
$qRDel="delete from ".$prefix."education_history where rstug_user_id='$asrmApplctID' and rstug_educn_id='$id'";
$mysqli->query($qRDel);
}
$qRPersoneld="select * from ".$prefix."education_history  where rstug_user_id='$asrmApplctID'";
$RPersoneld=$mysqli->query($qRPersoneld);
if($RPersoneld->num_rows){?>
<table width="80%" border="0" id="customers2">
<tr>
            <th width="24%">Institution (in full)</th>
            <th width="26%">Qualification </th>
            <th width="11%">Year </th>
            <th width="28%">Field of  Specialization </th>

            <th width="11%">&nbsp;</th>

        </tr>
<?php
while ($rowRows = $RPersoneld->fetch_array())
{ ///Display data for education history
	?>
<tr>
            <td><?php echo $rowRows['rstug_educn_university'];?> </td>
            <td><?php echo $rowRows['rstug_educn_designation'];?> </td>
            <td><?php echo $rowRows['rstug_educn_year'];?> </td>
            <td><?php echo $rowRows['rstug_educn_period'];?> 
            
            </td>
                 <td><a href="./main.php?option=submissionFiveRemoveUp&id=<?php echo $rowRows['rstug_educn_id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
        </tr>

<?php
}

?> 
        
        
    </table><?php }//end totas?> 
    
    
    
    </td>
    </tr>
    

                
              </table>
    
    
    
    
    
    </td>
    </tr>

                
              </table>
    </div>
                        
                        
                        
                        
<div class="line"></div>
                        
                       
                         <div class="form-group row">
                          <?php /*?><label class="col-sm-2 form-control-label">Contact Person:</label>
                         
                            <input type="text" name="sscientific_contact" id="sscientific_contact" class="form-control  required" value="<?php echo $rstudy['sscientific_contact'];?>"><?php */?>
                            <input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                            <input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
                       
                        </div>
                        <div class="line"></div>
                        
                         <?php /*?> <div class="form-group row">
                          <label class="col-sm-4 form-control-label">Prior Ethical Approval:</label>

                          <input name="prior_ethical_approval" type="radio" value="1" class="required"  onChange="getState(this.value)"/> Yes &nbsp;<input name="prior_ethical_approval" type="radio" value="0" class="required" onChange="getState(this.value)"/> No
  
                          
                          
                        </div>
                        <div id="statediv"></div><?php */?>
                        <div class="line"></div>
                        
                       
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveFive" type="submit"  class="btn btn-primary" value="Save and Next"/>

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