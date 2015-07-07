<?php

/**
* 
*/
class Lab_details_model extends CI_Model
{
	function get_all() 
	{
		$sql = "select * from lab_commodity_categories order by id asc";
		$categories = $this->db->query($sql)->result_array();
		return $categories;
	}

	function get_all_old($order_id) 
	{
		$sql = "select * from lab_commodity_details where order_id = '$order_id' order by id asc";
		$details = $this->db->query($sql)->result_array();
		return $details;
	}
	function get_active() 
	{
		$sql = "select * from lab_commodities where category='1' order by id asc";
		$commodities = $this->db->query($sql)->result_array();		
		return $commodities;
	}

	function get_all_from_order($order_id)
	{
		$sql = "SELECT * FROM lab_commodity_details, counties, facilities, districts,
				lab_commodity_orders, lab_commodity_categories, lab_commodities
        		WHERE lab_commodity_details.facility_code = facilities.facility_code
        		AND counties.id = districts.county
        		AND facilities.facility_code = lab_commodity_orders.facility_code
        		AND lab_commodity_details.commodity_id = lab_commodities.id
        		AND lab_commodity_categories.id = lab_commodities.category
        		AND facilities.district = districts.id
        		AND lab_commodity_details.order_id = lab_commodity_orders.id
        		AND lab_commodity_orders.id = '$order_id'";
        $result = $this->db->query($sql)->result_array();
        return $result;
	}

	function get_begining_balance($mfl) 
	{
		$result_bal = array();
	    $start_date_bal = date('Y-m-d', strtotime("first day of previous month"));
	    $end_date_bal = date('Y-m-d', strtotime("last day of previous month"));
	    $sql_bal = "SELECT lab_commodity_details.closing_stock from lab_commodity_orders, lab_commodity_details 
	    where lab_commodity_orders.id = lab_commodity_details.order_id 
	    and lab_commodity_orders.order_date between '$start_date_bal' and '$end_date_bal' 
	    and lab_commodity_orders.facility_code='$mfl'";

	    $res_bal = $this->db->query($sql_bal)->result_array();

	    foreach ($res_bal as $row_bal) {
	        array_push($result_bal, $row_bal['closing_stock']);
	    }
	    return $result_bal;
	}

	function get_ending_balance_county($county_id) 
	{		
	    $firstdate = date('Y-m-d', strtotime("first day of previous month"));
	    $lastdate = date('Y-m-d', strtotime("last day of previous month"));
	    $sql = "SELECT lab_commodities.id, lab_commodities.commodity_name,SUM(lab_commodity_details.closing_stock) AS end_bal
				FROM lab_commodities,lab_commodity_details,districts, counties, facilities
				WHERE  lab_commodities.category = '1' AND lab_commodity_details.commodity_id = lab_commodities.id
        		AND lab_commodity_details.created_at BETWEEN '$firstdate' AND '$lastdate'
        		AND  lab_commodity_details.facility_code = facilities.facility_code 
        		AND facilities.rtk_enabled = '1' AND facilities.district = districts.id 
        		AND districts.county = counties.id AND counties.id = '$county_id'
				GROUP BY lab_commodities.id
				ORDER BY lab_commodities.id ASC";				
	    $result = $this->db->query($sql)->result_array();	  
	    return $result;
	}

	function get_ending_balance_district($district_id) 
	{		
	    $firstdate = date('Y-m-d', strtotime("first day of previous month"));
	    $lastdate = date('Y-m-d', strtotime("last day of previous month"));
	    $sql = "SELECT lab_commodities.id, lab_commodities.commodity_name,SUM(lab_commodity_details.closing_stock) AS end_bal
				FROM lab_commodities,lab_commodity_details,districts, counties, facilities
				WHERE  lab_commodities.category = '1' AND lab_commodity_details.commodity_id = lab_commodities.id
        		AND lab_commodity_details.created_at BETWEEN '$firstdate' AND '$lastdate'
        		AND  lab_commodity_details.facility_code = facilities.facility_code 
        		AND facilities.rtk_enabled = '1' AND facilities.district = '$district_id'
				GROUP BY lab_commodities.id
				ORDER BY lab_commodities.id ASC";		
	    $result = $this->db->query($sql)->result_array();
	    return $result;
	}

