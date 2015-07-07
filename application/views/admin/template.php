<?php 
	include_once('template_header.php');
?>
<div id="inner_wrapper"> 
	<div id="side_menu">
		<?php 
			include_once('side_menu.php');
		?>
	</div>
	<div id="banner">
		<div id="banner_text" style="width:90%;font-size:13px;height:20px;float:left;">
			<?php 
				echo $banner_text;
			?>

			<?php 
				echo '<span id="location">'.$location.'</span>';
			?>
		</div>	
		<div id="switch_main_admin" style="z-index:10;margin-top:2%;height:45px;font-size:13px;width:101%;background-color:green;float:left;padding: 7px 1px 0px 13px;border-bottom: 1px solid #ccc;border-bottom: 1px solid #ccc;border-radius: 4px 0px 0px 4px;">						
			<span class="lead" style="color: #fff;float:left;font-size:14px;">Switch Identities</span>
			&nbsp;
			<select id="main_user_switch" class="form-control" style="width:15%;float:left;margin-left:200px;height:30px;font-size:12px;"><option value="0"> -- Select UserType--</option><option value="scmlt">SCMLT</option><option value="clc">County Administrator</option><option value="partner">Partner</option>
			</select>
			&nbsp;
			<select id="main_county_switch" class="form-control" style="width:15%;float:left;height:30px;font-size:12px;"></select>
			&nbsp;
			<select id="main_district_switch" class="form-control" style="width:15%;float:left;height:30px;font-size:12px;"></select>
			&nbsp;			
			<button id="switch_identity" class="form-control btn btn-primary" style="width:10%;float:left;height:30px;font-size:12px;">GO</button>	
			
			

		</div>			
	</div>
	
	<div id="content">		
		<div id="content_panel">
			<?php 
				 $this -> load -> view($content_view); 
			?>
		</div>
		
	</div> 		

</div>
<div id="bottom_ribbon">
	<div id="footer">
	<?php 
		include_once('template_footer.php');
	?>
	</div>
</div>
<style type="text/css">
	
	#inner_wrapper{		
		margin-left: -1%;
		margin-top: -35px;		
	}
	#location
	{
		float: right;
		color: green;		
	}
	#side_menu{
		width: 20%;
		padding: %;
		float: left;
		min-height: 1450px;
		min-height: 100%;
		border:1px solid #ccc;
		background-color: #f5f5f5;
		position: fixed;
		margin-top: 6%;
		/*color: #ccc;*/
		box-shadow: 1px 1px 12px #888888;
		overflow-y:scroll;
    	overflow-x:hidden;

	}

	#alert{
		padding: 2px;
		/*background-color: #FF4D4D;*/
		color: #fff;		
		opacity: 30%;
	}


	
	#banner{
		border-bottom:1px solid green;
		background-color: #ffffff;
		width: 101%;
		float: left;			
		padding:1%;
		font-size: 12px;
		font-weight: 1px;
		position: fixed;
		height:70px;	
		z-index: 1;		

	}
	#content{		
		width: 77%;
		/*min-height: 1350px;		*/
		float: left;
		/*border: solid 1px #000;*/
		/*border-color: green;*/
		margin-left: 23%;
		margin-top: 5%;
		overflow: none;
	}
	#side_menu ul>li{
		padding-top: 1%;
		padding-bottom: 1%;
	}
	#content_panel,#banner_text{
		/*margin-left: 25%;		*/
	}

	#banner_text{
		/*border-bottom:1px solid #ccc;*/
		background-color: #ffffff;
		width: 79%;
		float: left;
		margin-left: 1%;				
		font-size: 12px;
		font-weight: 1px;
		position: fixed;
		height: 2%;
		/*background-color: #fff;		*/

	}
	.link{
		color: green;
	}

	.active_link{
		background-color: green; 
		color:#ffffff;
	}

	.panel_active{
		background-color:green;
		color:#ffffff;
	}
</style>
<script type="text/javascript">
$(document).ready(function (e){
	var total = 0;
	var reported = 0;
	var nonreported = 0;
	var percentage = 0;
	
	$('#system_alert_div').hide();
	$.ajax({
            url: "<?php echo base_url() . 'Admin_management/get_counties_districts'; ?>",
            dataType: 'json',
            success: function(s){
            	console.log(s);
                var districtslist = s.districts_list;
                var countieslist = s.counties_list;
				$('#main_county_switch').html(countieslist);
				$('#main_district_switch').html(districtslist);
                
            },
            error: function(e){
                console.log(e.responseText);
            }            
        }); 
	$('#switch_identity').hide();
	var active_link = '<?php echo $active_link;?>';
	clear_active_links();
	$('#'+active_link).addClass('currently_active_panel');
	function clear_active_links()
	{
		$('#orders').removeClass('active_link');
		$('#allocations').removeClass('active_link');
		$('#statistics').removeClass('active_link');
		$('#home').removeClass('active_link');
	}
	$('#main_district_switch').attr("disabled", "true");
	$('#main_county_switch').attr("disabled", "true");

	$('#main_user_switch').change(function(e){
		var user_switch = $('#main_user_switch').val();	

		if(user_switch=='0'){
			$('#switch_identity').hide();
			$('#main_county_switch').attr("disabled", "true");
			$('#main_district_switch').attr("disabled", "true");
		}else if(user_switch=='scmlt'){
			$('#main_county_switch').attr("disabled", "true");
			$('#main_district_switch').removeAttr("disabled");	
			$('#switch_identity').show();
		}else if(user_switch=='clc'){			
			$('#main_district_switch').attr("disabled", "true");
			$('#main_county_switch').removeAttr("disabled");		
			$('#switch_identity').show();
		}else if(user_switch=='partner'){
			$('#main_county_switch').attr("disabled", "true");
			$('#main_district_switch').attr("disabled", "true");			
			$('#switch_identity').show();
		}
	});
	$('#switch_identity').click(function(){
		var type = $('#main_user_switch').val();			
		var switch_to = '';
		var base_url = "<?php echo base_url().'Switcher/switch_admin'; ?>";				
		var url;
		if(type=='scmlt'){
			switch_to = $('#main_district_switch').val();
			if(switch_to==0){
				alert('Please select a Sub-County to Switch To');
			}else{				
				url = base_url+'/'+type+'/'+switch_to;
				window.location = url;
			}
		}else if(type=='clc'){
			switch_to = $('#main_county_switch').val();
			if(switch_to==0){
				alert('Please select a County to Switch To');
			}else{
				url = base_url+'/'+type+'/'+switch_to;
				window.location = url;
			}
		}if(type=='partner'){
			switch_to = 'partner_admin';
			url = base_url+'/'+type+'/'+switch_to;
			window.location = url;			
		}
	});
		
});

</script>