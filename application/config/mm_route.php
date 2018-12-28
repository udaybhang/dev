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

$route['default_controller'] = 'web';

$route['404_override'] = '';

$route['translate_uri_dashes'] = FALSE;

$route['sign-up'] = 'signup/Signup/reg_form_save';

$route['email-ajax-check'] = 'signup/Signup/email_exsist_check';

$route['user-verification/(:any)'] = 'signup/Signup/user_email_verify';

//$route['caf-one']='caf/Caf/caf_one';

//$route['step-one']='caf/Caf/step_one_save';

//$route['caf-two']='caf/Caf/caf_two';

//

//$route['caf-three']='caf/Caf/caf_three';

$route['faq']='web/Web/faq';

//$route['caf-four']='caf/Caf/caf_four';

//$route['step-four']='caf/Caf/step_four_save';

$route['review-caf']='caf/Caf/final_before_step';

$route['review-save']='caf/Caf/final_step';

$route['thank-you']='caf/Caf/thankyou';

$route['signup-fb']='signup/Signup/sign_fb_save';

$route['signup-linkendin']='signup/Signup/sign_inkendin_save';

$route['consultant-register']='web/Web/consultant_register';

$route['privacy-policy']='web/Web/privacy_policy';

////webpages routing///////

$route['about-us']='web/Web/aboutus';

$route['contact-us']='web/Web/contactus';

////webpages routing///////

$route['admin-login'] = "admin/Admin/login";

$route['admin']='admin/Admin';

$route['admin-dashboard']='admindashboard/Admindashboard/dashboard';

$route['admin-logout']='admin/Admin/logout';

$route['user']='userlogin/Userlogin/login';

$route['user-logout']='userlogin/Userlogin/logout';

$route['user-dashboard']='userdashboard/Userdashboard/dashboard';

$route['how-it-works']='web/Web/howitwork';

$route['testimonials']='web/Web/testimonials';

$route['forget']='web/Web/forget';

//$route['update-profile']='userdashboard/Userdashboard/user_profile_update';

$route['fill-state-dd']='userdashboard/Userdashboard/fill_state_dropdown';

$route['fill-city-dd']='userdashboard/Userdashboard/fill_city_dd';

$route['education-update']='userdashboard/Userdashboard/education_update';

$route['work-exp-update']='userdashboard/Userdashboard/work_experience_update';

$route['mm-profile']='userdashboard/Userdashboard/mm_user_profile';

$route['caf-profile']='userdashboard/Userdashboard/caf_profile';

$route['step-two']='userdashboard/Userdashboard/step_two_save';

$route['step-three']='userdashboard/Userdashboard/step_three_save';

$route['step-four']='userdashboard/Userdashboard/step_four_save';

$route['step-five']='userdashboard/Userdashboard/step_five_save';

$route['blog']='web/Web/blog';

$route['blog-detail/(:any)']='web/Web/blog_detail';

$route['registered-user']='admindashboard/Admindashboard/reg_user';

$route['caf-user']='admindashboard/Admindashboard/caf_user';

$route['edit-ajax-user']='userdashboard/Userdashboard/user_data_edit';	

$route['assignment']='assignment/Assignment/asignments_level';

$route['start-assignment']='assignment/Assignment/asignment_start';



$route['xls-upload']='assignment/Assignment/xls_upload_ajax';

$route['doc-upload']='assignment/Assignment/doc_upload_ajax';

$route['ppt-upload']='assignment/Assignment/ppt_upload_ajax';



$route['count-file']='assignment/Assignment/count_uploaded_files';

$route['update-count-file']='assignment/Assignment/count_update_files';

$route['update-done-status']='assignment/Assignment/update_done_status';

$route['page-show']='assignment/Assignment/go_to_screen';



$route['assign-levels/(:any)']='assignments/Assignments/level_start';

$route['start-task/(:any)']='assignments/Assignments/task_start';

$route['timer-start']='assignments/Assignments/time_start';

$route['start-task-ajax']='assignments/Assignments/time_start_ajax';

$route['start-lvl-time-ajax']='assignments/Assignments/time_start_level_ajax';

$route['start-timer-assignments']='assignments/Assignments/start_timer';

$route['upload-assignment-files']='assignments/Assignments/upload_files_ajax_assignment';

$route['update-count-files']='assignments/Assignments/count_update_files';

$route['update-lvl-done-status']='assignments/Assignments/update_done_status';

$route['heat-chart']='userdashboard/Userdashboard/test';

//###### code by ravi #########

$route['invite']='invite/Invite';

$route['invite-send']='invite/Invite/invite_form_data';

$route['message-us']='web/Web/contact_data';



//###### code by ravi #########

$route['view-allcaf-users']='admindashboard/Admindashboard/all_caf_users';

$route['new-register-user']='admindashboard/Admindashboard/new_registration';

$route['recent-uploaded-assignment']='admindashboard/Admindashboard/recent_assign';

$route['user-score']='admindashboard/Admindashboard/user_score';

$route['signup-gmail']='signup/Signup/sign_gmail_save';

// ############  code by ravi 29042017 ###################



$route['list-of-candidate-assignment/(:any)'] ='score/Score/list_of_candidate_assignment';

$route['level-score/(:any)']='score/Score/level_score';

$route['score-data']='score/Score/score_data';

$route['update-score/(:any)']='score/Score/update_score';

$route['user-list']='score/Score/user_list';

$route['checked-user-list']='score/Score/checked_user_list';

$route['checked-candidate']='admindashboard/Admindashboard/checked_candidate';

 ///// ############## end of ravi code ###########@##########



////######shohrab######//////

$route['forget-password']='forgetpass/Userforget/user_forget';

$route['set-password']='forgetpass/Userforget/forgetchange';

$route['forget-view']='forgetpass/Userforget/forgetview';

//29-04-17

$route['create-assignment']='admindashboard/Admindashboard/create_assignment';

$route['candidate-score']='admindashboard/Admindashboard/candidate_score';

$route['candidate-level']='admindashboard/Admindashboard/candidate_level';

$route['level-score']='admindashboard/Admindashboard/level_score';

$route['create-assign']='admindashboard/Admindashboard/create_assign';

$route['assignment-lists']='admindashboard/Admindashboard/assignment_list';

$route['delete-assignment']='admindashboard/Admindashboard/delete_assign';

$route['edit-assign-form']='admindashboard/Admindashboard/edit_assign_form';

$route['assign-update']='admindashboard/Admindashboard/assign_update';

// 30-04-17

$route['create-level']='admindashboard/Admindashboard/create_level';

$route['get-assignment-level']='admindashboard/Admindashboard/get_assignment_level';

$route['update-level']='admindashboard/Admindashboard/update_level';

$route['insert-level']='admindashboard/Admindashboard/insert_level';

// 1-5-17

$route['create-task']='admindashboard/Admindashboard/create_taskpage';

$route['get-levels']='admindashboard/Admindashboard/get_levels';

$route['task-list']='admindashboard/Admindashboard/task_list';

$route['edit-task/(:any)']='admindashboard/Admindashboard/get_task_form';

$route['delete-task']='admindashboard/Admindashboard/delete_task';

$route['insert-task']='admindashboard/Admindashboard/insert_task';

$route['update-task']='admindashboard/Admindashboard/update_task';

// 02/05/17

$route['assignment-trash']='admindashboard/Admindashboard/assignment_trash';

$route['restore-assignment']='admindashboard/Admindashboard/restore_assign';

$route['task-trash']='admindashboard/Admindashboard/task_trash';

$route['restore-task']='admindashboard/Admindashboard/restore_task';

$route['country-widget']='admindashboard/Admindashboard/country_widget_page';

$route['create-widget']='admindashboard/Admindashboard/create_widget';

// 03/05/17

$route['widget']='admindashboard/Admindashboard/widget_page';

$route['delete-widget']='admindashboard/Admindashboard/delete_widget';

$route['widget-trash']='admindashboard/Admindashboard/widget_trash';

$route['restore-widget']='admindashboard/Admindashboard/restore_widget';

$route['get-widget']='admindashboard/Admindashboard/get_widget';

$route['edit-country-widget/(:any)']='admindashboard/Admindashboard/edit_widget';

$route['update-widget']='admindashboard/Admindashboard/update_widget';

// 06/05/2017

$route['get-country-name']='admindashboard/Admindashboard/get_country_name';

$route['create-assessment']='admindashboard/Admindashboard/create_assessment';

$route['insert-assesment']='admindashboard/Admindashboard/insert_assesment';

$route['assessment-mapping']='admindashboard/Admindashboard/assesment_maping';

$route['assesment-mapped']='admindashboard/Admindashboard/assesment_map';

$route['get-assesment-levels']='admindashboard/Admindashboard/get_assesment_levels';

$route['view-assessment-mapping']='admindashboard/Admindashboard/view_assesment_maping';

$route['view-assesment-levels']='admindashboard/Admindashboard/view_assesment_levels';

// 07/05/2017

$route['view-assesment-parameters']='admindashboard/Admindashboard/view_assesment_parameters';

// After Update 12/05/2017

$route['update-parameters']='admindashboard/Admindashboard/update_parameters';

// 13/05/2017

$route['timeline']='userdashboard/Userdashboard/timeline';

$route['view-task/(:any)']='admindashboard/Admindashboard/task_view';

$route['getallparamerts']='admindashboard/Admindashboard/getallparamertsforaddpara';

//20/05/2017

$route['create-mcq']='admindashboard/Admindashboard/create_mcq';

$route['insert-mcq']='admindashboard/Admindashboard/insert_mcq';

$route['mcq-list']='admindashboard/Admindashboard/list_mcq';

