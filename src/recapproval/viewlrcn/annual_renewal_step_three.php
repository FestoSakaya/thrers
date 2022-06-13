<?php
$sessionasrmApplctID=$_SESSION['asrmApplctID'];
//submission_stages
$sqlstudy="SELECT * FROM ".$prefix."renewals where `owner_id`='$sessionasrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];
$protocol_id2=$rstudy['protocol_id'];
//submission_stages
$sqlSub_Stages="SELECT * FROM ".$prefix."annual_stages where `owner_id`='$sessionasrmApplctID' and status='new'  and annual_id='$id' order by id desc limit 0,1";
$QuerySub_stages = $mysqli->query($sqlSub_Stages);
$totalSub_Stages = $QuerySub_stages->num_rows;
$rsSubStages = $QuerySub_stages->fetch_array();


if($_POST['doSaveFirst']=='Save and Next' and $_POST['AdverseEvents'] and $id>1){

	$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
	$AdverseEvents=$mysqli->real_escape_string($_POST['AdverseEvents']);
	$summaryProtocolDeviations=$mysqli->real_escape_string($_POST['summaryProtocolDeviations']);
	$SummarySiteActivities=$mysqli->real_escape_string($_POST['SummarySiteActivities']);
	$Challenges=$mysqli->real_escape_string($_POST['Challenges']);
	$annual_id=$mysqli->real_escape_string($_POST['annual_id']);
	$code=$mysqli->real_escape_string($_POST['code']);
	$ammendType=$mysqli->real_escape_string($_POST['ammendType']);

$sqlUsers="SELECT * FROM ".$prefix."renewals_summary where `owner_id`='$sessionasrmApplctID' and annual_id='$id' order by id desc limit 0,1";
		$QueryUsers = $mysqli->query($sqlUsers);
		$totalUsers = $QueryUsers->num_rows;
		$rUserInv=$QueryUsers->fetch_array();
		$protocID=$rUserInv['protocol_id'];
	
		if(!$totalUsers){
$sqlA2Protocol="insert into ".$prefix."renewals_summary (`protocol_id`,`annual_id`,`owner_id`,`AdverseEvents`,`summaryProtocolDeviations`,`SummarySiteActivities`,`Challenges`,`is_sent`,`updatedon`,`ammendType`,`code`) 

values('$protocol_id','$id','$sessionasrmApplctID','$AdverseEvents','$summaryProtocolDeviations','$SummarySiteActivities','$Challenges','0',now(),'$ammendType','$code')";
$mysqli->query($sqlA2Protocol);
$record_id = $mysqli->insert_id;


for ($i=0; $i < count($_POST['source']); $i++) {
$source=$_POST['source'][$i];
$BriefDescription=$_POST['BriefDescription'][$i];
$Implicationonresearch=$_POST['Implicationonresearch'][$i];

$sqlUsersLit="SELECT * FROM ".$prefix."renewals_literature where `owner_id`='$sessionasrmApplctID' and annual_id='$id' and source='$source' and BriefDescription='$BriefDescription' order by id desc limit 0,1";
$QueryUsersLit = $mysqli->query($sqlUsersLit);

if(!$QueryUsersLit->num_rows){
$Insert_QR2="insert into ".$prefix."renewals_literature (`protocol_id`,`annual_id`,`owner_id`,`source`,`BriefDescription`,`Implicationonresearch`,`updatedon`,`is_sent`,`ammendType`,`code`) values ('$protocol_id','$id','$sessionasrmApplctID','$source','$BriefDescription','$Implicationonresearch',now(),'0','$ammendType','$code')";
$inseted=$mysqli->query($Insert_QR2);
}
}




$message='<p class="success">Dear '.$session_fullname.', details have been submitted, save to continue</p>';
logaction("$session_fullname added created new protocol");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=AnnualRenualFour&id='.$id.'">';

		}
		
if($record_id<=0){
$message='<p class="failed">Dear '.$session_fullname.', details have not been saved. Re-enter and submit again.</p>';	
}

if($totalUsers){
$sqlA2Protocol="update ".$prefix."renewals_summary set `AdverseEvents`='$AdverseEvents',`summaryProtocolDeviations`='$summaryProtocolDeviations',`SummarySiteActivities`='$SummarySiteActivities',`Challenges`='$Challenges' where owner_id='$sessionasrmApplctID' and annual_id='$id' ";
$mysqli->query($sqlA2Protocol);	
}
//Insert into Submission Stages
$wm="select * from ".$prefix."annual_stages where  owner_id='$sessionasrmApplctID' and status='new' and annual_id='$id' ";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();

if($totalStages){
$sqlASubmissionStages="update ".$prefix."annual_stages  set `literature`='1' where `owner_id`='$sessionasrmApplctID' and status='new' and annual_id='$id'";
$mysqli->query($sqlASubmissionStages);
}

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=AnnualRenualFour&id='.$id.'">';






}//end post

