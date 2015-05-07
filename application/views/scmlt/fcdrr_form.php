<div id="dialog-form" title="Enter the lab commodity details here">
    <form>
        <table id="fcdrr_table_example" width="10%" class="data-table">
        	<thead>
        		<input  type="hidden" name="facility_name" colspan = "3" style = "color:#000; border:none" value="<?php echo $facility_name ?>"></td>
            <input type="hidden" name="facility_code" colspan = "2" style = "color:#000; border:none" value="<?php echo $facility_code ?>"></td>
            <input type="hidden" name="district_name" colspan = "2" style = "color:#000; border:none" value="<?php echo $district_name ?>"></td>
            <input type="hidden" name="county" colspan = "3" style = "color:#000; border:none" value="<?php echo $county_name ?>"></td>

            <tr><td style = "text-align:left"><b>Name of Facility:</b></td>
                <td colspan = "2"><?php echo $facility_name ?></td>
                <td rowspan = "8" style="background: #fff;"></td>
                <td colspan = "3"><b>Applicable to HIV Test Kits Only</b></td>
                <td colspan = "2"></td>
                <td colspan = "4" style="text-align:center"><b>Applicable to Malaria Testing Only</b></td>
                <td colspan = "1" rowspan = "8" style="background: #fff;"></td>
            </tr>
            <tr ><td colspan = "2" style = "text-align:left"><b>MFL Code:</b></td>
                <td><?php echo $facility_code ?></td>
                <td colspan = "2" style="text-align:center"><b>Type of Service</b></td>
                <td colspan = "1" style="text-align:center"><b>No. of Tests Done</b></td>
                <td colspan = "2"></td>
                <td colspan = "1"><b>Test</b></td>
                <td colspan = "1"><b>Category</b></td>
                <td colspan = "1"><b>No. of Tests Performed</b></td>
                <td colspan = "1"><b>No. Positive</b></td>                          
            </tr>
            <tr><td colspan = "2" style = "text-align:left"><b>Sub-County:</b></td>
                <td><?php echo $district_name ?></td>
                <td colspan = "2"><b>VCT</b></td>
                <td><input class='user2'class='user2' id="vct" name="vct" colspan = "2" style = "color:#000" value=0></td>
                <td colspan = "2"></td>
                <td rowspan = "3">RDT</td>
                <td style = "text-align:left">Patients&nbsp;<u>under</u> 5&nbsp;years</td>
                <td><input class='user2'id="rdt_under_tests" name="rdt_under_tests" size="10" type="text"/></td>
                <td><input class='user2'id="rdt_under_positive" name="rdt_under_positive" size="10" type="text"/></td>                          

            </tr>
            <tr><td colspan = "2" style = "text-align:left"><b>County:</b></td>                     
                <td><?php echo $county_name ?></td>
                <td colspan = "2"><b>PITC</b></td>
                <td><input class='user2'class='user2' id="pitc" name="pitc" colspan = "2" style = "color:#000" value=0></td>
                <td colspan = "2"></td>
                <td style = "text-align:left">Patients&nbsp;aged 5-14&nbsp;yrs</td>
                <td><input class='user2'id="rdt_to_tests" name="rdt_to_tests" size="10" type="text"/></td>
                <td><input class='user2'id="rdt_to_positive" name="rdt_to_positive" size="10" type="text"/></td>                        </tr>
                <tr><td colspan = "2" style = "text-align:right"><b>Beginning:</b></td> 
                    <td><input class='my_date'id="begin_date" name="begin_date" colspan = "2" size="10" type="text"/></td>
                    <td colspan = "2"><b>PMTCT</b></td>
                    <td><input class='user2'class='user2' id="pmtct" name="pmtct" colspan = "2" style = "color:#000" value=0></td>
                    <td colspan = "2"></td>
                    <td style = "text-align:left">Patients&nbsp;<u>over</u> 14&nbsp;years</td>
                    <td><input class='user2'id="rdt_over_tests" name="rdt_over_tests" size="10" type="text"/></td>
                    <td><input class='user2'id="rdt_over_positive" name="rdt_over_positive" size="10" type="text"/></td>

                </tr>
                <tr><td colspan = "2" style = "text-align:right"><b>Ending:</b></td>
                    <td><input class='my_date'id="end_date" name="end_date" colspan = "2" size="10" type="text"/></td>
                    <td colspan = "2"><b>Blood&nbsp;Screening</b></td>
                    <td><input class='user2'class='user2' id="blood_screening" name="blood_screening" colspan = "2" style = "color:#000" value=0></td>
                    <td colspan = "2"></td>
                    <td rowspan = "3">Microscopy</td>
                    <td style = "text-align:left">Patients&nbsp;<u>under</u> 5&nbsp;years</td>
                    <td><input class='user2'id="micro_under_tests" name="micro_under_tests" size="10" type="text"/></td>
                    <td><input class='user2'id="micro_under_positive" name="micro_under_positive" size="10" type="text"/></td>                          
                </tr>
                <tr ><td colspan = "3"></td>
                    <td colspan = "2"><b>Other&nbsp;(Please&nbsp;Specify)</b></td>
                    <td><input class='user2'class='user2' id="other2" name="other2" colspan = "2" style = "color:#000" value=0></td>    
                    <td colspan = "2"></td>
                    <td style = "text-align:left">Patients&nbsp;aged 5-14&nbsp;yrs</td>
                    <td><input class='user2'id="micro_to_tests" name="micro_to_tests" size="10" type="text"/></td>
                    <td><input class='user2'id="micro_to_positive" name="micro_to_positive" size="10" type="text"/></td>
                </tr>
                <tr><td colspan = "3"></td>
                    <td colspan = "2"><b>Specify&nbsp;Here:</b></td>
                    <td><input class='user2'class='user2' id="specification" name="specification" colspan = "2" style = "color:#000"></td>  
                    <td colspan = "2"></td>
                    <td style = "text-align:left">Patients&nbsp;<u>over</u> 14&nbsp;years</td>
                    <td><input class='user2'id="micro_over_tests" name="micro_over_tests" size="10" type="text"/></td>
                    <td><input class='user2'id="micro_over_positive" name="micro_over_positive" size="10" type="text"/></td>
                </tr>



                <tr>
                        <td colspan = "14" style = "text-align:center;" id="calc">
                            <b>The Ending Balance is Computed as follows: </b><i>Beginning Balance + Quantity Received + Positive Adjustments - Quantity Used - Negative Adjustments - Losses</i> 
                            <b><br/>Note:</b>
                            The Quantity Used Should Not be Less than the Tests Done
                        </td>            
                    </tr>
                <tr><td colspan = "14"></td></tr>
                <tr >       
                    <td rowspan = "2" colspan = "2"><b>Commodity Name</b></td>
                    <td rowspan = "2"><b>Unit of Issue (e.g. Test)</b></td>
                    <td rowspan = "2"><b>Beginning Balance</b></td>
                    <td rowspan = "2"><b>Quantity Received</b></td>
                    <td rowspan = "2"><b>Quantity Used</b></td>
                    <td rowspan = "2"><b>Number of Tests Done</b></td>
                    <td rowspan = "2"><b>Losses</b></td>
                    <td colspan = "2"><b>Adjustments [indicate if (+) or (-)]</b></td>  
                    <td rowspan = "2"><b>End of Month Physical Count</b></td>
                    <td rowspan = "2"><b>Quantity Expriing in <u>less than</u> 6 Months</b></td>
                    <td rowspan = "2"><b>Days out of Stock</b></td> 
                    <td rowspan = "2"><b>Quantity Requested for&nbsp;Re-Supply</b></td>
                </tr>
                <tr>
                    <td>Positive</td>
                    <td>Negative</td>
                </tr>
                <?php
                $checker = 0;
                foreach ($lab_categories as $lab_category) {
                    ?>
                    <tr>
                        <td colspan = "14" style = "text-align:left"><b><?php echo $lab_category['category_name']; ?></b></td>            
                    </tr>                    
                    <?php foreach ($lab_commodities_categories as $lab_commodities) { ?>
                    <tr commodity_id="<?php echo $checker ?>"><input type="hidden" id="commodity_id_<?php echo $checker ?>" name="commodity_id[<?php echo $checker ?>]" value="<?php echo $lab_commodities['id']; ?>" >
                        <input type="hidden" id="facilityCode" name="facilityCode">
                        <input type="hidden" id="district" name="district" value="<?php echo $district_id; ?>">
                        <input type="hidden" id="unit_of_issue_<?php echo $checker ?>" name = "unit_of_issue[<?php echo $checker ?>]" value="<?php echo $lab_commodities['unit_of_issue']; ?>">
                        <td class="commodity_names" id="commodity_name_<?php echo $checker;?>" colspan = "2" style = "text-align:left"></b><?php echo $lab_commodities['commodity_name']; ?></td>
                        <td style = "color:#000; border:none; text; text-align:center"><?php //echo $lab_commodities['unit_of_issue'];  ?>TESTS</td>
                        <td><input id="b_balance_<?php echo $checker ?>" data-uiid="<?php echo $checker ?>" name = "b_balance[<?php echo $checker ?>]" class='bbal' size="10" type="text" value="0" style = "text-align:center"/></td>
                        <td><input id="q_received_<?php echo $checker ?>" name = "q_received[<?php echo $checker ?>]" class='qty_rcvd' size="10" type="text" value="0" style = "text-align:center"/></td>
                        <td><input id="q_used_<?php echo $checker ?>" name = "q_used[<?php echo $checker ?>]" class='qty_used' size="10" type="text" value="0" style = "text-align:center"/></td>
                        <td><input id="tests_done_<?php echo $checker ?>" name = "tests_done[<?php echo $checker ?>]" class='tests_done' size="10" value="0" type="text" style = "text-align:center"/></td>
                        <td><input id="losses_<?php echo $checker ?>" name = "losses[<?php echo $checker ?>]" class='losses' size="10" type="text" value="0" style = "text-align:center" /></td>
                        <td><input id="pos_adj_<?php echo $checker ?>" name = "pos_adj[<?php echo $checker ?>]" class='pos_adj' size="10" type="text" value="0" style = "text-align:center"/></td>  
                        <td><input id="neg_adj_<?php echo $checker ?>" name = "neg_adj[<?php echo $checker ?>]" class='neg_adj' size="10" type="text" value="0" style = "text-align:center"/></td>
                        <td><input id="physical_count_<?php echo $checker ?>"  name = "physical_count[<?php echo $checker ?>]" class='phys_count' value="0" size="10" type="text" style = "text-align:center"/></td>
                        <td><input id="q_expiring_<?php echo $checker ?>" name = "q_expiring[<?php echo $checker ?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>
                        <td><input id="days_out_of_stock_<?php echo $checker ?>" name = "days_out_of_stock[<?php echo $checker ?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>  
                        <td><input id="q_requested_<?php echo $checker ?>" data-uiid="<?php echo $checker ?>"name = "q_requested[<?php echo $checker ?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>                  
                    </tr>
                    <?php $checker++;
                }
            }
            ?>
            <tr>
                <td colspan = "14"><br/></td>
            </tr>
            <tr>                    
                <td colspan = "14" style = "text-align:left;background: #EEE;">Explain Losses and Adjustments</td>
            </tr>
            <tr>                        
                <td colspan = "16"><input colspan = "16" id="explanation" name="explanation" size="210" type="text" value="" style=" width: 90%;"/></td>
            </tr>
            <tr></tr>


            <tr>
                <td colspan = "3" style = "text-align:left"><b>Order for Extra LMIS tools:<br/> To be requested only when your data collection or reporting tools are nearly full. Indicate quantity required for each tool type.</b></td>
                <td><input class='user2'id="order_extra" name="order_extra" size="10" type="text"/></td>
                <td colspan = "4"><b>(1) Daily Activity Register for Laboratory Reagents and Consumables (MOH 642):</b></td>
                <td><input class='user2'id="moh_642" name="moh_642" size="10" type="text"/></td>
                <td colspan = "3"><b>(2) F-CDRR for Laboratory Commodities (MOH 643):</b></td>
                <td colspan = "2"><input class='user2'id="moh_643" name="moh_643" size="10" type="text"/></td>
            </tr>   


            <tr>                    <td colspan = "3" style = "text-align:left">Compiled by:</td>
                <td colspan = "2" style = "text-align:left">Tel:</td>
                <td colspan = "1"></td>
                <td colspan = "2" style = "text-align:left">Designation:</td>
                <td colspan = "1"></td>
                <td colspan = "2" style = "text-align:left">Sign:</td>
                <td colspan = "1"></td>
                <td colspan = "2" style = "text-align:left">Date:</td>
            </tr>
            <tr><td ><input class='user2'id="compiled_by" name="compiled_by" size="10" type="text" colspan = "3"/>
                <span style="color: #f33;font-size: 10px;">* Required Field</span></td>
                <td colspan = "2"><br/></td>
                <td><input class='user2'id="compiled_tel" name="compiled_tel" size="10" type="text" colspan = "2"/></td>
                <td colspan = "1"><br/></td>
                <td colspan = "1"><br/></td>
                <td><input class='user2'id="compiled_des" name="compiled_des" size="10" type="text" colspan = "2"/></td>
                <td colspan = "1"><br/></td>
                <td colspan = "1"><br/></td>
                <td><input class='user2'id="compiled_sign" name="compiled_sign" size="10" type="text" colspan = "2"/></td>
                <td colspan = "1"><br/></td>
                <td colspan = "1"><br/></td>
                <td colspan = "2"><input class='user2'id="compiled_date" name="compiled_date" size="10" type="text" colspan = "2"/></td>
            </tr>

            <tr></tr>

            <tr>                    <td colspan = "3" style = "text-align:left">Approved by:</td>
                <td colspan = "2" style = "text-align:left">Tel:</td>
                <td colspan = "1"><br/></td>
                <td colspan = "2" style = "text-align:left">Designation:</td>
                <td colspan = "1"></td>
                <td colspan = "2" style = "text-align:left">Sign:</td>
                <td colspan = "1"></td>
                <td colspan = "2" style ="text-align:left">Date:</td>
            </tr>
            <tr>                    <td><input class='user2'id="approved_by" name="approved_by" size="10" type="text" colspan = "2"/>
                <span style="color:#f33;font-size: 10px;">* Required Field</span></td>            
                <td colspan = "2"><br/></td>
                <td><input class='user2'id="approved_tel" name="approved_tel" size="10" type="text" colspan = "2"/></td>
                <td colspan = "1"><br/></td>
                <td colspan = "1"><br/></td>
                <td><input class='user2'id="approved_des" name="approved_des" size="10" type="text" colspan = "2"/></td>
                <td colspan = "1"><br/></td>
                <td colspan = "2"><br/></td>
                <td><input class='user2'id="approved_sign" name="approved_sign" size="10" type="text" colspan = "2"/></td>
                <td colspan = "1"><br/></td>                
                <td colspan = "2"><input class='user2'id="approved_date" name="approved_date" size="10" type="text" colspan = "2"/></td>
            </tr>

        </table>
        <div id="validate" type="text" style="margin-left: 0%; width:600px;color:blue;font-size:120%"></div>
        <div id="message" type="text" style="margin-left: 0%; width:200px;color:blue;font-size:120%"></div>
        <input class="btn btn-primary" type="submit"   id="save1"  value="Save" style="margin-left: 0%; width:100px" >
        	</form>
<style type="text/css">
	#scmlt_contents{
		margin-top: 2%;
		padding-top: 1%;
		background-color: #ffffff;

	}
	#scmlt_table_example{
		font-size: 11px;
		margin-left: 1%;
	}
	input{
        width: 70px;
    }
    .form-control{
    	height: 24px;
    }
</style>
<script type="text/javascript">
	$(document).ready(function (e){					
		$('#fcdrr_table_example input').addClass("form-control");
		$('#fcdrr_table_example').tablecloth({
	        bordered: true,
	        condensed: true,
	        striped: true,            
	        clean: true,                
	    });

		// $.ajax({
		// 	url: "<?php echo base_url() . 'Scmlt_management/get_scmlt_home'; ?>",
		// 	dataType: 'json',
		// 	success: function(s){
		// 	// console.log(s);
		// 	oTable.fnClearTable();
		// 	for(var i = 0; i < s.length; i++) {
		// 		oTable.fnAddData([
		// 		s[i][0],
		// 		s[i][1],
		// 		s[i][2],
		// 		s[i][3]
		// 		]);
		// 		} // End For
		// 	},
		// 	error: function(e){
		// 		console.log(e.responseText);
		// 	}
		// });
		
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
