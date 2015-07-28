<?php 
    if( getVarClean("user_name","str","") == "" ) :
?>
<script>
    loadContentWithParams("pay_process-payment_login.php",{
        url_redirect : "pay_process-stp_pay_acc.php"    
    });
</script>
<?php endif; ?>

<!-- Bootgrid Dialog -->
<link rel="stylesheet" href="<?php echo BS_PATH; ?>bootgrid/jquery.bootgrid.css" />
<link rel="stylesheet" href="<?php echo BS_PATH; ?>bootgrid/modification.css" />
<script src="<?php echo BS_PATH; ?>bootgrid/jquery.bootgrid.min.js"></script>
<script src="<?php echo BS_PATH; ?>bootgrid/properties.js"></script>
<script src="<?php echo BS_PATH; ?>bootgrid/jquery.number.min.js"></script>

<div class="page-header">
	<h1>
		Payment Process
		<small>
			<i class="ace-icon fa fa-angle-double-right"></i>
			STP Pay Acc
		</small>
	</h1>
</div><!-- /.page-header -->

<div class="row" id="row-content">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="row">
		    <div id="filter-group" class="col-xs-12 col-lg-5">
              <div class="input-group">
                <input id="form_user_name" type="hidden" value="<?php echo getVarClean("user_name","str",""); ?>">
                <input id="inputServiceNo" class="form-control" placeholder="Input Your Service Number">
                <span class="input-group-btn">
                    <button id="btnProses" class="btn btn-info btn-sm">
                        <span class="ace-icon fa fa-search icon-on-right bigger-110"></span> Do Process
                    </button>
                </span>
              </div>
            </div>
		</div>
        <div class="space-4"> </div>
        <div class="row" id="table-group" style="display:none;">
            
            <div class="col-xs-12">
              <p>
                <button type="button" class="btn btn-pink btn-xs" id="backButton">
      	          <span class="ace-icon fa fa-angle-double-left" aria-hidden="true"></span> Back
                </button>
              </p>
              <table id="grid-selection" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th data-identifier="true" data-visible = "false" data-type="string" data-header-align="center" data-align="center" data-column-id="ID"> ID </th>
                     <th data-column-id="account_no" data-header-align="center" data-align="center" data-width="150">Account</th>
                     <th data-column-id="service_no" data-header-align="center" data-align="center" data-width="150">Service No</th>
                     <th data-column-id="finance_period_code" data-header-align="center" data-align="center">Period</th>
                     <th data-column-id="payment_charge_amt" data-align="right" data-formatter="payment_charge_amt">Invoice</th>
                     <th data-column-id="payment_vat_amt" data-align="right" data-formatter="payment_vat_amt">Vat</th>
                     <th data-column-id="stamp_duty_fee" data-align="right" data-formatter="stamp_duty_fee">Stamp Duty <br/> Fee</th>
                     <th data-column-id="penalty_amount" data-align="right" data-formatter="penalty_amount">Penalty</th>
                  </tr>
                </thead>
              </table>
            </div>
            
            <div class="col-xs-12 col-lg-4">
            	 <div class="panel panel-info">
            		   <!-- Default panel contents -->
            		  <div class="panel-heading"><h4>PAYMENT SUMMARY</h4></div>
            	      <div class="panel-body">
            	       <h5><span class="label label-warning">Total Invoice (Rp) : </span></h5> <input type="text" class="form-control priceformat" id="totalInvoiceField" placeholder="0">
            		   <h5><span class="label label-warning">Stamp Duty Fee (Rp) :  </span></h5> <input type="text" class="form-control priceformat" id="totalStampDutyField" placeholder="0">
            		   <h5><span class="label label-warning">Penalty (Rp) :  </span></h5> <input type="text" class="form-control priceformat" id="totalPenaltyField" placeholder="0">
            		   <h5><span class="label label-success">GRAND TOTAL (Rp) :  </span></h5> <input type="text" class="form-control priceformat" id="grandTotalField" placeholder="0">
            
            			<br/>
            			<button id="btnPembayaran" class="btn btn-primary btn-sm">Do Payment</button>
            		  </div>
            	 </div>
            </div>  
        </div>
    </div>
</div>

<script>

