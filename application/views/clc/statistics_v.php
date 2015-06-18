<div id="clc_contents">
	<div id="stock_card" class="table_divs panel panel-success">
	  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">Stock Card</div>
	  	<table id="stock_card_table" class="display table table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr class="header_tr">
					<th colspan="4" id="stock_period"><b>Stocks as At End of April 2015</b></th>
				</tr>
				<tr class="header_tr">					
					<th>Commodity Name</th>
					<th>AMC</th>
					<th>Stock on Hand at Facility</th>
					<th>MOS Central</th>					
				</tr>				
			</thead>			
		</table>
	</div>
	<div id="highest_stocks" class="table_divs_stocks panel panel-success" style="width:49%;">
	  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">Facilities with Highest Stocks</div>
	  	<table id="screening_highest" class="highest_stocks_table display table " cellspacing="0" width="100%">
				<thead>
					<tr class="header_tr">
						<th colspan="4" id="stock_period"><b>Screening KHB Stocks</b></th>
					</tr>
					<tr>
						<th>MFL</th>
						<th>Facility Name</th>
						<th>Stock on Hand at Facility</th>					
					</tr>
					
				</thead>			
			</table>

			<table id="confirmatory_highest" class="highest_stocks_table display table" cellspacing="0" width="100%">
				<thead>
					<tr class="header_tr">
						<th colspan="4" id="stock_period"><b>Confirmatory Unigold Stocks</b></th>
					</tr>
					<tr>
						<th>MFL</th>
						<th>Facility Name</th>
						<th>Stock on Hand at Facility</th>					
					</tr>
					
				</thead>			
			</table>

			<table id="tiebreaker_highest" class="highest_stocks_table display table" cellspacing="0" width="100%">
				<thead>
					<tr class="header_tr">
						<th colspan="4" id="stock_period"><b>Tie-breaker Stocks</b></th>
					</tr>
					<tr>
						<th>MFL</th>
						<th>Facility Name</th>
						<th>Stock on Hand at Facility</th>					
					</tr>
					
				</thead>			
			</table>
	</div>		
	<div id="highest_expiries" class="table_divs_expiries panel panel-success" style="width:49%;">
	  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">Facilities with Highest Expiries</div>
	  	<table id="screening_expiries" class="highest_expiries_table display table table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr class="header_tr">
						<th colspan="4" id="stock_period"><b>Screening KHB Expiries</b></th>
					</tr>
					<tr>
						<th>MFL</th>
						<th>Facility Name</th>
						<th>Stock on Hand at Facility</th>					
					</tr>
					
				</thead>			
			</table>

			<table id="confirmatory_expiries" class="highest_expiries_table display table table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr class="header_tr">
						<th colspan="4" id="stock_period"><b>Confirmatory Unigold Expiries</b></th>
					</tr>
					<tr>
						<th>MFL</th>
						<th>Facility Name</th>
						<th>Stock on Hand at Facility</th>					
					</tr>
					
				</thead>			
			</table>

			<table id="tiebreaker_expiries" class="highest_expiries_table display table table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr class="header_tr">
						<th colspan="4" id="stock_period"><b>Tie-breaker Expiries</b></th>
					</tr>
					<tr>
						<th>MFL</th>
						<th>Facility Name</th>
						<th>Stock on Hand at Facility</th>					
					</tr>
					
				</thead>			
			</table>
	</div>		
	<div id="non-reported" class="table_divs_non_reported panel panel-success">
	  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">Facilities Not-Reported</div>
	  	<table id="stock_card_table" class="display table table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr class="header_tr">
					<th colspan="4" id="stock_period"><b>Facilities Not Reported for April 2015</b></th>
				</tr>
				<tr>
					<th>MFL</th>
					<th>Facility Name</th>					
				</tr>
				
			</thead>			
		</table>
	</div>	
		
</div>
<style type="text/css">
	.table{
		font-size: 11px;
		/*margin: 1%;	*/
		width: 100%;	
	}
	.header_tr{
		background-color:#f5f5f5;
	}
	.table th{
		text-align: center;
	}

	#clc_contents h6{		
		font-weight: bold;
		color: green;
		margin-top: 1%;
		margin-left: 1%;
	}
	#expiries_stocks{
		float: left;
		width: 100%;
	}
	.table_divs{
		margin-top: 1%;
		margin-left: 1%;
		/*border: 1px dotted green;*/
		width: 100%;
		height: auto;
	}
	.table_divs_stocks{
		/*margin-top: 1%;*/
		margin-left: 1%;
		/*border: 1px dotted green;*/
		width: 49%;
		float: left;
		min-height: 250px;
		height: auto;
	}

	.highest_stocks_table{
		margin-top: 1%;
	}

	.highest_expiries_table{
		margin-top: 1%;
	}
	.table_divs_expiries{
		/*margin-top: 1%;*/
		margin-left: 1%;
		/*border: 1px dotted green;*/
		width: 49%;
		float: right;
		min-height: 250px;
		height: auto;
	}
	.table_divs_non_reported{
		margin-top: 2%;
		margin-left: 1%;
		/*border: 1px dotted green;*/
		width: 100%;
		float: left;
		min-height: 350px;
		height: auto;
	}
	
