<form action="" method="post" name="regForm" id="regForm" autocomplte="off">
<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="70%"><span class="label label-sec2">Find protocol (Search by protocol ID or RefNo):</span><br />
    <input type="text" class="form-control" name="searchprotocol" value="<?php echo $_POST['searchprotocol'];?>" style="border:2px ssolid #09F!important; padding:10px!important;"></td>
   
   <td width="7%"><br /><input type="submit" name="doSearch" id="button" class="search btn" value="Search" /></td>
  </tr>
</table>
</form>
<?php
$searchprotocol=$_POST['searchprotocol'];

	?>
                    <div class="card-body">
               <table width="100%" class="table table-striped table-sm"  id="customers">
               <?php
			   if($_POST['searchprotocol']){?>
                        <thead>
                          <tr>
                          <th width="10%">#ID</th>
                            <th width="10%">#REfNo</th>
                            <th width="50%">Protocol Title</th>
                            <th width="18%">PI</th>
                            <th width="12%">Allow Re-submit</th>
                            <th width="10%">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
						
						//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission where (id like '%$searchprotocol%' OR code like '%$searchprotocol%') order by id desc LIMIT 0,5";//and conceptm_status='new'

$result = $mysqli->query($sql);

$rProjects=$result->fetch_array();
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
while($sqUserddRREC2 = $resultSSSREC2->fetch_array()){
	?>
                          <tr>
 <td scope="row"><?php echo $sqprotocol['id'];?> </td>
<td scope="row"><?php echo $sqprotocol['code'];?> </td>
<td><h3 class="h4"><?php echo $rProjects['public_title'];?></h3><small><?php echo $sqUserdd['name'];?> - <?php echo $sqUserdd['institution'];?></small></td>
<td><?php echo $sqUserdd['name'];?></td>
<td>
<a href="./main.php?option=AllowResubmitProtocol&id=<?php echo $rProjects['id'];?>&action=resubmit"><span class="label label-secwarning" onclick="return confirm('Are you sure you want to proceed?');">Allow Re-submit</span></a>
</td>
<td><a href="./main.php?option=viewsubmission&id=<?php echo $rProjects['id'];?>" style="color:#039; font-weight:bold;" target="_blank">+ View Details</a>
                                                    
                            </td>
                          </tr>
             <?php }?><?php } // end search?>
             
             <?php 
	
			 if($_GET['action']=='resubmit' and $id){
				 
$sqlprotocolResubmit = "select * from ".$prefix."submission_stages where protocol_id='$id'";
$resultprotocolResubmit = $mysqli->query($sqlprotocolResubmit);
$sqprotocolResubmit = $resultprotocolResubmit->fetch_array();

$totalStudyApproval = $resultprotocolResubmit->num_rows;
if($totalStudyApproval){
	$stage_id=$sqprotocolResubmit['id'];			 
//Update
$sqlprotocolResubmit_update = "update ".$prefix."submission_stages set status='new' where id='$stage_id' and protocol_id='$id'";
$mysqli->query($sqlprotocolResubmit_update);				 
				 
				 ?>
                               <tr>
<td colspan="5"><span class="label label-sec4"> Action has been completed successfully. Thank You</span>
                            </td>
                          </tr>
             <?php  }else{?>
              <tr>
<td colspan="5"><span class="label label-sec4"> Record not found, try again</span>
                            </td>
                          </tr>
             
             <?php }
			 
			 } // End If
			 ?>  
             
             
             
             
                        </tbody>
                      </table>
        </div>




