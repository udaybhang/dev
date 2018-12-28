<style>
  @media screen and (min-width: 1024px) and (max-width: 2000px) {
  .table-responsive {
    min-height: .01%;
    overflow: hidden;
}
}
.t{
      border: 1px solid;
    padding: 5px;
}
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}
.uerdate{
        text-decoration: underline;
        color: #3c8dbc;
        cursor: pointer;
      }
      #testtable2 th,#testtable2 td{
      	font-size:11px;
      }
</style>
   
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        
      </ol>
    </section>
 
    <!-- Main content -->
    <section class="content">
    <div class="row">
            <div class="col-md-12">
        <div class="col-md-6">
          <div class="inner">
           <div class="small-box bg-aqua">
       <h4><b>MM Summary</b></h4>   
        <table>
          <tr>
            <td># Users</td>
            <td># Verified</td>
            <td># Not Verified</td>
            <td># Student</td>
            <td># Consultant</td>
            <td># System Neurons</td>
          </tr>
          <tr>
          <td><a style="color:#fff;text-decoration:underline; cursor: pointer;" href="#" class="user-data"> (click to view)</a></td>
         <td><a style="color:#fff;text-decoration:underline; cursor: pointer;" href="#" class="verified"> (click to view)</a></td>
          <td><a style="color:#fff;text-decoration:underline; cursor: pointer;" href="#" class="notverified"> (click to view)</a></td>
          <td><a style="color:#fff;text-decoration:underline; cursor: pointer;" href="#" class="student"> (click to view)</a></td>
          <td><a style="color:#fff;text-decoration:underline; cursor: pointer;" href="#" class="consultant"> (click to view)</a></td>
          <td><a style="color:#fff;text-decoration:underline; cursor: pointer;" href="#" class="total_neuron"> (click to view)</a></td>
           </tr>
        </table>
      </div>
      </div>
        </div>
        <div class="col-md-3">
          <div class="inner">
           <div class="small-box bg-aqua">
             <h4>User status</h4>   
              <table>
                <tr>
                 <td>Not started</td>
                 <td ><a href="#"  class="idleuser" style="color: #fff; text-decoration: underline;"> (click to view)</a>
                     <!-- url  <?php echo base_url() ?>not-attempt-lists   <?php echo sizeof($leaderboard_lists) ?> -->
                 </td>
               </tr>
               <!-- gvhjgfjg -->
               <tr>
                 <td>Idle since one week</td>
                  <td><a style="color:#fff;text-decoration:underline;" href="#" class="oneweak_idleuser"> (click to view)</a></td>
               </tr>
               <!-- jhgdfsjd -->
               <tr>
                 <td>Completed</td>
                 <td><a style="color:#fff;text-decoration:underline; cursor: pointer;" href="#" class="completed"> (click to view)</a></td>
               </tr>
              </table>
            </div>
            </div>
      </div>
        <div class="col-md-3">
                 <div class="inner">
           <div class="small-box bg-aqua">
       <h4>Admin Task List</h4>   
        <table>
          <tr>
            <th>   </th>
            <th>Pending</th>
            <th>Solved</th>
          </tr>
          <tr>
          <td>Ticket</td>
          <td><?php echo $ticket_open; ?></td>
          <td><?php echo $ticket_closed; ?></td>
           </tr>
           <tr>
          <td>Submission</td>
          <td><a href="<?php echo base_url().'pending-submission-detail';?>" style="color: #fff; text-decoration: underline;"><?php echo sizeof($case_unched); ?></a></td>
          <td><?php echo sizeof($case_ched); ?></td>
           </tr>
        </table>
      </div>
      </div>
        </div>
      </div>
    
                  <div class="col-md-12" style="background-color:#fff;">
              
               <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-col">

        <div class="box-header with-border">
