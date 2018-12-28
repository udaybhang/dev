<style>
  .invoice {
    position: relative;
    background: #fff;
    border: 1px solid #f4f4f4;
    padding: 0px 16px;
    margin: 114px 25px;
    padding-bottom: 20px;
  }
  table>thead>tr>th {
    border-bottom:1px solid #ecf0f5;
  }
  .show {
    -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  }
  .table>thead>tr>th,
  .table>tbody>tr>th,
  .table>tfoot>tr>th,
  .table>thead>tr>td,
  .table>tbody>tr>td,
  .table>tfoot>tr>td {
    border: 1px solid #ecf0f5;
  }
  .box-col
{
  border-top: 3px solid #112B4E;
}
  .lel {
    color: #fff;
    text-align: center;
    margin-bottom: 7px;
    margin-top: 7px;
  }
  .table > caption + thead > tr:first-child > td,
  .table > caption + thead > tr:first-child > th,
  .table > colgroup + thead > tr:first-child > td,
  .table > colgroup + thead > tr:first-child > th,
  .table > thead:first-child > tr:first-child > td,
  .table > thead:first-child > tr:first-child > th {
    border: 1px solid #fafafa;
  }
   .dd-mar{
          margin-left: -27px;
   }
   .btn-col
   {
          background-color: #112B4E;
    border-color: #ecf0f5;
   }
   .ul-mar{
  margin-top: 35px; width: 
   }

   /* Sohrab 29 apr 2017 */
   .danger{
    background-color: #f2dede;
      border-color: #ebccd1;
      color: #a94442;
    text-align: center;
    margin:auto;
    margin-bottom: 15px;
    margin-top: 30px;
    padding: 10px;
    width: 50%;
    box-shadow: 0px 0px 10px #ebccd1;
    }
  .success{
    background-color: #dff0d8;
    border-color: #d6e9c6;
    color: #3c763d;
    text-align: center;
    margin:auto;
    margin-bottom: 15px;
    margin-top: 30px;
    padding: 10px;
    width: 50%;
    box-shadow: 0px 0px 10px #d6e9c6;
      }

  .assignlink, .editassignlink{
    color: #3c8dbc;
    cursor: pointer;
  }
  .assignlink:hover,.assignlink:active,.assignlink:focus, .editassignlink:hover, .editassignlink:active, .editassignlink:focus {
    outline:none;
    text-decoration:none;
    color:#72afd2
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  
  <div class="row main">
    <div class="col-md-13">
      <?php
        if($this->session->flashdata('job_message')){
          echo $this->session->flashdata('job_message');
        }
        ?>
      <div class="col-md-1">
        
      </div>
      <div class="col-md-16">
        <div class="col-md-10">
               
        </div>
        <section class="invoice show">
          <!-- title row -->
          <div class="row" style="background-color: #587EA3">
            <div class="col-md-12">
              <h2 class="lel">Group List</h2> </div>
          </div>
          <div class="clearfix" style="margin-top: 20px;"></div>
          <div class="">
            <div class="col-md-12">
              
            </div>
          </div>
          <!-- /.box-header -->
            <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12">
              <?php 
                                   $permission_array=$this->session->userdata('permission_array');
                                    for($i=0;$i<sizeof($permission_array);$i++){
                                      $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
                                      if($p["permission_description"]=="Export"){

              ?>
              <div class="box box-col">
              <div class="box-header">
                <div class="col-md-12">
                  <input type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" onclick="tableToExcel('testtable2', 'Employer Record Table');" value="Export to Excel" />
                </div>
              </div>
              </div>
              <?php }} ?>
              <div class="table-responsive"> 
              <table class="table table-striped" id="testtable2">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Group Name</th>
                    <th>Leader Name</th>
                    <th>Total Members</th>
                    <th>Neurons</th>
                    <th>Edit/Delete</th>
                  </tr>
                </thead>
                <tbody id="alldatas">
              <?php
               foreach ($leaderboard_lists as $msqlists) {?>
              <tr>
                <td><?php echo $a+1 ?>.</td>
                 <td><?php if($msqlists['modified_date']=='0000-00-00 00:00:00'){ echo $msqlists['created_date'];}else{ echo $msqlists['modified_date'];} ?></td>
                <td>
                  <?php 
                                   $permission_array=$this->session->userdata('permission_array'); $flag=0;
                                    for($i=0;$i<sizeof($permission_array);$i++){
                                      $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
                                      if($p["permission_description"]=="View"){
                                        $flag=1;
                                      }
                                    }

                  ?>
                  <a href="<?php if($flag==1){echo base_url().'view-member-report/'.$msqlists['group_id'];}else{echo '#';} ?>"><?php echo $msqlists['group_name'] ?></a>
                 
                </td>
                <td><?php $leader_name=$this->Crud_modal->fetch_single_data('*',"user","mm_uid='$msqlists[group_leader_uid]'");  echo $leader_name['mm_user_full_name']; ?></td>
                <td><?php $v=$msqlists['group_id']; $member_list=$this->Crud_modal->all_data_select("*","mm_group_members","group_id='$v' and status='1'","group_member_id desc");
                    echo (sizeof($member_list)+1); ?></td>
                <td><?php 
                $leader_neurons=$this->Crud_modal->fetch_single_data('*',"neurons","u_id='$msqlists[group_leader_uid]'");
                $data_neurons=$this->Userdashboard_modal->group_neurons($msqlists['group_id']); echo $data_neurons[0]['tot']+($leader_neurons['neurons']); ?></td>
  <td>
    <?php 
                                   $permission_array=$this->session->userdata('permission_array');
                                    for($i=0;$i<sizeof($permission_array);$i++){
                                      $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
                                      if($p["permission_description"]=="Edit"){

    ?>
    <a href="<?php echo base_url().'group-edit/'.rtrim(strtr(base64_encode($msqlists['group_id']), '+/', '-_'), '='); ?>">&nbsp;Edit&nbsp;</a>
    <?php }if($p["permission_description"]=="Delete"){ ?>
    <a  href="" class="delete" data-index="<?php echo rtrim(strtr(base64_encode($msqlists['group_id']), '+/', '-_'), '='); ?>">&nbsp;Delete&nbsp;</a>
    <?php }} ?>
  </td>


  <!-- href="<?php //echo base_url().'group-delete/'.rtrim(strtr(base64_encode($msqlists['group_id']), '+/', '-_'), '='); ?>" -->
              </tr>
              <?php
              $a++;
              }
              ?>
              
        
                </tbody>

              </table>
              </div>
            </div>
          </div>
        </section>
      </div>
      <div class="col-md-1"></div>

    </div>
  </div>
  <!-- /.content -->
  <div class="clearfix"></div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="top: 20%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Are you sure want to delete?</h4>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default deletassign" id="">Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog" style="top: 10%;">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Assignment</h4>
        </div>
        <div class="box box-primary">
          <div class="box-header with-border">
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="<?php echo base_url() ?>assign-update" method="post" enctype="multipart/form-data">
            <div class="box-body">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="exampleInputname">Assignment Number<span  class="required-sp">*</span></label>
                    <input type="text" class="form-control" name="assignment_number" id="assignment_number" value=""  placeholder="Assignment Number" maxlength="30" readonly="">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="exampleInputname">Assignment Type<span  class="required-sp">*</span></label>
                    <select name="assignment_type" id="assignment_type" class="form-control"></select>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="exampleInputname">Assignment Name<span  class="required-sp">*</span></label>
                    <input type="text" class="form-control" id="assignment_name" name="assignment_name" value=""  placeholder="Assignment Name" maxlength="80" required="">
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label>No of levels</label>
                    <select name="assign_lvl" id="assign_lvl" class="form-control select2" style="width: 100%;"></select>
                  </div>
                  <!-- /.form-group -->
                </div>
              
                
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="exampleInputname">Start Date<span  class="required-sp">*</span></label>
                    <input type="text" class="form-control start_date" name="start_date" id="startdate_11" value="" placeholder="Start Date" >
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="exampleInputname">Assignment Image</label>
                    <input type="file" class="form-control " name="image"  >
                    <input type="hidden" class="form-control " name="previous_image"  id="previous_image" value="">
                  </div>
                </div>
                
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Assignment Description</label>
                    <textarea name="assignment_description" id="assignment_description" class="form-control" style="height: 100px;"></textarea>
                  </div>
                <!-- /.form-group -->
                </div>
              </div>
              <!-- /.col-lg-6 -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button style="float:right" type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
          <!-- form END -->
          <!-- /.box -->
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  
  $(function () {
   
   $("#01").DataTable();
  $("#testtable2").DataTable();
    $('#').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });

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
      $(document).ready(function(){
          $(document).on('click',".delete",function(){
              var res = confirm("Are you sure you want delete it");
              if(res==true){
                 var a = $(this).attr("data-index"); 
                  $.ajax({
                      type: 'GET',
                      url: "<?php echo base_url().'group-delete/'?>"+a,
                      success:function(data){
                         
                      }
                  });
              }else{
                return false;
              }
          });
      })()
</script>