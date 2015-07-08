<?php 
    $ci = & get_instance();
    if($ci->session->userdata('module_id') == 1):
?>
<ul class="nav nav-list">
	<li class="nav-menu-content active" data-source="dashboard.php">
		<a href="#">
			<i class="menu-icon fa fa-tachometer"></i>
			<span class="menu-text"> Dashboard </span>
		</a>
		<b class="arrow"></b>
	</li>

	<li class="">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-users"></i>
			<span class="menu-text">
				Users &amp; Groups
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>
		<b class="arrow"></b>

		<ul class="submenu">
			<li class="nav-menu-content" data-source="adm_sistem-p_user.php">
				<a href="#">
					<i class="menu-icon fa fa-caret-right"></i>
					USERS ADMINISTRATION
				</a>
				<b class="arrow"></b>
			</li>
		</ul>
	</li>

</ul><!-- /.nav-list -->

<?php elseif ($ci->session->userdata('module_id') == 4) : ?>

<ul class="nav nav-list">
	<li class="nav-menu-content active" data-source="dashboard.php">
		<a href="#">
			<i class="menu-icon fa fa-tachometer"></i>
			<span class="menu-text"> DASHBOARD </span>
		</a>
		<b class="arrow"></b>
	</li>

	<li class="">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-laptop"></i>
			<span class="menu-text">
				PARAMETER
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>
		<b class="arrow"></b>

		<ul class="submenu">
		    <li class="nav-menu-content" data-source="pay_param-p_bank.php">
				<a href="#">
					<i class="menu-icon fa fa-caret-right"></i>
					GROUP COUNTER
				</a>
				<b class="arrow"></b>
			</li>
			
			<li class="nav-menu-content" data-source="pay_param-p_area.php">
				<a href="#">
					<i class="menu-icon fa fa-caret-right"></i>
					AREA
				</a>
				<b class="arrow"></b>
			</li>
			
		</ul>
	</li>
		
	<li class="">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-laptop"></i>
			<span class="menu-text">
				PROCESS
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>
		<b class="arrow"></b>

		<ul class="submenu">
			<li class="nav-menu-content" data-source="pay_process-stp_pay_acc.php">
				<a href="#">
					<i class="menu-icon fa fa-caret-right"></i>
					STP PAY ACC
				</a>
				<b class="arrow"></b>
			</li>
		</ul>
	</li>

</ul><!-- /.nav-list -->
<?php endif; ?>