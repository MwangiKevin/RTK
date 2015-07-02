<div id="clc_contents">
	<div id="county_national_filter" class="table_divs panel panel-primary">
	  <div class="panel-heading accordion-heading " data-toggle="" data-parent="#accordion2" href="#national_reports" style="font-size:13px;font-weight:bold" >	  	
	  	  <select id="type_select" class="form-control" style="width:40%;">	
	  	  	<option value="0">Select Type</option>	  	
	  	  	<option value="national">National</option>	  	
	  	  	<option value="county">County</option>	  		  	  	
		  </select>
		  <!-- <label class="form-control" style="width:20%;background-color:#ccc;">Select Partner:</label> -->
		  <!-- <span class="input-group-addon btn-success">Select Partner</span> -->
		  <!-- <select id="partner_filter" class="form-control" style="width:30%;">		  	
		  </select>	   -->
		  <!-- <button id="btn_partner_filter" class=" btn btn-success" style="float:left">Filter</button> -->
		  <!-- <span class="input-group btn-success">Select Partner</span>
		  <select id="partner_filter" class="form-control" style="width:30%;">		  	
		  </select>
		   -->
		  <!-- <button id="btn_partner_filter" class=" btn btn-success">Filter</button> -->
		
	  </div>
	  
	</div>
	</div>
	
	<div class="accordion-group">
		<div id="stock_card_national" class="table_divs panel panel-success">
			  <div class="panel-heading accordion-heading " data-toggle="" data-parent="#accordion2" href="#national_stocks" style="font-size:13px;font-weight:bold" >National Commodity Usage</i></div>
			  <div id="national_stocks" class="accordion-body ">
			  <div class="accordion-inner">
			  	<table id="commodity_usage" class="display table table-bordered" cellspacing="0" width="100%">
					<thead>						
						<!-- <tr class="header_tr">					
							<th>County</th>
							<th>Sub-County</th>
							<th>MFL</th>
							<th>Facility Name</th>							
							<th >Screening - KHB</th>
							<th >Confirmatory - First Response</th>
							<th >Tiebreaker</th>							
						</tr>	 -->

						<tr class="header_tr">					
							<th rowspan="2">County</th>
							<th rowspan="2">Sub-County</th>
							<th rowspan="2">MFL</th>
							<th rowspan="2">Facility Name</th>
							<th colspan="3">Quantity used</th>	
						</tr>	
						<tr class="header_tr">					
							
							<th >Screening - KHB</th>
							<th >Confirmatory - First Response</th>
							<th >Tiebreaker</th>							
						</tr>				
					</thead>			
				</table>				
				</div>
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

		$('#btn_partner_filter').click(function(e){
			var partner_id = $('#partner_filter').val();			
			// get_stock_summary(partner_id);
			// get_highest_stocks(partner_id,4);
			// get_highest_stocks(partner_id,5);
			// get_highest_stocks(partner_id,6);
			// get_highest_expiries(partner_id,4);
			// get_highest_expiries(partner_id,5);
			// get_highest_expiries(partner_id,6);
		
		});
		
		// function populate_county_filter(){
		// 	var base_url = "<?php echo base_url() . 'Rtk_reports_management/get_partner_options/'; ?>";
		// 	$.ajax({
		// 		url: base_url,
		// 		dataType: 'json',
		// 		success: function(s){									
		// 			$('#partner_filter').html(s);
		// 		},
		// 		error: function(e){
		// 			console.log(e.responseText);
		// 		}
		// 	});
		// }
		
		get_stock_summary();
		// function get_stock_summary(partner_id){
		// 	var base_url = "<?php echo base_url() . 'Rtk_reports_management/get_commodity_usage/'; ?>";
		// 	var url = base_url+partner_id;
		// 	var oTable = $('#commodity_usage').dataTable(
		// 	{	
		// 		"bPaginate":false,	
		// 		"aaSorting": [[0, "asc"]],    
		// 	    "bFilter": false,
		// 	    "bSearchable":false,
		// 	    "bInfo":false
		// 	});	
		// 	$.ajax({
		// 		url: url,
		// 		dataType: 'json',
		// 		success: function(s){
		// 			console.log(s);
		// 		// oTable.fnClearTable();
		// 		// for(var i = 0; i < s.length; i++) {
		// 		// 	oTable.fnAddData([
		// 		// 	s[i][0],
		// 		// 	s[i][1],
		// 		// 	s[i][2],
		// 		// 	s[i][3],
		// 		// 	s[i][4]
		// 		// 	]);
		// 		// 	} // End For
		// 		},
		// 		error: function(e){
		// 			console.log(e.responseText);
		// 		}
		// 	});
		// }		
		
		function get_stock_summary(){
			var base_url = "<?php echo base_url() . 'Rtk_reports_management/get_commodity_usage/'; ?>";
			// var url = base_url+partner_id;
			var oTable = $('#commodity_usage').dataTable(
			{	
				"bPaginate":false,	
				"aaSorting": [[0, "asc"]],    
			    "bFilter": false,
			    "bSearchable":false,
			    "bInfo":false
			});	
			$.ajax({
				url: base_url,
				dataType: 'json',
				success: function(s){
					console.log(s);
				oTable.fnClearTable();
				for(var i = 0; i < s.length; i++) {
					oTable.fnAddData([
					s[i][0],
					s[i][1],
					s[i][2],
					s[i][3],
					s[i][4],
					s[i][5],
					s[i][6]
					]);
					} // End For
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		}		
		
		// populate_county_filter();
			
		// get_stock_summary(1);
		// get_highest_stocks(1,4);
		// get_highest_stocks(1,5);
		// get_highest_stocks(1,6);
		// function get_highest_stocks(partner_id,comm){
		// 	var tbl_name = '';			
		// 	if(comm==4){
		// 		tbl_name ='screening_highest';
		// 	}else if(comm==5){
		// 		tbl_name ='confirmatory_highest';
		// 	}
		// 	else if(comm==6){
		// 		tbl_name ='tiebreaker_highest';				
		// 	}
		// 	var url = "<?php echo base_url() . 'Rtk_reports_management/get_highest_stocks_partner/'; ?>";
		// 	var my_url = url+partner_id+'/'+comm;
		// 	var oTable_name = tbl_name;
		// 	oTable_name = $('#'+tbl_name).dataTable(
		// 	{	
		// 		"bPaginate":false,	
		// 		"aaSorting": [[0, "asc"]],    
		// 	    "bFilter": false,
		// 	    "bSearchable":false,
		// 	    "bInfo":false
		// 	});	
		// 	$.ajax({
		// 		url: my_url,
		// 		dataType: 'json',
		// 		success: function(s){				
		// 		oTable_name.fnClearTable();
		// 		for(var i = 0; i < s.length; i++) {
		// 			oTable_name.fnAddData([
		// 			s[i][0],
		// 			s[i][1],
		// 			s[i][2]
		// 			]);
		// 			} // End For
		// 		},
		// 		error: function(e){
		// 			console.log(e.responseText);
		// 		}
		// 	});
		// }			

		
		// get_highest_expiries(1,4);
		// get_highest_expiries(1,5);
		// get_highest_expiries(1,6);
		
		// function get_highest_expiries(partner_id,comm){
		// 	var tbl_name = '';			
		// 	if(comm==4){
		// 		tbl_name ='screening_expiries';
		// 	}else if(comm==5){
		// 		tbl_name ='confirmatory_expiries';
		// 	}
		// 	else if(comm==6){
		// 		tbl_name ='tiebreaker_expiries';				
		// 	}
		// 	var url = "<?php echo base_url() . 'Rtk_reports_management/get_highest_expiries_partner/'; ?>";
		// 	var my_url = url+partner_id+'/'+comm;
		// 	var oTable_name = tbl_name;
		// 	oTable_name = $('#'+tbl_name).dataTable(
		// 	{	
		// 		"bPaginate":false,	
		// 		"aaSorting": [[0, "asc"]],    
		// 	    "bFilter": false,
		// 	    "bSearchable":false,
		// 	    "bInfo":false
		// 	});	
		// 	$.ajax({
		// 		url: my_url,
		// 		dataType: 'json',
		// 		success: function(s){				
		// 		oTable_name.fnClearTable();
		// 		for(var i = 0; i < s.length; i++) {
		// 			oTable_name.fnAddData([
		// 			s[i][0],
		// 			s[i][1],
		// 			s[i][2]
		// 			]);
		// 			} // End For
		// 		},
		// 		error: function(e){
		// 			console.log(e.responseText);
		// 		}
		// 	});
		// }
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