$route['mcq-edit/(:any)']='admindashboard/Admindashboard/edit_mcq';

$route['mcq-update']='admindashboard/Admindashboard/update_mcq';

$route['mcq-delete/(:any)']='admindashboard/Admindashboard/delete_mcq';

$route['mcq-view/(:any)']='admindashboard/Admindashboard/view_mcq';

// Topic

$route['topic-list']='admindashboard/Admindashboard/view_topic';

$route['topic-create']='admindashboard/Admindashboard/insert_topic';

$route['topic-delete/(:any)']='admindashboard/Admindashboard/delete_topic';

// Type

// $route['type-list']='admindashboard/Admindashboard/view_type';

$route['type-create']='admindashboard/Admindashboard/insert_type';

$route['type-delete/(:any)']='admindashboard/Admindashboard/delete_type';

// skills_test 

$route['skills-test-list']='admindashboard/Admindashboard/view_skills_test';

$route['skills-test-create']='admindashboard/Admindashboard/insert_skills_test';

$route['skills-test-delete/(:any)']='admindashboard/Admindashboard/delete_skills_test';
$route['skills-test-list/skills-test-delete/(:any)']='admindashboard/Admindashboard/delete_skills_test1';

// Level 2

$route['sequence-list']='admindashboard/Admindashboard/sequence_lists';

$route['create-sequence']='admindashboard/Admindashboard/sequence_create';

$route['insert-sequence-question']='admindashboard/Admindashboard/insert_sequence_questions';

$route['delete-sequence/(:any)']='admindashboard/Admindashboard/delete_sequence_questions';

$route['edit-sequence/(:any)']='admindashboard/Admindashboard/sequence_create';

$route['update-sequence']='admindashboard/Admindashboard/sequence_update';

$route['view-sequence/(:any)']='admindashboard/Admindashboard/view_sequence_questions';

$route['mcq-upload']='admindashboard/Admindashboard/getcsvfile';

// Score

$route['view-scores']='admindashboard/Admindashboard/viewallscore';

$route['level-scores']='admindashboard/Admindashboard/completed_level_scrore';

// 06062017';

$route['sqncfile-upload']='admindashboard/Admindashboard/sqncfile';

//07062017

$route['user-scores']='admindashboard/Admindashboard/completed_user_scrore';
$route['user-scores/(:any)']='admindashboard/Admindashboard/completed_user_scrore';

//08062017

$route['day-mapped']='admindashboard/Admindashboard/mapped_day';

$route['day-mapping']='admindashboard/Admindashboard/insert_day';

$route['day-map']='admindashboard/Admindashboard/day_create';

//16062017

$route['week-mapped']='admindashboard/Admindashboard/mapped_weak';

$route['week-mapping']='admindashboard/Admindashboard/insert_weak';

$route['week-map']='admindashboard/Admindashboard/weak_create';

// 21062017

$route['case-list']='admindashboard/Admindashboard/case_list';

$route['add-case']='admindashboard/Admindashboard/add_case';

$route['getcaselevel']='admindashboard/Admindashboard/getcaselevel';

$route['insert-case']='admindashboard/Admindashboard/insert_case';

$route['delete-case/(:any)']='admindashboard/Admindashboard/delete_case';

$route['edit-case/(:any)']='admindashboard/Admindashboard/add_case';

$route['update-case']='admindashboard/Admindashboard/update_case';

$route['case-detail/(:any)']='admindashboard/Admindashboard/add_case';

////######shohrab######//////



################## start code 26/05/17 himanshu singh ##########

$route['add-instruction']='admindashboard/Admindashboard/add_instruction';

$route['insert-instruction']='admindashboard/Admindashboard/insert_instruction';

$route['view-instruction']='admindashboard/Admindashboard/view_instruction';

$route['update-instruction/(:any)']='admindashboard/Admindashboard/update_instruction';

$route['update-instruction-data']='admindashboard/Admindashboard/update_instruction_data';

$route['instruction-one/(:any)']='admindashboard/Admindashboard/instruction_one';

$route['delete-instruction/(:any)']='admindashboard/Admindashboard/delete_instruction';

################## 28/05/2017 end code himanshu singh ##########



################### 08052017 code by ravi #####################

$route['preview-data/(:any)']='admindashboard/Admindashboard/preview_data';

####################  end of code ravi ########################

################### 10052017 code by ravi #####################

$route['download-file/(:any)']='score/Score/download_file';

$route['my-neurons']='userdashboard/Userdashboard/my_score';
$route['my-neurons/(:any)']='userdashboard/Userdashboard/my_score';



####################  end of code ravi ########################

##################### 23/05/2017 code by ravi ########################

$route['mcq/(:any)']='assignments/Assignments/get_mcq';

$route['sequence/(:any)']='assignments/Assignments/get_sequence';

$route['sequence1']='assignments/Assignments/assignment2_level2';

$route['time-up-sequence']='assignments/Assignments/time_up_sequence';

$route['save-user-ans']='assignments/Assignments/save_user_ans';

$route['assignmet-instruction/(:any)']='assignments/Assignments/assignmet_instruction';

########### end of ravi code #####################################

$route['mail-sent']='mailer/Mailer_controller/mail_sent';

$route['mail-function']='mailer/Mailer_controller/mail_function';



$route['level-type-list']='admindashboard/Admindashboard/view_level_type';

$route['level-type-create']='admindashboard/Admindashboard/insert_level_type';

$route['level-type-delete/(:any)']='admindashboard/Admindashboard/level_delete_type';
$route['level-type-edit/(:any)']='admindashboard/Admindashboard/level_edit_type';


########### 06062017 code by ravi ##################################

$route['scoring-time']='admindashboard/Admindashboard/scoring_time_condition';

$route['score-time-save']='admindashboard/Admindashboard/score_time_save';

$route['scoring-question']='admindashboard/Admindashboard/scoring_question_condition';

$route['scoring-time-list']='admindashboard/Admindashboard/scoring_time_list';

$route['scoring-time-edit/(:any)']='admindashboard/Admindashboard/scoring_time_edit';

$route['score-time-update']='admindashboard/Admindashboard/score_time_update';



$route['difficulty-level']='admindashboard/Admindashboard/difficulty_level';

$route['save-difficulty-level']='admindashboard/Admindashboard/save_difficulty_level';

$route['diffi-edit/(:any)']='admindashboard/Admindashboard/diffi_edit';

$route['update-difficulty-level']='admindashboard/Admindashboard/update_difficulty_level';



$route['assignment-list/(:any)']='assignments/Assignments/asignments_second';

########### end 06062017 code by ravi ##################################



$route['file-extension']='admindashboard/Admindashboard/view_filetype';

$route['extension-create']='admindashboard/Admindashboard/insert_filetype';

$route['delete-filetype/(:any)']='admindashboard/Admindashboard/delete_filetype';

// Submission start 13062017

$route['task-detail/(:any)']='assignments/assignments/task_detail';

// 14062017

$route['task-submission']='assignments/assignments/task_submission';

$route['upload-submission']='assignments/assignments/fileuploadajax';

$route['task-finish']='assignments/assignments/submission_finish';
//27072017
$route['finish-submission/(:any)']='assignments/assignments/timeupsubmission';

################# start code of himanshu singh ##########

$route['fill-blanks']='admindashboard/Admindashboard/fill_blanks';

$route['blanks']='assignments/Assignments/blanks';

$route['match-the-following']='admindashboard/Admindashboard/match_the_following';

$route['match-follow']='admindashboard/Admindashboard/match_follow';

$route['match-list']='admindashboard/Admindashboard/match_list';

$route['match-view/(:any)']='admindashboard/Admindashboard/match_view';

$route['week-map-update']='admindashboard/Admindashboard/week_map_update';

$route['match-update-view/(:any)']='admindashboard/Admindashboard/update_match_view';

$route['update-match']='admindashboard/Admindashboard/update_match';

$route['delete-match/(:any)']='admindashboard/Admindashboard/delete_match';

################## end code of himanshu singh ###########



########################start code of assignment ##########

//$route['match-assignment/(:any)']='assignments/Assignments/match_assignment';

//$route['match-answer-check']='assignments/Assignments/match_answer_check';

//$route['time-up-match']='assignments/Assignments/time_up_match';

######################## end code of himanshu singh #######



//sohrab 22062017 - case test

$route['image-update']='userdashboard/Userdashboard/image_update';

###### code by ravi 30062017 ################################



$route['get-score/(:any)']='assignments/Assignments/get_score';

/// Code by sohrab for user field editable

$route['select-state']='userdashboard/Userdashboard/selectstate';

$route['select-city']='userdashboard/Userdashboard/selectcity';

$route['update-editable']='userdashboard/Userdashboard/updateeditable';

$route['select-mastdegree']='userdashboard/Userdashboard/select_mastdegree';

$route['select-mastuniver']='userdashboard/Userdashboard/select_mastuniver';

$route['select-mastyear']='userdashboard/Userdashboard/select_yearrange';

$route['select-mastboard']='userdashboard/Userdashboard/select_mastboard';

// code by sohrab

###### code by ravi 30062017 ################################

$route['new-match-assignment/(:any)']='assignments/Assignments/new_match_assignment';

$route['new-match-answer-check']='assignments/Assignments/new_match_answer_check';



$route['generate-score-match']='assignments/Assignments/generate_score_match';

######################## end code of himanshu singh #######

$route['get-score/(:any)']='assignments/Assignments/get_score';

$route['sequence-ans-save1']='assignments/Assignments/sequence_ans_save1';

