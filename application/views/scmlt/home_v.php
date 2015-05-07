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
</style>
<script type="text/javascript">
	$(document).ready(function (e){
		var oTable = $('#scmlt_table_example').dataTable(
		{	
			"bPaginate":false,	    
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
