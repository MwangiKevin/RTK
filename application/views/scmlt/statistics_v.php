<div id="statistics_contents">
	<div id="own_late_vs_timely" class="charts">
		
	</div>
	<div id="bar_percentages">
		
	</div>	
	<div id="summary">
		<table id="stats_table" class="display table table-bordered" cellspacing="0" width="100%">
			<thead>		 
				<tr>
					<th><b>Sub-County</b></th>
					<th><b>Total No.of Facilities</b></th>
					<th><b>No. of Facilities Reporting</b></th>
				    <th><b>No. of Facilities not Reporting</b></th>
				  	<th><b>No. of Reports Submitted before 10<sup>th</sup></b></th>
				  	<th><b>No. of Reports Submitted after 10<sup>th</sup></b></th>				    				    
		          </tr>
		    </thead>
		    <tfoot>
		    	<tr>
					<th><b>Sub-County</b></th>
					<th><b>Total No.of Facilities</b></th>
					<th><b>No. of Facilities Reporting</b></th>
				    <th><b>No. of Facilities not Reporting</b></th>
				  	<th><b>No. of Reports Submitted before 10<sup>th</sup></b></th>
				  	<th><b>No. of Reports Submitted after 10<sup>th</sup></b></th>				 		    
		        </tr>
	    </tfoot>	
		</table>
	</div>
</div>
<style type="text/css">
	#statistics_contents{
		margin-top: 2%;
		padding-top: 1%;
		background-color: #ffffff;
	}

	.charts{
		height: 300px;
		width: 30%;
		border: 1px dotted green;
		float: left;
		margin-left: 3%;
	}

	#bar_percentages{
		height: 300px;
		width: 63%;
		border: 1px dotted green;
		float: left;
		margin-left: 3%;
	}

	#summary{
		width: 96%;
		height: auto;
		/*border: 1px ridge green;*/
		float: left;
		margin-left: 3%;	
		margin-top: 3%;	
	}
	
</style>
<script type="text/javascript">	
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
	#stats_table{
		font-size: 11px;
	}
	#stats_table_info{
	font-size: 11px; 
	margin-left: 5%;
	float: left;
	color: green;
	}

</style>
<script type="text/javascript">
$(document).ready(function (e){		
	var oTable = $('#stats_table').dataTable(
	{	
		"bPaginate":false,				
	    "bFilter": false,
	    "bSearchable":true,
	    "bInfo":true
	});	
	$.ajax({
			url: "<?php echo base_url() . 'Scmlt_management/get_stats_table'; ?>",
			dataType: 'json',
			success: function(s){
			// console.log(s);
			oTable.fnClearTable();
			for(var i = 0; i < s.length; i++) {
				oTable.fnAddData([
				s[i][0],
				s[i][1],
				s[i][2],
				s[i][3],
				s[i][4],
				s[i][5]
				]);
				} // End For
			},
			error: function(e){
				console.log(e.responseText);
			}
		});
	$.ajax({
		url: "<?php echo base_url() . 'Scmlt_management/get_statistics'; ?>",
		dataType: 'json',
		success: function(s){
			var late_reports = s.late_reports;			
			var early_reports = s.early_reports;
			var data = null;
			if((late_reports==0)&&(early_reports==0)){
				data = [{name:'No Reports Submitted', color:'blue', y:null}];	
			}else if((late_reports==0)&&(early_reports!=0)){
				data = [{name:'Early', color:'green', y:early_reports}];					
			}else if((late_reports!=0)&&(early_reports==0)){
				data = [{name:'Late', color:'red', y:late_reports}];					
			}else if((late_reports!=0)&&(early_reports!=0)){
				data = [{name:'Late', color:'red', y:late_reports},{name:'Early', color:'green', y:early_reports}];
			}

			// var data = [{name:'Late', color:'red', y:late_reports},{name:'Early', color:'green', y:early_reports}];
			$('#own_late_vs_timely').highcharts({
	        chart: {
	            type: 'pie',
	        },
	        title: {
	            text: 'Early vs Late Reports'
	        },
	        subtitle: {
	            text: 'Out of Total Reports'
	        },
	        series: [{
	            type: 'pie',
	            name: 'Reports',
	            data: data
	        }]
	    });
		},
		error: function(e){
			console.log(e.responseText);
		}
	});

	$.ajax({
		url: "<?php echo base_url() . 'Scmlt_management/get_stats_column'; ?>",
		dataType: 'json',
		success: function(s){
			console.log(s);
			var categories = s[0].districts;    	
			var percentages = s[0].percentage;    	
			var data = {"name":"Percentage","data":percentages};    		
			$('#bar_percentages').highcharts({
				colors: ['green'],
		        chart: {
		            renderTo: 'container',
		            type: 'column'
		        },
		        title: {
		            text: 'Reports Submission Status'
		        },
		        xAxis: {
		            categories: categories
		        },
		        yAxis: {
		        	min: 0,
		        	max: 100,
		            title: {
		                text: 'Reports Submittes (%)'
		            },
		            plotLines: [{
		                value: 0,
		                width: 1,
		                color: 'green'
		             }]
		        },
		        series: [data]
		    });
		},
		error: function(e){
			console.log(e.responseText);
		}
	});
    
// 
	
});		
</script>