	function save_order_details($data){
		$this->db->insert('lab_commodity_details', $data); 		
	}

	function update_order_details($data,$order_id,$commodity_id){
		$this->db->where('order_id',$order_id);
		$this->db->where('commodity_id',$commodity_id);
		$this->db->update('lab_commodity_details', $data); 		
	}

	function save_order_details_old($data){
		$this->db->insert('lab_commodity_details', $data); 		
	}

	function get_county_highest_stocks($commodity_id,$county_id)
	{
    	$firstdate = date('Y-m-d', strtotime("first day of previous month"));
	    $lastdate = date('Y-m-d', strtotime("last day of previous month"));
	    $sql = "SELECT DISTINCT facilities.facility_code, facilities.facility_name, districts.district,
    			lab_commodity_details.closing_stock FROM  lab_commodity_details, facilities, districts
				WHERE   facilities.facility_code = lab_commodity_details.facility_code    
        		AND districts.id = facilities.district  and facilities.facility_code = lab_commodity_details.facility_code
        		AND lab_commodity_details.created_at BETWEEN '$firstdate' AND '$lastdate'
        		AND lab_commodity_details.commodity_id = '$commodity_id' AND districts.county = '$county_id'
				HAVING closing_stock > 0 
				ORDER BY lab_commodity_details.closing_stock DESC , facilities.facility_code ASC LIMIT 0 , 5";    		
	    $endbal = $this->db->query($sql)->result_array();	   
	    return $endbal;
	}

	function get_county_highest_expiries($commodity_id,$county_id)
	{
		$firstdate = date('Y-m-d', strtotime("first day of previous month"));
	    $lastdate = date('Y-m-d', strtotime("last day of previous month"));
		$sql = "SELECT distinct facilities.facility_code,facilities.facility_name,districts.district,lab_commodity_details.q_expiring, lab_commodity_details.closing_stock
            	FROM lab_commodity_details,facilities,districts
            	WHERE   facilities.facility_code = lab_commodity_details.facility_code    
        		AND districts.id = facilities.district  and facilities.facility_code = lab_commodity_details.facility_code
        		AND lab_commodity_details.created_at BETWEEN '$firstdate' AND '$lastdate'
        		AND lab_commodity_details.commodity_id = '$commodity_id' AND districts.county = '$county_id'
        		having q_expiring>0 order by lab_commodity_details.q_expiring desc,facilities.facility_code asc limit 0,5";    
	    $expiries = $this->db->query($sql)->result_array();
	    return $expiries;
	}
	function get_total_summary($year, $month){
		$returnable = array();

        // $firstdate = $year . '-' . $month . '-01';
        $firstdate = $year . '-04-01';
        $firstday = date("Y-m-d", strtotime("$firstdate Month "));

        // $month = date("m", strtotime("$firstdate  Month "));
        // $year = date("Y", strtotime("$firstdate  Month "));
        $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        // $lastdate = $year . '-' . $month . '-' . $num_days;    
        $lastdate = $year . '-04-' . $num_days;    
        // echo "First".$firstdate."and ".$lastdate;

        $sql = "SELECT 
                counties.county,
                counties.id,
                lab_commodities.commodity_name,
                SUM(lab_commodity_details.beginning_bal) AS sum_opening,
                SUM(lab_commodity_details.q_received) AS sum_received,
                SUM(lab_commodity_details.q_used) AS sum_used,
                SUM(lab_commodity_details.no_of_tests_done) AS sum_tests,
                SUM(lab_commodity_details.closing_stock) AS sum_closing_bal,
                SUM(lab_commodity_details.q_requested) AS sum_requested,
                SUM(lab_commodity_details.q_expiring) AS sum_expiring
            FROM
                lab_commodities,
                lab_commodity_details,
                facilities,
                districts,
                counties
            WHERE
                lab_commodity_details.commodity_id = lab_commodities.id
                    AND lab_commodity_details.facility_code = facilities.facility_code
                    AND facilities.district = districts.id
                    AND districts.county = counties.id
                    AND lab_commodity_details.created_at BETWEEN '$firstdate' AND '$lastdate'";                   
            //         and lab_commodities.id between 0 and 6
            // group by counties.id,lab_commodities.id";            
            //$returnable = $this->db->query($sql)->result_array();
        // $sql2 = $sql . " AND lab_commodities.id = 1 Group By counties.county";
        // $res = $this->db->query($sql2)->result_array();
        // array_push($returnable, $res);

        // $sql3 = $sql . " AND lab_commodities.id = 2 Group By counties.county";
        // $res2 = $this->db->query($sql3)->result_array();
        // array_push($returnable, $res2);

        $sql4 = $sql . " AND lab_commodities.id = 4 Group By counties.county";
        $res3 = $this->db->query($sql4)->result_array();
        array_push($returnable, $res3);

        $sql5 = $sql . " AND lab_commodities.id = 5 Group By counties.county";
        $res4 = $this->db->query($sql5)->result_array();
        array_push($returnable, $res4);

        $sql6 = $sql . " AND lab_commodities.id = 6 Group By counties.county";
        $res5 = $this->db->query($sql6)->result_array();
        array_push($returnable, $res5);
        
      // echo "<pre>";print_r($returnable);die;
        return $returnable;
	}

