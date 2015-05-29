<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2015-05-29 08:33:56 --> Severity: Notice --> Undefined variable: log_status /opt/lampp/htdocs/HCMP/application/controllers/User_management.php 73
ERROR - 2015-05-29 08:33:58 --> Severity: Notice --> Undefined index: year /opt/lampp/htdocs/HCMP/application/models/Lab_orders_model.php 161
ERROR - 2015-05-29 08:52:45 --> Severity: Notice --> Undefined index: year /opt/lampp/htdocs/HCMP/application/models/Lab_orders_model.php 162
ERROR - 2015-05-29 08:55:00 --> Severity: Notice --> Undefined index: year /opt/lampp/htdocs/HCMP/application/models/Lab_orders_model.php 162
ERROR - 2015-05-29 09:47:24 --> 404 Page Not Found: Clc_management/index
ERROR - 2015-05-29 09:53:40 --> 404 Page Not Found: Clc_management/index
ERROR - 2015-05-29 09:53:54 --> 404 Page Not Found: Clc_management/index
ERROR - 2015-05-29 09:54:13 --> 404 Page Not Found: Clc_management/index
ERROR - 2015-05-29 11:12:20 --> Query error: Table 'rtk.facility_amc' doesn't exist - Invalid query: select lab_commodities.id,lab_commodities.commodity_name,sum(facility_amc.amc) as amc 
			    from  lab_commodities,facility_amc,facilities,districts,counties 
			    where  lab_commodities.id = facility_amc.commodity_id and lab_commodities.category = '1' 
			    and facility_amc.facility_code = facilities.facility_code and facilities.district = districts.id 
			    and districts.county = counties.id and counties.id = '1'
			    group by lab_commodities.id order by lab_commodities.id asc
ERROR - 2015-05-29 11:13:39 --> Severity: Notice --> Undefined variable: sql_endbals /opt/lampp/htdocs/HCMP/application/models/Lab_details_model.php 72
ERROR - 2015-05-29 11:13:39 --> Severity: Warning --> mysqli::query(): Empty query /opt/lampp/htdocs/HCMP/system/database/drivers/mysqli/mysqli_driver.php 221
ERROR - 2015-05-29 11:13:39 --> Query error:  - Invalid query: 
ERROR - 2015-05-29 11:14:15 --> Severity: Notice --> Undefined variable: sql /opt/lampp/htdocs/HCMP/application/models/Lab_details_model.php 72
ERROR - 2015-05-29 11:14:15 --> Severity: Warning --> mysqli::query(): Empty query /opt/lampp/htdocs/HCMP/system/database/drivers/mysqli/mysqli_driver.php 221
ERROR - 2015-05-29 11:14:15 --> Query error:  - Invalid query: 
ERROR - 2015-05-29 11:14:24 --> Query error: Unknown column 'lab_commodity_details.district_id' in 'where clause' - Invalid query: select lab_commodities.id,lab_commodities.commodity_name, sum(lab_commodity_details.closing_stock) as end_bal
				    from   lab_commodities, lab_commodity_details,districts,counties 
				    where lab_commodities.category = '1' and lab_commodity_details.commodity_id = lab_commodities.id
				    and lab_commodity_details.created_at between '2015-04-01' and '2015-04-30' 
				    and lab_commodity_details.district_id = districts.id and districts.county = counties.id and counties.id = '1'
				    group by lab_commodities.id order by lab_commodities.id asc
ERROR - 2015-05-29 11:33:51 --> Severity: Warning --> Division by zero /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 170
ERROR - 2015-05-29 12:09:17 --> Severity: Parsing Error --> syntax error, unexpected '?>', expecting function (T_FUNCTION) /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 216
ERROR - 2015-05-29 12:09:17 --> Severity: Parsing Error --> syntax error, unexpected '?>', expecting function (T_FUNCTION) /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 216
ERROR - 2015-05-29 12:09:17 --> Severity: Parsing Error --> syntax error, unexpected '?>', expecting function (T_FUNCTION) /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 216
ERROR - 2015-05-29 12:10:02 --> Severity: Notice --> Undefined variable: first_date /opt/lampp/htdocs/HCMP/application/models/Lab_details_model.php 101
ERROR - 2015-05-29 12:10:02 --> Severity: Notice --> Undefined variable: last_date /opt/lampp/htdocs/HCMP/application/models/Lab_details_model.php 102
ERROR - 2015-05-29 12:10:02 --> Query error: Unknown column 'lab_commodity_details.district_id' in 'where clause' - Invalid query: SELECT distinct facilities.facility_code,facilities.facility_name,districts.district,lab_commodity_details.q_expiring, lab_commodity_details.closing_stock
	            FROM lab_commodity_details,facilities,districts
	            WHERE facilities.facility_code = lab_commodity_details.facility_code
	            and districts.id = lab_commodity_details.district_id
	            and lab_commodity_details.created_at BETWEEN '' AND ''
	            and lab_commodity_details.commodity_id = '4'
	            and districts.county = '1'             
	        	having closing_stock>0 order by lab_commodity_details.closing_stock desc,facilities.facility_code asc limit 0,5
