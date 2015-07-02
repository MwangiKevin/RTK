<div id="clc_contents">	
	<div id="main_filter" class="graphs table_divs panel panel-info" style="margin-top:-10px;">		  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">Main Filter</div>
	  <!-- <div class="panel-body"></div> -->
	</div>

	<div id="main_graph" class="graphs table_divs panel panel-success">		  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">National Reporting Trend for: <span id="report_period_header"></span></div>
	  <div id="main_chart_body" class="panel-body" style="height:400px;"></div>	  	  	
	  <div id="main_chart_bar" class="panel-body" style="height:60px;width:100%;">
	  	<div style="height:30px;width:100%;">
          Countrywide Progress: <span id="country_progress_bar"></span> %
          <div class="progress">
          	<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" >
          	</div>
          </div>
        </div>

	  </div>	  	  	
	</div>		
	
</div>
<style type="text/css">
	.graph{
		min-height: 360px;
		height: auto;
		width: 100%;
		border: 1px dotted green;
		float: left;
		margin-left: 3%;
		margin-top: -1%;
	}

	#main_graph{
		min-height: 350px;		
		width: 100%;		
		float: left;
		margin-left: 1%;
		margin-top: 0%;
	}

	#main_filter{		
		height: auto;
		width: 100%;		
		float: left;
		margin-left: 1%;
		margin-top: 0%;
	}
	#clc_contents{
		margin-top: 2%;		
		background-color: #ffffff;
	}

	.charts{
		height: 300px;
		width: 47%;
		border: 1px dotted green;
		float: left;
		margin-left: 3%;
		margin-top: 2%;
	}	
	
</style>

<script type="text/javascript">
	$(document).ready(function (e){		
		// $.ajax({
		// 	url: "<?php echo base_url() . 'Admin_management/get_national_summary'; ?>",
		// 	dataType: 'json',
		// 	success: function(s){		
		// 		var percentage = s.percentage;
		// 		console.log(percentage);
		// 		$('.progress-bar').css('width', percentage+'%').attr('aria-valuenow', percentage);
		// 		$( "#main_percentage" ).progressbar({
		// 			value: percentage
		// 		});
		// 		$( "#perc" ).html(percentage+' % Reported');
		// 	},
		// 	error: function(e){
		// 		console.log(e.responseText);
		// 	}
		// });	
		load_main_graph();
		function load_main_graph()
		{
			$.ajax({
			url: "<?php echo base_url() . 'Admin_management/get_national_trend/062015/'; ?>",
			dataType: 'json',
			success: function(s){		
				var jsony = s.jsony;
				var jsonx = s.jsonx;
				var jsonx1 = s.jsonx1;
				var country_progress_bar = s.reporting_rate;
				var englishdate = s.englishdate;				
				$('#country_progress_bar').html(country_progress_bar);
				$('#report_period_header').html(englishdate);
				$('.progress-bar').css('width', country_progress_bar+'%').attr('aria-valuenow', country_progress_bar); 
				// $('#report_period_header').html(header_month);
				console.log(s);		
				 $('#main_chart_body').highcharts({
			        chart: {
	                    type: 'line'
	                },
	                title: {
	                    text: 'RTK Reporting Trends'
	                },
	                subtitle: {
	                    text: 'Live Data from RTK Sytem'
	                },
	                xAxis: {
	                    categories:jsony
	                },
	                yAxis: {
	                    min: 0,
	                    title: {
	                        text: 'F-CDRR Reports'
	                    }
	                },
	                tooltip: {
	                    headerFormat: '<span style="font-size:3px">{point.key}</span><table>',
	                    pointFormat: '<tr><td style="color:{series.color};padding:0;font-size:11px;">{series.name}: </td>' +
	                    '<td style="padding:0;font-size:11px;"><b>{point.y:.0f} Reports</b></td></tr>',
	                    footerFormat: '</table>',
	                    shared: true,
	                    useHTML: true
	                },
	                plotOptions: {
	                    column: {
	                        pointPadding: 0.2,
	                        borderWidth: 0
	                    }
	                },
	                credits: false,
	                series: [{	                	
	                    name: 'Culmulative Trend',
	                    data: jsonx1
	                },
	                {
	                	color:'green',
	                    name: 'Daily Trend',
	                    data: jsonx
	                }]
	            });
			        				
			},
			error: function(e){
				console.log(e.responseText);
			}
		});	
		}
	    
	});
	


	// $(document).ajaxStart(function(){
	//     $('#loading').show();
	//  }).ajaxStop(function(){
	//     $('#loading').hide();
	//  });
</script>


	
</div>
<div class="modal" id="loading">
	
</div>
<style type="text/css">
	.modal
	{
	    display:    none;
	    position:   fixed;
	    z-index:    1000;
	    top:        0;
	    left:       0;
	    height:     100%;
	    width:      100%;
	    background: rgba( 255, 255, 255, .8 ) 
	                url('<?php echo base_url();?>assets/img/new_loader.gif') 
	                50% 50% 
	                no-repeat;	    
	}

	/* When the body has the loading class, we turn
	   the scrollbar off with overflow:hidden */
	body.loading {
	    overflow: hidden;   
	}

	/* Anytime the body has the loading class, our
	   modal element will be visible */
	body.loading .modal {
	    display: block;
	}

</style>
