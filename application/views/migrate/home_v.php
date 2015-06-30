<div id="clc_contents">	
	<div id="main_filter" class="graphs table_divs panel panel-info" style="margin-top:-10px;">		  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">Main Filter</div>
	  <!-- <div class="panel-body"></div> -->
	</div>

	<div id="main_graph" class="graphs table_divs panel panel-success">		  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">Data Migration Module</div>
	  <div id="main_chart_body" class="panel-body" style="height:350px;">
	  	<div class="charts">
	  		<h3>Orders</h3>
	  		<p>This Module is used to Migrate data from the Old Orders Table to the New System's Orders Table.</p>
	  		<button id="orders_migrate" class="btn btn-primary">Migrate</button>
	  		<br/>
	  		<br/>
	  		<span id="progress_orders">56%</span>
	  	</div>
	  	<div class="charts">
	  		<h3>Details</h3>	  	
	  		<p>This Module is used to Migrate data from the Old Orders Table to the New System's Lab Details Table.</p>
	  		<button id="details_migrate" class="btn btn-primary">Migrate</button>
	  		<br/>
	  		<br/>
	  		<span id="progress_details">56%</span>
	  	</div>
	  	<div class="charts">
	  		<h3>Facilities</h3>	  		
	  		<p>This Module is used to Migrate data from the Old Facilities Table to the New System's Facilities Table.</p>
	  		<button id="facilities_migrate" class="btn btn-primary">Migrate</button>
	  		<br/>
	  		<br/>
	  		<span id="progress_facilities">56%</span>
	  	</div>
	  	<div class="charts">
	  		<h3>Users</h3>	  		
	  		<p>This Module is used to Migrate data from the Old Users Table to the New System's Users Table.</p>
	  		<button id="users_migrate" class="btn btn-primary">Migrate</button>
	  		<br/>
	  		<br/>
	  		<span id="progress_users"></span>%
	  	</div>
	  	<div class="charts">
	  		<h3>Percentages</h3>	  		
	  		<p>This Module is used to Migrate data from the Old Percentages Tables to the New System's Percentages Tables.</p>
	  		<button id="percentages_migrate" class="btn btn-primary">Migrate</button>
	  		<br/>
	  		<br/>
	  		<span id="progress_percentages">56%</span>
	  	</div>
	  </div>
	</div>
</div>
<style type="text/css">
	.graph{
		min-height: 360px;
		height: auto;
		width: 100%;
		border: 1px dotted green;
		float: left;
		margin-left: 3%;
		margin-top: -1%;
	}

	#main_graph{
		min-height: 700px;
		height: auto;
		width: 100%;		
		float: left;
		margin-left: 1%;
		margin-top: 0%;
	}

	#main_filter{		
		height: auto;
		width: 100%;		
		float: left;
		margin-left: 1%;
		margin-top: 0%;
	}
	#clc_contents{
		margin-top: 2%;		
		background-color: #ffffff;
	}

	.charts{
		height: 220px;
		width: 28%;
		border: 1px dotted green;
		float: left;
		margin-left: 3%;
		margin-top: 2%;
		padding: 2%;
	}	
	
</style>

<script type="text/javascript">
	$(document).ready(function (e){		
		$('#users_migrate').click(function(e){
			migrate_users();
		});
		function migrate_users()
		{
			$.ajax({
			url: "<?php echo base_url() . 'Migration_controller/migrate_users'; ?>",
			dataType: 'json',
			success: function(s){						
				$('#progress_users').html(s);				
			},
			error: function(e){
				console.log(e.responseText);
			}
		});	
		}
	    
	});

</script>


	
</div>

