<?php 
	include_once('template_header.php');
?>
<div id="inner_wrapper"> 
	<div id="side_menu">
		<?php 
			include_once('side_menu_management.php');
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
		<div id="alert" style="margin-top:2%;width:99%;float:left;margin-left:1%;">			
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
		margin-top: 5%;
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
		margin-left: 21%;
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
		
});

</script>