	function get_total_summary_county($year, $month,$county_id){
		$returnable = array();

        // $firstdate = $year . '-' . $month . '-01';
        $firstdate = $year . '-04-01';
        $firstday = date("Y-m-d", strtotime("$firstdate Month "));

        // $month = date("m", strtotime("$firstdate  Month "));
        // $year = date("Y", strtotime("$firstdate  Month "));
        $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        // $lastdate = $year . '-' . $month . '-' . $num_days;    
        $lastdate = $year . '-04-' . $num_days;    
        // echo "First".$firstdate."and ".$lastdate;
        $conditions = '';
        if(($county_id!=0)||($county_id!='')){
        	$conditions.= " AND counties.id = '$county_id'";
        }
        $sql = "SELECT                 
                lab_commodities.commodity_name,
                SUM(lab_commodity_details.beginning_bal) AS sum_opening,
                SUM(lab_commodity_details.q_received) AS sum_received,
                SUM(lab_commodity_details.q_used) AS sum_used,
                SUM(lab_commodity_details.positive_adj) AS positive_adj,
                SUM(lab_commodity_details.negative_adj) AS negative_adj,
                SUM(lab_commodity_details.no_of_tests_done) AS sum_tests,
                SUM(lab_commodity_details.closing_stock) AS sum_closing_bal,
                SUM(lab_commodity_details.q_requested) AS sum_requested,
                SUM(lab_commodity_details.q_expiring) AS sum_expiring
            FROM
                lab_commodities,
                lab_commodity_details,
                facilities,
                districts,
                counties
            WHERE
                lab_commodity_details.commodity_id = lab_commodities.id
                    AND lab_commodity_details.facility_code = facilities.facility_code
                    AND facilities.district = districts.id
                    AND districts.county = counties.id
                    $conditions
                    AND lab_commodity_details.created_at BETWEEN '$firstdate' AND '$lastdate'";                   
            //         and lab_commodities.id between 0 and 6
            // group by counties.id,lab_commodities.id";            
            //$returnable = $this->db->query($sql)->result_array();
        // $sql2 = $sql . " AND lab_commodities.id = 1 Group By counties.county";
        // $res = $this->db->query($sql2)->result_array();
        // array_push($returnable, $res);

        // $sql3 = $sql . " AND lab_commodities.id = 2 Group By counties.county";
        // $res2 = $this->db->query($sql3)->result_array();
        // array_push($returnable, $res2);

        $sql4 = $sql . " AND lab_commodities.id = 4";
        // echo $sql4;die();
        $res3 = $this->db->query($sql4)->result_array();
        array_push($returnable, $res3);

        $sql5 = $sql . " AND lab_commodities.id = 5";
        $res4 = $this->db->query($sql5)->result_array();
        array_push($returnable, $res4);

        $sql6 = $sql . " AND lab_commodities.id = 6";
        $res5 = $this->db->query($sql6)->result_array();
        array_push($returnable, $res5);
        
      // echo "<pre>";print_r($returnable);die;
        return $returnable;
	}

}

?>