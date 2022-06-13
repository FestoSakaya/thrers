<?php
if(!$id){
	
echo '<meta http-equiv="REFRESH" content="1;url='.$base_url.'/main.php?option=dashboard">';
}
$sqlstudy="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];

//submission_stages
$sqlSub_Stages="SELECT * FROM ".$prefix."submission_stages where `owner_id`='$asrmApplctID' and protocol_id='$id' and status='new' order by id desc limit 0,1";
$QuerySub_stages = $mysqli->query($sqlSub_Stages);
$totalSub_Stages = $QuerySub_stages->num_rows;
$rsSubStages = $QuerySub_stages->fetch_array();
?>
<?php include("viewlrcn/final_button.php");?>
<ul id="countrytabs" class="shadetabs">
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submission&id=<?php echo $id;?>" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</li><?php }?>

<li><a href="#" rel="#default" class="selected" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</a></li>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionThird&id=<?php echo $id;?>" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=StudyPopulation&id=<?php echo $id;?>" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</li><?php }?>

<?php if($rstudy['is_clinical_trial']==1){?>
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFour&id=<?php echo $id;?>" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</li><?php }}?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionBudget&id=<?php echo $id;?>" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSchedule&id=<?php echo $id;?>" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</li><?php }?>

<?php /*?><?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFive/<?php echo $rstudy['id'];?>/"<?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra"<?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</li><?php }?><?php */?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSix&id=<?php echo $id;?>" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFinish&id=<?php echo $id;?>" <?php if($rsSubStages['payments']==1){?> style="background:green; color:#FFF;" <?php }?>>Payments</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['payments']==1){?> style="background:green; color:#FFF;" <?php }?>>Payments</li><?php }?>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
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
                     
           <?php include("viewlrcn/status_log.php");?>

                    </div>
                  </div>
                </div>
              </div>

<?php
if($_POST['doSaveSecond']=='Save and Next' and $_POST['abstract'] and $_POST['justification'] and $_POST['asrmApplctID'] and $protocol_id){

	$abstract=$mysqli->real_escape_string($_POST['abstract']);
	$keywords=$mysqli->real_escape_string($_POST['keywords']);
	$introduction=$mysqli->real_escape_string($_POST['introduction']);
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$justification=$mysqli->real_escape_string($_POST['justification']);
	$goals=$mysqli->real_escape_string($_POST['goals']);
	$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
	
	$objective_1=$mysqli->real_escape_string($_POST['objective_1']);
	$objective_2=$mysqli->real_escape_string($_POST['objective_2']);
	/*$objective_3=$mysqli->real_escape_string($_POST['objective_3']);
	$objective_4=$mysqli->real_escape_string($_POST['objective_4']);
	$objective_5=$mysqli->real_escape_string($_POST['objective_5']);*/
	
	
	for ($i=0; $i < count($_POST['objectives']); $i++) {
$institutioncode=$mysqli->real_escape_string($_POST['objectives'][$i]);
$institutioncode2.=$mysqli->real_escape_string($_POST['objectives'][$i]);
$objectivetype=$mysqli->real_escape_string($_POST['objectivetype'][$i]);


$wmObjectives="select * from ".$prefix."other_objectives where  owner_id='$sasrmApplctID' and protocol_id='$submission_id' and objective='$institutioncode'";
$cmdwbObjectives = $mysqli->query($wmObjectives);
$totalObjectives = $cmdwbObjectives->num_rows;

if(strlen($institutioncode)>=5 and !$totalObjectives){
	
$Insert_QR2="insert into ".$prefix."other_objectives (`owner_id`,`protocol_id`,`objective`,`created`,`objectivetype`) values ('$sasrmApplctID','$submission_id','$institutioncode',now(),'$objectivetype')";
$inseted=$mysqli->query($Insert_QR2);
}
	}

$sqlstudymab="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudymab = $mysqli->query($sqlstudymab);
$rstudymab = $Querystudymab->fetch_array();

$sqlstudyREC="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$QuerystudyREC = $mysqli->query($sqlstudyREC);
$rstudyREC = $QuerystudyREC->fetch_array();
$recAffiliated_id=$rstudyREC['recAffiliated_id'];
////Get REC ID
$sqlstudyREC2="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$QuerystudyREC2 = $mysqli->query($sqlstudyREC2);
$rstudyREC2 = $QuerystudyREC2->fetch_array();
$accroname=$rstudyREC2['accroname'];

if($rstudyREC2['recNo']==0){$protocol_idwe=1;}
if($rstudyREC2['recNo']){$protocol_idwe=($rstudyREC2['recNo']+1);}
$owner_id=$rstudymab['owner_id'];

$code="$accroname-$year-$protocol_idwe";
$protocol_idwemm=$rstudymab['protocol_id'];
////update


$sqlprotocalSubSel="SELECT * FROM ".$prefix."protocol where id='$protocol_idwemm' and owner_id='$sasrmApplctID'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();
//If no Reference no was assigned, assign new
if(!$rprotocalSub2Sel['code']){
$sqlUpdateProtocl="update ".$prefix."protocol set code='$code' where id='$protocol_idwemm' and owner_id='$sasrmApplctID'";
$mysqli->query($sqlUpdateProtocl);

$sqlstudyREC23="update ".$prefix."list_rec_affiliated set recNo='$protocol_idwe' where id='$recAffiliated_id'";
$mysqli->query($sqlstudyREC23);
}

$sqlA2Protocol="update ".$prefix."submission  set `abstract`='$abstract',`keywords`='$keywords',`introduction`='$introduction',`justification`='$justification',`goals`='$goals' where id='$submission_id' and owner_id='$sasrmApplctID'";
$mysqli->query($sqlA2Protocol);


//Insert into Submission Stages
$wm="select * from ".$prefix."submission_stages where  owner_id='$sasrmApplctID' and protocol_id='$submission_id' and status='new'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();
if($totalStages){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `protocol_details`='1' where `owner_id`='$sasrmApplctID' and `protocol_id`='$submission_id'";
$mysqli->query($sqlASubmissionStages);
}


$sqlA2Team="update ".$prefix."team  set `protocol_id`='$protocol_idwemm' where `owner_id`='$asrmApplctID' and status='pending'";
$mysqli->query($sqlA2Team);

$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname updated protocol");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="1;url='.$base_url.'/main.php?option=submissionThird&id='.$protocol_id.'">';

}//end post 


