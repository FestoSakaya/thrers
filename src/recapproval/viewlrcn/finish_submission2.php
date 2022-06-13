<?php
//doSaveFive

if($_POST['doFinalSave'] and $id and $_FILES['attachpayment']['name']){

$asrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
$type_of_payment=$mysqli->real_escape_string($_POST['type_of_payment']);
$submission_id=$mysqli->real_escape_string($_POST['submission_id']);

$sqlprotocalSubSel="SELECT * FROM ".$prefix."protocol where id='$submission_id'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();
$ProtoclRefNo=$rprotocalSub2Sel['code'];
//protocls
$sqlsProtocol="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$submission_id'";
$QuerystudyProtocol = $mysqli->query($sqlsProtocol);
$rstudyProtocol = $QuerystudyProtocol->fetch_array();
$public_title=$rstudyProtocol['public_title'];

$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

$contacts=$recNamew['contacts'];
$recOriginalNamem=$recNamew['name'];
//PI Name
$sqlMyUser="SELECT * FROM ".$prefix."user where asrmApplctID='$asrmApplctID'";
$sqlFUser=$mysqli->query($sqlMyUser);
$recUser=$sqlFUser->fetch_array();
$name=$recUser['name'];
$email=$recUser['email'];
///Get Reference Number
if($_FILES['attachpayment']['name']){
$attachpayment = preg_replace('/\s+/', '_', $_FILES['attachpayment']['name']);
$attachpayment2 = $asrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachpayment']['name']));
$targetw1 = "files/uploads/". basename($asrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachpayment']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachpayment']['tmp_name']), $targetw1);
/////update slip
$sqlA2Protocol="update ".$prefix."submission  set `paymentStatus`='Not Confirmed',`paymentProof`='$attachpayment2', `type_of_payment`='$type_of_payment' where id='$submission_id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol);


$wm="select * from ".$prefix."submission_stages where  owner_id='$asrmApplctID' and protocol_id='$submission_id' and status='new'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();
if($totalStages){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `payments`='1' where `owner_id`='$asrmApplctID' and `protocol_id`='$submission_id'";
$mysqli->query($sqlASubmissionStages);
}



}
if(!$_FILES['attachethicalapproval']['name']){
$sqlA2Protocol="update ".$prefix."submission  set `paymentStatus`='Not Paid' where id='$submission_id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol);
}


}//end post

$sqlstudy="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and is_sent='0' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();

$submission_id=$rstudy['protocol_id'];
$protocol_id=$rstudy['protocol_id'];
//submission_stages
$sqlSub_Stages="SELECT * FROM ".$prefix."submission_stages where `owner_id`='$asrmApplctID' and protocol_id='$protocol_id' and status='new' order by id desc limit 0,1";
$QuerySub_stages = $mysqli->query($sqlSub_Stages);
$totalSub_Stages = $QuerySub_stages->num_rows;
$rsSubStages = $QuerySub_stages->fetch_array();
?>


<?php 


$wmPopulation="select * from ".$prefix."study_population where  owner_id='$asrmApplctID' and protocol_id='$submission_id' and status='new'";
$cmdwbPopulation = $mysqli->query($wmPopulation);
$totalStagesPopulation = $cmdwbPopulation->num_rows;
?>


<?php include("viewlrcn/final_button.php");?>

<ul id="countrytabs" class="shadetabs">
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submission" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSecond&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionThird&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=StudyPopulation&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</li><?php }?>

<?php if($rstudy['is_clinical_trial']==1){?>
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFour&id=<?php echo $rstudy['id'];?>"  <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</li><?php }}?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionBudget&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSchedule&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</li><?php }?>

<?php /*?><?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFive/<?php echo $rstudy['id'];?>/" <?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</li><?php }?><?php */?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSix&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</li><?php }?>

<li><a href="#" rel="#default" class="selected" <?php if($rsSubStages['payments']==1){?> style="background:green; color:#FFF;" <?php }?>>Payments</a></li>



</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and is_sent='0' and protocol_id='$submission_id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$recAffiliated_id=$rstudym['recAffiliated_id'];

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();

if($category=='submissionFinishDel' and $id){

$sqlA2Protocol2="update ".$prefix."submission set `paymentProof`='', `type_of_payment`='' where id='$submission_id' and owner_id='$asrmApplctID'";
	$mysqli->query($sqlA2Protocol2);
	}
	
	///generate invoice
	
