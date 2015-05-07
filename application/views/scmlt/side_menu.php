<div class="panel-group " id="accordion" style="padding: 0;">
<select id="switch_subcounty" class="form-control">                    
    <?php 
        $option = '<option value="0">Select Sub-County</option>';
        for ($i=1; $i <12 ; $i++) { 
            $option.= '<option value='.$i.'>Sub-County '.$i.'</option>';
        }
    ?>
    <?php echo $option;?>
</select>                            
<div class="panel panel-default" id="stats">
    <div class="panel-heading">
        
    </div>
</div>
<div class="panel panel-default active-panel" id="home">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a href="<?php echo base_url('Home'); ?>" href="#collapseOne" id="notifications"><span class="glyphicon glyphicon-home">
            </span>Home</a>
        </h4>
    </div>
</div>
<div class="panel panel-default" id="stats">
    <div class="panel-heading">
        <h4 class="panel-title" id="dpp_stats">                        
            <a href="#" href="#collapseOne" id="notifications"><span class="glyphicon glyphicon-stats">
            </span>Statistics</a>
        </h4>
    </div>
</div>
<div class="panel panel-default" id="orders">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a href="<?php echo site_url('rtk_management/scmlt_orders'); ?>" href="#collapseTwo" id="stocking_levels"><span class="glyphicon glyphicon-shopping-cart">
            </span>Orders</a>
        </h4>
    </div>
</div>
<div class="panel panel-default" id="allocations">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a href="<?php echo site_url('rtk_management/scmlt_allocations'); ?>" href="#collapseThree" id="expiries"><span class="glyphicon glyphicon-transfer">
            </span>Allocation</a>
        </h4>
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
	#side_menu li a
	{
		background-color: #ccc;
	}
</style>