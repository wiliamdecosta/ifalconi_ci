<div class="row" style="display:none;" id="user_form_add_edit">
    <div class="col-xs-12">
        <div class="well well-sm">
		    <div class="inline middle blue bigger-150" id="user_form_title"> Add/Edit Bank </div>
		</div>
        <form class="form-horizontal" role="form" id="user_form">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right"> User Name *</label>
                <div class="col-sm-9">
                    <input id="form_p_user_id" type="hidden" placeholder="Area ID">
                    <input id="form_user_name" class="col-xs-10 col-sm-5 required" type="text">
                </div>
                
                <label class="col-sm-3 control-label no-padding-right"> Full Name *</label>
                <div class="col-sm-9">
                    <input id="form_full_name" class="col-xs-10 col-sm-5 required" type="text">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right"> Description </label>
                <div class="col-sm-9">
                    <textarea id="form_description" class="col-xs-10 col-sm-5" type="text"></textarea>
                </div>
            </div>
            
            <?php
			    $ci =& get_instance();
	            $user_name = $ci->session->userdata('user_name');
			?>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right"> Created By </label>
                <div class="col-sm-9">
                    <input id="form_created_by" disabled type="text" value="<?php echo $user_name; ?>">
                    &nbsp;  <input id="form_creation_date" disabled type="text" value="<?php echo date("Y-m-d"); ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right"> Updated By </label>
                <div class="col-sm-9">
                    <input id="form_updated_by" disabled type="text" value="<?php echo $user_name; ?>">
                    &nbsp; <input id="form_updated_date" disabled type="text" value="<?php echo date("Y-m-d"); ?>">
                </div>
            </div>

           <div class="space-4"></div>

           <div class="clearfix form-actions">
		        <div class="col-md-offset-3 col-md-9">
			      	<button type="button" class="btn btn-primary btn-round" id="user_form_btn_save">
			      		<i class="ace-icon fa fa-floppy-o bigger-120"></i>
			      		Save
			      	</button>
                    
                    <button type="reset" class="btn btn-danger btn-round" id="user_form_btn_cancel">
                        <i class="glyphicon glyphicon-circle-arrow-left bigger-120"></i>
                        Cancel
                    </button>
			      	
			    </div>
		   </div>
       </form>
    </div>
</div>


<script>
    jQuery(function($) {
        $("#user_form_btn_cancel").on(ace.click_event, function() {
            user_toggle_main_content();
        });
    
        $("#user_form_btn_save").on(ace.click_event, function() {
            user_save();
        });
    });

    function user_toggle_main_content() {
        $("#user_form")[0].reset();
        $("#user_form_add_edit").hide();
        $("#user_row_content").toggle("slow");
    }

    function user_show_form_add() {
        user_toggle_main_content();
        $("#user_form_add_edit").show("slow");
        $("#user_form_title").html("Add User");
    }

    function user_show_form_edit(theID) {
        user_toggle_main_content();
        $("#user_form_add_edit").show("slow");
        $("#user_form_title").html("Edit User");
        
        $("#form_p_user_id").val(theID);
        $.post( "<?php echo WS_URL.'adm_sistem.p_user_controller/read'; ?>",
            {
                p_user_id : $("#form_p_user_id").val()
            },
            function( response ) {
                if(response.success == false) {
                    showBootDialog(true, BootstrapDialog.TYPE_DANGER, 'Warning', response.message);
                }else {
        	        var obj = response.items[0];
        	        
        	        $("#form_p_user_id").val(obj.p_user_id);
        	        $("#form_description").val(obj.description);
        	        
        	        $("#form_created_by").val(obj.created_by);
        	        $("#form_creation_date").val(obj.creation_date);
        	        $("#form_updated_by").val(obj.updated_by);
        	        $("#form_updated_date").val(obj.updated_date);
        	        
                }
            }
        );
        
    }

    function user_save() {
        var action_execute = "";

        //jika ID kosong, panggil method create. Jika ID ada, maka panggil method update
        action_execute = ( $("#form_p_user_id").val() == "") ? "create" : "update";
        $.post( "<?php echo WS_URL.'adm_sistem.p_user_controller/'; ?>" + action_execute,
            {items: JSON.stringify({
                    p_user_id           : $("#form_p_user_id").val(),
                    description         : $("#form_description").val()
                })
            },
            function( response ) {
                if(response.success == false) {
                    showBootDialog(true, BootstrapDialog.TYPE_DANGER, 'Warning', response.message);
                }else {
        	        loadContent('adm_sistem-p_user');
                    showBootDialog(true, BootstrapDialog.TYPE_SUCCESS, 'Information', response.message);
                }
            }
        );
    }
</script>