<div class="col-md-9">
<form action="<?php echo base_url() ?>admin-home" method="post" id="Search_form">
          
            <div class="col-md-4">
               <label style="float:left"> Start Date : </label>
               <div class="col-md-7">
               <input type="text" class="form-control datecalender" name="fromdate" value="<?php if($f_date !=''){ echo $f_date;}?>"/>
               </div>
            </div>
            <div class="col-md-4">
             <label style="float: left">End Date : </label>
             <div class="col-md-7">
               <input type="text" class="form-control datecalender" name="todate" value="<?php if($t_date !=''){ echo $t_date;}?>"/>
             </div>
            </div>
            <div class="col-md-3">
               <input type="button" class="btn btn-primary btn-md"  id="search_button" value="Search">
            </div>
             </form>
         </div>
          <div class="col-md-3">
             <?php 
                $permission_array=$this->session->userdata('permission_array');
                for($i=0;$i<sizeof($permission_array);$i++){
                    $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
                    if($p["permission_description"]=="Export"){

            ?>
            <input type="button" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E;" onclick="tableToExcel('testtable2', 'Excel Report');" value="Export to Excel" />
            <?php }} ?>
            </div>

        </div>
      </div>
      <!-- /.box -->

              <div class="col-md-12" style="padding-top: 10px;">
              <table class="table table-striped table-responsive" id="testtable2">
                <thead>
          <tr>
                  <th>S.No</th>
                  <th>Date</th>
                  <th>New User</th>
				          <th>New Attemptted User</th>
                  <th>Attempted Level(Neurons)</th>
                  <th>Old Attemptted User</th>
                  <th>Attempted Level(Neurons)</th>
                  <th>Total Level</th>
                  <th>Total Neurons</th>
                  <th>All User</th>
                 
                 
          </tr>
                </thead>
                <tbody>
        <?php
          $a=1;
          foreach ($all_dates as $all_date) {
        ?>
        <tr>
          <td><?php echo $a; ?>.</td>
          <td><?php echo $all_date['date']; ?></td>
          <td>
            <span class="uerdate" data-date="<?php echo $all_date['date']; ?>" target="_blank"><?php echo $all_date['user']; ?></span>
          </td>
          <td><a href="<?php echo base_url()?>day-wise-notuser-report/<?php echo $all_date['date']; ?>" target="_blank" style="text-decoration: underline; color: #3c8dbc ; cursor: pointer;"><?php  echo $all_date['allusercount']; ?></a></td>
          <td><?php echo $all_date['old_assignment']; ?>&nbsp;(<?php if($all_date['new_neuan']>0){echo $all_date['new_neuan'];}else{ echo 0;} ?>)</td>
          <td><span class="old_user" data-date="<?php echo $all_date['date']; ?>" style="text-decoration: underline; color: #3c8dbc ; cursor: pointer;"><?php echo $all_date['old']; ?></span></td>
          <td><?php echo $all_date['new_assignment']; ?>&nbsp;(<?php $attemp_old = $all_date['neurons']-$all_date['new_neuan']; if($attemp_old>0){ echo $attemp_old;}else{ echo 0;}?>)</td><!-- Attempted old user  -->
          <td><?php echo $all_date['assignment']; ?></td>
          <td><?php echo $all_date['neurons']; ?></td> 
          <td><?php echo $all_date['alluser']; ?></td>
		  
          <!-- old_assignment -->
        </tr>

        <?php
        $a++;
        }
        ?>
          </tbody>
        </table>
        <form id="datewise" method="post" action="<?php echo base_url()?>day-user-report">
          <input type="hidden" name="userdate" value="" />
        </form>
		<form id="datewise_olduser" method="post" action="<?php echo base_url()?>day-old-user-report">
         <input type="hidden" name="olduser_date" value="" />
       </form>
              </div>
    </div>
      <div class="row" style="display:none;">
        <div class="col-md-12">
            <div class="box box-info">
              <div class="box-header with-border">
              <h3 class="box-title">New Registered User</h3>
              <div class="col-md-12">
              <div class="col-md-4 col-md-offset-4">
		 <form action="<?php echo base_url()?>admin-home" method="post" id="filtercheck">
          
              <select class="form-control" name="usertype" id="usertype">
                <option value="">Select User Type</option>
                <?php
                  foreach ($user_type as $ulist1) {
                    $all=$ulist1['user_type_id'];
                    if($all==$usert){
                      $sel = 'selected="selected"';
                    }
                    else{
                      $sel = '';
                    }
              ?>
              <option value="<?php echo $ulist1['user_type_id']; ?>" <?php echo $sel; ?>><?php echo $ulist1['type_name']; ?></option>
              <?php
                  }
                ?>
              </select>
            
          </form>
          </div>

          <div class="col-md-4">
            <?php 
                $permission_array=$this->session->userdata('permission_array');
                for($i=0;$i<sizeof($permission_array);$i++){
                    $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
                    if($p["permission_description"]=="Export"){

            ?>
            <input type="button" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E;" onclick="tableToExcel('userdatas', 'Excel Report');" value="Export to Excel" />
            <?php }} ?>
          </div>
          </div>
        
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="reload"><i class="fa fa-fw fa-refresh"></i></button>
              </div>
            </div>
                <div class="box-body table-responsive">
                    <table id="userdatas" class="table table-bordered table-hover ">
                        <thead>
                            <tr >
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Registration Date</th>
                  <th>Status</th>
                </tr>
                        </thead>
                        <tbody>
                          <?php $sn=0; foreach($reg_user_data as $reguser){
                             $sn++;
                              if($reguser['eamil_auth_status']==1)
                              {$ver='Email Verified';$col='color:#00a65a';}
                              else{$ver='Email Not Verified';$col='color:#F70E31';}
                            ?>
                <tr style="<?php echo $col?>">
                  <td><?php echo $sn ?></td>
                  <td><?php echo $reguser['mm_user_full_name'] ?></td>
                  <td><?php echo $reguser['mm_user_email'] ?></td>
                  <td><?php echo date('F j , Y',strtotime($reguser['reg_date'])) ?></td>
                  <td><?php echo $ver?></td>
                </tr>
                <?php }?>
                       
                        </tbody>
                       
                    </table>
                    
                      <!--<a href="<?php echo base_url()?>new-register-user" style="float: right">View More</a>-->
                </div>
            </div>
        </div>
        
      <div class="col-md-12">
            <div class="box box-info">
              <div class="box-header with-border">
              <h3 class="box-title">Assignment Done</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="reload"><i class="fa fa-fw fa-refresh"></i></button>
              </div>
               <?php 
                for($i=0;$i<sizeof($permission_array);$i++){
                    $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
                    if($p["permission_description"]=="Export"){

              ?>
                <input type="button" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E;margin-right: 60px;" onclick="tableToExcel('example3', 'Excel Report');" value="Export to Excel" />
                <?php }} ?>

            </div>
                <div class="box-body table-responsive">
                    <table id="example3" class="table table-bordered table-hover">
                        <thead>
                            <tr >
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Assignment Name</th>
                  <th>Completed date</th>
                  
                </tr>
                        </thead>
                        <tbody>
                          <?php  $er=0;foreach($assign_user_data as $asigndone){ $er++;?>
                           <tr>
                  <td><?php echo $er?></td>
                  <td><?php echo $asigndone['mm_user_full_name'] ?></td>
                  <td><?php echo $asigndone['mm_user_email'] ?></td>
                  <td><?php echo $asigndone['assignment_name']; ?></td>
                  <td><?php  echo date('F j , Y',strtotime($asigndone['end_time'])); ?></td>
                </tr>
                        <?php }?>
                         
                        </tbody>
                    </table>
                </div>
            </div>
        
      </div>
    </div>
   
       <div class="row" style="display:none">
        <div class="col-md-12">
            <div class="box box-info">
              <div class="box-header with-border">
              <h3 class="box-title"><a href="<?php echo base_url()?>recent-uploaded-assignment">Completed Level</a></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="reload"><i class="fa fa-fw fa-refresh"></i></button>
              </div>
               <?php 
                for($i=0;$i<sizeof($permission_array);$i++){
                    $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
                    if($p["permission_description"]=="Export"){

               ?>
                <input type="button" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E;margin-right: 60px;" onclick="tableToExcel('example4', 'Excel Report');" value="Export to Excel" />
                <?php }} ?>
            </div>
                <div class="box-body table-responsive">
                    <table id="example4" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                              <th>#</th>
                  <th>Name</th>
                  <th>Assignment</th>
                  <th>Level</th>
                  <th>Date</th>
                  <th>Status</th>
                  
                </tr>
                        </thead>
                        <tbody>
                          <?php $rt=0; foreach($goingon_assign_user_data as $gouserdaassign){ $rt++;
                               $maid=$gouserdaassign['maid'];
                               $uid=$gouserdaassign['mm_uid'];
                                      $goingon_lvl_user_data=$this->Admindashboard_modal->all_completed_level_with_user($maid,$uid);
                                    $df=   date('F j,Y',strtotime($goingon_lvl_user_data[count($goingon_lvl_user_data)-1]['end_time']));
                                      if($df=='January 1,1970'){$fg='NA';$lvl='Going On';}else{ $fg=$df; $lvl='Level Completed';}
                                      ?>
                           <tr style="color:#00a65a">
                  <td><?php echo $rt?></td>
                 <td><?php echo $gouserdaassign['mm_user_full_name'] ?></td>
                 
                   <td><?php echo $gouserdaassign['assignment_name'] ?></td>
                  <td><?php echo $goingon_lvl_user_data[count($goingon_lvl_user_data)-1]['lvl_name'] ?></td>
              <td><?php echo $fg?></td>
                  <td><?php echo $lvl?></td>
                 
                  
                </tr>
                           <?php }?>
                          
                        </tbody>
                    </table>
                   <a style="float: right" href="<?php echo base_url()?>recent-uploaded-assignment">view more</a>
                </div>
            </div>
        </div>
       </div>
    
         <div class="row" style="display:none">
        <div class="col-md-6">
            <div class="box box-info">
              <div class="box-header with-border">
              <h3 class="box-title"><a href="<?php echo base_url()?>view-allcaf-users">View CAF</a></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="reload"><i class="fa fa-fw fa-refresh"></i></button>
              </div>
            </div>
                <div class="box-body table-responsive">
                    <table id="example5" class="table table-bordered table-hover ">
                        <thead>
                           <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contact No</th>
                  <th>Registration Date</th>
                </tr>
                        </thead>
                         <?php $sn=0; foreach($user_data as $reguser){
                             $sn++;
                              if($reguser['eamil_auth_status']==1)
                              {$ver='Email Verified';$col='color:#00a65a';}
                              else{$ver='Email Not Verified';$col='color:#F70E31';}
                            ?>
                <tr style="<?php echo $col?>">
                  <td><?php echo $sn; ?></td>
                  <td><?php echo $reguser['mm_user_full_name']; ?></td>
                  <td><?php echo $reguser['mm_user_email']; ?></td>
                  <td><?php echo $reguser['contact_number']; ?></td>
                  <td><?php echo $ver?></td>
                </tr>
                <?php }?>
                          
                        
                        </tbody>
                    </table>
                    <a href="<?php echo base_url()?>view-allcaf-users" style="float: right">View More</a>
                
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
              <div class="box-header with-border">
              <h3 class="box-title"><a href="<?php echo base_url()?>view-allcaf-users">Score</a></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="reload"><i class="fa fa-fw fa-refresh"></i></button>
              </div>
            </div>
                <div class="box-body table-responsive">
                    <table id="example44" class="table table-bordered table-hover ">
                          <thead>
                           <tr>
                    <th>#</th>
                  <th>Name</th>
                  <th>Assignment</th>
                   <th>Level</th>
                  <th>Score</th>
                  <th>View more</th>
                </tr>
                        </thead>
                        <tbody>
                        <?php $a=0; foreach ($score as $sc) {
                          $a++;?>
                       
                  <tr>
                   <td><?php echo $a;?></td>
                  <td><?php echo $sc['mm_user_full_name'];?></td>
                  <td><?php echo $sc['assignment_name'];?></td>
                    <td><?php echo $sc['lvl_name'];?></td>
                  <td><?php echo $sc['total_score'];?></td>
                  <td><a href="<?php echo base_url().'user-score/'.$sc['score_id'];?>">view more</a></td>
                </tr>  
                <?php }?> 
                 </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
   
    </section></div>