if($category=='submissionSecondDel' and $id){

	$sqlA2Protocol2="delete from ".$prefix."team where owner_id='$asrmApplctID' and protocol_id='$protocol_id' and id='$id'";
	$mysqli->query($sqlA2Protocol2);
	}
	
if(isset($message)){echo $message;}
?>
   <div style="clear:both;"></div>
<form action="" method="post" name="regForm" id="regForm">
                   
                        <div class="form-group row success">
                          <label class="col-sm-2 form-control-label">Protocol Summary: <span class="error">*</span></label>
                          
 <textarea name="abstract" id="MyTextBox" cols="" rows="5" class="form-control  required"><?php echo $rstudy['abstract'];?></textarea>
 
  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>  
                          
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-2 form-control-label">Keywords: <span class="error">*</span></label>
                         
                            <input type="text" name="keywords" id="MyTextBoxss2" class="form-control  required" value="<?php echo $rstudy['keywords'];?>">
                            
                            <input name="protocol_id" type="hidden" value="<?php echo $protocol_id;?>"/>
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                            <input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
                       
                        </div>
                        <div class="line"></div>
                        
                          <div class="form-group row success">
                          <label class="col-sm-2 form-control-label">Introduction: <span class="error">*</span></label>
                          <textarea name="introduction" id="MyTextBox3" cols="" rows="5" class="form-control  required"><?php echo $rstudy['introduction'];?></textarea>
                            <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p> 
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-2 form-control-label">Justification: <span class="error">*</span></label>
                          <textarea name="justification" id="MyTextBox4" cols="" rows="5" class="form-control  required"><?php echo $rstudy['justification'];?></textarea>
                            <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p> 
                        </div>
                        <div class="line"></div>
                        
    <?php /*?>         
             <div class="form-group row success">
        <label class="col-sm-4 form-control-label">Objectives 1: <span class="error">*</span></label>
        <input type="text" name="objective_1" id="objective_1" class="form-control  required" value="<?php echo $rstudy['objective_1'];?>">
       
                        </div>
                        <div class="line"></div><?php */?>
                        
                        

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


     var inp1 = new_row.cells[2].getElementsByTagName('input')[0];
    inp1.id += len;
    inp1.value = '';
	
  new_row.cells[2].getElementsByTagName('input')[0].removeAttribute('style');
    x.appendChild( new_row );
}
</script>
  <?php
  $did=$mysqli->real_escape_string($_GET['did']);
  if($_GET['comobje']=='del'){
$qRDel="delete from ".$prefix."other_objectives where owner_id='$asrmApplctID' and protocol_id='$protocol_id' and id='$did'";
$mysqli->query($qRDel);
}