$route['generate-score-sequence']='assignments/Assignments/generate_score_sequence';
$route['time-score-of-case/(:any)']='assignments/Assignments/time_score_of_case';

$route['fill-blanks/(:any)']='assignments/Assignments/fill_blanks';
$route['insert-fill']='admindashboard/Admindashboard/insert_fill';
$route['fill-user-ans']='assignments/Assignments/fill_user_ans';
$route['generate-score-fill']='assignments/Assignments/generate_score_fill';

$route['fill-in-blank']='admindashboard/Admindashboard/fill_in_blank';
$route['create-fill-in-blank']='admindashboard/Admindashboard/create_fill_in_blank';
#####################rahul Code#######################
$route['view-fib-questions/(:any)']='admindashboard/Admindashboard/view_fib_questions';
$route['fill-update-view/(:any)']='admindashboard/Admindashboard/fill_update_view';
$route['edit-fib']='admindashboard/Admindashboard/edit_fib';

$route['ajax-score-data']='userdashboard/Userdashboard/ajax_score_data';

/// code for subjective
$route['subjective-list']='admindashboard/Admindashboard/subjective_list';
$route['create-subjective']='admindashboard/Admindashboard/subjective_create';
$route['insert-subjective']='admindashboard/Admindashboard/subjective_insert';
$route['view-subjective/(:any)']='admindashboard/Admindashboard/subjective_view';

$route['subjective-edit/(:any)']='admindashboard/Admindashboard/subjective_edit';
$route['update-subjective']='admindashboard/Admindashboard/subjective_update';

// subjective score
$route['subjective-score']='admindashboard/Admindashboard/subjective_score';
$route['subjective-user-score/(:any)']='admindashboard/Admindashboard/subjective_user_score';
$route['subjective-score-submit']='score/Score/save_subjective_score';
$route['checked-subjective-score']='admindashboard/Admindashboard/checked_subjective_score';
$route['subjective-checked-user-score/(:any)']='admindashboard/Admindashboard/subjective_user_score_checked';

$route['student-register']='web/Web/student_register';

//Invite earn point
$route['invite-accept/(:any)']='invite/Invite/referral_code';

// New Assignment Screen



$route['get-previous']='assignments/Assignments/get_previous';
$route['new-score']='assignments/Assignments/new_score';
##################    code by rahul ###################
$route['support-ticket']='userdashboard/Userdashboard/supportticket';
$route['open-ticket']='userdashboard/Userdashboard/open_ticket';
$route['viewticket/(:any)']='userdashboard/Userdashboard/viewticket';
$route['viewticket1']='userdashboard/Userdashboard/viewticket1';
$route['viewticket2']='userdashboard/Userdashboard/viewticket2';
$route['ticket-view']='admindashboard/Admindashboard/ticket_view'; 
$route['ticket']='userdashboard/Userdashboard/ticket';
$route['ticket-view']='admindashboard/Admindashboard/ticket_view';    

$route['ticketview']='admindashboard/Admindashboard/ticket_view4';
$route['view-ticket']='admindashboard/Admindashboard/viewticket3';
$route['reply/(:any)']='admindashboard/Admindashboard/reply';
$route['user-chat']='admindashboard/Admindashboard/user_chat';


$route['date-search']='admindashboard/Admindashboard/date_search';
$route['chat']='userdashboard/Userdashboard/chat';
$route['user-faq']='userdashboard/Userdashboard/faq';
$route['faq-article']='userdashboard/Userdashboard/faq_article';
$route['faq-assignment']='userdashboard/Userdashboard/faq_assignment';
$route['faq-chart']='userdashboard/Userdashboard/faq_chart';
$route['faq-education']='userdashboard/Userdashboard/faq_education';
$route['faq-family']='userdashboard/Userdashboard/faq_family';
$route['faq-invite']='userdashboard/Userdashboard/faq_invite';
$route['faq-login']='userdashboard/Userdashboard/faq_login';
$route['faq-logout']='userdashboard/Userdashboard/faq_logout';
$route['faq-personal']='userdashboard/Userdashboard/faq_personal';
$route['faq-refrences']='userdashboard/Userdashboard/faq_refrences';
$route['faq-signup']='userdashboard/Userdashboard/faq_signup';
$route['faq-timeline']='userdashboard/Userdashboard/faq_timeline';
$route['faq-work']='userdashboard/Userdashboard/faq_work';
$route['faq-references']='userdashboard/Userdashboard/faq_refrences';
$route['faq-my-score']='userdashboard/Userdashboard/faq_my_score';
$route['leaderboard']='userdashboard/Userdashboard/leaderboard';
 

// Package Code

$route['create-package']='admindashboard/Admindashboard/create_package_page';
$route['insert-package']='admindashboard/Admindashboard/insert_package';
$route['view-package']='admindashboard/Admindashboard/view_package_page';
$route['view-data-package']='admindashboard/Admindashboard/view_package_data';
$route['map-package']='admindashboard/Admindashboard/package_map';
$route['mapped-package']='admindashboard/Admindashboard/package_mapped';
$route['package-load']='admindashboard/Admindashboard/package_load';
$route['mm-wallet']='userdashboard/Userdashboard/mm_wallet';
$route['mm-neurons']='userdashboard/Userdashboard/mm_neurons';

$route['package-show']='assignments/Assignments/package_show';
$route['package-show/(:num)']='assignments/Assignments/package_show';
$route['package-assignment/(:any)']='assignments/Assignments/package_assignment';
$route['edit-package']='admindashboard/Admindashboard/edit_package_page';
$route['package-update']='admindashboard/Admindashboard/update_package';
$route['skip-tools']='assignments/Assignments/skip_tools';
$route['skip-sequence']='assignments/Assignments/skip_sequence';

$route['university']='admindashboard/Admindashboard/university';
$route['add-university']='admindashboard/Admindashboard/add_university';
$route['update-university']='admindashboard/Admindashboard/update_university';
$route['board']='admindashboard/Admindashboard/board';
$route['add-board']='admindashboard/Admindashboard/add_board';
$route['update-board']='admindashboard/Admindashboard/update_board';
$route['country']='admindashboard/Admindashboard/country';
$route['add-country']='admindashboard/Admindashboard/add_country';
$route['update-country']='admindashboard/Admindashboard/update_country';
$route['delete-country/(:any)']='admindashboard/Admindashboard/delete_country';
// Code for fib editable
$route['save-fib']='assignments/Assignments/fib_editable';
$route['fill-in-the-blanks/(:any)']='assignments/Assignments/fib_load';
$route['fib-score']='assignments/Assignments/score_fib';
$route['fib-skip']='assignments/Assignments/skip_fib';
$route['skip-file']='assignments/Assignments/skip_file';
// new routes for case
$route['case-study/(:any)']='assignments/Assignments/get_case';
$route['case-save-seq']='assignments/Assignments/save_case_seq';
$route['case-save-mcq']='assignments/Assignments/save_case_mcq';
$route['case-save-subjective']='assignments/Assignments/save_case_subjective';
$route['case-score']='assignments/Assignments/score_case';
$route['case-skip']='assignments/Assignments/skip_case';
$route['case-skip-subjective']='assignments/Assignments/remove_case_subjective';
// Userdashboard Leaderboard
$route['leader-board']='userdashboard/Userdashboard/mm_leader_boards';
$route['score-board']='userdashboard/Userdashboard/mm_score_boards';
$route['universityupload']='admindashboard/Admindashboard/csvfile';
// code by ravi 04092017 
$route['create-certification']='admindashboard/Admindashboard2/create_certification';
$route['create-job']='admindashboard/Admindashboard2/create_job';
$route['certification-lists']='admindashboard/Admindashboard2/certification_lists';
$route['job-lists']='admindashboard/Admindashboard2/job_lists';
$route['get-city']='admindashboard/Admindashboard2/get_city';

