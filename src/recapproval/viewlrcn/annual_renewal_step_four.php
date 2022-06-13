<?php
$sessionasrmApplctID=$_SESSION['asrmApplctID'];
$sqlstudy="SELECT * FROM ".$prefix."renewals where `owner_id`='$sessionasrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];
$protocol_id2=$rstudy['protocol_id'];
//submission_stages
$sqlSub_Stages="SELECT * FROM ".$prefix."annual_stages where `owner_id`='$sessionasrmApplctID' and status='new' and annual_id='$id' order by id desc limit 0,1";
$QuerySub_stages = $mysqli->query($sqlSub_Stages);
$totalSub_Stages = $QuerySub_stages->num_rows;
$rsSubStages = $QuerySub_stages->fetch_array();


if($_POST['doSaveFirst']=='Save' and $_POST['FuturePlans'] and $id>1){


	$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
$FuturePlans=$mysqli->real_escape_string($_POST['FuturePlans']);
	$annual_id=$mysqli->real_escape_string($_POST['annual_id']);
	$code=$mysqli->real_escape_string($_POST['code']);

$sqlUsers="SELECT * FROM ".$prefix."renewals_summary where `owner_id`='$sessionasrmApplctID' and annual_id='$id' order by id desc limit 0,1";
		$QueryUsers = $mysqli->query($sqlUsers);
		$totalUsers = $QueryUsers->num_rows;
		$rUserInv=$QueryUsers->fetch_array();
		$protocID=$rUserInv['protocol_id'];
	
		if($totalUsers){
$sqlA2Protocol="update ".$prefix."renewals_summary  set `FuturePlans`='$FuturePlans' where `owner_id`='$sessionasrmApplctID' and annual_id='$id'";
$mysqli->query($sqlA2Protocol);

//Insert into Submission Stages
$wm="select * from ".$prefix."annual_stages where  owner_id='$sessionasrmApplctID' and status='new' and annual_id='$id'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();

if($totalStages){
$sqlASubmissionStages="update ".$prefix."annual_stages  set `future_plans`='1' where `owner_id`='$sessionasrmApplctID' and status='new' and annual_id='$id'";
$mysqli->query($sqlASubmissionStages);
}



$message='<p class="success">Dear '.$session_fullname.', details have been submitted, save to continue</p>';
logaction("$session_fullname added created new protocol");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=AnnualRenewalPayment&id='.$id.'">';


		}
		



}//end post


$sqlstudypp="SELECT * FROM ".$prefix."renewals_summary where `owner_id`='$sessionasrmApplctID' and annual_id='$id' order by id desc limit 0,1";
$Querystudypp = $mysqli->query($sqlstudypp);
$totalstudypp = $Querystudypp->num_rows;
$rstudypp = $Querystudypp->fetch_array();

if($rstudypp['ammendType']=='online'){$link="AnnualRenual";}
if($rstudypp['ammendType']=='manual'){$link="AnnualRenualManual";}

?><ul id="countrytabs" class="shadetabs">


<?php if($totalstudy>=1){?><li><a href="./main.php?option=<?php echo $link;?>&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_information']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_information']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenualSecond&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['status_of_participants']==1){?> style="background:green; color:#FFF;" <?php }?>>Status of Participants & Specimens</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['status_of_participants']==1){?> style="background:green; color:#FFF;" <?php }?>>Status of Participants & Specimens</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenualThird&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['literature']==1){?> style="background:green; color:#FFF;" <?php }?>>Literature & Challanges</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['literature']==1){?> style="background:green; color:#FFF;" <?php }?>>Literature & Challanges</li><?php }?>

<li><a href="#" rel="#default" class="selected" <?php if($rsSubStages['future_plans']==1){?> style="background:green; color:#FFF;" <?php }?>>Future Plans/Activities</a></li>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenewalPayment&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['payment_proof']==1){?> style="background:green; color:#FFF;" <?php }?>>Payment</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['payment_proof']==1){?> style="background:green; color:#FFF;" <?php }?>>Payment</li><?php }?>

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
if(isset($message)){echo $message;}
?>

<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
<div class="form-group row" style="padding-top:30px;">
                        
                        <!--  <label class="col-sm-2 form-control-label">Future Plans/Activities<span class="error">*</span></label>!-->
                          <div class="col-sm-10">
                        <label class="form-control-label">What activities are planned during the coming year? Continued collection of data? Analysis of data? Completion of the protocol? Submission of a modification to the current protocol to expand on results? Any proposed modifications should be mentioned, but the request to modify the protocol should be submitted separately to the NARC secretariat. </label><br /><br />
    <input type="hidden" name="annual_id" value="<?php echo $rstudy['id'];?>">  
    
    <input name="ammendType" type="hidden" value="<?php echo $rstudy['ammendType'];?>"/>
                          <input name="code" type="hidden" value="<?php echo $rstudy['code'];?>"/>                  
                        
  <textarea name="FuturePlans" id="AdverseEvents" cols="" rows="5" class="form-control  required"><?php echo $rstudypp['FuturePlans'];?></textarea>
                   
                          </div>
    </div>
                        <div class="line"></div>
   
                        <div class="form-group row">
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