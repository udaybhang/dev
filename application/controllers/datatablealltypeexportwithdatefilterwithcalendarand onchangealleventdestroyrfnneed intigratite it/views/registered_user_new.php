  <?php  $base_url=base_url().'admin_assets/';?>
<style type="text/css">
  a[data-ci-pagination-page]{
    padding: 5px 10px 5px 10px;
    width: 25px;
    height:20px;
    background: #ddd;
    margin:1px;
    color:#000;
  }
</style>
<div class="wrapper">
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Users
        <small>List of registered users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url()?>admin-home"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <!-- search start from here -->
              
                   <div class="col-md-12">
                     <form action="<?php echo base_url() ?>registered-user-new" method="post" id="sssss" autocomplete="off">
                     <div class="col-md-3">
                        <label style="float:left">Start Date : </label>
                        <div class="col-md-7">
                        <input type="text" class="form-control datecalender" name="fromdate" value="<?php if($f_date !=''){ echo $f_date;}?>"/>
                        </div>
                     </div>
                     <div class="col-md-3">
                      <label style="float: left">End Date : </label>
                      <div class="col-md-7">
                        <input type="text" class="form-control datecalender" name="todate" value="<?php if($t_date !=''){ echo $t_date;}?>"/>
                      </div>
                     </div>
                     <div class="col-md-2">
                       <!--  <input type="button" class="btn btn-primary btn-md"  id="search_button" value="Search"> -->
                       <select name="nor" id="nor" class="form-control">
                            <option value="10" <?php if($tsearch==10){ echo "selected='selected'"; }?>>10 records</option>
                            <option value="20" <?php if($tsearch==20){ echo "selected='selected'"; }?>>20 records</option>
                            <option value="30" <?php if($tsearch==30){ echo "selected='selected'";}?>>30 records</option>
                            <option value="50" <?php if($tsearch==50){ echo "selected='selected'";}?>>50 records</option>
                          </select>
                          <input type="hidden" name="pageh" id="pageh">
                     </div>
                    </form>
                    <div class="col-md-2">
                        <input type="button" class="btn btn-primary btn-md"  id="submit" value="Search">
                    </div>
                  </div>
              <!-- search end from here -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
									<th>Sr.no </th>
									<th>Name</th>
                  <th>Father Name</th>
                  <th>Dob</th>
                  <th>Present Address</th>
                  <th>Contact Number</th>
                  <th>Highest Qualification</th>
				          <th>State & City</th>
				          <th>Reg.Date</th>
                </tr>
                </thead>
                <tbody>
								<?php  $sr=$row;foreach($result as $mmprofile){ $sr++;
                       $uid=$mmprofile['mm_uid'];
                       $where="`uid`='$uid'";
                       $name=$this->Crud_modal->all_data_select('*','user_data',$where,'uid asc');
                      // print_r($name); 
                       $all_state=$this->Userdashboard_modal->state_name_withid($name[0]['state']);
                       $all_city=$this->Userdashboard_modal->cityname_with_cityid($name[0]['city']);
                        if($name[0]['dob']=='0000-00-00'){
                          $dob='NA';
                        }
                        else{
                           $dob= date('F j,Y',strtotime($name[0]['dob']));
                          }
                        if($all_state['name']=='' || $all_state['name']==null)
                        {
                           $state='NA';
                        }
                        else{
                             $state=$all_state['name']. ' & ';
                        }
                  ?>
                <tr>
                  <td><?php echo $sr?></td>
                  <td><?php echo $mmprofile['mm_user_full_name']?></td>
                  <td><?php echo ucfirst($name[0]['father_name'])?></td>
                  <td><?php echo $dob; ?></td>
                  <td><?php echo $name[0]['present_addr']?></td>
                  <td><?php echo $name[0]['contact_number']?></td>
                  <td><?php echo $name[0]['high_q']?></td>
                  <td><?php echo $state . $all_city['name']?></td>
				  <td><?php if($mmprofile['reg_date']!="0000-00-00 00:00:00"){echo date("d/m/Y g:i A", strtotime($mmprofile['reg_date']));}else{echo "Not Available";} ?></td>
                </tr>
								<?php }?>
               
                </tfoot>
              </table>
              <p style="margin-top:10px"><?= $pagination; ?></p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>
 $(function () {

    $('#example1').DataTable({

      "paging": false,

      "lengthChange": false,

      "searching": true,

      "ordering": true,

      "info": true,

      "autoWidth": false

    });

  });

  $(document).ready(function() {
      $(".datecalender").click(function (){
          $(this).datepicker("show").on('change', function () {
            $('.datepicker').hide(); 
        });
      });
   });
 
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("a[data-ci-pagination-page]").click(function(e){
      
      e.preventDefault();
        var aval = $(this).attr('href');
        var s = aval.split('/'); 
        var w = parseInt(s[s.length-1]);
        
        if($.isNumeric(w)){
            var page = w;
            $('#pageh').val(page);
            $(this).attr("href", "");
            $('#sssss').submit();
        }else{
            $('#pageh').val(1);
            $('#sssss').submit();
        }
    });
    });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','#submit',function(){
           $('#sssss').submit();  
    });
  }); 
</script>