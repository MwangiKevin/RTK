<div id="clc_contents">		

	<div id="main_graph" class="graphs table_divs panel panel-success">		  <!-- Default panel contents -->
	  <div class="panel-heading" style="font-size:13px;font-weight:bold">National County Reporting Summary </div>
	  <div id="main_chart_body" class="panel-body" style="height:1800px;"></div>
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
		min-height: 400px;
		height: auto;
		width: 98%;		
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
		load_main_graph();
		function load_main_graph()
		{
			$.ajax({
			url: "<?php echo base_url() . 'Allocation_management/allocation_trend'; ?>",
			dataType: 'json',
			success: function(s){		
				var percentages = s.percentages;
				var months_texts = s.months_texts;
				// var percentages_last = s.last_month;
				// var percentages_last1 = s.last_month1;
				// var months_list = s.months_list;
				// var header_month = s.months_list[3];
				
				console.log(s);		
				 $('#main_graph').highcharts({
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'RTKs Reporting Rate',
                    x: -20 //center
                },
                subtitle: {
                    text: 'Live Data From RTK System',
                    x: -20
                },
                xAxis: {
                    categories:months_texts
                },
                  yAxis: {
                  	min:0,
                  	max:100,
                      title: {
                          text: 'Reports Submission (%)'
                      },
                      plotLines: [{
                          value: 0,
                          width: 1,
                          color: '#009933'
                      }]
                  },
                  tooltip: {
                      valueSuffix: '%'
                  },
                  legend: {
                      layout: 'horizontal',
                      align: 'right',
                      verticalAlign: 'middle',
                      borderWidth: 0
                  },
                  plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                credits: false,
                series: [{
                    color: '#009933',

                    name: 'Reporting Rates',
                    data: percentages
                }]
            });					
			},
			error: function(e){
				console.log(e.responseText);
			}
		});	
		}
		
	    
	});
	


	$(document).ajaxStart(function(){
	    $('#loading').show();
	 }).ajaxStop(function(){
	    $('#loading').hide();
	 });
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
