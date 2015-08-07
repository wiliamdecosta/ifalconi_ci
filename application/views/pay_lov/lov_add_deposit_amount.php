<div id="modal_lov_deposit" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
		    <!-- modal title -->
			<div class="modal-header no-padding">
				<div class="table-header">
					<span class="form-add-edit-title"> Add/Cancel Deposit </span>
				</div>
			</div>
            <input type="hidden" id="modal_lov_service_no_val" value="" />
            <input type="hidden" id="modal_lov_account_no_val" value="" />
            <input type="hidden" id="modal_lov_subscriber_id_val" value="" />

			<!-- modal body -->
			<div class="modal-body">
			    <p>
                  <button type="button" class="btn btn-sm btn-warning btn-round" id="modal_lov_deposit_btn_cancel_deposit">
  	                <span aria-hidden="true"></span> Cancel Deposit
                  </button>
                 </p>

				<table id="modal_lov_deposit_grid_selection" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                     <th data-column-id="t_deposit_id" data-sortable="false" data-visible="false">Deposit ID</th>
                     <th data-column-id="service_no" data-sortable="false" data-width="100">Service Number</th>
                     <th data-column-id="account_no" data-sortable="false" data-width="170">Account Number</th>
                     <th data-column-id="deposit_amount" data-formatter="deposit_amount" data-sortable="false" data-align="right">Deposit Amount</th>
                     <th data-column-id="trans_date" data-sortable="false">Trans. Date</th>
                     <th data-column-id="subs_name" data-sortable="false">Subscriber Name</th>
                     <th data-column-id="pic_name" data-sortable="false">PIC Name</th>
                  </tr>
                </thead>
                </table>
                
                <div class="well well-sm">
		            <div class="inline middle blue bigger-150" id="menu_form_title"> Add Deposit Amount </div>
		        </div>
		        
		        <form class="form-horizontal" application="form" id="deposit_form">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"> Deposit Amount (Rp) </label>
                        <div class="col-sm-4">
                            <input id="form_deposit_amount" class="col-xs-12 required priceformat align-right" type="text">
                        </div>
                        
                        <label class="col-sm-2 control-label no-padding-right"> Returnable </label>
                        <div class="col-sm-2">
                            <select id="form_is_returnable" class="col-xs-12">
                                <option value="Y">YES</option>
                                <option value="N">NO</option>
                    	    </select>
                        </div>
                    </div>
            
                    <div class="clearfix form-actions align-right">
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-success btn-round" id="form_btn_save_deposit">
        			      		<i class="ace-icon fa fa-floppy-o bigger-120"></i>
        			      		Save Deposit
    			      	    </button>
			      	    </div>
                    </div>
                </form>
			</div>

			<!-- modal footer -->
			<div class="modal-footer no-margin-top">
			    <div class="bootstrap-dialog-footer">
			        <div class="bootstrap-dialog-footer-buttons">
        				<button class="btn btn-danger btn-xs radius-4" data-dismiss="modal">
        					<i class="ace-icon fa fa-times"></i>
        					Close
        				</button>
    				</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.end modal -->

