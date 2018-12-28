<style type="text/css">
#draggablePanelList .panel-heading {
   cursor: move;
}
#draggablePanelList2 .panel-heading {
   cursor: move;
   }
   body {
   font-family: "open sans", "Helvetica Neue", Helvetica, Arial, sans-serif!important;
   font-size:13px;
   }
   @media screen and (min-width: 1024px) and (max-width: 2000px) {
   .table-responsive {
   min-height: .01%;
   overflow-x:auto;
   }
   .box_padd{padding-left:0px;}
   .content-wrapper, .right-side {
   min-height: 100%;
   background-color: #fff;
   z-index: 800;
   }
   }
   @media screen and (min-width: 600px) and (max-width: 2000px) {
   .panel-body{height:220px; overflow-x:auto;overflow-y:auto;padding: 0px!important;}
   }
   /*  ..panel-info>.panel-heading{background-color: #112b4ed9!important; padding: 1px 1px 1px 10px!important;font-weight: 700;}*/
   .panel-info>.panel-heading > h5{font-weight: 500;font-size:13px!important;color:#fff!important;font-family: "open sans", "Helvetica Neue", Helvetica, Arial, sans-serif!important;}
   thead{background-color:#fafafa;}
   .ibox{ margin-top: 3%;}
   #mydiv {
   position: absolute;
   z-index: 9;
   }
   .panel-info>.panel-heading {
   background-color: #112b4ed9!important; padding: 1px 1px 1px 10px!important;font-weight: 700;color: #fff!important;
   }
   #mydivheader {
   cursor: move;
   }
   .panel-info {
   border-color: #344b681a;
   border-radius: 0px;}
   .panel-heading .accordion-toggle:after {
    /* symbol for "opening" panels */
    font-family: 'Glyphicons Halflings';  /* essential for enabling glyphicon */
    content: "\e114";    /* adjust as needed, taken from bootstrap.css */
    float: right;        /* adjust as needed */
    color: #fff; 
    margin-right: 10px;        /* adjust as needed */
}
.panel-heading .accordion-toggle.collapsed:after {
    /* symbol for "collapsed" panels */
    content: "\e113";    /* adjust as needed, taken from bootstrap.css */
}
.mystyle{
  font-size:12px;
}
.inner_txt{
  font-size:11px;
}
/*top boxes css start*/
.top_box_padd{padding: 0px 15px 0px 15px;}
.ibox {
    clear: both;
    margin-bottom: 25px;
    margin-top: 0;
    padding: 0;
    border: 1px solid #ddd;
}
.ibox-title {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #ffffff;
    border-color: #e7eaec;
    border-image: none;
    border-width: 2px 0 0;
    color: inherit;
    margin-bottom: 0;
    padding: 15px 15px 7px;
    min-height: 48px;
}
.ibox-content {
    clear: both;
}

.ibox-content {
    background-color: #ffffff;
    color: inherit;
    padding: 15px 20px 20px 20px;
    border-color: #e7eaec;
    border-image: none;
    border-style: solid solid none;
    border-width: 1px 0;
}
.ibox-title h5 {
   font-weight: 600;
    display: inline-block;
    font-size: 16px;
    margin: 0 0 7px;
    padding: 0;
    text-overflow: ellipsis;
    float: left;
}

.nav .label, .ibox .label {
    font-size: 10px;
}

.label-success, .badge-success {
    background-color: #1c84c6;
    color: #FFFFFF;
}

.label {
   margin-right: 2px;
    background-color: #d1dade;
    color: #5e5e5e;
    font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    font-weight: 600;
    padding: 3px 8px;
    text-shadow: none;
}
.no-margins {
    margin: 0 !important;
}

h1 {
    font-size: 30px;
}
.text-success {
    color: #1c84c6;
}

.font-bold {
    font-weight: 600;
}

.stat-percent {
    float: right;
}
.small, small {
    font-size: 85%;
}
/*top boxes css end*/
 .panel-actions {
   margin-top: -20px;
   margin-bottom: 0;
   text-align: right;
   }
   .panel-actions a {
   color:#333;
   }
   .panel-fullscreen {
   display: block;
   z-index: 9999;
   position: fixed;
   width: 100%;
   height: 100%;
   top: 0;
   right: 0;
   left: 0;
   bottom: 0;
   overflow-x: auto;
   }
   .old_user, .userdate{
    cursor: pointer;
    color:#3c8dbc;
   }
