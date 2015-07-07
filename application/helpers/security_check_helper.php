<?php

function check_login($ws = '') {
	$ci =& get_instance();
	$isLoggedIn = $ci->session->userdata('logged_in');
	
	if(empty($isLoggedIn)) {
		
		if(!empty($ws)) { //request from Web Service (ws.php)
			throw new Exception('Maaf, Session login Anda telah habis atau Anda belum login. <br/> Silahkan <a href="'.BASE_URL.'base/index">Login</a> terlebih dahulu agar dapat mengakses halaman ini.');
		}else {
			redirect('base/index');
		}
	}
	return true;
}

function check_permission($module_name, $privileges) {
	
}

?>