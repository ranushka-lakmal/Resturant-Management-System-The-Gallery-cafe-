<?php include 'template/header.php';
if (!isset($_SESSION['isLoggedIn'])) {
	echo '<script>window.location="login.php"</script>';
}

if ($_SESSION['role'] !== 'admin') {
    echo '<script>window.location="login.php";</script>';
	session_destroy();
    exit();
}
?>

<body>
	<section class="body">
		<?php include 'template/top-bar.php'; ?>
		<div class="inner-wrapper">
			<?php include 'template/left-bar.php'; ?>
			<section role="main" class="content-body">
				<header class="page-header">
					<h2>Manage Tables</h2>
					<div class="right-wrapper pull-right">
						<ol class="breadcrumbs">
							<li>
								<a href="index.html">
									<i class="fa fa-home"></i>
								</a>
							</li>
							<li><span>Table</span></li>
							<li><span>Add New Table</span></li>
						</ol>
						<a class="sidebar-right-toggle" data-open="sidebar-right"></a>
					</div>
				</header>

				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<form action="manage-insert.php" method="POST" enctype="multipart/form-data">
							<section class="panel">
								<header class="panel-heading">
									<div class="panel-actions">
										<a href="#" class="fa fa-caret-down"></a>
										<a href="#" class="fa fa-times"></a>
									</div>
									<h2 class="panel-title">Tables</h2>
									<p class="panel-subtitle">To add <code>Tables</code>, please fill up all fields.</p>
								</header>
								<div class="panel-body">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label">Table Name</label>
												<input type="text" name="tablename" class="form-control" required
													placeholder="eg: TBL-01">
											</div>
										</div>

										<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label">Chair Count</label>
												<input type="number" name="chaircount" class="form-control" required
													placeholder="eg: 4" min="1" max="12" step="1">
											</div>
										</div>


									</div>
								</div>


								<footer class="panel-footer">
									<input type="submit" name="addtable" class="btn btn-primary" value="Add Table">
								</footer>
							</section>
						</form>
					</div>
				</div>
			</section>
		</div>
		<?php include 'template/right-bar.php'; ?>
	</section>
	<!-- Vendor -->
	<script src="assets/vendor/jquery/jquery.js"></script>
	<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
	<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
	<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="assets/javascripts/theme.js"></script>

	<!-- Theme Custom -->
	<script src="assets/javascripts/theme.custom.js"></script>

	<!-- Theme Initialization Files -->
	<script src="assets/javascripts/theme.init.js"></script>

</body>

</html>


