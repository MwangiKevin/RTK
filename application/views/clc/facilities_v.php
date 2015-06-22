<div id="clc_contents">	
	<div id="facility_details">
		<span id="fname"></span>
		<span id="factions">
			<button class="btn btn-primary my_navs" id="edit_facility_btn"  data-toggle="modal" data-target="#edit_facility">Edit Facility</button>		
			<button class="btn btn-primary my_navs" id="cancel_edit">Cancel</button>
		</span>
	</div>
	<div id="panel_summary" class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">Summary Reports</div>
	  	<div class="panel-body" id="fcdrr_details">
	  	</div>
	</div>	
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
                	<label for="facility_name_edit">Facility Name</label>
                	<input type="text" id="facility_name_edit" class="form-control" width="100%" />                	
                	<label for="facility_subcounty_edit"></label>                		
                	<select id="facility_subcounty_edit" class="form-control" width="100%">
                		<option>Select Sub-County</option>
                	</select>        
                	<br/>
                	<span id="eit_form_status"></span>        	
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary my_navs" data-dismiss="modal">Close</button>
                <button type="button" id="save_edit_form" class="btn btn-primary my_navs">Save Changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style type="text/css">	
	.table{
		font-size: 11px;
		/*margin: 1%;	*/
		width: 100%;	
	}
	#factions{
		float: right;
	}

	#fname{
		font-size: 14px;
		font-weight: bold;
		margin-left: 1%;
	}
	.my_navs{		
		background-color: green;
		font-size: 10px;
	}

	.table th{
		text-align: center;
	}

	

	#clc_contents{
		margin-top: 2%;
		padding-top: 1%;
		background-color: #ffffff;
	}
	#panel_summary{		
		width: 100%;		
		float: left;
		margin-left: 1%;
		margin-top: 1%;
	}	
	#fcdrr_details a{
		color: #000;
		text-decoration: none;
		font-size: 12px;
	}
	#fcdrr_details{		
		width: 100%;
		min-height: 500px;
		/*border: 1px dotted green;*/
		float: left;
		margin-left: 1%;
		/*margin-top: 3%;*/
	}	
	
</style>
<script type="text/javascript">
	$(document).ready(function (e){					
		$('.menu_link').click(function(f){
			var mfl = f.target.id;
			get_facility_details(mfl);			
			get_monthly_records(mfl);			
		});

		$('#save_edit_form').click(function(f){
			var fcode = $('#facility_code_hidden').val();						
			var facility_name = $('#facility_name_edit').val();
			var district_id = $('#facility_subcounty_edit').val();
			var district_id_old = "<?php echo $district_id?>";			
			if(facility_name=='')
			{
				$('#edit_form_status').html('Please Fill in the Facility Name.');
			}else if(district_id==0)
			{
				$('#eit_form_status').html('Please Select the Sub-County before Saving.');
			}else{
				$.post("<?php echo base_url() . 'Clc_management/update_facility_details'; ?>", {
		           facility_code: fcode,                        
		           facility_name: facility_name,                        
		           district_id: district_id,                        		           
		        }).done(function(data) {		
					$('#edit_form_status').html('Please Select the Sub-County before Saving.');
					var new_url = "<?php echo base_url() . 'Clc/view_facilities/'; ?>";
					var url = new_url+district_id_old;
		        	window.location = url;
		        });
			}
		});


		get_facility_details(null);
		get_monthly_records(null);		

		function get_facility_details(mfl)
		{
			var baseurl = "<?php echo base_url() . 'Clc_management/fac_county_get_dets/'; ?>";
			var district_id = "<?php echo $district_id?>";			
			var url = baseurl+district_id+'/'+mfl;
			$.ajax({
				url: url,
				dataType: 'json',
				success: function(s){							
					$('#fname').html(s.facility_name);
					$('#location').html(s.location);
					get_facility_edit_form_dets();

				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		}	

		function get_facility_edit_form_dets()
		{
			var fcode = $('#facility_code_hidden').val();			
			var baseurl = "<?php echo base_url() . 'Clc_management/get_edit_facility_form/'; ?>";						
			var url = baseurl+fcode;
			$.ajax({
				url: url,
				dataType: 'json',
				success: function(s){						
					$('#facility_name_edit').val(s.facility_name);
					$('#facility_subcounty_edit').html(s.districts);			
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
			
		}
		function get_monthly_records(mfl)
		{
			var baseurl = "<?php echo base_url() . 'Clc_management/get_facility_records/'; ?>";			
			var district_id = "<?php echo $district_id?>";			
			var url = baseurl+district_id+'/'+mfl;
			$.ajax({
				url: url,
				dataType: 'json',
				success: function(s){						
					$('#fcdrr_details').html(s);					
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		}		
		
	});

	$('#edit_facility').click(function(e){

	});


	// $(document).ajaxStart(function(){
	//     $('#loading').show();
	//  }).ajaxStop(function(){
	//     $('#loading').hide();
	//  });
	 // $("#report_table").dataTable();
	 // $("#report_table").tablecloth({
		//   theme: "default",
		//   bordered: true,
		//   condensed: true,
		//   striped: true,
		//   sortable: true,
		//   clean: true,
		//   cleanElements: "th td",
		//   customClass: "my-table"
		// });
</script>


	
</div>
