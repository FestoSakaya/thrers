<div class="card-header d-flex align-items-center">
<h3 class="h4">General Statistics </h3>
</div>

<?php if($session_privillage=='administrator'){include("viewlrcn/dashboard_admin_top.php");}?>

<div class="number allprotocols">        
         <a href="exportallsubmissions.php">EXPORT SUBMISSIONS</a></div>

<div class="col-mm12 halfgraph2">
<h4>Submissions by REC</h4> 

<?php
//////////////Medical and Health Sciences/////////////////////////////////////////////
$sqlstg="SELECT * FROM ".$prefix."list_rec_affiliated where published='Yes' order by name asc";
$resultm = $mysqli->query($sqlstg);?>
 <table width="100%" class="table table-striped table-sm" id="customers">
                        <thead>
                          <tr>
                            <th width="41%">Name</th>
                            <th width="11%">All Protocols</th>
                            <th width="14%">Pending Submission</th>
                            <th width="10%">Newly Submitted</th>
                            <th width="15%">Completeness</th>
                            <th width="15%">Scheduled for Review</th>
                            <th width="9%">Rejected (Others)</th>
                            <th width="9%">Approved</th>
                          </tr>
                        </thead>
                        <tbody><?php 
while($rProjects=$resultm->fetch_array()){
$country_id=$rProjects['country_id'];
$recAffiliated_id=$rProjects['id'];
$sqlSRR_tr1 = "select * from ".$prefix."submission where recAffiliated_id='$recAffiliated_id' order by id desc";
$resultSSS_tr1 = $mysqli->query($sqlSRR_tr1);
$total_tr1 = $resultSSS_tr1->num_rows;

///Pending Final submission
$sqlSRR_tr2 = "select * from ".$prefix."submission where recAffiliated_id='$recAffiliated_id' and is_sent='0' order by id desc";
$resultSSS_tr2 = $mysqli->query($sqlSRR_tr2);
$total_tr2 = $resultSSS_tr2->num_rows;

//submitted
$sqlSRR_tr3 = "select * from ".$prefix."submission where recAffiliated_id='$recAffiliated_id' and status='Waiting for Committee' and is_sent='1' order by id desc";
$resultSSS_tr3 = $mysqli->query($sqlSRR_tr3);
$total_tr3 = $resultSSS_tr3->num_rows;
////////////Scheduled for Review
$sqlSRR_tr4 = "select * from ".$prefix."submission where recAffiliated_id='$recAffiliated_id' and status='Scheduled for Review' and is_sent='1' order by id desc";
$resultSSS_tr4 = $mysqli->query($sqlSRR_tr4);
$total_tr4 = $resultSSS_tr4->num_rows;
///Approved
$sqlSRR_tr5 = "select * from ".$prefix."submission where recAffiliated_id='$recAffiliated_id' and status='Approved' and is_sent='1' order by id desc";
$resultSSS_tr5 = $mysqli->query($sqlSRR_tr5);
$total_tr5 = $resultSSS_tr5->num_rows;

$sqlSRR_check = "select * from ".$prefix."submission where recAffiliated_id='$recAffiliated_id' and status='completeness check' and is_sent='1' order by id desc";
$resultSSS_check = $mysqli->query($sqlSRR_check);
$total_check = $resultSSS_check->num_rows;

///
$sqlSRR_Rejected = "select * from ".$prefix."submission where recAffiliated_id='$recAffiliated_id' and (status='Rejected' || status='Resubmit | Needs Major Revisions' || status='Request for Responses' || status='Conditional Approval | Needs Minor Revisions' || status='Invitation to a VIVA')  and is_sent='1' order by id desc";
$resultSSS_Rejected = $mysqli->query($sqlSRR_Rejected);
$total_Rejected = $resultSSS_Rejected->num_rows;

?> 
  <tr>
                            <td><?php echo $rProjects['name'];?></td>
                            <td align="center"><a href="./main.php?option=submissionDeletem&id=<?php echo $recAffiliated_id;?>"  onclick="return confirm('You are Navigating away from STATISTICS page to a page where you will DELETE Protocols from. Are you sure you want to proceed?');"><?php echo $total_tr1;?></a></td>
                            <td style="background:#F00; color:#FFF;" align="center"><?php echo $total_tr2;?></td>
                            <td align="center"><?php echo $total_tr3;?></td>
                            <td align="center"><?php echo $total_check;?></td>
                            <td align="center"><?php echo $total_tr4;?></td>
                            <td  style="background:#F00; color:#FFF;" align="center"><?php echo $total_Rejected;?></td>
                            <td align="center"><?php echo $total_tr5;?></td>
                         
                          </tr>
   <?php 
   
   $all_total_tr1=($total_tr1+$all_total_tr1);
    $all_total_tr2=($total_tr2+$all_total_tr2);
	$all_total_tr3=($total_tr3+$all_total_tr3);
	$all_total_tr4=($total_tr4+$all_total_tr4);
	
	$all_total_check=($total_check+$all_total_check);
	$all_total_Rejected=($total_Rejected+$all_total_Rejected);
	$all_total_tr5=($total_tr5+$all_total_tr5);
   
   
   }///////////end function ?> 
   
   
   
     <tr>
                            <td><strong>TOTAL</strong></td>
                            <td align="center"><strong><?php echo $all_total_tr1;?></strong></td>
                            <td style="background:#F00; color:#FFF;" align="center"><strong><?php echo $all_total_tr2;?></strong></td>
                            <td align="center"><strong><?php echo $all_total_tr3;?></strong></td>
                            <td align="center"><strong><?php echo $all_total_check;?></strong></td>
                            <td align="center"><strong><?php echo $all_total_tr4;?></strong></td>
                            <td  style="background:#F00; color:#FFF;" align="center"><strong><?php echo $all_total_Rejected;?></strong></td>
                            <td align="center"><strong><?php echo $all_total_tr5;?></strong></td>
                         
                          </tr>                
                        </tbody>
                      </table>



</div>
<div style="clear:both;"></div>

