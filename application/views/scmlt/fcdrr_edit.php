<?php
    $attributes = array('name' => 'myform', 'id' => 'myform');
    echo form_open('Scmlt_management/update_report', $attributes);
?>
<div id="dialog-form" title="Enter the lab commodity details here">
    <form >
        <table id="fcdrr_table_example" width="10%" class="data-table">
            <thead>
            <input  type="hidden" name="facility_name" colspan = "3" style = "color:#000; border:none" value="<?php echo $facility_name ?>"></td>
            <input  type="hidden" name="order_id" id="order_id" colspan = "3" style = "color:#000; border:none" value="<?php echo $order_id ?>"></td>
            <input  type="hidden" name="district_id" colspan = "3" style = "color:#000; border:none" value="<?php echo $district_id ?>"></td>
            <input type="hidden" name="facility_code" colspan = "2" style = "color:#000; border:none" value="<?php echo $facility_code ?>"></td>
            <input type="hidden" name="district_name" colspan = "2" style = "color:#000; border:none" value="<?php echo $district_name ?>"></td>
            <input type="hidden" name="county" colspan = "3" style = "color:#000; border:none" value="<?php echo $county_name ?>"></td>

            <tr><td style = "text-align:left"><b>Name of Facility:</b></td>
                <td colspan = "2"><?php echo $facility_name ?></td>
                <td rowspan = "8" style="background: #fff;"></td>
                <td colspan = "3"><b>Applicable to HIV Test Kits Only</b></td>
                <td colspan = "1" rowspan = "8" style="background: #fff;"></td>
                <td colspan = "6" style="text-align:center"><b>Applicable to Malaria Testing Only</b></td>
                
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
                <td><input class='user2'class='user2' id="vct" name="vct" colspan = "2" style = "color:#000" value="<?php echo $order_details['vct'];?>"/></td>
                <td colspan = "2"></td>
                <td rowspan = "3">RDT</td>
                <td style = "text-align:left">Patients&nbsp;<u>under</u> 5&nbsp;years</td>
                <td><input class='user2'id="rdt_under_tests" name="rdt_under_tests" size="10" type="text" value="<?php echo $order_details['rdt_under_tests'];?>"/></td>
                <td><input class='user2'id="rdt_under_positive" name="rdt_under_positive" size="10" type="text" value="<?php echo $order_details['rdt_under_pos'];?>"/></td>                          

            </tr>
            <tr><td colspan = "2" style = "text-align:left"><b>County:</b></td>                     
                <td><?php echo $county_name ?></td>
                <td colspan = "2"><b>PITC</b></td>
                <td><input class='user2'class='user2' id="pitc" name="pitc" colspan = "2" style = "color:#000" value="<?php echo $order_details['pitc'];?>"/></td>
                <td colspan = "2"></td>
                <td style = "text-align:left">Patients&nbsp;aged 5-14&nbsp;yrs</td>
                <td><input class='user2'id="rdt_to_tests" name="rdt_to_tests" size="10" type="text"  value="<?php echo $order_details['rdt_btwn_tests'];?>"/></td>
                <td><input class='user2'id="rdt_to_positive" name="rdt_to_positive" size="10" type="text"  value="<?php echo $order_details['rdt_btwn_pos'];?>"/></td>                        </tr>
                <tr><td colspan = "2" style = "text-align:right"><b>Beginning:</b></td> 
                    <td><input class='my_date'id="begin_date" name="begin_date" colspan = "2" size="10" type="text"/></td>
                    <td colspan = "2"><b>PMTCT</b></td>
                    <td><input class='user2'class='user2' id="pmtct" name="pmtct" colspan = "2" style = "color:#000" value="<?php echo $order_details['pmtct'];?>"/></td>
                    <td colspan = "2"></td>
                    <td style = "text-align:left">Patients&nbsp;<u>over</u> 14&nbsp;years</td>
                    <td><input class='user2'id="rdt_over_tests" name="rdt_over_tests" size="10" type="text" value="<?php echo $order_details['rdt_over_tests'];?>"/></td>    
                    <td><input class='user2'id="rdt_over_positive" name="rdt_over_positive" size="10" type="text" value="<?php echo $order_details['rdt_over_pos'];?>"/></td>

                </tr>
                <tr><td colspan = "2" style = "text-align:right"><b>Ending:</b></td>
                    <td><input class='my_date'id="end_date" name="end_date" colspan = "2" size="10" type="text"/></td>
                    <td colspan = "2"><b>Blood&nbsp;Screening</b></td>
                    <td><input class='user2'class='user2' id="blood_screening" name="blood_screening" colspan = "2" style = "color:#000" value="<?php echo $order_details['b_screening'];?>"/></td>
                    <td colspan = "2"></td>
                    <td rowspan = "3">Microscopy</td>
                    <td style = "text-align:left">Patients&nbsp;<u>under</u> 5&nbsp;years</td>
                    <td><input class='user2'id="micro_under_tests" name="micro_under_tests" size="10" type="text" value="<?php echo $order_details['micro_under_tests'];?>"/></td>
                    <td><input class='user2'id="micro_under_positive" name="micro_under_positive" size="10" type="text" value="<?php echo $order_details['micro_under_pos'];?>"/></td>                          
                </tr>
                <tr ><td colspan = "3"></td>
                    <td colspan = "2"><b>Other&nbsp;(Please&nbsp;Specify)</b></td>
                    <td><input class='user2'class='user2' id="other2" name="other2" colspan = "2" style = "color:#000" value="<?php echo $order_details['other'];?>"/></td>    
                    <td colspan = "2"></td>
                    <td style = "text-align:left">Patients&nbsp;aged 5-14&nbsp;yrs</td>
                    <td><input class='user2'id="micro_to_tests" name="micro_to_tests" size="10" type="text" value="<?php echo $order_details['micro_btwn_tests'];?>"/></td>
                    <td><input class='user2'id="micro_to_positive" name="micro_to_positive" size="10" type="text" value="<?php echo $order_details['micro_btwn_pos'];?>"/></td>
                </tr>
                <tr><td colspan = "3"></td>
                    <td colspan = "2"><b>Specify&nbsp;Here:</b></td>
                    <td><input class='user2'class='user2' id="specification" name="specification" colspan = "2" style = "color:#000" value="<?php echo $order_details['specification'];?>"/></td>  
                    <td colspan = "2"></td>
                    <td style = "text-align:left">Patients&nbsp;<u>over</u> 14&nbsp;years</td>
                    <td><input class='user2'id="micro_over_tests" name="micro_over_tests" size="10" type="text" value="<?php echo $order_details['micro_over_tests'];?>"/></td>
                    <td><input class='user2'id="micro_over_positive" name="micro_over_positive" size="10" type="text" value="<?php echo $order_details['micro_over_pos'];?>"/></td>
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
                    <?php foreach ($all_details as $detail) {?>
                        <tr commodity_id="<?php echo $checker ?>"><input type="hidden" id="commodity_id[<?php echo $checker?>]" name="commodity_id[<?php echo $checker?>]" value="<?php echo $detail['commodity_id']; ?>" >
                        <input type="hidden" id="facilityCode" name="facilityCode">
                        <input type="hidden" id="district" name="district" value="<?php echo $district_id; ?>">
                        <input type="hidden" id="unit_of_issue[<?php echo $checker?>]" name = "unit_of_issue[<?php echo $checker?>]" value="<?php echo $detail['unit_of_issue']; ?>">
                        <input type="hidden" id="detail_id[<?php echo $checker?>]" name = "detail_id[<?php echo $checker?>]" value="<?php echo $detail['id']; ?>">                        
                        <td class="commodity_names" id="commodity_name_<?php echo $checker;?>" colspan = "2" style = "text-align:left"></b><?php echo $detail['commodity_name']; ?></td>
                        <td style = "text-align:center" readonly="readonly"><?php echo $detail['unit_of_issue']; ?></td> 
                        <td><input id="b_balance_<?php echo $checker ?>" name = "b_balance[<?php echo $checker ?>]" class='bbal' size="10" type="text" value="<?php echo $detail['beginning_bal']; ?>" style = "text-align:center"/></td>
                        <td><input id="q_received_<?php echo $checker ?>" name = "q_received[<?php echo $checker ?>]" class='qty_rcvd' size="10" type="text" value="<?php echo $detail['q_received']; ?>" style = "text-align:center"/></td>
                        <td><input id="q_used_<?php echo $checker ?>" name = "q_used[<?php echo $checker ?>]" class='qty_used' size="10" type="text" value="<?php echo $detail['q_used']; ?>" style = "text-align:center"/></td>
                        <td><input id="tests_done_<?php echo $checker ?>" name = "tests_done[<?php echo $checker ?>]" class='tests_done' size="10" value="<?php echo $detail['no_of_tests_done']; ?>" type="text" style = "text-align:center"/></td>
                        <td><input id="losses_<?php echo $checker ?>" name = "losses[<?php echo $checker ?>]" class='loses' size="10" type="text" value="<?php echo $detail['positive_adj']; ?>" style = "text-align:center" /></td>
                        <td><input id="pos_adj_<?php echo $checker ?>" name = "pos_adj[<?php echo $checker ?>]" class='pos_adj' size="10" type="text" value="<?php echo $detail['positive_adj']; ?>" style = "text-align:center"/></td>  
                        <td><input id="neg_adj_<?php echo $checker ?>" name = "neg_adj[<?php echo $checker ?>]" class='neg_adj' size="10" type="text" value="<?php echo $detail['negative_adj']; ?>" style = "text-align:center"/></td>
                        <td><input id="physical_count_<?php echo $checker ?>"  name = "physical_count[<?php echo $checker ?>]" class='phys_count' value="<?php echo $detail['closing_stock']; ?>" size="10" type="text" style = "text-align:center"/></td>
                        <td><input id="q_expiring_<?php echo $checker ?>" name = "q_expiring[<?php echo $checker ?>]" class='user2' size="10" type="text" style = "text-align:center" value="<?php echo $detail['q_expiring']; ?>"/></td>
                        <td><input id="days_out_of_stock_<?php echo $checker ?>" name = "days_out_of_stock[<?php echo $checker ?>]" class='user2' size="10" type="text" style = "text-align:center" value="<?php echo $detail['days_out_of_stock']; ?>"/></td>  
                        <td><input id="q_requested_<?php echo $checker ?>" name = "q_requested[<?php echo $checker ?>]" class='user2' size="10" type="text" style = "text-align:center" value="<?php echo $detail['q_requested']; ?>"/></td>                  
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
                <td colspan = "16"><input colspan = "16" id="explanation" name="explanation" size="210" type="text" value="<?php echo $order_details['explanation']?>" style=" width: 90%;"/></td>
            </tr>
            <tr></tr>


            <tr>
                <td colspan = "3" style = "text-align:left"><b>Order for Extra LMIS tools:<br/> To be requested only when your data collection or reporting tools are nearly full. Indicate quantity required for each tool type.</b></td>
                <td><input class='user2'id="order_extra" name="order_extra" size="10" type="text"/></td>
                <td colspan = "4"><b>(1) Daily Activity Register for Laboratory Reagents and Consumables (MOH 642):</b></td>
                <td><input class='user2'id="moh_642" name="moh_642" size="10" type="text"/></td>
                <td colspan = "3"><b>(2) F-CDRR for Laboratory Commodities (MOH 643):</b></td>
                <td colspan = "2"><input class='user2' id="moh_643" name="moh_643" size="10" type="text"/></td>
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
            <tr><td ><input class='user2'id="compiled_by" name="compiled_by" size="10" type="text" colspan = "3" value="<?php echo $order_details['compiled_by']?>"/>
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

            <tr><td colspan = "3" style = "text-align:left">Approved by:</td>
                <td colspan = "2" style = "text-align:left">Tel:</td>
                <td colspan = "1"><br/></td>
                <td colspan = "2" style = "text-align:left">Designation:</td>
                <td colspan = "1"></td>
                <td colspan = "2" style = "text-align:left">Sign:</td>
                <td colspan = "1"></td>
                <td colspan = "2" style ="text-align:left">Date:</td>
            </tr>
            <tr>                    <td><input class='user2'id="approved_by" name="approved_by" size="10" type="text" colspan = "2" value="<?php echo $order_details['approved_by']?>"/>
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
        <input class="btn btn-primary" type="submit"   id="save1"  value="Update" style="margin-left: 0%; width:100px" >
</form>
<?php form_close(); ?>

<div class="modal fade" id="next_modal">
  <div class="modal-dialog">
    <div class="modal-content">      
      <div class="modal-body">
        <span id="report_status"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="go_home">
            Back to Home
        </button>
        <button type="button" class="btn btn-default" <a id="next_report_btn">
            Next Report
        </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
    .button>a{
        text-decoration: none;
        color: #FFFFFF;        
    }
    .form-control{
        height: 24px;
    }
    div#next_report {
      display: none;
      position: absolute;
      width: 280px;
      padding: 10px;
      background: #eeeeee;
      color: #000000;
      border: 1px solid #1a1a1a;
      font-size: 90%;
    }

    #report_status{
        font-size: 18px;
    }

