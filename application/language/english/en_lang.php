<?php defined('BASEPATH') OR exit("No direct script access allowed");
	/* --= Global Module =-- */
	#[1] LAYOUT TOP
	$lang['mod_cpass']				= "Change Password";
	$lang['mod_signout']			= "Sign Out";
	$lang['mod_mainnav']			= "MAIN NAVIGATION";

	/* --= Global Messages =-- */
	/*** Error Messages ***/
	$lang['err_sessactive']			= "Your session still active.";
	$lang['err_invsess']			= "Session expired, Please refresh your browser.";
	$lang['err_post']				= "Invalid parameters.";
	$lang['err_404']				= "No data found.";
	$lang['err_empty']				= "Please fill in all marked *.";
	$lang['err_noacc']				= "You don't access to this feature.";
	
	/*** Successfull Messages ***/
	$lang['scs_ins']				= "Successfully insert data.";
	$lang['scs_upd']				= "Successfully update data.";
	$lang['scs_rem']				= "Successfully remove data.";
	
	/*** Information Messages ***/
	$lang['info_1']					= "Please fill in all required fields marked with an asterisk (*)";
	$lang['btn_save']				= "Save / Modified";

	/* --= Module Messages =-- */
	#[2] LOGIN MODULE
	# [MODULE]
	$lang['mod_logininfo']			= "Sign in to start your session";
	$lang['mod_loginuser']			= "Username";
	$lang['mod_loginpwd']			= "Password";
	$lang['mod_loginbtn']			= "Sign In";
	# [AJAX]
	$lang['fill_uname']				= "Fill username.";
	$lang['fill_pwd']				= "Fill password.";
	$lang['inv_user']				= "Invalid username / password.";
	$lang['scs_login']				= "Successfully login.";

	#[3] CHANGE PASSWORD MODULE
	$lang['fill_opwd']				= "Fill old password.";
	$lang['inv_opwd']				= "Invalid old password.";
	$lang['fill_npwd']				= "Fill new password.";
	$lang['len_npwd']				= "New password length must be between 6 and 50 characters.";
	$lang['notsame_cpwd']			= "Confirm password must be same as new password.";
	$lang['scs_cpass']				= "Successfully change password.";

	#[4.0] MASTER DATA - CITY
	# [MODULE]
	$lang['mod_city_title']			= "Master data - City";
	$lang['mod_city_name']			= "City";
	# [AJAX]
	$lang['fill_city_name']			= "Fill city name.";
	$lang['len_city_name']			= "Max length for city name is 50 characters.";

	#[4.1] MASTER DATA - WAREHOUSE
	# [MODULE]
	$lang['mod_ware_title']			= "Master data - Warehouse";
	$lang['mod_ware_name']			= "Warehouse";
	$lang['mod_ware_rowcols']		= "Rows x Cols";
	$lang['mod_ware_rowcode']		= "Rows Code";
	$lang['mod_ware_colcode']		= "Cols Code";
	$lang['mod_ware_choosecity']	= "- Choose City -";
	$lang['mod_ware_chooserows']	= "- Choose Rows Code -";
	$lang['mod_ware_choosecols']	= "- Choose Cols Code -";
	$lang['mod_ware_alpha']			= "Alpha";
	$lang['mod_ware_num']			= "Numeric";

	# [AJAX]
	$lang['fill_ware_name']			= "Fill warehouse name.";
	$lang['len_ware_name']			= "Max length for warehouse name is 50 characters.";
	$lang['choose_ware_city']		= "Choose city.";
	$lang['fill_ware_rows']			= "Fill rows.";
	$lang['fill_ware_cols']			= "Fill cols.";
	$lang['num_ware_rows']			= "Rows must be number.";
	$lang['num_ware_cols']			= "Cols must be number.";
	$lang['len_ware_rows']			= "Max length for rows is 3 digits.";
	$lang['len_ware_cols']			= "Max length for cols is 3 digits.";
	$lang['choose_ware_rows']		= "Rows code must be alpha or numeric.";
	$lang['choose_ware_cols']		= "Rows code must be alpha or numeric.";

	#[4.3] MASTER DATA - COLOR
	# [MODULE]
	$lang['mod_color_title']		= "Master data - Color";
	$lang['mod_color_code']			= "Code";
	$lang['mod_color_name']			= "Color Name";
	# [AJAX]
	$lang['fill_color_code']		= "Fill color code.";
	$lang['len_color_code']			= "Max length for color code is 5 characters.";
	$lang['color_code_exists']		= "Color code already exists.";
	$lang['fill_color_name']		= "Fill color name.";
	$lang['len_color_name']			= "Max length for color name is 50 characters.";

	#[4.4] MASTER DATA - CAR BRAND
	# [MODULE]
	$lang['mod_brand_name']			= "Car Brand";

	# [AJAX]
	$lang['fill_brand_name']		= "Fill car brand name.";
	$lang['len_brand_name']			= "Max length for car brand name is 50 characters.";

	#[4.5] MASTER DATA - VEHICLE
	# [MODULE]
	$lang['mod_vec_title']			= "Master Vehicle";
	$lang['mod_vec_name']			= "License Plate";
	$lang['mod_vec_yearmade']		= "Year Made";
	$lang['mod_vec_color']			= "Color";
	$lang['mod_vec_choosebrand']	= "- Choose Car Brand -";

	# [AJAX]
	$lang['fill_vec_name']			= "Fill license plate.";
	$lang['len_vec_name']			= "Max length for license plate is 30 characters.";
	$lang['choose_vec_brand']		= "Choose car brand.";
	$lang['choose_vec_year']		= "Choose year made.";
	$lang['fill_vec_color']			= "Fill car color.";
	$lang['len_vec_color']			= "Max length for color is 30 characters.";

	#[4.6] MASTER DATA - PRODUCT
	# [MODULE]
	$lang['mod_prod_title']			= "Product";
	$lang['mod_prod_name']			= "Name";
	$lang['mod_prod_info']			= "Information";
	$lang['mod_prod_loc']			= "Location";
	$lang['mod_prod_qty']			= "Qty";
	$lang['mod_prod_newtitle']		= "Product - New Entry";
	$lang['mod_prod_edittitle']		= "Product - Modified Entry";
	$lang['mod_prod_viewtitle']		= "Product - View";
	$lang['mod_det_product']		= "Detail Product";
	$lang['mod_det_addproduct']		= "Add Detail";
	$lang['mod_det_color']			= "Color";
	$lang['mod_det_measure']		= "Measurement";
	$lang['mod_det_setprice']		= "Setup Price";
	$lang['mod_det_loc']			= "Location";
	$lang['mod_det_choose_color']	= "- Choose Color -";
	$lang['mod_det_choose_dist']	= "- Choose Distributor -";
	$lang['mod_prod_wh']			= "Width x Height (M)";
	$lang['mod_prod_weight']		= "Weight (Gr)";
	$lang['mod_prod_weight_roll']	= "Weight/Roll (Kg)";
	$lang['mod_prod_buyprice']		= "Buy Price";
	$lang['mod_prod_sellprice']		= "Sell Price";
	$lang['mod_prod_addloc']		= "Add Location";
	$lang['mod_det_qty']			= "Quantity";
	$lang['mod_prod_distitle']		= "Product - Display";
	$lang['mod_prod_info_display']	= "* Best preview for this module is using Laptop/PC or Device with high Resolution";
	$lang['mod_prod_qtygood']		= "Good";
	$lang['mod_prod_qtybad']		= "Bad";

	# [AJAX]
	$lang['fill_prod_name']			= "Fill product name.";
	$lang['len_prod_name']			= "Max length for product name is 100 characters.";
	$lang['len_prod_info']			= "Max length for product information is 1000 characters.";
	$lang['fill_prod_detail']		= "Fill product detail.";
	$lang['fill_prod_location']		= "Fill product location.";

	#[5.0] CONFIGURATION - USERS
	# [MODULE]
	$lang['mod_user_title']			= "Configuration - Users";
	$lang['mod_user_uname']			= "Username";
	$lang['mod_user_pwd']			= "Password";
	$lang['mod_user_fname']			= "Fullname";
	$lang['mod_user_pos']			= "Position";
	$lang['mod_user_email']			= "Email";
	$lang['mod_user_phone1']		= "Phone 1";
	$lang['mod_user_phone2']		= "Phone 2";
	$lang['mod_user_infopwd']		= "* For creating a new user, password must be set.<br />For editing users, leave password empty to not change the password.";

	# [AJAX]
	$lang['fill_user_uname']		= "Fill username.";
	$lang['alpha_user_uname']		= "Username only accept alphabet.";
	$lang['len_user_uname']			= "Max length for username is 25 characters.";
	$lang['user_exists']			= "Username already exists.";
	$lang['fill_user_fname']		= "Fill fullname.";
	$lang['len_user_fname']			= "Max length for fullname is 100 characters.";
	$lang['fill_user_pos']			= "Fill position.";
	$lang['len_user_pos']			= "Max length for position is 50 characters.";
	$lang['fill_user_pass']			= "Fill password.";
	$lang['len_user_pass']			= "Length for password is between 6 and 50 characters.";
	$lang['len_user_email']			= "Max length for email is 150 characters.";
	$lang['fill_user_phone1']		= "Fill phone 1.";
	$lang['len_user_phone1']		= "Max length for phone 1 is 20 characters.";
	$lang['len_user_phone2']		= "Max length for phone 2 is 20 characters.";

	#[5.1] CONFIGURATIONS - NAVIGATION
	# [MODULE]
	$lang['mod_nav_title']			= "Navigation";
	$lang['mod_nav_name']			= "Title";
	$lang['mod_nav_url']			= "Url";
	$lang['mod_nav_icon']			= "Icon";
	$lang['mod_nav_parent']			= "Parent";
	$lang['mod_nav_chooseparent']	= "- Choose Parent -";
	$lang['mod_nav_maintenance']	= "Maintenance";
	$lang['mod_nav_choosemainten']	= "- Choose Maintenance -";

	# [AJAX]
	$lang['fill_nav_name']			= "Fill navigation title.";
	$lang['len_nav_name']			= "Max length for navigation title is 50 characters.";
	$lang['len_nav_url']			= "Max length for navigation url is 100 characters.";
	$lang['fill_nav_icon']			= "Fill navigation icon.";
	$lang['len_nav_icon']			= "Max length for navigation icon is 30 characters.";

	#[5.2] CONFIGURATIONS - UAC
	# [MODULE]
	$lang['mod_uac_title']			= "User Access";
	$lang['mod_uac_chooseuser']		= "- Choose User -";
	$lang['mod_uac_user']			= "User";
	$lang['mod_nav_add']			= "Add";
	$lang['mod_nav_mod']			= "Modified";
	$lang['mod_nav_del']			= "Remove";
	$lang['mod_nav_all']			= "All";

	# [AJAX]
	$lang['choose_uac_user']		= "Choose user.";
	$lang['choose_uac_nav']			= "Choose navigation.";

	#[6] CUSTOMER
	# [MODULE]
	$lang['mod_cust_title']			= "Customer";
	$lang['mod_cust_add']			= "Address";

	# [AJAX]
	$lang['fill_cust_add']			= "Fill address.";
	$lang['len_cust_add']			= "Max length for address is 500 characters.";

	#[7] DISTRIBUTOR
	# [MODULE]
	$lang['mod_dist_title']			= "Distributor";

	#[8] AGENT
	# [MODULE]
	$lang['mod_agent_title']		= "Agent";

	#[9] Receiving
	# [MODULE]
	$lang['mod_rec_title']			= "Receiving";
	$lang['mod_rec_viewtitle']		= "Receiving - View";
	$lang['mod_rec_newtitle']		= "Receiving - New Entry";
	$lang['mod_rec_edittitle']		= "Receiving - Modified Entry";
	$lang['mod_rec_invoice']		= "Invoice No.";
	$lang['mod_det_choose_agent']	= "- Choose Agent -";
	$lang['mod_det_choose_ware']	= "- Choose Warehouse -";
	$lang['mod_rec_size']			= "Size";
	$lang['mod_rec_date']			= "Receiving Date";
	$lang['mod_rec_detinfo']		= "Detail Receiving";
	$lang['mod_rec_netweight_roll'] = "Net Weight<br /> / Rolls";
	$lang['mod_rec_totalweight']	= "Total<br />Net Weight";
	$lang['mod_rec_fobprice_roll']	= "Fob Price<br />(USD/Roll)";
	$lang['mod_rec_totalamount']	= "Total<br />Amount<br />(USD)";
	$lang['mod_rec_container']	 	= "Container No.";
	$lang['mod_rec_price']			= "Price";

	# [AJAX]
	$lang['fill_invoice_no']		= "Input Invoice Number.";
	$lang['choose_rec_date']		= "Choose receiving date.";
	$lang['choose_rec_dist']		= "Choose distributor.";
	$lang['choose_rec_agent']		= "Choose Agent.";
	$lang['choose_rec_warehouse']	= "Choose warehouse.";
	$lang['fill_rec_info']			= "Input receiving informations.";
	$lang['detail_no_found']		= "Detail item not found.";
	$lang['detail_invalid']			= "Invalid detail.";
	$lang['invoice_rec_exists']		= "Invoice No. already exists.";

	#[9] Sales Order
	# [MODULE]
	$lang['mod_sales_title']		= "Sales Order";
	$lang['mod_sales_invoice']		= "Sales Order Number";
	$lang['mod_sales_date']			= "Sales Date";
	$lang['mod_sales_customer']		= "Customer";
	$lang['mod_sales_newtitle']		= "Sales Order - New Entry";
	$lang['mod_sales_edittitle']	= "Sales Order - Modified Entry";
	$lang['mod_sales_detinfo']		= "Detail Sales";
	$lang['mod_saleschoosecust']	= "- Choose Customer -";
	$lang['mod_sales_viewtitle']	= "Sales Order - View";

	# [AJAX]
	$lang['fill_sales_no']			= "Input Sales Number.";
	$lang['choose_sales_date']		= "Choose sales date.";
	$lang['choose_sales_cust']		= "Choose customer.";
	$lang['sales_no_length']		= "Max length for Sales Number is 50 characters.";
	$lang['max_length_salesinfo']	= "Max length for information sales is 1000 characters.";
	$lang['invoice_sales_exists']	= "Sales Order Number already exists.";