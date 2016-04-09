<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<?php 
session_start();
include_once  'BusinessHSMDatabase.php';
require '../Common/HSMMessages.php';
include_once 'DiscountData.php';
$disc = new DiscountData();

?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>
<?php
try{
$recordCount = $_POST['medicalrecordcount'];
//echo "in record count  ".$recordCount;echo "<br/>";
for($i=0;$i<$recordCount;$i++){
  //  echo "counter - ".$i;echo "<br/>";
   // echo "Diag ...".$_POST['diag'.$i];echo "<br/>";
    // echo "Hosiptal ...".$_POST['discvalue'.$i];echo "<br/>";
     $diagId = $_POST['shop'.$i];
     $discvalue = $_POST['medicaldiscvalue'.$i];
      $cgsdiscount = $_POST['medicalcgsdiscount'.$i];
      
      if(($diagId != "") && (!($discvalue < 1) || !($cgsdiscount < 1))){
         $extData = $disc->fetchInstitution($diagId);
        
         if(sizeof($extData) > 0){
          
             $disc->updateDiscountPercentage($diagId, $discvalue,$cgsdiscount);
         }else if(sizeof($extData) < 1){
            
             $disc->createDiscount('Percentage','Medical Shop', $discvalue, $diagId,$cgsdiscount);
         }
     }
}
 $message = "Data Updated Successfully. ";
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/admin/adminindex.php?page=discount";

} catch(Exception $ex) {
    echo $ex->getMessage();
} 
?>
<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>