ERROR - 2015-05-29 12:10:02 --> Severity: Notice --> Undefined variable: first_date /opt/lampp/htdocs/HCMP/application/models/Lab_details_model.php 101
ERROR - 2015-05-29 12:10:02 --> Severity: Notice --> Undefined variable: last_date /opt/lampp/htdocs/HCMP/application/models/Lab_details_model.php 102
ERROR - 2015-05-29 12:10:02 --> Query error: Unknown column 'lab_commodity_details.district_id' in 'where clause' - Invalid query: SELECT distinct facilities.facility_code,facilities.facility_name,districts.district,lab_commodity_details.q_expiring, lab_commodity_details.closing_stock
	            FROM lab_commodity_details,facilities,districts
	            WHERE facilities.facility_code = lab_commodity_details.facility_code
	            and districts.id = lab_commodity_details.district_id
	            and lab_commodity_details.created_at BETWEEN '' AND ''
	            and lab_commodity_details.commodity_id = '6'
	            and districts.county = '1'             
	        	having closing_stock>0 order by lab_commodity_details.closing_stock desc,facilities.facility_code asc limit 0,5
ERROR - 2015-05-29 12:10:02 --> Severity: Notice --> Undefined variable: first_date /opt/lampp/htdocs/HCMP/application/models/Lab_details_model.php 101
ERROR - 2015-05-29 12:10:02 --> Severity: Notice --> Undefined variable: last_date /opt/lampp/htdocs/HCMP/application/models/Lab_details_model.php 102
ERROR - 2015-05-29 12:10:02 --> Query error: Unknown column 'lab_commodity_details.district_id' in 'where clause' - Invalid query: SELECT distinct facilities.facility_code,facilities.facility_name,districts.district,lab_commodity_details.q_expiring, lab_commodity_details.closing_stock
	            FROM lab_commodity_details,facilities,districts
	            WHERE facilities.facility_code = lab_commodity_details.facility_code
	            and districts.id = lab_commodity_details.district_id
	            and lab_commodity_details.created_at BETWEEN '' AND ''
	            and lab_commodity_details.commodity_id = '5'
	            and districts.county = '1'             
	        	having closing_stock>0 order by lab_commodity_details.closing_stock desc,facilities.facility_code asc limit 0,5
ERROR - 2015-05-29 12:10:49 --> Severity: Notice --> Undefined variable: first_date /opt/lampp/htdocs/HCMP/application/models/Lab_details_model.php 101
ERROR - 2015-05-29 12:10:49 --> Severity: Notice --> Undefined variable: last_date /opt/lampp/htdocs/HCMP/application/models/Lab_details_model.php 102
ERROR - 2015-05-29 12:16:55 --> Severity: Notice --> Undefined variable: commodity_id /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 203
ERROR - 2015-05-29 12:16:57 --> Severity: Notice --> Undefined variable: highest_expiries_details /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 210
ERROR - 2015-05-29 12:16:57 --> Severity: Notice --> Undefined variable: commodity_id /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 203
ERROR - 2015-05-29 12:16:58 --> Severity: Notice --> Undefined variable: highest_expiries_details /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 210
ERROR - 2015-05-29 12:16:58 --> Severity: Notice --> Undefined variable: commodity_id /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 203
ERROR - 2015-05-29 12:17:00 --> Severity: Notice --> Undefined variable: highest_expiries_details /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 210
ERROR - 2015-05-29 12:24:27 --> Severity: Notice --> Undefined variable: log_status /opt/lampp/htdocs/HCMP/application/controllers/User_management.php 73
