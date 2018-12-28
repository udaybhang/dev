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
    margin-top: 35px;
    width: 
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="row main">
    <div class="col-md-12">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
        <section class="invoice show">
          <!-- title row -->
          <div class="row" style="background-color: #587EA3">
            <div class="col-md-12">
              <h2 class="lel">Candidate Assignment 
              </h2> 
            </div>
          </div>
          <div class="clearfix" style="margin-top: 20px;">
          </div>
          <div class="">
            <div class="col-md-12">
            </div>
          </div>
          <!-- /.box-header -->
          <div class="clearfix">
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="box box-col">
                <div class="box-header">
                  <form action="<?php echo base_url()?>checked-subjective-score" method="post" id="assform">
                    <div class="col-md-3">
                    <select name="pkgid" class="form-control" id="changepkg">
                      <option value="">Select Package</option>
                      <?php
                        foreach ($grouppackages as $grouppackage) {
                      ?> 
                        <option value="<?php echo $grouppackage['package_id']?>" <?php if($grouppackage['package_id']==$pkgid){ echo 'selected="selected"';} ?>><?php echo $grouppackage['package_name']?></option>
                      <?php
                        }
                      ?>
                    </select>
                    </div>
                    <div class="col-md-3">
                    <?php
                     if(isset($groupassigns)){
                    ?>
                    <select name="maid" id="changeassign" class="form-control">
                      <option value="">Select Assignment Name</option>
                      <?php foreach($groupassigns as $result) {
                      if($result['maid']==$maid)
                      {
                      $sle='selected="selected"';
                      }else{
                      $sle='';
                      }
                      ?>
                      <option value="<?php echo $result['maid'] ?>" <?php echo $sle;?>><?php echo $result['assignment_name'] ?></option>
                    <?php }?>
                    </select>
                    <?php
                      }
                    ?>
                    </div>
                   <div class="col-md-3 pull-right">
                    <?php 
                      $permission_array=$this->session->userdata('permission_array');
                      for($i=0;$i<sizeof($permission_array);$i++){
                          $p =$this->Crud_modal->fetch_single_data('*','master_permission',"permission_id='$permission_array[$i]'");
                          if($p["permission_description"]=="Export"){

                    ?>
                      <input type="button" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E;" onclick="tableToExcel('userdatas', 'Excel Report');" value="Export to Excel" />
                    <?php }} ?>
                    </div>
                  </form>
              </div>
            </div>
            <table class="table table-striped table-responsive" id="userdatas">
              <thead>
                <tr>
                  <th>S.No
                  </th>
                  <th>Name
                  </th>
                  <th>Email
                  </th>
                  <th>Level Name
                  </th>
                  <th>Score
                  </th>
                  <th>Attempted</th>
                  <th>Assigned</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php 
$Y=1;  foreach($subjectives_ans as $subjective_ans){
					$uids = $subjective_ans['u_id'];
					$cids = $subjective_ans['case_id'];
                  	$maids=$subjective_ans['maid'];
                  	$mlids=$subjective_ans['ml_id'];
					$userdata = $this->Crud_modal->fetch_single_data('mm_user_full_name,mm_user_email','user',"mm_uid='$uids'");
					$casedata = $this->Crud_modal->fetch_single_data('lvl_name','master_level',"ml_id='$mlids'");
          $scoredata=$this->Crud_modal->fetch_single_data('created_date,modified_date,score','score',"u_id='$uids' AND level_id='$mlids' AND maid='$maids'");
          $scrval = explode(',', $scoredata['score']);
          $subscore = 0;
          for($si=1;$si<sizeof($scrval);$si++){
            $subscore+=$scrval[$si];
          }
?>	
                <tr>
                  <td>
                    <?php echo $Y;?>.
                  </td>
                  <td>
                    <?php echo $userdata['mm_user_full_name'] ?>
                  </td>
                  <td>
                    <?php echo $userdata['mm_user_email'] ?>
                  </td>
                  <td>
                    <?php echo $casedata['lvl_name'] ?>
                  </td>
                  <td>
                    <?php echo $subscore ?>
                  </td>
                  <td><?php if($scoredata['created_date']!="0000-00-00 00:00:00"){ echo date("d F Y",strtotime($scoredata['created_date']));}else{ echo '00:00 00-00-0000';} ?></td>
                  <td><?php if($scoredata['modified_date']!="0000-00-00 00:00:00"){ echo date("d F Y",strtotime($scoredata['modified_date']));}else{ echo '00:00 00-00-0000';} ?></td>
                  <?php 
                    $qurstr1=rtrim(strtr(base64_encode($uids), '+/', '-_'), '=');//User Id
                    $qurstr2=rtrim(strtr(base64_encode($cids), '+/', '-_'), '=');//Case Id
                    $qurstr3=rtrim(strtr(base64_encode($maids), '+/', '-_'), '=');//Assignment Id
                    $qurstr5=rtrim(strtr(base64_encode($mlids), '+/', '-_'), '=');//Level Id
                    $qurstr6=rtrim(strtr(base64_encode($pkgid), '+/', '-_'), '=');//Package Id
                  ?>
                  <td>
                    <a href="<?php echo base_url();?>subjective-checked-user-score/<?php echo $qurstr1.'-'.$qurstr2.'-'.$qurstr3.'-'.$qurstr5.'-'.$qurstr6 ?>">view more
                    </a>
                  </td>
                </tr>
                <?php $Y++; } ?>
              </tbody>
            </table>
          </div>
          </div>
        </section>
    </div>
    <div class="col-md-1">
    </div>
  </div>
</div>
<!-- /.content -->
<div class="clearfix">
</div>
</div>
<script>
  $(function () {
    $("#userdatas").DataTable();
    $('#').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  }
   );

  $('#changeassign').change(function(){
    $('#assform').submit();
  });
  $('#changepkg').change(function(){
  	$('#changeassign').find('option[value=""]').attr('selected','selected');
    $('#assform').submit();
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
</script>
