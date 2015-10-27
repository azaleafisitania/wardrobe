<!-- Validate if parameter is set -->
<?php
if(!isset($_GET['category'])) $category = "";
else $category = $_GET['category'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "meta-css.php"; ?>
	<title>Clothes | Wardrobe </title>
</head>


<body class="nav-md">

	<div class="container body">


		<div class="main_container">

			<!-- sidebar -->
			<?php include "sidebar.php"; ?>
			<!-- /sidebar -->

			<!-- top navigation -->
            <?php include "top-navigation.php"; ?>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left clothes_title">
							<!-- Clothes title here -->
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search for...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">Go!</button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>

					<div class="row">

						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2><i class="fa fa-photo"></i> Gallery</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content clothes_gallery">
									<!-- Clothes gallery here -->
								</div>
								<div id="ajax_load" style="display:none">
									<center><img src="images/ajax-loader.gif" /></center>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- footer content -->
				<?php include "footer.php"; ?>
				<!-- /footer content -->

			</div>
			<!-- /page content -->
		</div>

	</div>

	<?php include "script.php"; ?>
	<script>
	// Load first batch of data
	start = 0; 
	limit = 20;
	$(document).ready(function () {
		$(".clothes_title").append('<h3><i class="fa fa-folder-open"></i> <a href="clothes.php">Clothes</a> <i class="fa fa-angle-right"></i> <?php echo ucfirst($category); ?></h3>');
		getCategory("<?php echo $category; ?>");
		getClothes("<?php echo $category; ?>",start,limit);
	});

	// Load next batches when hit bottom, endless scroll
	$(window).scroll(function() {
		if($(window).scrollTop() == $(document).height() - $(window).height()) {
			document.getElementById("ajax_load").style="display:block";
			setTimeout(function(){
				start = start+limit;
				getClothes("<?php echo $category; ?>",start,limit);
				document.getElementById("ajax_load").style="display:none";
			},100);
		}
	});
	</script>
</body>

</html>