$qRPersoneld="select * from ".$prefix."other_objectives  where owner_id='$asrmApplctID' and protocol_id='$protocol_id' order by objectivetype asc";
$RPersoneld=$mysqli->query($qRPersoneld);
?>                     

<table width="100%" border="0" id="POITable" class="success">
        <tr>
            <th width="3%" style=" display:none;">&nbsp;</th>
            <th width="74%"><strong>Objectives (one objective per row)<span class="error3">*</span></strong></th>
<th width="5%">&nbsp;</th>
            <th width="12%">&nbsp;</th>
            <th width="11%">&nbsp;</th>
        </tr>
        <tr>
            <td width="3%" style="display:none;">1</td>
  
              <td align="left">
              
<?php if(!$RPersoneld->num_rows){?>
<input type="text" name="objectives[]" id="objectives" tabindex="5"  class="form-control required" minlength="8" style="
    width:700px!important;
    padding: .5rem .75rem;
    font-size: 0.9rem;
    line-height: 1.25;
    color: #464a4c;
    background-color: #fff; float:left;" value=""/>
    <?php }?>
    
    
<?php if($RPersoneld->num_rows){?>
<input type="text" name="objectives[]" id="objectives" tabindex="5"  class="form-control" minlength="8" style="
    width:700px!important;
    padding: .5rem .75rem;
    font-size: 0.9rem;
    line-height: 1.25;
    color: #464a4c;
    background-color: #fff; float:left;" value=""/>
    <?php }?>
            </td>
           
           <td>  <input name="onhh[]" type="hidden" />
           <select name="objectivetype[]" id="objectivetype" class="form-control required" style="width:200px;">
      
           <option value="Main Objective">Main Objective</option>
           <option value="Specific Objective">Specific Objective</option>
           </select>
           
           </td>
           
            <td><input type="button" id="delPOIbutton" value="Delete" onClick="deleteRow(this)" style="display:none; font-size:12px;"/></td>
            <td><input type="button" id="addmorePOIbutton" value="Add an objective" onClick="insRow()" style="font-size:12px;"/></td>
        </tr>
        </table>
        
   </table>        
        

<div class="form-group row success">
  
  
<?php
if($RPersoneld->num_rows){?>  
 
<h5>Main Objective</h5>
  
   <?php
  $count1=0;
$qRPersoneld="select * from ".$prefix."other_objectives  where owner_id='$owner_id' and protocol_id='$protocol_id' and objectivetype='Main Objective' order by objectivetype asc";
$RPersoneld=$mysqli->query($qRPersoneld);
while ($rowRows = $RPersoneld->fetch_array())
{ $count1++;
///Display data for education history
	?> 
    
<label class="form-control-label">
<?php echo $count1.'. '.$rowRows['objective'];?> <a href="main.php?option=submissionSecond&id=<?php echo $id;?>&did=<?php echo $rowRows['id'];?>&comobje=del" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></label><br />
<?php
}
?> 
<hr />
<h5>Specific Objectives</h5>
  
  <?php
   $count2=0;
$qRPersoneld4="select * from ".$prefix."other_objectives  where owner_id='$owner_id' and protocol_id='$protocol_id' and objectivetype='Specific Objective' order by objectivetype asc";
$RPersoneld4=$mysqli->query($qRPersoneld4);
while ($rowRows4 = $RPersoneld4->fetch_array())
{ $count2++;
///Display data for education history
	?> 
    
<label class="form-control-label">
<?php echo $count2.'. '.$rowRows4['objective'];?> <a href="main.php?option=submissionSecond&id=<?php echo $id;?>&did=<?php echo $rowRows4['id'];?>&comobje=del" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></label><br />
<?php
}

?>    
  
  
  
 <?php }//end totas?> 

</div>      
                        
                 
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveSecond" type="submit"  class="btn btn-primary" value="Save and Next"/>

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