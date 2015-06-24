<div id="clc_contents">
	<div id="main_graph" class="graph">
		
	</div>
		
</div>
<style type="text/css">
	.graph{
		height: 360px;
		width: 97%;
		border: 1px dotted green;
		float: left;
		margin-left: 3%;
		margin-top: 2%;
	}

	#main_percentage{
		height:20px;
		width: 97%;
		/*border: 1px ridge green;*/
		float: left;
		margin-left: 3%;
		margin-top: 2%;
		background-color:#ffffff; 
	}
	#clc_contents{
		margin-top: 2%;
		padding-top: 1%;
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
		$.ajax({
			url: "<?php echo base_url() . 'Admin_management/get_national_summary'; ?>",
			dataType: 'json',
			success: function(s){		
				var percentage = s.percentage;
				console.log(percentage);
				$('.progress-bar').css('width', percentage+'%').attr('aria-valuenow', percentage);
				$( "#main_percentage" ).progressbar({
					value: percentage
				});
				$( "#perc" ).html(percentage+' % Reported');
			},
			error: function(e){
				console.log(e.responseText);
			}
		});	
	// 	$.ajax({
	// 		url: "<?php echo base_url() . 'Clc_management/get_main_graph'; ?>",
	// 		dataType: 'json',
	// 		success: function(s){
	// 			var districts_list = s.districts;				
	// 			var reported_list = s.reported;
	// 			var nonreported_list = s.nonreported;
	// 			var month_text = s.englishdate;				
	// 			$('#main_graph').highcharts({
 //                    chart: {
 //                        type: 'bar'
 //                    },
 //                    title: {
 //                        text: 'County Reporting Rates for '+month_text
 //                    }, subtitle: {
 //                        text: 'Live data reports on RTK'
 //                    },
 //                    xAxis: {
 //                        categories: districts_list
 //                    },
 //                    yAxis: {
 //                        min: 0,
 //                        max:100,
 //                        title: {
 //                            text: 'Percentage Complete (%)'
 //                        }
 //                    },
 //                    legend: {
 //                        backgroundColor: '#FFFFFF',
 //                        reversed: true
 //                    },
 //                    plotOptions: {
 //                        series: {
 //                            stacking: 'normal'
 //                        }
 //                    },
 //                    series: [{
 //                            name: 'Not reported',
 //                            data: nonreported_list
 //                        }, {
 //                            name: 'Reported',
 //                            data: reported_list
 //                        }]
 //                });
	// 		},
	// 		error: function(e){
	// 			console.log(e.responseText);
	// 		}
	// 	});
	// 	$.ajax({
	// 		url: "<?php echo base_url() . 'Clc_management/get_early_vs_late'; ?>",
	// 		dataType: 'json',
	// 		success: function(s){
	// 			var late_reports = s.late_reports;			
	// 			var early_reports = s.early_reports;
	// 			var data = null;
	// 			var month_text = s.englishdate;				
	// 			if((late_reports==0)&&(early_reports==0)){
	// 				data = [{name:'No Reports Submitted', color:'blue', y:null}];	
	// 			}else if((late_reports==0)&&(early_reports!=0)){
	// 				data = [{name:'Early', color:'green', y:early_reports}];					
	// 			}else if((late_reports!=0)&&(early_reports==0)){
	// 				data = [{name:'Late', color:'red', y:late_reports}];					
	// 			}else if((late_reports!=0)&&(early_reports!=0)){
	// 				data = [{name:'Late', color:'red', y:late_reports},{name:'Early', color:'green', y:early_reports}];
	// 			}

	// 			// var data = [{name:'Late', color:'red', y:late_reports},{name:'Early', color:'green', y:early_reports}];
	// 			$('#early_vs_late').highcharts({
	// 	        chart: {
	// 	            type: 'pie',
	// 	        },
	// 	        title: {
	// 	            text: 'Early vs Late Reports for '+month_text
	// 	        },
	// 	        subtitle: {
	// 	            text: 'Out of Total Reports'
	// 	        },
	// 	        series: [{
	// 	            type: 'pie',
	// 	            name: 'Reports',
	// 	            data: data
	// 	        }]
	// 	    });
	// 		},
	// 		error: function(e){
	// 			console.log(e.responseText);
	// 		}
	// 	});
	// 	$.ajax({
	// 		url: "<?php echo base_url() . 'Clc_management/get_reported_vs_nonreported'; ?>",
	// 		dataType: 'json',
	// 		success: function(s){
	// 			var nonreported = s.nonreported_facilities;			
	// 			var reported = s.reported_facilities;
	// 			var data = null;
	// 			var month_text = s.englishdate;				
	// 			if((nonreported==0)&&(reported==0)){
	// 				data = [{name:'No Facilities Reported', color:'blue', y:null}];	
	// 			}else if((nonreported==0)&&(reported!=0)){
	// 				data = [{name:'Reported', color:'green', y:reported}];					
	// 			}else if((nonreported!=0)&&(reported==0)){
	// 				data = [{name:'Non Reported', color:'red', y:nonreported}];					
	// 			}else if((nonreported!=0)&&(reported!=0)){
	// 				data = [{name:'Non Reported', color:'red', y:nonreported},{name:'Reported', color:'green', y:reported}];
	// 			}

	// 			$('#reported_vs_non').highcharts({
	// 	        chart: {
	// 	            type: 'pie',
	// 	        },
	// 	        title: {
	// 	            text: 'Reported vs Non Reported Facilities for '+month_text
	// 	        },
	// 	        subtitle: {
	// 	            text: 'Out of Total Facilities'
	// 	        },
	// 	        series: [{
	// 	            type: 'pie',
	// 	            name: 'Facilities',
	// 	            data: data
	// 	        }]
	// 	    });
	// 		},
	// 		error: function(e){
	// 			console.log(e.responseText);
	// 		}
	// 	});
	// 	$.ajax({
	// 		url: "<?php echo base_url() . 'Clc_management/get_trend_graph'; ?>",
	// 		dataType: 'json',
	// 		success: function(s){
	// 			var month_text = s.month_text;
	// 			var cumulative_result = s.cumulative_result;
	// 			var jsonx = s.jsonx;
	// 			var jsony = s.jsony;
	// 			var jsonx1 = s.jsonx1;
	// 			$('#main_trend').highcharts({
 //                chart: {
 //                    type: 'line'
 //                },
 //                title: {
 //                    text: 'Reporting Trends for '+month_text
 //                },
 //                subtitle: {
 //                    text: 'Live Data from RTK System'
 //                },
 //                xAxis: {
 //                    categories: jsony
 //                },
 //                yAxis: {
 //                    min: 0,                    
 //                    title: {
 //                        text: 'F-CDRR Reports'
 //                    }
 //                },
 //                tooltip: {
 //                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
 //                    pointFormat: '<tr><td style="color:{series.color};padding:0;font-size:11px;">{series.name}: </td>' +
 //                    '<td style="padding:0;font-size:11px;"><b>{point.y:.0f} Reports</b></td></tr>',
 //                    footerFormat: '</table>',
 //                    shared: true,
 //                    useHTML: true
 //                },
 //                plotOptions: {
 //                    column: {
 //                        pointPadding: 0.2,
 //                        borderWidth: 0
 //                    }
 //                },
 //                credits: false,
 //                series: [{
 //                    name: 'Cumulative Trend',
 //                    data: jsonx1
 //                },
 //                {
 //                    name: 'Daily Trend',
 //                    data: jsonx
 //                }]
 //            });
	// 		},
	// 		error: function(e){
	// 			console.log(e.responseText);
	// 		}
	// 	});
		
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