</style>
<script src="https://code.jquery.com/jquery-2.2.0.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<div class="content-wrapper">
   <!-- Main content -->
   <div class=" wrapper-content" style="margin-left:1%;margin-right:0%;margin-top: 2%;">

   <div class="row">
         <div class="top_box_padd">
                    <div class="col-lg-3 box_padd">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title" style="min-height:25px;height:25px;border-bottom: 1px solid #e7eaec;padding-top:4px;">
                                <h5>Users</h5>
                            </div>
                            <div class="ibox-title" style="min-height:25px;height:25px;border-bottom: 1px solid #e7eaec;padding-top:4px;">
                                <span class="label label-primary pull-right monthly_users" style="cursor: pointer;">Monthly</span>
                                <span class="label label-info pull-right weekly_users" style="cursor: pointer;">Weekly</span>
                                <span class="label label-success pull-right todays_users" style="cursor: pointer;">Today</span>
                            </div>
                            <div class="ibox-title" style="min-height:25px;height:25px;padding-top:4px;">
                                <span class="label label-primary pull-right oneweek_idleuser" style="cursor: pointer;">Idle User</span>
                                <span class="label label-info pull-right idleuser" style="cursor: pointer;">Not Started</span>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins total_users" style="cursor: pointer;"></h1>
                                <!-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> -->
                                <small>Total number of users</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 box_padd">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title" style="min-height:25px;height:25px;border-bottom: 1px solid #e7eaec;padding-top:4px;">
                                <h5>Neurons</h5>
                            </div>
                            <div class="ibox-title" style="min-height:25px;height:25px;padding-top:4px;border-bottom: 1px solid #e7eaec;">
                                <span class="label label-primary pull-right monthly_neurons" style="cursor: pointer;">Monthly</span>
                                <span class="label label-info pull-right weekly_neurons" style="cursor: pointer;">Weekly</span>
                                <span class="label label-success pull-right todays_neurons" style="cursor: pointer;">Today</span>
                            </div>
                            <div class="ibox-title" style="min-height:25px;height:25px;padding-top:6px;"></div>
                            <div class="ibox-content" style="border-top: none">
                                <h1 class="no-margins total_neurons" style="cursor: pointer;"></h1>
                                <!-- <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div> -->
                                <small>Total number of neurons</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 box_padd">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title" style="min-height:25px;height:25px;border-bottom: 1px solid #e7eaec;padding-top:4px;">
                                <h5>Ticket</h5>
                            </div>
                            <div class="ibox-title" style="min-height:25px;height:25px;padding-top:4px;border-bottom: 1px solid #e7eaec;">
                                 <span class="label label-primary pull-right open_ticket" style="cursor: pointer;">Open</span>
                                 <span class="label label-info pull-right close_ticket" style="cursor: pointer;">Closed</span>
                            </div>
                            <div class="ibox-title" style="min-height:25px;height:25px;padding-top:6px;"></div>
                            <div class="ibox-content" style="border-top: none">
                                <h1 class="no-margins"><?php echo $ticket_closed+$ticket_open; ?></h1>
                                <!-- <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div> -->
                                <small>Total number of ticket</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 box_padd">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title" style="min-height:25px;height:25px;border-bottom: 1px solid #e7eaec;padding-top:4px;">
                                <h5>Submission</h5>
                            </div>
                            <div class="ibox-title" style="min-height:25px;height:25px;padding-top:5px;border-bottom: 1px solid #e7eaec;">
                              <span class="label label-primary pull-right completed_submission" style="cursor: pointer;">Completed</span>
                              <span class="label label-info pull-right total_submission" style="cursor: pointer;">Total</span>
                            </div>
                            <div class="ibox-title" style="min-height:25px;height:25px;padding-top:5px;"></div>
                            <div class="ibox-content" style="border-top: none">
                                <h1 class="no-margins">
                                  <a href="<?php echo base_url(); ?>pending-submission-detail" style="color:#000;"><?php echo $pending_submission; ?></a>
                                </h1>
                                <!-- <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div> -->
                                <small>Total number of pending submission</small>
                            </div>
                        </div>
            </div>
         </div>
  </div>
  <!-- Ends first row -->

      <?php //echo $count_portlet; print_r($portlets); 
           $count=$count_portlet;
           $r=$count_portlet%3; 
            $rd=$count_portlet/3;
            if($r!=0){
              $rd+=1;
            }
            $row=floor($rd);
         ?>
      <div class="">
        <div class="row">
          <div class="col-md-12">
            <ul id="draggablePanelList" class="list-unstyled">
             <?php 
                 for($i=0;$i<$count;$i++){
                 if($portlets[$i]['portlet_name']=="Brief Summary"){
             ?>
             <div class="col-lg-12 col-md-12 box_padd" >
                  <li class="panel panel-info">
                      <?php 
                          $class_name= preg_replace('/\s+/', '_', $portlets[$i]['portlet_name']); 
                          if($portlets[$i]['portlet_name']!=''){
                      ?>
                      <div class="panel-heading">
                        <h5>
                          <?php echo ($i+1).". ".$portlets[$i]['portlet_name']; ?>
                          <span class="<?php echo 'Total_'.$class_name; ?>"></span>
                          <div class="panel-actions">
                              <a href="#" class="panel-fullscreen-portlets" data-id="<?php echo 'Resize_'.$class_name; ?>" role="button" title="Toggle fullscreen" style="margin-right: 2px;"><i class="glyphicon glyphicon-resize-full" style="color: #fff;"></i>
                              </a>&nbsp;
                              <span class="pull-right" href="" style="margin-right: 2%;cursor:pointer" id="<?php echo 'Link_'.$class_name; ?>">
                                <i class="fa fa-share" aria-hidden="true" style="color:#fff;"></i>
                              </span>
                              <a class="accordion-toggle pull-right" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $class_name; ?>"></a>
                          </div>
                        </h5>
                      </div>
                     <?php } ?>
                      <div id="<?php echo $class_name; ?>" class="panel-collapse collapse in">
                          <div class="panel-body <?php echo $class_name; ?>">
                              <div class="table-responsive" >
                                  <table class="table table-bordered mystyle" id="<?php echo 'Portlet_'.$class_name; ?>" >
                                      <thead>
                                        <tr>
                                          <th>Date</th><th>New User</th><th>Attempted Level(Neurons)</th>
                                          <th>Old Attempted User</th><th>Attempted Level(Neurons)</th><th>Total Level</th>
                                          <th>Total Neurons</th><th>All Users</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                              // Start date
                                              $curdate = date('Y-m-d');
                                              // End date
                                              $timestamp = time()-86400;
                                              $date = strtotime("-6 day", $timestamp);
                                              $end_date = date('Y-m-d', $date);
                                              $kk=0;
                                              while (strtotime($curdate) >= strtotime($end_date)) {
                                        ?>
                                        <tr class="test<?php echo $kk; ?>">
                                          <td>
                                              <a class="getRowData" data-val="<?php echo $curdate; ?>" style="cursor: pointer;">
                                              <?php 
                                                  echo date('M j, Y',strtotime($curdate));
                                                  $curdate = date ("Y-m-d", strtotime("-1 day", strtotime($curdate)));
                                                  $kk++;
                                              ?>
                                             </a>
                                          </td>
                                          <td></td><td></td><td></td>
                                          <td></td><td></td><td></td>
                                          <td></td>
                                        </tr>
                                        <?php } ?>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </li>
            </div>
              <?php
                 }elseif($portlets[$i]['portlet_name']=="Package Status"){
             ?>
             <div class="col-lg-8 col-md-12 box_padd" >
                  <li class="panel panel-info">
                      <?php 
                          $class_name= preg_replace('/\s+/', '_', $portlets[$i]['portlet_name']); 
                          if($portlets[$i]['portlet_name']!=''){
                      ?>
                      <div class="panel-heading">
                        <h5>
                          <?php echo ($i+1).". ".$portlets[$i]['portlet_name']; ?>
                          <span class="<?php echo 'Total_'.$class_name; ?>"></span>&nbsp;&nbsp;
                         <!--  <select name="pack_type" id="pack_type" style="color:#000;">
                            <option value="">Package Type</option>
                            <?php foreach($package_type as $ptype){ ?>
                              <option value="<?php echo $ptype['pack_type_id'];?>" <?php if($ptype['pack_type_id']==$selected_pack_type){echo "selected"; } ?>><?php echo $ptype['pack_type_name']; ?></option>
                            <?php } ?>
                          </select> -->
                          <div class="panel-actions">
                              &nbsp;
                              <span class="pull-right" href="" style="margin-right: 2%;cursor:pointer" id="<?php echo 'Link_'.$class_name; ?>">
                                <i class="fa fa-share" aria-hidden="true" style="color:#fff;"></i>
                              </span>
                              <a class="accordion-toggle pull-right" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $class_name; ?>"></a>
                          </div>
                        </h5>
                      </div>
                     <?php } ?>
                      <div id="<?php echo $class_name; ?>" class="panel-collapse collapse in">
                          <div class="panel-body <?php echo $class_name; ?>">
                              <div class="table-responsive" >
                                  <table class="table table-bordered mystyle" id="<?php echo 'Portlet_'.$class_name; ?>" >
                                      <thead>
                                        <tr>
                                          <th>Package Name</th><th>User Attempted</th><th>User Completed</th>
                                          <th>Not Completed</th><th>Not attempted</th><th>Total Neurons</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                              $kk=1;
                                              foreach ($packages as $value) {
                                        ?>
                                        <tr class="test_pack<?php echo $value['package_id']; ?>" style="font-size:14px">
                                          <td>
                                              <a class="getPackageStatusData" data-val="<?php echo $value['package_id']; ?>" style="cursor: pointer;">
                                              <?php 
                                                  echo $value['package_name'];
                                                  $kk++;
                                              ?>
                                             </a>
                                          </td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
										  <td></td>
                                        </tr>
                                        <?php } ?>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </li>
            </div>
             <?php
                 }else{
             ?>
             <div class="col-lg-4 col-md-6 box_padd" >
                  <li class="panel panel-info">
                      <?php 
                          $class_name= preg_replace('/\s+/', '_', $portlets[$i]['portlet_name']); 
                          if($portlets[$i]['portlet_name']!=''){
                      ?>
                      <div class="panel-heading">
                        <h5>
                          <?php echo ($i+1).". ".$portlets[$i]['portlet_name']; ?>
                          <span class="<?php echo 'Total_'.$class_name; ?>"></span>
                          <div class="panel-actions">
                              <a href="#" class="panel-fullscreen-portlets" data-id="<?php echo 'Resize_'.$class_name; ?>" role="button" title="Toggle fullscreen" style="margin-right: 2px;"><i class="glyphicon glyphicon-resize-full" style="color: #fff;"></i>
                              </a>&nbsp;
                              <span class="pull-right" href="" style="margin-right: 2%;cursor:pointer" id="<?php echo 'Link_'.$class_name; ?>">
                                <i class="fa fa-share" aria-hidden="true" style="color:#fff;"></i>
                              </span>
                              <a class="accordion-toggle pull-right" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $class_name; ?>"></a>
                          </div>
                        </h5>
                      </div>
                      <?php } ?>
                      <div id="<?php echo $class_name; ?>" class="panel-collapse collapse in">
                          <div class="panel-body <?php echo $class_name; ?>">
                              <div class="table-responsive" >
                                  <table class="table table-bordered mystyle" id="<?php echo 'Portlet_'.$class_name; ?>" >
                                  </table>
                              </div>
                          </div>
                      </div>
                  </li>
              </div>
              <?php 
                    } //close else
                    } //close loop
              ?>
            
             
            </ul>
          </div>
        </div>
      </div>

    </div>
  
