<div class="row" id="zone_view" >
<div class="two_zones">
	<div class="span3 extra" id="zone_a">
		<span><a href="<?php echo base_url().'Allocation/allocation_details/A'?>">ZONE A</a></span><br>
		<div class="details">
			<div class="facilities">Facilities Supported : <?php echo $zone_data['facilities'][0];?></div>
			<div class="percentage">Reported Percentage (Current Month) : <?php echo $zone_data['percentage'][0];?> % </div>
			<div class="last_allocated">Last Allocated on : <?php echo $zone_data['last_allocated'][0];?> </div>
		</div>	
	</div>
	<div class="span3 extra"id="zone_b">
		<span><a href="<?php echo base_url().'Allocation/allocation_details/B'?>">ZONE B</a></span><br>
		<div class="details">
			<div class="facilities">Facilities Supported : <?php echo $zone_data['facilities'][1];?></div>
			<div class="percentage">Reported Percentage (Current Month) : <?php echo $zone_data['percentage'][1];?> %</div>
			<div class="last_allocated">Last Allocated on : <?php echo $zone_data['last_allocated'][1];?> </div>
		</div>	
	</div>
</div>
<div class="two_zones">

	<div class="span3 extra" id="zone_c">
		<span><a href="<?php echo base_url().'Allocation/allocation_details/C'?>">ZONE C</a></span><br>
		<div class="details">
			<div class="facilities">Facilities Supported : <?php echo $zone_data['facilities'][2];?></div>
			<div class="percentage">Reported Percentage (Current Month) : <?php echo $zone_data['percentage'][2];?> %</div>
			<div class="last_allocated">Last Allocated on : <?php echo $zone_data['last_allocated'][2];?> </div>
		</div>	
	</div>
	<div class="span3 extra" id="zone_d">
		<span><a href="<?php echo base_url().'Allocation/allocation_details/D'?>">ZONE D</a></span><br>
		<div class="details">
			<div class="facilities">Facilities Supported : <?php echo $zone_data['facilities'][3];?></div>
			<div class="percentage">Reported Percentage (Current Month) : <?php echo $zone_data['percentage'][3];?> % </div>
			<div class="last_allocated">Last Allocated on : <?php echo $zone_data['last_allocated'][3];?> </div>
		</div>	
	</div>
	</div>
</div>

<style type="text/css">
#zone_view{
		min-height: 400px;
		height: auto;
		width: 90%;		
		float: left;
		margin-left: 4%;
		margin-top: 4%;
	}
	.two_zones{
		width: 85%;
		margin-top: 8%;
		margin-bottom: 8%;
		margin-left:1%;
	}
.extra{
	font-size: 133%; 
    padding: 10px;
    border: 1px #ECE8E8 solid;
    border-bottom: 8px solid #D4D48B;
    border-radius: 0px 6px 6px 10px; 
    min-height: 100px ;
	margin-left:10%;
	margin-top:1%;

}
.details{
	font-size: 12px;
}
.extra:hover{
	background: #FCFAFA;
	border: 1px #EBD3D3 solid;
	border-bottom: 8px solid #F32A72;
}
.extra>span,.extra>span>a:hover{
	font-size: 30px;text-shadow: 2px 2px #EBEBEB;
	text-decoration: none;
}
.progress{
	height: 8px;
}
	
	
</style>

