<?php 
session_start();
?>
<div class="col-md-12">

<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>


<style>
    td, th {
  width: 4rem;
  height: 2rem;
  border: 0px solid #ccc;
  text-align: justify;
}
th {
 -- background: lightblue;
  border-color: white;
}
body {
  padding: 1rem;
}
  /* CSS */
.btnExample {
  color: #900;
  background: #FF0;
  font-weight: bold;
  border: 1px solid #900;
}
 
.btnExample:hover {
  color: #FFF;
  background: #900;
}
</style>
<script>
function myFunction() {
    $('#printbutton').hide();
    window.print();
}
</script>

    <?php
include_once '../../Business/AppointmentData.php';
include_once '../../Business/PatientData.php';
include_once '../../Business/MasterData.php';
try{
    

$ad = new AppointmentData();
$pd = new PatientData();
$master = new MasterData();
$hospital = $_POST['hospital'];

$testname = $_POST['list'];
$doctor = $_POST['doctor'];
$appointmentType = $_POST['prescriptiontype'];
$appointmentdate = $_POST['start'];
/*$fromhr = $_POST['fromhr'];
$frommin = $_POST['frommin'];
$endhr = $_POST['endhr'];
$endmin = $_POST['endmin'];*/
$patientid = $_POST['testforpatient'];
//echo "Patient ID ".$patientid;
$details = ($pd->fetchPatientDetails($patientid));
//print_r($details);
$amount = 0;
$slot = $_POST['slottime']; 
if(strlen($slot) < 2){
    $slot = "00:00 - 00:00";
} 
if(strlen($appointmentdate) < 3){
    $appointmentdate = date("Y-m-d");
}
if($hospital == "HOSPITAL"){
   $hospital =  $_SESSION['officeid'];
   $hospitalName = $hospital;
}  else {
    $hosData = $master->getHosiptalDataBasedOnId($hospital);
$hospitalName = $hosData[0]->hosiptalname;   
}
if($doctor == "DOCTOR"){
    $doctor = " - ";
}


//echo "patientInfo :".$patientid." <br/>";

$patientInfo = $pd->fetchPatientDetails($patientid);
//print_r($patientInfo);
//echo "patientInfo : <br/>";

$appointmentInfo = $ad->createCallCenterOldAppointment($hospital, $doctor, $appointmentdate, $slot, $patientid, 'Y', $patientInfo[0]->name, $appointmentType);

//echo "Appointment ID : ".$appointmentInfo."<br/>";
/*if($appointmentType = "General")
    $ad->createCallCenterOldDateDummyPrescription($appointmentInfo,$patientid,$patientInfo[0]->name,$doctor,$hospital,$appointmentdate);
else if($appointmentType = "Pregnancy")
      $ad->createDummyPregnancyPatientPrescriptionDetails($appointmentInfo,$patientid,$patientInfo[0]->name,"",$doctor,$hospital,$appointmentdate);  
else if($appointmentType = "Child")
    $ad->createDummyChildPatientPrescriptionDetails($appointmentInfo,$patientid,$patientInfo[0]->name,"",$doctor,$hospital,$appointmentdate);
*/
$message = "";
$message = $message."<html>";
$message = $message."<head>";
$message = $message."<meta charset='UTF-8'>";
?>
 
<style> 
  .textbox { 
    height: 25px; 
    width: 75px; 
    background-color: transparent;  
    border-style: solid;  
    border-width: 0px 0px 1px 0px;  
    border-color: darkred; 
    outline:0; 
  } 
  .btnExample {
  color: #900;
  background: #FF0;
  font-weight: bold;
  border: 1px solid #900;
}
 
.btnExample:hover {
  color: #FFF;
  background: #900;
}
 </style> 

<input type="hidden" name="appointmentid" id="appointmentid" value="<?php  echo $appointmentId; ?>"/>
<div class="col-md-12">
    <div id="printbutton">
 <button class="btnExample" onclick="myFunction()" type="button" value="button"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </button>
 </div><br/>
    <?php
$message = $message."<title></title>";
$message = $message." </head>";
$message = $message."<body>";
      
$message = $message."<div class='tg-wrap'>";
$message = $message."<table width='70%' align='center'>";
$message = $message." <tr style='background-color:orange;'><td colspan='6' align='center'>". $_SESSION['logeduser']."</td></tr>";
$message = $message." <tr><td>Receipt #</td><td></td><td>Date</td><td>".date("F j, Y")."</td><td>PW</td><td></td></tr>";
$message = $message." <tr><td>Patient ID</td><td>".$patientid."</td><td>Age/Sex</td><td>".$patientInfo[0]->age."/".$patientInfo[0]->gender."</td><td colspan='2' rowspan='3'></td></tr>";
$message = $message." <tr><td>Patient Name</td><td>".$patientInfo[0]->name."</td><td></td><td></td></tr>";
$message = $message."<tr><td>Ref Doctor</td><td>".$doctor."</td><td></td><td></td></tr>";
$message = $message." <tr><td colspan='6'><hr/></td></tr>";
$message = $message."<tr ><td><b>Tests</b></td><td colspan='5'><b>Amount</b></td></tr>";
$message = $message." <tr><td colspan='6'><hr/></td></tr>";
$totalPrice = 0;
for($i=0;$i<$_POST['counter'];$i++){
    
    $namevalue = $_POST['textbox'.$i];
    $testdata = explode("#", $namevalue);
    $totalPrice = $totalPrice+$testdata[2];
   //($diagtype,$nameValue,$appointmentId,$patientId)
    $ad->insertPrescriptionDiagnosisDetails("MEDICAL TEST",$testdata[0],$appointmentInfo,$patientid);
     $message = $message."<tr><td>".$testdata[1]."</td><td colspan='5'>".$testdata[2]."</td></tr>";
}
$updateappointment = $ad->updateAppointmentWithLabPrice($appointmentInfo,$totalPrice);
    $alertmessage = "Data Updated Successfully. ";
   // $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/lab/labindex.php?page=newReport";


} catch (Exception $ex) {
    
    echo $ex->getMessage();
     $alertmessage = $ex->getMessage();
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/lab/labindex.php?page=newReport";
}

