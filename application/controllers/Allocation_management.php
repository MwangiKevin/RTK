<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// Author Titus Tunduny
class Allocation_management extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct() {
            parent::__construct();
            $this->load->library('Excel');
        }
 

    //Update the Average Monthly Consumption
    public function allocation_trend() {        
        
        $months_texts = array();
        $percentages = array();

        for ($i=11; $i >=0; $i--) { 
            $month =  date("mY", strtotime( date( 'Y-m-01' )." -$i months"));
            $j = $i+1;            
            $month_text =  date("M Y", strtotime( date( 'Y-m-01' )." -$j months")); 
            array_push($months_texts,$month_text);
            $sql = "select sum(reported) as reported, sum(facilities) as total, month from rtk_county_percentage 
                where month ='$month'";

            $res_trend = $this->db->query($sql)->result_array();            
            foreach ($res_trend as $key => $value) {
                $reported = $value['reported'];
                $total = $value['total'];
                // echo "$reported"; echo " and $total";die;
                if ($total ==0) {
                    $percentage = 0;
                    
                }else{
                    $percentage = round(($reported/$total)*100);
                }

                if($percentage>100){
                    $percentage = 100;
                }
                array_push($percentages, $percentage);
            }
        }   
        $months_texts = str_replace('"',"'",$months_texts);        
        
        $output = array('months_texts'=>$months_texts,'percentages'=>$percentages);               
        echo json_encode($output);
        
    }

   private function update_amc($mfl) {
        $last_update = time();        
        $amc = 0;
        for ($commodity_id = 4; $commodity_id <= 6; $commodity_id++) {
            $amc = $this->_facility_amc($mfl, $commodity_id);
            echo " _ $amc<br/>";
            $q = "select * from facility_amc where facility_code='$mfl' and commodity_id='$commodity_id' ";
            $resq = $this->db->query($q)->result_array();
            $count = count($resq);
            if($count>0){
                $sql = "update facility_amc set amc = '$amc', last_update = '$last_update' where facility_code = '$mfl' and commodity_id='$commodity_id'";
                $res = $this->db->query($sql); 
            }else{

                $sql = "INSERT INTO `facility_amc`(`facility_code`, `commodity_id`, `amc`,`last_update`) VALUES ('$mfl','$commodity_id','$amc','$last_update')";
                $res = $this->db->query($sql);
            }
            
        }
    }

    //Facility Amc
     function _facility_amc($mfl_code, $commodity = null) {
        $three_months_ago = date("Y-m-", strtotime("-4 Month "));
        $three_months_ago .='1';
        $end_date = date("Y-m-", strtotime("-1 Month "));
        $end_date .='31';
        // echo "Three months ago = $three_months_ago and End Date =$end_date ";die();

        $q ="SELECT distinct avg(lab_commodity_details.q_used) as avg_used
             FROM  lab_commodity_details,lab_commodity_orders
             WHERE lab_commodity_orders.old_id =  lab_commodity_details.order_id
             AND lab_commodity_details.facility_code =  $mfl_code
             AND lab_commodity_orders.order_date BETWEEN '$three_months_ago' AND '$end_date'";
        
        if (isset($commodity)) {
            $q.=" AND lab_commodity_details.commodity_id = $commodity";
        } else {
            $q.=" AND lab_commodity_details.commodity_id = 4";
        }
        echo "$q";
        $res = $this->db->query($q);
        $result = $res->result_array();
        $result = $result[0]['avg_used'];
        $result = number_format($result, 0);
        return $result;
    }

     function facility_amc_compute($zone, $a, $b) {
             $sql = "SELECT distinct
                        facilities.facility_code
                    FROM
                        facilities,districts, counties
                    WHERE
                        facilities.rtk_enabled = '1'
                        and facilities.district = districts.id
                        and districts.county = counties.id
                    AND counties.zone = '$zone' limit $a, $b";
             $facility = $this->db->query($sql)->result_array();             

             foreach ($facility as $value) {
                 $fcode = $value['facility_code'];
                 $this->update_amc($fcode);
             }
    }
    public function allocation_details_json($zone, $a,$b ){    
    ini_set('max_execution_time',-1);
    $sql = "SELECT 
                facilities.facility_code,
                facilities.facility_name,
                districts.district,
                counties.county
            FROM
                facilities,
                districts,
                counties
            WHERE
                facilities.district = districts.id
                    AND districts.county = counties.id
                    AND facilities.rtk_enabled = 1
                    and counties.zone='$zone'
            ORDER BY counties.county asc,facilities.facility_code ASC limit $a, $b";
    // echo "$sql";die();
    $result = $this->db->query($sql)->result_array();

    $final_dets = array();

    foreach ($result as $key => $id_details) { 

        $fcode = $id_details['facility_code'];
        $county = $id_details['county'];
        $district = $id_details['district'];
        $facilityname = $id_details['facility_name'];

        $sql2 = "SELECT 
                    facility_amc.amc as amc
                FROM
                    facilities,
                    facility_amc,
                    lab_commodities
                WHERE
                    facilities.facility_code = facility_amc.facility_code
                        AND facilities.facility_code = '$fcode'
                        AND facility_amc.commodity_id = lab_commodities.id
                        AND lab_commodities.category = 1
                        AND facility_amc.commodity_id between 4 and 6            
                ORDER BY facility_amc.commodity_id ASC";
        // echo "$sql2";die();
        $result2 = $this->db->query($sql2)->result_array();
       
        $sql3 = "SELECT 
                    closing_stock
                FROM
                    lab_commodity_details AS a
                WHERE
                    facility_code = $fcode
                    AND commodity_id between 4 and 6
                        AND created_at in (SELECT 
                            MAX(created_at)
                        FROM
                            lab_commodity_details AS b
                        WHERE
                            a.facility_code = b.facility_code)";
        // echo "$sql3";die();
        $result3 = $this->db->query($sql3)->result_array();
        
        $final_dets[$fcode]['name'] = $facilityname;
        $final_dets[$fcode]['district'] = $district;
        $final_dets[$fcode]['county'] = $county;
        $final_dets[$fcode]['amcs'] = $result2;
        $final_dets[$fcode]['code'] = $fcode;
        $final_dets[$fcode]['end_bal'] = $result3;
    }
   // echo "<pre>"; print_r($final_dets); die;
    if(count($final_dets)>0){
       foreach ($final_dets as $value) {
        //$zone = str_replace(' ', '-',$value['zone']);
            $facil = $value['code'];

            $ending_bal_s =ceil(($value['end_bal'][0]['closing_stock'])/50); 
            $ending_bal_c =ceil(($value['end_bal'][1]['closing_stock'])/30); 
            $ending_bal_t =ceil(($value['end_bal'][2]['closing_stock'])/20);

            $amc_s = str_replace(',', '',$value['amcs'][0]['amc']);
            $amc_c = str_replace(',', '',$value['amcs'][1]['amc']);
            $amc_t = str_replace(',', '',$value['amcs'][2]['amc']);

            if($amc_s==''){
              $amc_s = 0;
            }

            if($amc_c==''){
              $amc_c = 0;
            }

            if($amc_t==''){
              $amc_t = 0;
            }

            $mmos_s = ceil(($amc_s * 4)/50);
            $mmos_c = ceil(($amc_c * 4)/30);
            $mmos_t = ceil(($amc_t * 4)/20);

            if($mmos_s < $ending_bal_s){
              $qty_to_alloc_s = 0;
            }else{
              $qty_to_alloc_s = $mmos_s - $ending_bal_s;
            }

            if($mmos_c < $ending_bal_c){
              $qty_to_alloc_c = 0;
            }else{
              $qty_to_alloc_c = $mmos_c - $ending_bal_c;
            }

            if($mmos_t < $ending_bal_t){
              $qty_to_alloc_t = 0;
            }else{
              $qty_to_alloc_t = $mmos_t - $ending_bal_t;
            }

            $county = $value['county'];
            $district = $value['district'];            
            $facility_name = $value['name'];   

        $sql_dets = "INSERT INTO `allocation_details`
            (`county`, `district`, `mfl`, `facility_name`,`zone`,
             `end_bal_s3`, `amc_s3`, `amc_s6`, `mmos_s3`, `mmos_s6`, `allocate_s3`, `allocate_s6`, 
             `end_bal_c3`, `amc_c3`, `amc_c6`, `mmos_c3`, `mmos_c6`, `allocate_c3`, `allocate_c6`,
             `end_bal_t3`, `amc_t3`, `amc_t6`, `mmos_t3`, `mmos_t6`, `allocate_t3`, `allocate_t6`)
             VALUES 
             ('$county','$district','$facil','$facility_name','$zone',
             '$ending_bal_s','$amc_s',0,'$mmos_s',0,'$qty_to_alloc_s',0,
             '$ending_bal_c','$amc_c',0,'$mmos_c',0,'$qty_to_alloc_c',0,
             '$ending_bal_t','$amc_t',0,'$mmos_t',0,'$qty_to_alloc_t',0)";
        // echo "$sql_dets";die();
        $this->db->query($sql_dets);
    }
}}
function get_allocation_details($zone){

        $this->load->model("Amcs_model",'amcs');  
                            
        $alocation_details= $this->amcs->get_allocation_details($zone);  

        // echo"<pre>";print_r($alloc_details);die;

        // if(count($alloc_details)!=0)
        // {
        //     // for ($i=0; $i < count($alloc_details); $i++) { 
        //         // $stock_details_mine = $alloc_details[$i];
        //         foreach ($alloc_details as $key => $value) {                                       
        //             $county = $value['county'];
        //             $districts = $value['district'];
        //             $mfl = $value['mfl'];
        //             $facility_name = $value['facility_name'];

        //             $end_bal_s3 = $value['end_bal_s3'];
        //             $amc_s3 = $value['amc_s3'];
        //             $mmos_s3 = $value['mmos_s3'];
        //             $allocate_s3 = $value['allocate_s3'];

        //             $end_bal_c3 = $value['end_bal_c3'];
        //             $amc_c3 = $value['amc_c3'];
        //             $mmos_c3 = $value['mmos_c3'];
        //             $allocate_c3 = $value['allocate_c3'];

        //             $end_bal_t3 = $value['end_bal_t3'];
        //             $amc_t3 = $value['amc_t3'];
        //             $mmos_t3 = $value['mmos_t3'];
        //             $allocate_t3 = $value['allocate_t3']; 

        //             $end_bal_s3 = ($end_bal_s3 =='' ? 0 : $end_bal_s3);                  
        //             $amc_s3 = ($amc_s3 =='' ? 0 : $amc_s3);                   
        //             $mmos_s3 = ($mmos_s3 =='' ? 0 : $mmos_s3);                   
        //             $allocate_s3 = ($allocate_s3 =='' ? 0 : $allocate_s3);   

        //             $end_bal_c3 = ($end_bal_c3 =='' ? 0 : $end_bal_c3);                  
        //             $amc_c3 = ($amc_c3 =='' ? 0 : $amc_c3);                   
        //             $mmos_c3 = ($mmos_c3 =='' ? 0 : $mmos_c3);                   
        //             $allocate_c3 = ($allocate_c3 =='' ? 0 : $allocate_c3);   

        //             $end_bal_t3 = ($end_bal_t3 =='' ? 0 : $end_bal_t3);                  
        //             $amc_t3 = ($amc_t3 =='' ? 0 : $amc_t3);                   
        //             $mmos_t3 = ($mmos_t3 =='' ? 0 : $mmos_t3);                   
        //             $allocate_t3 = ($allocate_t3 =='' ? 0 : $allocate_t3);  

        //             $alocation_details[] = array($county,$districts,$mfl,$facility_name,$end_bal_s3,$amc_s3,$end_bal_c3,$amc_c3,$end_bal_t3,$amc_t3);
        //         }   
        //     // }           

        // }else
        // {   
            
        //     $alocation_details[0] = array(0,0,0,0,0,0,0,0,0,0);
        // }       
        echo json_encode($alocation_details);
        // return $alocation_details;
    
    }
    function get_allocation_stock_card(){
        $this->load->model("Lab_details_model",'lab_details');
        $ending_balance= $this->lab_details->get_ending_balance_national();  

        $this->load->model("Amcs_model",'amcs');
        $facil_amcs= $this->amcs->get_national_amc();

        $this->load->model("Counties_model",'county');
        $counties= $this->county->get_all();  
        $option_counties = "";
        $option_counties .='<option value="0">--Select a County--</option>';
        foreach ($counties as $key => $value) {
           $option_counties .='<option value="'.$value['id'].'">'.$value['county'].'</option>';
        }  
        echo "<pre>"; print_r($facil_amcs); die;

        $count = count($facil_amcs);
        $stock_details = array();
        for ($i=0; $i < $count; $i++) { 
            $comm_id = $facil_amcs[$i]['id'];
            $comm_name = $facil_amcs[$i]['commodity_name'];
            $amc = $facil_amcs[$i]['amc'];
            $endbal = $ending_balance[$i]['end_bal'];
            $ratio = 'N/A';
            //$ratio = round(($endbal/$amc),0);
            $stock_details[$i] = array('commodity_name'=>$comm_name,'amc'=>$amc,'endbal'=>$endbal,'ratio'=>$ratio);
        }  

        // echo json_encode($option_counties);
        echo json_encode($stock_details);

    }
    function export_excel($zone){

        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Counties');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'Commodity Consumption Data (in Tests)');
        $this->excel->getActiveSheet()->setCellValue('A4', 'County');
        $this->excel->getActiveSheet()->setCellValue('B4', 'Sub-County');
        $this->excel->getActiveSheet()->setCellValue('C4', 'MFL Code');
        $this->excel->getActiveSheet()->setCellValue('D4', 'Facility Name');
        $this->excel->getActiveSheet()->setCellValue('E4', 'Screening KHB');
        $this->excel->getActiveSheet()->setCellValue('I4', 'Confirmatory - First Response');
        $this->excel->getActiveSheet()->setCellValue('M4', 'Tie Breaker');

        $this->excel->getActiveSheet()->setCellValue('A5', '');
        $this->excel->getActiveSheet()->setCellValue('B5', '');
        $this->excel->getActiveSheet()->setCellValue('C5', '');
        $this->excel->getActiveSheet()->setCellValue('D5', '');

        $this->excel->getActiveSheet()->setCellValue('E5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('F5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('G5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('H5', 'Quantity Requested');

        $this->excel->getActiveSheet()->setCellValue('I5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('J5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('K5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('L5', 'Quantity Requested');

        $this->excel->getActiveSheet()->setCellValue('M5', 'Ending Balance');
        $this->excel->getActiveSheet()->setCellValue('N5', 'AMC');
        $this->excel->getActiveSheet()->setCellValue('O5', 'Days Out of Stock');
        $this->excel->getActiveSheet()->setCellValue('P5', 'Quantity Requested');

        //merge cell A1 until C1
        $this->excel->getActiveSheet()->mergeCells('A1:K1');
        $this->excel->getActiveSheet()->mergeCells('E4:H4');
        $this->excel->getActiveSheet()->mergeCells('I4:L4');
        $this->excel->getActiveSheet()->mergeCells('M4:P4');
        //set aligment to center for that merged cell (A1 to C1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('M4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A4:Q4')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A5:Q5')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

       for($col = ord('A'); $col <= ord('Q'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(false);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                //$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
                //GET ALLOCATION DATA
                $this->load->model("Amcs_model",'amcs');  
                            
                $alocation_details= $this->amcs->get_allocation_details($zone);
                
        foreach ($alocation_details as $row){
                $exceldata[] = $row;
        }

                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A6');
                 
                // $this->excel->getActiveSheet()->getStyle('A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                // $this->excel->getActiveSheet()->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 
                $filename='PHPExcelDemo.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
                 
    }

}