$route['get-user-neurons-details/(:any)']='admindashboard/admindashboard2/get_user_neurons_details';
$route['neurons-per-day']='admindashboard/admindashboard2/neurons_per_day';
$route['leaderboard-lists']='admindashboard/admindashboard2/leaderboard_lists';
$route['leaderboard-lists/(:any)']='admindashboard/admindashboard2/leaderboard_lists';
$route['not-attempt-lists']='admindashboard/admindashboard2/notusers_lists';
$route['ticket-close-admin/(:any)']='admindashboard/admindashboard2/closeticketadmin';
$route['ticket-close-user/(:any)']='userdashboard/Userdashboard/closeticketuser';
$route['pre-password']='web/web/pre_password';
$route['check-email-valid']='signup/Signup/check_email_valid';
$route['certification-view/(:any)']='admindashboard/Admindashboard2/certification_view';
$route['certification-edit/(:any)']='admindashboard/Admindashboard2/certification_edit';
$route['update-certification']='admindashboard/Admindashboard2/update_certification';
$route['certification-delete/(:any)']='admindashboard/Admindashboard2/delete_certificate';
$route['upload-case-study']='userdashboard/userdashboard/upload_case_study';
$route['job-view/(:any)']='admindashboard/admindashboard2/job_view';
$route['job-edit/(:any)']='admindashboard/admindashboard2/job_edit'; 
$route['update-job']='admindashboard/admindashboard2/update_job';
$route['job-delete/(:any)']='admindashboard/admindashboard2/delete_job';
$route['password-match']='userdashboard/Userdashboard/password_match';
$route['present-city']='userdashboard/Userdashboard/presentcity';
$route['updeditable']='userdashboard/Userdashboard/updeditable';
$route['all-user-score']='admindashboard/admindashboard2/viewallscoredata';
$route['notification-wallet']='userdashboard/Userdashboard/notification_wallet';
$route['notification-certification']='userdashboard/Userdashboard/notification_certification';
$route['industry-lists']='admindashboard/Admindashboard2/industry_lists';
$route['industry-create']='admindashboard/Admindashboard2/industry_create';
$route['industry-edit/(:any)']='admindashboard/Admindashboard2/industry_edit';
$route['industry-update']='admindashboard/Admindashboard2/industry_update';
$route['industry-delete/(:any)']='admindashboard/Admindashboard2/industry_delete';
$route['add-user-mailchimp']='admindashboard/Admindashboard2/add_user_mailchimp';
$route['update-user-in-mailchimp']='admindashboard/Admindashboard2/update_user_in_mailchimp';
$route['edit-skills-test/(:any)']='admindashboard/Admindashboard2/edit_skills_test';
$route['skill-update']='admindashboard/Admindashboard2/skill_update';
$route['daily-report']='admindashboard/Admindashboard2/dailyreport';
$route['day-user-report']='admindashboard/Admindashboard2/daywiseuserreport';
$route['referral-link']='userdashboard/Userdashboard/referral_link';
$route['consultant-register/(:any)']='web/Web/consultant_register';
$route['send-referral-email']='invite/Invite/send_referral_email';
$route['registered-verify']='admindashboard/Admindashboard/registered_verify';
$route['package-mapping-detail']='admindashboard/Admindashboard2/package_mapping_detail';
$route['mm-logout']='web/Web/log_out';
$route['neurons-per-day-user-details']='admindashboard/admindashboard2/neurons_per_day_user_details';
$route['neurons-details-by-ass-wise/(:any)']='admindashboard/admindashboard2/neurons_details_by_ass_wise';
$route['level-user-neurons/(:any)']='admindashboard/admindashboard2/level_user_neurons';
$route['more-info-package']='assignments/assignments/more_info_package';
$route['test_val']='admindashboard/Admindashboard2/test_val';
$route['group-create']='admindashboard/Admindashboard2/group_create';
$route['search-member']='admindashboard/Admindashboard2/search_member';
$route['insert-group']='admindashboard/Admindashboard2/insert_group';
$route['create-member']='admindashboard/Admindashboard2/create_member';
$route['member-insert']='admindashboard/Admindashboard2/member_insert';
// group code of admin 
$route['group-create']='admindashboard/Admindashboard2/group_create';
$route['search-member']='admindashboard/Admindashboard2/search_member';
$route['insert-group']='admindashboard/Admindashboard2/insert_group';
$route['create-member']='admindashboard/Admindashboard2/create_member';
$route['member-insert']='admindashboard/Admindashboard2/member_insert';
$route['view-group-report']='admindashboard/Admindashboard2/view_group_report';
$route['view-member-report/(:any)']='admindashboard/Admindashboard2/view_member_report';
$route['member_neurons/(:any)']='admindashboard/Admindashboard2/member_neurons';
$route['user-neurons/(:any)']='userdashboard/Userdashboard/user_neurons';
$route['sent-email']='userdashboard/Userdashboard/sent_email';
$route['community-show']='userdashboard/Userdashboard/community_show';
$route['community']='userdashboard/Userdashboard/community';
$route['search-user']='userdashboard/Userdashboard/search_user';
$route['user-request']='userdashboard/Userdashboard/user_request';
$route['accpet-request']='userdashboard/Userdashboard/accpet_request';
$route['community-neurons']='userdashboard/Userdashboard/community_neurons';
$route['community-profile/(:any)']='userdashboard/Userdashboard/community_profile';
$route['community-invitation']='userdashboard/Userdashboard/community_invitation';
$route['leave-group']='userdashboard/Userdashboard/leave_group';
#############grid fill ##############
$route['grid-fib']='admindashboard/Admindashboard2/grid_fib';
$route['grid-fib-list']='admindashboard/Admindashboard2/grid_fib_list';
$route['delete-grid/(:any)']='admindashboard/Admindashboard2/delete_grid_questions';
$route['view-grid/(:any)']='admindashboard/Admindashboard2/view_grid';
$route['edit-grid-fib/(:any)']='admindashboard/Admindashboard2/grid_fib';
$route['update-grid-fib']='admindashboard/Admindashboard2/update_grid_fib';
$route['create-grid-fill-in-blank']='admindashboard/Admindashboard2/create_grid_fill_in_blank';
#############grid fill ##############
$route['grid-fib/(:any)']='assignments/assignments/gird_fib';
$route['save-grid-fib']='assignments/assignments/save_grid_fib';
$route['group-leader']='userdashboard/Userdashboard/group_leader';
$route['activity']='userdashboard/Userdashboard/activity';
##############
$route['create-bucket']='admindashboard/Admindashboard2/create_bucket';
$route['insert-bucket']='admindashboard/Admindashboard2/insert_bucket';
##########bucket admin ##############

// bucket
$route['bucket/(:any)']='assignments/assignments/bucket';
$route['bucket-ans-save']='assignments/assignments/bucket_ans_save';
$route['generate-score-bucket']='assignments/assignments/generate_score_bucket';
$route['skip-bucket']='assignments/assignments/skip_bucket';
$route['insert-rating']='userdashboard/Userdashboard/insert_rating';
// word detective
$route['word-detective/(:any)']='assignments/assignments/word_detective';
$route['get-hint']='assignments/assignments/get_hint';
$route['word-detective-ans-save']='assignments/assignments/word_detective_ans_save';
$route['generate-word-detective-score']='assignments/assignments/generate_word_detective_score';
$route['create-word-detective']='admindashboard/Admindashboard2/create_word_detective';
$route['insert-word-detective']='admindashboard/Admindashboard2/insert_word_detective';
$route['skip-word-detective']='assignments/assignments/skip_word_detective';
$route['bucket-list']='admindashboard/Admindashboard2/bucket_list';
$route['bucket-delete/(:any)']='admindashboard/Admindashboard2/delete_bucket';
$route['bucket-view/(:any)']='admindashboard/Admindashboard2/view_bucket';
$route['bucket-edit/(:any)']='admindashboard/Admindashboard2/edit_bucket';
$route['update-bucket']='admindashboard/Admindashboard2/update_bucket';

##############shifiq new caf ui ########################
$route['personal-details']='userdashboard/Userdashboard/personal_details';
$route['educational-profile']='userdashboard/Userdashboard/educational_profile';
$route['work-experience-test']='userdashboard/Userdashboard/work_experience_test';
$route['references']='userdashboard/Userdashboard/references';
$route['family-background']='userdashboard/Userdashboard/family_background';
$route['user-full-profile']='userdashboard/Userdashboard/user_full_profile';
$route['work-experience-update']='userdashboard/Userdashboard/work_experience_update_save';
$route['work-experience-update-test']='userdashboard/Userdashboard/work_experience_update_save_test';
$route['update-profile']='userdashboard/Userdashboard/user_profile_update';
$route['education-profile-update']='userdashboard/Userdashboard/education_profile_update';
$route['references-update']='userdashboard/Userdashboard/references_update';
$route['family-background-update']='userdashboard/Userdashboard/family_background_update';
##############shifiq new caf ui ########################
$route['package-rank/(:any)']='userdashboard/Userdashboard/package_rank';
$route['skills-report']='userdashboard/Userdashboard/skills_report';

############cross word admin ############
$route['crossword-insert']='admindashboard/Admindashboard2/crossword_insert';
$route['crossword-show']='assignments/Assignments/crossword_show';
$route['crossword-answer']='assignments/Assignments/crossword_answer';
$route['crossword-tool/(:any)']='assignments/Assignments/crossword_tool';
$route['crossword-user-insert']='assignments/Assignments/crossword_insert_user';
$route['generate-score-crossword']='assignments/Assignments/generate_score_crossword';
$route['skip-cross']='assignments/Assignments/skip_cross';
##########bucket admin ##############
########## cross word root started here for admin ############
$route['crossword-create']='admindashboard/Admindashboard2/crossword_create';
$route['cross-word-list']='admindashboard/Admindashboard2/cross_word_list';
$route['cross-word-delete/(:any)']='admindashboard/Admindashboard2/cross_word_delete';
$route['cross-word-edit/(:any)']='admindashboard/Admindashboard2/cross_word_edit';
$route['crossword-update']='admindashboard/Admindashboard2/update_cross_word';
$route['cross-word-view/(:any)']='admindashboard/Admindashboard2/cross_word_view';
########## cross word root end here for admin ############
############## admin view ################

// word deactivate list
$route['word-detective-list']='admindashboard/Admindashboard2/word_detective_list';
$route['word-detective-delete/(:any)']='admindashboard/Admindashboard2/delete_word_detective';
$route['word-detective-view/(:any)']='admindashboard/Admindashboard2/view_word_detective';
$route['word-detective-edit/(:any)']='admindashboard/Admindashboard2/edit_word_detective';
$route['update-word-detective']='admindashboard/Admindashboard2/update_word_detective';
$route['day-wise-notuser-report/(:any)']='admindashboard/Admindashboard2/daywisenotuserreport';

