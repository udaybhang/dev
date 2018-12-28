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
  .btn-action{
    float: left;
    background: #112B4E;
    font-size: 14px;
    border-radius: 6px;
    padding: 10px 20px;
    text-align: center;
    color: #fff;
    cursor: pointer;
  }
  .clrred{
    background-color: #b87333;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="row main">
    <?php
if(isset($subjectives_ans)){
?>
    <div class="col-md-12">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
        <?php
if($this->session->flashdata('mcq_message')){
echo $this->session->flashdata('mcq_message');
}
?>
        <section class="invoice show">
          <!-- title row -->
          <div class="row" style="background-color: #587EA3">
            <div class="col-md-9">
              <h2 class="lel">
                <?php echo $userdata['mm_user_full_name'] ?>
              </h2> 
            </div>
			<div class="col-md-3" >
              <a href="<?php echo base_url()?>pending-submission-detail" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E ; border-color: #112B4E ; margin-top: 6px;">Back to Pending Case Study</a>
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
              <section class="content">
                <!-- SELECT2 EXAMPLE -->
                <div class="box box-col">
                  <form method="post" action="<?php echo base_url()?>subjective-score-submit">
                    <div class="box-header with-border">
                      <h3 class="box-title">
                      </h3>
                    </div>
					<input type="hidden" name="question_number" value="<?php echo sizeof($subjectives_ans)?>" />
                    <!-- /.box-header -->
                    <?php
                      $i=0;
                    	foreach ($subjectives_ans as $value) {

						$qids = $value['ques_id'];
						$mlids = $value['ml_id'];
						$uids = $value['u_id'];
						$questiondata = $this->Crud_modal->fetch_single_data('question,answer','subjective',"subjective_id='$qids'");
						$leveldata = $this->Crud_modal->fetch_single_data('p_id','master_level',"ml_id='$mlids'");
					?>
                    <div class="box-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <div>
                              <h3>Question <?php echo ++$i ?>
                              </h3>
                              <?php echo $questiondata['question'] ?>
                            </div>
                            <div>
                              <h3>Answer
                              </h3>
                              <?php echo $questiondata['answer'] ?>
                            </div>
                          </div>
                          <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <div>
                              <h3>User File
                              </h3>
                              <div class="btn-action <?php echo ($value['user_file']=="Skipped" ? "clrred" : "downld")?>" data-id="<?php echo $value['user_file'] ?>"><?php echo ($value['user_file']=="Skipped" ? "User Skiped The file" : "Download File")?>
                              </div>
                            </div>
                          </div>
                          <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                      </div>
                      <div class="row">
                      <?php
                        if($value['status']!=1){
                      ?>
                      <input type="hidden" name="cq_number[]" value="<?php echo $value['ques_id']?>" />
                        <div class="col-md-12">
                          <div class="form-group">
                            <div>
                              <h3>Assesment
                              </h3>
                            </div>
                            <?php
                						$pids = explode(',', $leveldata['p_id']);
            								$sizof=sizeof($pids);
            								$point=round($per_question_marks/($sizof-1));
									
                						foreach ($pids as $pid) {
                						$pnames = $this->Crud_modal->fetch_single_data('p_id,name','master_parameter',"p_id='$pid'");
                						if($pnames['p_id']!=1){
                						?>
                            <div class="col-md-12" style="padding:2px 0px;">
                              <div class="col-md-6" style="height: 34px; line-height: 34px;">
                                <?php echo $pnames['name']?>
                              </div>
                              <div class="col-md-6">
                                <select class="form-control" name="<?php echo $pid?>[]">
                                <?php for($ys=0;$ys<=$point;$ys++){?>
                                  <option value="<?php echo $ys?>"><?php echo $ys?></option>
                                <?php } ?>
                                </select>
                              </div>
                            </div>
                            <?php
							} 
							}
							?>
                          </div>
                          <!-- /.form-group -->
                        </div>
                        <?php } ?>
                        <!-- /.col -->
                      </div>
                    </div>
                    <?php
                    	}
                    ?>
                        <input type="hidden" value="<?php echo $value['maid']; ?>" name="assid" />
                        <input type="hidden" value="<?php echo $value['ml_id']; ?>" name="lvlid" />
                        <input type="hidden" value="<?php echo $value['u_id']; ?>" name="usid" />
                        <input type="hidden" value="<?php echo $value['case_id']; ?>" name="caseid" />
                        <input type="hidden" value="<?php echo $this->uri->segment(2); ?>" name="ssval" />
                    <!-- /.box-body -->
                      <div class="row">
                        <div class="col-md-12" style="padding: 10px 30px;">
                          <div class="form-group">
                            <input type="button" id="backlink" data-link="<?php echo base_url()?>subjective-score" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" value="Back" />
                            <input type="submit" value="Submit" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" />
                          </div>
                        </div>
                      </div>
                  </form>
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
    <?php
}else{
?>
    <div class="col-md-12">
      <div class="col-md-10 col-md-offset-1">
        <div class="col-md-12">
          <div class="danger">
            <strong>Sorry!
            </strong> Page Not Found
          </div>
        </div>
      </div> 
    </div>
    <?php
}
?>
  </div>   
  <!-- /.content -->
  <div class="clearfix">
  </div>
</div>
<script type="text/javascript">
$('#backlink').click(function(){
  <?php
    $this->session->set_flashdata('ssval',$this->uri->segment(2));
  ?>
  window.location.href = $(this).attr("data-link");
});
  $('.downld').click(function(){
    window.location.href='<?php echo base_url()."upload/".$uids ?>/'+$(this).attr("data-id");
  } );
</script>
