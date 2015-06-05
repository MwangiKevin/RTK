<div class="panel-group " id="accordion" style="padding: 0;">   
<div class="panel panel-default active-panel alert"  id="system_alert_div" style="margin-top:4px;">    
    <p class="panel-title alert"  id="system_alert"></p>    
</div>
<div class="panel panel-default" id="switch_county_main">    
        <select class="panel-title form-control" id="switch_county">
        </select>
 </div>

<div class="panel panel-default"  >
    <div class="panel-heading" id="home" >
        <h4 class="panel-title">
            <a href="<?php echo base_url('Clc'); ?>" href="#collapseOne" id="notifications"><span class="glyphicon glyphicon-home">
            </span>Home</a>
        </h4>
    </div>
</div>
<div class="panel panel-default" >
    <div class="panel-heading" id="statistics">
        <h4 class="panel-title" id="dpp_stats">                        
            <a href="<?php echo base_url('Clc/statistics'); ?>" href="#collapseOne" id="notifications"><span class="glyphicon glyphicon-stats">
            </span>Statistics</a>
        </h4>
    </div>
</div>
<div class="panel panel-default" >
    <div class="panel-heading" id="subcounties">
        <h4 class="panel-title">
            <a href="<?php echo site_url('Clc/sub_county'); ?>" href="#collapseTwo" id="stocking_levels"><span class="glyphicon glyphicon-shopping-cart">
            </span>Sub-Counties</a>
        </h4>
    </div>
</div>
<div class="panel panel-default" >
    <div class="panel-heading" id="management">
        <h4 class="panel-title">
            <a href="<?php echo site_url('Clc/management'); ?>" href="#collapseThree" id="expiries"><span class="glyphicon glyphicon-transfer">
            </span>Management</a>
        </h4>
    </div>
</div>
<div class="panel panel-default" >
    <div class="panel-heading" id="reports">
        <h4 class="panel-title">
            <a href="<?php echo site_url('Reports/clc'); ?>" href="#collapseThree" id="expiries"><span class="glyphicon glyphicon-file">
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