############# mcq user answer report root end  #########################
$route['view-mcq-user-answer']='admindashboard/Admindashboard2/view_mcq_user_answer';
$route['get-assignment-data']='admindashboard/Admindashboard2/get_assignment_data';
$route['get-level-data']='admindashboard/Admindashboard2/get_level_data';
$route['get-mcq-user-ans-list']='admindashboard/Admindashboard2/get_mcq_user_ans_list';
############# mcq user answer report root end  #########################
############# bucket user answer report root start from here############
$route['view-bucket-user-answer']='admindashboard/Admindashboard2/view_bucket_user_answer';
$route['get-bucket-user-ans-list']='admindashboard/Admindashboard2/get_bucket_user_ans_list';
############# bucket user answer report root end from here############
############# word detective user answer report root start from here############
$route['view-word-detective-user-answer']='admindashboard/Admindashboard2/view_word_detective_user_answer';
$route['get-word-detective-user-ans-list']='admindashboard/Admindashboard2/get_word_detective_user_ans_list';
############# word detective user answer report root end from here############
############# Cross Word user answer report root start from here############
$route['view-cross-word-user-answer']='admindashboard/Admindashboard2/view_cross_word_user_answer';
$route['get-cross-word-user-ans-list']='admindashboard/Admindashboard2/get_cross_word_user_ans_list';
############# Cross Word user answer report root end from here############
############# Cross Word user answer report root start from here############
$route['view-grid-fib-user-answer']='admindashboard/Admindashboard2/view_grid_fib_user_answer';
$route['get-grib-fib-user-ans-list']='admindashboard/Admindashboard2/get_grib_fib_user_ans_list';
############# Cross Word user answer report root end from here############ 
$route['linkedin']='web/web/linkedin';
$route['update-profile-resume']='userdashboard/Userdashboard/update_profile_resume';
##################process generator #########################
$route['create-process']='admindashboard/Admindashboard2/create_process';
$route['process-insert']='admindashboard/Admindashboard2/process_insert';
$route['process-tool/(:any)']='assignments/Assignments/process_tool';
$route['process-insert-user']='assignments/Assignments/process_insert_user';
$route['generate-score-process']='assignments/Assignments/generate_score_process';
$route['skip-process']='assignments/Assignments/skip_process';
##################process generator #########################

##############group delete #################
$route['group-edit/(:any)']='admindashboard/Admindashboard2/group_edit';
$route['group-delete/(:any)']='admindashboard/Admindashboard2/group_delete';
$route['leave-group-admin']='admindashboard/Admindashboard2/leave_group_admin';
$route['group-edit-insert']='admindashboard/Admindashboard2/group_edit_insert';
##############group delete #################
$route['user-login']='web/Web/user_login';
$route['faq-support']='web/Web/faq_support';

$route['delete-draft-case-upload/(:any)']='userdashboard/Userdashboard/delete_draft_case_upload';
$route['user-case-upload-file']='userdashboard/Userdashboard/user_case_upload_file';
$route['upload-case-study-view']='userdashboard/Userdashboard/upload_case_study_view';
$route['user-case-study-upload']='userdashboard/userdashboard/user_case_study_upload';
$route['upload-case-study']='userdashboard/userdashboard/upload_case_study';
$route['upload-case-study/(:any)']='userdashboard/userdashboard/upload_case_study';
$route['edit-ajax-user-table']='userdashboard/Userdashboard/edit_ajax_user_table';
//employer section 
$route['employer']='employer/employer';
$route['verify-employer/(:any)']='employer/employer/confirm_mail'; 
$route['forget-employer']='employer/employer/forget';
$route['forget-employer-password']='employer_forgetpass/Employerforget/employer_forget';
$route['set-employer-password']='employer_forgetpass/Employerforget/employer_forgetchange';
$route['employer-forget-view']='employer_forgetpass/Employerforget/forgetview';
$route['employer-dashboard']='employer/employer/employer_dashboard';

$route['emp-dashboard']='employer/Employer/emp_dashboard';

$route['employer-logout']='employer/employer/employer_logout';
$route['employer-password-match']='employer/employer/employer_password_match';
$route['employer-company-profile']='employer/employer/employer_company_profile';
$route['employer-update-editable']='employer/employer/employer_updeditable';
$route['employer-data-edit']='employer/employer/employer_data_edit';
$route['emp-selectstate']='employer/employer/emp_selectstate';
$route['emp-selectcity']='employer/employer/emp_selectcity';
$route['select-industry']='employer/employer/emp_selectindustry';
$route['emp-image-update']='employer/employer/employer_image_update';

$route['employer-job-post']='employer/employer/employer_job_post';
$route['search-city-emp']='employer/employer/search_city_emp';
$route['save-emp-job-data']='employer/employer/submit_emp_job_data';
$route['update-emp-job-data']='employer/employer/update_emp_job_data';
$route['view-job/(:any)']='employer/employer/job_desc_view'; 
#####################16/11/2017 Khushboo Sahu#########################
$route['employer-lists']='admindashboard/Admindashboard/employer_list';
$route['employer-preview-data/(:any)']='admindashboard/Admindashboard/employer_preview_data';
#####################16/11/2017 Khushboo Sahu#########################
// 02 12 2017
$route['applied-condidate-detail']='employer/employer/applied_condidate_detail';
$route['delete-emp-job']='employer/employer/delete_emp_job';
$route['share-emp-job']='employer/employer/share_emp_job';
// 03 12 2017
$route['edit-emp-job/(:any)']='employer/employer/edit_emp_job';
$route['edit-emp-job-data']='employer/employer/edit_emp_job_data';
//04 12 2017
$route['employer-my-jobs']='employer/employer/employer_my_jobs';
$route['applied-candidates/(:any)']='employer/employer/applied_candidate_list';
$route['open-job']='employer/employer/open_job';
$route['close-job']='employer/employer/close_job';
$route['candidate-full-detail/(:any)']='employer/employer/candidate_full_detail';
// 09 12 2017 
$route['edit-job-second-step/(:any)']='employer/employer/edit_job_second_step';
$route['edit-job-second-step-next/(:any)']='employer/employer/edit_job_second_step_next';
$route['check-employer-email-valid']='employer/employer/check_employer_email_valid';
$route['email-employer-ajax-check']='employer/employer/email_employer_ajax_check';

////job data 
$route['company-profile/(:any)']='userdashboard/Userdashboard/company_profile';
$route['job-profile']='userdashboard/Userdashboard/job_profile';
$route['apply-job/(:any)']='userdashboard/Userdashboard/apply_job';
$route['apply-job-data']='userdashboard/Userdashboard/apply_job_data';
$route['job-experience-update']='userdashboard/Userdashboard/job_experience_update';
$route['work-experience-delete']='userdashboard/Userdashboard/work_experience_delete';

// 15 12 2017
$route['edit-emp-job-after-applied/(:any)']='employer/employer/edit_emp_job_after_applied';
$route['edit-emp-job-data-after-applied']='employer/employer/edit_emp_job_data_after_applied';
############# Match of following user answer report root start from here############
$route['view-match-the-following-user-answer']='admindashboard/Admindashboard2/view_match_the_following_user_answer';
$route['get-match-the-following-user-ans-list']='admindashboard/Admindashboard2/get_match_the_following_user_ans_list';
############# Match of following user answer report root end from here############
$route['emp-step-process-condidate/(:any)']='employer/employer/emp_step_process_condidate';

######## employer root ###########
$route['confirm-employer-message']='employer/Employer/confirm_employer_message';
$route['approve-employer-account/(:any)/(:any)']='admindashboard/Admindashboard2/approve_employer_account';
$route['employer-activation/(:any)']='employer/employer/employer_account_activation';

$route['dashboard-latest']='admindashboard/Admindashboard2/dashboard_latest';
$route['day-old-user-report']='admindashboard/Admindashboard2/daywise_old_report';
$route['pending-submission-detail']='admindashboard/Admindashboard2/pending_submission_detail';
//21 12 2017
$route['image-cropper']='employer/CropImage/index';
//23 12 2017
$route['employer-job-lists']='admindashboard/admindashboard2/employer_job_list';
//25 12 2017
$route['change-job-status/(:any)/(:any)']='admindashboard/Admindashboard2/change_job_status';
$route['more-info-job']='admindashboard/admindashboard2/more_info_job';
$route['get-industry-functional']='admindashboard/Admindashboard2/get_industry_functional';
//27/12/2017

$route['get-idle-user']='admindashboard/admindashboard/get_idle_user';
$route['get-idle-user-a-week']='admindashboard/admindashboard/get_idle_user_a_week';
$route['completed-user']='admindashboard/admindashboard/completed_user';
$route['get-system-neuron']='admindashboard/admindashboard/get_system_neuron';

$route['get-consultant']='admindashboard/admindashboard/get_consultant';
$route['get-student']='admindashboard/admindashboard/get_student';
$route['get-not-verified-user']='admindashboard/admindashboard/get_not_verified_user';
$route['get-verified-user']='admindashboard/admindashboard/get_verified_user';
$route['get-user']='admindashboard/admindashboard/get_user';
$route['ticket-delete/(:any)']='admindashboard/Admindashboard2/ticket_delete';
$route['ticket-trash']='admindashboard/Admindashboard/ticket_trash';
$route['ticket-recover/(:any)']='admindashboard/Admindashboard2/ticket_recover';
$route['ticket-delete-permanantly/(:any)']='admindashboard/Admindashboard2/ticket_delete_permanantly';

#####################  demo package  ################################
$route['demo-package']='demopackage/Demopackage/demo_package';
$route['demo-get-mcq/(:any)']='demopackage/Demopackage/demo_get_mcq';
$route['demo-save-user-ans']='demopackage/Demopackage/demo_save_user_ans';
$route['demo-gird-fib']='demopackage/Demopackage/demo_gird_fib';
$route['demo-save-grid-fib']='demopackage/Demopackage/demo_save_grid_fib';
$route['demo-crossword-tool']='demopackage/Demopackage/crossword_tool';
$route['demo-crossword-insert-user']='demopackage/Demopackage/demo_crossword_insert_user';
$route['demo-generate-score-crossword']='demopackage/Demopackage/demo_generate_score_crossword';
$route['signup-demo']='demopackage/Demopackage/signup_demo';
$route['net-check']='assignments/Assignments/net_check';

