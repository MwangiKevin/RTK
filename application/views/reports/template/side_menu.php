<div class="panel-group " id="accordion" style="padding: 0;"> 

<div class="panel panel-default"  >
    <div class="panel-heading" id="home" >
        <h4 class="panel-title">
            <a href="<?php echo base_url('Reports'); ?>" href="#collapseOne" id="notifications"><span class="glyphicon glyphicon-home">
            </span>National Reports</a>
        </h4>
    </div>
</div>
<div class="panel panel-default" >
    <div class="panel-heading" id="statistics">
        <h4 class="panel-title" id="dpp_stats">                        
            <a href="<?php echo base_url('Reports/national_clc'); ?>" href="#collapseOne" id="notifications"><span class="glyphicon glyphicon-stats">
            </span>County Reports</a>
        </h4>
    </div>
</div>
<div class="panel panel-default" >
    <div class="panel-heading" id="orders">
        <h4 class="panel-title">
            <a href="<?php echo site_url('Reports/national_partner'); ?>" href="#collapseTwo" id="stocking_levels"><span class="glyphicon glyphicon-shopping-cart">
            </span>Partner Reports</a>
        </h4>
    </div>
</div>
<div class="panel panel-default" >
    <div class="panel-heading" id="allocations">
        <h4 class="panel-title">
            <a href="<?php echo site_url('Reports/national_commodity_usage'); ?>" href="#collapseThree" id="expiries"><span class="glyphicon glyphicon-transfer">
            </span>Commodity Usage</a>
        </h4>
    </div>
</div>
</div>

</div>
<style type="text/css">
	#side_menu ul
	{
		display: block;
		width: 100%;
		text-decoration: none;
		text-align: center;
		list-style-type: none;
	}
	#sub_reports
    {
        float: right;
    }
    .panel-default > .currently_active_panel {
      background-color: green;
      color: white;
    }
    
    .alert{
        background-color: fff;
        color: red;
        font-size: 11px;   
    }
    
    #side_menu li a
    {
        display: block;
        margin-left: 1%;
        margin-top: 1%;
        text-decoration: none;
        padding: 2%;
        line-height: 120%;
        border: 1px solid #ccc;
        /*background-color: #fff;*/
    }
    
   
</style>
