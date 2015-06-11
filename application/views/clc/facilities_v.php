<div id="clc_contents">	
	<div id="facility_details">
		<span id="fname"></span>
		<span id="factions">
			<button class="btn btn-primary my_navs" id="edit_fcdrr">Edit</button>		
			<button class="btn btn-primary my_navs" id="cancel_edit">Cancel</button>
		</span>
	</div>	
	<div id="fcdrr_details">
		
	</div>	
	
</div>
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
	#facility_details{		
		width: 100%;
		/*border: 1px dotted green;*/
		float: left;
		margin-left: 1%;
		margin-top: -1%;
	}	
	#fcdrr_details{		
		width: 100%;
		min-height: 500px;
		border: 1px dotted green;
		float: left;
		margin-left: 1%;
		margin-top: 3%;
	}	
	
</style>
<script type="text/javascript">
	$(document).ready(function (e){			
		
		$('.menu_link').click(function(f){
			var mfl = f.target.id;
			get_facility_details(mfl);			
		});
		get_facility_details(null);

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
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
		}

		
		
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
	