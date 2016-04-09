<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OfficeSettings
 *
 * @author pkumarku
 */

include_once 'BusinessHSMDatabase.php';

class OfficeSettings {
    
    
    function fetchTaxSettings($officeid){
        $sql = "select * from tax where officeid = 1 and status = 'Y' ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $taxData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $taxData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
     function fetchOperationSettings($officeid){
         if($officeid == "")
             $officeid = "1";
        $sql = "select * from hosoperations where officeid = $officeid and status = 'Y' ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $hospitalData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
             
                return $hospitalData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    function fetchChargesSettings($officeid){
        $sql = "select * from extracharges where officeid = 1 and status = 'Y' ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $chargeData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $chargeData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    function fetchWardSettings($officeid){
        if($officeid == "")
            $officeid = "1";
        $sql = "select * from ward where officeid = $officeid and status = 'Y' ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $chargeData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
              //  print_r($chargeData);
                return $chargeData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    function fetchWardDetailsSettings($officeid){
        $sql = "select wd.* from wards_details wd,ward w where w.id = wd.wardid and w.status = 'Y' and w.officeid = $officeid and wd.occupancy = '0' ";
       // echo $sql;
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $chargeData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $chargeData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
     function fetchRoomSettings($officeid){
         if($officeid == "")
             $officeid ="1";
         
        $sql = "select * from rooms where officeid = $officeid and status = 'Y' ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $roomData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
     function fetchRoomDetailsSettings($officeid){
          $sql = "select rd.* from rooms_details rd,rooms r where r.id = rd.roomid and r.status = 'Y' and r.officeid = $officeid and rd.occupancy = '0' ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                return $roomData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
     function fetchRoomTypeSettings($officeid){
          if($officeid == "")
             $officeid ="1";
        $sql = "select * from roomtype where officeid = $officeid and status = 'Y' ";
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $roomData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    
     function fetchRoomTypeSettingsById($roomid){
          
        $sql = "select id,roomtype from roomtype where id = $roomid and status = 'Y' ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $roomData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
     function fetchServicesSettings($officeid){
        $sql = "select hs.*,hst.servicetypename as servicetypename from hosservices hs, hosservicestype hst where hst.id = hs.servicetype "
                . "and hs.officeid = 1 and hs.status = 'Y' ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $servicesData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $servicesData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
      function fetchServicesTypeSettings($officeid){
        $sql = "select * from hosservicestype where officeid = 1 and status = 'Y' ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $servicesTypeData = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
               // print_r($taxData);
                return $servicesTypeData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
        
    }
    
    function insertNewTaxSettings($taxInfo,$officeid){
        $userid  = $_SESSION['logeduser'];
     
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
        $sql = "insert into tax(taxname,taxdesc,taxrate,status,createddate,createdby,officeid) values('$taxInfo->taxname','$taxInfo->taxdesc',"
                . "'$taxInfo->taxrate',"
                . " 'Y',CURDATE(),'$userid',$officeid)";
        
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $taxData = $db->lastInsertId();
                $db = null;
               // print_r($taxData);
              //  return $taxData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
    function insertNewOperationsSettings($operationInfo,$officeid){
        $userid  = $_SESSION['logeduser'];
     
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
        $sql = "insert into hosoperations(operationname,Department,status,createddate,createdby,officeid,operationcost)"
                . " values('$operationInfo->operationname','$operationInfo->department',"
                
                . " 'Y',CURDATE(),'$userid',$officeid,'$operationInfo->operationcost')";
        
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $operationData = $db->lastInsertId();
                $db = null;
               // print_r($taxData);
               return $operationData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
     function insertNewChargeSettings($chargeInfo,$officeid){
        $userid  = $_SESSION['logeduser'];
       // var_dump($chargeInfo);
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
        
         
        $sql = "insert into extracharges(chargename,chargetype,chargebleamount,status,createddate,createdby,officeid,discount) "
                . "values('$chargeInfo->chargename','$chargeInfo->chargetype',"
                . "'$chargeInfo->chargebleamount',"
                . " 'Y',CURDATE(),'$userid',$officeid,'$chargeInfo->discount')";
        
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $chargeData = $db->lastInsertId();
                $db = null;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
     function insertNewServicesSettings($servicesInfo,$officeid){
        $userid  = $_SESSION['logeduser'];
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
      //  var_dump($servicesInfo);
         
        $sql = "insert into hosservices(servicesname,servicetype,subservicename,status,createddate,createdby,officeid,servicecost) "
                . "values('$servicesInfo->servicesname',$servicesInfo->servicetype,"
                . "'$servicesInfo->subservicename',"
                . " 'Y',CURDATE(),'$userid',$officeid,'$servicesInfo->servicecost')";
     //   echo $sql;
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $servicesData = $db->lastInsertId();
                $db = null;
                return $servicesData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
     function insertNewWardSettings($wardInfo,$officeid){
        $userid  = $_SESSION['logeduser'];
       // var_dump($chargeInfo);
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
        
         
        $sql = "insert into ward(wardname,wardtype,bedscount,status,createddate,createdby,officeid,discount,bedcost) "
                . "values('$wardInfo->wardname','$wardInfo->wardtype',"
                . "'$wardInfo->bedscount',"
                . " 'Y',CURDATE(),'$userid',$officeid,'$wardInfo->discount','$wardInfo->bedcost')";
        
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $wardData = $db->lastInsertId();
                $db = null;
                $this->createWardList($wardInfo->bedscount, $wardInfo->wardname, $wardData, $userid);
                return $wardData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
     function insertNewRoomSettings($roomInfo,$officeid){
        $userid  = $_SESSION['logeduser'];
      //  var_dump($roomInfo);
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
        //echo $officeid;
         
        $sql = "insert into rooms(roomname,roomtype,totalrooms,status,createddate,createdby,officeid,discount,roomcost) "
                . "values('$roomInfo->roomname','$roomInfo->roomtype',"
                . "'$roomInfo->totalrooms',"
                . " 'Y',CURDATE(),'$userid',$officeid,'$roomInfo->discount','$roomInfo->roomcost')";
        
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $db->lastInsertId();
                $db = null;
                $this->createRoomsList($roomInfo->totalrooms, $roomInfo->roomname, $roomData, $userid,$roomInfo->roomtype);
                return $roomData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
    function createRoomsList($roomscount,$roomname,$roomid,$userid,$roomtype){
        
         if($userid == "")
            $userid = "Admin";
          $dbConnection = new BusinessHSMDatabase();
           $db = $dbConnection->getConnection();
           
          $result =  $this->fetchRoomTypeSettingsById($roomtype);
           
        for($i=1;$i<$roomscount+1;$i++){
            $roomnumber = $result[0]->roomtype."-".$roomname."-".$i;
            
            $sql = "insert into rooms_details(roomid,status,createddate,createdby,room_name) "
                . "values($roomid,"
                . " 'Y',CURDATE(),'$userid','$roomnumber')";
        
                  try {
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $roomDetailsData = $db->lastInsertId();
                       
                   } catch(PDOException $e) {
                        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
                } catch(Exception $e1) {
                        echo '{"error111":{"text111":'. $e1->getMessage() .'}}'; 
                } 
                
        }
      $db = null;
   return $roomDetailsData;       
    }
    
    
     function deleteRoomsDetails($roomid){
         $sql = "delete from rooms_details  where roomid = $roomid "; 
      // echo $sql;
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $taxData = $db->lastInsertId();
                $db = null;
               // print_r($taxData);
              //  return $taxData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function deleteOperationsDetails($operationid){
         $sql = "delete from hosoperations  where id = $operationid "; 
      // echo $sql;
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $operationData = $db->lastInsertId();
                $db = null;
               // print_r($taxData);
                return $operationData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function createWardList($wardcount,$wardname,$wardid,$userid){
        
        
         if($userid == "")
            $userid = "Admin";
         $dbConnection = new BusinessHSMDatabase();
          $db = $dbConnection->getConnection();
        for($i=1;$i<$wardcount+1;$i++){
            $wardnumber = $wardname."-".$i;
            $sql = "insert into wards_details(wardid,status,createddate,createdby,ward_name) "
                . "values($wardid,"
                . " 'Y',CURDATE(),'$userid','$wardnumber')";
        
                
                  try {
                       
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $roomDetailsData = $db->lastInsertId();
                       
                   } catch(PDOException $e) {
                        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
                } catch(Exception $e1) {
                        echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
                } 
        }
       $db = null;
       return $roomDetailsData;      
    }
    
    function deleteWardDetails($wardid){
         $sql = "delete from wards_details  where wardid = $wardid "; 
      // echo $sql;
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $taxData = $db->lastInsertId();
                $db = null;
               // print_r($taxData);
              //  return $taxData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
    
     function insertNewRoomTypeSettings($roomTypeInfo,$officeid){
        $userid  = $_SESSION['logeduser'];
       // var_dump($chargeInfo);
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
        
         
        $sql = "insert into roomtype(roomtype,status,createddate,createdby,officeid) "
                . "values('$roomTypeInfo->roomtype',"
                . " 'Y',CURDATE(),'$userid',$officeid)";
        
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $db->lastInsertId();
                $db = null;
                return $roomData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
     function insertNewServicesTypeSettings($servicesTypeInfo,$officeid){
        $userid  = $_SESSION['logeduser'];
       // var_dump($chargeInfo);
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
        
         
        $sql = "insert into hosservicestype(servicetypename,status,createddate,createdby,officeid) "
                . "values('$servicesTypeInfo->servicetypename',"
                . " 'Y',CURDATE(),'$userid',$officeid)";
        
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $servicesTypeData = $db->lastInsertId();
                $db = null;
                return $servicesTypeData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
     function deleteNewTaxSettings($taxid){
       
        $sql = "update tax set status = 'N' where id = $taxid "; 
      // echo $sql;
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $taxData = $db->lastInsertId();
                $db = null;
               // print_r($taxData);
              //  return $taxData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
   function deleteNewOperationsSettings($operationid){
       
        $sql = "update hosoperations set status = 'N' where id = $operationid "; 
      // echo $sql;
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $operationData = $db->lastInsertId();
                $db = null;
               // print_r($taxData);
                return $operationData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
      function deleteNewChargeSettings($chargeid){
       
        $sql = "update extracharges set status = 'N' where id = $chargeid "; 
      // echo $sql;
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $chargeData = $db->lastInsertId();
                $db = null;
               // print_r($taxData);
              //  return $taxData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function deleteNewWardSettings($wardid){
       
        $sql = "update ward set status = 'N' where id = $wardid "; 
      // echo $sql;
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $wardData = $db->lastInsertId();
                $db = null;
               $this->deleteWardDetails($wardid);
               return $wardData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function deleteNewRoomSettings($roomid){
       
        $sql = "update rooms set status = 'N' where id = $roomid "; 
      // echo $sql;
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $db->lastInsertId();
                $db = null;
               $this->deleteRoomsDetails($roomid);
               return $roomData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
      function deleteNewRoomTypeSettings($roomtypeid){
       
        $sql = "update roomtype set status = 'N' where id = $roomtypeid "; 
      // echo $sql;
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $db->lastInsertId();
                $db = null;
               
               return $roomData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
      function deleteNewServicesSettings($servicestypeid){
       
        $sql = "update hosservices set status = 'N' where id = $servicestypeid "; 
      // echo $sql;
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $servicesData = $db->lastInsertId();
                $db = null;
               
               return $servicesData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
       function deleteNewServicesTypeSettings($servicestypeid){
       
        $sql = "update hosservicestype set status = 'N' where id = $servicestypeid "; 
      // echo $sql;
        $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $servicestypeData = $db->lastInsertId();
                $db = null;
               
               return $servicestypeData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    function updateExistingTaxInfo($taxinfo){
        
        $sql = "update tax set taxname = '$taxinfo->taxname',taxdesc='$taxinfo->taxdesc',taxrate=$taxinfo->taxrate"
                . " where id = $taxinfo->id ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $taxData = $db->lastInsertId();
                $db = null;
               // print_r($taxData);
              //  return $taxData;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
    function updateExistingChargesInfo($chargeinfo){
        
        $sql = "update extracharges set chargename = '$chargeinfo->chargename',chargetype='$chargeinfo->chargetype',"
                . " chargebleamount=$chargeinfo->chargebleamount,discount='$taxinfo->discount' where id = $chargeinfo->id ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $chargeData = $db->lastInsertId();
                $db = null;

           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
     function updateExistingWardInfo($wardinfo){
        
        $sql = "update ward set wardname = '$wardinfo->wardname',wardtype='$wardinfo->wardtype',"
                . " bedscount=$wardinfo->bedscount,discount='$wardinfo->discount',bedcost=$wardinfo->bedcost where id = $wardinfo->id ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $wardData = $db->lastInsertId();
                $db = null;
                return $wardData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
     function updateExistingRoomInfo($roominfo){
        
        $sql = "update rooms set roomname = '$roominfo->roomname',roomtype='$roominfo->roomtype',"
                . " totalrooms=$roominfo->totalrooms,discount='$roominfo->discount',roomcost=$roominfo->roomcost where id = $roominfo->id ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $db->lastInsertId();
                $db = null;
                return $roomData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
      function updateExistingOperationsInfo($operationsinfo){
        
        $sql = "update hosoperations set operationname = '$operationsinfo->operationname',Department='$operationsinfo->Department',operationcost='$operationsinfo->operationcost'"
                . "  where id = $operationsinfo->id ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $operationsData = $db->lastInsertId();
                $db = null;
                return $operationsData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
     function updateExistingRoomTypeInfo($roomtypeinfo){
        
        $sql = "update roomtype set roomtype='$roomtypeinfo->roomtype'"
                . "  where id = $roomtypeinfo->id ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $roomData = $db->lastInsertId();
                $db = null;
                return $roomData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
     function updateExistingServicesInfo($servicesinfo){
        
        $sql = "update hosservices set servicesname = '$servicesinfo->servicesname',servicetype='$servicesinfo->servicetype',"
                . " subservicename=$servicesinfo->subservicename,servicecost=$servicesinfo->servicecost where id = $servicesinfo->id ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $servicesData = $db->lastInsertId();
                $db = null;
                return $servicesData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
     function updateExistingServicesTypeInfo($servicestypeinfo){
        
        $sql = "update hosservicestype set servicetypename = '$servicestypeinfo->servicetypename' where id = $servicestypeinfo->id ";
         $dbConnection = new BusinessHSMDatabase();
          try {
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $servicestypeData = $db->lastInsertId();
                $db = null;
                return $servicestypeData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
    
    
  function insertChargeTaxMapping($mapData,$officeid){
        $userid  = $_SESSION['logeduser'];
       // var_dump($chargeInfo);
        if($userid == "")
            $userid = "Admin";
         if($officeid == "")
            $officeid = "1";
         
        $serviceid = $mapData->serviceid;
        $selectedtax = $mapData->selectedtax;
        $selectedCharges = $mapData->selectedcharges;
        $applytype = $mapData->applytype;
        $effectivedate = $mapData->effectivedate;
        $finalDate = date('Y-m-d', strtotime($effectivedate));
       try { 
             
                $dbConnection = new BusinessHSMDatabase();
        if(sizeof($selectedtax) > 0){
           // var_dump($selectedtax);
            for($i=0;$i<sizeof($selectedtax);$i++){
              //  echo 
               $sql = "insert into charges_map(applyid,status,createddate,createdby,officeid,chargeid,effectivedate,applyname,chargetype) "
                . "values($serviceid, 'Y',CURDATE(),'$userid',$officeid,$selectedtax[$i],'$finalDate','$mapData->applytype','TAX')";
        
              // echo $sql;
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
            }
        }
          if(sizeof($selectedCharges) > 0){
          //     var_dump($selectedCharges);
            for($i=0;$i<sizeof($selectedCharges);$i++){
                
               $sql = "insert into charges_map(applyid,status,createddate,createdby,officeid,chargeid,effectivedate,applyname,chargetype) "
                . "values($serviceid, 'Y',CURDATE(),'$userid',$officeid,$selectedCharges[$i],'$finalDate','$mapData->applytype','CHARGES')";
        
          
                $db = $dbConnection->getConnection();
                $stmt = $db->prepare($sql);
                $stmt->execute();
            }
        }
       
                $servicesTypeData = $db->lastInsertId();
        
                $db = null;
                return $servicesTypeData;
           } catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	} catch(Exception $e1) {
		echo '{"error11":{"text11":'. $e1->getMessage() .'}}'; 
	} 
    }
      
}