if($category=='GenerateInvoice'){
	
$sqlstudyAny="SELECT * FROM ".$prefix."user where `asrmApplctID`='$asrmApplctID'";
$QuerystudyAny = $mysqli->query($sqlstudyAny);
$totalstudyAny = $QuerystudyAny->num_rows;
$rstudyAny = $QuerystudyAny->fetch_array();
$file=$rstudyAny['invoiceName'];
//check whether we dont have an invoice already
$sqlRECName="SELECT * FROM ".$prefix."list_rec_affiliated where `id`='$recAffiliated_id'";
$QueryRECName = $mysqli->query($sqlRECName);
$rstudyRECName = $QueryRECName->fetch_array();

/////////////////////Get protocols
$sqlprotocolName="SELECT * FROM ".$prefix."protocol where id='$submission_id' and `owner_id`='$asrmApplctID'";
$QprotocalName = $mysqli->query($sqlprotocolName);
$rprotocalQprotocalName = $QprotocalName->fetch_array();
$ProtoclReference=$rprotocalQprotocalName['code'];

$company = $rstudyAny["name"];
$address = $rstudyAny["institution"];
$email = $rstudyAny["email"];
$telephone = $rstudyAny["phone"];
$number = "CRIMS/00".$rstudym['protocol_id'];//Invoice Number

$rstudym['protocol_id'];

$item = "REC approval fees for the ".$rstudym["public_title"]." Ref Number: $ProtoclReference";
$price = $rstudyRECName['payAmount'];
$currency = $rstudyRECName['currency'];
$vat = 0;
$nda = $rstudyRECName['name'];
$bank = $rstudyRECName['bankName'].','.$rstudyRECName['BranchName'];
$iban = "IBN001";
$paypal = "UG";
$com = $rstudyAny["com"];
$pay = 'Payment Information';
$price = str_replace(",",".",$price);
$vat = str_replace(",",".",$vat);
$p = explode(" ",$price);
$v = explode(" ",$vat);
$re = $p[0] + $v[0];
function r($r)
{
$r = str_replace("$currency","",$r);
$r = str_replace(" ","",$r);
$r = $r." $currency";
return $r;
}
$price = r($price);
$vat = r($vat);

require('./pdf/pdf/fpdf.php');
class PDF extends FPDF
{
function Header()
{
/*if(!empty($_FILES["file"]))
  {
$uploaddir = "images/logo2.png";
$nm = $_FILES["file"]["name"];
$random = rand(1,99);
move_uploaded_file($_FILES["file"]["tmp_name"], $uploaddir.$random.$nm);
$this->Image($uploaddir.$random.$nm,10,10,20);
unlink($uploaddir.$random.$nm);
}*/
$this->SetFont('Arial','B',12);
$this->Ln(1);
}
function Footer()
{
$this->SetY(-15);
$this->SetFont('Arial','I',8);
$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
function ChapterTitle($num, $label)
{
$this->SetFont('Arial','',12);
$this->SetFillColor(200,220,255);
$this->Cell(0,6,"$num $label",0,1,'L',true);
$this->Ln(0);
}
function ChapterTitle2($num, $label)
{
$this->SetFont('Arial','',12);
$this->SetFillColor(249,249,249);
$this->Cell(0,6,"$num $label",0,1,'L',true);
$this->Ln(0);
}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->SetTextColor(32);
$pdf->Cell(0,5,$company,0,1,'R');
$pdf->Cell(0,5,$address,0,1,'R');
$pdf->Cell(0,5,$email,0,1,'R');
$pdf->Cell(0,5,'Tel: '.$telephone,0,1,'R');
$pdf->Cell(0,30,'',0,1,'R');
$pdf->SetFillColor(200,220,255);
$pdf->ChapterTitle('Invoice Number ',$number);
$pdf->ChapterTitle('Invoice Date ',date('d-m-Y'));
$pdf->Cell(0,20,'',0,1,'R');
$pdf->SetFillColor(224,235,255);
$pdf->SetDrawColor(192,192,192);
$pdf->Cell(170,7,'Description',1,0,'L');
$pdf->Cell(40,7,'Amount',1,1,'C');
$pdf->Cell(170,7,$item,1,0,'L',0);
$pdf->Cell(40,7,$price,1,1,'C',0);
$pdf->Cell(0,0,'',0,1,'R');
//$pdf->Cell(170,7,'VAT',1,0,'R',0);
//$pdf->Cell(20,7,$vat,1,1,'C',0);
$pdf->Cell(170,7,'Total',1,0,'R',0);
$pdf->Cell(40,7,$re." $",1,0,'C',0);
$pdf->Cell(0,20,'',0,1,'R');
$pdf->Cell(0,5,$pay,0,1,'L');
$pdf->Cell(0,5,$nda,0,1,'L');
$pdf->Cell(0,5,$bank,0,1,'L');
$pdf->Cell(0,5,$iban,0,1,'L');
$pdf->Cell(0,20,'',0,1,'R');
//$pdf->Cell(0,5,'PayPal:',0,1,'L');
//$pdf->Cell(0,5,$paypal,0,1,'L');
//$pdf->Cell(190,40,$com,0,0,'C');
$filename="invoices/".$asrmApplctID.'_'.date('Ymdh').'_'.$rstudym['protocol_id']."invoice.pdf";
$filerealname=$asrmApplctID.'_'.date('Ymdh').'_'.$rstudym['protocol_id']."invoice.pdf";
$pdf->Output($filename,'F'); //Save invoice on file

$sqlstudyUpdate="update ".$prefix."submission set invoiceName='$filerealname' where `id`='$protocol_id' and `owner_id`='$asrmApplctID' and is_sent='0'";
$mysqli->query($sqlstudyUpdate);
}
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

<!--<h3>Status</h3>-->


 <table class="table table-striped table-sm">
<tr>
<td> </td>
<td> </td>
<td> </td>
<td> </td>
 </tr>

</table>
     
  <div style="clear:both;"></div>    
   <!-- Trigger/Open The Modal -->
<form action="" name="regForm" id="regForm" method="post" enctype="multipart/form-data">
<table width="100%" border="0" class="success">
  <tr>
    <td width="29%"> 
    <a href="./main.php?option=GenerateInvoice" style="font-weight:bold;"><img src="images/pdf.png" /> Generate Invoice</a><br /><br />
    
   <?php if($rstudym['invoiceName']){?><a href="<?php echo $base_url;?>invoices/<?php echo $rstudym['invoiceName'];?>" target="_blank" style="color:#F00;"><img src="images/pdf.png" /> Print My Invoice</a> <?php }?>
    
    
    
    <div class="form-group row" style="padding-top:20px;">
<label class="form-control-label" style="padding-left:16px;">Type of Payment:</label><br />
<div class="col-sm-10">
<select name="type_of_payment" id="upload_type_id" class="form-control  required" required>

<option value="Wire Transfer" <?php if($rstudym['type_of_payment']=='Wire Transfer'){?>selected="selected"<?php }?>> Wire Transfer</option>
<option value="Cash Deposit" <?php if($rstudym['type_of_payment']=='Cash Deposit'){?>selected="selected"<?php }?>> Cash Deposit</option>
<option value="Mobile Money" <?php if($rstudym['type_of_payment']=='Mobile Money'){?>selected="selected"<?php }?>> Mobile Money</option>

</select>

<input name="submission_id" type="hidden" value="<?php echo $rstudy['protocol_id'];?>"/>
</div>
</div></td>
    <td width="39%"><label class=" form-control-label">Attach Proof of Payment: <span class="error">*</span></label><br />
<input name="attachpayment" type="file" id="attachpayment" class="required"/><br /></td>
    <td width="32%"><?php if($rstudym['paymentProof']){?><a href="./files/uploads/<?php echo $rstudym['paymentProof'];?>" target="_blank">Proof of Payment</a> ... <a href="./main.php?option=submissionFinishDel&id=<?php echo $rstudym['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>

<?php }?></td>
  </tr>
</table>









<input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
<input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
                            
<input name="doFinalSave" type="submit"  class="btn btn-primary" value="Save" style="float:right; margin-top:5px; "/>
  
<div style="clear:both;"></div>
             
   
   </form>
   
   
   <!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>New Attachment</strong></h3>
    </div>
    <div class="modal-body">

 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
 
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Type:</label>
<div class="col-sm-10">
<select name="upload_type_id" id="upload_type_id" class="form-control  required">
<?php
$sqlClinicalcv = "select * FROM ".$prefix."upload_type order by name asc";//and conceptm_status='new' 
$resultClinicalcv = $mysqli->query($sqlClinicalcv);
while($rClinicalcv=$resultClinicalcv->fetch_array()){
?>
<option value="<?php echo $rClinicalcv['id'];?>"><?php echo $rClinicalcv['name'];?></option>
<?php }?>
</select>
</div>
</div> 



 <div class="form-group row">
 
<label class="col-sm-2 form-control-label">File:</label>
<div class="col-sm-10">
<input name="attachethicalapproval" type="file" id="attachethicalapproval" class="required"/>

<input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
<input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
</div>
</div>
                        
                  
                        
       
       <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doFilesUpload" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
                                          
     </form>                   
    </div>
    </div>
    </div><!--End-->
    
                                     
</div>

<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>