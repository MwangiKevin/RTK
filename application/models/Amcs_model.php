<?php

/**
* 
*/
class Amcs_model extends CI_Model
{
	function get_all()
	{
		$sql = "select * from counties";
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_one_id($id)
	{
		$sql = "select * from counties where id='$id'";
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}

	function get_one_name($name)
	{
		$sql = "select * from counties where county='$name'";
		$result = $this->db->query($sql)->result_array();
		return $result[0];
	}

	function get_county_amc($county_id)
	{
		$sql = "select lab_commodities.id,lab_commodities.commodity_name,sum(facility_amc.amc) as amc 
			    from  lab_commodities,facility_amc,facilities,districts,counties 
			    where  lab_commodities.id = facility_amc.commodity_id and lab_commodities.category = '1' 
			    and facility_amc.facility_code = facilities.facility_code and facilities.district = districts.id 
			    and districts.county = counties.id and counties.id = '$county_id'
			    group by lab_commodities.id order by lab_commodities.id asc";		
		$result = $this->db->query($sql)->result_array();
		return $result;
	}

	function get_district_amc($district_id)
	{
		$sql = "select lab_commodities.id,lab_commodities.commodity_name,sum(facility_amc.amc) as amc from  lab_commodities,facility_amc,facilities,districts,counties where  lab_commodities.id = facility_amc.commodity_id and lab_commodities.category = '1' and facility_amc.facility_code = facilities.facility_code and facilities.district = districts.id and districts.id = '$district_id' group by lab_commodities.id order by lab_commodities.id asc";
		$result = $this->db->query($sql)->result_array();		
		return $result;
	}
	function get_allocation_details($zone){
		$sql = "SELECT * FROM rtk.allocation_details where zone = '$zone' limit 0,300";
		$result = $this->db->query($sql)->result_array();	

		if(count($result)!=0)
        {
            // for ($i=0; $i < count($alloc_details); $i++) { 
                // $stock_details_mine = $alloc_details[$i];
                foreach ($result as $key => $value) {                                       
                    $county = $value['county'];
                    $districts = $value['district'];
                    $mfl = $value['mfl'];
                    $facility_name = $value['facility_name'];

                    $end_bal_s3 = $value['end_bal_s3'];
                    $days_out_of_stock_s3 = '0';
                    $q_requested_s3 = '0';
                    $amc_s3 = $value['amc_s3'];
                    $mmos_s3 = $value['mmos_s3'];
                    $allocate_s3 = $value['allocate_s3'];

                    $end_bal_c3 = $value['end_bal_c3'];
                    $days_out_of_stock_c3 = '0';
                    $q_requested_c3 = '0';
                    $amc_c3 = $value['amc_c3'];
                    $mmos_c3 = $value['mmos_c3'];
                    $allocate_c3 = $value['allocate_c3'];

                    $end_bal_t3 = $value['end_bal_t3'];
                    $days_out_of_stock_t3 = '0';
                    $q_requested_t3 = '0';
                    $amc_t3 = $value['amc_t3'];
                    $mmos_t3 = $value['mmos_t3'];
                    $allocate_t3 = $value['allocate_t3']; 

                    $end_bal_s3 = ($end_bal_s3 =='' ? 0 : $end_bal_s3);                  
                    $amc_s3 = ($amc_s3 =='' ? 0 : $amc_s3);                   
                    $mmos_s3 = ($mmos_s3 =='' ? 0 : $mmos_s3);                   
                    $allocate_s3 = ($allocate_s3 =='' ? 0 : $allocate_s3);   

                    $end_bal_c3 = ($end_bal_c3 =='' ? 0 : $end_bal_c3);                  
                    $amc_c3 = ($amc_c3 =='' ? 0 : $amc_c3);                   
                    $mmos_c3 = ($mmos_c3 =='' ? 0 : $mmos_c3);                   
                    $allocate_c3 = ($allocate_c3 =='' ? 0 : $allocate_c3);   

                    $end_bal_t3 = ($end_bal_t3 =='' ? 0 : $end_bal_t3);                  
                    $amc_t3 = ($amc_t3 =='' ? 0 : $amc_t3);                   
                    $mmos_t3 = ($mmos_t3 =='' ? 0 : $mmos_t3);                   
                    $allocate_t3 = ($allocate_t3 =='' ? 0 : $allocate_t3);  

                    $alocation_details[] = array($county,$districts,$mfl,$facility_name,
                    							 $end_bal_s3,$amc_s3,$days_out_of_stock_s3,$q_requested_s3,
                    							 $end_bal_c3,$amc_c3,$days_out_of_stock_t3,$q_requested_t3,
                    							 $end_bal_t3,$amc_t3,$days_out_of_stock_t3,$q_requested_t3);
                }   
            // }           

        }else
        {   
            
            $alocation_details[0] = array(0,0,0,0,0,0,0,0,0,0);
        }       	
		return $alocation_details;
	}
	function get_national_amc(){
	
    $sql = "SELECT 
			    lab_commodities.id,
			    lab_commodities.commodity_name,
			    SUM(facility_amc.amc) AS amc
			FROM
			    lab_commodities,
			    facility_amc
			WHERE
			    lab_commodities.id = facility_amc.commodity_id
			        AND lab_commodities.category = '1'
			GROUP BY lab_commodities.id
			ORDER BY lab_commodities.id ASC";   
	
	// echo "$sql";die;
	$result = $this->db->query($sql)->result_array();	
	return $result;	


}}

?>