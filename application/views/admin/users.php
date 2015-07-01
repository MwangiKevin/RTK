<div id="clc_contents">	
	<div id="main_filter" class="graphs table_divs panel panel-info" style="margin-top:-10px;">		  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">Main Filter</div>
	  <!-- <div class="panel-body"></div> -->
	</div>
	<div id="main_graph" class="graphs table_divs panel panel-success">		  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">
	  	Users
	  	&nbsp;
	  	<button class="btn btn-primary" data-toggle="modal" data-target="#add_facility">Add New</button>	  	
	  </div>
	  <div id="main_chart_body" class="panel-body" style="min-height:400px;height:auto">
	  	<table id="users_table" class="display table table-bordered" cellspacing="0" width="100%" style="font-size:11px;">
			<thead>				
				<tr class="header_tr">					
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>User Type</th>
					<th>Status</th>
					<th>Action</th>					
				</tr>				
			</thead>			
		</table>
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
		min-height: 350px;		
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
		height: 300px;
		width: 47%;
		border: 1px dotted green;
		float: left;
		margin-left: 3%;
		margin-top: 2%;
	}	
	
</style>

<script type="text/javascript">
	$(document).ready(function (e){		
		// $.ajax({
		// 	url: "<?php echo base_url() . 'Admin_management/get_national_summary'; ?>",
		// 	dataType: 'json',
		// 	success: function(s){		
		// 		var percentage = s.percentage;
		// 		console.log(percentage);
		// 		$('.progress-bar').css('width', percentage+'%').attr('aria-valuenow', percentage);
		// 		$( "#main_percentage" ).progressbar({
		// 			value: percentage
		// 		});
		// 		$( "#perc" ).html(percentage+' % Reported');
		// 	},
		// 	error: function(e){
		// 		console.log(e.responseText);
		// 	}
		// });	
		load_facilities();
		
		function load_facilities()
		{
			var oTable = $('#users_table').dataTable(
			{	
				"bPaginate":false,				
			    "bFilter": true,
			    "bSearchable":true,
			    "bInfo":true
			});				
			$.ajax({
				url: "<?php echo base_url() . 'User_management/get_national_users'; ?>",
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
		}
	    
	});
	


	// $(document).ajaxStart(function(){
	//     $('#loading').show();
	//  }).ajaxStop(function(){
	//     $('#loading').hide();
	//  });
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
