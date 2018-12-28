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
   .danger{
  background-color: #f2dede;
    border-color: #ebccd1;
    color: #a94442;
  text-align: center;
  margin:auto;
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
  margin-top: 30px;
  padding: 10px;
  width: 80%;
  box-shadow: 0px 0px 10px #d6e9c6;
}
ul.tsc_pagination li a
{
border:solid 1px;
border-radius:3px;
-moz-border-radius:3px;
-webkit-border-radius:3px;
padding:6px 9px 6px 9px;
}
ul.tsc_pagination li
{
padding-bottom:1px;
}
ul.tsc_pagination li a:hover,
ul.tsc_pagination li a.current
{
color:#FFFFFF;
box-shadow:0px 1px #EDEDED;
-moz-box-shadow:0px 1px #EDEDED;
-webkit-box-shadow:0px 1px #EDEDED;
}
ul.tsc_pagination
{
margin:4px 0;
padding:0px;
height:100%;
overflow:hidden;
font:12px 'Tahoma';
list-style-type:none;
}
ul.tsc_pagination li
{
float:left;
margin:0px;
padding:0px;
margin-left:5px;
}
ul.tsc_pagination li a
{
color:black;
display:block;
text-decoration:none;
padding:7px 10px 7px 10px;
}
ul.tsc_pagination li a img
{
border:none;
}
ul.tsc_pagination li a
{
color:#0A7EC5;
border-color:#8DC5E6;
background:#F8FCFF;
}
ul.tsc_pagination li a:hover,
ul.tsc_pagination li a.current
{
text-shadow:0px 1px #388DBE;
border-color:#3390CA;
background:#58B0E7;
background:-moz-linear-gradient(top, #B4F6FF 1px, #63D0FE 1px, #58B0E7);
background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #B4F6FF), color-stop(0.02, #63D0FE), color-stop(1, #58B0E7));
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  
  <div class="row main">
    <div class="col-md-12">
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <?php
        if($this->session->flashdata('job_message')){
          echo $this->session->flashdata('job_message');
        }
        ?>
        <section class="invoice show">
          <!-- title row -->
          <div class="row" style="background-color: #587EA3">
            <div class="col-md-12">
              <h2 class="lel">Group Members</h2> </div>
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
                   <div class="box box-col">
        <div class="box-header with-border">
          <div class="col-md-6"><input type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" onclick="tableToExcel('testtable2', 'user score data');" value="Export to Excel" />
          </div>
      <div id="resultStats" style="margin-top: 5px!important;" class="col-md-12"></div>
        </div>
      </div>
              <table class="table table-striped table-responsive" id="testtable2">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Total Neurons</th>
                    <th>Certification</th>
                    <th>Last Login</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody id="alldatas">
              <?php
              $a=0;
               foreach ($leaderboard_lists as $msqlists) {?>
              <tr>
                <td><?php echo ($a+1); ?>.</td>
                 <td><?php $u_id=$msqlists['user_id']; if($msqlists['modified_date']=='0000-00-00 00:00:00'){ echo $msqlists['created_date'];}else{ echo $msqlists['modified_date'];} ?></td>
                <td><a href="<?php echo base_url(); ?>member_neurons/<?php echo $u_id ?>"><?php  $user_name=$this->Crud_modal->fetch_single_data("*","user","mm_uid='$u_id'");echo $user_name['mm_user_full_name']; ?></a></td>
                <td><?php  echo $user_name['mm_user_email']; ?></td>
                <td><?php  $data_neurons=$this->Crud_modal->fetch_single_data("*","neurons","u_id='$u_id'"); if($data_neurons['neurons']==''){echo '0';}else{ echo $data_neurons['neurons']; } ?></td>
                <td><?php 
                $data_certi=$this->Crud_modal->check_numrow("mm_certificate_log","uid='$uid'");echo $data_certi; ?></td>
                <td><?php $last_login=$this->Crud_modal->all_data_select("*","user_login_status","status='1' and uid='$u_id'","uls_id DESC"); echo $last_login[0]['login_time']; ?></td>
<td><span class="leave_group" style="color:blue;" data-id="<?php echo $u_id; ?>">Delete</span></td>
              </tr>
              <?php
              $a++;
              }
              ?>
               <tr style="font-weight: bold;">
                <td><?php echo $a+1; ?>.</td>
                 <td><?php $data_id=$this->Crud_modal->fetch_single_data("*","mm_group","group_id='$group_id'");  $u_id=$data_id['group_leader_uid']; $user_name=$this->Crud_modal->fetch_single_data("*","user","mm_uid='$u_id'"); echo $user_name['reg_date']; ?></td>
                <td><a href="<?php echo base_url(); ?>member_neurons/<?php echo $u_id ?>"><?php  echo $user_name['mm_user_full_name']; ?></a><span class="label label-danger pull-right">Leader</span></td>
                <td><?php  echo $user_name['mm_user_email']; ?></td>
                <td><?php  $data_neurons=$this->Crud_modal->fetch_single_data("*","neurons","u_id='$u_id'"); if($data_neurons['neurons']==''){echo '0';}else{ echo $data_neurons['neurons']; } ?></td>
                <td><?php 
                $data_certi=$this->Crud_modal->check_numrow("mm_certificate_log","uid='$uid'");echo $data_certi; ?></td>
                <td><?php $last_login=$this->Crud_modal->all_data_select("*","user_login_status","status='1' and uid='$u_id'","uls_id DESC"); echo $last_login[0]['login_time']; ?></td>
              </tr>
        
                </tbody>

              </table>
        <!--      <div id="pagination">
<ul class="tsc_pagination">
<?php foreach ($links as $link) {
echo "<li>". $link."</li>";
} ?>
</ul>
</div--> 
<style type="text/css">
  .pagination>li>p>a {
    background: #fafafa;
    color: #666;
}
.pagination>li>p>a{
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #337ab7;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
}
.pagination>li>p>strong {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #fff;
    text-decoration: none;
    background-color: #337ab7;;
    border: 1px solid #ddd;
}
a {
    color: #3c8dbc;
}
a {
    color: #337ab7;
    text-decoration: none;
}
</style>

              <div class="col-sm-7" style="float: right;">
                <div class="" >
                  <ul class="pagination">
                    <li class=""><p><?php echo $links; ?></p></li>
                  </ul>
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
<script src="<?php echo base_url()?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">

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
$(".leave_group").click(function(){
  var data=$(this).attr("data-id");
 var value=confirm("Do you really want to delete this member!");
 if(value==true){
     $.ajax({
    type: "POST",
    data:{"user_id":data},
    url: "<?php echo base_url()?>leave-group-admin",
    success: function(data){
      window.location.href="<?php echo base_url()?>view-member-report/<?php echo $data_id['group_id']; ?>";
    }
  });
 }
});
</script>

