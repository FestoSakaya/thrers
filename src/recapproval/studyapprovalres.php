<?php
require_once('TCPDF/tcpdf.php');
$hostm   = "db";
$dbm = "c1nrims_recapprovals";
$usrm   = "c1nrimsrm";
$pwdm   = "xgfkbGNPWZ!4";
//object oriented style (recommended)
$mysqli = new mysqli($hostm,$usrm,$pwdm,$dbm);
//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

$rmd_id=$_GET['rmd_id'];
$queryp2w="select * from apvr_study_approvals where rmd_id='$rmd_id'";
$cmdw2=$mysqli->query($queryp2w);
$rSw2=$cmdw2->fetch_array();
//$approvalMain=$rSw2['approvalMain'];
$approvalText=$rSw2['approvalText1'];
$approvalText2=$rSw2['approvalText2'];//nl2br()
$approvalText3=$rSw2['approvalText3'];
$studyTools=$rSw2['studyTools'];
$rstug_UNCSTRefNumber=$rSw2['refNo'];
$DateApproved=$rSw2['DateApproved'];
$whosigns=$rSw2['whosigns'];
$totaldocs=$rSw2['totaldocs'];
$rstug_rsch_project_id=$rSw2['rstug_rsch_project_id'];
$querypsubmission="select * from apvr_submission where id='$rstug_rsch_project_id' order by id desc";
$cmdwsubmission=$mysqli->query($querypsubmission);
$rSwsubmission=$cmdwsubmission->fetch_array();
$rec_id=$rSwsubmission['recAffiliated_id'];
$querypREC="select * from apvr_list_rec_affiliated where id='$rec_id' order by id desc";
$cmdwREC=$mysqli->query($querypREC);
$rSwREC=$cmdwREC->fetch_array();
$rec_header=$rSwREC['recheader'];
$recChairName=$rSwREC['name'];
//$approvalMain=$rSwREC['shortaddress'];

$querypUser="select * from apvr_user where asrmApplctID='$whosigns' order by asrmApplctID desc";
$cmdwUser=$mysqli->query($querypUser);
$rSwUser=$cmdwUser->fetch_array();
$signedby=$rSwUser['name'];
if($rSwUser['signatures']){$signature=$rSwUser['signatures'];}else{$signature="hellensignature.jpg";}
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
$pdf->SetCreator("Hellen Opolot");
$pdf->SetAuthor('Hellen Opolot');
$pdf->SetTitle("Study Approval - $rstug_UNCSTRefNumber");
 
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0, 6, 255), array(0, 64, 128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));
 
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
// ---------------------------------------------------------
 if($totaldocs>=4){$pageBreak='<p style="page-break-before: always"></p>';}//

//$studyToolsMain = str_replace('\'', "\"", $studyTools);


// set default font subsetting mode
 
$pdf->setFont('times', '', 11, '', true);
 
$pdf->AddPage();

$html = <<<EOD
<style>
.customers {
  border-collapse: collapse;
  width: 100%;
}

.customers td, .customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

.customers tr:nth-child(even){background-color: #f2f2f2;}

.customers tr:hover {background-color: #ddd;}

.customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #796AEE;
  color: white;
}</style>
<img src="./files/headers/$rec_header" />
<table width='100%' border='0'>
  <tr>
    <td width='78%' align='left' valign='top'>
	<br><br>
	$approvalMain
    </td>
    <td width='22%' valign='top'>
	
<table width='100%' border='0'>
  <tr>
    <td valign='top' align="right"><br><br>$DateApproved</td>
  </tr>
</table>

	
</td>
  </tr>
  
  
  
</table>
$approvalText

$approvalText2<br>


<table width="100%" border="0" class="customers">
<tr>
    <th width="6%" valign='top'><p><strong>No. </strong></p></th>
    <th width="40%" valign='top'><p><strong>Document Title</strong></p></th>
    <th width="17%" valign='top'><p><strong>Language</strong></p></th>
    <th width="17%" valign='top'><p><strong>Version Number</strong></p></th>
    <th width="18%" valign='top'><p><strong>Version Date</strong></p></th>
  </tr>
$studyTools
</table>

<br><br>
Yours Sincerely<br>
<img src="./files/signatures/$signature" /><br>

$signedby<br>
For: $recChairName<br>
EOD;
 
//$pdf->writeHTML($html);
$pdf->writeHTML($html, true, false, true, false, '');
 //ob_end_clean();//ignore headers already sent error
$pdf->Output('$rstug_UNCSTRefNumber.pdf', 'I');

?>