/* jquery on load */
jQuery(function($) {
      
	  $(".priceformat").number( true, 0 , ',', '.'); /* price number format on summary group */
	  $(".priceformat").css("font-weight", "bold");

      $("#btnProses").on(ace.click_event, function () {
          doProses();
      });

	  $("#inputServiceNo").keyup(function(e){
		 if(e.keyCode == 13) { /* on enter */
			doProses();
		 }
	  });
	  
	  $("#backButton").on(ace.click_event, function () {
          loadContentWithParams('pay_process-stp_pay_acc.php',
          {
            user_name : $("#form_user_name").val() 
          });
      });

      $("#btnPembayaran").on(ace.click_event, function () {

          if($("#grid-selection").bootgrid("getSelectedRows") == "") {
                BootstrapDialog.show({
                    type: BootstrapDialog.TYPE_WARNING,
    		    	size: BootstrapDialog.SIZE_NORMAL,
    		    	title: 'Attention',
    		    	message: 'No data payment selected on table. Please put a check <span class="glyphicon glyphicon-check" /> your data payment'
			    });
			    return;
          }

          BootstrapDialog.show({
            size: BootstrapDialog.SIZE_SMALL,
            type: BootstrapDialog.TYPE_INFO,
            title: 'Payment Confirmation',
            message: 'Your Total Payment : <b> Rp. ' + $.number($("#grandTotalField").val(), 0, ',', '.') + '</b>. Are You sure to make a payment?',
            buttons: [{

                cssClass: 'btn-primary btn-sm',
                label: 'Yes, Do Payment',
                action: function() {

                }
            }, {
                icon: 'glyphicon glyphicon-remove',
                cssClass: 'btn-danger btn-sm',
                label: 'Cancel',
                action: function(dialogItself){
                     dialogItself.close();
                }
            }]
          });

      });
});


