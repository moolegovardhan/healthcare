<?php session_start(); 
ini_set('display_errors', false);?>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>

<div class="col-md-12">
<?php 
try{
include_once '../../Business/PatientData.php'; 
include_once '../../Business/PatientPrescription.php';
include_once '../../Business/AppointmentData.php';
$ad = new AppointmentData();
$pd = new PatientData();

$pp = new PatientPrescription();
$userId = $_SESSION['userid'];
$recordCount = $_POST['recordcount'];
$patientid = $_POST["hidpatientid"];
$appointmentId = $_POST['appointmentidhid'];
$totalPrice = 0;
$appData = $ad->getAppointmentPatientList("nodata",$patientid,"nodata");
$data = json_decode($pd->patientDetails($patientid));

$message = "";
$message = $message."<html>";
$message = $message."<head>";
$message = $message."<meta charset='UTF-8'>";
?>
 <style> 
  .textbox { 
    height: 25px; 
    width: 45px; 
    background-color: transparent;  
    border-style: solid;  
    border-width: 0px 0px 1px 0px;  
    border-color: darkred; 
    outline:0; 
  } 
 </style> 

 <!--div id="printbutton">
     <button class="btn-u btn-u-orange pull-right" onclick="myFunction()" type="button" value="button"><i class="fa fa-print"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </button>
 </div><br/-->
<input type="hidden" name="appointmentid" id="appointmentid" value="<?php  echo $appointmentId; ?>"/>
<div class="col-md-12">
    <?php
$message = $message."<title></title>";
$message = $message." </head>";
$message = $message."<body>";
      
$message = $message."<div class='tg-wrap'>";
$message = $message."<table width='70%' align='center'>";
$message = $message." <tr style='background-color:orange;'><td colspan='6' align='center'>". $_SESSION['logeduser']."</td></tr>";
$message = $message." <tr><td>Receipt #</td><td></td><td>Date</td><td>".date("F j, Y")."</td><td>PW</td><td></td></tr>";
$message = $message." <tr><td>Patient ID</td><td>".$patientid."</td><td>Age/Sex</td><td>".$data[0]->age."/".$data[0]->gender."</td><td colspan='2' rowspan='3'></td></tr>";
$message = $message." <tr><td>Patient Name</td><td>".$data[0]->name."</td><td></td><td></td></tr>";
$message = $message."<tr><td>Ref Doctor</td><td>".$appData[0]->DoctorName."</td><td></td><td></td></tr>";
$message = $message." <tr><td colspan='6'><hr/></td></tr>";
$message = $message."<tr ><td><b>Tests</b></td><td colspan='5'><b>Amount</b></td></tr>";
$message = $message." <tr><td colspan='6'><hr/></td></tr>";
try{

for($i=0;$i<$recordCount;$i++){
  //  echo "Helloooo1  in record count.....";echo "<br/>";
    //echo $_POST[$i];
   // echo $_POST['text'.$i];
    $datatoSplit = explode ("$",$_POST[$i]);
    if(sizeof($datatoSplit)>1){
    //  print_r($datatoSplit);
      $finalPrice = $_POST['text'.$i];
      $totalPrice = $totalPrice+$datatoSplit[2];//($appointmentId,$patientid,$testId,$consultationdiagnosticsId,$userId,$amount)
  //  $result = $pp->collectPatientLabSamples($appointmentId, $patientid, $datatoSplit[1], $datatoSplit[0], $userId, $finalPrice);
     $result = $pp->updateConsultationDiagnosisDetailsForSampleCollected($datatoSplit[0],$datatoSplit[2]);
      $message = $message."<tr><td>".$datatoSplit[3]."</td><td colspan='5'>".$datatoSplit[2]."<inptut type='hidden' name='appointmentid' id='appointmentid' value='".$datatoSplit[0]."'></td></tr>";
      
    }
}
}  catch (Exception $e){
    echo $e->getMessage();
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
$message = $message."<tr><td colspan='2'>Test Amount</td><td colspan='4'>Rs ".$totalPrice."/-<inptut type='hidden' name='totalprice' id='totalprice' value='".$totalPrice."'></td></tr>";
$message = $message."<tr><td colspan='2'>Discount</td><td colspan='4'>".$discountAmount." {Discount : ".$discountPercent."% } </td></tr>";
$message = $message."<tr><td colspan='2'>Final Amount</td><td colspan='4'>Rs ".$finalAmount." /-<inptut type='hidden' name='hidfinalamount' id='hidfinalamount' value='".$finalAmount."'></td></tr>";
$message = $message."<tr><td colspan='2'>Paid Amount</td><td colspan='4' align='left'>Rs<span id='payingamount'></span>  /-</td></tr>";
$message = $message."<tr><td colspan='2'>Balance Amount</td><td colspan='4' align='left'>Rs<span id='balanceamount'></span>  /-</td></tr>";
$message = $message."<tr><td colspan='6'></td></tr>";
$message = $message."<tr><td colspan='6'>Report Time</td></tr>";
$message = $message."<tr><td colspan='6'></td></tr>";
$message = $message."<tr><td colspan='6' align='right'>Lab Technician </td></tr>";
$message = $message."<tr><td colspan='6'><br/></td></tr>";
$message = $message."<tr><td colspan='6'>Test result refer to item tested </td></tr>";
$message = $message."</table>";
$message = $message." </div>";
	  
	  
$message = $message." </body>";
$message = $message."</html>";

print_r($message);
$url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Business/PrintLabSampleCollection.php?apid=".$appointmentId."&price=";
} catch(Exception $ex) {
    echo $ex->getMessage();
} 
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
 <script>
     //$('#hidfinalamount').val(0);
    function updatepaidamount(){
        console.log($('#paidamount').val());
        $('#payingamount').html($('#paidamount').val());
        console.log("Hidden Value..."+$('#hidfinalamount').val());
        finalamount = $('#hidfinalamount').val();
        console.log("Final Amount"+parseInt(finalamount));
        console.log(parseInt($('#paidamount').val()));
        console.log((parseInt(finalamount)-parseInt($('#paidamount').val())));
        $('#balanceamount').html(parseInt(finalamount)-parseInt($('#paidamount').val()));
    }//
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
        console.log(wallet);
         console.log(wallet < paidamount);
        if(wallet != "" && wallet < paidamount){
            alert("Insufficeant balance.Please lower the paying amount");
            return false;
        }
    }
    $('#printbutton').hide();
    $('#payment-options').hide();
    $('#header').hide();
    console.log($('#totalprice').val());
    window.print();
    console.log('<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>);
     if(paymenttype != "wallet"){
       window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>+'&discamount='+<?php echo $_SESSION['discpercent'];?>+'&patientid='+<?php echo $patientid;?>;
    }else {
      window.location.href='<?php  echo $url; ?>'+$('#paidamount').val()+'&totalamount='+<?php echo $totalPrice;?>+'&discamount='+<?php echo $_SESSION['discpercent'];?>+'&wallet=Y&patientid='+<?php echo $patientid;?>;
      
    }

}
</script>
</div>