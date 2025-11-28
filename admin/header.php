<?php
//session_start();
require("../connection.php");
////code
 
//if(!isset($_SESSION['auser']))
{
	//header("location:../index.php");
}
?>
<div class="header">

    <!-- Logo -->
    <div class="header-left">
        <a href="dashboard.php" class="logo">
            <SPAN style="font-size: xx-large;">ELCX.</SPAN>
        </a>
        <a href="dashboard.php" class="logo logo-small">
            <span style="font-size:xx-large">ELCX.</span>
        </a>
    </div>
    <!-- /Logo -->

    <a href="javascript:void(0);" id="toggle_btn">
        <i class="fe fe-text-align-left"></i>
    </a>



    <!-- Mobile Menu Toggle -->
    <a class="mobile_btn" id="mobile_btn">
        <i class="fa fa-bars"></i>
    </a>
    <!-- /Mobile Menu Toggle -->

    <!-- Header Right Menu -->
    <ul class="nav user-menu">


        <!-- User Menu -->
        <!-- <h4 style="color:white;margin-top:13px;text-transform:capitalize;"><?php echo $_SESSION['auser'];?></h4> -->
        <li class="nav-item dropdown app-dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img"><img class="rounded-circle" src="assets/img/profiles/avatar-01.png" width="31"
                        alt="Ryan Taylor"></span>
            </a>

            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <img src="assets/img/profiles/avatar-01.png" alt="User Image" class="avatar-img rounded-circle">
                    </div>
                    <div class="user-text">
                        
                    </div>
                </div>
                
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </li>

        <!-- /User Menu -->

    </ul>
    <!-- /Header Right Menu -->

</div>

<!-- header --->



<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li>
                    <a href="dashboard.php"><i class="fe fe-home"></i> <span>Dashboard</span></a>
                </li>

                <!-- <li class="menu-title"> 
								<span>Authentication</span>
							</li>
						
							<li class="submenu">
								<a href="#"><i class="fe fe-user"></i> <span> Authentication </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="index.php"> Login </a></li>
									<li><a href="register.php"> Register </a></li>
									
								</ul>
							</li> -->
                <li class="menu-title">
                    
                </li>

                <li class="submenu">
                    <a href="#"><i class="fe fe-user"></i> <span>Manage Users </span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="displayadmin.php"> Admin </a></li>
                        <li><a href="displayuser.php"> delete user </a></li>
                        <li><a href="register1.php"> add users</a></li>
                        
                    </ul>
                </li>

                <li class="menu-title">
                    <span></span>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fe fe-location"></i> <span>Manage products</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="../admin/insert_products.php"> add products</a></li>
                        <li><a href="../admin/deleteproducts.php"> delete products </a></li>
                    </ul>
                </li>

                <li class="menu-title">
                    
                </li>
                <li class="submenu">
                    <a href="#"><i class="fe fe-map"></i> <span>Manage category</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="../admin/insert_catagory.php"> Add category</a></li>
                        <li><a href="../admin/deletecatagory.php"> delete category </a></li>

                    </ul>
                </li>



                <li class="menu-title">
                    
                </li>
                <li class="submenu">
                    <a href="#"><i class="fe fe-comment"></i> <span> Comments </span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="../admin/displaycommen.php"> view comments </a></li>
                        
                    </ul>
                </li>
                <li class="menu-title">
                
                </li>
                <li class="submenu">
                    <a href="#"><i class="fe fe-browser"></i> <span>view farmers_product </span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="../admin/farmers_pro.php"> farmers_product </a></li>
                        
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fe fe-browser"></i> <span>Manage orders </span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="../admin/displayorders.php"> View orders </a></li>
                        
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->