function doProses() {
    var responseError = false;

	/* cek input */
	if( $("#inputServiceNo").val() == "" ) {
	   showBootDialog(true, BootstrapDialog.TYPE_INFO, 'Information', 'Please Input Your Service Number');
	   return;
	}

	/* show progress bar modal */
	var progressBarDialog = BootstrapDialog.show({
	    closable:false,
	    title: 'Processing Your Request',
	    message: properties.bootgridinfo.progressbar
	});

    $("#grid-selection").bootgrid("destroy");

	/************************** Start Setting Bootgrid ******************/
	$("#grid-selection").bootgrid({
	     formatters: {
            "payment_charge_amt" : function (column, row) {
				return $.number(row.PAYMENT_CHARGE_AMT, 0, ',', '.') + '<input id="' + row.ID + '-payment_charge_amt" readonly  type="hidden" value="' + row.PAYMENT_CHARGE_AMT + '" />';
            },
            "payment_vat_amt" : function (column, row) {
				return $.number(row.PAYMENT_VAT_AMT, 0, ',', '.') + '<input id="' + row.ID + '-payment_vat_amt" readonly  type="hidden" value="' + row.PAYMENT_VAT_AMT + '" />';
            },
            "stamp_duty_fee" : function (column, row) {
                return $.number(row.STAMP_DUTY_FEE, 0, ',', '.') + '<input id="' + row.ID + '-stamp_duty_fee" readonly  type="hidden" value="' + row.STAMP_DUTY_FEE + '" />';
            },
            "penalty_amount" : function (column, row) {
				return $.number(row.PENALTY_AMOUNT, 0, ',', '.') + '<input id="' + row.ID + '-penalty_amount" readonly  type="hidden" value="' + row.PENALTY_AMOUNT + '" />';
            }
         },
	     labels: {
	        loading     : properties.bootgridinfo.loading
	     },
	     rowCount:[10,25,50,100,-1],
		 navigation: 0,
	     ajax: true,
	     post: function () {
	         /* To accumulate custom parameter with the request object */
	         return {
	             service_no : $("#inputServiceNo").val()
	         };
	     },
	     requestHandler:function(request) {
	        if(request.sort) {
	            request.sortby = Object.keys(request.sort)[0];
	            request.sortdir = request.sort[request.sortby];
	            delete request.sort;
	        }
	        return request;
	     },
	     responseHandler:function (response) {
	        /* cek response if needed */
	        if(response.success == false) {
	            progressBarDialog.close();
	            showBootDialog(true, BootstrapDialog.TYPE_WARNING, 'Attention', response.message);
	            responseError = true;
	        }
	        return response;
	     },
	     url: "<?php echo PAYMENT_WS_URL.'ws.php?type=json&module=paymentccbs&class=payment&method=stp_pay_acc'; ?>",
	     searchSettings:{
	        delay:100,
	        characters: 3
	     },
	     selection: true,
	     multiSelect: true,
	     rowSelect: false,
	     keepSelection: false,
	     sorting:false
	});
	resize_bootgrid();
	/************************** End Setting Bootgrid ******************/

	/* bootgrid on leaded data . hide filter, close progress bar, and show table */
    $("#grid-selection").bootgrid().on("loaded.rs.jquery.bootgrid",function(e){

       if(!responseError) {
           setTimeout( function(){
                progressBarDialog.close();

                $("#filter-group").hide();
                $("#table-group").show();

    			/* as default , all rows are selected */
    			var arr = new Array();
                for (var i = 0; i < $("#grid-selection").bootgrid("getCurrentRows").length; i++) {
                	arr[i] = $("#grid-selection").bootgrid("getCurrentRows")[i].ID;
                }
                $("#grid-selection").bootgrid("select", arr);

           }, 1000 );
       }else {
            progressBarDialog.close();
            $("#grid-selection").bootgrid("destroy");
       }
	});

	var totalInvoice = 0;
	var totalStampDuty = 0;
	var totalPenalty = 0;
	var grandTotal = 0;

	/* ketika row selected */
	$("#grid-selection").bootgrid().on("selected.rs.jquery.bootgrid", function (e, selectedRows){
    	var row,
		payment_charge_amt = 0,
		payment_vat_amt = 0,
		stamp_duty_fee = 0,
		penalty_amount = 0;

        for (var i = 0; i < selectedRows.length; i++) {
        	row = selectedRows[i];
            payment_charge_amt = $("#grid-selection").find("#" + row.ID + "-payment_charge_amt").val();
			payment_vat_amt = $("#grid-selection").find("#" + row.ID + "-payment_vat_amt").val();
			stamp_duty_fee = $("#grid-selection").find("#" + row.ID + "-stamp_duty_fee").val();
			penalty_amount = $("#grid-selection").find("#" + row.ID + "-penalty_amount").val();

            totalInvoice += parseInt(payment_charge_amt) + parseInt(payment_vat_amt);
			totalStampDuty += parseInt(stamp_duty_fee);
			totalPenalty += parseInt(penalty_amount);

        }
		grandTotal = totalInvoice + totalStampDuty - totalPenalty;
		$("#totalInvoiceField").val( totalInvoice );
		$("#totalStampDutyField").val( totalStampDuty );
		$("#totalPenaltyField").val( totalPenalty );
		$("#grandTotalField").val( grandTotal );
    });

	/* ketika row deselected */
	$("#grid-selection").bootgrid().on("deselected.rs.jquery.bootgrid", function (e, deselectedRows){
    	var row,
		payment_charge_amt = 0,
		payment_vat_amt = 0,
		stamp_duty_fee = 0,
		penalty_amount = 0;

        for (var i = 0; i < deselectedRows.length; i++) {
        	row = deselectedRows[i];
            payment_charge_amt = $("#grid-selection").find("#" + row.ID + "-payment_charge_amt").val();
			payment_vat_amt = $("#grid-selection").find("#" + row.ID + "-payment_vat_amt").val();
			stamp_duty_fee = $("#grid-selection").find("#" + row.ID + "-stamp_duty_fee").val();
			penalty_amount = $("#grid-selection").find("#" + row.ID + "-penalty_amount").val();

            totalInvoice -= parseInt(payment_charge_amt) + parseInt(payment_vat_amt);
			totalStampDuty -= parseInt(stamp_duty_fee);
			totalPenalty -= parseInt(penalty_amount);
        }

		grandTotal = totalInvoice + totalStampDuty - totalPenalty;
		$("#totalInvoiceField").val( totalInvoice);
		$("#totalStampDutyField").val( totalStampDuty );
		$("#totalPenaltyField").val( totalPenalty );
		$("#grandTotalField").val( grandTotal );
    });
}

</script>