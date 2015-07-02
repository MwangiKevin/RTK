<div id="clc_contents">	
	
	<div id="main_graph" class="graphs table_divs panel panel-success">		  <!-- Default panel contents -->
	  	<div class="panel-heading" style="font-size:13px;font-weight:bold">User Profile: <span id="report_period_header"></span></div>
	  
	  <div id="main_user_profile" class="panel-body charts">
	  <div class="panel panel-heading" style="font-size:13px;font-weight:bold" >User Details</div>
	  	<div class=" user"> *user name: <span id="fname"/><span id="last_name"/></div>
	  	<div class=" user"> Phone Number: <span id="phone"/></div>
	  	<div class=" user"> Email: <span id="email"/></div>
	  	<div class=" user"> Status: <span id="status"/></div>
	  	<div class=" user">User Type:<span id="user_type"/> for <span id=""/></div>

	  	<div class="footer">
                <button type="button" class="btn btn-primary my_navs" id="reset_password">Reset Password</button>
                <button type="button" class="btn btn-primary" id="deactive_user">Deactivate</button>
                <button type="button" class="btn btn-primary">Add Sub County</button>
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
	get_user_details();	
		function get_user_details()
		{
			// var user_id = $('#user_id').val();			
			var user_id = "1384";			
			var baseurl = "<?php echo base_url() . 'User_management/get_national_user_profile/'; ?>";						
			var url = baseurl+user_id;
			$.ajax({
				url: url,
				dataType: 'json',
				success: function(s){						
					$('#fname').html(s[0].first_name);
					$('#last_name').html(s[0].last_name);			
					$('#email').html(s[0].email);			
					$('#phone').html(s[0].phone);			
					$('#user_type').html(s[0].user_type_txt);			
					$('#status').html(s[0].status_txt);			
					$('#regions').html(s[0].regions);			
					console.log(s[0]);
					// alert(s.first_name);
				},
				error: function(e){
					console.log(e.responseText);
				}
			});
			
		}
		$('#reset_password').click(function(){
	      var get_user_id = window.location.pathname.split( '/' );
	      var user_id = get_user_id[4];

	      $.post("<?php echo base_url() . 'User_management/reset_password'; ?>", {
	        user_id: user_id          
	      }).done(function(data) {
	        alert("Password Changed" + data);
	        window.location = "<?php echo base_url() . 'Admin/user_profile/"+user_id+"';?>";
	    });
	    });

	    $('#deactive_user').click(function(){	      
	      var get_user_id = window.location.pathname.split( '/' );
	      var user_id = get_user_id[4];	 
	      alert("dff");     

	      $.post("<?php echo base_url() . 'User_management/reset_password'; ?>", {
	        user_id: user_id          
	      }).done(function(data) {
	        alert("User Deactivated" + data);
	        window.location = "<?php echo base_url() . 'Admin/user_profile/"+user_id+"'; ?>";
	    });

    });
	    
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