</div>
<!-- end first row -->
<form id="datewise" method="post" action="<?php echo base_url()?>day-user-report">
  <input type="hidden" name="userdate" value="" />
</form>
<form id="datewise_olduser" method="post" action="<?php echo base_url()?>day-old-user-report">
  <input type="hidden" name="olduser_date" value="" />
</form>
<script type="text/javascript">
  var l='';
  l+='<tr><td>';
  l+='<div align="center"><img src="<?php echo base_url(); ?>assets/loading.gif" style="width:80px;height:80px;margin-top:15%"></div>';
  l+='</td></tr>';

   $(document).ready(function(){
     if($("div").hasClass("Brief_Summary")==true){
       $('a[data-id="Resize_Brief_Summary"').hide();
     }
     if($("div").hasClass("Users")==true){
         display_user_reports(5);
     }
     if($("div").hasClass("Pending_Submissions")==true){
         display_score_report(5);
     }
     if($("div").hasClass("Tickets")==true){
         display_recent_tickets(5);
     }
     if($("div").hasClass("Recent_Packages")==true){
         display_recent_packages(5);
     }
     if($("div").hasClass("Groups")==true){
         display_recent_group(5);
     }
     if($("div").hasClass("New_Employers")==true){
         display_recent_employers(5);
     }
     if($("div").hasClass("Recent_Jobs")==true){
         display_recent_employer_jobs(5);
     }
     if($("div").hasClass("Recent_Applied_Jobs")==true){
         display_recent_applied_jobs(5);
     }
   });
   $(document).on('click',"#Link_Brief_Summary",function(){
       window.location.href="<?php echo base_url(); ?>view-brief-summary";
   });
   $(document).on('click',"#Link_Users",function(){
       window.location.href="<?php echo base_url(); ?>registered-user";
   });
   $(document).on('click',"#Link_Pending_Submissions",function(){
       window.location.href="<?php echo base_url(); ?>pending-submission-detail";
   });
   $(document).on('click',"#Link_Tickets",function(){
       window.location.href="<?php echo base_url(); ?>ticket-view";
   });
   $(document).on('click',"#Link_Groups",function(){
       window.location.href="<?php echo base_url(); ?>view-group-report";
   });
   $(document).on('click',"#Link_New_Employers",function(){
       window.location.href="<?php echo base_url(); ?>employer-lists";
   });
   $(document).on('click',"#Link_Recent_Jobs",function(){
       window.location.href="<?php echo base_url(); ?>employer-job-lists";
   });
   $(document).on('click',"#Link_Recent_Packages",function(){
       window.location.href="<?php echo base_url(); ?>package-status-list";
   });
   $(document).on('click',"#Link_Package_Status",function(){
       window.location.href="<?php echo base_url(); ?>package-status-list";
   });
   // displaying user report
   function display_user_reports(limit){
      $.ajax({ 
                type:"POST",
                data:{'limit':limit}, 
                url:"<?php echo base_url()?>get-user-portlet", 
                dataType:"json",
                async:true,  
                beforeSend: function(){
                    $("#Portlet_Users").html(l);
                },
                success:function(message){
                     var data_json=message;
                     var  product='<thead><tr><th>#</th><th>Name</th><th>Contact</th></tr></thead><tbody>';
                     for(var i=0; i<data_json.user.length; i++)
                     { 
                             product+='<tr>'; 
                             product+='<td>'+(i+1)+'.</td>';
                             product+='<td>';
                             product+='<a href="<?php echo base_url();?>preview-data/'+data_json.user[i].params+'" target="_blank">';
                             product+=data_json.user[i].name+'<br>[';
                             product+='<span class="">'+data_json.user[i].mm_user_email+'</span>]</a>';
                             product+='</td>';
                             product+='<td>'+data_json.user[i].contact_number+'</td>';
                             product+='</tr>';
                     }
                     product+='</tbody>';
                     $("#Portlet_Users").html(product);
                     $(".Total_Users").html(" - "+data_json.user_count.total_user);
               },
               complete: function(){
                 
               },
               error:function(){
                  //alert('Some Error Occurred!');
               }
      
      }); 
   }
     // displaying score report
    function display_score_report(limit){
      $.ajax({ 
                type:"POST", 
                data:{'limit':limit}, 
                url:"<?php echo base_url()?>get-score-portlet", 
                dataType:"json",
                async:true,  
                beforeSend: function(){
                     $('#Portlet_Pending_Submissions').html(l);
                },
                success:function(message){
                    var data_json=message; 
                    if(limit==5){
                      var  product='<thead><tr><th>#</th><th>Name</th><th>Package</th></tr></thead><tbody>';
                    }
                    if(limit==20){
                      var  product='<thead><tr><th>#</th><th>Name</th><th>Package</th><th>Assignment</th><th>Level</th></tr></thead><tbody>';
                    }
                    for(var i=0; i<data_json.score.length; i++){ 
                           product+='<tr>'; 
                           product+='<td>'+(i+1)+'.</td>';
                           product+='<td>';
                           product+='<a href="<?php echo base_url();?>subjective-user-score/'+data_json.score[i].params+'" target="_blank">';
                           product+=data_json.score[i].user_info[0].name+'<br>[';
                           product+=''+data_json.score[i].user_info[0].mm_user_email+']</a>';
                           product+='</td>';
                           product+='<td>'+data_json.score[i].package_info[0].package_name+'</td>';
                           if(limit==20){
                            product+='<td>'+data_json.score[i].assigninfo_info[0].assignment_name+'</td>';
                            product+='<td>'+data_json.score[i].level_info[0].lvl_name+'</td>';
                           }
                           product+='</tr>';
                    }
                    product+='</tbody>';
                    $("#Portlet_Pending_Submissions").html(product);
                    $(".Total_Pending_Submissions").html(" - "+"<?php echo $pending_submission; ?>");
               },
               complete: function(){
                 
               },
               error:function(){
                  //alert('Some Error Occurred!');
               }
      
      }); 
   }
     // displaying recent tickets
    function display_recent_tickets(limit){
      $.ajax({ 
                type:"POST",
                data:{'limit':limit},  
                url:"<?php echo base_url()?>get-ticket-portlet", 
                dataType:"json",
                async:true,  
                beforeSend: function(){
                     $('#Portlet_Tickets').html(l);
                },
                success:function(message){
                     var data_json=message;
                     var  product='<thead><tr><th>TicketNo.</th><th>Name</th><th>Contact</th></tr></thead><tbody>';
                      for(var i=0; i<data_json.ticket.length; i++)
                      {
                           product+='<tr>'; 
                           product+='<td>';
                           product+='<a href="<?php echo base_url();?>reply/'+data_json.ticket[i].ticket_id+'" target="_blank">';
                           product+=data_json.ticket[i].ticket_sequence_no+'</a>';
                           product+='</td>';
                           product+='<td>'+data_json.ticket[i].name+'<br>['+data_json.ticket[i].email_id+']</td>';
                           product+='<td>'+data_json.ticket[i].contact_number+'</td>';
                           //product+='<td>'+data_json.ticket[i].subject+'</td>';
                           product+='</tr>';
                      }
                     
                      product+='</tbody>';
                      $("#Portlet_Tickets").html(product);
                      $(".Total_Tickets").html(" - "+"<?php echo $ticket_open+$ticket_closed; ?>");
   
               },
               complete: function(){
                 
               },
               error:function(){
                  //alert('Some Error Occurred!');
               }
      
      }); 
   }
    // displaying recent package
    function display_recent_packages(limit){
      $.ajax({ 
                type:"POST", 
                data:{'limit':limit}, 
                url:"<?php echo base_url()?>get-package-portlet", 
                dataType:"json",
                async:true,  
                beforeSend: function(){
                     $('#Portlet_Recent_Packages').html(l);
                },
                success:function(message){
                     var data_json=message; 
                     var  product='<thead><tr><th>#</th><th>Name</th><th>Levels</th><th>TotalMarks</th><th>TotalTime</th></tr></thead><tbody>';
                      for(var i=0; i<data_json.packages.length; i++)
                      {
                           product+='<tr>'; 
                           product+='<td>'+(i+1)+'.</td>';
                           product+='<td>'+data_json.packages[i].package_name+'</td>';
                           product+='<td>'+data_json.packages[i].totalLevel+'</td>';
                           product+='<td>'+data_json.packages[i].total_marks+'</td>';
                           product+='<td>'+data_json.packages[i].totalTime+'</td>';
                           product+='</tr>';
                      }
                     
                      product+='</tbody>';
                       $("#Portlet_Recent_Packages").html(product);
                       $(".Total_Recent_Packages").html(" - "+data_json.pack_count.total_packs);
                       $(".Total_Package_Status").html(" - "+data_json.pack_count.total_packs);
               },
               complete: function(){
                 
               },
               error:function(){
                  //alert('Some Error Occurred!');
               }
      
      }); 
   }
    // displaying recent group
    function display_recent_group(limit){
      $.ajax({ 
                type:"POST", 
                data:{'limit':limit}, 
                url:"<?php echo base_url()?>get-group-portlet", 
                dataType:"json",
                async:true,  
                beforeSend: function(){
                     $('#Portlet_Groups').html(l);
                },
                success:function(message){
                     var data_json=message; 
                     var  product='<thead><tr><th>#</th><th>Name</th><th>Leader</th><th>Members</th><th>Neurons</th></tr></thead><tbody>';
                      for(var i=0; i<data_json.group.length; i++)
                      {
                           product+='<tr>'; 
                           product+='<td>'+(i+1)+'.</td>';
                           product+='<td>';
                           product+='<a href="<?php echo base_url();?>view-member-report/'+data_json.group[i].group_id+'" target="_blank">';
                           product+=data_json.group[i].group_name+'</a>';
                           product+='</td>';
                           product+='<td>'+data_json.group[i].mm_user_full_name+'</td>';
                           product+='<td>'+data_json.group[i].numberOfmember+'</td>';
                           product+='<td>'+data_json.group[i].totalNeurons+'</td>';
                           product+='</tr>';
                      }
                     
                      product+='</tbody>';
                       $("#Portlet_Groups").html(product);
                       $(".Total_Groups").html(" - "+data_json.group_count.total_group);
               },
               complete: function(){
                 
               },
               error:function(){
                  //alert('Some Error Occurred!');
               }
      
      }); 
   }

    // displaying recent employers
    function display_recent_employers(limit){
      $.ajax({ 
                type:"POST", 
                data:{'limit':limit}, 
                url:"<?php echo base_url()?>get-employer-portlet", 
                dataType:"json",
                async:true,  
                beforeSend: function(){
                     $('#Portlet_New_Employers').html(l);
                },
                success:function(message){
                     var data_json=message; 
                     var product='<thead><tr><th>#</th><th>Company</th><th>ConcernPerson</th><th>Contact</th></tr></thead><tbody>';
                      for(var i=0; i<data_json.employer.length; i++)
                      {
                        web='';
                        if(data_json.employer[i].web_link!='' || data_json.employer[i].web_link!=null){
                          web=data_json.employer[i].web_link;
                        }else{
                          web="";
                        }
                           product+='<tr>'; 
                           product+='<td>'+(i+1)+'.</td>';
                           product+='<td>';
                           product+='<a href="'+data_json.employer[i].web_link+'" target="_blank" title="'+data_json.employer[i].web_link+'">';
                           product+='<span style="color:#3c8dbc;font-size:15px"><i class="fa fa-globe" aria-hidden="true"></i></span> </a>';
                           product+='<a href="<?php echo base_url();?>employer-preview-data/'+data_json.employer[i].params+'" target="_blank">';
                           product+=' '+data_json.employer[i].employer_company+'</a>';
                           product+='</td>';
                           product+='<td>'+data_json.employer[i].employer_contact_person_name+'<br>[<span class=inner_txt>'+data_json.employer[i].employer_email+'</span>]</td>';
                           product+='<td>'+data_json.employer[i].employer_mobile+'</td>';
                           product+='</tr>';
                      }
                     
                      product+='</tbody>';
                       $("#Portlet_New_Employers").html(product);
                       $(".Total_New_Employers").html(" - "+data_json.emp_count.total_emp);
               },
               complete: function(){
                 
               },
               error:function(){
                  //alert('Some Error Occurred!');
               }
      
      }); 
   }

   // displaying recent employer jobs
    function display_recent_employer_jobs(limit){
      $.ajax({ 
                type:"POST", 
                data:{'limit':limit}, 
                url:"<?php echo base_url()?>get-employer-jobs-portlet", 
                dataType:"json",
                async:true,  
                beforeSend: function(){
                     $('#Portlet_Recent_Jobs').html(l);
                },
                success:function(message){
                     var data_json=message; 
                     var  product='<thead><tr><th>#</th><th>Title[Company]</th><th>Neurons</th><th>CTC(Lac/Yr.)</th></tr></thead><tbody>';
                      for(var i=0; i<data_json.employer_jobs.length; i++)
                      {
                           product+='<tr>'; 
                           product+='<td>'+(i+1)+'.</td>';
                           product+='<td>'+data_json.employer_jobs[i].job_title+'<br>[';
                           product+='<span class="inner_txt">'+data_json.employer_jobs[i].employer_company+'</span>]</td>';
                           product+='<td>'+data_json.employer_jobs[i].required_system_neurons+'</td>';
                           product+='<td>'+data_json.employer_jobs[i].ctc_from+'-'+data_json.employer_jobs[i].ctc_from+'</td>';
                           product+='</tr>';
                      }
                     
                      product+='</tbody>';
                       $("#Portlet_Recent_Jobs").html(product);
                       $(".Total_Recent_Jobs").html(" - "+data_json.job_count.total_job);
               },
               complete: function(){
                 
               },
               error:function(){
                  //alert('Some Error Occurred!');
               }
      
      }); 
   }
   // displaying recent applied jobs
    function display_recent_applied_jobs(limit){
      $.ajax({ 
                type:"POST", 
                data:{'limit':limit}, 
                url:"<?php echo base_url()?>get-applied-jobs-portlet", 
                dataType:"json",
                async:true,  
                beforeSend: function(){
                     $('#Portlet_Recent_Applied_Jobs').html(l);
                },
                success:function(message){
                     var data_json=message; 
                     var  product='<thead><tr><th>#</th><th>Title[Company]</th><th>Name</th><th>Contact</th><th>Status</th></tr></thead><tbody>';
                      for(var i=0; i<data_json.applied_jobs.length; i++)
                      {
                           product+='<tr>'; 
                           product+='<td>'+(i+1)+'.</td>';
                           product+='<td>'+data_json.applied_jobs[i].job_title+'<br>[';
                           product+='<span class="inner_txt">'+data_json.applied_jobs[i].employer_company+'</span>]</td>';
                           product+='<td>';
                           product+='<a href="<?php echo base_url();?>preview-data/'+data_json.applied_jobs[i].params+'" target="_blank">';
                           product+=data_json.applied_jobs[i].name+'<br>[';
                           product+='<span class="inner_txt">'+data_json.applied_jobs[i].mm_user_email+'</span>]</a></td>';
                           product+='<td><span class="inner_txt">'+data_json.applied_jobs[i].phone_no+'</span></td>';
                           var status=''; var st=data_json.applied_jobs[i].job_process_step;
                           if(st=="2-0"){
                              status='Applied';
                           }else if(st=="2-1"){
                              status='Rejected';
                           }else if(st=="3-0"){
                              status='Shortlisted';
                           }else if(st=="3-1"){
                              status='Rejected After Shortlisted';
                           }else if(st=="4-0"){
                              status='Interview';
                           }else if(st=="4-1"){
                              status='Rejected After Interview';
                           }else if(st=="5-0"){
                              status='Offered';
                           }else if(st=="5-1"){
                              status='Rejected After Offered';
                           }else if(st=="6-0"){
                              status='Joined';
                           }else if(st=="6-1"){
                              status='Rejected After Joined';
                           }
                           product+='<td><span class="inner_txt">'+status+'</span></td>';
                           product+='</tr>';
                      }
                     
                      product+='</tbody>';
                       $("#Portlet_Recent_Applied_Jobs").html(product);
                       $(".Total_Recent_Applied_Jobs").html(" - "+data_json.ap_job_count.total_ap_job);
               },
               complete: function(){
                 
               },
               error:function(){
                  //alert('Some Error Occurred!');
               }
      
      }); 
   }
