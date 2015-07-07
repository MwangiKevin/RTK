<div id="orders_contents">
	<table id="scmlt_table_orders" class="display table table-bordered" cellspacing="0" width="100%">	
		<thead>		 
			<tr>
				<th><b>Reports For</b></th>
				<th><b>MFL Code</b></th>
			  	<th><b>Facility Name</b></th>
			    <th><b>Compiled By</b></th>
			    <th><b>Approved By</b></th>
			    <th><b>Order Date</b></th>
            	<th ><b>Action</b></th> 
	          </tr>
	    </thead>
	    <tfoot>
	    	<tr>
				<th><b>Reports For</b></th>
				<th><b>MFL Code</b></th>
			  	<th><b>Facility Name</b></th>
			    <th><b>Compiled By</b></th>
			    <th><b>Approved By</b></th>
			    <th><b>Order Date</b></th>
            	<th ><b>Action</b></th> 
	          </tr>
	    </tfoot>	    
	</table>
</div>
<style type="text/css">
	#orders_contents{
		margin-top: 2%;
		padding-top: 1%;
		background-color: #ffffff;

	}
	#scmlt_table_orders{
		font-size: 11px;
	}
	#scmlt_table_orders_info{
	font-size: 11px; 
	margin-left: 5%;
	float: left;
	color: green;
	}
</style>
<script type="text/javascript">
	$(document).ready(function (e){
		var oTable = $('#scmlt_table_orders').dataTable(
		{	
			"bPaginate":false,				
		    "bFilter": true,
		    "bSearchable":true,
		    "bInfo":true
		});				
		$.ajax({
			url: "<?php echo base_url() . 'Scmlt_management/get_scmlt_orders'; ?>",
			dataType: 'json',
			success: function(s){
			// console.log(s);
			oTable.fnClearTable();
			for(var i = 0; i < s.length; i++) {
				oTable.fnAddData([
				s[i][0],
				s[i][1],
				s[i][2],
				s[i][3],
				s[i][4],
				s[i][5],
				s[i][6]
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
		$('#switch_sub').change(function(){
            var request_from = 'orders';
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
