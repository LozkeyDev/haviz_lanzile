 <?php
    include_once("../includes/inc_functions.php");

    // session_start();
    $adminid = $_SESSION["adminid"];
    $exp = explode("_", $adminid);
    $sel = $conn->query("SELECT * FROM tbl_admin WHERE admin_id = '$exp[0]'") or die(mysqli_error($conn));
    $row = mysqli_fetch_array($sel);
    ?>

 <aside class="main-sidebar">
     <!-- sidebar: style can be found in sidebar.less -->
     <section class="sidebar">
         <!-- Sidebar user panel -->
         <div class="user-panel">
             <div class="pull-left image">
                 <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
             </div>
             <div class="pull-left info">
                 <p><?php echo $row["full_name"]; ?></p>
                 <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
             </div>
         </div>

         <!-- sidebar menu: : style can be found in sidebar.less -->
         <ul class="sidebar-menu" data-widget="tree">
             <li class="header">Admin Dashboard</li>
             <li class="active treeview">
                 <a href="dashboard.php">
                     <i class="fa fa-dashboard"></i> <span>Dashboard</span>

                 </a>

             </li>
             <li class="treeview">
                 <a href="#">
                     <i class="fa fa-files-o"></i>
                     <span>Page Layouts </span>
                     <span class="pull-right-container">
                         <i class="fa fa-angle-left pull-right"></i>
                     </span>
                 </a>
                 <ul class="treeview-menu">
                     <li><a href="banner-upload.php"><i class="fa fa-circle-o"></i> Banner</a></li>
                     <li><a href="#"><i class="fa fa-circle-o"></i> Header </a></li>
                     <li><a href="#"><i class="fa fa-circle-o"></i> Index Page </a></li>
                     <li><a href="#"><i class="fa fa-circle-o"></i> Product page</a></li>
                     <li><a href="#"><i class="fa fa-circle-o"></i> Checkout page</a></li>
                 </ul>
             </li>

             <li class="treeview">
                 <a href="#">
                     <i class="fa fa-pie-chart"></i>
                     <span> Manage Products </span>
                     <span class="pull-right-container">
                         <i class="fa fa-angle-left pull-right"></i>
                     </span>
                 </a>
                 <ul class="treeview-menu">
                     <li><a href="all-products.php"><i class="fa fa-circle-o"></i> All Products</a></li>
                     <li><a href="upload-product.php"><i class="fa fa-circle-o"></i> Upload Products</a></li>
                     <li><a href="product-cat.php"><i class="fa fa-circle-o"></i> Product Category</a></li>
                     <li><a href="#"><i class="fa fa-circle-o"></i> Deleted Products</a></li>

                 </ul>
             </li>
             <li class="treeview">
                 <a href="#">
                     <i class="fa fa-laptop"></i>
                     <span>Accounts</span>
                     <span class="pull-right-container">
                         <i class="fa fa-angle-left pull-right"></i>
                     </span>
                 </a>
                 <ul class="treeview-menu">
                     <li><a href="all-admin.php"><i class="fa fa-circle-o"></i> Admins</a></li>
                     <li><a href="customers.php"><i class="fa fa-circle-o"></i> Customers </a></li>

                 </ul>
             </li>

             <li class="treeview">
                 <a href="#">
                     <i class="fa fa-table"></i> <span>Orders</span>
                     <span class="pull-right-container">
                         <i class="fa fa-angle-left pull-right"></i>
                     </span>
                 </a>
                 <ul class="treeview-menu">
                     <li><a href="#"><i class="fa fa-circle-o"></i> New Orders </a></li>
                     <li><a href="#"><i class="fa fa-circle-o"></i> Review Orders </a></li>
                 </ul>
             </li>
             <li class="treeview">
                 <a href="#">
                     <i class="fa fa-files-o"></i>
                     <span>Utilities </span>
                     <span class="pull-right-container">
                         <i class="fa fa-angle-left pull-right"></i>
                     </span>
                 </a>
                 <ul class="treeview-menu">
                     <li><a href="contacts-upload.php"><i class="fa fa-circle-o"></i> Contacts </a></li>
                     <li><a href="followus-upload.php"><i class="fa fa-circle-o"></i> Follow us Link</a></li>
                     <li><a href="testimonials.php"><i class="fa fa-circle-o"></i> Testimonials</a></li>

                 </ul>
             </li>

             <li>
                 <a href="#">
                     <i class="fa fa-envelope"></i> <span>Messages</span>

                 </a>
             </li>
             <li>
                 <a href="#">
                     <i class="fa fa-calendar"></i> <span>Calendar</span>
                     <span class="pull-right-container">
                         <small class="label pull-right bg-red">3</small>
                         <small class="label pull-right bg-blue">17</small>
                     </span>
                 </a>
             </li>



         </ul>
     </section>
     <!-- /.sidebar -->
 </aside>