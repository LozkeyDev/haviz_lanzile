<?php
include_once("../includes/inc_functions.php");
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
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
            <!-- DATA TABLE-->

            <section class="p-t-20">
                <div class="container-fluid">
                    <div class="row">

                        <?php
                        if (isset($_GET['contact_id']) && isset($_GET['action'])) {
                            $id = $_GET['contact_id'];
                            $de = urldecode($id);
                            $cat_id = base64_decode($de);

                            if ($action == "edit") {
                                $sel = $conn->query("SELECT * FROM tbl_contact WHERE id = '$cat_id'");
                                $row = mysqli_fetch_array($sel);
                                $exp_phone = explode(",", $row["phoneNo"]);
                            }
                        }

                        if (isset($_POST["upload-contact"])) {
                            $contacts = [$_POST["firstPhoneNo"] . "," . $_POST["secondPhoneNo"], $_POST["email"], $_POST["houseAddress"]];
                            postContact($contacts);

                        }
                        if (isset($_POST["update-contact"])) {
                            $contacts = [$_POST["firstPhoneNo"] . "," . $_POST["secondPhoneNo"], $_POST["email"], $_POST["houseAddress"]];
                            updateContact($contacts);

                        }
                           
                        
                        ?>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-horizontal">
                            <div class="alert" id="alert" style="display: none"></div>

                            <div class="col-lg-5 mt-4" style="margin-top: 30px;">
                                <div class="card" style="background-color: white; padding: 40px 40px 40px 40px">
                                    <span style="color: darkgoldenrod; font-weight: bolder;font-family:'montserrat' , 'sans-serif';font-size: 16px;"> Contact Address </span>
                                    <div class=" card-body card-block" style="margin-top: 10px">
                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label for="select" class=" form-control-label">Phone No. 1 <b style="color: red">*</b></label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <input name="firstPhoneNo" id="phone1" value="<?php if (isset($exp_phone[0])) {
                                                                                                    echo $exp_phone[0];
                                                                                                } ?>" class="form-control" required>

                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label for="select" class=" form-control-label">Phone No. 2 </label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <input name="secondPhoneNo" value="<?php if (isset($exp_phone[1])) {
                                                                                        echo $exp_phone[1];
                                                                                    } ?>" id="phone2" class="form-control">

                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label for="email" class=" form-control-label">Email <b style="color: red">*</b></label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <input name="email" id="email" value="<?php if (isset($row["email"])) {
                                                                                            echo $row["email"];
                                                                                        } ?>" class="form-control">

                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-4">
                                                <label for="email" class=" form-control-label">Home Address <b style="color: red">*</b></label>
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <textarea name="houseAddress" id="houseAddress" class="form-control" rows="3"><?php if (isset($row["address"])) {
                                                                                                                                    echo $row["address"];
                                                                                                                                } ?></textarea>

                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <button type="submit" name="upload-contact" id="upload-contact" class="btn btn-primary btn-sm">
                                                <i class="fa fa-dot-circle-o"></i> Submit
                                            </button>
                                        </div>

                                        <div class="card-footer">
                                            <button type="submit" name="update-contact" id="update-contact" class="btn btn-primary btn-sm" style="display: none">
                                                <i class="fa fa-dot-circle-o"></i> Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <input type="text" value="<?php if (isset($action)) {
                                                        echo $action;
                                                    } ?>" id="edit-contact" style="display: none">
                    </div>

                    <div class="row">
                        <!-- view all categories -->
                        <div class="col-lg-12 mt-4" style="margin-top: 30px;">
                            <div class="card" style="background-color: white; padding: 40px 40px 40px 40px">
                                <span style="color: darkgoldenrod; font-weight: bolder; font-family:'montserrat' , 'sans-serif';font-size: 16px; "> View Contact </span>
                                <div class=" card-body card-block" style="margin-top: 10px">

                                    <table class="table table-striped table-bordered table-responsive table-hover" id="dataTables-example" style="white-space: nowrap;font-size: 12px;">

                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Phone Number</th>
                                                <th>Email address</th>
                                                <th>Location</th>
                                                <th>Action(s)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            <?php
                                            $selme = $conn->query("SELECT * FROM tbl_contact") or die(mysqli_error($conn));
                                            $count = 0;

                                            while ($row = mysqli_fetch_array($selme)) {
                                                $id = base64_encode($row["id"]);
                                                $encodeurl = urlencode($id);
                                                $count = $count + 1;
                                            ?>
                                                <tr>
                                                    <td><?php echo $count ?></td>
                                                    <td><?php echo $row["phoneNo"]; ?></td>
                                                    <td><?php echo $row["email"]; ?></td>
                                                    <td><?php echo $row["address"]; ?></td>
                                                    <td><?php echo $row["date_saved"]; ?></td>
                                                    <td><a href="?contact_id=<?php echo $encodeurl; ?>&action=edit" class="btn btn-sm btn-danger">Edit</a></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <!-- END DATA TABLE-->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer" style="text-align: center">

        <strong>Copyright &copy; <?php echo date("Y"); ?> <b style="text-transform: uppercase;"> Haviz</b>Lanzile</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark" style="display: none;">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <!-- <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li> -->
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

    <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="bower_components/jquery-2.1.1.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>

    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="bower_components/raphael/raphael.min.js"></script>

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


    <script type="text/javascript" src="assets/DataTables-1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/DataTables-1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            // alert(0);
            const ed = $("#edit-contact").val();
            console.log(ed);

            if (ed != "") {
                $("#update-contact").show();
                $("#upload-contact").hide();

            }

            $('#dataTables-example').dataTable();

            $("#alert-message").slideDown().delay(2000).slideUp();



        });
    </script>

</body>

</html>