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
                    <li>Super Admin </li>
                     <li class="topbar-devider"></li>   
                    <li><?php if(isset($_SESSION['logeduser'])){ echo $_SESSION['logeduser'];  }?></li>
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
                   
                </div>
            </div>
             <div class="collapse navbar-collapse navbar-responsive-collapse">
                 <ul class="nav navbar-nav">
                     <?php $classcss = "active"; ?>
                      <li  class="<?php   if($_GET['page'] == '' ) {echo active;} ?>">
                           <a href="adminindex.php">Home</a>
                      </li> 
                     <li class="dropdown <?php  echo (($_GET['page'] == 'diagnostics' || $_GET['page'] == 'hospital' || $_GET['page'] == 'medical' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Register
                            </a>
                            <ul class="dropdown-menu">
                                <!--li><a href="adminindex.php?page=staff">Staff</a></li>
                                <li><a href="adminindex.php?page=doctor">Doctor</a></li-->
                                <li class="<?php  echo (($_GET['page'] == 'hospital' ) ? ($classcss) : ''); ?>">
                                    <a href="adminindex.php?page=hospital">Hospital</a>
                                </li>
                                <li class="<?php  echo (($_GET['page'] == 'diagnostics' ) ? ($classcss) : ''); ?>">
                                    <a href="adminindex.php?page=diagnostics">Diagnostics</a>
                                </li>
                                <li class="<?php  echo (($_GET['page'] == 'medical' ) ? ($classcss) : ''); ?>">
                                    <a href="adminindex.php?page=medical">Medical Shop</a>
                                </li>
                                
                            </ul>
                            
                        </li>
                        <li class="dropdown <?php  echo (($_GET['page'] == 'card' || $_GET['page'] == 'discount' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Settings
                            </a>
                            <ul class="dropdown-menu">
                                <!--li><a href="adminindex.php?page=staff">Staff</a></li>
                                <li><a href="adminindex.php?page=doctor">Doctor</a></li-->
                                <li class="<?php  echo (($_GET['page'] == 'card' ) ? ($classcss) : ''); ?>">
                                    <a href="adminindex.php?page=card">Create Card</a>
                                </li>
                                <li class="<?php  echo (($_GET['page'] == 'discount' ) ? ($classcss) : ''); ?>">
                                    <a href="adminindex.php?page=discount">Discount</a>
                                </li>
                               
                            </ul>
                            
                        </li>
                         <li class="dropdown  <?php  echo (($_GET['page'] == 'perdoctor' || $_GET['page'] == 'link' || $_GET['page'] == 'perdiagnostics' || $_GET['page'] == 'permedical' ) ? ($classcss) : ''); ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Permissions
                            </a>
                            <ul class="dropdown-menu">
                                <!--li><a href="adminindex.php?page=staff">Staff</a></li-->
                                <li class="<?php  echo (($_GET['page'] == 'perdoctor' ) ? ($classcss) : ''); ?>">
                                    <a href="adminindex.php?page=perdoctor">Doctor</a>
                                </li>
                                <li class="<?php  echo (($_GET['page'] == 'link' ) ? ($classcss) : ''); ?>">
                                    <a href="adminindex.php?page=link">Hospital</a>
                                </li>
                                <li class="<?php  echo (($_GET['page'] == 'perdiagnostics' ) ? ($classcss) : ''); ?>">
                                    <a href="adminindex.php?page=perdiagnostics">Diagnostics</a>
                                </li>
                                <li class="<?php  echo (($_GET['page'] == 'permedical' ) ? ($classcss) : ''); ?>">
                                    <a href="adminindex.php?page=permedical">Medical Shop</a>
                                </li>
                                
                            </ul>
                            
                        </li>
                       <!--li><a href="adminindex.php?page=link">Permissions</a></li--> 

                        <li><a href="#">View Request</a></li> 
 
                 </ul>
             </div> 
          
         </div> 
      
    </div>










