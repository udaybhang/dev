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
  #file_upload_css .fa,#add_file{
    cursor: pointer;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="row main">
    <div class="col-md-12">
      <div class="col-md-10 col-md-offset-1">
        <div class="col-md-12">
          <?php echo $this->session->flashdata('item');  ?>
        </div>
        <section class="invoice show">
          <!-- title row -->
          <div class="row" style="background-color: #587EA3">
            <div class="col-md-12">
              <h2 class="lel">Case Details
              </h2> 
            </div>
          </div>
          <!-- /.box-header -->
          <div class="clearfix">
          </div>
          <div class="row">
            <div class="col-md-12">
              <section class="content">
                <!-- SELECT2 EXAMPLE -->
                <div class="box box-col">
                  <div class="box-header with-border">
                    <h3 class="box-title">Case Details
                    </h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Case Name
                          </label>
                          <p>
                            <?php echo $case_value['case_name'] ?>
                          </p>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Case Content
                          </label>
                          <p>
                            <?php echo $case_value['content'] ?>
                          </p>
                        </div>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Case Topic
                          </label>
                          <?php
foreach ($type as $types) {
if($types['ml_id']==$case_value['level_id']){
?>
                          <p>
                            <?php echo $types['lvl_name']; ?>
                          </p>
                          <?php
}
}
?>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Audio File</label>
                          <div>
                            <?php  $audfile =explode('/', $case_value['audiofile']); echo $audfile[2]; ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Video File</label>
                          <div>
                           <?php  $vidfile =explode('/', $case_value['videofile']); echo $vidfile[2]; ?>
                          </div>
                        </div>
                      </div>
                      <?php
if($case_value['sample_file']!=''){
?>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>File List
                          </label>
                          <div>
                            <?php $filesize = explode(',',$case_value['sample_file']);
for($f=0;$f<sizeof($filesize);$f++){
$ran = rand(111111,999999);
$filename = explode('/',$filesize[$f]);
echo '<div class="row" id="'.$ran.'">';
echo '<div class="col-sm-11">';
echo '<p>'.$filename[1].'<p>';
echo '</div>';
echo '</div>';
}
?>
                          </div>
                        </div>
                      </div>
                      <?php
}
?>
                      <div class="col-md-12" style="margin: 10px 0px;">
                        <div class="form-group">
                          <label>Question Types
                          </label>
                          <div class="col-md-12">
                            <?php
$checklist = explode(',',$case_value['case_sequence']);
$quest_limit = explode(',',$case_value['quest_limit']);
for($qi=0;$qi<sizeof($checklist);$qi++){
?>
                            <div class="col-md-3">
                              <h4>
                                <?php
switch($checklist[$qi]) {
case 1:
echo 'MCQ';
break;
case 2:
echo 'Sequence';
break;
case 3:
echo 'Match the Following';
break;
case 5:
echo 'Fill in the Blank';
break;
case 6:
echo 'Subjective';
break;
}
?>
                              </h4>
                              <p>Question Limit : 
                                <?php echo $quest_limit[$qi]; ?>
                              </p>
                            </div>
                            <?php
}
?>
                          </div>
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                    <a href="<?php echo base_url() ?>case-list" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E">Back
                    </a>
                    <a href="<?php echo base_url().'edit-case/'.rtrim(strtr(base64_encode($case_value['case_id']), '+/', '-_'), '='); ?>" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E">Edit
                    </a>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </section>
              <!-- /.content -->
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
<script type="text/javascript">
  $(document).ready(function(){
    var fileid = 1;
    $("#add_file").click(function(){
      $("#file_upload_css").append('<div class="col-md-12 file_'+fileid+'" style="padding: 0px;"><div class="col-sm-4" style="padding: 0px;">Sample data </div><div class="col-sm-5"><input type="file" name="caseFiles[]" required="required" /></div><div class="col-sm-3"><i class="fa fa-minus" aria-hidden="true" id="'+fileid+'"></i></div></div>');
      fileid++;
      $(".fa-minus").click(function(){
        $(".file_"+$(this).attr("id")).remove();
      }
                          );
    }
                        );
    $(".fa-minus").click(function(){
      $("#file_"+$(this).attr("id")).remove();
    }
                        );
    $(".fileremove").click(function(){
      $("#"+$(this).attr("data-id")).remove();
    });
  });
</script>
