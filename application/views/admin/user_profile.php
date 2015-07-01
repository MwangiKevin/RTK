<div id="clc_contents">	
	
	<div id="main_graph" class="graphs table_divs panel panel-success">		  <!-- Default panel contents -->
	  	<div class="panel-heading" style="font-size:13px;font-weight:bold">User Profile: <span id="report_period_header"></span></div>
	  
	  <div id="main_user_profile" class="panel-body charts">
	  <div class="panel spanel-heading" style="font-size:13px;font-weight:bold">User Details</div>
	  	<div class=" user"> *user name</div>
	  	<div class=" user"> Phone Number</div>
	  	<div class=" user"> Email</div>
	  	<div class=" user"> Status</div>
	  	<div class=" user">Date of Activation</div>
	  	<div class=" user">User Type</div>

	  	<div class="footer">
                <button type="button" class="btn btn-primary my_navs" >Reset Password</button>
                <button type="button" id="save_add_form" class="btn btn-primary">Deactivate</button>
                <button type="button" id="save_add_form" class="btn btn-primary">Add Sub County</button>
            </div>

	  </div>
	  <div id="activity_log" class="panel-body charts">
	  	<div class="panel spanel-heading" style="font-size:13px;font-weight:bold">Activity Log</div>
	  	
	  	
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
	.user{
		height: 30px;
		width: 200px;
		font-size: 13px;

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
		height: 450px;
		width: 47%;
		border: 1px dotted green;
		float: left;
		margin-left: 2%;
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
