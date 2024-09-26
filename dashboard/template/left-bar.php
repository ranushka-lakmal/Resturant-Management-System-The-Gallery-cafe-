<aside id="sidebar-left" class="sidebar-left">
				
	<div class="sidebar-header">
		<div class="sidebar-title">
			Navigation
		</div>
		<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<div class="nano">
		<div class="nano-content">
			<nav id="menu" class="nav-main" role="navigation">
				<ul class="nav nav-main">
					<li class="nav-active">
						<a href="index.php">
							<i class="fa fa-home" aria-hidden="true"></i>
							<span>Dashboard</span>
						</a>
					</li>


					<?php if((isset($_SESSION['isLoggedIn']))){ ?>
					<li class="nav-parent">
						<a>
							<i class="fa fa-user" aria-hidden="true"></i>
							<span>Staff Management</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a href="staff-add.php">
									<span class="pull-right label label-primary">add</span>
									<i class="fa fa-plus-square" aria-hidden="true"></i>
									<span>Add Staff Member</span>
								</a>
							</li>
							<li>
								<a href="staff-manage.php">
									<span class="pull-right label label-info">list</span>
									<i class="fa fa-list-ul" aria-hidden="true"></i>
									<span>Manage Staff</span>
								</a>
							</li>
						</ul>
					</li>
					<?php } ?>

					<?php if((isset($_SESSION['isLoggedIn']))){ ?>
					<li class="nav-parent">
						<a>
							<i class="fa fa-users" aria-hidden="true"></i>
							<span>User Management</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a href="user-add.php">
									<span class="pull-right label label-primary">add</span>
									<i class="fa fa-plus-square" aria-hidden="true"></i>
									<span>Add User</span>
								</a>
							</li>
							<li>
								<a href="user-list.php">
									<span class="pull-right label label-info">list</span>
									<i class="fa fa-list-ul" aria-hidden="true"></i>
									<span>Manage Users</span>
								</a>
							</li>
						</ul>
					</li>
					<?php } ?>

					<?php if((isset($_SESSION['isLoggedIn']))){ ?>
					<li class="nav-parent">
						<a>
							<i class="fa fa-table" aria-hidden="true"></i>
							<span>Table Managemet</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a href="table-add.php">
									<span class="pull-right label label-primary">add</span>
									<i class="fa fa-plus-square" aria-hidden="true"></i>
									<span>Add Table</span>
								</a>
							</li>
							<li>
								<a href="table-list.php">
									<span class="pull-right label label-info">list</span>
									<i class="fa fa-eye" aria-hidden="true"></i>
									<span>View Table</span>
								</a>
							</li>
						</ul>
					</li>
					<?php } ?>

					<?php if((isset($_SESSION['isLoggedIn']))){ ?>
					<li class="nav-parent">
						<a>
							<i class="fa fa-cutlery" aria-hidden="true"></i>
							<span>Menu Item</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a href="menu-add.php">
									<span class="pull-right label label-primary">add</span>
									<i class="fa fa-plus-square" aria-hidden="true"></i>
									<span>Menu Item Add</span>
								</a>
							</li>
							<li>
								<a href="menu-list.php">
									<span class="pull-right label label-info">list</span>
									<i class="fa fa-eye" aria-hidden="true"></i>
									<span>Menu Item View</span>
								</a>
							</li>
						</ul>
					</li>
					<?php } ?>

					<?php if((isset($_SESSION['isLoggedIn']) )){ ?>
					<li class="nav-parent">
						<a>
							<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
							<span>Booking</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a href="booking-list.php">
									<span class="pull-right label label-info">list</span>
									<i class="fa fa-eye" aria-hidden="true"></i>
									<span>Booking</span>
								</a>
							</li>
						</ul>
					</li>
					<?php } ?> 

				</ul>
			</nav>

			<hr class="separator" />
		</div>

	</div>

</aside>


