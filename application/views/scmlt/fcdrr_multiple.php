<?php
    // $attributes = array('name' => 'myform', 'id' => 'myform');
    // echo form_open('Scmlt_management/submit_report', $attributes);
?>
<div id="dialog-form" title="Enter the lab commodity details here">
    <table id="fcdrr_table_example" width="10%" class="data-table">
        <input  type="hidden" name="facility_name" class="facility_name" colspan = "3" style = "color:#000; border:none"></td>
            <input type="hidden" name="facility_code" class="facility_code" id="facility_code" colspan = "2" style = "color:#000; border:none"></td>
            <input type="hidden" name="district_name" class="district_name" colspan = "2" style = "color:#000; border:none"></td>
            <input type="hidden" name="county" class="county_name" colspan = "3" style = "color:#000; border:none"></td>

            <tr>
                <td colspan = "3"><b>Facility Details</b></td>
                
                <td rowspan = "8" style="background: #fff;"></td>
                <td colspan = "3"><b>Applicable to HIV Test Kits Only</b></td>
                <td colspan = "2"></td>
                <td colspan = "4" style="text-align:center"><b>Applicable to Malaria Testing Only</b></td>
                <td colspan = "1" rowspan = "8" style="background: #fff;"></td>
            </tr>
            <tr >
                <td style = "text-align:left"><b>Name of Facility:</b></td>
                <td colspan = "2" class="facility_name"></td>            
                <td colspan = "2" style="text-align:center"><b>Type of Service</b></td>
                <td colspan = "1" style="text-align:center"><b>No. of Tests Done</b></td>
                <td colspan = "2"></td>
                <td colspan = "1"><b>Test</b></td>
                <td colspan = "1"><b>Category</b></td>
                <td colspan = "1"><b>No. of Tests Performed</b></td>
                <td colspan = "1"><b>No. Positive</b></td>                          
            </tr>
            <tr><td colspan = "2" style = "text-align:left"><b>MFL Code:</b></td>
                <td class="facility_code"></td>
                <td colspan = "2"><b>VCT</b></td>
                <td><input class='user2'class='user2' id="vct" name="vct" colspan = "2" style = "color:#000" value=0></td>
                <td colspan = "2"></td>
                <td rowspan = "3">RDT</td>
                <td style = "text-align:left">Patients&nbsp;<u>under</u> 5&nbsp;years</td>
                <td><input class='user2'id="rdt_under_tests" name="rdt_under_tests" size="10" type="text"/></td>
                <td><input class='user2'id="rdt_under_positive" name="rdt_under_positive" size="10" type="text"/></td>                          

            </tr>
            <tr><td colspan = "2" style = "text-align:left"><b>Sub-County:</b></td>
                <td class="district_name"></td>
                <td colspan = "2"><b>PITC</b></td>
                <td><input class='user2'class='user2' id="pitc" name="pitc" colspan = "2" style = "color:#000" value=0></td>
                <td colspan = "2"></td>
                <td style = "text-align:left">Patients&nbsp;aged 5-14&nbsp;yrs</td>
                <td><input class='user2'id="rdt_to_tests" name="rdt_to_tests" size="10" type="text"/></td>
                <td><input class='user2'id="rdt_to_positive" name="rdt_to_positive" size="10" type="text"/></td>                        </tr>
                <tr><td colspan = "2" style = "text-align:left"><b>County:</b></td>                     
                <td  class="county_name"></td>
                    <td colspan = "2"><b>PMTCT</b></td>
                    <td><input class='user2'class='user2' id="pmtct" name="pmtct" colspan = "2" style = "color:#000" value=0></td>
                    <td colspan = "2"></td>
                    <td style = "text-align:left">Patients&nbsp;<u>over</u> 14&nbsp;years</td>
                    <td><input class='user2'id="rdt_over_tests" name="rdt_over_tests" size="10" type="text"/></td>
                    <td><input class='user2'id="rdt_over_positive" name="rdt_over_positive" size="10" type="text"/></td>

                </tr>
                <tr><td colspan = "2" style = "text-align:right"><b>Beginning:</b></td> 
                    <td><input class='my_date'id="begin_date" name="begin_date" colspan = "2" size="10" type="text"/></td>
                    <td colspan = "2"><b>Blood&nbsp;Screening</b></td>
                    <td><input class='user2'class='user2' id="blood_screening" name="blood_screening" colspan = "2" style = "color:#000" value=0></td>
                    <td colspan = "2"></td>
                    <td rowspan = "3">Microscopy</td>
                    <td style = "text-align:left">Patients&nbsp;<u>under</u> 5&nbsp;years</td>
                    <td><input class='user2'id="micro_under_tests" name="micro_under_tests" size="10" type="text"/></td>
                    <td><input class='user2'id="micro_under_positive" name="micro_under_positive" size="10" type="text"/></td>                          
                </tr>
                <tr ><td colspan = "2" style = "text-align:right"><b>Ending:</b></td>
                    <td><input class='my_date'id="end_date" name="end_date" colspan = "2" size="10" type="text"/></td>                    
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
        </thead>
        
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
    var global_mfl = <?php echo "$mfl";?>;
	$(document).ready(function (e){		

		$('#fcdrr_table_example input').addClass("form-control");
		$('#fcdrr_table_example').tablecloth({
	        bordered: true,
	        condensed: true,
	        striped: true,            
	        clean: true,                
	    });
        
        
        
        get_all_details();        
        
        function get_all_details()
        {
            get_facility_details();
            // get_kits_details();
            get_commodity_details();   
            get_navigation();        

        }
        function get_kits_details()
        {

        }
        function get_commodity_details()
        {
            var mfl = $('#facility_code').val();
            $.post("<?php echo base_url() . 'Scmlt_management/get_fcdrr_kits'; ?>", {                
                mfl: mfl,                                                          
            }).done(function(data) {
                var details = JSON.parse(data);
                var lab_categories = details.lab_categories;
                var lab_commodities_categories = details.lab_commodities_categories;
                var district_id = details.district_id;
               
                var lab_category = null;            
                for (var i = 0; i < lab_categories.length; i++)
                {
                    lab_category = lab_categories[i].category_name;
                    var table_comm = '<tr class="removeRow"><td colspan = "14" style = "text-align:left"><b>'+lab_category+'</b></td></tr>';
                    $('#fcdrr_table_example').append(table_comm);

                    var checker = 0;
                    for (var j = 0; j < lab_commodities_categories.length; j++)
                    {
                        var commodity_name = lab_commodities_categories[checker].commodity_name;
                        var unit_of_issue = lab_commodities_categories[checker].unit_of_issue;                                            
                        var table_row = '<tr commodity_id="'+checker+'" class="removeRow"><input type="hidden" id="commodity_id_'+checker+'" name="commodity_id'+checker+'" value="'+commodity_name+'">';
                        table_row+='<input type="hidden" id="facilityCode" name="facilityCode">';
                        table_row+='<input type="hidden" id="district" name="district" value="+district_id+">';
                        table_row+='<input type="hidden" id="unit_of_issue_'+checker+'" name = "unit_of_issue'+checker+'" value="'+unit_of_issue+'">';
                        table_row+='<td class="commodity_names removeRow" id="commodity_name_'+checker+'" colspan = "2" style = "text-align:left">'+commodity_name+'</b></td>';
                        table_row+='<td class="removeRow" style = "color:#000; border:none; text; text-align:center">'+unit_of_issue+' Tests</td>';
                        table_row+='<td class="removeRow"><input id="b_balance_'+checker+'" data-uiid="'+checker+'" name = "b_balance'+checker+'" class=\'bbal\' size="10" type="text" value="0" style = "text-align:center"/></td>';
                        table_row+='<td class="removeRow"><input id="q_received_'+checker+'" name = "q_received'+checker+'" class=\'qty_rcvd\' size="10" type="text" value="0" style = "text-align:center"/></td>';
                        table_row+='<td class="removeRow"><input id="q_used_'+checker+'" name = "q_used'+checker+'" class=\'qty_used\' size="10" type="text" value="0" style = "text-align:center"/></td>';
                        table_row+='<td class="removeRow"><input id="tests_done_'+checker+'" name = "tests_done'+checker+'" class=\'tests_done\' size="10" value="0" type="text" style = "text-align:center"/></td>';
                        table_row+='<td class="removeRow"><input id="losses_'+checker+'" name = "losses'+checker+'" class=\'losses\' size="10" type="text" value="0" style = "text-align:center" /></td>';
                        table_row+='<td class="removeRow"><input id="pos_adj_'+checker+'" name = "pos_adj'+checker+'" class=\'pos_adj\' size="10" type="text" value="0" style = "text-align:center"/></td>  ';
                        table_row+='<td class="removeRow"><input id="neg_adj_'+checker+'" name = "neg_adj'+checker+'" class=\'neg_adj\' size="10" type="text" value="0" style = "text-align:center"/></td>';
                        table_row+='<td class="removeRow"><input id="physical_count_'+checker+'"  name = "physical_count'+checker+'" class=\'phys_count\' value="0" size="10" type="text" style = "text-align:center"/></td>';
                        table_row+='<td class="removeRow"><input id="q_expiring_'+checker+'" name = "q_expiring'+checker+'" class=\'user2\' size="10" type="text" style = "text-align:center"/></td>';
                        table_row+='<td class="removeRow"><input id="days_out_of_stock_'+checker+'" name = "days_out_of_stock'+checker+'" class=\'user2\' size="10" type="text" style = "text-align:center"/></td>  ';
                        table_row+='<td class="removeRow"><input id="q_requested_'+checker+'" data-uiid="'+checker+'"name = "q_requested'+checker+'" class=\'user2\' size="10" type="text" style = "text-align:center"/></td>';                    

                        $('#fcdrr_table_example').append(table_row);   
                        checker++;                 
                    }; 
                }; 

                var table_rows_other = '<tr class="removeRow"><td colspan = "14"><br/></td></tr>';
                table_rows_other += '<tr class="removeRow"><td colspan = "14" style = "text-align:left;background: #EEE;">Explain Losses and Adjustments</td></tr>';
                table_rows_other += '<tr class="removeRow"><td colspan = "16"><input colspan = "16" id="explanation" name="explanation" size="210" type="text" value="" style=" width: 90%;"/></td></tr><tr></tr>';

                table_rows_other += '<tr class="removeRow"><td colspan = "3" style = "text-align:left"><b>Order for Extra LMIS tools:<br/> To be requested only when your data collection or reporting tools are nearly full. Indicate quantity required for each tool type.</b></td>';
                table_rows_other += '<td class="removeRow"><input class=\'user2\' id="order_extra" name="order_extra" size="10" type="text"/></td>';
                table_rows_other += '<td class="removeRow" colspan = "4"><b>(1) Daily Activity Register for Laboratory Reagents and Consumables (MOH 642):</b></td>';
                table_rows_other += '<td class="removeRow"><input class=\'user2\' id="moh_642" name="moh_642" size="10" type="text"/></td>';
                table_rows_other += '<td class="removeRow" colspan = "3"><b>(2) F-CDRR for Laboratory Commodities (MOH 643):</b></td>';
                table_rows_other += '<td class="removeRow" colspan = "2"><input class=\'user2\' id="moh_643" name="moh_643" size="10" type="text"/></td></tr>';

                table_rows_other += '<tr class="removeRow"><td colspan = "3" style = "text-align:left">Compiled by:</td><td colspan = "2" style = "text-align:left">Tel:</td>';
                table_rows_other += '<td class="removeRow" colspan = "1"></td><td colspan = "2" style = "text-align:left">Designation:</td><td colspan = "1"></td>';
                table_rows_other += '<td class="removeRow" colspan = "2" style = "text-align:left">Sign:</td><td colspan = "1"></td><td colspan = "2" style = "text-align:left">Date:</td></tr>';
                
                table_rows_other += '<tr class="removeRow"><td ><input class=\'user2\'id="compiled_by" name="compiled_by" size="10" type="text" colspan = "3"/><span style="color: #f33;font-size: 10px;">* Required Field</span></td>';
                table_rows_other += '<span style="color: #f33;font-size: 10px;">* Required Field</span></td><td colspan = "2"><br/></td><td><input class=\'user2\' id="compiled_tel" name="compiled_tel" size="10" type="text" colspan = "2"/></td>';
                table_rows_other += '<td class="removeRow" colspan = "1"><br/></td><td colspan = "1"><br/></td><td><input class=\'user2\' id="compiled_des" name="compiled_des" size="10" type="text" colspan = "2"/></td>';
                table_rows_other += '<td class="removeRow"colspan = "1"><br/></td><td colspan = "1"><br/></td><td><input class=\'user2\' id="compiled_sign" name="compiled_sign" size="10" type="text" colspan = "2"/></td>';
                table_rows_other += '<td class="removeRow" colspan = "1"><br/></td><td colspan = "1"><br/></td><td colspan = "2"><input class=\'user2\' id="compiled_date" name="compiled_date" size="10" type="text" colspan = "2"/></td></tr><tr></tr>';
                   
                table_rows_other +='<tr class="removeRow"><td colspan = "3" style = "text-align:left">Approved by:</td>';
                table_rows_other +='<td class="removeRow"colspan = "2" style = "text-align:left">Tel:</td><td colspan = "1"><br/></td>';
                table_rows_other +='<td class="removeRow"colspan = "2" style = "text-align:left">Designation:</td><td colspan = "1"></td>';
                table_rows_other +='<td class="removeRow"colspan = "2" style = "text-align:left">Sign:</td>';
                table_rows_other +='<td class="removeRow"colspan = "1"></td><td colspan = "2" style ="text-align:left">Date:</td></tr>';

                table_rows_other +='<tr class="removeRow"><td><input class=\'user2\'id="approved_by" name="approved_by" size="10" type="text" colspan = "2"/><span style="color:#f33;font-size: 10px;">* Required Field</span></td>';
                table_rows_other +='<td class="removeRow"colspan = "2"><br/></td><td><input class=\'user2\'id="approved_tel" name="approved_tel" size="10" type="text" colspan = "2"/></td>';
                table_rows_other +='<td class="removeRow"colspan = "1"><br/></td><td colspan = "1"><br/></td><td><input class=\'user2\'id="approved_des" name="approved_des" size="10" type="text" colspan = "2"/></td>';
                table_rows_other +='<td class="removeRow" colspan = "2"><br/></td>';
                table_rows_other +='<td class="removeRow">class="removeRow"<input class=\'user2\'id="approved_sign" name="approved_sign" size="10" type="text" colspan = "2"/></td><td colspan = "1"><br/></td>';
                table_rows_other +='<td class="removeRow" colspan = "1"><br/></td><td colspan = "2"><input class=\'user2\'id="approved_date" name="approved_date" size="10" type="text" colspan = "2"/></td></tr>';
                table_rows_other +='</table>';

                var div_append = '<div class="removeRow" id="validate" type="text" style="margin-left: 0%; width:600px;color:blue;font-size:120%"></div>';
                div_append = '<div class="removeRow" id="message" type="text" style="margin-left: 0%; width:200px;color:blue;font-size:120%"></div>';
                div_append = '<input class="btn btn-primary removeRow" type="submit"   id="save1"  value="Save" style="margin-left: 0%; width:100px" >';

            
                $('#fcdrr_table_example').append(table_rows_other);   
                $('#dialog-form').append(div_append);   
                $('#fcdrr_table_example input').addClass("form-control");

                var beginning_bal = details.beginning_bal;

                for (var a = 0; a < beginning_bal.length; a++) {            
                    var current_bal = beginning_bal[a];
                    $('#b_balance_'+a).attr("value",current_bal); 
                    $('#physical_count_'+a).attr("value",current_bal); 
                };  

            });
        }

        function clear_table()
        {
            $('.removeRow').remove();
        }
        
        function get_facility_details()
        {

            $.post("<?php echo base_url() . 'Scmlt_management/get_fcdrr_details'; ?>", {                
                mfl: global_mfl,                                                          
            }).done(function(data) {
                var details = JSON.parse(data);
                var facility_name = details.facility_name;
                var facility_code = details.facility_code;
                var sub_county = details.district_name;
                var county = details.county_name;
                var banner_text = details.banner_text;
                $('.facility_name').html(facility_name);
                $('.facility_code').html(facility_code);
                $('.district_name').html(sub_county);
                $('.county_name').html(county);
                $('#banner_text').html(banner_text);
                global_mfl = facility_code;
            });         
        }
        function get_navigation(){
            var current_mfl = global_mfl;              
            var next_mfl = null;
            $.ajax({
            url: "<?php echo base_url() . 'Scmlt_management/get_navigation'; ?>",
            dataType: 'json',
                success: function(s){
                    var j=1;
                    var k;
                    for (var i = 0; i < s.length; i++) {
                        j+=i;    
                        k = j-1;                    
                        var cur = s[i];    
                        cur = parseInt(cur);   

                        if(current_mfl===cur){ 
                            if(j<=s.length){
                                next_mfl = s[j];                                
                                if(k>=0){
                                    prev_mfl = s[k];                                
                                }
                            }else{
                                $('#next').hide();
                            }                                                                             
                            
                        }
                    };                    

                    $('#current_mfl').val(current_mfl);
                    $('#next_mfl').val(next_mfl);
                    $('#previous_mfl').val(prev_mfl);
                    
                },
                error: function(e){
                    console.log(e.responseText);
                }
            });

        }

        $('#next').click(function(e){
            var mfl = $('#next_mfl').val();
            global_mfl = mfl; 
            clear_table();           
            get_all_details();
        });
        $('#previous').click(function(e){
            var mfl = $('#previous_mfl').val();
            global_mfl = mfl;
            clear_table();                       
            get_all_details();
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
<script type="text/javascript">
    $(function() {

        $('#user_order input').addClass("form-control");

    //Set the begining Balance for the Comodities    
    
    //Set the Datepickers
    $("#begin_date").datepicker({
        defaultDate: "",
        changeMontd: true,
        changeYear: true,
        numberOfMontds: 1,
    });
    $("#end_date").datepicker({
        defaultDate: "",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        
    });

    /*Calculating the Value of the Number of tests done for Screening Determine*/

    /*end of triggering of the calculation of Values of the Number of tests done for Screening Determine*/
    $('#vct').change(function(){           
        validate_tests('vct');        
    })    
    $('#pitc').change(function(){        
        validate_tests('pitc');       
    })
    $('#pmtct').change(function(){        
        validate_tests('pmtct');        
    })
    $('#blood_screening').change(function(){        
        validate_tests('blood_screening');        
    })
    $('#other2').change(function(){        
       validate_tests('other2');        
   }) 

    /* end of triggering of the calculation of Values for Screening Determine */   
    /* Start of Validation for Tests for Screening Determine */
    function validate_tests(top_type){
        var input_value  = $('#'+top_type).val();
        if(isNaN(input_value)){            
           $('#'+top_type).css("border-color","red");
       }else{ 
            if(input_value<0){                
                $('#'+top_type).css("border-color","red");                
            }else{      
                $('#'+top_type).css("border-color","none");
                //compute_tests_done();
            }
        }

    }

/* --- Start of calculation for the no of tests done for Screening Determine  -- */
function compute_tests_done(){  
    var vct_no = parseInt($('#vct').val());
    var pitc_no = parseInt($('#pitc').val());
    var pmtct_no = parseInt($('#pmtct').val());
    var blood_screening_no = parseInt($('#blood_screening').val());
    var other = parseInt($('#other2').val());
    tests_done_no = vct_no + pitc_no + pmtct_no + blood_screening_no + other;
    $('#tests_done_0').attr("value",tests_done_no).change();
    $('#q_used_0').attr("value",tests_done_no).change();
}       
/* End of Validation for Tests for Screening Determine */


    /* ---- Compute the Losses New----*/    
    function validate_loss(row){
        var tests_done = $('#tests_done_'+row).val();        
        var quantity_used = $('#q_used_'+row).val();
        compute_loss(row,'q_used_','tests_done_');
    }

    function compute_loss(row,q_used,tests_done){        
        var loss = $('#q_used'+row).val() - $('#tests_done'+row).val();
        $('#losses_'+row).val(loss).change();        
    }

    $('.qty_used').change(function() {
        row_id = $(this).closest("tr");
        number = row_id.attr("commodity_id");
        num = parseInt(number);
        validate_inputs_loss('q_used_',num);
        //validate_inputs('q_used_',num);
        
    })
    $('.tests_done').change(function() {
        row_id = $(this).closest("tr");
        number = row_id.attr("commodity_id");
        num = parseInt(number);
        validate_inputs_loss('tests_done_',num);
        //validate_inputs('q_used_',num);
        
    })
    $('.bbal').change(function() {
        row_id = $(this).closest("tr");
        number = row_id.attr("commodity_id");
        num = parseInt(number);
        validate_inputs('b_balance_',num);
    })
    $('.qty_rcvd').change(function() {
        row_id = $(this).closest("tr");
        number = row_id.attr("commodity_id");
        num = parseInt(number);
        validate_inputs('q_received_',num);
    })


    $('.pos_adj').change(function() {
        row_id = $(this).closest("tr");
        number = row_id.attr("commodity_id");
        num = parseInt(number);
        validate_inputs('pos_adj_',num);
        $('#explanation').css("border-color","green"); 
    })
    $('.neg_adj').change(function() {
        row_id = $(this).closest("tr");
        number = row_id.attr("commodity_id");
        num = parseInt(number);
        validate_inputs('neg_adj_',num);
        $('#explanation').css("border-color","green"); 
    })  
    $('.phys_count').change(function() {
        row_id = $(this).closest("tr");
        number = row_id.attr("commodity_id");
        num = parseInt(number);
        validate_inputs('physical_count_',num);
    })  
    $('.losses').change(function() {
        row_id = $(this).closest("tr");
        number = row_id.attr("commodity_id");
        num = parseInt(number);
        validate_inputs('losses_',num);
        $('#explanation').css("border-color","green"); 
    }) 
    
    $('.bbal').change(function() {
        row_id = $(this).closest("tr");
        number = row_id.attr("commodity_id");
        num = parseInt(number);        
        validate_inputs('b_balance_',num);
    })     

    $('#compiled_by').change(function() {        
        check_compiled();
    })       

      $('#approved_by').change(function() {        
        check_approved();
    })    
                  
    //  $('.bbal').load(function() {
    //     row_id = $(this).closest("tr");
    //     number = row_id.attr("commodity_id");
    //     num = parseInt(number);        
    //     validate_inputs('b_balance_',num);
    // })   



    /*  Check if a value is a number and not less than zero */
    function validate_inputs(input,row){        
        var input_value  = $('#'+input+row).val();
        if((isNaN(input_value))|| (input_value=='')){            
           $('#'+input+row).css("border-color","red");
           hide_save();
         }else{ 
                $('#'+input+row).css("border",'');                
                if(input_value<0){                
                    $('#'+input+row).css("border-color","red");                
                    hide_save();
                }else if(input_value>100000){
                    alert('Sorry, your values are above the expected limit. Please check them again');                
                    $('#'+input+row).css("border-color","red");                
                    hide_save();
                }else{      
                    $('#'+input+row).css("border",'');                
                    show_save();
                    compute_closing(row);
                }
            }

    }

    /*  End of Input Validations */

    /*  Check if a value is a number and not less than zero */
    function validate_inputs_loss(input,row){        
        var input_value  = $('#'+input+row).val();        
        if((isNaN(input_value))||(input_value='')){            
           $('#'+input+row).css("border-color","red");
         }else{ 
                input_value = parseInt(input_value);
                $('#'+input+row).css("border",'');                
                if(input_value<0){                
                    $('#'+input+row).css("border-color","red");
                    hide_save();                
                }else{      
                    $('#'+input+row).css("border",'');
                    var q_used = parseInt($('#q_used_'+row).val());
                    var tests_done = parseInt($('#tests_done_'+row).val());
                    if(q_used < tests_done){
                        $('#q_used_'+row).css("border-color","red"); 
                        $('#tests_done_'+row).css("border-color","red"); 
                        hide_save();
                    }else{
                        /*var loss = q_used - tests_done;
                        $('#q_used_'+row).css("border-color",""); 
                        $('#tests_done_'+row).css("border-color",""); 
                        $('#losses_'+row).val(loss).change();*/
                        show_save();
                        compute_closing(row);
                    }                        
                }
            }

    }

    /*  End of Input Validations */
    /* Compute Closing Balance */
    function compute_closing(row){
        var b_bal = parseInt($('#b_balance_' + row).val()); 
        var qty_rcvd = parseInt($('#q_received_' + row).val());
        var q_used = parseInt($('#q_used_' + row).val());
        var tests_done = parseInt($('#tests_done_' + row).val());
        var loses = parseInt($('#losses_' + row).val());
        var pos_adj = parseInt($('#pos_adj_' + row).val());
        var neg_adj = parseInt($('#neg_adj_' + row).val());
        var closing = b_bal + qty_rcvd - q_used + pos_adj - neg_adj -loses;       
        if(((q_used+neg_adj)>(b_bal+qty_rcvd+pos_adj))||(closing<0)){
            alert('You cannot use more kits than what you have in Stock. Please check your computations again');
            $('#b_balance_' + row).css('border-color','red'); 
            $('#q_received_' + row).css('border-color','red'); 
            $('#q_used_' + row).css('border-color','red'); 
            $('#tests_done_' + row).css('border-color','red'); 
            $('#losses_' + row).css('border-color','red'); 
            $('#pos_adj_' + row).css('border-color','red'); 
            $('#neg_adj_' + row).css('border-color','red'); 
            $('#physical_count_' + row).css('border-color','red'); 
            hide_save();
        }else{
            $('#b_balance_' + row).css('border-color',''); 
            $('#q_received_' + row).css('border-color',''); 
            $('#q_used_' + row).css('border-color',''); 
            $('#tests_done_' + row).css('border-color',''); 
            $('#losses_' + row).css('border-color',''); 
            $('#pos_adj_' + row).css('border-color',''); 
            $('#neg_adj_' + row).css('border-color',''); 
            $('#physical_count_' + row).css('border-color',''); 
            $('#physical_count_' + row).val(closing);
            show_save();
        }
    }  

    function hide_save() {
        $('#validate').show();
        $('#validate').html('NOTE: Please Correct all Input Fields with red border to Activate the Save Data Button');                                         
        $('#validate').css('font-size','13px'); 
        $('#validate').css('color','red'); 
        $('#save1').hide();
    }
    function show_save() {
        $('#validate').hide();       
        $('#save1').show();
    }

    function check_compiled()
    {
        var compiled_by = $('#compiled_by').val();         
        if(compiled_by==''){
            $('#compiled_by').css('border-color','red'); 
            hide_save();
        } else{
            check_compiled_approved();
        }              

    }
    function check_approved()
    {
        var approved_by = $('#approved_by').val();         
        if(approved_by==''){
            $('#approved_by').css('border-color','red'); 
            hide_save();
        }else{
            check_compiled_approved();
        }              

    }

     function check_compiled_approved()
    {
        var state = false;
        var compiled_by = $('#compiled_by').val();         
        var approved_by = $('#approved_by').val();   
        if((compiled_by!='')&&(approved_by!='')){
            $('#compiled_by').css('border-color',''); 
            $('#approved_by').css('border-color',''); 
            state = true;
            show_save();
        }  
        if(approved_by==''){
            $('#approved_by').css('border-color','red'); 
            hide_save();
        } else{
            $('#approved_by').css('border-color',''); 
        }      
        if(compiled_by==''){
            $('#compiled_by').css('border-color','red'); 
            hide_save();
        }else{
            $('#compiled_by').css('border-color',''); 
        }    

        return state;
    }
    
    


$('#save1').button().click(function(e) {               
    e.preventDefault();
    var state = check_compiled_approved();
    if(state==false){

    }else{        
        $('#message').html('The Report is Being Saved. Please Wait');                                         
        $('#message').css('font-size','13px');                                         
        $('#message').css('color','green'); 
        var myform = $('#myform').serialize();        
        $.post("<?php echo base_url() . 'Scmlt_management/submit_report_ajax'; ?>", {                
                form: myform,                                                          
            }).done(function(data) {                     
                alert(data);
            });
        // $('#myform').submit();      
    }
    
    // $('#message').html('The Report is Being Saved. Please Wait');                                         
    // $('#message').css('font-size','13px');                                         
    // $('#message').css('color','green'); 
    // $('#myform').submit();  


});
$("#dialog").dialog({
    height: 140,
    modal: true
});


});


</script>