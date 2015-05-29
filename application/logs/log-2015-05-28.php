<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2015-05-28 10:32:10 --> Severity: Notice --> Undefined variable: log_status /opt/lampp/htdocs/HCMP/application/controllers/User_management.php 73
ERROR - 2015-05-28 10:33:27 --> Severity: Error --> Call to undefined method Pdf::WriteHTML() /opt/lampp/htdocs/HCMP/application/controllers/Scmlt_management.php 661
ERROR - 2015-05-28 11:04:20 --> Severity: Notice --> Undefined variable: log_status /opt/lampp/htdocs/HCMP/application/controllers/User_management.php 73
ERROR - 2015-05-28 11:04:30 --> Severity: Error --> Call to undefined method Pdf::WriteHTML() /opt/lampp/htdocs/HCMP/application/controllers/Scmlt_management.php 661
ERROR - 2015-05-28 11:05:42 --> Unable to load the requested class: Mpdf
ERROR - 2015-05-28 11:10:30 --> Unable to load the requested class: Mpdf
ERROR - 2015-05-28 11:10:33 --> Unable to load the requested class: Mpdf
ERROR - 2015-05-28 11:15:17 --> Severity: Notice --> Undefined variable: log_status /opt/lampp/htdocs/HCMP/application/controllers/User_management.php 73
ERROR - 2015-05-28 11:45:34 --> Severity: Notice --> Undefined variable: month /opt/lampp/htdocs/HCMP/application/models/Percentages_model.php 13
ERROR - 2015-05-28 11:45:34 --> Severity: Notice --> Undefined variable: month /opt/lampp/htdocs/HCMP/application/models/Percentages_model.php 14
ERROR - 2015-05-28 11:45:34 --> Severity: error --> Exception: DateTime::__construct(): Failed to parse time string (--01) at position 0 (-): Unexpected character /opt/lampp/htdocs/HCMP/application/models/Percentages_model.php 16
ERROR - 2015-05-28 11:45:54 --> Severity: Notice --> Undefined variable: countyid /opt/lampp/htdocs/HCMP/application/models/Percentages_model.php 23
ERROR - 2015-05-28 11:57:12 --> Severity: Notice --> Undefined variable: log_status /opt/lampp/htdocs/HCMP/application/controllers/User_management.php 73
ERROR - 2015-05-28 12:17:08 --> Severity: Notice --> Undefined property: Clc_management::$orders /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 77
ERROR - 2015-05-28 12:17:09 --> Severity: Error --> Call to a member function get_late_county_reports() on a non-object /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 77
ERROR - 2015-05-28 12:20:23 --> Severity: Notice --> Undefined property: Clc_management::$orders /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 77
ERROR - 2015-05-28 12:20:23 --> Severity: Error --> Call to a member function get_all_reported_county() on a non-object /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 77
ERROR - 2015-05-28 12:22:23 --> Severity: Notice --> Undefined property: Clc_management::$orders /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 77
ERROR - 2015-05-28 12:22:23 --> Severity: Error --> Call to a member function get_all_reported_county() on a non-object /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 77
ERROR - 2015-05-28 12:22:54 --> Query error: Unknown column 'districts.id' in 'where clause' - Invalid query: select * from facilities where rtk_enabled='1' 
		and facilities.district=districts.id and districts.county = counties.id 
		and counties.id = '1'
