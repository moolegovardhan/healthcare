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
                    <li><?php if(isset($_SESSION['logeduser'])){ echo $_SESSION['logeduser'];  }?></li>
                     <li class="topbar-devider"></li>  
                     <li>
                           <a href="callcenterindex.php?page=orderStatus" >Order Status</a>
                      </li> 
                      <li class="topbar-devider"></li>  
                    <li><a href="../common/logout.php">Logout</a></li> 
                    <li class="topbar-devider"></li>   
                    <li><a href="#">Help</a></li>  
                    <li class="topbar-devider"></li>   
                    <li><a href="#">Contact Us</a></li>   
                </ul>
                <!-- End Topbar Navigation -->
            </div>
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
                    <!--a class="navbar-brand" href="adminindex.php">
                        <h3><i><b>HSM Call Center</b></i></h3>
                       
                    </a-->
                </div>
            </div>
          <div class="collapse navbar-collapse navbar-responsive-collapse">
                 <ul class="nav navbar-nav">
                     <?php $classcss = "active"; ?>
                      <li  class="<?php   if($_GET['page'] == '' ) {echo active;} ?>">
                           <a href="callcenterindex.php">Home</a>
                      </li>
                      <li class="dropdown  <?php  echo (($_GET['page'] == 'registerPatient' || $_GET['page'] == 'payments'  || $_GET['page'] == 'registerPatient' ) ? ($classcss) : 'carddistribution'); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Register
                            </a>
                            <ul class="dropdown-menu">
                                <!--li><a href="adminindex.php?page=staff">Staff</a></li-->
                                 <li  class="<?php   if($_GET['page'] == 'registerPatient' ) {echo active;} ?>">
                                        <a href="callcenterindex.php?page=registerPatient" >Register</a>
                                   </li> 
                                    <li  class="<?php   if($_GET['page'] == 'carddistribution' ) {echo active;} ?>">
                                            <a href="callcenterindex.php?page=carddistribution" >Card Distribution</a>
                                       </li> 
                               <li  class="<?php   if($_GET['page'] == 'payments' ) {echo active;} ?>">
                                    <a href="callcenterindex.php?page=payments" >Payments</a>
                               </li>       
                            </ul>
                            
                        </li>
                     
                     <li class="dropdown <?php  echo (($_GET['page'] == 'nonregister' || $_GET['page'] == 'medicinesorder' || $_GET['page'] == 'register' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Request
                            </a>
                            <ul class="dropdown-menu">
                                
                                <li class="<?php  echo (($_GET['page'] == 'register' ) ? ($classcss) : ''); ?>">
                                    <a href="callcenterindex.php?page=register">Register Member</a>
                                </li>
                                <li class="<?php  echo (($_GET['page'] == 'nonregister' ) ? ($classcss) : ''); ?>">
                                    <a href="callcenterindex.php?page=nonregister">Non Register Member</a>
                                </li>
                                 <li class="<?php  echo (($_GET['page'] == 'medicinesorder' ) ? ($classcss) : ''); ?>">
                                    <a href="callcenterindex.php?page=medicinesorder">Medicines</a>
                                </li>
                                
                            </ul>
                            
                        </li>
                        
                         <li class="dropdown  <?php  echo (($_GET['page'] == 'appointment' || $_GET['page'] == 'prescription' || $_GET['page'] == 'medicines' || $_GET['page'] == 'medicaltest' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Consultation
                            </a>
                            <ul class="dropdown-menu">
                                <!--li><a href="adminindex.php?page=staff">Staff</a></li-->
                                <li class="<?php  echo (($_GET['page'] == 'appointment' ) ? ($classcss) : ''); ?>">
                                    <a href="callcenterindex.php?page=appointment">Appointment</a>
                                </li>
                                <li class="<?php  echo (($_GET['page'] == 'prescription' ) ? ($classcss) : ''); ?>">
                                    <a href="callcenterindex.php?page=prescription">Prescription</a>
                                </li>
                                 <li class="<?php  echo (($_GET['page'] == 'pregnancyprescription' ) ? ($classcss) : ''); ?>">
                                    <a href="callcenterindex.php?page=pregnancyprescription">Pregnancy Prescription</a>
                                </li>
                                 <li class="<?php  echo (($_GET['page'] == 'childprescription' ) ? ($classcss) : ''); ?>">
                                    <a href="callcenterindex.php?page=childprescription">Child Prescription</a>
                                </li>
                                <li class="<?php  echo (($_GET['page'] == 'medicines' ) ? ($classcss) : ''); ?>">
                                    <a href="callcenterindex.php?page=medicines">Medicines</a>
                                </li>
                              
                            </ul>
                            
                        </li>
                        <li class="dropdown  <?php  echo (($_GET['page'] == 'blog' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Blog
                            </a>
                            <ul class="dropdown-menu">
                                <!--li><a href="adminindex.php?page=staff">Staff</a></li-->
                                <li class="<?php  echo (($_GET['page'] == 'blog' ) ? ($classcss) : ''); ?>">
                                    <a href="callcenterindex.php?page=blog">Blog</a>
                                </li>
                              
                            </ul>
                            
                        </li>
                       <!--li><a href="adminindex.php?page=link">Permissions</a></li> 

                        <li><a href="#">View Request</a></li--> 
 
                 </ul>
             </div> 
         </div> 
      
    </div>










