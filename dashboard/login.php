<?php 
session_start();
?>
<!doctype html>
<html class="fixed">
	<head>
		<meta charset="UTF-8">
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Custom CSS for Animation -->
		<style>
			/* Fade in animation */
			.fade-in {
				opacity: 0;
				animation: fadeIn ease 1s;
				animation-fill-mode: forwards;
			}

			@keyframes fadeIn {
				0% { opacity: 0; }
				100% { opacity: 1; }
			}
		</style>

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
	</head>
	<body>
		<section class="body-sign fade-in">
			<div class="center-sign">
				<a href="" class="logo pull-left">
					<img src="assets/images/newlogo.png" height="74" alt="Admin" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
					</div>
					<div class="panel-body">
						<!-- Nav Tabs -->
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#adminLogin">Admin Login</a></li>
							<li><a data-toggle="tab" href="#staffLogin">Staff Login</a></li>
						</ul>

						<!-- Tab Content -->
						<div class="tab-content">
							<!-- Admin Login Form -->
							<div id="adminLogin" class="tab-pane fade in active">
								<form action="" method="POST">
									<div class="form-group mb-lg">
										<label>Email</label>
										<div class="input-group input-group-icon">
											<input name="email" type="email" class="form-control input-lg" required />
											<span class="input-group-addon">
												<span class="icon icon-lg"><i class="fa fa-user"></i></span>
											</span>
										</div>
									</div>
									<div class="form-group mb-lg">
										<label>Password</label>
										<div class="input-group input-group-icon">
											<input name="password" type="password" class="form-control input-lg" required />
											<span class="input-group-addon">
												<span class="icon icon-lg"><i class="fa fa-lock"></i></span>
											</span>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-8"></div>
										<div class="col-sm-4 text-right">
											<input type="submit" class="btn btn-primary btn-block" name="login_admin" value="Sign In">
										</div>
									</div>
								</form>
							</div>

							<!-- Staff Login Form -->
							<div id="staffLogin" class="tab-pane fade">
								<form action="" method="POST">
									<div class="form-group mb-lg">
										<label>Email</label>
										<div class="input-group input-group-icon">
											<input name="email" type="email" class="form-control input-lg" required />
											<span class="input-group-addon">
												<span class="icon icon-lg"><i class="fa fa-user"></i></span>
											</span>
										</div>
									</div>
									<div class="form-group mb-lg">
										<label>Password</label>
										<div class="input-group input-group-icon">
											<input name="password" type="password" class="form-control input-lg" required />
											<span class="input-group-addon">
												<span class="icon icon-lg"><i class="fa fa-lock"></i></span>
											</span>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-8"></div>
										<div class="col-sm-4 text-right">
											<input type="submit" class="btn btn-primary btn-block" name="login_staff" value="Sign In">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Vendor JS -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
	</body>
</html>

<?php
	if (isset($_POST['login_admin'])) {
		$email = $_POST['email'];
		$password = md5($_POST['password']);  // MD5 hash for admin

		include 'dbCon.php';
		$con = connect();

		// Check admin login
		$emailSQL = "SELECT * FROM admin WHERE email = '$email';";
		$emailResult = $con->query($emailSQL);

		if ($emailResult->num_rows <= 0) {
			echo '<script>alert("This Email Does Not Exist.")</script>';
			echo '<script>window.location="login.php"</script>';
		} else {
			$passwordSQL = "SELECT * FROM admin WHERE email = '$email' AND password = '$password';";
			$passwordResult = $con->query($passwordSQL);

			if ($passwordResult->num_rows <= 0) {
				echo '<script>alert("This Password is Incorrect.")</script>';
				echo '<script>window.location="login.php"</script>';
			} else {
				$_SESSION['isLoggedIn'] = TRUE;
				$admin = $passwordResult->fetch_assoc();
				$_SESSION['id'] = $admin['id'];
				$_SESSION['email'] = $admin['email'];
				echo '<script>window.location="index.php"</script>';
			}
		}
	}

	if (isset($_POST['login_staff'])) {
		$email = $_POST['email'];
		$password = md5($_POST['password']);  // MD5 hash for staff
	
		include 'dbCon.php';
		$con = connect();
	
		// Check staff login
		$emailSQL = "SELECT * FROM staff WHERE email = '$email';";
		$emailResult = $con->query($emailSQL);
	
		if ($emailResult->num_rows <= 0) {
			echo '<script>alert("This Email Does Not Exist.")</script>';
			echo '<script>window.location="login.php"</script>';
		} else {
			$staff = $emailResult->fetch_assoc();
			// Check the status of the staff
			if ($staff['status'] == 0) {
				echo '<script>alert("Your account is pending approval. Please wait for admin approval.")</script>';
				echo '<script>window.location="login.php"</script>';
			} elseif ($staff['status'] == 9) {
				echo '<script>alert("Your account has been deactivated. Please contact the admin.")</script>';
				echo '<script>window.location="login.php"</script>';
			} else {
				// Check if the password is correct
				$passwordSQL = "SELECT * FROM staff WHERE email = '$email' AND password = '$password';";
				$passwordResult = $con->query($passwordSQL);
	
				if ($passwordResult->num_rows <= 0) {
					echo '<script>alert("This Password is Incorrect.")</script>';
					echo '<script>window.location="login.php"</script>';
				} else {
					$_SESSION['isLoggedIn'] = TRUE;
					$_SESSION['id'] = $staff['id'];
					$_SESSION['email'] = $staff['email'];
					echo '<script>window.location="./staff-dashboard/staff_dashboard.php"</script>';
				}
			}
		}
	}
	
?>
