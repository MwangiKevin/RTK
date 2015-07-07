<div id="clc_contents">
	<div id="county_national_filter" class="table_divs panel panel-primary">
	  <div class="panel-heading accordion-heading " data-toggle="" data-parent="#accordion2" href="#national_reports" style="font-size:13px;font-weight:bold" >
	  	<div class="input-group">
		  <span class="input-group-addon btn-success">Select County</span>
		  <select id="county_filter" class="form-control" style="width:30%;">		  	
		  </select>
		  
		  <button id="btn_county_filter" class=" btn btn-success">Filter</button>
		</div>
	  </div>
	  
	</div>

	<div class="accordion-group">
		<div id="percentage_national" class="table_divs panel panel-success">
			  <div class="panel-heading accordion-heading " data-toggle="collapse" data-parent="#accordion2" href="#national_reports" style="font-size:13px;font-weight:bold" >Percentages <i>(Click to View)</i></div>
			  <div id="national_reports" class="accordion-body collapse">
			  <div class="accordion-inner">
			  	<table id="percentage_table" class="display table" cellspacing="0" width="100%">
					<thead>
						<tr class="header_tr">
							<th colspan="4" id="percentage_table_header"><b></b></th>
						</tr>
						<tr class="header_tr">					
							<th id="county_sub"></th>
							<th id="perc_monthp1"></th>
							<th id="perc_monthp"></th>
							<th id="perc_monthc"></th>					
						</tr>				
					</thead>			
				</table>
				</div>
				</div>
			</div>
	</div>		

	<div class="accordion-group">
		<div id="stock_card_national" class="table_divs panel panel-success">
			  <div class="panel-heading accordion-heading " data-toggle="collapse" data-parent="#accordion2" href="#national_stocks" style="font-size:13px;font-weight:bold" >National Stocks <i>(Click to View)</i></div>
			  <div id="national_stocks" class="accordion-body collapse">
			  <div class="accordion-inner">
			  	<table id="stock_summary" class="display table" cellspacing="0" width="100%">
					<thead>
						<tr class="header_tr">
							<th colspan="5" id="national_Stock_summary_table_header"><b></b></th>
						</tr>
						<tr class="header_tr">					
							<th>Commodity</th>
							<th>Begining Balance</th>
							<th>Quantity Used</th>
							<th>Tests Done</th>
							<th>Closing Balance</th>							
						</tr>				
					</thead>			
				</table>
				<hr/>
				<table id="stock_summary" class="display table" cellspacing="0" width="100%" style="margin-top:1%;">
					<thead>
						<tr class="header_tr">
							<th colspan="5" id="national_Stock_detailed_table_header"><b></b></th>
						</tr>
						<tr class="header_tr">					
							<th>Commodity</th>
							<th>Begining Balance</th>
							<th>Quantity Used</th>
							<th>Tests Done</th>
							<th>Closing Balance</th>							
						</tr>				
					</thead>			
				</table>
				</div>
				</div>
			</div>
	</div>		
	<div class="accordion-group">
		<div id="highest_stock_expiries_national" class="table_divs panel panel-success">
		<div class="panel-heading accordion-heading " data-toggle="collapse" data-parent="#accordion2" href="#highest_stock_expiries" style="font-size:13px;font-weight:bold" >Facilities with Highest Stocks and Expiries (next 6 Months) <i>(Click to View)</i></div>
		 <div id="highest_stock_expiries" class="accordion-body collapse">
			<div id="highest_stocks" class="table_divs_stocks panel panel-info" style="width:49%;margin-left:-0.1%;">
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
			<div id="highest_expiries" class="table_divs_expiries panel panel-info" style="width:49%;">
			  <!-- Default panel contents -->
			  <div class="panel-heading" style="font-size:13px;font-weight:bold">Facilities with Highest Expiries (Next 6 Months)</div>
			  	<table id="screening_expiries" class="highest_expiries_table display table" cellspacing="0" width="100%">
						<thead>
							<tr class="header_tr">
								<th colspan="4" id="stock_period"><b>Screening KHB Expiries</b></th>
							</tr>
							<tr>
								<th>MFL</th>
								<th>Facility Name</th>
								<th>Quantity Expiring</th>					
							</tr>
							
						</thead>			
					</table>

					<table id="confirmatory_expiries" class="highest_expiries_table display table" cellspacing="0" width="100%">
						<thead>
							<tr class="header_tr">
								<th colspan="4" id="stock_period"><b>Confirmatory Unigold Expiries</b></th>
							</tr>
							<tr>
								<th>MFL</th>
								<th>Facility Name</th>
								<th>Quantity Expiring</th>					
							</tr>
							
						</thead>			
					</table>

					<table id="tiebreaker_expiries" class="highest_expiries_table display table " cellspacing="0" width="100%">
						<thead>
							<tr class="header_tr">
								<th colspan="4" id="stock_period"><b>Tie-breaker Expiries</b></th>
							</tr>
							<tr>
								<th>MFL</th>
								<th>Facility Name</th>
								<th>Quantity Expiring</th>					
							</tr>
							
						</thead>			
					</table>
			</div>		
		</div>
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
		height: 300px;		
	}

	.highest_expiries_table{
		margin-top: 1%;
		height: 300px;
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

		$('#btn_county_filter').click(function(e){
			var county_id = $('#county_filter').val();
			get_percentages(county_id,null);
			get_percentages_labels(county_id);
			get_stock_summary(county_id);
			get_highest_stocks(county_id,4);
			get_highest_stocks(county_id,5);
			get_highest_stocks(county_id,6);
			get_highest_expiries(county_id,4);
			get_highest_expiries(county_id,5);
			get_highest_expiries(county_id,6);
		
		});
		function get_percentages_labels(county_id){
			var base_url = "<?php echo base_url() . 'Rtk_reports_management/get_percentage_months/'; ?>";
			var url = base_url+county_id;
			$.ajax({
				url: url,
				dataType: 'json',
				success: function(s){				
					var perc_monthp1 = s.previous_month1;
					var perc_monthp = s.previous_month;
					var perc_monthc = s.current_month;
					var header_info = s.header_info;
					var header_type = s.header_type;
					$('#percentage_table_header').text(header_info);
					$('#perc_monthp1').text(perc_monthp1);
					$('#perc_monthp').text(perc_monthp);
					$('#perc_monthc').text(perc_monthc);
					$('#county_sub').text(header_type);
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		}
		function populate_county_filter(){
			var base_url = "<?php echo base_url() . 'Rtk_reports_management/get_county_options/'; ?>";
			$.ajax({
				url: base_url,
				dataType: 'json',
				success: function(s){									
					$('#county_filter').html(s);
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		}
		

		function get_stock_summary(county_id){
			var base_url = "<?php echo base_url() . 'Rtk_reports_management/get_national_stock_summary/'; ?>";
			var url = base_url+county_id;
			var oTable = $('#stock_summary').dataTable(
			{	
				"bPaginate":false,	
				"aaSorting": [],    
			    "bFilter": false,
			    "bSearchable":false,
			    "bInfo":false
			});	
			$.ajax({
				url: url,
				dataType: 'json',
				success: function(s){
				oTable.fnClearTable();
				for(var i = 0; i < s.length; i++) {
					oTable.fnAddData([
					s[i][0],
					s[i][1],
					s[i][2],
					s[i][3],
					s[i][4]
					]);
					} // End For
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		}		
		function get_percentages(county_id,month_text){
			var oTable = $('#percentage_table').dataTable(
			{	
				"bPaginate":false,	
				"aaSorting": [[0, "asc"]],    
			    "bFilter": false,
			    "bSearchable":false,
			    "bInfo":false
			});		
			var base_url = "<?php echo base_url() . 'Rtk_reports_management/get_percentages/'; ?>";
			var purl = base_url+county_id;		
			var url = purl+'/'+month_text;		
			$.ajax({				
				url: url,
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
		}
		populate_county_filter();
		get_percentages(1,null);
		get_percentages_labels(1);
		get_stock_summary(1);
		get_highest_stocks(1,4);
		get_highest_stocks(1,5);
		get_highest_stocks(1,6);
		function get_highest_stocks(county_id,comm){
			var tbl_name = '';			
			if(comm==4){
				tbl_name ='screening_highest';
			}else if(comm==5){
				tbl_name ='confirmatory_highest';
			}
			else if(comm==6){
				tbl_name ='tiebreaker_highest';				
			}
			var url = "<?php echo base_url() . 'Rtk_reports_management/get_highest_stocks/'; ?>";
			var my_url = url+county_id+'/'+comm;
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

		
		get_highest_expiries(1,4);
		get_highest_expiries(1,5);
		get_highest_expiries(1,6);
		
		function get_highest_expiries(county_id,comm){
			var tbl_name = '';			
			if(comm==4){
				tbl_name ='screening_expiries';
			}else if(comm==5){
				tbl_name ='confirmatory_expiries';
			}
			else if(comm==6){
				tbl_name ='tiebreaker_expiries';				
			}
			var url = "<?php echo base_url() . 'Rtk_reports_management/get_highest_expiries/'; ?>";
			var my_url = url+county_id+'/'+comm;
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
