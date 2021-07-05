<?php
include 'includes/inc_functions.php';

?>
<?php
if (isset($_GET["id"])) {
	$base = base64_decode($_GET["id"]);
	$url = urldecode($base);
	// echo $url;
	$chkme = $conn->query("SELECT * FROM tbl_product WHERE id = '$url'") or die(mysqli_error($conn));
	if ($chkme->num_rows == 0) {
		header("location: not-found.php");
	} else {
		$row = mysqli_fetch_array($chkme);
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Ansonika">
	<title> Haviz Lanzile | </title>

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
	<link href="css/product_page.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet">

</head>

<body>

	<div id="page">

		<?php include_once("lib/header.php"); ?>

		<main class="">

			<div class="container margin_30">
				<div class="page_header">
					<div class="breadcrumbs">
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Category</a></li>
							<li>Product details</li>
						</ul>
					</div>

					<h1><?php echo $row["productname"]; ?></h1>
				</div>
				<!-- /page_header -->

				<div class="row" style="background-color: #F6F6F6;" style="padding: 20px 20px 20px 20px">
					<div class="col-lg-4" style="background: white;">
						<div class="owl-carousel owl-theme prod_pics magnific-gallery">
							<?php
							$images = $row['image'];
							$ex = explode(",", $images);
							$image_array = array_filter($ex);
							// $count = count($image_array);
							for ($index = 0; $index < count($image_array); $index++) {
							?>
								<div class="item">
									<a href="" title="Photo title" data-effect="mfp-zoom-in">
										<img src="llp/product_image/<?php echo $image_array[$index] ?>" alt="" width="200" height="240"></a>
								</div>
								<!-- /item -->
							<?php } ?>
						</div>
						<!-- /carousel -->
					</div>
					<div class="col-lg-5" style="background: white;">
						<div class="prod_info version_2">
							<span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i><em>4 reviews</em></span>
							<p><small> <?php echo $row["productname"]; ?> </small><br><?php echo $row["description"]; ?></p>

						</div>

						<div class="prod_options version_2">

							<div class="row">
								<?php
								if (!empty($row["size"])) { ?>
									<label class="col-xl-7 col-lg-5  col-md-6 col-6"><strong> Size: <?php echo $row["size"] ?></strong></label>

								<?php } ?>

								<!-- <div class="col-xl-5 col-lg-5 col-md-6 col-6">
									<div class="custom-select-form">
										<select class="wide">
											<option value="" selected="">Small (S)</option>
											<option value="">M</option>
											<option value=" ">L</option>
											<option value=" ">XL</option>
										</select>
									</div>
								</div> -->
							</div>
							<div class="row">
								<?php
								if (!empty($row["quantity"])) { ?>
									<label class="col-xl-7 col-lg-5  col-md-6 col-6"><strong>Available Quantity: <?php echo $row["quantity"] ?> Pieces</strong></label>

								<?php } ?>
								<div class="col-xl-5 col-lg-5 col-md-6 col-6">
									<div class="numbers-row">
										<input type="text" value="1" id="quantity_1" class="qty2" name="quantity_1">
										<div class="inc button_inc">+</div>
										<div class="dec button_inc">-</div>
									</div>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-lg-7 col-md-6">
									<div class="price_main"><span class="new_price">&#8358;<?php echo $row["amount"]; ?></span>
										<?php
										if (!empty($row["discount"])) { ?> <span class="percentage"><?php echo $row["discount"]; ?></span><?php } ?>

										<?php if (!empty($row["old_price"])) { ?><span class="old_price">&#8358;<?php echo $row["old_price"]; ?></span> <?php } ?>
									</div>
								</div>
								<div class="col-lg-5 col-md-6">
									<div class="btn_add_to_cart"><a href="#" class="btn_1">Add to Cart</a></div>
								</div>
							</div>


						</div>


					</div>
					<div class="col-lg-3" style="background: white; border: 1px solid #44288A; box-shadow: 15px 5px;padding: 10px 10px;">
						<span style="font-weight: bold">Delivery Returns </span>
						<hr style="">
						<span><b>Haviz Lanzile </b> </span> <i style="color: darkorange">Express</i>

					</div>
				</div>



				<div class="tabs_product bg_white version_2">
					<div class="container">
						<ul class="nav nav-tabs" role="tablist">

							<li class="nav-item">
								<a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Reviews</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- /tabs_product -->

				<div class="tab_content_wrapper">
					<div class="container">
						<div class="tab-content" role="tablist">
							<div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
								<div class="card-header" role="tab" id="heading-A">
									<h5 class="mb-0">
										<a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="false" aria-controls="collapse-A">
											Description
										</a>
									</h5>
								</div>

								<!-- <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
									<div class="card-body">
										<div class="row justify-content-between">
											<div class="col-lg-6">
												<h3>Details</h3>
												<p>Lorem ipsum dolor sit amet, in eleifend <strong>inimicus elaboraret</strong> his, harum efficiendi mel ne. Sale percipit vituperata ex mel, sea ne essent aeterno sanctus, nam ea laoreet civibus electram. Ea vis eius explicari. Quot iuvaret ad has.</p>
												<p>Vis ei ipsum conclusionemque. Te enim suscipit recusabo mea, ne vis mazim aliquando, everti insolens at sit. Cu vel modo unum quaestio, in vide dicta has. Ut his laudem explicari adversarium, nisl <strong>laboramus hendrerit</strong> te his, alia lobortis vis ea.</p>
												<p>Perfecto eleifend sea no, cu audire voluptatibus eam. An alii praesent sit, nobis numquam principes ea eos, cu autem constituto suscipiantur eam. Ex graeci elaboraret pro. Mei te omnis tantas, nobis viderer vivendo ex has.</p>
											</div>
											<div class="col-lg-5">
												<h3>Specifications</h3>
												<div class="table-responsive">
													<table class="table table-sm table-striped">
														<tbody>
															<tr>
																<td><strong>Color</strong></td>
																<td>Blue, Purple</td>
															</tr>
															<tr>
																<td><strong>Size</strong></td>
																<td>150x100x100</td>
															</tr>
															<tr>
																<td><strong>Weight</strong></td>
																<td>0.6kg</td>
															</tr>
															<tr>
																<td><strong>Manifacturer</strong></td>
																<td>Manifacturer</td>
															</tr>
														</tbody>
													</table>
												</div>
												
											</div>
										</div>
									</div>
								</div> -->
							</div>
							<!-- /TAB A -->
							<div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
								<div class="card-header" role="tab" id="heading-B">
									<h5 class="mb-0">
										<a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
											Reviews
										</a>
									</h5>
								</div>
								<div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
									<div class="card-body">
										<div class="row justify-content-between">
											<div class="col-lg-5">
												<div class="review_content">
													<div class="clearfix add_bottom_10">
														<span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><em>5.0/5.0</em></span>
														<em>Published 54 minutes ago</em>
													</div>
													<h4>"Commpletely satisfied"</h4>
													<p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.</p>
												</div>
											</div>

										</div>
										<!-- /row -->


										<p class="text-right"><a href="leave-review.php" class="btn_1">Leave a review</a></p>
									</div>
									<!-- /card-body -->
								</div>

							</div>
							<!-- /tab B -->
						</div>
						<!-- /tab-content -->
					</div>
					<!-- /container -->
				</div>
				<!-- /tab_content_wrapper -->

				<div class="bg_white">
					<div class="container margin_60_35">
						<div class="main_title">
							<h2>Related</h2>
							<span>Products</span>
							<!-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p> -->
						</div>


						<div class="owl-carousel owl-theme products_carousel">
							<?php
							if (isset($_GET["cat"])) {
								$cat = $_GET["cat"];

								$chkme2 = $conn->query("SELECT * FROM tbl_product WHERE category = '$cat'") or die(mysqli_error($conn));
								while ($row2 = mysqli_fetch_array($chkme2)) {
								$producturl = base64_encode($row2['id']);
								$encodeproducturl = urlencode($producturl);
									$rawimage = $row2["image"];
									$rawimage = explode(",", $rawimage);
									$rawimage = array_filter($rawimage);
									$realimage = $rawimage[0];
							?>
									<div class="item">
										<div class="grid_item">
											<span class="ribbon new">New</span>
											<figure>
												<a href="product.php?id=<?php echo $encodeproducturl; ?>&&cat=<?php echo $row2["category"]?>">
													<img class="owl-lazy" src="llp/product_image/<?php echo $realimage; ?>" data-src="llp/product_image/<?php echo $realimage; ?>" alt="">
												</a>
											</figure>
											<div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
											<a href="product.php">
												<h3><?php echo $row2["productname"] ?></h3>
											</a>
											<div class="price_box">
												<span class="new_price">&#8358; <?php echo $row2["amount"] ?></span>
											</div>
											<ul>
												<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>

												<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
											</ul>
										</div>
										<!-- /grid_item -->
									</div>

							<?php }
							} ?>
							<!-- /item -->

						</div>
						<!-- /products_carousel -->
					</div>
					<!-- /container -->
				</div>
				

		</main>
		<!-- /main -->

		<!-- footer -->
		<?php include_once("lib/footer.php"); ?>
		<!--/footer-->
	</div>
	<!-- page -->

	<div id="toTop"></div><!-- Back to top button -->

	<div class="top_panel">
		<div class="container header_panel">
			<a href="#" class="btn_close_top_panel"><i class="ti-close"></i></a>
			<label>1 product added to cart</label>
		</div>
		<!-- /header_panel -->
		
	</div>
	
		<!-- /item -->
		
	

	<!-- COMMON SCRIPTS -->
	<script src="js/common_scripts.min.js"></script>
	<script src="js/main.js"></script>


</body>

</html>