<div class="panel-group " id="accordion" style="padding: 0;">   
<div class="panel panel-default active-panel alert"  id="system_alert_div" style="margin-top:4px;">    
    <p class="panel-title alert"  id="system_alert"></p>    
</div>
<div class="panel panel-default" id="switch_sub_main">    
        <select class="panel-title form-control" id="switch_sub">
        </select>
 </div>

<div class="panel panel-default"  >
    <div class="panel-heading" id="home" >
        <h4 class="panel-title">
            <a href="<?php echo base_url('Scmlt'); ?>" href="#collapseOne" id="notifications"><span class="glyphicon glyphicon-home">
            </span>Home</a>
        </h4>
    </div>
</div>
<div class="panel panel-default" >
    <div class="panel-heading" id="statistics">
        <h4 class="panel-title" id="dpp_stats">                        
            <a href="<?php echo base_url('Scmlt/statistics'); ?>" href="#collapseOne" id="notifications"><span class="glyphicon glyphicon-stats">
            </span>Statistics</a>
        </h4>
    </div>
</div>
<div class="panel panel-default" >
    <div class="panel-heading" id="orders">
        <h4 class="panel-title">
            <a href="<?php echo site_url('Scmlt/orders'); ?>" href="#collapseTwo" id="stocking_levels"><span class="glyphicon glyphicon-shopping-cart">
            </span>Orders</a>
        </h4>
    </div>
</div>
<div class="panel panel-default" >
    <div class="panel-heading" id="allocations">
        <h4 class="panel-title">
            <a href="<?php echo site_url('Scmlt/allocations'); ?>" href="#collapseThree" id="expiries"><span class="glyphicon glyphicon-transfer">
            </span>Allocation</a>
        </h4>
    </div>
</div>
<div class="panel panel-default" >
    <div class="panel-heading" id="reports_multiple">
        <h4 class="panel-title">
            <a href="<?php echo site_url('rtk_management/scmlt_allocations'); ?>" href="#collapseThree" id="expiries"><span class="glyphicon glyphicon-file">
            </span>Reports</a>&nbsp;&nbsp;&nbsp;&nbsp;<span id="sub_reports" class="glyphicon toggleSpan"></span>
            <br/>
            <div id="submit_reports_sub">
                <ul>
                    <li>
                        <a href="<?php echo site_url(''); ?>" href="#collapseThree" id="expiries" class="sub_menu_links"></span>Submit One</a><br/>               
                    </li>
                    <li>
                        <a href="<?php echo site_url(''); ?>" href="#collapseThree" id="expiries" class="sub_menu_links"></span>Submit Multiple</a>                
                    </li>
                </ul>             
                
            </div>            
        </h4>
    </div>
</div>
<div class="panel panel-default" id="report_progress">
    <div class="panel-heading" style="background-color:#fff">
        <h6 class="panel-title" style="font-size:12px" id="report_percentage"><span id="percentage_reported"></span> Reports Submitted (<span id="remaining_reports"></span> Remaining)</h6>
        <div class="panel-title progress progress-striped active" style="margin-top:5px">
            <div id="report_graph" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">            
                <span id="perc"></span>
            </div>
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
<script type="text/javascript">
    $(document).ready(function()
    {
        $('#submit_reports_sub').hide();    
        $('#system_alerts').hide();    
        $('.toggleSpan').addClass('glyphicon-chevron-down');      
        $('#sub_reports').click(function(){        
            $('#submit_reports_sub').toggle('fast');
            $('.toggleSpan').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
        });
        $.ajax({
            url: "<?php echo base_url() . 'Scmlt_management/get_scmlt_districts'; ?>",
            dataType: 'json',
            success: function(s){
                var count_dists = s.count_assigned;
                if(count_dists>0){
                    $('#switch_sub').html(s.districts);                
                }else{
                    $('#switch_sub_main').hide();
                }
                
            },
            error: function(e){
                console.log(e.responseText);
            }            
        });        
    });
    
</script>