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
<div class="panel panel-default"  >
    <div class="panel-heading" id="home" >
        <h4 class="panel-title">
            <a href="<?php echo base_url('Clc/sub_county'); ?>" href="#collapseOne" id="notifications"><span class="glyphicon glyphicon-arrow-left">
            </span>Back</a>
        </h4>
    </div>
</div>
<div id="my_new_menu" style="margin-top:21%;width:19%;height:340px;position:fixed;overflow-y:scroll;overflow-x:hidden;">
    <?php 
    
    foreach ($menu as $key => $value) {
        $link = $value['menu'];
        $fid = $value['id'];?>
        <div class="panel panel-default" >
            <div class="panel-heading" id="<?php echo $fid;?>">
                <h6 class="panel-title menu_fonts">                        
                    <?php echo $link;?>                    
                </h6>
            </div>
        </div>
    <?php }?>
    
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
    .menu_fonts{
        font-size: 12px;
        padding-left: 2%;
    }

    #my_new_menu{
        top: 0;
        bottom:0;
        /*position:fixed;*/
        overflow-y:scroll;
        overflow-x:hidden;
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