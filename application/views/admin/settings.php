<div id="clc_contents">	
	<div id="main_graph" class="graphs table_divs panel panel-success">		  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">
	  	Deadlines
	  	&nbsp;
	  	<button class="btn btn-primary" data-toggle="modal" data-target="#add_deadline">Add New</button>	  	
	  </div>
	  <div id="deadline_div" class="panel-body" style="min-height:400px;height:auto">
	  	<table id="deadline_table" class="display table table-bordered" cellspacing="0" width="100%" style="font-size:11px;">
			<thead>				
				<tr class="header_tr">					
					<th>Reporting Deadline</th>
					<th>Reporting Status</th>
					<th>Applicable To</th>
					<th>Modified By</th>
					<th>Action</th>		
				</tr>				
			</thead>			
		</table>
	  </div>	  	  		  
	</div>	
	<div id="main_graph" class="graphs table_divs panel panel-success">		  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">
	  	Alerts
	  	&nbsp;
	  	<button class="btn btn-primary" data-toggle="modal" data-target="#add_deadline">Add New</button>	  	
	  </div>
	  <div id="alerts_div" class="panel-body" style="min-height:400px;height:auto">
	  	<table id="alerts_table" class="display table table-bordered" cellspacing="0" width="100%" style="font-size:11px;">
			<thead>				
				<tr class="header_tr">					
					<th>Alert Message</th>
					<th>Alert Type</th>
					<th>Status</th>
					<th>Applicable To</th>
					<th>Action</th>		
				</tr>				
			</thead>			
		</table>
	  </div>	  	  		  
	</div>		
	<div id="main_graph" class="graphs table_divs panel panel-success">		  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">
	  	Commodities
	  	&nbsp;
	  	<button class="btn btn-primary" data-toggle="modal" data-target="#add_deadline">Add New</button>	  	
	  </div>
	  <div id="commodities_div" class="panel-body" style="min-height:400px;height:auto">
	  	<table id="commodities_table" class="display table table-bordered" cellspacing="0" width="100%" style="font-size:11px;">
			<thead>				
				<tr class="header_tr">					
					<th>Name</th>
					<th>Category</th>
					<th>Unit of Issue</th>
					<th>Action</th>		
				</tr>				
			</thead>			
		</table>
	  </div>	  	  		  
	</div>		
</div>
<style type="text/css">
	.graph{
		min-height: 200px;
		height: auto;
		width: 100%;
		border: 1px dotted green;
		float: left;
		margin-left: 3%;
		margin-top: -1%;
	}

	#main_graph{
		min-height: 200px;		
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
	#edit_deadline_tables{
		margin-top: 2%;		
		background-color: #ffffff;
		border: 1px solid black;
    	padding: 5px;
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

	//Dealines table
		load_deadlines();
		load_alerts();
		function load_deadlines()
		{
			var oTable = $('#deadline_table').dataTable(
			{	
				"bPaginate":false,				
			    "bFilter": true,
			    "bSearchable":true,
			    "bInfo":true
			});				
			$.ajax({
				url: "<?php echo base_url() . 'Admin_management/get_deadlines'; ?>",
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
					s[i][4]

					]);
					} // End For
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		}

		//Save edited deadline
	$('.edit_deadline_btn').click(function(){
      var id = $('#edit_deadline_id').val();
      var deadline = $('#edit_deadline').val();
      var status = $('#active_status').val();

      $.post("<?php echo base_url() . 'Admin_management/update_deadline'; ?>", {
        id: id,
        deadline: deadline,            
        status: status            
      }).done(function(data) {
        alert("Data Loaded: " + data);
        $('Edit_Deadline'.id).modal('hide');
        window.location = "<?php echo base_url() . 'Admin/settings'; ?>";
      });

    });	
    function load_alerts()
		{
			var oTable = $('#alerts_table').dataTable(
			{	
				"bPaginate":false,				
			    "bFilter": true,
			    "bSearchable":true,
			    "bInfo":true
			});				
			$.ajax({
				url: "<?php echo base_url() . 'Admin_management/get_admin_alerts'; ?>",
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
					s[i][4]

					]);
					} // End For
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		}
	//Makes the status checkbox it can be selecteed once		
	$('input[type="checkbox"]').bind('click',function() {

   	 $('input[type="checkbox"]').not(this).prop("checked", false);
    });

	});

	//edit deadline modal
	$(document).on('click', '.edit_deadline_link', function(f) 
	{	
     	var id = $(this).attr('id');      
        var deadline =  $('td:first', $(this).parents('tr')).text();        
        var status =  $('td:nth-child(2)', $(this).parents('tr')).text();        
        var zone =  $('td:nth-child(3)', $(this).parents('tr')).text(); 

        $('#edit_deadline').val(deadline);
        $('#edit_status').val(status);  
        $('#edit_deadline_id').val(id);
        $('.edit_zone').val(zone); 

        /*if(('#active_status').attr("checked", true)) {
        	('#inactive_status').attr("checked", false)
        };*/ 
	});

	
