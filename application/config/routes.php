<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Website';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['getcity']='Adminlogin/get_city';
$route['user-register']='Main/user_register';
$route['user-login']='Main/user_login';
$route['login-form']='Main/form_login';
$route['update/(:any)']='Main/update_row';
$route['delete/(:any)']='Main/delete_row';
$route['validate']= 'A_crudexport/validate_data';
$route['userform']= 'A_crudexport';
$route['member']= 'A_crudexport/dashboard';
$route['export']= 'A_crudexport/createXLS';
$route['update/(:any)']= 'A_crudexport/update';
$route['delete/(:any)']= 'A_crudexport/delete';
$route['csv-file-export']='Admindashboard3/list_of_tkc';
$route['edit-mm-master/(:any)']='A_mm_master/edit_master';
$route['perpage/(:any)']='AA_pagination/index';
$route['deletebycheck']='admindashboard/A_deletebycheck';
$route['bycheckrowdelete/(:any)']='admindashboard/A_deletebycheck/deleterowbycheck';
$route['delete-check-ajax']='admindashboard/A_deletecheckajax';
$route['employer-delete/(:any)']='admindashboard/A_deletecheckajax/deletecheck';
$route['select-date-range']='A_showpassword/date_range';
$route['json-display']='Jsondisplay';
$route['view-data-package']='Jsondisplay/view_package_data';
$route['all-export']='fulldatatable/Data_table';
$route['subscription-type']='fulldatatable/Data_table/subscription_type_data';
$route['date-filter']='fulldatatable/Data_table/date_filter';
$route['findplan']='Dynemicddatatbl/find_plan';
$route['user-subscription-report-ajax']='Admindashboard/user_subscription_report_ajax';
$route['user-subscription-report']='Admindashboard/user_subscription_report';
$route['download-invoice/(:any)']='Downloadpdf/download_invoice';
$route['user-cashback-date-report']='Admindashboard/user_cashback_date_report';
$route['user-cashback-report']='Admindashboard/user_cashback_report';
$route['user_cashback_date_filter']='Admindashboard/user_cashback_date_filter';
$route["login"]='Session_expire_loader/login';
$route["check-login"]='Session_expire_loader/check_login';
$route["home"]='Session_expire_loader/hello';
$route['user-plan-drag']='dragrow/Admindashboard4/user_plan_drag';
$route['edit-plan-feature/(:any)']='dragrow/Admindashboard4/edit_plan_feature';
$route['edit-plan-feature-save']='dragrow/Admindashboard4/user_edit_plan_feature_save';
$route['delete-user-plan-feature']='dragrow/Admindashboard4/delete_user_plan_feature';
$route['update-drag-row']='dragrow/Admindashboard4/update_drag_row';
$route['pagination']='pagination/Paging';
$route['pagination/(:any)']='pagination/Paging/index';
$route['submit-pass-validation']='Passvalidation/submit_pass_validation';
$route['ajax-view-query']='Passvalidation/ajax_view_query';
$route['get-employee-json']='Dispjsononchng/get_employee_json';
$route['table-display-json']='Dispjsononchng/table_display_json';
$route['table-json-onchange']='Searchjsondatadropdowntable/table_json_onchange';
$route['employer-my-jobs']='employer/Employer/employer_my_jobs';
$route['employer-my-jobs1-page']='employer/Employer/employer_my_jobs1_page';

$route['employer-my-jobs1']='employer/Employer/employer_my_jobs1';
$route['ajax-display']='Ajax_table/ajax_display';
$route['search-ajax-datatable']='Ajax_datatable/search_ajax_datatable';
$route['comment']='Comment_system';
$route['validation']='validation/Validation';
$route['validation-on-keypress']='validation/Validation/key_event_form_submit';
$route['edit-package']='validation/Validation/edit_package';
$route['package-update']='validation/Validation/package_update';
$route['join']='join/Joinexp';
$route['rating']='rating/Rating';
$route['helper']='Example_helper';