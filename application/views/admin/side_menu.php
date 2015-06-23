<div class="panel-group " id="accordion" style="padding: 0;">   
<div class="panel panel-default active-panel alert"  id="system_alert_div" style="margin-top:4px;">    
    <p class="panel-title alert"  id="system_alert"></p>    
</div>

<div class="panel panel-default"  >
    <div class="panel-heading" id="summary" >
        <a href="<?php echo base_url('Admin'); ?>" href="#collapseTwo" id="notifications" style="color:#000;text-decoration:none;display:block;">        
            <h4 class="panel-title" id="dpp_stats">                                    
               <span class="glyphicon glyphicon-home"></span>
                Summary
            </h4>
        </a>          
    </div>
</div>
<div class="panel panel-default" >
    <div class="panel-heading" id="reports">
        <a href="<?php echo base_url('Reports'); ?>" href="#collapseTwo" id="stocking_levels" style="color:#000;text-decoration:none;display:block;">        
            <h4 class="panel-title" id="dpp_stats">                                    
                <span class="glyphicon glyphicon-stats"></span>
                Reports
            </h4>
        </a>        
    </div>
</div>
<div class="panel panel-default" >
    <div class="panel-heading" id="admin_management">
        <a href="<?php echo site_url('Admin/admin_management'); ?>" href="#collapseTwo" id="stocking_levels" style="color:#000;text-decoration:none;display:block;">        
            <h4 class="panel-title">            
                <span class="glyphicon glyphicon-cog"></span>
                Admin Management
            </h4>
        </a>
    </div>
</div>
<div class="panel panel-default" id="stock_status">
  <div class="panel-heading dropdown dropdown-toggle accordion-group">
    <a href="<?php echo site_url('Admin/stock_status'); ?>" href="#collapseTwo" id="stocking_levels" style="color:#000;text-decoration:none;display:block;">        
        <h4 class="panel-title ">            
            <span class="glyphicon glyphicon-shopping-cart"></span>
           </span>Stock Status
        </h4>    
    </span>
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
        $('#management').click(function(){        
            $('#management_subs').toggle('fast');
            $('.toggleSpan1').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
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