</script>

<!-- <div class="modal" id="loading">
	
</div> -->

<!--Edit Deadline -->
</div>
<div id="Edit_Deadline" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Deadline</h4>
            </div>
            <div class="modal-body">
                <form id="edit_deadline_form">
                	<label for="edit_deadline_txt">Reporting Deadline (every month)</label><br/>
                	<input type="text" id="edit_deadline" class="form-control" width="100%" /><br/>

                	<label for="edit_reporting_status">Reporting Status</label><br/>
                	<span id="status" name = "status" width="50%" class="form-control">
                		<input type="checkbox" name="active_status" id="active_status" value="0">Activate 
                        <input type="checkbox" name="inactive_status" id="inactive_status" value="1">Deactivate</span><br/>
                	              	
                	<label for="edit_applicable_to">Applicable To: <i><span class="edit_zone" name="edit_zone"></span></i></label><br/>                		
                	                		
                	<input type="hidden" value="" id="edit_deadline_id" name="edit_deadline_id">
                	<br/>
                	<span id="edit_form_status"></span>        	
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary my_navs" data-dismiss="modal">Close</button>
                <button type="button" id="save_edit_form" class="btn btn-primary my_navs">Save Changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->        

<!--Edit Alert -->
<div id="Edit_Alerts" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Alert</h4>
            </div>
            <div class="modal-body">
                <form id="edit_alert_form">
                	<label for="edit_alert_txt">Alert Message</label><br/>
                	<input type="text" id="edit_alert" class="form-control" width="100%" /><br/>

                	<label for="edit_reporting_status">Alert Type</label><br/>
                	<select id="edit_alert_type" name="edit_alert_type" class="form-control">
                      	<option value = "">Select Alert Type</option>	
                      	<option value = "Reporting Deadline">Reporting Deadline</option>	
                      	<option value = "General Message">General Message</option>	
                      	<option value = "Other">Other</option>	
                      	</select> <br/>
                	              	
                	<label for="edit_applicable_to">Status (<i><span class="edit_zone" name="edit_zone"></span></i>)</label><br/>  
                	<span id="status" name = "status" class = "form-control">
                		<input type="checkbox" name="active_status" id="active_status" value="0">Activate 
                        <input type="checkbox" name="inactive_status" id="inactive_status" value="1">Deactivate<br/></span> 
                      	  
                    <label for="edit_reporting_status">Applicable To:</label><br/>  
                    <select id="edit_applicable_to" name="edit_applicable_to" class="form-control">
                      	<option value = "1">All Sub Counties (Districts)</option>	
                      	<option value = "2">All Counties</option>	
                      	<option value = "3">Zone A</option>	
                      	<option value = "4">Zone B</option>	
                      	<option value = "5">Zone C</option>	
                      	<option value = "6">Zone D</option>	
                      	<option value = "7">Partners</option>
                      	</select>          		
                	                		
                	<input type="hidden" value="" id="edit_alert_id" name="edit_alert_id">
                	<br/>
                	<span id="edit_form_status"></span>        	
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary my_navs" data-dismiss="modal">Close</button>
                <button type="button" id="save_edit_form" class="btn btn-primary my_navs">Save Changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
        
        