$route['demo-tools']='web/Web/tools_demo';
$route['crossword-cookies']='demopackage/Demopackage/crossword_cookies';
$route['crossword-cookies-next']='demopackage/Demopackage/crossword_cookies_next';
$route['sequence-cookies']='demopackage/Demopackage/sequence_cookies';
$route['mcq-cookies']='demopackage/Demopackage/mcq_cookies';
$route['hint-cookies']='demopackage/Demopackage/hint_cookies';
$route['signup-by-demopackage']='demopackage/Demopackage/signup_by_demopackage';
$route['demo-crossword-score']='demopackage/Demopackage/demo_crossword_score';
$route['demo-sequence-score']='demopackage/Demopackage/demo_sequence_score';
$route['demo-word-score']='demopackage/Demopackage/demo_word_score';
$route['demo-mcq-score']='demopackage/Demopackage/demo_mcq_score';
$route['demo-user-login']='demopackage/Demopackage/demo_user_login';
######## employer root ###########
$route['confirm-employer-message']='employer/Employer/confirm_employer_message';
$route['approve-employer-account/(:any)/(:any)']='admindashboard/Admindashboard2/approve_employer_account';
$route['employer-activation/(:any)']='employer/employer/employer_account_activation';
$route['web-blog']='web/web/web_blog';
$route['blog']='web/Web/blog';

$route['blog-detail']='web/Web/blog_detail';
$route['blog-hindi-movie']='web/Web/blog_hindi_movie';
$route['tourist-traveller']='web/Web/tourist_traveller';
$route['brain-clay']='web/Web/brain_clay';
$route['demo-skills']='demopackage/Demopackage/demo_skills';
$route['message-list']='userdashboard/Userdashboard/message_list';
$route['get-message']='userdashboard/Userdashboard/get_message';
// New root for super admin
// route by khushboo
$route['view-main-menu']='admindashboard/Admindashboard3/view_main_menu';
$route['view-sub-menu']='admindashboard/Admindashboard3/view_sub_menu';
$route['view-sub-sub-menu']='admindashboard/Admindashboard3/view_sub_sub_menu';
$route['view-roles']='admindashboard/Admindashboard3/view_roles';
$route['view-permissions']='admindashboard/Admindashboard3/view_permissions';
$route['view-employees']='admindashboard/Admindashboard3/view_employees';
$route['map-role-with-permission-menu']='admindashboard/Admindashboard3/map_role_with_permission_menu';
// new controller for super admin pannel
//menu-master-insert
$route['menu-master-insert']='admindashboard/Admindashboard3/menu_master_insert';
$route['delete-master-menu']='admindashboard/Admindashboard3/delete_master_menu';
$route['edit-master-form-get-data']='admindashboard/Admindashboard3/edit_master_form_get_data';
$route['edit-master-form-data-save']='admindashboard/Admindashboard3/edit_master_form_data_save';
$route['edit-master-form-data-save']='admindashboard/Admindashboard3/edit_master_form_data_save';
$route['permission-master-form-data-save']='admindashboard/Admindashboard3/permission_master_form_data_save';
//edit-master-permission-form-get-data
$route['edit-master-permission-form-get-data']='admindashboard/Admindashboard3/edit_master_permission_form_get_data';
$route['edit-master-permission-save']='admindashboard/Admindashboard3/edit_master_permission_save';
$route['delete-master-permission']='admindashboard/Admindashboard3/delete_master_permission';
// route by khushboo
$route['sub-menu-master-insert']='admindashboard/Admindashboard3/sub_menu_master_insert';
$route['delete-master-sub-menu']='admindashboard/Admindashboard3/delete_master_sub_menu';
$route['edit-parent-form-get-data']='admindashboard/Admindashboard3/edit_parent_form_get_data';
$route['edit-parent-form-data-save']='admindashboard/Admindashboard3/edit_parent_form_data_save';

$route['sub-sub-menu-master-insert']='admindashboard/Admindashboard3/sub_sub_menu_master_insert';
$route['get-menu-submenu']='admindashboard/Admindashboard3/get_menu_submenu';
$route['delete-master-sub-sub-menu']='admindashboard/Admindashboard3/delete_master_sub_sub_menu';

//08 01 2018
$route['edit-child-form-get-data']='admindashboard/Admindashboard3/edit_child_form_get_data';
$route['edit-child-form-data-save']='admindashboard/Admindashboard3/edit_child_form_data_save';

$route['role-master-insert']='admindashboard/Admindashboard3/role_master_insert';
$route['delete-master-role']='admindashboard/Admindashboard3/delete_master_role';
$route['edit-role-form-get-data']='admindashboard/Admindashboard3/edit_role_form_get_data';
$route['edit-role-form-data-save']='admindashboard/Admindashboard3/edit_role_form_data_save';

$route['employee-master-insert']='admindashboard/Admindashboard3/employee_master_insert';
$route['delete-master-employee']='admindashboard/Admindashboard3/delete_master_employee';
$route['edit-employee-form-get-data']='admindashboard/Admindashboard3/edit_employee_form_get_data';
// map info save form route
$route['map-role-permission-form-save']='admindashboard/Admindashboard3/map_role_permission_form_save';
$route['delete-map-role-permission']='admindashboard/Admindashboard3/delete_map_role_permission';
$route['view-map-role-permission/(:any)']='admindashboard/Admindashboard3/view_map_role_permission';
$route['edit-map-role-permission/(:any)']='admindashboard/Admindashboard3/edit_map_role_permission';
$route['edit-map-role-permission-form-save']='admindashboard/Admindashboard3/edit_map_role_permission_form_save';
//$route['edit-employee-form-data-save']='admindashboard/Admindashboard3/edit_employee_form_dat
// check side bar
$route['edit-map-role-permission-form-save']='admindashboard/Admindashboard3/edit_map_role_permission_form_save';
$route['testing-url']='admindashboard/Admindashboard3/testing_url';
$route['view-map']='admindashboard/Admindashboard3/view_map';
$route['interactive-case/(:any)']='assignments/Assignments1/interactive_case';
$route['next-test-case']='assignments/Assignments1/next_test_case';
$route['user-interactive-answer-insert']='assignments/Assignments1/user_interactive_answer_insert';
// root for certificate
$route['by-post']='admindashboard/Admindashboard2/by_post';
//khushboo route
$route['edit-employee-form-data-save']='admindashboard/Admindashboard3/edit_employee_form_data_save';
$route['delete-master-employee']='admindashboard/Admindashboard3/delete_master_employee';
$route['single-map-role-detail']='admindashboard/Admindashboard3/single_map_role_detail';
$route['admin-dashboardtemp']='admindashboard/Admindashboard3/admin_dashboardtemp';
$route['view-new-scores']='admindashboard/Admindashboard/index_score';
$route['view-new-scores/(:num)/(:num)']='admindashboard/Admindashboard/index_score';
$route['view-new-scores/(:num)']='admindashboard/Admindashboard/index_score';
$route['cart-checkout']='userdashboard/Userdashboard/cart_checkout';
$route['wallet-payment/(:any)']='userdashboard/Userdashboard/wallet_payment';
$route['payement-option/(:any)']='userdashboard/Userdashboard/payement_option';
$route['product-list']='product/Product/product_list';
$route['industry-skill-per']='admindashboard/Admindashboard3/industry_skill_per';
$route['insert-industries-per']='admindashboard/Admindashboard3/insert_industries_per';
$route['industries-skills-per-list']='admindashboard/Admindashboard3/industries_skills_per_list';
// heat chart 
$route['heat-chart']='userdashboard/Userdashboard/heat_chart';
// start up package 
$route['start-up-tool']='startuptool/Startuptool/start_up_tool';
$route['start-up-tool-exercise']='startuptool/Startuptool/start_up_tool_excercise';
$route['industry-list']='startuptool/Startuptool/industry_list_at_first_time';

// demo case
$route['demo-case']='demopackage/Demopackage/demo_case';
$route['case-cookies']='demopackage/Demopackage/case_cookies';
$route['demo-graph']='demopackage/Demopackage/demo_graph';

// Auto matic subjective
$route['auto-submit/(:any)']='assignments/Assignments1/auto_submit';
$route['ajax_data_auto']='assignments/Assignments1/ajax_data_auto';
$route['score-auto-submit']='assignments/Assignments1/score_auto_submit';
$route['insert-auto-submit']='assignments/Assignments1/insert_auto_submit';
$route['neurons-summary']='userdashboard/Userdashboard/neurons_summary';

// new root of interactive case study
$route['interactive-case']='admindashboard/Admindashboard2/interactive_case';
$route['create-interactive-case']='admindashboard/Admindashboard2/create_interactive_case';
$route['insert-interactive-case-study']='admindashboard/Admindashboard2/insert_interactive_case_study';
$route['interactive-case-option']='admindashboard/Admindashboard2/interactive_case_option_list';
$route['create-interactive-case-option']='admindashboard/Admindashboard2/create_interactive_case_option';
$route['case-map']='admindashboard/Admindashboard2/case_map_list';
$route['create-case-map']='admindashboard/Admindashboard2/create_case_map';
$route['create-case-map-insert']='admindashboard/Admindashboard2/create_case_map_insert';
$route['insert-interactive-case-option']='admindashboard/Admindashboard2/insert_interactive_case_option_list';
$route['get-case-map-skill']='admindashboard/Admindashboard2/get_case_map_skill';
$route['edit-interactive-case-study/(:any)']='admindashboard/Admindashboard2/edit_interactive_case_study';
$route['edit-interactive-case-study-save']='admindashboard/Admindashboard2/edit_interactive_case_study_save';
$route['edit-case-map/(:any)']='admindashboard/Admindashboard2/edit_case_map';
$route['edit-case-map-save']='admindashboard/Admindashboard2/edit_case_map_save';
$route['edit-interactive-case-option/(:any)']='admindashboard/Admindashboard2/edit_interactive_case_option';
$route['edit-interactive-case-option-save']='admindashboard/Admindashboard2/edit_interactive_case_option_save';
//interactive-case-option case-map
$route['case-bucket-ans-save']='assignments/Assignments/case_bucket_ans_save';
$route['new-case-study/(:any)']='assignments/Assignments1/new_case_study';
$route['new-score-case']='assignments/Assignments1/new_score_case';
$route['get_score_auto']='assignments/Assignments1/get_score_auto';

