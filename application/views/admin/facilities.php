<div id="clc_contents">	
	<div id="main_filter" class="graphs table_divs panel panel-info" style="margin-top:-10px;">		  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">Main Filter</div>
	  <!-- <div class="panel-body"></div> -->
	</div>

	<div id="main_graph" class="graphs table_divs panel panel-success">		  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">
	  	Facilities
	  	&nbsp;
	  	<button class="btn btn-primary" data-toggle="modal" data-target="#add_facility">Add New</button>	  	
	  </div>
	  <div id="main_chart_body" class="panel-body" style="min-height:400px;height:auto">
	  	<table id="facilities_table" class="display table table-bordered" cellspacing="0" width="100%" style="font-size:11px;">
			<thead>				
				<tr class="header_tr">					
					<th>County</th>
					<th>Sub-County</th>
					<th>Partner</th>
					<th>MFL</th>
					<th>Facility Name</th>
					<th>Reporting Status</th>
					<th>Action</th>					
				</tr>				
			</thead>			
		</table>
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
		load_facilities();
		get_counties();
		get_partners();
		get_counties_add();
		get_partners_add();
		function load_facilities()
		{
			var oTable = $('#facilities_table').dataTable(
			{	
				"bPaginate":false,				
			    "bFilter": true,
			    "bSearchable":true,
			    "bInfo":true
			});				
			$.ajax({
				url: "<?php echo base_url() . 'Admin_management/get_national_facilities'; ?>",
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
		
		function get_counties()
		{			
			$.ajax({
				url: "<?php echo base_url() . 'Admin_management/get_national_counties'; ?>",
				dataType: 'json',
				success: function(s){
					$('#facility_county_edit').html(s);
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		}


		function get_counties_add()
		{			
			$.ajax({
				url: "<?php echo base_url() . 'Admin_management/get_national_counties'; ?>",
				dataType: 'json',
				success: function(s){
					$('#facility_county_add').html(s);
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		}

		function get_partners()
		{			
			$.ajax({
				url: "<?php echo base_url() . 'Admin_management/get_national_partners'; ?>",
				dataType: 'json',
				success: function(s){
					$('#facility_partner_edit').html(s);
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		}


		function get_partners_add()
		{			
			$.ajax({
				url: "<?php echo base_url() . 'Admin_management/get_national_partners'; ?>",
				dataType: 'json',
				success: function(s){
					$('#facility_partner_add').html(s);
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		}
		$('#facility_county_edit').change(function (x)
		{
			var cid = $('#facility_county_edit').val();
			if(cid!=0){
				get_sub_counties(cid);					
			}else{
				var mine = '<option value="0"> Select Sub-County</option>';
				$('#facility_subcounty_edit').html(mine);
			}
			
		});

		$('#facility_county_add').change(function (x)
		{
			var cid = $('#facility_county_add').val();
			if(cid!=0){
				get_sub_counties_add(cid);					
			}else{
				var mine = '<option value="0"> Select Sub-County</option>';
				$('#facility_subcounty_add').html(mine);
			}
			
		});
		function get_sub_counties(county_id)
		{			
			var base_url = "<?php echo base_url() . 'Admin_management/get_national_subcounties/'; ?>";
			var url = base_url+county_id;
			$.ajax({
				url: url,
				dataType: 'json',
				success: function(s){
					$('#facility_subcounty_edit').html(s);
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		}
		function get_sub_counties_add(county_id)
		{			
			var base_url = "<?php echo base_url() . 'Admin_management/get_national_subcounties/'; ?>";
			var url = base_url+county_id;
			$.ajax({
				url: url,
				dataType: 'json',
				success: function(s){
					$('#facility_subcounty_add').html(s);
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		}

		$('#save_edit_form').click(function(z)
		{
			z.preventDefault();
			var mfl = $('#facility_mfl_edit').val();
			var facility_name = $('#facility_name_edit').val();
			var county = $('#facility_county_edit').val();
			var district = $('#facility_subcounty_edit').val();
			var partner = $('#facility_partner_edit').val();
			if(facility_name==''){
				$('#edit_form_status').text('The Facility Name must be Filled In');
			}else{
				$.post("<?php echo base_url() . 'Admin_management/update_facility_details'; ?>", {
		           facility_code: mfl,                        
		           facility_name: facility_name,                        
		           district_id: district,                        		           
		           partner: partner,                        		           
		        }).done(function(data) {		
					$('#edit_form_status').html(data);
					var url = "<?php echo base_url() . 'Admin/facilities/'; ?>";						
		        	window.location = url;
		        });
			}
			
		});

		$('#save_add_form').click(function(p)
		{
			p.preventDefault();
			var mfl = $('#facility_mfl_add').val();
			var facility_name = $('#facility_add').val();
			var county = $('#facility_county_add').val();
			var district = $('#facility_subcounty_add').val();
			var partner = $('#facility_partner_add').val();
			var owner = $('#owner_add').val();
			var facility_level = $('#facility_level_add').val();
			var facility_type = $('#facility_type_add').val();
			if(mfl==''){
				$('#add_form_status').text('The Facility Code must be Filled In');
			}else if(facility_name==''){
				$('#add_form_status').text('The Facility Name must be Filled In');
			}else if(district==''){
				$('#add_form_status').text('The Sub-County must be Selected');
			}else{
				$.post("<?php echo base_url() . 'Admin_management/add_facility_details'; ?>", {
		           facility_code: mfl,                        
		           facility_name: facility_name,                        
		           district_id: district,                        		           		           
		           partner: partner,                        		           
		           owner: owner,                        		           
		           facility_level: facility_level,                        		           
		           facility_type: facility_type                        		           
		        }).done(function(data) {		
					$('#add_form_status').html(data);
					var url = "<?php echo base_url() . 'Admin/facilities/'; ?>";						
		        	window.location = url;
		        });
			}
			
		});
		
	});
	
	
	
	$(document).on('click', '.edit_facility_link', function(f) 
	{
	
        var id = $(this).attr('id');      
        var county =  $('td:first', $(this).parents('tr')).text();        
        var district =  $('td:nth-child(2)', $(this).parents('tr')).text();        
        var mfl =  $('td:nth-child(4)', $(this).parents('tr')).text();
        var name =  $('td:nth-child(5)', $(this).parents('tr')).text();          
        var partner =  $('td:nth-child(3)', $(this).parents('tr')).text();          
        $('#facility_mfl_edit').val(mfl);
        $('#facility_name_edit').val(name);
        $('#current_county').html(county);
        $('#current_district').html(district);          
        $('#current_partner').html(partner);          
	        
	});

	
</script>
	
</div>
<div id="edit_facility" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Facility</h4>
            </div>
            <div class="modal-body">
                <form id="edit_facility">
                	<label for="facility_name_edit">MFL</label><br/>
                	<input type="text" id="facility_mfl_edit" class="form-control" width="100%" readonly="true" /><br/>                	
                	<label for="facility_name_edit">Facility Name</label><br/>
                	<input type="text" id="facility_name_edit" class="form-control" width="100%" /><br/>                	
                	<label for="facility_county_edit">County (<i><span id="current_county"></span></i>)</label><br/>                		
                	<select id="facility_county_edit" class="form-control" width="100%">                		
                	</select>        
                	<br/>
                	<label for="facility_subcounty_edit">Sub-County (<i><span id="current_district"></span></i>)</label><br/>                		
                	<select id="facility_subcounty_edit" class="form-control" width="100%">
                		<option value="0">Select Sub-County</option>
                	</select>        
                	<br/>
                	<label for="facility_partner_edit">Partner (<i><span id="current_partner"></span></i>)</label><br/>                		
                	<select id="facility_partner_edit" class="form-control" width="100%">
                		<option value="0">Select Partner</option>
                	</select>        
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

<div id="add_facility" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Facility</h4>
            </div>
            <div class="modal-body">
                <form id="add_facility_form">
                	<label for="facility_name_add">MFL</label><br/>
                	<input type="text" id="facility_mfl_add" class="form-control" width="100%"/><br/>                	
                	<label for="facility_name_add">Facility Name</label><br/>
                	<input type="text" id="facility_name_add" class="form-control" width="100%" /><br/>                	
                	<label for="facility_county_add">County</label><br/>                		
                	<select id="facility_county_add" class="form-control" width="100%">                		
                	</select>        
                	<br/>
                	<label for="facility_subcounty_add">Sub-County</label><br/>                		
                	<select id="facility_subcounty_add" class="form-control" width="100%">
                		<option value="0">Select Sub-County</option>
                	</select>        
                	<br/>
                	<label for="facility_partner_add">Partner</label><br/>                		
                	<select id="facility_partner_add" class="form-control" width="100%">
                		<option value="0">Select Partner</option>
                	</select>        
                	<br/>
                	<label for="facility_name_add">Facility Type</label><br/>
                	<input type="text" id="facility_type_add" class="form-control" width="100%"/><br/> 
                	<label for="facility_name_add">Facility Owner</label><br/>
                	<input type="text" id="owner_add" class="form-control" width="100%"/><br/> 
                	<label for="facility_name_add">Facility Level</label><br/>
                	<input type="text" id="facility_level_add" class="form-control" width="100%"/><br/> 
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
<div class="mymodal" id="loading">
	
</div>
<style type="text/css">
	.mymodal
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