</script>
<!-- move boxes code -->
<script type="text/javascript">
   jQuery(function($) {
       var panelList = $('#draggablePanelList');
       panelList.sortable({
           // Only make the .panel-heading child elements support dragging.
           // Omit this to make then entire <li>...</li> draggable.
           handle: '.panel-heading', 
           update: function() {
               $('.panel', panelList).each(function(index, elem) {
                    var $listItem = $(elem),
                    newIndex = $listItem.index();
                    // Persist the new indices.
               });
           }
       });
   });
   
   jQuery(function($) {
       var panelList2 = $('#draggablePanelList2');
       panelList2.sortable({
           // Only make the .panel-heading child elements support dragging.
           // Omit this to make then entire <li>...</li> draggable.
           handle: '.panel-heading', 
           update: function() {
               $('.panel', panelList2).each(function(index, elem) {
                    var $listItem = $(elem),
                    newIndex = $listItem.index();
                    // Persist the new indices.
               });
           }
       });
   });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    // $(document).on('click',".total_neurons",function(){
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url().'get-system-neuron'?>",
            async:true,  
            beforeSend: function(){
              $('.total_neurons').text('Wait...');
            },
            success:function(data){
              $('.total_neurons').css('cursor', 'default');
              $('.total_neurons').css('text-decoration', 'none');
              $(".total_neurons").text(data);
            }
        });
    //});
  });
  $(document).ready(function(){
    //$(document).on('click',".total_users",function(){
    $.ajax({
        type: 'POST',
        url: "<?php echo base_url().'get-user'?>",
                      async:true,  
                      beforeSend: function(){
                           $('.total_users').text('Wait...');
                      },
                      success:function(data){
                        $('.total_users').css('cursor', 'default');
                        $('.total_users').css('text-decoration', 'none');
                        $(".total_users").text(data);
        }
    });
    //});
  });
  $(document).ready(function(){
          $(document).on('click',".open_ticket",function(){
              $('.open_ticket').css('cursor', 'default');
              $('.open_ticket').css('text-decoration', 'none');
              $(".open_ticket").html("Open: "+"<?php echo $ticket_open; ?>");
          });
  });
 $(document).ready(function(){
          $(document).on('click',".close_ticket",function(){
              $('.close_ticket').css('cursor', 'default');
              $('.close_ticket').css('text-decoration', 'none');
              $(".close_ticket").html("Closed: "+"<?php echo $ticket_closed; ?>");
          });
  });
 $(document).ready(function(){
          $(document).on('click',".total_submission",function(){
              $('.total_submission').css('cursor', 'default');
              $('.total_submission').css('text-decoration', 'none');
              $(".total_submission").html("Total : "+"<?php echo $total_submission; ?>");
          });
  });
 $(document).ready(function(){
          $(document).on('click',".completed_submission",function(){
              $('.completed_submission').css('cursor', 'default');
              $('.completed_submission').css('text-decoration', 'none');
              $(".completed_submission").html("Completed : "+"<?php echo $completed_submission; ?>");
          });
  });

 $(document).ready(function(){
      $(document).on('click',".todays_neurons",function(){
          $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url().'get-todays-system-neuron'?>",
                    async:true,  
                    beforeSend: function(){
                           $('.todays_neurons').text('Wait...');
                    },
                    success:function(data){
                        $('.todays_neurons').css('cursor', 'default');
                        $('.todays_neurons').css('text-decoration', 'none');
                        if(data=='' || data==null){data='0';}
                        $(".todays_neurons").html("Today: "+data);
                    }
          });
      });
  });
 $(document).ready(function(){
      $(document).on('click',".weekly_neurons",function(){
          $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url().'get-weekly-system-neuron'?>",
                    async:true,  
                    beforeSend: function(){
                           $('.weekly_neurons').text('Wait...');
                    },
                    success:function(data){
                        $('.weekly_neurons').css('cursor', 'default');
                        $('.weekly_neurons').css('text-decoration', 'none');
                        if(data=='' || data==null){data='0';}
                        $(".weekly_neurons").html("Weekly: "+data);
                    }
          });
      });
  });
 $(document).ready(function(){
      $(document).on('click',".monthly_neurons",function(){
          $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url().'get-monthly-system-neuron'?>",
                    async:true,  
                    beforeSend: function(){
                           $('.monthly_neurons').text('Wait...');
                    },
                    success:function(data){
                        $('.monthly_neurons').css('cursor', 'default');
                        $('.monthly_neurons').css('text-decoration', 'none');
                        if(data=='' || data==null){data='0';}
                        $(".monthly_neurons").html("Monthly: "+data);
                    }
          });
      });
  });


 $(document).ready(function(){
      $(document).on('click',".todays_users",function(){
          $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url().'get-todays-users'?>",
                    async:true,  
                    beforeSend: function(){
                           $('.todays_users').text('Wait...');
                    },
                    success:function(data){
                        $('.todays_users').css('cursor', 'default');
                        $('.todays_users').css('text-decoration', 'none');
                        if(data=='' || data==null){data='0';}
                        $(".todays_users").html("Today: "+data);
                    }
          });
      });
  });
 $(document).ready(function(){
      $(document).on('click',".weekly_users",function(){
          $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url().'get-weekly-users'?>",
                    async:true,  
                    beforeSend: function(){
                           $('.weekly_users').text('Wait...');
                    },
                    success:function(data){
                        $('.weekly_users').css('cursor', 'default');
                        $('.weekly_users').css('text-decoration', 'none');
                        if(data=='' || data==null){data='0';}
                        $(".weekly_users").html("Weekly: "+data);
                    }
          });
      });
  });
 $(document).ready(function(){
      $(document).on('click',".monthly_users",function(){
          $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url().'get-monthly-users'?>",
                    async:true,  
                    beforeSend: function(){
                           $('.monthly_users').text('Wait...');
                    },
                    success:function(data){
                        $('.monthly_users').css('cursor', 'default');
                        $('.monthly_users').css('text-decoration', 'none');
                        if(data=='' || data==null){data='0';}
                        $(".monthly_users").html("Monthly: "+data);
                    }
          });
      });
  });
  $(document).ready(function(){
     $(document).on('click',".idleuser",function(){
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url().'get-idle-user'?>",
            async:true,  
            beforeSend: function(){
              $('.idleuser').html('Wait...');
            },
            success:function(data){
              $(".idleuser").html("Not Started:"+data);
            }
        });
      });
  });
  $(document).ready(function(){
     $(document).on('click',".oneweek_idleuser",function(){
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url().'get-idle-user-a-week'?>",
            async:true,  
            beforeSend: function(){
              $('.oneweek_idleuser').html('Wait...');
            },
            success:function(data){
              if(data=='' || data==null){data='0';}
              $(".oneweek_idleuser").text("Idle Users:"+data);
            }
        });
     });
  });