$route['mm-certifications']='userdashboard/Userdashboard/mm_certifications';
$route['cart-checkout']='userdashboard/Userdashboard/cart_checkout';
$route['wallet-payment/(:any)']='userdashboard/Userdashboard/wallet_payment';
$route['payement-pay/(:any)']='userdashboard/Userdashboard/payement_pay';
$route['assignment-instruction/(:any)']='assignments/Assignments/assignmet_instruction';

$route['ongoing-job-list']='userdashboard/Userdashboard/ongoing_job_list';
$route['applied-job-status/(:any)']='userdashboard/Userdashboard/applied_job_status';
$route['job-dashboard']='userdashboard/userdashboard/job_dashboard';
$route['new-job-next']='userdashboard/userdashboard/new_job_next';
$route['job-details']='userdashboard/userdashboard/job_details';
$route['applied-job-list']='userdashboard/userdashboard/applied_job_list';
$route['save-job-list']='userdashboard/userdashboard/save_job_list';
$route['save-job']='userdashboard/userdashboard/save_job';
$route['un-save-job']='userdashboard/userdashboard/un_save_job';
$route['unlock-job']='userdashboard/userdashboard/unlock_job';
$route['package-job-list']='userdashboard/userdashboard/package_job_list';

// khushboo
$route['apply-click-list']='employer/employer/apply_click_list';
$route['job-viewer-list']='employer/employer/job_viewer_list';
$route['all-job-list']='employer/employer/all_job_list';
$route['candidate-comparison-chart']='employer/employer/candidate_comparison_chart';
$route['job-show-display']='web/Web/signup_by_mailer';
$route['mail-login-user']='web/Web/mail_login_user';

//// new code by shafik ///////////// 
// root for new packages
$route['create-package-demo']='admindashboard/Admindashboard3/create_package_demo';
$route['get-user-industry-functional']='admindashboard/Admindashboard3/get_user_industry_functional';
$route['package-data-insert']='admindashboard/Admindashboard3/package_data_insert';
$route['get-package-data']='admindashboard/Admindashboard3/get_package_data';
$route['assignment-data-insert']='admindashboard/Admindashboard3/assignment_data_insert';
$route['get-industries-company-map-package']='admindashboard/Admindashboard3/get_industries_company_map_package';
$route['get-industries-map-company']='admindashboard/Admindashboard3/get_industries_map_company';
// url given by the khushboo
$route['save-levels']='admindashboard/Admindashboard3/save_levels';
$route['get-assignment-maxcount-data']='admindashboard/Admindashboard3/get_assignment_maxcount_data';
$route['insert-level-instruction']='admindashboard/Admindashboard3/insert_level_instruction';
// demo screen
$route['package-tool/(:any)']='admindashboard/Admindashboard3/package_tool';
$route['refill-package']='admindashboard/Admindashboard3/refill_package';
$route['get-pack-discription']='admindashboard/Admindashboard3/get_pack_discription';
$route['get-assign-discription']='admindashboard/Admindashboard3/get_assign_discription';
$route['get-level-question']='admindashboard/Admindashboard3/get_level_question';
$route['get-tool-form']='admindashboard/Admindashboard3/get_tool_form';
// root for save tool data start from here
$route['insert-sequence-tool-question']='admindashboard/Admindashboard3/insert_sequence_tool_questions';
$route['insert-word-detective-tool']='admindashboard/Admindashboard3/insert_word_detective_tool';
$route['crossword-insert-tool']='admindashboard/Admindashboard3/crossword_insert_tool';
$route['create-fill-in-blank-tool']='admindashboard/Admindashboard3/create_fill_in_blank_tool';
$route['create-grid-fill-in-blank-tool']='admindashboard/Admindashboard3/create_grid_fill_in_blank_tool';
$route['insert-mcq-tool']='admindashboard/Admindashboard3/insert_mcq_tool';
$route['match-follow-tool']='admindashboard/Admindashboard3/match_follow_tool';
$route['process-insert-tool']='admindashboard/Admindashboard3/process_insert_tool';
$route['insert-bucket-tool']='admindashboard/Admindashboard3/insert_bucket_tool';
// root for save tool data end here
$route['demo-page']='admindashboard/Admindashboard3/demo_page';
$route['master-skilltest-edit/(:any)']='admindashboard/Admindashboard/master_skilltest_edit';
$route['update-skill-test']='admindashboard/Admindashboard/update_skill_test';
$route['create-skill-test']='admindashboard/Admindashboard/create_skill_test';

$route['edit-package-tool/(:any)']='admindashboard/Admindashboard4/edit_package_tool';

$route['delete-tool-question']='admindashboard/Admindashboard3/delete_tool_question';
$route['veiw-tool-question/(:any)']='admindashboard/Admindashboard4/view_tool_question';

// edit package new route
$route['update-word-detective-tool']='admindashboard/Admindashboard4/update_word_detective_tool';
$route['update-grid-fib-tool']='admindashboard/Admindashboard4/update_grid_fib_tool';
$route['update-mcq-tool']='admindashboard/Admindashboard4/update_mcq_tool';
$route['update-match-tool']='admindashboard/Admindashboard4/update_match_tool';
$route['update-grid-fib-tool']='admindashboard/Admindashboard4/update_grid_fib_tool';
$route['edit-fib-tool']='admindashboard/Admindashboard4/edit_fib_tool';
$route['crossword-update-tool']='admindashboard/Admindashboard4/update_cross_word_tool';
$route['update-sequence-tool']='admindashboard/Admindashboard4/sequence_update_tool';
$route['update-bucket-tool']='admindashboard/Admindashboard4/update_bucket_tool';
$route['edit-process-insert-tool']='admindashboard/Admindashboard4/edit_process_insert_tool';
$route['employer-skill-map']='admindashboard/Admindashboard4/employer_skill_map';
$route['industries-company-data']='admindashboard/Admindashboard4/industries_company_data';

 
$route['industry-skills-map']='admindashboard/Admindashboard4/industry_skills_map';
$route['insert-industry-skill-map']='admindashboard/Admindashboard4/insert_industry_skill_map';
$route['update-industry-skill-map/(:any)']='admindashboard/Admindashboard4/edit_industry_skill_map';
$route['edit-industry-skill-map-save']='admindashboard/Admindashboard4/edit_industry_skill_map_save';
// root end here for new packages
//// new code by shafik /////////////

##############new route employer ################
$route['company-show']='company/Company/company_show';
$route['employee-add-dep']='employer/employer/employee_add_dep';
$route['employee-add-func']='employer/employer/employee_add_func';
$route['employee-add-dep']='employer/employer/employee_add_dep';
$route['employee-add-func']='employer/employer/employee_add_func'; 
$route['edit-emp-function/(:any)']='employer/employer/edit_emp_function';
$route['emp-func-edit-insert']='employer/employer/emp_func_edit_insert';
$route['create-training-widget']='employer/employer/create_training_widget';
$route['emp-training-widget-insert']='employer/employer/emp_training_widget_insert';
$route['edit-emp-training-widget/(:any)']='employer/employer/edit_emp_training_widget';
$route['emp-edit-training-widget-insert']='employer/employer/emp_edit_training_widget_insert';
$route['employee-add-unit']='employer/employer/employee_add_unit'; 
$route['emp-unit-insert']='employer/employer/emp_unit_insert';
$route['emp-dep-insert']='employer/employer/emp_dep_insert';
$route['emp-func-insert']='employer/employer/emp_func_insert';
$route['job-offer-list']='employer/employer/job_offer_list';
$route['create-employer-skills']='employer/employer/create_employer_skills';
$route['insert-employer-skills']='employer/employer/insert_employer_skills';
//$route['emp-skills-view']='employer/employer/emp_skills_view';
$route['edit-employer-skills/(:any)']='employer/employer/edit_employer_skills';
$route['edit-insert-employer-skills']='employer/employer/edit_insert_employer_skills';
$route['add-new-employee']='employer/employer/add_old_employee';
$route['emp-package-map']='employer/employer/emp_package_map';
$route['edit-emp-package-map/(:any)']='employer/employer/edit_emp_package_map';
##############new route employer ################

##########
$route['edit-emp-record-unit/(:any)']='employer/employer/edit_emp_record_unit';
$route['edit-emp-unit-update']='employer/employer/edit_emp_unit_update';
$route['edit-company-depratment/(:any)']='employer/employer/edit_company_depratment';
$route['edit-company-department-save']='employer/employer/edit_company_department_save';
$route['edit-employee-detail/(:any)']='employer/employer/edit_employee_detail';   
$route['employee-report-functional']='employer/employer/employee_report_functional';  
##########