if($rstudy['ammendType']=='online'){$link="AnnualRenual";}
if($rstudy['ammendType']=='manual'){$link="AnnualRenualManual";}
?><ul id="countrytabs" class="shadetabs">

<?php if($totalstudy>=1){?><li><a href="./main.php?option=<?php echo $link;?>&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_information']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_information']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenualSecond&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['status_of_participants']==1){?> style="background:green; color:#FFF;" <?php }?>>Status of Participants & Specimens</a></li><?php }?>

<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['status_of_participants']==1){?> style="background:green; color:#FFF;" <?php }?>>Status of Participants & Specimens</li><?php }?>

<li><a href="#" rel="#default" class="selected" <?php if($rsSubStages['literature']==1){?> style="background:green; color:#FFF;" <?php }?>>Literature & Challanges</a></li>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenualFour&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['future_plans']==1){?> style="background:green; color:#FFF;" <?php }?>>Future Plans/Activities</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['future_plans']==1){?> style="background:green; color:#FFF;" <?php }?>>Status of Future Plans/Activities</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenewalPayment&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['payment_proof']==1){?> style="background:green; color:#FFF;" <?php }?>>Attachments</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['payment_proof']==1){?> style="background:green; color:#FFF;" <?php }?>>Attachments</li><?php }?>

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



$sqlstudypp="SELECT * FROM ".$prefix."renewals_summary where `owner_id`='$sessionasrmApplctID' and annual_id='$id' order by id desc limit 0,1";
$Querystudypp = $mysqli->query($sqlstudypp);
$totalstudypp = $Querystudypp->num_rows;
$rstudypp = $Querystudypp->fetch_array();
if(isset($message)){echo $message;}

$sqlUsersLit1="SELECT * FROM ".$prefix."renewals_literature where `owner_id`='$sessionasrmApplctID' and annual_id='$id' order by id desc limit 0,20";
$QueryUsersLit1 = $mysqli->query($sqlUsersLit1);

?>

<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
<div class="form-group row success" style="padding-top:30px;">
         <input type="hidden" name="annual_id" value="<?php echo $rstudy['id'];?>">
         <input type="hidden" name="protocol_id" value="<?php echo $rstudy['protocol_id'];?>">
                          <label class="col-sm-10 form-control-label">Current Literature<span class="error">*</span></label>
                          <div class="col-sm-10">

<label class="col-sm-10 form-control-label">If there have been any new publications in the area of study, including those from your study, provide a brief summary of these stating the implication they might have on continuation of your research.</label> <br /><br />
                         
                         
   <?php
   if(!$QueryUsersLit1->num_rows){
	   ?><table width="80%" border="0" id="POITable" class="htheadersm">
        <tr>
            <th style=" display:none;">&nbsp;</th>
            <th><strong>Source</strong></th>
            <th><strong>Brief description</strong></th>

            <th><strong>Implication on your research</strong></th>

            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <td style=" display:none;">1</td>
            <td>
<input type="text" name="source[]" id="vvv" tabindex="4" class="required" minlength="8" style="border:1px solid #7F9DB9;width:130px;background:url(./images/fmbg.jpg);padding:5px;"/>
            </td>
            <td><input type="text" name="BriefDescription[]" id="customss2" tabindex="5" class="required" minlength="8" style="border:1px solid #7F9DB9;width:130px;background:url(./images/fmbg.jpg);padding:5px;"/></td>
  
          
  
  
           
              <td>
            <input type="text" name="Implicationonresearch[]" id="ddd" tabindex="5" class="required" style="border:1px solid #7F9DB9;width:210px;background:url(./images/fmbg.jpg);padding:5px;"/>
            </td>
           
            <td><input type="button" id="delPOIbutton" value="Delete" onClick="deleteRow(this)" style="display:none; font-size:12px;"/></td>
            <td><input type="button" id="addmorePOIbutton" value="Add Rows" onClick="insRow()" style="font-size:12px;"/></td>
        </tr>
    </table>
    
      <?php
	  }


