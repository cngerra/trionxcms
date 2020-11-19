	<!-- top navigation -->
	<div class="top_nav">
		<div class="nav_menu">
			<div class="nav toggle">
				<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			</div>

			<nav class="nav navbar-nav">
				<ul class=" navbar-right">
					<li class="nav-item dropdown open" style="padding-left: 15px;">
						<a href="javascript:void(0);" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
							<?php echo getAvatar($fname." ".$lname, $avatar_color, "marginr15"); ?><?php echo $fname." ".$lname; ?>
						</a>
						<div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
							<a class="dropdown-item"  href="javascript:;"> Profile</a>
							<a class="dropdown-item"  href="javascript:;"> <span class="badge bg-red pull-right">50%</span> <span>Settings</span></a>
							<a class="dropdown-item"  href="javascript:;">Help</a>
							<a class="dropdown-item"  href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
						</div>
					</li>
					<li role="presentation" class="nav-item dropdown open">
						<a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
							<i class="fa fa-envelope-o"></i><span class="badge bg-green">6</span>
						</a>
						<ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
							<li class="nav-item">
								<a class="dropdown-item">
									<span class="image"><img src="<?php echo base_url(); ?>assets/images/img.jpg" alt="Profile Image" /></span>
									<span>
										<span>John Smith</span>
										<span class="time">3 mins ago</span>
									</span>
									<span class="message">
										Film festivals used to be do-or-die moments for movie makers. They were where...
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="dropdown-item">
									<span class="image"><img src="<?php echo base_url(); ?>assets/images/img.jpg" alt="Profile Image" /></span>
									<span>
										<span>John Smith</span>
										<span class="time">3 mins ago</span>
									</span>
									<span class="message">
										Film festivals used to be do-or-die moments for movie makers. They were where...
									</span>
								</a>
							</li>
							<li class="nav-item">
								<div class="text-center">
									<a class="dropdown-item">
										<strong>See All Alerts</strong>
										<i class="fa fa-angle-right"></i>
									</a>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<!-- /top navigation -->
	<div class="right_col" role="main">
		<div class="page-title">
			<div class="title_left"><h1><?php echo $titleText; ?></h1></div>
			<?php if ($isBtnPresent){ ?>
			<div class="title_right">
				<button type="button" name="<?php echo $btnName; ?>" class="btn btn-secondary source-sans-600 pull-right" data-toggle="modal" onclick="<?php echo $btnFunction; ?>"><?php echo $btnText; ?></button>
			</div>
			<?php } ?>
		</div>
		<div class="clearfix"></div>