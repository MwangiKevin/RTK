<div id="admin_contents">
	
	<div id="stock_card" class="charts panel panel-success" width = "100%">
	  <!-- Default panel contents -->
	  <div class="panel-heading">
	  Stock Status per County
	  <button id="download_alloacation" class="form-control btn btn-primary" style="width:20%;height:auto;font-size:11px;"> Download as Excel</button>
	  </div>

	  <table id="stock_card_table" class="charts-inner display table table-bordered" cellspacing="0">
			<thead>
				<tr>        
			       <tr>        
			      <th rowspan="2" align="center">County</th>
			      <th rowspan="2" align="center">Sub-County</th>
			      <th rowspan="2" align="center">MFL</th>
			      <th rowspan="2" align="center">Facility Name</th>     
			      <th align="center" colspan="2">Screening KHB</th>      
			      <th align="center" colspan="2">Confirmatory First Response</th>      
			      <th align="center" colspan="2">TieBreaker - Unigold</th> 
			    </tr>    
			    <tr>	          
			         
			      <th align="center">Ending Balance</th>      
			      <th align="center">AMC</th>
			      <th align="center">Ending Balance</th>      
			      <th align="center">AMC</th>
			      <th align="center">Ending Balance</th>      
			      <th align="center">AMC</th>                
			    </tr>
			</thead>			
		</table>
	</div>	
		
</div>
<style type="text/css">
	.graph{
		height: 360px;
		width: 97%;
		border: 1px dotted green;
		float: left;
		margin-left: %;
		margin-top: 2%;
	}
	.table{
		font-size: 11px;
		/*margin: 1%;	*/
		width: 100%;	
	}

	.table th{
		text-align: center;
	}

	#admin_contents{
		margin-top: 2%;
		padding-top: 1%;
		background-color: #ffffff;
		
	}

	.charts{
		min-height: 500px;
		height: auto;
		width: 98%;
		/*border: 1px dotted green;*/
		float: left;
		margin-left: 2%;
		margin-top: 2%;
	}	
	.charts-inner{
		max-height: 480px;
		height: auto;		
	}	
	
	
</style>
<script type="text/javascript">
	$(document).ready(function (e){	
		get_stock_status_data();
		function get_stock_status_data(){
			var get_zone = window.location.pathname.split( '/' );
	      	var zone = get_zone[4]; 
			var baseurl = "<?php echo base_url() . 'Allocation_management/get_allocation_details/'; ?>";
			var url =baseurl + zone;
			var oTable = $('#stock_card_table').dataTable(
			{	
				"bPaginate":false,	
				"aaSorting": [[0, "asc"]],    
			    "bFilter": false,
			    "bSearchable":false,
			    "bInfo":false
			});	
			
			$.ajax({
				url: url,
				dataType: 'json',
				success: function(s){
				console.log(s);
				oTable.fnClearTable();
				for(var i = 0; i < s.length; i++) {
					oTable.fnAddData([
					s[i][0],
					s[i][1],
					s[i][2],
					s[i][3],
					s[i][4],
					s[i][5],
					s[i][6],
					s[i][7],
					s[i][8],
					s[i][9]
					]);
					} // End For
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
