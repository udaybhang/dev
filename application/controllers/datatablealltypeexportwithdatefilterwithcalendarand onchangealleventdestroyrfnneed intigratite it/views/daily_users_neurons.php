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
   /* Sohrab 30 apr 2017 */
   .danger{
    background-color: #f2dede;
      border-color: #ebccd1;
      color: #a94442;
    text-align: center;
    margin:auto;
    margin-bottom: 15px;
    margin-top: 30px;
    padding: 10px;
    width: 80%;
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
    width: 80%;
    box-shadow: 0px 0px 10px #d6e9c6;
      }
      #levellist>div{
        height: 34px;
        line-height: 34px;
        margin-bottom: 5px;
        padding:0px;
      }
      #levellist>div.col-md-3{
        font-weight: 700;
      }
.uerdate{
  text-decoration: underline; color: #3c8dbc ; cursor: pointer;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  
  <div class="row main">
    <div class="col-md-12">
      <div class="col-md-12">
        <div class="col-md-12">
                <?php
                if($this->session->flashdata('topic_insert_message')){
                  echo $this->session->flashdata('topic_insert_message');
                }
                ?>
        </div>
        <section class="invoice show">
          <!-- title row -->
          
          <!-- /.box-header -->
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12">
              
               <section class="content">

      <!-- SELECT2 EXAMPLE -->

      <!-- /.box -->

<div class="col-md-12">
            <div class="box box-info">
              <div class="box-header with-border">
              <h3 class="box-title">New Registered User's Neurons</h3>
              <div class="col-md-12">
              <div class="col-md-4 col-md-offset-4">
    
          </div>
          <div class="col-md-4"><input type="button" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E;" onclick="tableToExcel('userdatas', 'Excel Report');" value="Export to Excel" /></div>
          </div>
        
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="reload"><i class="fa fa-fw fa-refresh"></i></button>
              </div>
            </div>
            <div class="col-md-12" style="margin-top:8px">
              <form action="<?php echo base_url() ?>show-new-users-neurons" method="post" id="Search_form">
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
         </div></div>
                <div class="box-body table-responsive">
                    <table class="table table-striped table-responsive" id="userdatas">
                <thead>
          <tr>
                  <th>S.No.</th>
                  <th>Date</th>
                  <th>New User</th>
                  <th>Attempted Level</th>
                  <th>Neurons</th>
                  <th>Total Neurons</th>
                  
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
          <td><span class="uerdate" data-date="<?php echo $all_date['date']; ?>"><?php echo $all_date['user']; ?></span></td>
          <td><?php echo $all_date['old_assignment']; ?></td>
          <td><?php if($all_date['new_neuan']>0){echo $all_date['new_neuan'];}else{ echo 0;} ?></td>
          <td><?php echo $all_date['neurons']; ?></td>
          
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
                </div>
            </div>
        </div>
              <div class="col-md-12" id="alldataexcel" style="display: none;"></div>
    </section>
    <!-- /.content -->
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
<script type="text/javascript">

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

$('.uerdate').click(function(){ 
  var dateval = $(this).attr('data-date');
  if(dateval!=''){
    $('input[name="userdate"').val($(this).attr('data-date'));
    $('#datewise').submit();
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
</script>
