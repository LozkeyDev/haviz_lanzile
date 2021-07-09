<?php
include 'includes/inc_functions.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Haviz Lanzile">
    <title>Haviz Lanzile | Home </title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/1fa39604-50a2-4ad7-9a48-85271cdbc0bd (1).ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.custom.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="css/home_1.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">




    <style>
        /* @media screen and (max-width: 375px) {
			.owl-slide {
				background-size: 300px;
				width: 375px;
				height: 85px;
			}
		} */
    </style>
</head>

<body>

    <div id="page" data-ng-init="" class="container-fluid">

        <!-- header -->
        <?php include_once("lib/header.php"); ?>
        <!-- header ends here -->
        <main>
            


            <div class="container margin_60_35">
                <div class="main_title">
                    <h2><?php echo $_GET["category"]; ?></h2>
                    <span>Products</span>
                    <!-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p> -->
                </div>
                <div class="row small-gutters">

                    <?php
                    $selectquery = mysqli_query($conn, "SELECT * FROM `tbl_product` ");

                    while ($productrow = mysqli_fetch_array($selectquery)) { ?>

                        <?php
                        $trimfetcimg = rtrim($productrow['image'], ',');
                        $expimg = explode(',', $trimfetcimg);

                        $producturl = base64_encode($productrow['id']);
                        $encodeproducturl = urlencode($producturl);
                        $rawimage = $productrow["image"];
                        $rawimage = explode(",", $rawimage);
                        $rawimage = array_filter($rawimage);
                        $realimage = $rawimage[0];
                        ?>
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="grid_item">
                                <figure>
                                    <span class="ribbon off">-30%</span>
                                    <a href="product.php?id=<?php echo $encodeproducturl; ?>&&cat=<?php echo $productrow["category"] ?>">
                                        <img class="img-fluid lazy" width="200" height="240" src="llp/product_image/<?php echo $realimage; ?>" data-src="llp/product_image/<?php echo $realimage; ?>" alt="">

                                    </a>
                                    <!-- <div data-countdown="2019/05/15" class="countdown"></div> -->
                                </figure>
                                <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                                <a href="product.php?id=<?php echo $encodeproducturl; ?>">
                                    <h3><?php echo $productrow["productname"] ?></h3>
                                </a>
                                <div class="price_box">
                                    <span class="new_price">&#8358; <?php echo $productrow["amount"] ?></span>
                                    <span class="old_price">&#8358;60.00</span>
                                </div>
                                <ul>
                                    <li><a href="#" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>

                                    <li><a href="#" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                                </ul>
                            </div>
                            <!-- /grid_item -->
                        </div>
                        <!-- /col -->
                    <?php } ?>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->


            <div class="container margin_60_35">
                <div class="main_title">
                    <h2>Featured</h2>
                    <span>Products</span>
                    <!-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p> -->
                </div>
                <div class="owl-carousel owl-theme products_carousel">
                    <?php
                    $selectquery = mysqli_query($conn, "SELECT * FROM `tbl_product` ORDER BY id DESC");

                    while ($productrow = mysqli_fetch_array($selectquery)) { ?>

                        <?php
                        $trimfetcimg = rtrim($productrow['image'], ',');
                        $expimg = explode(',', $trimfetcimg);

                        $producturl = base64_encode($productrow['id']);
                        $encodeproducturl = urlencode($producturl);
                        $rawimage = $productrow["image"];
                        $rawimage = explode(",", $rawimage);
                        $rawimage = array_filter($rawimage);
                        $realimage = $rawimage[0];
                        ?>
                        <div class="item">
                            <div class="grid_item">
                                <span class="ribbon new">New</span>
                                <figure>
                                    <a href="product.php?id=<?php echo $encodeproducturl; ?>">
                                        <img class="owl-lazy" src="llp/product_image/<?php echo $realimage; ?>" data-src="llp/product_image/<?php echo $realimage; ?>" alt="">
                                    </a>
                                </figure>
                                <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                                <a href="product-detail-1.html">
                                    <h3><?php echo $productrow["productname"]; ?></h3>
                                </a>
                                <div class="price_box">
                                    <span class="new_price">&#8358;<?php echo $productrow["amount"]; ?></span>
                                </div>
                                <ul>
                                    <li><a href="#" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                                    <!-- <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a></li> -->
                                    <li><a href="#" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                                </ul>
                            </div>
                            <!-- /grid_item -->
                        </div>
                    <?php } ?>
                    <!-- /item -->

                    <!-- /item -->
                </div>
                <!-- /products_carousel -->
            </div>
            <!-- /container -->

            <!-- patnership -->
            <?php include_once("lib/patnership.php"); ?>
            <!-- patnership ends here -->
            <div class="container margin_60_35">
                <div class="main_title">
                    <h2>Testimonials</h2>
                    <span>Haviz Lanzile</span>
                    <p>What people say about our products</p>
                </div>
                <div class="row">
                    <?php
                    $selme = $conn->query("SELECT * FROM tbl_testimonial") or die(mysqli_error($conn));

                    while ($row = mysqli_fetch_array($selme)) {
                        $id = base64_encode($row["id"]);
                        $encodeurl = urlencode($id);
                        $date = explode("-", $row["date"]);


                    ?>
                        <div class="col-lg-4">
                            <a class="box_news" href="#">
                                <figure>
                                    <img src="llp/product_image/<?php echo $row["userPicture"]; ?>" data-src="llp/product_image/<?php echo $row["userPicture"]; ?>" alt="" width="300" height="266" class="lazy">
                                    <figcaption><strong><?php echo $date[0]; ?></strong></figcaption>
                                </figure>
                                <ul>
                                    <li>by <?php echo $row["fullname"]; ?></li>
                                    <li><?php echo $row["date"]; ?></li>
                                </ul>
                                <!-- <h4>Pri oportere scribentur eu</h4> -->
                                <p><?php echo $row["testimonial"] ?></p>
                            </a>
                        </div>
                    <?php } ?>
                    <!-- /box_news -->

                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </main>
        <!-- /main -->

        <!-- footer -->

        <?php
        include_once("lib/footer.php");
        ?>

        <!--/footer-->
    </div>
    <!-- page -->

    <div id="toTop"></div><!-- Back to top button -->

    <!-- COMMON SCRIPTS -->
    <script src="js/common_scripts.min.js"></script>
    <script src="js/main.js"></script>

    <!-- SPECIFIC SCRIPTS -->
    <script src="js/carousel-home.min.js"></script>

    <!-- from kwasu -->
    <script src="js1/app_1.js"></script>
    <script src="js1/jquery-2.1.1.js"></script>
    <script src="js1/bootstrap.min.js"></script>
    <script src="js1/jquery.metisMenu.js"></script>
    <script src="js1/jquery.slimscroll.min.js"></script>
    <script src="js1/angular.min.js"></script>
    <script src="js1/app.js"></script>
    <script src="js1/ocLazyLoad.min.js"></script>
    <script src="js1/angular-ui-router.min.js"></script>
    <script src="js1/sweetalert.min.js"></script>
    <script src="js1/flicksauth.js"></script>
</body>

</html>