$route['edit-package-demo']='admindashboard/Admindashboard3/edit_package_demo';
$route['update-case-study']='admindashboard/Admindashboard4/update_case_study';
$route['get-assignment-maxcount-data']='admindashboard/Admindashboard3/get_assignment_maxcount_data';

// Auto submit tool rout start from here
$route['auto-submit-create']='admindashboard/Admindashboard3/auto_submit_create';
$route['insert-auto-admin-submit']='admindashboard/Admindashboard3/insert_auto_submit';
$route['view-auto-submit']='admindashboard/Admindashboard3/view_auto_submit';
$route['edit-auto-submit/(:any)']='admindashboard/Admindashboard3/edit_auto_submit';
$route['edit-auto-submit-save']='admindashboard/Admindashboard3/edit_auto_submit_save';
$route['delete-auto-submit/(:any)']='admindashboard/Admindashboard3/delete_auto_submit';
// Auto submit tool rout end from here
$route['about-us']='web/Web/web_blog_new';


# exercise 

$route['exercise-tool/(:num)']='exercise/Exercise/exercise_tool'; 
$route['exercise-tool-level/(:any)']='exercise/Exercise/exercise_tool_level'; 
$route['exercise-instruction/(:any)']='exercise/Exercise/exercise_instruction';
$route['ex-question-mcq/(:any)']='exercise/Exercise/ex_question_mcq';
$route['ex-mcq-result']='exercise/Exercise/ex_mcq_result';
$route['exercise-score/(:any)']='exercise/Exercise/exercise_score';

#training route
$route['employee-training']='company/Company/employee_training';
$route['training-level/(:any)']='company/Company/training_level';
$route['training-room/(:any)/(:any)']='company/Company/training_room';
$route['training-room/(:any)']='company/Company/training_room';
$route['training-list']='company/Company/training_list';
$route['training-assignment-instruction/(:any)']='company_training/Company_training/training_assignment_instruction';
$route['tarining-mcq/(:any)']='company_training/Company_training/get_mcq';
$route['tr-mcq-result']='company_training/Company_training/tr_mcq_result';
$route['training-score/(:any)']='company_training/Company_training/training_score';
$route['emp-package-map-insert']='employer/employer/emp_package_map_insert';
$route['create-training-material-form']='employer/employer/create_training_material_form';
$route['emp-training-material-insert']='employer/employer/emp_training_material_insert';


$route['create-subjective-tool']='admindashboard/Admindashboard4/create_subjective_tool';
$route['insert-subjective-tool']='admindashboard/Admindashboard4/insert_subjective_tool';
$route['veiw-tool-question/(:any)']='admindashboard/Admindashboard4/view_tool_question';
$route['update-subjective-tool']='admindashboard/Admindashboard4/update_subjective_tool';

$route['create-job-questionaire']='employer/employer/create_job_questionaire';
$route['view-job-questionaire']='employer/employer/view_job_questionaire';

$route['create-employer-package']='employer/employer2/create_employer_package';

$route['refill-employer-package']='employer/employer2/refill_employer_package';
$route['emp-package-tool/(:any)']='employer/employer2/emp_package_tool';
$route['emp-edit-package-tool/(:any)']='employer/employer2/emp_edit_package_tool';
$route['emp-view-package-tool/(:any)']='employer/employer2/emp_view_package_tool';

$route['emp-insert-mcq-tool']='employer/employer2/emp_insert_mcq_tool';
$route['insert-mcq-file']='employer/employer2/insert_mcq_file';
$route['emp-update-mcq-tool']='employer/employer2/emp_update_mcq_tool';

$route['msg']='employer/employer/msg';
$route['archive-jobs']='employer/employer/archive_jobs';
$route['edit-employer-package']='employer/employer2/edit_employer_package';
$route['edit-training-material-form/(:any)']='employer/employer/edit_training_material_form';
$route['update-emp-training-material-insert']='employer/employer/update_emp_training_material_insert';

//11 June 2018
$route['emp-insert-sequence-tool-questions']='employer/employer2/emp_insert_sequence_tool_questions';
$route['emp-match-follow-tool']='employer/employer2/emp_match_follow_tool';
$route['emp-insert-bucket-tool']='employer/employer2/emp_insert_bucket_tool';
$route['load-work-experience-form']='userdashboard/Userdashboard/load_work_experience_form';
$route['get-total-work-experience']='userdashboard/Userdashboard/get_total_work_experience';

$route['edit-emp-package-map-insert']='employer/employer/edit_emp_package_map_insert';
//emp new dashboard
$route['count_view_clicks']='employer/employer/count_view_clicks';
$route['published_jobs']='employer/employer/published_jobs';
$route['un_published_jobs']='employer/employer/un_published_jobs';
$route['new-dashboard']='employer/employer/new_dashboard';  

$route['preview-job-questionaire']='employer/employer/preview_job_questionaire';
// route for job package

$route['create-job-package']='employer/Job_package/create_job_package';
$route['get-package-preview']='employer/Job_package/get_package_preview';
$route['refill-employer-package/(:any)']='employer/employer2/refill_employer_package';

$route['map-employee-training']='employer/Employer3/map_employee_training';
$route['map-employee-training-data']='employer/Employer3/map_employee_training_data';
$route['training-report']='employer/Employer3/training_report';
$route['training-report-data']='employer/Employer3/training_report_data';
$route['training-attend-user']='employer/Employer3/training_attend_user';

//route for refill job package
$route['refill-employer-package/(:any)']='employer/Job_Refill_Package/refill_employer_package';
$route['emp-job-package-tool/(:any)']='employer/Job_Refill_Package/emp_job_package_tool';
$route['emp-job-edit-package-tool/(:any)']='employer/Job_Refill_Package/emp_job_edit_package_tool';
$route['emp-job-view-package-tool/(:any)']='employer/Job_Refill_Package/emp_job_view_package_tool';

$route['emp-update-bucket-tool']='employer/employer2/emp_update_bucket_tool';
$route['emp-update-sequence-tool']='employer/employer2/emp_sequence_update_tool';
$route['emp-update-match-tool']='employer/employer2/emp_update_match_tool';

$route['open-user-job/(:any)']='employer/employer/open_user_job';
$route['job-wise-not-applied-list']='employer/Employer/job_wise_not_applied_list'; 
$route['job-user-list']='employer/employer3/job_user_list';
$route['job-user-list-data']='employer/employer3/job_user_list_data';
$route['jaf-candidate-list']='employer/employer/jaf_candidate_list';
$route['view-jaf-structure-ajax']='employer/employer3/view_jaf_structure_ajax';

#########################new tool ##################################
$route['dmcq/(:any)']='assignments/Assignments1/dget_mcq';
$route['dsave-user-ans']='assignments/Assignments1/dsave_user_ans';
#########################new tool ##################################

$route['package-status-list']='admindashboard/admindashboard4/package_status_list';
$route['admin-home']='admindashboard/Admindashboard3/admin_home';
// admin portlets 
$route['get-user-portlet']='admindashboard/Admindashboard3/get_user_portlet';
$route['get-score-portlet']='admindashboard/Admindashboard3/get_pending_submission_detail_portlet';
$route['get-ticket-portlet']='admindashboard/Admindashboard3/get_ticket_portlet';
$route['get-package-portlet']='admindashboard/Admindashboard3/get_package_portlet';
$route['get-group-portlet']='admindashboard/Admindashboard3/get_group_portlet';
$route['get-employer-portlet']='admindashboard/Admindashboard3/get_employer_portlet';
$route['get-employer-jobs-portlet']='admindashboard/Admindashboard3/get_employer_jobs_portlet';
$route['get-applied-jobs-portlet']='admindashboard/Admindashboard3/get_applied_jobs_portlet';

$route['get-todays-system-neuron']='admindashboard/admindashboard3/get_todays_system_neuron';
$route['get-weekly-system-neuron']='admindashboard/admindashboard3/get_weekly_system_neuron';
$route['get-monthly-system-neuron']='admindashboard/admindashboard3/get_monthly_system_neuron';

$route['get-todays-users']='admindashboard/admindashboard3/get_todays_users';
$route['get-weekly-users']='admindashboard/admindashboard3/get_weekly_users';
$route['get-monthly-users']='admindashboard/admindashboard3/get_monthly_users';
$route['get-mm-summary']='admindashboard/admindashboard3/get_mm_summary';
$route['view-brief-summary']='admindashboard/admindashboard3/view_brief_summary';
$route['trainee-report']='employer/employer/trainee_report';
$route['training-rank-and-report']='company/Company/training_rank_and_report';

$route['package-attempted-user/(:any)']='admindashboard/Report/package_attempted_user';
$route['package-not-attempted-user/(:any)']='admindashboard/Report/package_not_attempted_user';
$route['package-not-completed-user/(:any)']='admindashboard/Report/package_not_completed_user';

$route['training-preview']='employer/employer2/training_preview';

$route['training-day-wise-report']='employer/Employer3/training_day_wise_report'; 
$route['package-record-list']='admindashboard/Report/package_record_list';
$route['view-package-data/(:any)']='admindashboard/Report/view_package_data';

//13 july 2018 Khushboo Sahu
$route['not-applied-candidate']='employer/Employer_Report/not_applied_candidate';
$route['trainee-report-new']='employer/Employer_Report/trainee_report_new';
$route['interactive-case-option-new']='admindashboard/Report/interactive_case_option_new';
$route['registered-user-new']='admindashboard/Report/registered_user_new';
$route['instruction-list-new']='admindashboard/Report/instruction_list_new';


$route['case-mcq-tool/(:any)']='assignments/Assignments1/case_mcq_tool';
$route['score-dmcq']='assignments/Assignments1/score_dmcq';