if($data[0]->cardtype != ""){
    $discountPercent = $_SESSION['discpercent'];
    $finalAmount = ($totalPrice-(($totalPrice*$_SESSION['discpercent'])/100));
    $discountAmount = (($totalPrice*$_SESSION['discpercent'])/100);
}else{
    $discountPercent = "0";
    $finalAmount = $totalPrice;
    $discountAmount = "0";
}
$message = $message."<tr><td colspan='6'><hr/></td></tr>";
$message = $message."<tr><td colspan='2'>Test Amount</td><td colspan='4'>".$totalPrice."</td></tr>";
$message = $message."<tr><td colspan='2'>Discount </td><td colspan='4'>".$discountAmount." {Discount : ".$discountPercent."% }</td></tr>";
$message = $message."<tr><td colspan='2'>Paid Amount</td><td colspan='4' align='left'>Rs<span id='payingamount'></span>  /-</td></tr>";
$message = $message."<tr><td colspan='6'></td></tr>";
$message = $message."<tr><td colspan='6'>Report Time</td></tr>";
$message = $message."</table>";
$message = $message." </div>";
	  
	  
$message = $message." </body>";
$message = $message."</html>";

print_r($message);
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Business/PrintLabSampleCollection.php?apid=".$appointmentId."&price=";
?>
 </div>

<div class="col-md-13 sky-form" id="payment-options">
      <div class="row">
          <section class="col-md-2"></section>  
          <section class="col-md-9" >
    <?php 
     // print_r($data);
    include '../common/payment.php';
    
    ?>
          </section> <section class="col-md-2"></section>  
        </div>
</div>
</div>
 <script>
       function updatepaidamount(){
        console.log($('#paidamount').val());
        $('#payingamount').html($('#paidamount').val());
    }
function myFunction() {
    paymenttype = $('#paymenttype').val();
    paidamount = $('#paidamount').val();
    creditcardnumber = $('#creditcardnumber').val();
    creditcardname = $('#creditcardname').val();
    cvv = $('#cvv').val();
    cardtype = $('#cardtype').val();
    wallet = $('#wallet').val();
    
    if(paidamount == ""){
       
       alert("Please enter paying amount");
       return false;
    }
    if(paymenttype == "selectpaymenttype"){
               alert("Please select Payment Type");
            return false;
     }   
    if(paymenttype == "creditcard"){
        
        if(creditcardnumber == ""){
             alert("Please enter credit card number");
            return false;
        }    
        if(creditcardname == ""){
             alert("Please enter credit card name");
            return false;
        }    
        if(cvv == ""){
             alert("Please enter credit card cvv number");
            return false;
        }    
        
    }
    if(paymenttype == "debitcard"){
        
        if(debitcardnumber == ""){
             alert("Please enter debit card number");
            return false;
        }    
        if(debitcardname == ""){
             alert("Please enter debit card name");
            return false;
        }    
        if(cvv == ""){
             alert("Please enter debit card cvv number");
            return false;
        }    
        
    }
    if(paymenttype == "wallet"){
        if(wallet == ""){
            alert("You have in sufficeant balance. Can't pay using wallet");
            return false;
        }
        if(wallet != "" && wallet < paidamount){
            alert("Insufficeant balance.Please lower the paying amount");
            return false;
        }
    }
    $('#printbutton').hide();
    $('#payment-options').hide();
    $('#header').hide();
    window.print();
    
  //  window.location.href='<?php  echo $url; ?>'+$('#paidamount').val();
    if(paymenttype != "wallet"){
       window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>+'&discamount='+<?php echo $_SESSION['discpercent'];?>+'&patientid='+<?php echo $patientid;?>;
    }else {
      window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>+'&discamount='+<?php echo $_SESSION['discpercent'];?>+'&wallet=Y&patientid='+<?php echo $patientid;?>;
      
    }
}
</script>

<script>
setTimeout(function () {
   // alert("<?php echo $alertmessage ;?>");
 //   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 10000);

</script>
