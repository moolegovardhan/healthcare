<!--=== Header ===-->    
    <div class="header">
        <!-- Topbar -->
        <div class="topbar">
            <div class="container">
                <!-- Topbar Navigation -->
              
                <ul class="loginbar pull-right">
                    
                    <li>
                        <i class="fa fa-globe"></i>
                        <a>Welcome</a>
                       
                    </li>
                     <li class="topbar-devider"></li>   
                      <li class="list-inline badge-lists badge-icons badge-aqua">
                            <a href="#"><i class="fa fa-envelope"></i></a>
                            <span class="badge badge-blue rounded-x">2</span>
                        </li>
                    <li class="list-inline badge-lists badge-icons badge-aqua">
                        
                        &nbsp; &nbsp;<a href="#"><i class="fa fa-comments badge-aqua"></i></a>
                        <?php if(count($orders) > 0) { ?>
                        <span class="badge badge-blue rounded-x"><a href="#"  onclick="showorders('<?php  echo $_SESSION['userid'];?>')"><?php echo count($orders);  ?></a></span>
                        <?php } ?>
                    </li>    
                     <li class="topbar-devider"> &nbsp; &nbsp;</li>  
                    <li><?php if(isset($_SESSION['logeduser'])){ echo $_SESSION['logeduser'];  }?></li> 
                    <li class="topbar-devider"></li>   
                    <li><i class="fa fa-inr"></i> : <?php echo ($result[0]->totalamount == "") ? "0" : $result[0]->totalamount;?></li> 
                    <li class="topbar-devider"></li>  
                    <li><a href="../common/logout.php">Logout</a></li> 
                    <li class="topbar-devider"></li>   
                    <li><a href="#">Help</a></li> 
                    <li class="topbar-devider"></li>   
                    <li><a href="#">Contact Us</a></li>   
                </ul>
                <!-- End Topbar Navigation -->
            </div>
        
        <!-- End Topbar -->
         <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="fa fa-bars"></span>
                    </button>
                    <!--a class="navbar-brand" href="#">
                        <h4> <?php echo "HSM Patient";//if(isset($_SESSION['logeduser'])){ echo $_SESSION['logeduser'];  }?></h4>
                    </a-->
                </div>
            </div><?php $classcss = "active";?>
            <?php if($result[0]->firstname != ""){ ?> 
             <div> 
             <div class="collapse navbar-collapse navbar-responsive-collapse">
                 <ul class="nav navbar-nav ">
                     <li  class="<?php   if($_GET['page'] == '' ) {echo active;} ?>">
                           <a href="patientindex.php" >Home</a>
                      </li>
                     <li class="dropdown <?php  echo (($_GET['page'] == 'health' || $_GET['page'] == 'personal' ) ? ($classcss) : ''); ?>">
                         <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" >
                                Profile
                            </a>
                            <ul class="dropdown-menu">
                                <li class="<?php  echo (($_GET['page'] == 'personal' ) ? ($classcss) : ''); ?>">
                                    <a href="patientindex.php?page=personal">Personal</a>
                                </li>
                                 <li class="<?php  echo (($_GET['page'] == 'patientgeneral') ? ($classcss) : ''); ?>">
                                    <a href="patientindex.php?page=patientgeneral">General</a>
                                </li>
                                 <li class="<?php  echo (($_GET['page'] == 'patienthealth' ) ? ($classcss) : ''); ?>">
                                     <a href="patientindex.php?page=patienthealth">Health</a>
                                 </li>
                                
                            </ul>
                            
                        </li>
                        <li class="dropdown <?php  echo (($_GET['page'] == 'doctortimings' || $_GET['page'] == 'viewappointment' || $_GET['page'] == 'appointment' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Appointments
                            </a>
                            <ul class="dropdown-menu">
                                  <li class="<?php  echo (($_GET['page'] == 'doctortimings' ) ? ($classcss) : ''); ?>">
                                        <a href="patientindex.php?page=doctortimings" >Doctor Timings</a>
                                    </li>
                                 <li class="<?php  echo (($_GET['page'] == 'viewappointment' ) ? ($classcss) : ''); ?>">
                                    <a href="patientindex.php?page=viewappointment" >View Appointment</a>
                                </li>
                                 <li class="<?php  echo (($_GET['page'] == 'appointment' ) ? ($classcss) : ''); ?>">
                                    <a href="patientindex.php?page=appointment">Book Appointment</a>
                                </li>
                            </ul>
                            
                        </li>
                        
                       <!--li class="<?php  //echo (($_GET['page'] == 'consultation' ) ? ($classcss) : ''); ?>">
                           <a href="patientindex.php?page=consultation">Consultation</a>
                       </li--> 
                        <li class="dropdown <?php  echo (($_GET['page'] == 'nonprescriptionmedicines' || $_GET['page'] == 'medicines' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Order Medicines
                            </a>
                            <ul class="dropdown-menu">
                                 <li class="<?php  echo (($_GET['page'] == 'medicines' ) ? ($classcss) : ''); ?>">
                                    <a href="patientindex.php?page=medicines">Prescription Medicines</a>
                                </li>
                                     <li class="<?php  echo (($_GET['page'] == 'nonprescriptionmedicines' ) ? ($classcss) : ''); ?>">
                                        <a href="patientindex.php?page=nonprescriptionmedicines" >Non Prescription Medicines</a>
                                    </li>
                            </ul>
                        </li>    
                        
                        
                        <li class="<?php  echo (($_GET['page'] == 'reports' ) ? ($classcss) : ''); ?>">
                            <a href="patientindex.php?page=reports">Reports</a>
                        </li> 
                        <li class="<?php  echo (($_GET['page'] == 'question' ) ? ($classcss) : ''); ?>">
                            <a href="patientindex.php?page=question" >Questions</a>
                        </li>
                         <!--li class="dropdown <?php  echo (($_GET['page'] == 'addpeople' || $_GET['page'] == 'permission' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" style="color: #FFFFFF">
                                Grouping
                            </a>
                             <ul class="dropdown-menu">
                                 <li class="<?php  echo (($_GET['page'] == 'addpeople' ) ? ($classcss) : ''); ?>">
                                    <a href="patientindex.php?page=addpeople">Add People</a>
                                </li>
                                 <li class="<?php  echo (($_GET['page'] == 'permission' ) ? ($classcss) : ''); ?>">
                                    <a href="patientindex.php?page=permission">Permissions</a>
                                </li>
                             </ul> 
                         </li-->     
                        
                 </ul>
                
             </div> 
         </div>
            <?php }?>    
         </div> 
     </div> 
    </div>










