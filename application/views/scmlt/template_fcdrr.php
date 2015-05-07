<?php 
	include_once('template_header.php');
?>
<div id="inner_wrapper"> 	
	<div id="banner_text">
			<?php 
				echo $banner_text;
			?>
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

	#content{		
		width: 96%;		
		float: left;		
		margin-left: 2%;
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
		width: 100%;
		float: left;
			
		padding:1%;
		font-size: 12px;
		font-weight: 1px;
		position: fixed;
		height: 2%;	

	}
	#fcdrr_table_example{
		font-size: 11px;
	}
</style>