<script>

$('.uerdate').click(function(){
  var dateval = $(this).attr('data-date');
  if(dateval!=''){
    $('input[name="userdate"').val($(this).attr('data-date'));
    $('#datewise').submit();
  }
});
  $(function () {
    $("#example1").DataTable();
     $("#example2").DataTable();
      $("#example3").DataTable();
        $("#example4").DataTable();
          $("#example5").DataTable();
          $("#userdatas").DataTable();
          $("#example44").DataTable();
          $("#testtable2").DataTable();
          
  });
  var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
$('#usertype').change(function(){
  $('#filtercheck').submit();
});

$('.old_user').click(function(){
 var dateval = $(this).attr('data-date');
 //alert(dateval);
 if(dateval!=''){
   $('input[name="olduser_date"').val($(this).attr('data-date'));
   $('#datewise_olduser').submit();
 }
});

$(document).ready(function() {
 $(".datecalender").click(function (){
  // alert("hai");
     $(this).datepicker("show").on('change', function () {
       $('.datepicker').hide();
   });
 });
});
$(document).ready(function (){
 $("#search_button").click(function() {
   //Search_form
   $("#Search_form").submit();
 });
});
    $(document).ready(function(){
          $(document).on('click',".idleuser",function(){
              $.ajax({
                      type: 'GET',
                      url: "<?php echo base_url().'get-idle-user'?>",
                      success:function(data){
                        $(".idleuser").attr("href", "<?php echo base_url() ?>not-attempt-lists");
                         $('.idleuser').attr('target', '_blank');
                        $(".idleuser").text(data);
                         //alert(data);
                      }
                  });
          });
      });
    $(document).ready(function(){
          $(document).on('click',".oneweak_idleuser",function(){
              $.ajax({
                      type: 'GET',
                      url: "<?php echo base_url().'get-idle-user-a-week'?>",
                      success:function(data){
                        $(".oneweak_idleuser").attr("href", "<?php echo base_url() ?>test_val");
                         $('.oneweak_idleuser').attr('target', '_blank');
                        $(".oneweak_idleuser").text(data);
                         //alert(data);
                      }
                  });
          });
      });
    $(document).ready(function(){
          $(document).on('click',".completed",function(){
              $.ajax({
                      type: 'GET',
                      url: "<?php echo base_url().'completed-user'?>",
                      success:function(data){
                        $('.completed').css('cursor', 'default');
                        $('.completed').css('text-decoration', 'none');
                        $(".completed").text(data);
                      }
                  });
          });
      });
 $(document).ready(function(){
          $(document).on('click',".total_neuron",function(){
            $.ajax({
                      type: 'GET',
                      url: "<?php echo base_url().'get-system-neuron'?>",
                      success:function(data){
                        $('.total_neuron').css('cursor', 'default');
                        $('.total_neuron').css('text-decoration', 'none');
                        $(".total_neuron").text(data);
                      }
                  });
          });
      });
 $(document).ready(function(){
          $(document).on('click',".consultant",function(){
            $.ajax({
                      type: 'GET',
                      url: "<?php echo base_url().'get-consultant'?>",
                      success:function(data){
                        $('.consultant').css('cursor', 'default');
                        $('.consultant').css('text-decoration', 'none');
                        $(".consultant").text(data);
                      }
                  });
          });
      });
 $(document).ready(function(){
          $(document).on('click',".student",function(){
            $.ajax({
                      type: 'GET',
                      url: "<?php echo base_url().'get-student'?>",
                      success:function(data){
                        $('.student').css('cursor', 'default');
                        $('.student').css('text-decoration', 'none');
                        $(".student").text(data);
                      }
                  });
          });
      });
 $(document).ready(function(){
          $(document).on('click',".notverified",function(){
            $.ajax({
                      type: 'GET',
                      url: "<?php echo base_url().'get-not-verified-user'?>",
                      success:function(data){
                        $('.notverified').css('cursor', 'default');
                        $('.notverified').css('text-decoration', 'none');
                        $(".notverified").text(data);
                      }
                  });
          });
      });
 $(document).ready(function(){
          $(document).on('click',".verified",function(){
            $.ajax({
                      type: 'GET',
                      url: "<?php echo base_url().'get-verified-user'?>",
                      success:function(data){
                        $('.verified').css('cursor', 'default');
                        $('.verified').css('text-decoration', 'none');
                        $(".verified").text(data);
                      }
                  });
          });
      });
  $(document).ready(function(){
          $(document).on('click',".user-data",function(){
            $.ajax({
                      type: 'GET',
                      url: "<?php echo base_url().'get-user'?>",
                      success:function(data){
                        $('.user-data').css('cursor', 'default');
                        $('.user-data').css('text-decoration', 'none');
                        $(".user-data").text(data);
                      }
                  });
          });
      });

</script>