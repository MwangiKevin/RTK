<?php 
	include_once('template_header.php');
?>
<div id="inner_wrapper"> 
	<div id="side_menu">
		<?php 
			include_once('side_menu.php');
		?>
	</div>
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
	#side_menu{
		width: 20%;
		padding: 1%;
		float: left;
		min-height: 1450px;
		border:1px solid #ccc;
		background-color: #f5f5f5;
		position: fixed;
		/*color: #ccc;*/
		box-shadow: 1px 1px 12px #888888;

	}

	#content{		
		width: 78%;
		/*min-height: 1350px;		*/
		float: left;
		/*border: solid 1px #000;*/
		/*border-color: green;*/
		margin-left: 21%;
		margin-top: 1%;
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
		margin-left: 21%;		
		padding:1%;
		font-size: 12px;
		font-weight: 1px;
		position: fixed;
		height: 2%;
		/*background-color: #fff;		*/

	}
</style>