if($QueryUsersLit1->num_rows){?>


<table width="80%" border="0" id="POITable" class="htheadersm">
        <tr>
            <th style=" display:none;">&nbsp;</th>
            <th><strong>Source</strong></th>
            <th><strong>Brief description</strong></th>

            <th><strong>Implication on your research</strong></th>

            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <tr>
            <td style=" display:none;">1</td>
            <td>
<input type="text" name="source[]" id="vvv" tabindex="4" class="requiredee" minlength="8" style="border:1px solid #7F9DB9;width:130px;background:url(./images/fmbg.jpg);padding:5px;"/>
            </td>
            <td><input type="text" name="BriefDescription[]" id="customss2" tabindex="5" class="requiredee" minlength="8" style="border:1px solid #7F9DB9;width:130px;background:url(./images/fmbg.jpg);padding:5px;"/></td>
  
          
  
  
           
              <td>
            <input type="text" name="Implicationonresearch[]" id="ddd" tabindex="5" class="requiredee" style="border:1px solid #7F9DB9;width:210px;background:url(./images/fmbg.jpg);padding:5px;"/>
            </td>
           
            <td><input type="button" id="delPOIbutton" value="Delete" onClick="deleteRow(this)" style="display:none; font-size:12px;"/></td>
            <td><input type="button" id="addmorePOIbutton" value="Add Rows" onClick="insRow()" style="font-size:12px;"/></td>
        </tr>
    </table>











           <table width="80%" border="0" id="customers2">
        <tr>
            <th><strong>Source</strong></th>
            <th><strong>Brief description</strong></th>

            <th><strong>Implication on your research</strong></th>

        </tr>
     <?php  while($rstudyppLIT = $QueryUsersLit1->fetch_array()){?>
        <tr>
            <td><?php echo $rstudyppLIT['source'];?>
            </td>
            <td><?php echo $rstudyppLIT['BriefDescription'];?></td>
            
              <td><?php echo $rstudyppLIT['Implicationonresearch'];?>
            </td>
        
        </tr> <?php }?>
    </table>
    <?php }?>
    
    
                         
                          </div>
    </div>
                        <div class="line"></div>
                        


<div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Summary of Adverse Events: </label>
                          <div class="col-sm-10">
                          
                          <input name="ammendType" type="hidden" value="<?php echo $rstudy['ammendType'];?>"/>
                          <input name="code" type="hidden" value="<?php echo $rstudy['code'];?>"/>
                          
                          
                          <label class="form-control-label">Provide a summary of numbers of all the adverse events observed and their severity and types (use extra sheet if necessary). </label>
                          <textarea name="AdverseEvents" id="AdverseEvents" cols="" rows="5" class="form-control"><?php echo $rstudypp['AdverseEvents'];?></textarea>
                          </div>
                        </div>
                        <div class="line"></div>
                        
                        
                        <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Summary of Protocol Deviations and Violations: <span class="error">*</span></label>
                          <div class="col-sm-10">
                          <label class="form-control-label">Provide a summary of any protocol deviations or violations during the reporting period</label>
                          <textarea name="summaryProtocolDeviations" id="summaryProtocolDeviations" cols="" rows="5" class="form-control  required"><?php echo $rstudypp['summaryProtocolDeviations'];?></textarea>
                          </div>
                        </div>
                        <div class="line"></div>
                        
                        
                        <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Summary of Site Activities: <span class="error">*</span></label>
                          <div class="col-sm-10">
                          <label class="form-control-label">Give a summary of other relevant activities carried out at the site including training of study staff and facilities upgraded and new changes in management of the study. </label>
                          <textarea name="SummarySiteActivities" id="SummarySiteActivities" cols="" rows="5" class="form-control  required"><?php echo $rstudypp['SummarySiteActivities'];?></textarea>
                          </div>
                        </div>
                        <div class="line"></div>
                        
                        
                        <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Challenges: <span class="error">*</span></label>
                          <div class="col-sm-10">
                          <label class="form-control-label">Briefly state any challenges encountered during the reporting period, and steps taken to address them.  </label>
                          <textarea name="Challenges" id="Challenges" cols="" rows="5" class="form-control  required"><?php echo $rstudypp['Challenges'];?></textarea>
                          </div>
                        </div>
                        <div class="line"></div>
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveFirst" type="submit"  class="btn btn-primary" value="Save and Next"/>

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