<script>

    jQuery(function($) {
                
        $("#modal_lov_deposit_btn_cancel_deposit").on(ace.click_event, function() {
            BootstrapDialog.show({
                type: BootstrapDialog.TYPE_INFO,
                title: 'Cancel Confirmation',
                message: 'The first record of the deposit list will be remove from table. Are You sure to continue?',
                buttons: [{
                    cssClass: 'btn-primary btn-sm',
                    label: 'Yes, Cancel Deposit',
                    action: function(dialogItself) {
                        /* show progress bar modal */
                        dialogItself.close();
                    	modal_lov_deposit_cancel_deposit();
                    }
                }, {
                    icon: 'glyphicon glyphicon-remove',
                    cssClass: 'btn-danger btn-sm',
                    label: 'No',
                    action: function(dialogItself){
                         dialogItself.close();
                    }
                }]
            });       
        });
        
        
        $("#form_btn_save_deposit").on(ace.click_event, function() {
            if($("#form_deposit_amount").val() == 0) {
                showBootDialog(true, BootstrapDialog.TYPE_INFO, 'Attention', 'Please fill your deposit amount');
                return;   
            }
            modal_lov_deposit_add_deposit();    
        });
    });

    function modal_lov_deposit_show(service_no, account_no, subscriber_id) {
        modal_lov_deposit_set_field_value(service_no, account_no, subscriber_id);
        $("#modal_lov_deposit").modal({backdrop: 'static'});
        modal_lov_deposit_prepare_table();
    }


    function modal_lov_deposit_set_field_value(service_no, account_no, subscriber_id) {
         $("#modal_lov_service_no_val").val(service_no);
         $("#modal_lov_account_no_val").val(account_no);
         $("#modal_lov_subscriber_id_val").val(subscriber_id);
    }

    function modal_lov_deposit_prepare_table() {
        $("#modal_lov_deposit_grid_selection").bootgrid({
            formatters: {
                "deposit_amount" : function (column, row) {
    				return $.number(row.deposit_amount, 2, '.',',');
                }
             },
    		 ajax: true,
    		 rowCount:[-1],
    		 navigation: 0,
    	     requestHandler:function(request) {
    	        if(request.sort) {
    	            var sortby = Object.keys(request.sort)[0];
    	            request.dir = request.sort[sortby];

    	            delete request.sort;
    	            request.sort = sortby;
    	        }
    	        return request;
    	     },
    	     responseHandler:function (response) {
    	        if(response.success == false) {
    	            showBootDialog(true, BootstrapDialog.TYPE_WARNING, 'Attention', response.message);
    	        }
    	        return response;
    	     },
       	     url : "<?php echo PAYMENT_WS_URL.'ws.php?type=json&module=paymentccbs&class=t_deposit&method=read'; ?>",
       	     post: function () {
    	         /* To accumulate custom parameter with the request object */
    	         return {
    	             subscriber_id : $("#modal_lov_subscriber_id_val").val()
    	         };
	         },
    	     selection: true,
    	     sorting:true,
    	     labels: {
    	        loading     : properties.bootgridinfo.loading
	         }
    	});
    	resize_bootgrid();
    }
    
    function modal_lov_deposit_cancel_deposit() {
        /* show progress bar */
            var progressBarDialog = BootstrapDialog.show({
        		    closable: false,
                    type: BootstrapDialog.TYPE_PRIMARY,
            		title: 'Processing Your Request',
            		message: properties.bootgridinfo.progressbar
        		});
        
            $.post( "<?php echo PAYMENT_WS_URL.'ws.php?type=json&module=paymentccbs&class=t_deposit&method=cancel_deposit'; ?>",
                {
                    subscriber_id       : $("#modal_lov_subscriber_id_val").val(),
                    p_user_loket_id     : 2
                },
                function( data ) {
                    progressBarDialog.close();
        
                    if(data.success) {
                        showBootDialog(true, BootstrapDialog.TYPE_SUCCESS, 'Information', data.message);
                        $("#modal_lov_deposit_grid_selection").bootgrid("reload");
                        get_deposit_amount();
                    }else {
                        showBootDialog(true, BootstrapDialog.TYPE_WARNING, 'Attention', data.message);
                    }
                }, "json"
            );
    }
    
    function modal_lov_deposit_add_deposit() {
        
        /* show progress bar */
            var progressBarDialog = BootstrapDialog.show({
        		    closable: false,
                    type: BootstrapDialog.TYPE_PRIMARY,
            		title: 'Processing Your Request',
            		message: properties.bootgridinfo.progressbar
        		});
        
            $.post( "<?php echo PAYMENT_WS_URL.'ws.php?type=json&module=paymentccbs&class=t_deposit&method=add_deposit'; ?>",
                {
                    service_no          : $("#modal_lov_service_no_val").val(),
                    account_no          : $("#modal_lov_account_no_val").val(),
                    subscriber_id       : $("#modal_lov_subscriber_id_val").val(),
                    p_user_loket_id     : 2,
                    deposit_amount      : $("#form_deposit_amount").val(),
                    is_returnable       : $("#form_is_returnable").val()
                },
                function( data ) {
                    progressBarDialog.close();
        
                    if(data.success) {
                        showBootDialog(true, BootstrapDialog.TYPE_SUCCESS, 'Information', data.message);
                        $("#modal_lov_deposit_grid_selection").bootgrid("reload");
                        $("#form_deposit_amount").val(0);
                        get_deposit_amount();
                    }else {
                        showBootDialog(true, BootstrapDialog.TYPE_WARNING, 'Attention', data.message);
                    }
                }, "json"
            );   
    }
    

</script>