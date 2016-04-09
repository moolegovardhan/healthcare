<?php 
session_start();
?>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Data Please wait. Thanks !</b></font></center></p>

<?php
include_once 'MedicinesOrdered.php';

$mo = new MedicinesOrdered();

 try{       

$counter = $_POST['counter'];
$patientid = $_SESSION['userid'];

for($i=0;$i<$counter;$i++){
    
    $quantity = "quantity".$i;
    if($quantity < 0 || $quantity == "")
        $quantity = "0";
    
    $data = $_POST['textbox'.$i];
    $medicineData = split("#", $data);
    $mo->nonPrescriptionMedicineOrdered($patientid, $medicineData[1], $quantity);
}



 $message = "Medicines Order Made Successfully. ";
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/staff/staffindex.php?page=childprescription";
}catch(Exception $ex){
    $message = $ex->getMessage();
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/staff/staffindex.php?page=childprescription";
}

?>
<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>
