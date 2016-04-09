<?php
session_start();
include_once 'MedicinesOrdered.php';
$od = new MedicinesOrdered();
?>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<br/><br/><br/><br/>
<p><center><img src="../Web/config/content/assets/img/loading.png"/> <font color="blue"><b>Updating Request.... Please wait. Thanks !</b></font></center></p>

<?php
$mo = new MedicinesOrdered();
//echo "rating...".$_POST['rating'];
for($i=0;$i<$_POST['recordcount'];$i++){
 
       if($_POST[$i."selected"] != ""){
           $od->orderclosed($_SESSION['pid'],$_POST[$i."selected"],$_POST["comments"],$_POST['rating']);
       }
    
    
}

$message = "Thanks for Feedback";
 $url = "http://".$_SESSION['host']."/".$_SESSION['rootNode']."/Web/patient/patientindex.php";
?>
<script>

	
    alert("<?php echo $message ;?>");
   window.location.href = "<?php echo $url; ?>"; //will redirect to your blog page (an ex: blog.html)
}, 2000);

</script>