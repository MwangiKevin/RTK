<div id="admin_contents">
	
	<div id="stock_card" class="charts panel panel-success" width = "100%">
	  <!-- Default panel contents -->
	  <div class="panel-heading">Stock Status per County</div>

	  <table id="stock_card_table" class="charts-inner display table table-bordered" cellspacing="0">
			<thead>
				<tr>
					<th colspan="9" id="stock_period"><b>Stocks as At End of April 2015</b></th>
				</tr>
				<tr>
					<th>County</th>
					<th>Commodity</th>
					<th>Beginning Balance</th>
					<th>Quantity Received</th>
					<th>Quantity Used</th>
					<th>Tests Done</th>
					<th>Closing Balance</th>
					<th>Quantity Requested</th>					
					<th>Quantity Expiring (next 6 months)</th>					
				</tr>
			</thead>			
		</table>
	</div>	
		
</div>
<style type="text/css">
	.graph{
		height: 360px;
		width: 97%;
		border: 1px dotted green;
		float: left;
		margin-left: %;
		margin-top: 2%;
	}
	.table{
		font-size: 11px;
		/*margin: 1%;	*/
		width: 98%;	
	}

	.table th{
		text-align: center;
	}

	#admin_contents{
		margin-top: 2%;
		padding-top: 1%;
		background-color: #ffffff;
		
	}

	.charts{
		min-height: 500px;
		height: auto;
		width: 100%;
		/*border: 1px dotted green;*/
		float: left;
		margin-left: 2%;
		margin-top: 2%;
	}	
	.charts-inner{
		max-height: 480px;
		height: auto;		
	}	
	
	
