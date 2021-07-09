<?php include_once("../includes/inc_functions.php");
// include_once("../includes/redirect.php");

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Haviz Lanzile | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <link rel="stylesheet" type="text/css" href="assets/DataTables-1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="shortcut icon" href="../img/1fa39604-50a2-4ad7-9a48-85271cdbc0bd (1).ico" type="image/x-icon">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- header -->
        <?php include_once("pages/header.php"); ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php include_once("pages/sidebar.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Banner
                    <small> Slideshow</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>
            <div class="row container">
                <?php
                if (isset($_GET['id']) && isset($_GET['action'])) {
                    $id = $_GET['id'];
                    $de = urldecode($id);
                    $cat_id = base64_decode($de);
                    $action = $_GET['action'];

                    if ($action == "delete") {
                        $sel = $conn->query("SELECT id FROM tbl_banner WHERE id = '$cat_id'");
                        if ($sel->num_rows == 0) {
                            echo message("danger", "Banner already deleted");
                        } else {
                            $del = $conn->query("DELETE FROM tbl_banner WHERE id = '$cat_id'");
                            if ($del) {
                                echo message("info", "You have successfully deleted a banner");
                            }
                        }
                    }
                }

                if (isset($_POST['submit'])) {
                   
                    uploadBanner($conn, $_FILES['banner']);
                }
                ?>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-horizontal" enctype="multipart/form-data">
                    <div class="alert" id="alert" style="display: none"></div>

                    <div class="col-lg-5 mt-4" style="margin-top: 30px;">
                        <div class="card" style="background-color: white; padding: 40px 40px 40px 40px">
                            <span style="color: darkgoldenrod; font-weight: bolder; font-family:'montserrat' , 'sans-serif';font-size: 16px; ">Add Banner </span>
                            <div class=" card-body card-block" style="margin-top: 10px">


                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="select" class=" form-control-label">Select banner <b style="color: red">*</b></label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <input type="file" name="banner" id="banner" class="form-control" required>
                                    </div>
                                </div>

                                
                                <div class="card-footer">
                                    <button type="submit" name="submit" id="upload" class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- view all categories -->
                    <div class="col-lg-7 mt-4" style="margin-top: 30px;">
                        <div class="card" style="background-color: white; padding: 40px 40px 40px 40px">
                            <span style="color: darkgoldenrod; font-weight: bolder; font-family:'montserrat' , 'sans-serif';font-size: 16px; ">Banners </span>
                            <div class=" card-body card-block" style="margin-top: 10px">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="white-space: nowrap;font-size: 12px;">

                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Banner</th>
                                            <th>Date</th>
                                            <th>Action(s)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        <?php
                                        $selme = $conn->query("SELECT * FROM tbl_banner") or die(mysqli_error($conn));
                                        $count = 0;

                                        while ($row = mysqli_fetch_array($selme)) {
                                            $id = base64_encode($row["id"]);
                                            $encodeurl = urlencode($id);
                                            $count = $count + 1;
                                        ?>
                                            <tr>
                                                <td><?php echo $count ?></td>
                                                
                                                <td>
                                                    <div style="width: 100px; height: 100px; background-color: #f2f2f2; background-size: cover; background-position: center; background-repeat: no-repeat; background-image: url('product_image/<?php echo $row["banner"]; ?>');"></div>
                                                </td>
                                                <td><?php echo $row["date"]; ?></td>
                                                <td><a href="?id=<?php echo $encodeurl; ?>&&action=delete" class="btn btn-sm btn-danger">Delete</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>


                            </div>
                        </div>
                </form>

            </div>

        </div>
        <!-- /.content-wrapper -->
        <!-- <footer class="main-footer" style="text-align: center; background:#44288A; color: white">

            <strong>Copyright &copy; <?php echo date("Y"); ?> <b style="text-transform: uppercase;"> Haviz</b>Lanzile</a>.</strong> All rights
            reserved.
        </footer> -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark" style="display: none;">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Home tab content -->
                <div class="tab-pane" id="control-sidebar-home-tab">


                </div>
                <!-- /.tab-pane -->

                <!-- /.tab-pane -->
            </div>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="../js/jquery-2.1.1.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="bower_components/raphael/raphael.min.js"></script>
    <!-- <script src="bower_components/morris.js/morris.min.js"></script> -->
    <!-- Sparkline -->
    <script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="bower_components/moment/min/moment.min.js"></script>
    <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

    <script src="dist/js/demo.js"></script>

    <script type="text/javascript" src="assets/DataTables-1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/DataTables-1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable();

            // time alert

            $("#alert-message").slideDown().delay(2000).slideUp();







        });
    </script>



</body>

</html>