</style>
<script type="text/javascript">
    $(document).ready(function (e){      
        $('#save1').hide();        
        $('#fcdrr_table_example input').addClass("form-control");
        $('#fcdrr_table_example').tablecloth({
            bordered: true,
            condensed: true,
            striped: true,            
            clean: true,                
        });
        
    });
    
</script>    
</div>
<script type="text/javascript">
    $(function() {

        $('#user_order input').addClass("form-control");
        $('.form-control').attr('readonly',true);
        hideCancel();

    //Set the begining Balance for the Comodities    
    var begining_bal = <?php echo json_encode($beginning_bal);?>;

    for (var a = 0; a < begining_bal.length; a++) {            
        var current_bal = begining_bal[a];
        $('#b_balance_'+a).attr("value",current_bal); 
        $('#physical_count_'+a).attr("value",current_bal); 
    }; 

    var beg_date = <?php echo json_encode($beg_date);?>;
    var end_date = <?php echo json_encode($end_date);?>;

    $('#begin_date').val(beg_date);           
    $('#end_date').val(end_date);           

    //Set the first element uneditable i.e. Screening Determine
   // $('#tests_done_0').attr("readonly",'true');

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
    
function hidePrints()
{
    $('#print_pdf').hide();
    $('#print_excel').hide();
    $('#edit_fcdrr').hide();
}
function showPrints()
{
    $('#print_pdf').show();
    $('#print_excel').show();
    $('#edit_fcdrr').show();
}

function showCancel()
{
    $('#cancel_edit').show();        
}

function hideCancel()
{
    $('#cancel_edit').hide();        
}

$('#cancel_edit').button().click(function(e)
{
   hideCancel();
   showPrints();
   $('.form-control').attr('readonly',true);

});


$('#edit_fcdrr').button().click(function(e)
{
   hidePrints();
   showCancel();
   show_save();
   $('.form-control').attr('readonly',false);

});



$('#save1').button().click(function(e) {               
    // e.preventDefault();
    var state = check_compiled_approved();
    if(state==false){
        alert('Error');
    }else{                
        var url = "<?php echo base_url() . 'Scmlt_management/update_report'; ?>";
        $('#myform').ajaxForm({
            url : url, // or whatever
            dataType : 'json',
                success : function (response) {                                        
                    if(response==1)
                    {   
                        showPrints();
                        hideCancel();
                        $('.form-control').attr('readonly',true);
                        $('#save1').hide();
                    }else{                                                
                        hidePrints();
                        showCancel();
                        $('.form-control').attr('readonly',false);
                    }
                }
            });       
       
    }   
   
});
$('#print_pdf').button().click(function(e) {               
    var order_id = $('#order_id').val();
    var url = "<?php echo base_url() . 'Scmlt_management/print_fcdrr/'; ?>";
    var final_url = url+order_id+'/pdf'; 
    alert(final_url);
   
});
$("#dialog").dialog({
    height: 140,
    modal: true
});


});


</script>
