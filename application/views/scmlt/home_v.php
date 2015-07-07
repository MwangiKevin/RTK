<div id="scmlt_contents">
	<table id="scmlt_table_example" class="display table table-bordered" cellspacing="0" width="100%">	
		<thead>
			<tr>
				<th><b>MFL Code</b></th>
			  	<th><b>Facility Name</b></th>
			    <th><b>Owner</b></th>
            	<th ><b>Reports</b></th> 
	          </tr>
	    </thead>
	    <tfoot>
	    	<tr>
				<th><b>MFL Code</b></th>
			  	<th><b>Facility Name</b></th>
			    <th><b>Owner</b></th>
            	<th ><b>Reports</b></th> 
	          </tr>
	    </tfoot>	    
	</table>
</div>
<style type="text/css">
	#scmlt_contents{
		margin-top: 2%;
		padding-top: 1%;
		background-color: #ffffff;

	}
	#scmlt_table_example{
		font-size: 11px;
	}
	#scmlt_table_example_info{
	font-size: 11px; 
	margin-left: 5%;
	float: left;
	color: green;
	}
</style>
<script type="text/javascript">
	$(document).ready(function (e){
		var oTable = $('#scmlt_table_example').dataTable(
		{	
			"bPaginate":false,	
			"aaSorting": [[3, "asc"]],    
		    "bFilter": true,
		    "bSearchable":true,
		    "bInfo":true
		});				
		$.ajax({
			url: "<?php echo base_url() . 'Scmlt_management/get_scmlt_home'; ?>",
			dataType: 'json',
			success: function(s){
			// console.log(s);
			oTable.fnClearTable();
			for(var i = 0; i < s.length; i++) {
				oTable.fnAddData([
				s[i][0],
				s[i][1],
				s[i][2],
				s[i][3]
				]);
				} // End For
			},
			error: function(e){
				console.log(e.responseText);
			}
		});
		$.ajax({
			url: "<?php echo base_url() . 'Scmlt_management/get_reporting_message'; ?>",
			dataType: 'json',
			success: function(s){
				$('#alert').html(s);				
			},
			error: function(e){
				console.log(e.responseText);
			}
		});
		var total = 0;
		var reported = 0;
		var nonreported = 0;
		var percentage = 0;
		$.ajax({
			url: "<?php echo base_url() . 'Scmlt_management/get_reporting_percentage'; ?>",
			dataType: 'json',
			success: function(s){
				console.log(s);
				for(var i = 0; i < s.length; i++) {
					reported = s[i]['reported'];
					nonreported = s[i]['nonreported'];
					total = s[i]['total'];
					percentage = s[i]['percentage'];
					$('#remaining_reports').html(nonreported);
					$('#percentage_reported').html(reported);					
					$('.progress-bar').css('width', percentage+'%').attr('aria-valuenow', percentage);
					$( "#report_graph_test" ).progressbar({
						value: percentage
					});
					$( "#perc" ).html(percentage+' %');
				}
			},
			error: function(e){
				console.log(e.responseText);
			}
		});
		$('#switch_sub').change(function(){
            var request_from = 'Scmlt';
            var base_url = "<?php echo base_url() . 'Switcher/switch_district'; ?>";
            var switched_to = $('#switch_sub').val();
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