</script>
<script type="text/javascript">
/*full screen code start*/
  $(document).ready(function () {
   //Toggle fullscreen
   $(".panel-fullscreen-portlets").click(function (e) {
       e.preventDefault();
       var $this = $(this);
       var id = $this.attr('data-id');
       if ($this.children('i').hasClass('glyphicon-resize-full'))
       {
           $this.children('i').removeClass('glyphicon-resize-full');
           $this.children('i').addClass('glyphicon-resize-small');
           if(id=="Resize_Users"){display_user_reports(20);}
           if(id=="Resize_Pending_Submissions"){display_score_report(20);}
           if(id=="Resize_Tickets"){display_recent_tickets(20);}
           if(id=="Resize_Recent_Packages"){display_recent_packages(20);}
           if(id=="Resize_Groups"){display_recent_group(20);}
           if(id=="Resize_New_Employers"){display_recent_employers(20);}
           if(id=="Resize_Recent_Jobs"){display_recent_employer_jobs(20);}
           if(id=="Resize_Recent_Applied_Jobs"){display_recent_applied_jobs(20);}

           $(".accordion-toggle").hide(); $(".fa-share").hide();
           $(".panel-body").css("height","auto");
       }
       else if ($this.children('i').hasClass('glyphicon-resize-small'))
       {
           $this.children('i').removeClass('glyphicon-resize-small');
           $this.children('i').addClass('glyphicon-resize-full');
           if(id=="Resize_Users"){display_user_reports(5);}
           if(id=="Resize_Pending_Submissions"){display_score_report(5);}
           if(id=="Resize_Tickets"){display_recent_tickets(5);}
           if(id=="Resize_Recent_Packages"){display_recent_packages(5);}
           if(id=="Resize_Groups"){display_recent_group(5);}
           if(id=="Resize_New_Employers"){display_recent_employers(5);}
           if(id=="Resize_Recent_Jobs"){display_recent_employer_jobs(5);}
           if(id=="Resize_Recent_Applied_Jobs"){display_recent_applied_jobs(5);}

           $(".accordion-toggle").show(); $(".fa-share").show();
           $(".panel-body").css("height","220px");
       }
       $(this).closest('.panel').toggleClass('panel-fullscreen');
       
   });
  });
   /*full screen code end*/ 
