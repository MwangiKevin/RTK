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
        <a href="<?php echo base_url('Clc'); ?>" href="#collapseTwo" id="notifications" style="color:#000;text-decoration:none;display:block;">        
            <h4 class="panel-title" id="dpp_stats">                                    
               <span class="glyphicon glyphicon-home"></span>
                Home
            </h4>
        </a>          
    </div>
</div>
<div class="panel panel-default" >
    <div class="panel-heading" id="statistics">
        <a href="<?php echo base_url('Clc/statistics'); ?>" href="#collapseTwo" id="stocking_levels" style="color:#000;text-decoration:none;display:block;">        
            <h4 class="panel-title" id="dpp_stats">                                    
                <span class="glyphicon glyphicon-stats"></span>
                Stastistics
            </h4>
        </a>        
    </div>
</div>
<div class="panel panel-default" >
    <div class="panel-heading" id="subcounties">
        <a href="<?php echo site_url('Clc/sub_county'); ?>" href="#collapseTwo" id="stocking_levels" style="color:#000;text-decoration:none;display:block;">        
            <h4 class="panel-title">            
                <span class="glyphicon glyphicon-shopping-cart"></span>
                Sub-Counties
            </h4>
        </a>
    </div>
</div>
<div class="panel panel-default" id="management">
  <div class="panel-heading dropdown dropdown-toggle accordion-group">
    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#report" style="color:#000;text-decoration:none;display:block;">
        <h4 class="panel-title accordion-heading">            
            <span class="glyphicon glyphicon-shopping-cart">
           </span>Management
        </h4>    
    </span>
  </div> 
  <div id="report" class="accordion-body collapse" style="padding-left:2%;">
      <div class="panel-body">    
        <a href="<?php echo site_url('Clc/users'); ?>" href="#collapseTwo" id="stocking_levels"><span class="glyphicon glyphicon-shopping-cart">
        </span>User Management</a>
        
      </div>
      <div class="panel-body">     
        <a href="<?php echo site_url('Clc/facilities'); ?>" href="#collapseTwo" id="stocking_levels"><span class="glyphicon glyphicon-shopping-cart">
        </span>Facilities Mapping</a>    
      </div>
      <div class="panel-body">
        <a href="<?php echo site_url('Clc/sub_county'); ?>" href="#collapseTwo" id="stocking_levels"><span class="glyphicon glyphicon-shopping-cart">
        </span>Account Management</a>
      </div >
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
        $.ajax({
            url: "<?php echo base_url() . 'Clc_management/get_clc_counties'; ?>",
            dataType: 'json',
            success: function(s){
                var counties = s;                      
                if(counties!=null){
                    $('#switch_county').html(s);                
                }else{
                    $('#switch_county_main').hide();
                }
                
            },
            error: function(e){
                console.log(e.responseText);
            }            
        }); 
        $('#switch_county').change(function(){
            var request_from = 'Clc';
            var base_url = "<?php echo base_url() . 'Switcher/switch_county'; ?>";
            var switched_to = $('#switch_county').val();
            var url = base_url+'/'+request_from+'/'+switched_to;
            $.ajax({
                url:url,
                dataType: 'json',
                success: function(s){                
                   window.location = s.redirect;
                   // console.log(s);
                },
                error: function(e){
                    console.log(e.responseText);
                }            
            });               
                   
        });       
    });
    
</script>