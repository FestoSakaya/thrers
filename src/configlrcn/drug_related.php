<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
?>

<div  style="color:#FFF; font-size:16px;">
<label for="names" style="color:#FFF; font-size:16px;">Select Research Category <font color="#CC0000">*</font></label> 
</div>
<select name="category" id="welcomesd" class="required" required>
   <option value="" selected="selected">&nbsp;Select from list</option>
<?php
$qRCat="select * from ".$prefix."categories order by rstug_categoryName asc";
$RCat = $mysqli->query($qRCat);
while($TCat = $RCat->fetch_array()){
?>
                <option value="<?php echo $TCat['rstug_categoryID'];?>" <?php if($TCat['rstug_categoryID']==$rowProject['rstug_categoryID']){?>selected="selected"<?php }?>>&nbsp;<?php echo $TCat['rstug_categoryName'];?></option>
<?php }?>
                </select>

<?php if($country=='No'){?>
<div  style="color:#FFF; font-size:16px;">
<label for="names" style="color:#FFF; font-size:16px;">You will be re-directed to UNCST Approval <font color="#CC0000">*</font></label> 
</div>
<?php }
if($country=='Yes'){?>
<div  style="color:#FFF; font-size:16px;">
<label for="names" style="color:#FFF; font-size:16px;">You will be re-directed to REC Approval <font color="#CC0000">*</font></label> 
</div>
<?php }?>
