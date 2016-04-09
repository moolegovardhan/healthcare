<?php
include_once 'BusinessHSMDatabase.php';
include_once 'AppointmentEmail.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Appointment
 *
 * @author pkumarku
 */
class AppointmentData {
    //put your code here
    
    function getAppointmentDetails($hosiptal,$doctor,$appdate){
        $dbConnection = new HSMDatabase();
       
       $sql = "SELECT * from appointment  ";
            try {
                
                
                  $status = 'N';
                    $cond = array();
                    $params = array();

                    if ($hosiptal != 'nodata') {
                        $cond[] = "HosiptalId = ?";
                        $params[] = "$hosiptal";
                    }

                    if ($doctor != 'nodata') {
                        $cond[] = "DoctorId = ?";
                        $params[] = $doctor;
                    }
                    
                    if ($appdate != 'nodata') {
                        $cond[] = "AppointementDate = ?";
                        $params[] = $appdate;
                    }

                 
                    if (count($cond)) {
                        $sql .= ' WHERE ' . implode(' AND ', $cond);
                    }
           //echo $sql;
           //print_r($params);     
             
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
               $stmt->execute($params);
                $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                
                return $appointmentDetails;



           } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            } 
              
        
    }
    
    function checkSlotStatus($hosiptal,$doctor,$appdate,$slot,$pid,$status,$pname){
         $dbConnection = new HSMDatabase();
            $sql = "SELECT * from appointment where DoctorId =:doctor and HosiptalId = :hosiptal and AppointementDate  = :appdate and appointmenttime = :slot";
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("doctor", $doctor);
                $stmt->bindParam("hosiptal", $hosiptal);
                $stmt->bindParam("appdate", $appdate);
                 $stmt->bindParam("slot", $slot);
               // print_r($stmt);
                $stmt->execute();
                $appoiontmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return ($appoiontmentDetails);

     
                
                
            } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            } 
    }
    
     
    function createAppointment($hosiptal,$doctor,$appdate,$slot,$pid,$status,$pname,$appointmentType){
            $email = new AppointmentEmail();
             $dbConnection = new HSMDatabase();
            try{
               // echo "ID.....".$pid."    ";
              //echo "ID.....".$hosiptal."    ";
            //  echo "ID.....".$doctor."    ";
                $pname = $this->userMasterData($pid);
               $hname = $this->getHosiptalName($hosiptal);
               $dname = $this->userMasterData($doctor);
              //print($pname[0]->name);
            //    print($hname[0]->hosiptalname);
            //  print($dname[0]->name);
             //echo "Hello";
                $Yes = 'Y';
                $No = 'N';
             $sql = "INSERT INTO appointment(DoctorId, AppointementDate, AppointmentTime,status,PatientId,HosiptalId,PatientName,
                 HospitalName,DoctorName,pregnancy,child,createdate)
             VALUES (:doctor,:appdate,:slot,:status,:pid,:hosiptal,:pname,:hname,:dname,:pregnancy,:child,CURDATE())";    
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("doctor", $doctor);
            $stmt->bindParam("appdate", $appdate);
            $stmt->bindParam("slot", $slot);
            $stmt->bindParam("status",$status);
            $stmt->bindParam("pid", $pid);
            $stmt->bindParam("hosiptal", $hosiptal);
            $stmt->bindParam("pname", $pname[0]->name);
            $stmt->bindParam("hname", $hname[0]->hosiptalname);
            $stmt->bindParam("dname", $dname[0]->name);   
            if($appointmentType == "Pregnancy")
                $stmt->bindParam("pregnancy",$Yes);
            else 
                $stmt->bindParam("pregnancy",$No);
            if($appointmentType == "Child")
                $stmt->bindParam("child",$Yes);
            else 
                $stmt->bindParam("child",$No);
            $stmt->execute();
            $appointment = $db->lastInsertId();
            $db = null;
            //echo $stmt->debugDumpParams(); 
            //return $appointment; 
            
          // $email->sendMail($dname[0]->name,$hname[0]->hosiptalname,$pname[0]->name,$appdate,$slot,$pid);
                    
            } catch(PDOException $pdoex) {
              echo "Exception in Appointment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
              //  throw new Exception($pdoex);
              echo $pdoex->getFile();
              
             } catch(Exception $ex) {
                 echo "Exception in Appointment : ".$ex->getMessage()." Line Number : ".$ex->getLine();
                //throw new Exception($ex);
                 echo $ex->getFile();
             } 
        
    }
    
    

    function userMasterData($userId){
        $dbConnection = new BusinessHSMDatabase();         
                try{
                 $sql = "select * from users u where u.ID = :userId";    
    //echo $sql;
    //echo $userId;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("userId", $userId);
                $stmt->execute();
               // $doctorMasterData = $stmt->lastInsertId();
                $result = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $result; 
             } catch(PDOException $pdoex) {
              echo "Exception in Master Data : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
              //  throw new Exception($pdoex);
             } catch(Exception $ex) {
                 echo "Exception in Master Data : ".$ex->getMessage()." Line Number : ".$ex->getLine();
               // throw new Exception($ex);
             }  
        }


    function getHosiptalName($userId){
        
    $dbConnection = new BusinessHSMDatabase();
     //echo "User Id".$userId."         ";
                try{
                 $sql = "select * from hosiptal u where u.ID = :userId";    
    //echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("userId", $userId);
                $stmt->execute();
               // $doctorMasterData = $stmt->lastInsertId();
                $doctorMasterData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $doctorMasterData; 
            } catch(PDOException $pdoex) {
              echo "Exception in Hospital : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
             //   throw new Exception($pdoex);
             } catch(Exception $ex) {
                 echo "Exception in Hospital : ".$ex->getMessage()." Line Number : ".$ex->getLine();
               // throw new Exception($ex);
             }  
        }

   function getAppointmentPatientList($patientName,$patientid,$appdate){
        
           $dbConnection = new BusinessHSMDatabase();
        
            $sql = "SELECT * from appointment";
            //where patientName LIKE :patientName and PatientId = :patientid and appointementdate = :appdate and status = 'N'";
        $status = 'N';
         $cond = array();
         $params = array();

         if ($patientName != 'nodata') {
             $cond[] = "PatientName LIKE ?";
             $params[] = "%".$patientName."%";
         }

         if ($patientid != 'nodata') {
             $cond[] = "PatientId = ?";
             $params[] = $patientid;
         }
  
         $cond[] = "status = ?";
         $params[] = $status;
     
         if (count($cond)) {
             $sql .= ' WHERE ' . implode(' AND ', $cond);
         }
//echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
               $stmt->execute($params);
                $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                //$_SESSION['userDetails'] = $userDetails;
                //echo $stmt->debugDumpParams();
                
                  //  print_r($userDetails);
                return $appointmentDetails;



           } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            }  
    }   
    

       
      
    function updateAppointment($appointmentId){
        
           $dbConnection = new HSMDatabase();
            $sql = "update appointment set status = 'Y' where id =:id";
        try{
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("id", $appointmentId);
                $stmt->execute();  
                $db = null;
                return $appointmentId;
         } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            }   
        
    }
  
 function updateAppointmentForInpatient($appointmentId){
        
           $dbConnection = new BusinessHSMDatabase();
            $sql = "update appointment set inpatient = 'Y' where id =:id";
        try{
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("id", $appointmentId);
                $stmt->execute();  
                $db = null;
                return $appointmentId;
         } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            }   
        
    }

   
    function updateAppointmenttoPregnancy($appointmentId){
        
           $dbConnection = new HSMDatabase();
            $sql = "update appointment set pregnancy = 'Y' where id =:id";
        try{
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("id", $appointmentId);
                $stmt->execute();  
                $db = null;
                return $appointmentId;
         } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            }   
        
    }
    
    
    function updateAppointmenttoChild($appointmentId){
        
           $dbConnection = new HSMDatabase();
            $sql = "update appointment set child = 'Y' where id =:id";
        try{
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("id", $appointmentId);
                $stmt->execute();  
                $db = null;
                return $appointmentId;
         } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            }   
        
    }
    
 function consultationPatientList(){
        
            $dbConnection = new HSMDatabase();
            
            if(isset($_SESSION['officeid'])){
            $officeId = $_SESSION['officeid'];
            }  else {
                throw new Exception("Invalid Office ID","HSM002","");
            }
            
           //echo $officeId; 
            $sql = "SELECT ID,PATIENTNAME,PATIENTID,DOCTORID,HOSIPTALID,DOCTORNAME,HOSPITALNAME,APPOINTEMENTDATE,APPOINTMENTTIME FROM appointment WHERE STATUS = 'Y' and HOSIPTALID = :hospitalId";
          //echo $sql;
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("hospitalId", $officeId);
                $stmt->execute();
                $consultationList = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return $consultationList;



        } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            } 
    }
   
    
    
     
    function consultationPatientDetails($patientId){
        
        try{
            
            $dbConnection = new BusinessHSMDatabase();
            $sql = "SELECT ID,PATIENTNAME,PATIENTID,DOCTORNAME,HOSPITALNAME,APPOINTEMENTDATE,HOSIPTALID,DOCTORID,APPOINTMENTTIME FROM appointment WHERE STATUS = 'Y' and PATIENTID = :patientID";
            
            $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientID", $patientId);
                $stmt->execute();
                $consultationPatientDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return $consultationPatientDetails;

            } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            }
        
        }

        
        
           
    function insertPatientPrescriptionDetails($appointmentId,$patientid,$patientname,$description,$doctorid,$hositpalid,$appointmentdt,$nextappointmentdt,$medicalshop,$inpatient,$suggestions){
        
        $dbConnection = new BusinessHSMDatabase();
        $db = $dbConnection->getConnection();
       // echo ".......... in patient ...".$inpatient;
       // echo ".......... in patient ...".($inpatient == 'N');
        if($inpatient == 'N'){
           // echo ".........>>>>>>>>>>>> In N inpateint";
            $sql = "delete from prescription where appointmentid = :appointmentId";
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute(); 
             
             
            $sql = "delete from consultationdiagnosisdetails where appointmentid = :appointmentId";
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute(); 
             
             
            $sql = "delete from patienttranscripts where appointmentid = :appointmentId";
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute();  
             
                 
        }     
        
        
             $sql = "delete from medicines where appointmentid = :appointmentId";
             $stmt = $db->prepare($sql);  
             $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute();
             
        $sql = "INSERT INTO  prescription (appointmentid,patientid,patientname,description,doctorid,hositpalid,appointmentdt,nextappointmentdt,medicalshop,suggestions)
        VALUES (:appointmentId, :patientid, :patientname, :description, :doctorid, :hositpalid, :appointmentdt, :nextappointmentdt,:medicalshop, :suggestions)";
      // echo $sql; echo "<br/>"; 
     // echo "SQL DATE : .".$nextappointmentdt;
        try{
              
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("appointmentId", $appointmentId);
                $stmt->bindParam("patientid", $patientid);
                $stmt->bindParam("patientname", $patientname);
                $stmt->bindParam("description", $description);
                $stmt->bindParam("doctorid", $doctorid);
                $stmt->bindParam("hositpalid", $hositpalid);
                $stmt->bindParam("appointmentdt", $appointmentdt);
                $stmt->bindParam("nextappointmentdt", $nextappointmentdt);
                $stmt->bindParam("medicalshop", $medicalshop);
                $stmt->bindParam("suggestions", $suggestions);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                return $presMasterData;
        } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
           
    function insertPregnancyPatientPrescriptionDetails($appointmentId,$patientid,$patientname,$description,$doctorid,$hositpalid,$appointmentdt,$nextappointmentdt,$medicalshop,$inpatient,$suggestions,$weight,$bp,$month){
        
        $dbConnection = new BusinessHSMDatabase();
        $db = $dbConnection->getConnection();
       // echo ".......... in patient ...".$inpatient;
       // echo ".......... in patient ...".($inpatient == 'N');
        if($inpatient == 'N'){
           // echo ".........>>>>>>>>>>>> In N inpateint";
            $sql = "delete from pregnancy_prescription where appointmentid = :appointmentId";
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute(); 
             
             
            $sql = "delete from consultationdiagnosisdetails where appointmentid = :appointmentId";
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute(); 
             
             
            $sql = "delete from patienttranscripts where appointmentid = :appointmentId";
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute();  
             
                 
        }     
        
        
             $sql = "delete from medicines where appointmentid = :appointmentId";
             $stmt = $db->prepare($sql);  
             $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute();
             
        $sql = "INSERT INTO  pregnancy_prescription (appointmentid,patientid,patientname,description,doctorid,hositpalid,appointmentdt,nextappointmentdt,
            medicalshop,suggestions,weight,bp,month)
        VALUES (:appointmentId, :patientid, :patientname, :description, :doctorid, :hositpalid, :appointmentdt,
        :nextappointmentdt,:medicalshop, :suggestions,:weight,:bp,:month)";
      // echo $sql; echo "<br/>"; 
     // echo "SQL DATE : .".$nextappointmentdt;
        try{
              
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("appointmentId", $appointmentId);
                $stmt->bindParam("patientid", $patientid);
                $stmt->bindParam("patientname", $patientname);
                $stmt->bindParam("description", $description);
                $stmt->bindParam("doctorid", $doctorid);
                $stmt->bindParam("hositpalid", $hositpalid);
                $stmt->bindParam("appointmentdt", $appointmentdt);
                $stmt->bindParam("nextappointmentdt", $nextappointmentdt);
                $stmt->bindParam("medicalshop", $medicalshop);
                $stmt->bindParam("suggestions", $suggestions);
                $stmt->bindParam("weight", $weight);
                $stmt->bindParam("bp", $bp);
                $stmt->bindParam("month", $month);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                return $presMasterData;
        } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
        
    function insertChildPatientPrescriptionDetails($appointmentId,$patientid,$patientname,$description,$doctorid,$hositpalid,$appointmentdt,$nextappointmentdt,$medicalshop,$inpatient,$suggestions,$weight,$height,$month,$isvacination,$vacination){
        
        $dbConnection = new BusinessHSMDatabase();
        $db = $dbConnection->getConnection();
       // echo ".......... in patient ...".$inpatient;
       // echo ".......... in patient ...".($inpatient == 'N');
        if($inpatient == 'N'){
           // echo ".........>>>>>>>>>>>> In N inpateint";
            $sql = "delete from child_prescription where appointmentid = :appointmentId";
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute(); 
             
             
            $sql = "delete from consultationdiagnosisdetails where appointmentid = :appointmentId";
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute(); 
             
             
            $sql = "delete from patienttranscripts where appointmentid = :appointmentId";
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute();  
             
                 
        }     
        
        
             $sql = "delete from medicines where appointmentid = :appointmentId";
             $stmt = $db->prepare($sql);  
             $stmt->bindParam("appointmentId", $appointmentId);
             $stmt->execute();
             
        $sql = "INSERT INTO  child_prescription (appointmentid,patientid,patientname,description,doctorid,hositpalid,appointmentdt,nextappointmentdt,
            medicalshop,suggestions,weight,height,month,isvacination,vacination)
        VALUES (:appointmentId, :patientid, :patientname, :description, :doctorid, :hositpalid, :appointmentdt,
        :nextappointmentdt,:medicalshop, :suggestions,:weight,:height,:month,:isvacination,:vacination)";
      // echo $sql; echo "<br/>"; 
     // echo "SQL DATE : .".$nextappointmentdt;
        try{
              
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("appointmentId", $appointmentId);
                $stmt->bindParam("patientid", $patientid);
                $stmt->bindParam("patientname", $patientname);
                $stmt->bindParam("description", $description);
                $stmt->bindParam("doctorid", $doctorid);
                $stmt->bindParam("hositpalid", $hositpalid);
                $stmt->bindParam("appointmentdt", $appointmentdt);
                $stmt->bindParam("nextappointmentdt", $nextappointmentdt);
                $stmt->bindParam("medicalshop", $medicalshop);
                $stmt->bindParam("suggestions", $suggestions);
                $stmt->bindParam("weight", $weight);
                $stmt->bindParam("height", $height);
                $stmt->bindParam("month", $month);
                $stmt->bindParam("isvacination", $isvacination);
                $stmt->bindParam("vacination", $vacination);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                return $presMasterData;
        } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
 function insertPrescriptionDiagnosisDetails($diagtype,$nameValue,$appointmentId,$patientId){
         
     
     $dbConnection = new BusinessHSMDatabase();
        try{
         $sql = "INSERT INTO consultationdiagnosisdetails(TYPE,NAMEVALUE,STATUS,appointmentid,patientid) VALUES(:diagtype,:nameValue,'P',:appointmentId,:patientId)";   
           // echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("diagtype", $diagtype);
                $stmt->bindParam("nameValue", $nameValue);
                $stmt->bindParam("appointmentId", $appointmentId);
                $stmt->bindParam("patientId", $patientId);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error111":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error1441":{"text11":'. $e1->getMessage() .'}}'; 
        } 
        
    }
    
  function insertPrescriptionDiagnosisNonDetails($diagtype,$nameValue,$appointmentId,$patientId){
         
     
     $dbConnection = new BusinessHSMDatabase();
        try{
         $sql = "INSERT INTO consultationdiagnosisdetails(TYPE,NAMEVALUE,STATUS,appointmentid,patientid,nonprestest) VALUES(:diagtype,:nameValue,'P',:appointmentId,:patientId,'NP')";   
           // echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("diagtype", $diagtype);
                $stmt->bindParam("nameValue", $nameValue);
                $stmt->bindParam("appointmentId", $appointmentId);
                $stmt->bindParam("patientId", $patientId);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                //return $presMasterData;
       } catch(PDOException $e) {
            echo '{"error111":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error1441":{"text11":'. $e1->getMessage() .'}}'; 
        } 
        
    }
   
    function deleteNonPrescriptionTest($constid){
         $dbConnection = new BusinessHSMDatabase();
        $sql = "delete from consultationdiagnosisdetails where id = $constid";
         $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql); 
             $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;     
    }
    
    
     function insertPrescriptionDiagnosisTranscriptsDetails($patientId,$fileName,$path,$reportType,$appointmentId,$patientname,$reportid,$reportname){

        $dbConnection = new BusinessHSMDatabase();

        try{
         $sql = "INSERT INTO patienttranscripts(patientid,filename,path,reporttype,appointmentid,patientname,reportid,reportname) VALUES(:patientid,:filename,:path,:reporttype,:appointmentid,:patientname,:reportid,:reportname)";   
           // echo $sql;
        $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("patientid", $patientId);
                $stmt->bindParam("filename", $fileName);
                $stmt->bindParam("path", $path);
                $stmt->bindParam("reporttype", $reportType);
                $stmt->bindParam("appointmentid", $appointmentId);
                $stmt->bindParam("patientname", $patientname);
                 $stmt->bindParam("reportid", $reportid);
                  $stmt->bindParam("reportname", $reportname);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                //return $presMasterData;
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        } 
        
    }
    
    
    
     function insertPrescriptionDiagnosisMedicenesDetails($patientId,$medicineName,$mbf,$maf,$abf,$aaf,$ebf,$eaf,$appointmentid,$noofdays,$dosage){
       $dbConnection = new BusinessHSMDatabase();
   $sql =  "INSERT INTO medicines(patientid, medicinename, MBF, MAF, ABF, AAF, EBF, EAF, appointmentid, noofdays,dosage) 
        VALUES (:patientId,:medicineName,:mbf,:maf,:abf,:aaf,:ebf,:eaf,:appointmentid,:noofdays,:dosage)"; 
        try{
            echo $sql;
              $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("patientId", $patientId);
                $stmt->bindParam("medicineName", $medicineName);
                $stmt->bindParam("mbf", $mbf);
                $stmt->bindParam("maf", $maf);
                $stmt->bindParam("abf", $abf);
                $stmt->bindParam("aaf", $aaf);
                $stmt->bindParam("ebf", $ebf);
                $stmt->bindParam("eaf", $eaf);
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->bindParam("noofdays", $noofdays);
                 $stmt->bindParam("dosage", $dosage);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                //return $presMasterData;
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        } 

    } 
  
    
    function todayDoctorAppointments($doctorName){
        
        try{
            
            
              
            $dbConnection = new BusinessHSMDatabase();
            $sql = "SELECT ID,PATIENTNAME,PATIENTID,DOCTORNAME,HOSPITALNAME,APPOINTEMENTDATE,APPOINTMENTTIME,HOSIPTALID,DOCTORID,STATUS FROM appointment WHERE  DOCTORNAME = :doctorname and APPOINTEMENTDATE = CURDATE()";
            
            $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("doctorname", $doctorName);
                $stmt->execute();
                $appointmentPatientDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return $appointmentPatientDetails;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
        
    }
    
      
       
     function fetchConsultationList($patientName,$patientId,$appointmentid,$mobilePatientId){
        
         $dbConnection = new BusinessHSMDatabase();
         $hospitalid = $_SESSION['officeid'];
         try{
             $sql = "SELECT * FROM appointment where (amount is NOT NULL or amount != '') AND ";
             if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
          
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "PatientName LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "id = ?";
                    $params[] = $appointmentid;
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "PatientId = ?";
                    $params[] = $patientuniqueId;
                }
                
 
                $cond[] = "status = ?";
                $params[] = $status;
                
                $cond[] = "HosiptalId = ?";
                $params[] = $hospitalid;
                
                
                if (count($cond)) {
                   // $sql .= ' WHERE ' . implode(' AND ', $cond);
                    $sql .= implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY id ASC";
              //  echo $sql; echo "<br/>";echo "<br/>";
               // print_r($params);echo "<br/>";echo "<br/>";
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
                 
                 return $appointmentDetails;
                 
         } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
     
     
       
     function fetchAppointmentConsultationDetails($appointmentid){
        
         $dbConnection = new BusinessHSMDatabase();
         $hospitalid = $_SESSION['officeid'];
         try{
             $sql = "SELECT * FROM appointment where (amount is NOT NULL or amount != '') AND ";
           
          
                $status = 'Y';
                $cond = array();
                $params = array();


                if ($appointmentid != 'nodata') {
                    $cond[] = "id = ?";
                    $params[] = $appointmentid;
                }
                
               
                $cond[] = "status = ?";
                $params[] = $status;
                
                $cond[] = "HosiptalId = ?";
                $params[] = $hospitalid;
                
                
                if (count($cond)) {
                   // $sql .= ' WHERE ' . implode(' AND ', $cond);
                    $sql .= implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY id ASC";
               // echo $sql; echo "<br/>";echo "<br/>";
               // print_r($params);echo "<br/>";echo "<br/>";
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
                 
                 return $appointmentDetails;
                 
         } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
     
     
     function fetchPregnancyConsultationList($patientName,$patientId,$appointmentid,$mobilePatientId){
        
         $dbConnection = new BusinessHSMDatabase();
         $hospitalid = $_SESSION['officeid'];
         try{
             $sql = "SELECT * FROM appointment  ";
             if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
          
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "PatientName LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "id = ?";
                    $params[] = $appointmentid;
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "PatientId = ?";
                    $params[] = $patientuniqueId;
                }
                
 
                $cond[] = "status = ?";
                $params[] = $status;
                
                $cond[] = "HosiptalId = ?";
                $params[] = $hospitalid;
                
                $cond[] = "pregnancy = ?";
                $params[] = $status;

                if (count($cond)) {
                    $sql .= ' WHERE ' . implode(' AND ', $cond);
                    
                }
                $sql = $sql." ORDER BY id ASC";
                //echo $sql;
               // print_r($params);
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
                 
                 return $appointmentDetails;
                 
         } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
     
     
     
     function fetchChildConsultationList($patientName,$patientId,$appointmentid,$mobilePatientId){
        
         $dbConnection = new BusinessHSMDatabase();
         $hospitalid = $_SESSION['officeid'];
         try{
             $sql = "SELECT * FROM appointment  ";
             if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
          
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "PatientName LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "id = ?";
                    $params[] = $appointmentid;
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "PatientId = ?";
                    $params[] = $patientuniqueId;
                }
                
 
                $cond[] = "status = ?";
                $params[] = $status;
                
                $cond[] = "HosiptalId = ?";
                $params[] = $hospitalid;
                
                $cond[] = "child = ?";
                $params[] = $status;

                if (count($cond)) {
                    $sql .= ' WHERE ' . implode(' AND ', $cond);
                    
                }
                $sql = $sql." ORDER BY id ASC";
                //echo $sql;
                //print_r($params);
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
                 
                 return $appointmentDetails;
                 
         } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
     
     function fetchCallCenterConsultationList($patientName,$patientId,$appointmentid,$mobilePatientId){
        
         $dbConnection = new BusinessHSMDatabase();
        // $hospitalid = $_SESSION['officeid'];
         try{
             $sql = "SELECT * FROM appointment";
             if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
          
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "PatientName LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "id = ?";
                    $params[] = $appointmentid;
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "PatientId = ?";
                    $params[] = $patientuniqueId;
                }
                
 
                $cond[] = "status = ?";
                $params[] = $status;
                
               
                if (count($cond)) {
                    $sql .= ' WHERE ' . implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY id ASC";
                //echo $sql;
                //print_r($params);
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
                 
                 return $appointmentDetails;
                 
         } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     } 
      
   
     
     
     function doctorAppointmentList($doctorId){
         try{
             $dbConnection = new HSMDatabase();
             $db = $dbConnection->getConnection();
             $sql = "SELECT * FROM APPOINTMENT WHERE DOCTORID = :DOCTORID AND APPOINTEMENTDATE = CURDATE()";
             $stmt = $db->prepare($sql);
            $stmt->bindParam("DOCTORID", $doctorId);
            $stmt->execute();
            $doctorAppointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $doctorAppointmentDetails;
             
         } catch (Exception $ex) {

         }
     }
     
   function fetchAppointmentDetails($appointmentid){
       
         $dbConnection = new BusinessHSMDatabase();
         $sql = "select * from appointment where id = :appointmentid";
         //echo $sql;echo $appointmentid;
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->execute();
                $appointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
               
                //$this->fetchPrescriptionTranscripts($appointmentid);
                
                $db = null;
               
                return $appointmentDetails;//$this->fetchPrescriptionTranscripts($appointmentid);
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
       
       
   }  
   
   function fetchPrescriptionDescription($appointmentid){
        $dbConnection = new BusinessHSMDatabase();
         $sql = "select * from prescription where appointmentid = :appointmentid";
         //echo $sql;echo $appointmentid;
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->execute();
                $prescriptionDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
               
                //$this->fetchPrescriptionTranscripts($appointmentid);
                
                $db = null;
               
                return $prescriptionDetails;//$this->fetchPrescriptionTranscripts($appointmentid);
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
   }
   
   function fetchPregnancyPrescriptionDescription($appointmentid){
        $dbConnection = new BusinessHSMDatabase();
         $sql = "select * from pregnancy_prescription where appointmentid = :appointmentid";
         //echo $sql;echo $appointmentid;
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->execute();
                $prescriptionDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
               
                //$this->fetchPrescriptionTranscripts($appointmentid);
                
                $db = null;
               
                return $prescriptionDetails;//$this->fetchPrescriptionTranscripts($appointmentid);
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
   }
     
   function fetchPrescriptionTranscripts($appointmentId){
        $dbConnection = new HSMDatabase();
       $sql = "select * from patienttranscripts where appointmentid = :appointmentid and reporttype = 'Prescription'";
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentId);
                $stmt->execute();
                $transacripts = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                //print_r(json_encode($appointmentPatientTestDetails));
                $_SESSION['transcripts'] = json_encode($transacripts);
                return $transacripts;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
       
   }
      
     function fetchPatientAppointmentSpecificMedicalTestList($appointmentId){
         $dbConnection = new HSMDatabase();
         $sql = "select * from patienttests where appointmentid = :appointmentid";
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentId);
                $stmt->execute();
                $appointmentPatientTestDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return $appointmentPatientTestDetails;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
   
     
     function fetchPatientAppointmentMedicalTestList($appointmentId){
         $dbConnection = new BusinessHSMDatabase();
         $sql = "select l.testname,l.id from consultationdiagnosisdetails c,labtests l where l.id = c.namevalue and c.appointmentid = :appointmentid and c.type = 'MEDICAL TEST'";
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentId);
                $stmt->execute();
                $appointmentPatientTestDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return $appointmentPatientTestDetails;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
  
     
      function fetchPatientAppointmentSpecificMedicalTestDetails($appointmentId){
         $dbConnection = new BusinessHSMDatabase();
         $sql = "select l.testname,l.parametername,t.value  d from patient_tests_details t,labtestsdetails l where t.parameterid = l.id and t.appointmentid = :appointmentid";
     //  echo $sql;
         trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentId);
                $stmt->execute();
                $appointmentPatientTestDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return $appointmentPatientTestDetails;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
   
    function meterreading(){
        
        
         $dbConnection = new HSMDatabase();
         $sql = "select * from meterreading";
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $meterreading = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return $meterreading;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
        
    } 
     
     
   function fetchPrescriptionMedicines($appointmentid){
        $dbConnection = new BusinessHSMDatabase();
         $sql = "select * from medicines where appointmentid = :appointmentid";
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->execute();
                $medicinesDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return $medicinesDetails;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
   }
    
    function fetchPatientAppointmentMedicalTestDetails($testid,$appointmentId){
         $dbConnection = new BusinessHSMDatabase();
         $sql = "select d.parametername,t.value from patient_tests_details t, labtestsdetails d where t.parameterid = d.id and t.appointmentid = :appointmentid and t.testid = :testid";
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("appointmentid", $appointmentId);
                $stmt->bindParam("testid", $testid);
                $stmt->execute();
                $appointmentPatientTestDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return $appointmentPatientTestDetails;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
     
    function fetchPaidNonPrescriptionPatients($patientName,$patientId,$appointmentid,$mobilePatientId){
        
        
     $sql = " select  distinct appointment.id as appointmentid,appointment.* from appointment INNER JOIN consultationdiagnosisdetails ON consultationdiagnosisdetails.appointmentid = appointment.id 
where (labamount is  NULL or labamount = '') and ";//
//AND hosiptalid = 1 and consultationdiagnosisdetails.type = 'MEDICAL TEST'  ORDER BY appointment.id DESC
                 
                 
          $dbConnection = new HSMDatabase();
       //  $sql = "select * from appointment  where (amount is not NULL or amount != '') and ";
        trY{
              if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
                $resultStatus = "";
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "patientname LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "appointmentid = ?";
                    $params[] = $appointmentid;
                    $resultStatus = "Y";
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "appointment.patientid = ?";
                    $params[] = $patientuniqueId;
                    $resultStatus = "Y";
                }
                
 
                $cond[] = "appointment.status = ?";
                $params[] = $status;
                
                $cond[] = "consultationdiagnosisdetails.type = ? ";
                 $params[] = 'MEDICAL TEST';
                         
              /*  $cond[] = "hosiptalid = ?";
                $params[] = $_SESSION['officeid'];
*/
                if (count($cond)) {
                    //$sql .= ' WHERE ' . implode(' AND ', $cond);
                    $sql .= implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY appointment.id DESC";
              // echo $sql;echo "<br/>";
            //   print_r($params);echo "<br/>";
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $paidNonPrescriptionPatient = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
               
                   return $paidNonPrescriptionPatient;
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
       
    }
    
    
    function fetchPaidNonPrescriptionLabPaidPatients($patientName,$patientId,$appointmentid,$mobilePatientId){
        
        
     $sql = " select  distinct appointment.id as appointmentid,appointment.* from appointment INNER JOIN
         consultationdiagnosisdetails ON consultationdiagnosisdetails.appointmentid = appointment.id 
where (labamount is  NOT NULL or labamount != '') and ";//
//AND hosiptalid = 1 and consultationdiagnosisdetails.type = 'MEDICAL TEST'  ORDER BY appointment.id DESC
                 
                 
          $dbConnection = new HSMDatabase();
       //  $sql = "select * from appointment  where (amount is not NULL or amount != '') and ";
        trY{
              if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
                $resultStatus = "";
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "patientname LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "appointmentid = ?";
                    $params[] = $appointmentid;
                    $resultStatus = "Y";
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "appointment.patientid = ?";
                    $params[] = $patientuniqueId;
                    $resultStatus = "Y";
                }
                
 
                $cond[] = "appointment.status = ?";
                $params[] = $status;
                
                $cond[] = "consultationdiagnosisdetails.type = ? ";
                 $params[] = 'MEDICAL TEST';
                         
              /*  $cond[] = "hosiptalid = ?";
                $params[] = $_SESSION['officeid'];
*/
                if (count($cond)) {
                    //$sql .= ' WHERE ' . implode(' AND ', $cond);
                    $sql .= implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY appointment.id DESC";
              //  echo $sql;echo "<br/>";
             //  print_r($params);echo "<br/>";
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $paidNonPrescriptionPatient = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
               
                   return $paidNonPrescriptionPatient;
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
       
    }
     
    function fetchNonPaidPrescription($patientName,$patientId,$appointmentid,$mobilePatientId){
        
          $dbConnection = new HSMDatabase();
         $sql = "select * from appointment  where (amount is NULL or amount = '') and ";
        trY{
              if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
                $resultStatus = "";
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "patientname LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "appointmentid = ?";
                    $params[] = $appointmentid;
                    $resultStatus = "Y";
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "patientid = ?";
                    $params[] = $patientuniqueId;
                    $resultStatus = "Y";
                }
                
 
                $cond[] = "status = ?";
                $params[] = $status;
                
                $cond[] = "hosiptalid = ?";
                $params[] = $_SESSION['officeid'];

                if (count($cond)) {
                    //$sql .= ' WHERE ' . implode(' AND ', $cond);
                    $sql .= implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY id DESC";
                //echo $sql;
                //print_r($params);
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $nonPaidPatientPrescription = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
               
                   return $nonPaidPatientPrescription;
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
        
    } 
    
    function fetchPaidPrescription($patientName,$patientId,$appointmentid,$mobilePatientId){
        
          $dbConnection = new HSMDatabase();
         $sql = "select * from appointment a, prescription p  ";// where status = 'N' and hositpalid = :officeid";
        trY{
              if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
                $resultStatus = "";
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "a.patientname LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "p.appointmentid = ?";
                    $params[] = $appointmentid;
                    $resultStatus = "Y";
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "p.patientid = ?";
                    $params[] = $patientuniqueId;
                    $resultStatus = "Y";
                }
                
 
                $cond[] = "p.status = ?";
                $params[] = $status;
                
                $cond[] = "a.id = p.appointmentid ";
                //$cond[] = "hositpalid = ?";
                //$params[] = $_SESSION['officeid'];

                if (count($cond)) {
                    $sql .= ' WHERE ' . implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY p.id DESC";
               // echo $sql;
                //print_r($params);
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $nonPaidPatientPrescription = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
               
                   return $nonPaidPatientPrescription;
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
        
    } 
    
    
    function fetchPaidLabSampleCollectedPrescription($patientName,$patientId,$appointmentid,$mobilePatientId){
        
          $dbConnection = new HSMDatabase();
         $sql = "select * from appointment a,consultationdiagnosisdetails c  ";// where status = 'N' and hositpalid = :officeid";
        trY{
              if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
                $resultStatus = "";
                $status = 'SC';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "a.patientname LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "a.id = ?";
                    $params[] = $appointmentid;
                    $resultStatus = "Y";
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "a.patientid = ?";
                    $params[] = $patientuniqueId;
                    $resultStatus = "Y";
                }
                
 
                $cond[] = "c.status = ?";
                $params[] = $status;
                
                $cond[] = "a.labamount is not null ";
                 $cond[] = " a.id = c.appointmentid  ";
               
                //$cond[] = "hositpalid = ?";
                //$params[] = $_SESSION['officeid'];

                if (count($cond)) {
                    $sql .= ' WHERE ' . implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY a.id DESC";
            //    echo $sql;
            //   print_r($params);
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $nonPaidPatientPrescription = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
               
                   return $nonPaidPatientPrescription;
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
        
    }
    
    
     function fetchPaidLabPrescription($patientName,$patientId,$appointmentid,$mobilePatientId){
        
          $dbConnection = new HSMDatabase();
         $sql = "select * from appointment a ";// where status = 'N' and hositpalid = :officeid";
        trY{
              if($patientId != "nodata" && $mobilePatientId == "nodata"){
                 $patientuniqueId = $patientId;
            }else if($mobilePatientId != "nodata" && $patientId == "nodata"){
               $patientuniqueId = $mobilePatientId;
            }else{
                
                     $patientuniqueId = $patientId;
            }  
                $resultStatus = "";
                $status = 'Y';
                $cond = array();
                $params = array();

                if ($patientName != 'nodata') {
                    $cond[] = "a.patientname LIKE ?";
                    $params[] = "%".$patientName."%";
                }

                if ($appointmentid != 'nodata') {
                    $cond[] = "a.id = ?";
                    $params[] = $appointmentid;
                    $resultStatus = "Y";
                }
                
               
                
                if ($patientuniqueId != 'nodata') {
                    $cond[] = "a.patientid = ?";
                    $params[] = $patientuniqueId;
                    $resultStatus = "Y";
                }
                
 
                $cond[] = "a.status = ?";
                $params[] = $status;
                
                $cond[] = "a.labamount is not null";
                
               
                //$cond[] = "hositpalid = ?";
                //$params[] = $_SESSION['officeid'];

                if (count($cond)) {
                    $sql .= ' WHERE ' . implode(' AND ', $cond);
                }
                $sql = $sql." ORDER BY a.id DESC";
             //   echo $sql;
             //  print_r($params);
                 $db = $dbConnection->getConnection();
                 $stmt = $db->prepare($sql);
                 $stmt->execute($params);
                 $nonPaidPatientPrescription = $stmt->fetchAll(PDO::FETCH_OBJ);
                 $db = null;
               
                   return $nonPaidPatientPrescription;
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
        
    } 
    
  
   function updateAmount($appointmentid,$amount){
       $sql = "update appointment set status = 'Y',amount = :amount where id = :appointmentid";
       try{
                $dbConnection = new BusinessHSMDatabase();
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->bindParam("amount", $amount);
                $stmt->execute();  
                $db = null;
                //$appointmentid = $this->fetchPrescriptionByPrescriptionId($appointmentid);
                //echo "Appointment id : ".$appointmentid;
                $this->updateDiagnostics($appointmentid);
                $this->updateMedicines($appointmentid);
                return $appointmentid;
         } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            } 
   } 
   
   function updateDiagnostics($appointmentid){
       $sql = "update consultationdiagnosisdetails set status = 'Y' where appointmentid = :appointmentid";
       try{
                $dbConnection = new BusinessHSMDatabase();
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->execute();  
                $db = null;
                //return $updateDetails;
         } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            } 
   } 
   
   
   function updateSampleCollectedInDiagnostics($constid){
      // echo $constid;echo "<br/>";
       $sql = "update consultationdiagnosisdetails set status = 'SC' where id = :id";
      // echo $sql;
       try{
                $dbConnection = new BusinessHSMDatabase();
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("id", $constid);
                $stmt->execute();  
                $db = null;
               // return $updateDetails;
         } catch(PDOException $pdoex) {
             echo $pdoex->getMessage();
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                 echo $ex->getMessage();
                throw new Exception($ex); 
            } 
   } 
 
    function updateMedicines($appointmentid){
       $sql = "update medicines set status = 'Y' where appointmentid = :appointmentid";
       try{
                $dbConnection = new BusinessHSMDatabase();
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("appointmentid", $appointmentid);
                $stmt->execute();  
                $db = null;
               // return $updateDetails;
         } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            } 
   }
   
   function fetchPrescriptionByPrescriptionId($id){
        $dbConnection = new HSMDatabase();
         $sql = "select * from prescription where id = :id";
         //echo $sql;echo $appointmentid;
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("id", $id);
                $stmt->execute();
                $prescriptionDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
               
                $db = null;
               
                return $prescriptionDetails[0]->appointmentid;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
   }
   
   function fetchPrescriptionDataByAppointmentId($id){
       
        $dbConnection = new BusinessHSMDatabase();
         $sql = "select * from prescription where appointmentid = :id";
        // echo $sql;echo $id."Id ";
        trY{
               $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("id", $id);
                $stmt->execute();
                $prescriptionDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
               
                $db = null;
                
                return $prescriptionDetails;
                
                
        } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
       
   }
   
   function fetchAppointmentDoctorPrecritption($appointmentid, $doctorid){
   	$dbConnection = new HSMDatabase();
   	$sql = "select * from prescription as pre inner join consultationdiagnosisdetails as cdd on"
                . " cdd.appointmentid=pre.appointmentid where pre.appointmentid=$appointmentid and pre.doctorid=$doctorid";
   	//echo $sql;echo $appointmentid;
   	try{
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->execute();
   		$prescriptionDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
   		 
   		$db = null;
   		 
   		return $prescriptionDetails;
   
   
   	} catch(PDOException $e) {
   		echo '{"error":{"text":'. $e->getMessage() .'}}';
   	} catch(Exception $e1) {
   		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
   	}
   }
   
   
   function fetchMedicinesList($medicineName){
   	$dbConnection = new HSMDatabase();
   	$sql = "select * from medicineslist where medicinename like '$medicineName%' and status='Y'";
   	//echo $sql;//echo $appointmentid;
   	try{
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->execute();
   		$prescriptionDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
   
   		$db = null;
   
   		return $prescriptionDetails;
   		 
   		 
   	} catch(PDOException $e) {
   		echo '{"error":{"text":'. $e->getMessage() .'}}';
   	} catch(Exception $e1) {
   		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
   	}
   }
   

   function fetchDoctorMedicinesList($medicineName, $doctorId){
   
   	//$doctorId = $_SESSION['userid'];
   
   	$dbConnection = new BusinessHSMDatabase();
   
   	//$sql = "SELECT l.medicinename as name from medicineslist l,medicines_doctor d where l.medicinename '%$medicineName%' d.status = 'Y' and d.doctorid = :doctorId and d.medicine_id = l.id";
   	$sql = "SELECT * from medicineslist l,medicines_doctor d where l.medicinename like '$medicineName%' and d.status = 'Y' and d.doctorid = :doctorId and d.medicine_id = l.id";
   	
   	try {
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->bindParam("doctorId", $doctorId);
   		$stmt->execute();
   		$generalMedicinesList = $stmt->fetchAll(PDO::FETCH_OBJ);
   		$db = null;
   		return ($generalMedicinesList);
   	} catch(PDOException $pdoex) {
   		throw new Exception($pdoex);
   	} catch(Exception $ex) {
   		throw new Exception($ex);
   	}
   }
   
   
   function fetchDiseasesByAppointmentid($appointmentid){
       
       
       $dbConnection = new BusinessHSMDatabase();
       $sql = " select c.* from prescription p,consultationdiagnosisdetails c where c.appointmentid = p.appointmentid and p.appointmentid = :appointmentid
  and c.type IN  ('DISEASES') group by c.namevalue	";
   	try {
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->bindParam("appointmentid", $appointmentid);
   		$stmt->execute();
   		$diseasesList = $stmt->fetchAll(PDO::FETCH_OBJ);
   		$db = null;
   		return ($diseasesList);
   	} catch(PDOException $pdoex) {
   		throw new Exception($pdoex);
   	} catch(Exception $ex) {
   		throw new Exception($ex);
   	}
       
   }
   
   function fetchDiseases(){
        
       $dbConnection = new BusinessHSMDatabase();
       $sql = " select * from diseases 	";
   	try {
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->execute();
   		$diseasesList = $stmt->fetchAll(PDO::FETCH_OBJ);
   		$db = null;
   		return ($diseasesList);
   	} catch(PDOException $pdoex) {
   		throw new Exception($pdoex);
   	} catch(Exception $ex) {
   		throw new Exception($ex);
   	}
       
   }
   
   
   function fetchTestsByAppointmentid($appointmentid){
       
       
       $dbConnection = new BusinessHSMDatabase();
       $sql = "select * from consultationdiagnosisdetails c,labtests l "
               . "where l.id = c.namevalue and c.appointmentid = :appointmentid and c.type = 'MEDICAL TEST'";
   	try {
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->bindParam("appointmentid", $appointmentid);
   		$stmt->execute();
   		$diseasesList = $stmt->fetchAll(PDO::FETCH_OBJ);
   		$db = null;
   		return ($diseasesList);
   	} catch(PDOException $pdoex) {
   		throw new Exception($pdoex);
   	} catch(Exception $ex) {
   		throw new Exception($ex);
   	}
       
   }
   
   function fetchPatientVisit($startDate,$endDate,$hospitalId){
       
        $dbConnection = new BusinessHSMDatabase();
       $sql = "select p.patientname,a.doctorname,p.appointmentdt,a.appointmenttime,a.amount "
               . "from prescription p,appointment a where a.id = p.appointmentid and  "
               . "p.hositpalid = :hospitalid and appointmentdt BETWEEN :startDate and :endDate ;";
   	try {
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->bindParam("startDate", $startDate);
                $stmt->bindParam("endDate", $endDate);
                $stmt->bindParam("hospitalid", $hospitalId);
   		$stmt->execute();
   		$patientList = $stmt->fetchAll(PDO::FETCH_OBJ);
   		$db = null;
   		return ($patientList);
   	} catch(PDOException $pdoex) {
   		throw new Exception($pdoex);
   	} catch(Exception $ex) {
   		throw new Exception($ex);
   	}
       
   }
   
   function fetchPatientVisitByDoctor($startDate,$endDate,$doctorId){
       
        $dbConnection = new BusinessHSMDatabase();
       $sql = "select p.patientname,a.doctorname,p.appointmentdt,a.appointmenttime,a.amount "
               . "from prescription p,appointment a where a.id = p.appointmentid and  "
               . "a.doctorid = :doctorid and appointmentdt BETWEEN :startDate and :endDate ";
   	try {
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->bindParam("startDate", $startDate);
                $stmt->bindParam("endDate", $endDate);
                $stmt->bindParam("doctorid", $doctorId);
   		$stmt->execute();
   		$patientList = $stmt->fetchAll(PDO::FETCH_OBJ);
   		$db = null;
   		return ($patientList);
   	} catch(PDOException $pdoex) {
   		throw new Exception($pdoex);
   	} catch(Exception $ex) {
   		throw new Exception($ex);
   	}
       
   }
  
   function createDummyPrescription($appointmentId){
        
        $dbConnection = new BusinessHSMDatabase();
        $db = $dbConnection->getConnection();
          
        $fetchAppointmentData = $this->fetchConsultationList('nodata','nodata',$appointmentId,'nodata');
        
        $sql = "INSERT INTO  prescription (appointmentid,patientid,patientname,description,doctorid,hositpalid,appointmentdt,nextappointmentdt,medicalshop)
        VALUES (:appointmentId, :patientid, :patientname, :description, :doctorid, :hositpalid, :appointmentdt, :nextappointmentdt,:medicalshop)";
      // echo $sql; echo "<br/>"; 
     // echo "SQL DATE : .".$nextappointmentdt;
        try{
              $dummyData = "-";
              $dummyDate = '0000-00-00';
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("appointmentId", $appointmentId);
                $stmt->bindParam("patientid", $fetchAppointmentData[0]->PatientId);
                $stmt->bindParam("patientname", $fetchAppointmentData[0]->PatientName);
                $stmt->bindParam("description", $dummyData);
                $stmt->bindParam("doctorid", $fetchAppointmentData[0]->DoctorId);
                $stmt->bindParam("hositpalid", $fetchAppointmentData[0]->HosiptalId);
                $stmt->bindParam("appointmentdt", $fetchAppointmentData[0]->AppointementDate);
                $stmt->bindParam("nextappointmentdt", $dummyDate);
                $stmt->bindParam("medicalshop", $dummyData);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
              //echo $stmt->debugDumpParams();
                $db = null;
                return $presMasterData;
        } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    function fetchMedicinesForPatient($patientId)
    {  
        $dbConnection = new BusinessHSMDatabase();       
       $sql = "select a.id, a.appointementdate, a.DoctorName, a.HospitalName, m.medicinename,a.patientname,"
               . "m.dosage, m.MBF, m.MAF, m.ABF, m.AAF, m.EBF, m.EAF, m.noofdays,m.id as medicineid from appointment a "
               . "inner join medicines m on a.id = m.appointmentid where m.patientid = :patientId group by a.id, "
               . "a.appointementdate, a.DoctorName, a.HospitalName, m.medicinename, m.dosage, m.MBF, m.MAF, "
               . "m.ABF, m.AAF, m.EBF, m.EAF, m.noofdays ";
   	try {
   		$db = $dbConnection->getConnection();
   		$stmt = $db->prepare($sql);
   		$stmt->bindParam("patientId", $patientId);                
   		$stmt->execute();
   		$medicineList = $stmt->fetchAll(PDO::FETCH_OBJ);
   		$db = null;
   		return ($medicineList);
   	} catch(PDOException $pdoex) {
   		throw new Exception($pdoex);
   	} catch(Exception $ex) {
   		throw new Exception($ex);
   	}
    }
   
    function insertIntoDoctorReferral($patientid,$doctorid,$hospitalid){
        
         $dbConnection = new BusinessHSMDatabase();
         $db = $dbConnection->getConnection();
       try{ 
         $sql = "insert into patient_referral(patientid,doctorid,hospitalid,status,referraldate) values(:patientid,:doctorid,:hospitalid,'Y',CURDATE())";
         $stmt = $db->prepare($sql);  
               
                $stmt->bindParam("patientid", $patientid);
                $stmt->bindParam("doctorid", $doctorid);
                $stmt->bindParam("hospitalid", $hospitalid);
                $stmt->execute();  
                $presMasterData = $db->lastInsertId();
                   $db = null;
                return $presMasterData;
        } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
   
    
    
     function fetchPatient($hosiptal,$doctor,$appdate){
        $dbConnection = new HSMDatabase();
       
       $sql = "SELECT * from appointment where DoctorId =:doctor and HosiptalId = :hosiptal and AppointementDate  = :appdate ";
            try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("doctor", $hosiptal);
                $stmt->bindParam("hosiptal", $doctor);
                $stmt->bindParam("appdate", $appdate);
               // print_r($stmt);
                $stmt->execute();
                $appoiontmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               
                return ($appoiontmentDetails);



            } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            } 
        
    }
    
    function updateAppointmentWithLabPrice($appointmentId,$amount){
        
           $dbConnection = new BusinessHSMDatabase();
            $sql = "update appointment set labamount = :amount where id =:id";
        try{
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);  
                $stmt->bindParam("id", $appointmentId);
                 $stmt->bindParam("amount", $amount);
                $stmt->execute();  
                $db = null;
                return $appointmentId;
         } catch(PDOException $pdoex) {
                throw new PDOException($pdoex); 
            } catch(Exception $ex) {
                throw new Exception($ex); 
            }   
        
    }
             //($hospital, $doctor, $appointmentdate, $slot, $patientid, 'Y', $patientInfo[0]->name, $appointmentType,$amount)
     function createCallCenterOldAppointment($hosiptal,$doctor,$appdate,$slot,$pid,$status,$pname,$appointmentType){
            $email = new AppointmentEmail();
             $dbConnection = new BusinessHSMDatabase();
            try{
                $pname = $this->userMasterData($pid);
               $hname = $this->getHosiptalName($hosiptal);
              // $dname = $this->userMasterData($doctor);
              //print($pname[0]->name);
            //    print($hname[0]->hosiptalname);
            
             //echo "Hello";
           //    echo (is_numeric($doctor));
             if(is_numeric($doctor)){
             //    echo "In If";
                 $dname = $this->userMasterData($doctor);
                 $doctorName = $dname[0]->name;
                 $doctorId = $doctor;
               } else {
               //     echo "In Else";
                   $doctorName = "Self";
                   $doctorId = "0";
               }
                //print($dname[0]->name);
                $Yes = 'Y';
                $No = 'N';
                if(strlen($hname[0]->hosiptalname) < 1)
                    $hospitalName = $_SESSION['logeduser'];
                else {
                    $hospitalName = $hname[0]->hosiptalname;
                }
              //  echo "Doctor ID : ".$doctorId;
               // echo "Doctor Name : ".$doctorName;
             $sql = "INSERT INTO appointment(DoctorId, AppointementDate, AppointmentTime,status,PatientId,HosiptalId,PatientName,
                 HospitalName,DoctorName,pregnancy,child,createdate)
             VALUES (:doctor,:appdate,:slot,:status,:pid,:hosiptal,:pname,:hname,:dname,:pregnancy,:child,CURDATE())";    
            $db = $dbConnection->getConnection();
            $stmt = $db->prepare($sql);  
            $stmt->bindParam("doctor", $doctorId);
            $stmt->bindParam("appdate", $appdate);
            $stmt->bindParam("slot", $slot);
            $stmt->bindParam("status",$status);
            $stmt->bindParam("pid", $pid);
            $stmt->bindParam("hosiptal", $hosiptal);
            $stmt->bindParam("pname", $pname[0]->name);
            $stmt->bindParam("hname",$hospitalName);
            $stmt->bindParam("dname", $doctorName);   
            if($appointmentType == "Pregnancy")
                $stmt->bindParam("pregnancy",$Yes);
            else 
                $stmt->bindParam("pregnancy",$No);
            if($appointmentType == "Child")
                $stmt->bindParam("child",$Yes);
            else 
                $stmt->bindParam("child",$No);
            $stmt->execute();
            $appointment = $db->lastInsertId();
            $db = null;
            //echo $stmt->debugDumpParams(); 
            return $appointment; 
            
            $email->sendMail($doctorName,$hname[0]->hosiptalname,$pname[0]->name,$appdate,$slot,$pid);
                    
            } catch(PDOException $pdoex) {
              echo "Exception in Appointment : ".$pdoex->getMessage()." Line Number : ".$pdoex->getLine();
              //  throw new Exception($pdoex);
              echo $pdoex->getFile();
              
             } catch(Exception $ex) {
                 echo "Exception in Appointment : ".$ex->getMessage()." Line Number : ".$ex->getLine();
                //throw new Exception($ex);
                 echo $ex->getFile();
             } 
        
    }
    
    
    function fetchPastAppointmentList($userId, $date){
         try{
             $dbConnection = new HSMDatabase();
             $db = $dbConnection->getConnection();
             $sql = "SELECT * FROM appointment WHERE PatientId = :userId AND APPOINTEMENTDATE < :appointementDate";
             $stmt = $db->prepare($sql);
            $stmt->bindParam("userId", $userId);
            $stmt->bindParam("appointementDate", $date);
            $stmt->execute();
            $pastAppointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $pastAppointmentDetails;
             
         } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }

     function fetchUpcomingAppointmentList($userId, $date){
         try{
             $dbConnection = new HSMDatabase();
             $db = $dbConnection->getConnection();
             $sql = "SELECT * FROM appointment WHERE PatientId = :userId AND APPOINTEMENTDATE > :appointementDate";
             $stmt = $db->prepare($sql);
            $stmt->bindParam("userId", $userId);
            $stmt->bindParam("appointementDate", $date);
            $stmt->execute();
            $pastAppointmentDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;

            return $pastAppointmentDetails;
             
         } catch(PDOException $e) {
                echo '{"error":{"text":'. $e->getMessage() .'}}'; 
        } catch(Exception $e1) {
            echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
        }
     }
     
     
      function getUnMapDoctorMedicinData(){
     	$db = new BusinessHSMDatabase();
     	//$sql = "select * from medicineslist where id = $medicineId";
     	//$sql = "SELECT med.id,med.company,med.medicinename,med.technicalname,med.medicinetype,med.strength,med.units FROM medicineslist med LEFT JOIN medicines_doctor ON  medicines_doctor.medicine_id = med.id WHERE medicines_doctor.medicine_id IS NULL ORDER BY id DESC";
     	$sql = "SELECT *  FROM medicineslist med WHERE med.id NOT IN (SELECT medicine_id FROM medicines_doctor)";
        
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$medicalDetails = $stmt->fetchAll(PDO::FETCH_OBJ);
                  //   print_r($medicalDetails);
     		$db = null;
     		return $medicalDetails;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
      function insertDiscountInformation($instid,$discamount,$cgsdiscount,$actualamount,$paidamount,$appointmentid){
       
         
     	$dbConnection = new BusinessHSMDatabase();
     	$sql = "INSERT INTO  discountapplied (endid,discpercent,cgsdiscount,actuallamount,paidamount,appointmentid,createddate)
     	VALUES('$instid', '$discamount', '$cgsdiscount',$actualamount,$paidamount,$appointmentid,SYSDATE())";
       // echo $sql;
     	try{
     		$db = $dbConnection->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$insertedId = $db->lastInsertId();
     		 
     		$db = null;
     		return $insertedId;
     		 
     	} catch(PDOException $e) {
     		echo '{"error":{"text":'. $e->getMessage() .'}}';
     	} catch(Exception $e1) {
     		echo '{"error11":{"text11":'. $e1->getMessage() .'}}';
     	}
     
     }
     
     
     
 function fetchDiscountData($start,$end){
     	$db = new BusinessHSMDatabase();
     	//$sql = "select * from medicineslist where id = $medicineId";
     	//$sql = "SELECT med.id,med.company,med.medicinename,med.technicalname,med.medicinetype,med.strength,med.units FROM medicineslist med LEFT JOIN medicines_doctor ON  medicines_doctor.medicine_id = med.id WHERE medicines_doctor.medicine_id IS NULL ORDER BY id DESC";
      $miniSql = "d.createddate = SYSDATE()";
        if($start == "" && $end == "")
            $miniSql = "d.createddate BETWEEN DATE_SUB(SYSDATE(), INTERVAL 7 DAY) AND SYSDATE()";
        else {
           $miniSql = "d.createddate > '$start' and d.createddate < '$end' ";
        }
        $sql = "select d.id, diag.diagnosticsname , sum(d.actuallamount)as actualamount,sum(d.paidamount) as paidamount,
sum(d.actuallamount-d.paidamount) as discountamount from discountapplied d , appointment a,diagnostics diag where a.id = d.appointmentid and 
diag.id = d.endid and $miniSql group by d.endid,d.createddate";
   // echo $sql;    
     	try {
     		$db = $db->getConnection();
     		$stmt = $db->prepare($sql);
     		$stmt->execute();
     		$discountData = $stmt->fetchAll(PDO::FETCH_OBJ);
                  //   print_r($medicalDetails);
     		$db = null;
     		return $discountData;
     		 
     	} catch(PDOException $e) {
     	} catch(Exception $e1) {
     		//    $response = Slim::getInstance()->response();
     	}
     }
     
}
//consultationdiagnosisdetails