</style>
<script type="text/javascript">
	$(document).ready(function (e){	
			
		get_stock_status_data();		
		// get_district_details(null);				
		// get_early_vs_late(null);	
		// get_reported_vs_non_reported(null);		
		// get_stock_card(null);
		// get_commodity_options();		

		// $('#comm_filter').click(function(g){
		// 	var district_id = g.target.id;						
		// 	var comm = $('#comm_select').val();
		// 	alert(district_id);
		// 	// get_consumption_data(district_id,comm);					
		// });

		// function get_stock_status_data()
		// {
		// 	var url = "<?php echo base_url() . 'Admin_management/get_stock_status'; ?>";
		// 	$.ajax({
		// 		url: url,
		// 		dataType: 'json',
		// 		success: function(s){		
		// 			console.log(s);			
		// 			$('#location').html(s);
		// 		},
		// 		error: function(e){
		// 			console.log(e.responseText);
		// 		}
		// 	});
		// }	


		// function get_commodity_options()
		// {
		// 	var baseurl = "<?php echo base_url() . 'Clc_management/get_commodity_select_options/'; ?>";
		// 	var url = baseurl;
		// 	$.ajax({
		// 		url: url,
		// 		dataType: 'json',
		// 		success: function(s){		
		// 			console.log(s);			
		// 			$('#comm_select').html(s);
		// 		},
		// 		error: function(e){
		// 			console.log(e.responseText);
		// 		}
		// 	});
		// }


		function get_stock_status_data(){
			var url = "<?php echo base_url() . 'Admin_management/get_stock_status'; ?>";
			var oTable = $('#stock_card_table').dataTable(
			{	
				"bPaginate":false,	
				"aaSorting": [[0, "asc"]],    
			    "bFilter": false,
			    "bSearchable":false,
			    "bInfo":false
			});	
			
			$.ajax({
				url: url,
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
					s[i][6],
					s[i][7],
					s[i][8]
					]);
					} // End For
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		}
		
		// function get_early_vs_late(district_id)
		// {		
		// 	var baseurl = "<?php echo base_url() . 'Clc_management/sub_county_early_vs_late/'; ?>";
		// 	var url = baseurl+district_id;
		// 	$.ajax({
		// 		url: url,
		// 		dataType: 'json',
		// 		success: function(s){
		// 			var late_reports = s.late_reports;			
		// 			var early_reports = s.early_reports;
		// 			var data = null;
		// 			var month_text = s.englishdate;				
		// 			if((late_reports==0)&&(early_reports==0)){
		// 				data = [{name:'No Reports Submitted', color:'blue', y:null}];	
		// 			}else if((late_reports==0)&&(early_reports!=0)){
		// 				data = [{name:'Early', color:'green', y:early_reports}];					
		// 			}else if((late_reports!=0)&&(early_reports==0)){
		// 				data = [{name:'Late', color:'red', y:late_reports}];					
		// 			}else if((late_reports!=0)&&(early_reports!=0)){
		// 				data = [{name:'Late', color:'red', y:late_reports},{name:'Early', color:'green', y:early_reports}];
		// 			}
					
		// 			$('#early_vs_late').highcharts({
		// 	        chart: {
		// 	            type: 'pie',
		// 	        },
		// 	        title: {
		// 	            text: 'Period: '+month_text
		// 	        },
		// 	        subtitle: {
		// 	            text: 'Out of Total Reports'
		// 	        },
		// 	        series: [{
		// 	            type: 'pie',
		// 	            name: 'Reports',
		// 	            data: data
		// 	        }]
		// 	    });
		// 		},
		// 		error: function(e){
		// 			console.log(e.responseText);
		// 		}
		// 	});
		// }

		// function get_consumption_data(district_id,commodity_id)
		// {	
		// 	var baseurl = "<?php echo base_url() . 'Clc_management/commodity_usage/'; ?>";
		// 	var url = baseurl+district_id+'/'+commodity_id;

		// 	$.ajax({
		// 		url: url,
		// 		dataType: 'json',
		// 		success: function(s){
		// 			var months = s.months;
		// 			var opening = s.opening;
		// 			var tests_done = s.tests_done;
		// 			var used = s.used;
		// 			var closing_bal = s.closing_bal;
		// 			var first_month = [opening[0],used[0],tests_done[0],closing_bal[0]];
		// 			var second_month = [opening[1],used[1],tests_done[1],closing_bal[1]];
		// 			var third_month = [opening[2],used[2],tests_done[2],closing_bal[2]];										
		// 			$('#commodity_usage').highcharts({
		// 		        chart: {
		// 		            type: 'column'
		// 		        },
		// 		        title: {
		// 		            text: 'Screening Determine Consumption Data'
		// 		        },
		// 		        subtitle: {
		// 		            text: 'Source: RTK System'
		// 		        },
		// 		        xAxis: {
		// 		            categories: [
		// 		                'Beginning Balance',
		// 		                'Used Total',
		// 		                'Total Tests',
		// 		                'Closing Balance'		                
		// 		            ],
		// 		            crosshair: true
		// 		        },
		// 		        yAxis: {
		// 		            min: 0,
		// 		            title: {
		// 		                text: 'Values'
		// 		            }
		// 		        },
		// 		        tooltip: {
		// 		            headerFormat: '<span style="font-size:11px">{point.key}</span><table>',
		// 		            pointFormat: '<tr><td style="color:{series.color};padding:0;font-size:11px;">{series.name}: </td>' +
		// 		                '<td style="padding:0;font-size:10px"><b>{point.y:.1f}</b></td></tr>',
		// 		            footerFormat: '</table>',
		// 		            shared: true,
		// 		            useHTML: true
		// 		        },
		// 		        plotOptions: {
		// 		            column: {
		// 		                pointPadding: 0.2,
		// 		                borderWidth: 0
		// 		            }
		// 		        },
		// 		        series: [{
		// 		            name: months[0],
		// 		            data: [first_month[0],first_month[1],first_month[2],first_month[3]]

		// 		        }, {
		// 		            name: months[1],
		// 		            data: [second_month[0],second_month[1],second_month[2],second_month[3]]			            

		// 		        }, {
		// 		            name: months[2],
		// 		            data: [third_month[0],third_month[1],third_month[2],third_month[3]]			            

		// 		        }]
		// 		    });					
		// 		},
		// 		error: function(e){
		// 			console.log(e.responseText);
		// 		}
		// 	});

		// }

		
		// function get_reported_vs_non_reported(district_id)
		// {			
		// 	var baseurl = "<?php echo base_url() . 'Clc_management/sub_county_reported_vs_nonreported/'; ?>";
		// 	var url = baseurl+district_id;
		// 	$.ajax({
		// 		url: url,
		// 		dataType: 'json',
		// 		success: function(s){
		// 			var nonreported = s.nonreported_facilities;			
		// 			var reported = s.reported_facilities;
		// 			var data = null;
		// 			var month_text = s.englishdate;				
		// 			if((nonreported==0)&&(reported==0)){
		// 				data = [{name:'No Facilities Reported', color:'blue', y:null}];	
		// 			}else if((nonreported==0)&&(reported!=0)){
		// 				data = [{name:'Reported', color:'green', y:reported}];					
		// 			}else if((nonreported!=0)&&(reported==0)){
		// 				data = [{name:'Non Reported', color:'red', y:nonreported}];					
		// 			}else if((nonreported!=0)&&(reported!=0)){
		// 				data = [{name:'Non Reported', color:'red', y:nonreported},{name:'Reported', color:'green', y:reported}];
		// 			}

		// 			$('#reported_vs_non').highcharts({
		// 	        chart: {
		// 	            type: 'pie',
		// 	        },
		// 	        title: {
		// 	            text: 'Period: '+month_text
		// 	        },
		// 	        subtitle: {
		// 	            text: 'Out of Total Facilities'
		// 	        },
		// 	        series: [{
		// 	            type: 'pie',
		// 	            name: 'Facilities',
		// 	            data: data
		// 	        }]
		// 	    });
		// 		},
		// 		error: function(e){
		// 			console.log(e.responseText);
		// 		}
		// 	});		
			
		// }
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
	