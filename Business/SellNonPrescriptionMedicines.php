<?php
session_start();
?>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>

<style>
    td, th {
  width: 4rem;
  height: 2rem;
  border: 1px solid #ccc;
  text-align: justify;
}
th {
  background: lightblue;
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
require 'MedicalData.php';
require 'PatientData.php';
$md = new MedicalData();
$pd = new PatientData();

$patientId = $_POST['medicinesforPatient'];
$counter = $_POST['counter'];
$totalCost = $_POST['medicinescost'];
$patientDetails = $pd->patientDetails($patientId);
$details = json_decode($patientDetails);
//print_r($details);
for($i = 1;$i<$counter+1;$i++){
    $data = $_POST['textbox'.$i];
    if(strlen($data) > 1){
        
    }
}
?>
<br/><br/><br/><br/>

<?php 

//echo "Record Count : ".$hidcount; echo "<br/>";
try{
?>
<div id="printbutton">
 <button class="btnExample" onclick="myFunction()" type="button" value="button"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </button>
 </div><br/>
<table width="80%" cellspacing="0" cellpadding="0" border="1" align="center">
    <tr> <td ><b>Patient Name</b></td><td colspan="2"><?php echo $details[0]->name;?></td></tr>
     <tr> <td><b>Date </b></td><td colspan="2"><?php echo date("d.m.Y");?></td></tr>
    <tr bgcolor="#81F7BE">
        <th style="color: #990000;" width="60%"><b>Medicine Name</b></th>
         <th style="color: #990000;" width="20%"><b>Medicine Distributed</b></th>
          <th style="color: #990000;" width="20%"><b>Cost (Rs)</b></th>
    </tr>
<?php  

for($i = 1;$i<$counter+1;$i++){
    $data = $_POST['textbox'.$i];
    if(strlen($data) > 1){
   
    $passonvalue = explode("#", $data);
    
    $distribute = $passonvalue[1];
    $original = $passonvalue[1];
    $cost = $passonvalue[2];
    $medicineindex = "";   
    $patientid = $patientId;
    $appointmentid =   "";     
    $medicinename =   $passonvalue[0]; 
    if($cost != "" && $distribute != ""){
     
        $md->insertMedicineDistributionDetails($medicineindex, $cost, $distribute, $original, $patientid, $appointmentid, $medicinename);
    
        
  ?>
     <tr>
        <th width="60%"><?php echo $medicinename; ?></th>
         <td width="20%"><?php echo $distribute; ?></td>
          <td width="20%"><?php echo $cost; ?>/-</td>
    </tr>
    
  <?php  
  }
    }
 }
 ?>
    <tr>
        <td colspan="2" style="text-align: end;">Total Cost :&nbsp;&nbsp;</td>
        <td  align="right">  <b>Rs. <?php echo $totalCost;?>/-</b></td>
    </tr> 
</table> 
 <?php   
//$medicineId,$cost,$distributed,$original,$patientid,$appointmentid)
//userDetails.id+"$"+userDetails.totalcount+"$"+userDetails.patientid+"$"+userDetails.appointmentid+"$"+userDetails.medicinename  
    $message = "Data Updated Successfully. ";
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/medical/medicalindex.php?page=nonprescription";
}catch(Exception $ex){
    $message = $ex->getMessage();
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/medical/medicalindex.php?page=nonprescription";
}
?>

<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
    window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 10000);

</script>