ERROR - 2015-05-28 13:44:13 --> Severity: Notice --> Undefined variable: log_status /opt/lampp/htdocs/HCMP/application/controllers/User_management.php 73
ERROR - 2015-05-28 14:13:47 --> Severity: Notice --> Undefined variable: year /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 118
ERROR - 2015-05-28 14:13:47 --> Severity: Notice --> Undefined property: Clc_management::$county /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 122
ERROR - 2015-05-28 14:13:47 --> Severity: Error --> Call to a member function get_one_id() on a non-object /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 122
ERROR - 2015-05-28 14:14:28 --> Severity: Notice --> Undefined property: Clc_management::$county /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 122
ERROR - 2015-05-28 14:14:28 --> Severity: Error --> Call to a member function get_one_id() on a non-object /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 122
ERROR - 2015-05-28 14:14:52 --> Severity: Error --> Call to undefined method Lab_orders_model::reporting_rates() /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 131
ERROR - 2015-05-28 14:15:36 --> Severity: Notice --> Undefined variable: conditions /opt/lampp/htdocs/HCMP/application/models/Lab_orders_model.php 214
ERROR - 2015-05-28 14:15:36 --> Query error: Unknown column 'lab_commodity_orders.district_id' in 'where clause' - Invalid query: select 
	    lab_commodity_orders.order_date as order_date,
	    count(distinct lab_commodity_orders.facility_code) as count
	    from
	    lab_commodity_orders ,districts,counties
	    WHERE
	    lab_commodity_orders.order_date between '1970-01-01' and '1970-01-31' and lab_commodity_orders.district_id= districts.id and districts.county = counties.id and counties.id = 1
	    Group BY lab_commodity_orders.order_date
ERROR - 2015-05-28 14:16:53 --> Severity: Notice --> Undefined variable: conditions /opt/lampp/htdocs/HCMP/application/models/Lab_orders_model.php 214
ERROR - 2015-05-28 14:16:53 --> Query error: Unknown column 'lab_commodity_orders.district_id' in 'where clause' - Invalid query: select 
	    lab_commodity_orders.order_date as order_date,
	    count(distinct lab_commodity_orders.facility_code) as count
	    from
	    lab_commodity_orders ,districts,counties
	    WHERE
	    lab_commodity_orders.order_date between '1970-01-01' and '1970-01-31' and lab_commodity_orders.district_id= districts.id and districts.county = counties.id and counties.id = 1
	    Group BY lab_commodity_orders.order_date
ERROR - 2015-05-28 14:17:09 --> Query error: Unknown column 'lab_commodity_orders.district_id' in 'where clause' - Invalid query: select 
	    lab_commodity_orders.order_date as order_date,
	    count(distinct lab_commodity_orders.facility_code) as count
	    from
	    lab_commodity_orders ,districts,counties
	    WHERE
	    lab_commodity_orders.order_date between '1970-01-01' and '1970-01-31' and lab_commodity_orders.district_id= districts.id and districts.county = counties.id and counties.id = 1
	    Group BY lab_commodity_orders.order_date
