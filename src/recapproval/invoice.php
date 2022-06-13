 <?php
session_start();
require_once('contrlrcn/c_mlsrcontrol.php');
timeout($timeout);
if(!$mysqli->real_escape_string($_SESSION['username']) and !$mysqli->real_escape_string($_SESSION['asrmApplctID']))
{
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'">';
	
die;
}
?>

 <?php
$submission_id=base64_decode($id);
  /////////////////////Get protocols
  
  
$sqlstudyAny="SELECT * FROM ".$prefix."user where `asrmApplctID`='$asrmApplctID'";
$QuerystudyAny = $mysqli->query($sqlstudyAny);
$totalstudyAny = $QuerystudyAny->num_rows;
$rstudyAny = $QuerystudyAny->fetch_array();
$fullName=$rstudyAny['name'];


$sqlprotocolName="SELECT *,DATE_FORMAT(`updated`,'%d %m %Y') AS updatedm FROM ".$prefix."protocol where id='$submission_id' and `owner_id`='$asrmApplctID'";
$QprotocalName = $mysqli->query($sqlprotocolName);
$rprotocalQprotocalName = $QprotocalName->fetch_array();
$ProtoclReference=$rprotocalQprotocalName['code'];
$recAffiliated_id=$rprotocalQprotocalName['recAffiliated_id'];

$sqlstudym2="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and is_sent='0' and protocol_id='$submission_id' order by id desc limit 0,1";
$Querystudym2 = $mysqli->query($sqlstudym2);
$rstudym2 = $Querystudym2->fetch_array();



//check whether we dont have an invoice already
$sqlRECName="SELECT * FROM ".$prefix."list_rec_affiliated where `id`='$recAffiliated_id'";
$QueryRECName = $mysqli->query($sqlRECName);
$rstudyRECName = $QueryRECName->fetch_array();

$company = $rstudyAny["name"];
$address = $rstudyAny["institution"];
$email = $rstudyAny["email"];
$telephone = $rstudyAny["phone"];
$number = "CRIMS/00".$rstudym['protocol_id'];//Invoice Number

$rstudym['protocol_id'];

$item = "REC approval fees for the ".$rstudym2["public_title"];
$price = $rstudyRECName['payAmount'];
$currency = $rstudyRECName['currency'];
$vat = 0;
$recName = $rstudyRECName['name'];
$recAddress = $rstudyRECName['contacts'];
$bank = $rstudyRECName['bankName'].','.$rstudyRECName['BranchName'];

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice - <?php echo $fullName;?></title>
    <link rel="stylesheet" href="css/invoice.css" media="all" />
  </head>
  <body>
 
    <header class="clearfix">
      <div id="logo">
        <img src="<?php echo $base_url;?>/recapproval/images/invoice.png">
      </div> 
      <div id="company">
        <h2 class="name"><?php echo $recName;?></h2>
        <div><?php echo $recAddress;?></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name"><?php echo $rstudyAny['name'];?></h2>
          <div class="address"><?php echo $rstudyAny['institution'];?></div>
          <div class="email"><a href="mailto:<?php echo $rstudyAny['email'];?>"><?php echo $rstudyAny['email'];?></a></div>
        </div>
        <div id="invoice">
          <h1>INVOICE NO: <?php echo $number;?></h1>
          <div class="date">Date of Invoice: <?php echo $rstudym['updatedm'];?></div>
          
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">DESCRIPTION</th>
            <th class="unit">UNIT PRICE</th>
            <th class="qty">QUANTITY</th>
            <th class="total">TOTAL <?php echo $rstudym2["currency"];?></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="no">01</td>
            <td class="desc"><h3><?php echo $item;?></h3>Ref Number: <?php echo $ProtoclReference;?></td>
            <td class="unit"><?php echo numberformat($price);?></td>
            <td class="qty">1</td>
            <td class="total"><?php echo numberformat($price);?></td>
          </tr>
       
          <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td><?php echo numberformat($price);?> <?php echo $rstudym2["currency"];?></td>
          </tr>
        </tfoot>
      </table>

      <div id="notices">
        <div>Bank Details:</div>
        <div class="notice"><?php echo $bank;?></div>
      </div>
    </main>
    
  </body>
</html>