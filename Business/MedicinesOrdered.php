<?php
include_once 'BusinessHSMDatabase.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MedicinesOrdered
 *
 * @author pkumarku
 */
class MedicinesOrdered {
    
     function updateMedicineDispatchStatus($orderId,$price,$status){
        
       /*  echo "Start ".$medicalshopname."<br/>";
        echo "end ".$medicalshopid."<br/>";
        echo "name ".$patientid."<br/>";
        echo "mobiel ".$status."<br/>";
        */
       try{ 
            $dbConnection = new BusinessHSMDatabase();
           $db = $dbConnection->getConnection(); 
           
        $sql = "update medicines_ordered set status = :status ,dispatchdate = CURDATE(), price = :price   where id = :orderid";
          
           $stmt = $db->prepare($sql);  
          
           //echo "Hello ";
            $stmt->bindParam("status", $status); //   echo "Hello ";
            $stmt->bindParam("price", $price);
            $stmt->bindParam("orderid", $orderId);  
            $stmt->execute();
           // var_dump($stmt);
           
              } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function updateOrderStatus($patientid,$medicalshopid,$medicalshopname,$status){
        
       /*  echo "Start ".$medicalshopname."<br/>";
        echo "end ".$medicalshopid."<br/>";
        echo "name ".$patientid."<br/>";
        echo "mobiel ".$status."<br/>";
        */
       try{ 
            $dbConnection = new BusinessHSMDatabase();
           $db = $dbConnection->getConnection(); 
           
        $sql = "update medicines_ordered set status = :status , medicalshopid = :shopid ,redirecteddate = CURDATE(), medicalshopname = :shopname where patientid = :patientid";
          
           $stmt = $db->prepare($sql);  
          
             $stmt->bindParam("patientid", $patientid);    //echo "Hello ";
            $stmt->bindParam("status", $status); //   echo "Hello ";
            $stmt->bindParam("shopid", $medicalshopid);
            $stmt->bindParam("shopname", $medicalshopname);  
            $stmt->execute();
           // var_dump($stmt);
           
              } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
     function medicineOrdered($patientid,$appointmentid,$medicinename,$doctorname,$doctorid,$orderedvalue){
        try{
        $sql = "INSERT INTO medicines_ordered( patientid, appointmentid, medicinename, "
                . " orderdate,doctorname,doctorid,quantity) VALUES (:patientid, :appointmentid, :medicinename, "
                . " CURDATE(),:doctorname,:doctorid,:quantity)";
          $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
          
             $stmt->bindParam("patientid", $patientid);    //echo "Hello ";
            $stmt->bindParam("appointmentid", $appointmentid); //   echo "Hello ";
            $stmt->bindParam("medicinename", $medicinename);
            $stmt->bindParam("doctorname", $doctorname);   
           $stmt->bindParam("doctorid", $doctorid); 
           $stmt->bindParam("quantity", $orderedvalue); 
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
        
          } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
     function nonPrescriptionMedicineOrdered($patientid,$medicinename,$orderedvalue){
        try{
        $sql = "INSERT INTO medicines_ordered( patientid, medicinename, "
                . " orderdate,quantity) VALUES (:patientid, :medicinename, "
                . " CURDATE(),:quantity)";
          $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
          
             $stmt->bindParam("patientid", $patientid);    //echo "Hello ";
            $stmt->bindParam("appointmentid", $appointmentid); //   echo "Hello ";
            $stmt->bindParam("medicinename", $medicinename);
           $stmt->bindParam("quantity", $orderedvalue); 
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
        
          } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
     function mobileNonPrescriptionMedicineOrdered($patientid,$medicinename,$orderedvalue){
        try{
        $sql = "INSERT INTO medicines_ordered( patientid, medicinename, "
                . " orderdate,quantity) VALUES (:patientid, :medicinename, "
                . " CURDATE(),:quantity)";
          $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection(); 
           $stmt = $db->prepare($sql);  
          
             $stmt->bindParam("patientid", $patientid);    //echo "Hello ";
            //$stmt->bindParam("appointmentid", $appointmentid); //   echo "Hello ";
            $stmt->bindParam("medicinename", $medicinename);
           $stmt->bindParam("quantity", $orderedvalue); 
            $stmt->execute();
            
            $finalUser= $db->lastInsertId();
       // echo "Final User..............".$finalUser;
          } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function medicalShopSpecificOrder($medicalShopId,$patientid){
        $sql = "select  u.name,u.address,u.mobile,m.* from medicines_ordered m,users u where m.medicalshopid = :shopid and m.status = 'A' and m.patientid = u.ID  and patientid = :patientid";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("shopid", $medicalShopId);
                 $stmt->bindParam("patientid", $patientid);
                $stmt->execute();
                $orderData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
             
                return $orderData;



           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    function fetchOrders($orderid){
        
        $sql = "select distinct u.name,m.* from medicines_ordered m,users u where m.patientid = :orderid and m.status = 'N' and m.patientid = u.ID ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("orderid", $orderid);
                $stmt->execute();
                $orderData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
             
                return $orderData;



           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function fetchPatientData($startDate,$endDate,$patientname,$mobile){
        /*echo "Start ".$startDate."<br/>";
        echo "end ".$endDate."<br/>";
        echo "name ".$patientname."<br/>";
        echo "mobiel ".$mobile."<br/>";*/
        $sql = "select  distinct u.name,m.id,u.mobile,u.ID,u.address,m.doctorname"
                . " from medicines_ordered m , users u where  u.id = m.patientid and ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                    $cond = array();
                    $params = array();
                    if ($patientname != 'nodata') {
                        $cond[] = "u.name LIKE ? ";
                        $params[] = "%".$patientname."%";
                    }  
                      
                     if ($mobile != 'nodata') {
                            $cond[] = "u.mobile = ? ";
                            $params[] = $mobile;
                        }    
                    
                       $cond[] = "m.status = ?";
                        $params[] = 'N';
                       
                     if($startDate != 'nodata' && $endDate != 'nodata'){
                           $cond[] = "m.orderdate >= ? ";
                            $params[] = $startDate;
                            
                            $cond[] = "m.orderdate <= ? ";
                            $params[] = $endDate;
                     }   
                        
                       if (count($cond)) {
                           $sql .=  implode(' and ', $cond);
                       }
                          $db = $dbConnection->getConnection();
                         // echo $sql;
                         // print_r($params);
                          $stmt = $db->prepare($sql);
                          $stmt->execute($params);
                          $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);   
                        
                     return   $userDetails; 
                   } catch(PDOException $pdoex) {
                    throw new Exception($pdoex);
                } catch(Exception $ex) {
                    throw new Exception($ex);
                } 
    }
    
    
     function fetchMedicalShopPatientData($startDate,$endDate,$patientname,$mobile,$shopid){
       /* echo "Start ".$startDate."<br/>";
        echo "end ".$endDate."<br/>";
        echo "name ".$patientname."<br/>";
        echo "mobiel ".$mobile."<br/>";
         echo "shopid ".$shopid."<br/>";*/
        $sql = "select  distinct u.name,m.id,u.mobile,u.ID,u.address,m.doctorname"
                . " from medicines_ordered m , users u where  u.id = m.patientid and ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                    $cond = array();
                    $params = array();
                    if ($patientname != 'nodata') {
                        $cond[] = "u.name LIKE ? ";
                        $params[] = "%".$patientname."%";
                    }  
                      
                     if ($mobile != 'nodata') {
                            $cond[] = "u.mobile = ? ";
                            $params[] = $mobile;
                        }    
                    
                       $cond[] = "m.status = ?";
                        $params[] = 'A';
                        
                      $cond[] = "m.medicalshopid = ?";
                        $params[] = $shopid;
                        
                     if($startDate != 'nodata' && $endDate != 'nodata'){
                           $cond[] = "m.orderdate >= ? ";
                            $params[] = $startDate;
                            
                            $cond[] = "m.orderdate <= ? ";
                            $params[] = $endDate;
                     }   
                        
                       if (count($cond)) {
                           $sql .=  implode(' and ', $cond);
                       }
                          $db = $dbConnection->getConnection();
                         // echo $sql;
                         // print_r($params);
                          $stmt = $db->prepare($sql);
                          $stmt->execute($params);
                          $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);   
                        
                     return   $userDetails; 
                   } catch(PDOException $pdoex) {
                    throw new Exception($pdoex);
                } catch(Exception $ex) {
                    throw new Exception($ex);
                } 
    }
    
    
    
    function medicineDispatched($patientid,$medicalshopid,$status,$price){
        
       /*  echo "Start ".$medicalshopname."<br/>";
        echo "end ".$medicalshopid."<br/>";
        echo "name ".$patientid."<br/>";
        echo "mobiel ".$status."<br/>";
        */
       try{ 
            $dbConnection = new BusinessHSMDatabase();
           $db = $dbConnection->getConnection(); 
           
        $sql = "update medicines_ordered set status = :status , medicalshopid = :shopid ,"
                . " price = :price where patientid = :patientid";
          
           $stmt = $db->prepare($sql);  
          
             $stmt->bindParam("patientid", $patientid);    //echo "Hello ";
            $stmt->bindParam("status", $status); //   echo "Hello ";
            $stmt->bindParam("shopid", $medicalshopid);
            $stmt->bindParam("shopname", $medicalshopname);  
            $stmt->execute();
           // var_dump($stmt);
           
              } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
    function fetchOrdersStatusforPatient($patientid){
        
        $sql = "select distinct u.name,m.* from medicines_ordered m,users u where m.patientid = :patientid and m.status != 'O'  and m.patientid = u.ID ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->bindParam("patientid", $patientid);
                $stmt->execute();
                $orderData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
             
                return $orderData;



           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function orderclosed($patientid,$orderid,$comments,$fav){
        
        try{ 
            $dbConnection = new BusinessHSMDatabase();
           $db = $dbConnection->getConnection(); 
           
        $sql = "update medicines_ordered set status = 'O' ,receiveddate = CURDATE(), comments = :comments,rating = :rating   where id = :orderid";
          
           $stmt = $db->prepare($sql);  
          
           //echo "Hello ";
            //   echo "Hello ";
            $stmt->bindParam("comments", $comments);
            $stmt->bindParam("orderid", $orderid); 
            $stmt->bindParam("rating", $fav);
            
            $stmt->execute();
           // var_dump($stmt);
           
              } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
    function fetchPatientSpecificOrders($patientid){
        
         $sql = "select  u.name,u.address,u.mobile,m.* from medicines_ordered m,users u where  m.status != 'O' and m.patientid = u.ID  and patientid = :patientid";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                 $stmt->bindParam("patientid", $patientid);
                $stmt->execute();
                $orderData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
             
                return $orderData;



           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
     function fetchAllMedicinesOrdered($startDate,$endDate,$patientname,$mobile){
       /* echo "Start ".$startDate."<br/>";
        echo "end ".$endDate."<br/>";
        echo "name ".$patientname."<br/>";
        echo "mobiel ".$mobile."<br/>";
         echo "shopid ".$shopid."<br/>";*/
        $sql = "select  distinct u.name,m.id,u.mobile,u.ID,"
                . "case m.status
                    when 'A' then 'Assigned'
                    when 'O' then 'Closed'
                     when 'N' then 'Not Assigned'
                    end as status"
                . ",m.medicalshopname,m.dispatchdate,m.doctorname"
                . " from medicines_ordered m , users u where  u.id = m.patientid and ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                    $cond = array();
                    $params = array();
                    if ($patientname != 'nodata') {
                        $cond[] = "u.name LIKE ? ";
                        $params[] = "%".$patientname."%";
                    }  
                      
                     if ($mobile != 'nodata') {
                            $cond[] = "u.mobile = ? ";
                            $params[] = $mobile;
                        }    
                    
                       
                     if($startDate != 'nodata' && $endDate != 'nodata'){
                           $cond[] = "m.orderdate >= ? ";
                            $params[] = $startDate;
                            
                            $cond[] = "m.orderdate <= ? ";
                            $params[] = $endDate;
                     }   
                        
                       if (count($cond)) {
                           $sql .=  implode(' and ', $cond);
                       }
                          $db = $dbConnection->getConnection();
                          //echo $sql;
                         // print_r($params);
                          $stmt = $db->prepare($sql);
                          $stmt->execute($params);
                          $userDetails = $stmt->fetchAll(PDO::FETCH_OBJ);   
                        
                     return   $userDetails; 
                   } catch(PDOException $pdoex) {
                    throw new Exception($pdoex);
                } catch(Exception $ex) {
                    throw new Exception($ex);
                } 
    }
    
}
