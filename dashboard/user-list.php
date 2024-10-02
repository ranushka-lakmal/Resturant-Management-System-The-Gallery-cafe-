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
	<style>
		/* Custom Dropdown Styles */
.dropdown-menu a {
    display: flex;
    align-items: center;
    padding: 4px 6px;
    font-size: 14px;
    transition: background-color 0.2s ease;
}

.dropdown-menu a i {
    margin-right: 8px;
}

.dropdown-menu a:hover {
    background-color: #f0f0f0;
}

.btn-light {
    background-color: white;
    color: #333;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

}

.badge {
    padding: 5px 10px;
    font-size: 12px;
    border-radius: 5px;
}

.badge-success {
    background-color: #28a745;
}

.badge-danger {
    background-color: #dc3545;
}

.badge-warning {
    background-color: #ffc107;
}

	</style>
	<section class="body">

		<!-- start: header -->
		<?php include 'template/top-bar.php'; ?>
		<!-- end: header -->

		<div class="inner-wrapper">
			<!-- start: sidebar -->
			<?php include 'template/left-bar.php'; ?>
			<!-- end: sidebar -->

			<section role="main" class="content-body">
				<header class="page-header">
					<h2>User List</h2>
				
					<div class="right-wrapper pull-right">
						<ol class="breadcrumbs">
							<li>
								<a href="index.php">
									<i class="fa fa-home"></i>
								</a>
							</li>
							<li><span>Tables</span></li>
							<li><span>View Users</span></li>
						</ol>
				
						<a class="sidebar-right-toggle" data-open="sidebar-right"></i></a>
					</div>
				</header>

				<!-- start: page -->
				<section class="panel">
					<header class="panel-heading">
						<div class="panel-actions">
							<a href="#" class="fa fa-caret-down"></a>
							<a href="#" class="fa fa-times"></a>
						</div>
				
						<h2 class="panel-title">All Users</h2>
					</header>
					<div class="panel-body">
						<table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
							<thead>
								<tr>
									<th>No</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Gender</th>
									<th>Address</th>
									<th>Password</th> <!-- Password column added here -->
                                    <th>Status</th>
									<th class="hidden-phone">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$count = 1;
								include 'dbCon.php';
								$con = connect();
								$sql = "SELECT * FROM `users`;";
								$result = $con->query($sql);
								foreach ($result as $r) {
								?>
								<tr class="gradeX">
									<td class="center hidden-phone"><?php echo $count; ?></td>
									<td><?php echo $r['username']; ?></td>
									<td><?php echo $r['email']; ?></td>
									<td><?php echo $r['phone']; ?></td>
									<td><?php echo $r['gender']; ?></td>
									<td><?php echo $r['address']; ?></td>
									<td>
										<span id="password-<?php echo $r['id']; ?>" class="password-hidden">••••••••</span> 
										<i class="fa fa-eye" onclick="togglePassword(<?php echo $r['id']; ?>)" style="cursor:pointer;"></i>
									</td>
                                   
	
									<!-- Modify the status dropdown button and badge colors -->
<td id="status-<?php echo $r['id']; ?>">
    <div class="dropdown">
        <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="statusDropdown-<?php echo $r['id']; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php 
            if ($r['status'] == 1) {
                echo '<span class="badge" style="background-color: #007bff; color: white;">Active</span>'; // Blue for active
            } elseif ($r['status'] == 9) {
                echo '<span class="badge" style="background-color: #dc3545; color: white;">Inactive</span>'; // Red for inactive
            } else {
                echo '<span class="badge" style="background-color: #ffc107; color: black;">Pending</span>'; // Yellow for pending
            }
            ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="statusDropdown-<?php echo $r['id']; ?>" style="min-width: 160px;">
            <a class="dropdown-item" href="#" onclick="changeStatus(<?php echo $r['id']; ?>, 1)">
                <i class="fa fa-check text-primary"></i> Active
            </a>
            <a class="dropdown-item" href="#" onclick="changeStatus(<?php echo $r['id']; ?>, 9)">
                <i class="fa fa-times text-danger"></i> Inactive
            </a>
           
        </div>
    </div>
</td>

									<td class="center hidden-phone">
										<a href="user-edit.php?id=<?php echo $r['id']; ?>" class="btn btn-primary">Edit</a>
										<a href="user-delete.php?id=<?php echo $r['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
									</td>
								</tr>
								<?php $count++; } ?>
							</tbody>
						</table>
					</div>
				</section>
				<!-- end: page -->
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
	
	<!-- Specific Page Vendor -->
	<script src="assets/vendor/select2/select2.js"></script>
	<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
	<script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
	<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
	
	<!-- Theme Base, Components and Settings -->
	<script src="assets/javascripts/theme.js"></script>
	
	<!-- Theme Custom -->
	<script src="assets/javascripts/theme.custom.js"></script>
	
	<!-- Theme Initialization Files -->
	<script src="assets/javascripts/theme.init.js"></script>

	<!-- Examples -->
	<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
	<script src="assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
	<script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>

	<!-- JavaScript to toggle password visibility -->
	<script>
		function togglePassword(id) {
		    var passwordSpan = document.getElementById("password-" + id);
		    if (passwordSpan.classList.contains('password-hidden')) {
		        passwordSpan.textContent = "<?php echo $r['password']; ?>"; // Display the password
		        passwordSpan.classList.remove('password-hidden');
		    } else {
		        passwordSpan.textContent = "••••••••"; // Hide the password
		        passwordSpan.classList.add('password-hidden');
		    }
		}
	</script>

<script>
function changeStatus(userId, status) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "change_status.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // On success, update the status label
            var statusElement = document.getElementById("status-" + userId);
            var dropdownHTML = '<div class="dropdown">' +
                '<button class="btn btn-light btn-sm dropdown-toggle" type="button" id="statusDropdown-' + userId + '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';

            if (status == 1) {
                dropdownHTML += '<span class="badge" style="background-color: #007bff; color: white;">Active</span>'; // Blue for Active
            } else if (status == 9) {
                dropdownHTML += '<span class="badge" style="background-color: #dc3545; color: white;">Inactive</span>'; // Red for Inactive
            } 
            
            dropdownHTML += '</button>' +
                '<div class="dropdown-menu" aria-labelledby="statusDropdown-' + userId + '" style="min-width: 160px;">' +
                '<a class="dropdown-item" href="#" onclick="changeStatus(' + userId + ', 1)"><i class="fa fa-check text-primary"></i> Active</a>' +
                '<a class="dropdown-item" href="#" onclick="changeStatus(' + userId + ', 9)"><i class="fa fa-times text-danger"></i> Inactive</a>' +
                
                '</div></div>';

            statusElement.innerHTML = dropdownHTML;
        }
    };
    
    xhr.send("user_id=" + userId + "&status=" + status);
}

</script>
</body>
</html>
