<?php
include_once("includes/inc_functions.php");

$select_cat = $conn->query("SELECT * FROM tbl_category");
$select_contact = $conn->query("SELECT * FROM tbl_contact");
$select_followus = $conn->query("SELECT * FROM tbl_follow_us");



?>
<footer class="revealed">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-6">
				<h3 data-target="#collapse_1">Quick Links</h3>
				<div class="collapse dont-collapse-sm links" id="collapse_1">
					<ul>
						<li><a href="about.html">About us</a></li>

						<li><a href="help.html">Help</a></li>
						<li><a href="account.html">My account</a></li>

						<li><a href="contacts.php">Contacts</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<h3 data-target="#collapse_2">Categories</h3>
				<div class="collapse dont-collapse-sm links" id="collapse_2">
					<ul>
						<?php
						while ($row_cat = mysqli_fetch_array($select_cat)) {
						?>
							<li><a href="product-cat.php?category=<?php echo $row_cat["category"]; ?>"><?php echo $row_cat["category"]; ?></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<h3 data-target="#collapse_3">Contacts</h3>
				<div class="collapse dont-collapse-sm contacts" id="collapse_3">
					<ul>
						<?php
						$row_contact = mysqli_fetch_array($select_contact);
						$phoneNumber = $row_contact["phoneNo"];
						$exp = explode(",", $phoneNumber);
						?>

						<li><i class="ti-home"></i><?php echo $row_contact["address"]; ?> - Nigeria</li>
						<li><i class="ti-headphone-alt"></i><?php echo $exp[0] . " OR " . $exp[1]; ?></li>
						<li><i class="ti-email"></i><a href="#0"><?php echo $row_contact["email"]; ?></a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">

				<div class="follow_us">
					<h5>Follow Us</h5>
					<ul>
						<li><a href="#"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/twitter_icon.svg" alt="" class="lazy"></a></li>
						<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/facebook_icon.svg" alt="" class="lazy"></a></li>
						<li><a href="https://instagram.com/haviz_lanzile?r=nametag"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/instagram_icon.svg" alt="" class="lazy"></a></li>
						<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/youtube_icon.svg" alt="" class="lazy"></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- /row-->
	<hr>
	<div class="row add_bottom_25">
		<div class="col-lg-6">
			<ul class="footer-selector clearfix">
				<li>
					<div class="styled-select lang-selector">
						<select>
							<option value="English" selected>English</option>
							<option value="French">French</option>
							<option value="Spanish">Spanish</option>
							<option value="Russian">Russian</option>
						</select>
					</div>
				</li>
				<li>
					<div class="styled-select currency-selector">
						<select>
							<option value="US Dollars" selected>US Dollars</option>
							<option value="Euro">Euro</option>
						</select>
					</div>
				</li>
				<li><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/cards_all.svg" alt="" width="198" height="30" class="lazy"></li>
			</ul>
		</div>
		<div class="col-lg-6">
			<ul class="additional_links">
				<li><a href="#">Terms and conditions</a></li>
				<li><a href="#">Privacy</a></li>
				<li><span>© <?php echo date("Y"); ?> Haviz Lanzile</span></li>
			</ul>
		</div>
	</div>
	</div>
</footer>