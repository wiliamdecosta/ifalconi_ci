<?php 
function check_payment_login($url_redirect) {
    
    /* ----------------------- check login first ------------------------ */
    if( getVarClean("p_user_loket_id","str","") == "" or 
            getVarClean("user_name","str","") == "" ) :
        echo '<script>
                loadContentWithParams("pay_process-payment_login.php",{
                    url_redirect : "'.$url_redirect.'"
                });
            </script>';
        
    else :
        
         /* re-check login */
        $ci = & get_instance();
    	$ci->load->model('pay_param/p_user_loket');
    	$table = $ci->p_user_loket;
    	
    	$p_user_loket_id = $table->revalid_login( getVarClean("p_user_loket_id","int",0), getVarClean("user_name","str",""));
    	if(empty($p_user_loket_id)) :
    	    echo '<script>
                loadContentWithParams("pay_process-payment_login.php",{
                    url_redirect : "'.$url_redirect.'"
                });
            </script>';
    	    
    	endif;
    endif;
    /* ----------------------- end check login ------------------------ */
}
?>
