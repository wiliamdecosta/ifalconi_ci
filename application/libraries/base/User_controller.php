<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class User_controller
* @version 07/05/2015 12:20:52
*/
class User_controller {

    function getInfo() {

    	$ci =& get_instance();
	    $uid = $ci->session->userdata('p_user_id');

        $data = array('data' => array(), 'success' => false, 'message' => '');

        try{
            if (empty($uid)){
                throw new Exception('Bad Params : Empty UserID');
            }

            $ci = & get_instance();
		    $ci->load->model('base/user');
		    $table = $ci->user;

            $data['data'] = $table->get($uid);
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }
        return $data;

    }

    function updateInfo() {

		$user_password1 = trim(getVarClean('user_password1', 'str', ''));
		$user_password2 = trim(getVarClean('user_password2', 'str', ''));

		$user_email = trim(getVarClean('user_email', 'str', ''));
		$user_realname = trim(getVarClean('user_realname', 'str', ''));

        $data = array('items' => array(), 'total' => 0, 'success' => false, 'message' => '');

    	$ci =& get_instance();
	    $uid = $ci->session->userdata('p_user_id');

        try{
            if (empty($uid)){
                throw new Exception('Bad Params : Empty UserID');
            }

	        $ci->load->model('base/user');
	        $table = $ci->user;
	        
	        $table->actionType = 'UPDATE';

	        $record = array('p_user_id' => $uid,
	                        'email_address' => $user_email,
	                        'full_name' => $user_realname);

            if (!empty($user_password1)){
                if (strcmp($user_password1, $user_password2) != 0) throw new Exception("Your password does not match. Please check again.");

                if (strlen($user_password1) < 5) throw new Exception("Mininum password length is 5 characters");

                $record['user_pwd'] = $user_password1;
	        }

	        $table->setRecord($record);
	        $table->update();
            
            $userdata = array('p_user_id'	=> $record['p_user_id'],
						  'user_name' 	    => $ci->session->userdata('user_name'),
						  'full_name'       => $record['full_name'],
						  'email_address' 	=> $record['email_address'],
						  'logged_in'	    => true
						  );
						  						  
			$ci->session->set_userdata($userdata);
			
	        $data['success'] = true;
	        $data['message'] = 'Update Profile Success';

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }
        return $data;

    }


}

/* End of file User_controller.php */
/* Location: ./application/libraries/base/User_controller.php */