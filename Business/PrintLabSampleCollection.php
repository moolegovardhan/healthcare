<?php session_start();
include_once 'AppointmentData.php';
include_once 'PatientData.php';
$pd = new PatientData();
$paymentDone = $_GET['price'];
$appointmentid = $_GET['apid'];
$totalprice = $_GET['totalamount'];
$discpercent = $_GET['discamount'];
$cgsdicount = $_SESSION['cgsdiscount'];
$instid = $_SESSION['officeid'];
$wallet = $_GET['wallet'];
$discamount = ($totalprice*$discpercent)/100;
$patientid = $_GET['patientid'];

$message = "Data Updated Successfully";

$ad = new AppointmentData();
$ad->updateAppointmentWithLabPrice($appointmentid,$paymentDone);
if($cardtype !=  "")
   $ad->insertDiscountInformation($instid,$discamount,$cgsdicount,$totalprice,$paymentDone,$appointmentid);
if($wallet != "" && $wallet == "Y"){
    $pd->updatePatientWalletPaymentInfo($patientid, $paymentDone);
}


 $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/lab/labindex.php?page=samplecollection";
 
?>


<script>
setTimeout(function () {
   alert("<?php echo $message ;?>");
    window.location.href = "<?php echo $url; ?>"; 
}, 1000);

</script>