ERROR - 2015-05-28 14:28:27 --> Severity: Parsing Error --> syntax error, unexpected '=>' (T_DOUBLE_ARROW) /opt/lampp/htdocs/HCMP/application/controllers/User_management.php 75
ERROR - 2015-05-28 14:29:01 --> Severity: Notice --> Undefined variable: log_status /opt/lampp/htdocs/HCMP/application/controllers/User_management.php 75
ERROR - 2015-05-28 14:31:24 --> 404 Page Not Found: Clc_management/get_trend_graph
ERROR - 2015-05-28 15:21:33 --> Severity: Notice --> Undefined variable: get_county_percentage /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 159
ERROR - 2015-05-28 15:21:33 --> Severity: Error --> Method name must be a string /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 159
ERROR - 2015-05-28 15:22:04 --> Severity: Notice --> Undefined variable: get_county_percentage /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 159
ERROR - 2015-05-28 15:22:04 --> Severity: Error --> Method name must be a string /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 159
ERROR - 2015-05-28 16:03:37 --> Severity: Notice --> Undefined variable: log_status /opt/lampp/htdocs/HCMP/application/controllers/User_management.php 73
ERROR - 2015-05-28 16:08:03 --> Severity: Notice --> Undefined variable: log_status /opt/lampp/htdocs/HCMP/application/controllers/User_management.php 73
ERROR - 2015-05-28 16:14:21 --> Severity: Notice --> Undefined variable: month /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 94
ERROR - 2015-05-28 16:14:21 --> Severity: Notice --> Undefined variable: month /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 95
ERROR - 2015-05-28 16:15:02 --> Severity: Notice --> Undefined variable: month /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 94
ERROR - 2015-05-28 16:15:02 --> Severity: Notice --> Undefined variable: month /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 95
ERROR - 2015-05-28 16:17:24 --> Severity: Parsing Error --> syntax error, unexpected ')' /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 92
ERROR - 2015-05-28 16:17:24 --> Severity: Parsing Error --> syntax error, unexpected ')' /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 92
ERROR - 2015-05-28 16:17:24 --> Severity: Parsing Error --> syntax error, unexpected ')' /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 92
ERROR - 2015-05-28 16:17:24 --> Severity: Parsing Error --> syntax error, unexpected ')' /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 92
ERROR - 2015-05-28 16:17:24 --> Severity: Parsing Error --> syntax error, unexpected ')' /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 92
ERROR - 2015-05-28 16:17:40 --> Severity: Parsing Error --> syntax error, unexpected ')' /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 92
ERROR - 2015-05-28 16:17:40 --> Severity: Parsing Error --> syntax error, unexpected ')' /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 92
ERROR - 2015-05-28 16:17:40 --> Severity: Parsing Error --> syntax error, unexpected ')' /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 92
ERROR - 2015-05-28 16:17:40 --> Severity: Parsing Error --> syntax error, unexpected ')' /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 92
ERROR - 2015-05-28 16:17:40 --> Severity: Parsing Error --> syntax error, unexpected ')' /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 92
ERROR - 2015-05-28 16:20:04 --> Severity: Compile Error --> Cannot use isset() on the result of an expression (you can use "null !== expression" instead) /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 92
ERROR - 2015-05-28 16:20:04 --> Severity: Compile Error --> Cannot use isset() on the result of an expression (you can use "null !== expression" instead) /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 92
ERROR - 2015-05-28 16:20:04 --> Severity: Compile Error --> Cannot use isset() on the result of an expression (you can use "null !== expression" instead) /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 92
ERROR - 2015-05-28 16:20:04 --> Severity: Compile Error --> Cannot use isset() on the result of an expression (you can use "null !== expression" instead) /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 92
ERROR - 2015-05-28 16:20:04 --> Severity: Compile Error --> Cannot use isset() on the result of an expression (you can use "null !== expression" instead) /opt/lampp/htdocs/HCMP/application/controllers/Clc_management.php 92
ERROR - 2015-05-28 16:28:41 --> Severity: Notice --> Undefined variable: previous_month_details /opt/lampp/htdocs/HCMP/application/models/Lab_orders_model.php 156
ERROR - 2015-05-28 16:28:41 --> Severity: Notice --> Undefined variable: previous_month_details /opt/lampp/htdocs/HCMP/application/models/Lab_orders_model.php 157
ERROR - 2015-05-28 16:28:41 --> Severity: Notice --> Undefined variable: previous_month_details /opt/lampp/htdocs/HCMP/application/models/Lab_orders_model.php 158
ERROR - 2015-05-28 16:28:41 --> Severity: Notice --> Undefined variable: previous_month_details /opt/lampp/htdocs/HCMP/application/models/Lab_orders_model.php 159
ERROR - 2015-05-28 16:28:41 --> Severity: Notice --> Undefined variable: previous_month_details /opt/lampp/htdocs/HCMP/application/models/Lab_orders_model.php 160
ERROR - 2015-05-28 16:28:41 --> Severity: Notice --> Undefined variable: previous_month_details /opt/lampp/htdocs/HCMP/application/models/Lab_orders_model.php 161
ERROR - 2015-05-28 16:31:13 --> Severity: Notice --> Undefined index: year /opt/lampp/htdocs/HCMP/application/models/Lab_orders_model.php 161