</style>
<script type="text/javascript">
	$(document).ready(function (e){		
		var oTable = $('#stock_card_table').dataTable(
		{	
			"bPaginate":false,	
			"aaSorting": [[0, "asc"]],    
		    "bFilter": false,
		    "bSearchable":false,
		    "bInfo":false
		});				
		$.ajax({
			url: "<?php echo base_url() . 'Clc_management/get_stock_card'; ?>",
			dataType: 'json',
			success: function(s){
			// console.log(s);
			oTable.fnClearTable();
			for(var i = 0; i < s.length; i++) {
				oTable.fnAddData([
				s[i][0],
				s[i][1],
				s[i][2],
				s[i][3]
				]);
				} // End For
			},
			error: function(e){
				console.log(e.responseText);
			}
		});
		get_highest_stocks(4);
		get_highest_stocks(5);
		get_highest_stocks(6);
		function get_highest_stocks(comm){
			var tbl_name = '';			
			if(comm==4){
				tbl_name ='screening_highest';
			}else if(comm==5){
				tbl_name ='confirmatory_highest';
			}
			else if(comm==6){
				tbl_name ='tiebreaker_highest';				
			}
			var url = "<?php echo base_url() . 'Clc_management/get_highest_stocks/'; ?>";
			var my_url = url+comm;
			var oTable_name = tbl_name;
			oTable_name = $('#'+tbl_name).dataTable(
			{	
				"bPaginate":false,	
				"aaSorting": [[0, "asc"]],    
			    "bFilter": false,
			    "bSearchable":false,
			    "bInfo":false
			});	
			$.ajax({
				url: my_url,
				dataType: 'json',
				success: function(s){				
				oTable_name.fnClearTable();
				for(var i = 0; i < s.length; i++) {
					oTable_name.fnAddData([
					s[i][0],
					s[i][1],
					s[i][2]
					]);
					} // End For
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		}			

		get_highest_expiries(4);
		get_highest_expiries(5);
		get_highest_expiries(6);
		function get_highest_expiries(comm){
			var tbl_name = '';			
			if(comm==4){
				tbl_name ='screening_expiries';
			}else if(comm==5){
				tbl_name ='confirmatory_expiries';
			}
			else if(comm==6){
				tbl_name ='tiebreaker_expiries';				
			}
			var url = "<?php echo base_url() . 'Clc_management/get_highest_expiries/'; ?>";
			var my_url = url+comm;
			var oTable_name = tbl_name;
			oTable_name = $('#'+tbl_name).dataTable(
			{	
				"bPaginate":false,	
				"aaSorting": [[0, "asc"]],    
			    "bFilter": false,
			    "bSearchable":false,
			    "bInfo":false
			});	
			$.ajax({
				url: my_url,
				dataType: 'json',
				success: function(s){				
				oTable_name.fnClearTable();
				for(var i = 0; i < s.length; i++) {
					oTable_name.fnAddData([
					s[i][0],
					s[i][1],
					s[i][2]
					]);
					} // End For
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		}			
		
	});


	$(document).ajaxStart(function(){
	    $('#loading').show();
	 }).ajaxStop(function(){
	    $('#loading').hide();
	 });
</script>


	
</div>
<div class="modal" id="loading">
	
</div>
<style type="text/css">
	.modal
	{
	    display:    none;
	    position:   fixed;
	    z-index:    1000;
	    top:        0;
	    left:       0;
	    height:     100%;
	    width:      100%;
	    background: rgba( 255, 255, 255, .8 ) 
	                url('<?php echo base_url();?>assets/img/new_loader.gif') 
	                50% 50% 
	                no-repeat;
	}

	/* When the body has the loading class, we turn
	   the scrollbar off with overflow:hidden */
	body.loading {
	    overflow: hidden;   
	}

	/* Anytime the body has the loading class, our
	   modal element will be visible */
	body.loading .modal {
	    display: block;
	}

</style>
