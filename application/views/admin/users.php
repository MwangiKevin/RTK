<div id="clc_contents">	
	<div id="main_filter" class="graphs table_divs panel panel-info" style="margin-top:-10px;">		  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">Main Filter</div>
	  <!-- <div class="panel-body"></div> -->
	</div>
	<div id="main_graph" class="graphs table_divs panel panel-success">		  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">
	  	Users
	  	&nbsp;
	  	<button class="btn btn-primary" data-toggle="modal" data-target="#add_user">Add New User</button>	  	
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
		$('#user_type').change(function (x)
		{
			var user_type_id = $('#user_type').val();
			if(user_type_id!=0){
				get_regions(user_type_id);					
			}else{
				var mine = '<option value="0"> Select Region</option>';
				$('#region_values').html(mine);
			}
			
		});
		function get_regions(user_type_id)
		{			
			var base_url = "<?php echo base_url() . 'User_management/get_regions/'; ?>";
			var url = base_url+user_type_id;
			$.ajax({
				url: url,
				dataType: 'json',
				success: function(s){
					$('#region_values').html(s);
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

<div id="add_user" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add User</h4>
            </div>
            <div class="modal-body">
                <form id="add_user_form">
                	<label >First Name</label><br/>
                	<input type="text" id="fname" class="form-control" width="100%"/><br/>                	
                	<label >Last Name</label><br/>
                	<input type="text" id="lname" class="form-control" width="100%" /><br/>  
                	<label >Phone</label><br/>
                	<input type="text" id="facility_type_add" class="form-control" width="100%"/><br/> 
                	<label >Email Address</label><br/>
                	<input type="text" id="owner_add" class="form-control" width="100%"/><br/> 
                	<label >User Type</label><br/>                		
                	<select id="user_type" class="form-control" width="100%">
	                	<option id="scmlt" value="0">Select User Type</option>                		
	                	<option id="scmlt" value="1">Sub County Lab Tec</option>                		
	                	<option id="clc" value="2"> County Lab Coordinator</option>                		
	                	<option id="partner" value="3">Partner</option>                		
	                	<option id="partner_admin" value="4">Partner Admin</option>                		
	                	<option id="rtk_manager" value="5">RTK Manager</option>                		
                	</select> 
                	<label >Region</label><br/>                		
                	<select id="region_values" class="form-control" width="100%">
                		<option value="0">Select Region</option>
                	</select> 
                	<span id="add_form_status"></span>        	
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary my_navs" data-dismiss="modal">Close</button>
                <button type="button" id="save_add_form" class="btn btn-primary my_navs">Save Changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
