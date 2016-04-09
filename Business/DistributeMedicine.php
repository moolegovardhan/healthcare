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
session_start();
?>
<br/><br/><br/><br/>

<?php 
require 'MedicalData.php';
$md = new MedicalData();
$hidcount = $_POST['hidcount'];
//echo "Record Count : ".$hidcount; echo "<br/>";
try{
?>
<div id="printbutton">
 <button class="btnExample" onclick="myFunction()" type="button" value="button"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </button>
 </div><br/>
<table width="80%" cellspacing="0" cellpadding="0" border="1" align="center">
    <tr> <td><b>Patient Name</b></td><td colspan="2"><?php echo $_POST['patientname'];?></td></tr>
     <tr> <td><b>Date </b></td><td colspan="2"><?php echo date("d.m.Y");?></td></tr>
    <tr bgcolor="#81F7BE">
        <th style="color: #990000;"><b>Medicine Name</b></th>
         <th style="color: #990000;"><b>Medicine Distributed</b></th>
          <th style="color: #990000;"><b>Cost (Rs)</b></th>
    </tr>
<?php  
$totalCost = 0;
for($i = 0;$i<$hidcount+1;$i++){
   /* echo'medicinedist'.$i;echo "<br/>";
    echo "Distribute Count : ".$_POST['medicinedist'.$i];echo "<br/>";
    echo "Medicine Index : ".$_POST['medicine'.$i];echo "<br/>";
    echo "Price : ".$_POST['medicineprice'.$i];echo "<br/>";
    */
    $passonvalue = explode("$", $_POST['medicine'.$i]);
    
    $distribute = $_POST['medicinedist'.$i];
    $original = $passonvalue[1];
    $cost = $_POST['medicineprice'.$i];
    $medicineindex = $passonvalue[0];   
    $patientid = $passonvalue[2];
    $appointmentid =   $passonvalue[3];     
    $medicinename =   urldecode($passonvalue[4]); 
    if($cost != "" && $distribute != ""){
     
        $md->insertMedicineDistributionDetails($medicineindex, $cost, $distribute, $original, $patientid, $appointmentid, $medicinename);
    
        
    
    $totalCost = $totalCost+$cost;
  ?>
     <tr>
        <th><?php echo $medicinename; ?></th>
         <td><?php echo $distribute; ?></td>
          <td><?php echo $cost; ?>/-</td>
    </tr>
    
  <?php  
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
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/medical/medicalindex.php?page=distribution";
}catch(Exception $ex){
    $message = $ex->getMessage();
    $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/medical/medicalindex.php?page=distribution";
}
?>

<script>
setTimeout(function () {
    alert("<?php echo $message ;?>");
    window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 10000);

</script>