</script>

<script type="text/javascript">
  $(document).on('click',".getRowData",function(){
    var curr_class=$(this).parent().parent().attr("class");
    var a=$(this).attr('data-val');
    $("."+curr_class).html('<td colspan=8 align=center>Loading...</td>');
    $.ajax({ 
        type:"POST",
        data:{'date':a}, 
        url:"<?php echo base_url()?>get-mm-summary", 
        async:true,
        success:function(message){
          $("."+curr_class).html("");    
          $("."+curr_class).html(message);     
        },
        error:function(){
          alert('Some Error Occurred!');
        }
      
      }); 
  });

 $(document).on('click',".old_user",function(){
    var dateval = $(this).attr('data-date');
    if(dateval!=''){
      $('input[name="olduser_date"').val(dateval);  
      $('#datewise_olduser').submit();
   }
 });
 $(document).on('click',".userdate",function(){
  var dateval = $(this).attr('data-date');
  if(dateval!=''){
    $('input[name="userdate"').val($(this).attr('data-date'));
    $('#datewise').submit();
  }
});
 //Code for Package Status
  $(document).on('click',".getPackageStatusData",function(){
    var curr_class=$(this).parent().parent().attr("class");
    var a=$(this).attr('data-val'); 
    $("."+curr_class).html('<td colspan="5" align="center">Loading...</td>');
      $.ajax({ 
        type:"POST",
        data:{'package_id':a}, 
        url:"<?php echo base_url()?>admindashboard/admindashboard4/get_package_status", 
        async:true,
        success:function(message){
          $("."+curr_class).html("");    
          $("."+curr_class).html(message);     
        },
        error:function(){
          alert('Some Error Occurred!');
        }
      
      }); 
  });
</script>
