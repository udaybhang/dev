
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
    border-bottom: 1px solid #ecf0f5;
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
    text-align: center;
  }
  .box-col {
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
  .input {
    height: 30%;
    width: 80%;
    margin: 8px 0;
    border: 1px solid #ddd;
    background-color: #F9F9F9;
  }
  .tr1 {
    background-color: #112B4E;
    color: #fff;
  }
  .panelbg{
    border-color: #112B4E;
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
        <?php if($this->session->flashdata('failmsg'))
{?>
        <div class="col-md-12 alert alert-danger text-center" style="margin-top: 20px"> 
          <?php echo $this->session->flashdata('failmsg'); ?>
        </div>
        <?php } ?>
        <?php if($this->session->flashdata('msg'))
{?>
        <div class="col-md-12 alert alert-success text-center" style="margin-top: 20px"> 
          <?php echo $this->session->flashdata('msg'); ?>
        </div>
        <?php } ?>
        <section class="invoice show">
          <div class="row" style="background-color: #587EA3">
            <div class="col-md-12">
              <h2 class="lel">Candidate Scoring Card 
              </h2> 
            </div>
          </div>
          <div class="clearfix" style="margin-top: 20px;">
          </div>
          <div class="row">
            <div class="col-md-12">
            <div class="box-header">
             <h3 class="box-title"><?php echo $username[0]['mm_user_full_name'].'('.$username[0]['mm_uid'].')';?></h3>
             

            
           </div>
              <?php $ravi=$levels; if(!empty($ravi)) {?>
              <?php $i=1;foreach ($levels as $data) { 

                
              ?>
                            <div class="panel-group" id="accordion<?php echo $i?>">
              
                <form action="<?php echo base_url()?>score-data" method="post">
               <!--  <?php if(($master_level['numberlevel'])==$i)
                {?>
                  <input type="hidden" name="check_status" value="1" />
                <?php }?> -->

                  <input type="hidden" name="pkg" value="<?php echo $pkgid  ;?>">
                  <input type="hidden" name="yyy" value="<?php echo $masid?>" />
                  <input type="hidden" name="xxx" value="<?php echo $userid?>" />
                  <input type="hidden" name="zzz" value="<?php echo $data->level_id?>" />
                  <input type="hidden" name="abc" value="<?php echo $data->cl_id?>" />
                  <input type="hidden" name="ccc" value="<?php echo $data->ps_id?>" />
                  <div class="panel panel-default">
                    <div class="panel-heading"> 
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion<?php echo $i?>" href="#collapseOne<?php echo $i?>">
                          <span class="glyphicon glyphicon-th-list">
                          </span>&nbsp;&nbsp;Level 
                          <?php echo $i?>
                        </a> 
                        <!--<span style="float:right;margin-right:30px;font-weight:600">Total Points: 
                          <?php echo ($data->total_score ? $data->total_score :'Not Given')   ?>
                        </span--> 
                      </h4>
                    </div>
                    <div id="collapseOne<?php echo $i?>" class="panel-collapse collapse">
                      <div class="panel-body">
                      <?php $ids=$data->level_id.'_'.$masid.'_'.$userid;  $qurstr=rtrim(strtr(base64_encode($ids), '+/', '-_'), '=');
                      $lvlid=$data->level_id;


                        $fileget = $this->Score_model->get_file_name($masid, $lvlid, $userid);
                        if($fileget!=null){

                      ?>
                         <a class="btn btn-primary btn-md center-block" style="width: 40%;margin-bottom: 10px;"  href="<?php echo base_url()?>download-file/<?php echo $qurstr?>">Download Assignment</a>
                        <?php
                          }else{
                        ?>
                            <button type="button" class="btn btn-primary btn-md center-block" style="width: 40%;margin-bottom: 10px;">No File Found</button>
                          <?php
                          }
                        ?>
                        <div class="row">
                          <div class="col-md-2">
                          </div>
                          <div class="col-md-8">
                            <table class="table table-striped table-responsive">
                              <thead>
                                <tr class="tr1">
                                  <th style="width:50%">Scoring Parameters
                                  </th>
                                  <th style="width:50%">Points
                                  </th>
                              </thead>
                              <tbody>
                              
                            <?php 
                              //$this->load->model('Score_model');
                            $level=$data->level_id;
                            $maid=$data->maid;
                              $leveldata=$this->Score_model->get_master_perameter($level,$maid);
                              $scoredata=$this->Score_model->get_secore_for_user_level_wise($level,$maid,$userid);
                              $sorepoint=$this->Crud_modal->fetch_single_data("time_limit,d_level","master_level","ml_id='$level'");
                              sscanf($sorepoint['time_limit'], "%d:%d:%d", $hours, $minutes, $seconds);
                              $time_limit=isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
                              $per_score=(($time_limit/60)*$sorepoint['d_level'])/sizeof($leveldata);
                            for($z=0;$z<sizeof($leveldata);$z++)
                            {?>
                              <tr>
                            <td class="tr1"><?php echo $leveldata[$z][0]['name']?>
                            </td>
                            <td>
                              <div class="form-group">
                                <div class="col-xs-10 selectContainer">
                                <input type="hidden" name="p_id[]" value="<?php echo $leveldata[$z][0]['p_id']?>">
                                 <input type="hidden" name="score_id" value="<?php echo $scoredata['score_id'];?>">
                                  <select class="form-control"
                                          name="res_and_coll_data[]" required="required">
                                    <option value="">Scoring Points</option>
                                    <?php for($score_number=0;$score_number<=$per_score;$score_number++) { 
                                          $scorenumber=$scoredata[$z];
                                          $sc='';
                                          if($score_number == $scorenumber)
                                          {
                                          $sc=' selected="selected"';
                                          }
                                          ?>
                                    <option value="<?php echo intval($score_number)?>" <?php echo $sc;?> ><?php echo $score_number ?></option>
                                  <?php }?>
                                  </select>
                              </div>
                        </div>
                          </td>
                        </tr>



                            <?php } ?>



<!--<tr>
<th style="background-color:#D9E0F2; color:#112B4E">Total</th>
<td></td>
</tr-->
</tbody>
</table>
<?php $chek=$scoredata[0]['score_id']; if($chek ==''){   ?>
<input  type="submit"  name="button" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E" value="Save" />

<?php } else {?>
<input  type="submit"  name="button" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E" value="Update"/ >

<?php }?>
</div>
<div class="col-md-2">
</div>
</div>
</div>
</div>
</div>
</form> 
</div>
<?php $i++;}?>
</div>
<?php }else{?>
<div >
  <p style="text-align: center;" >Opps! No  Data Find.
  </p>
</div>
<?php }?>   
</section>
</div>
<!-- /.box-header -->
<div class="col-md-1">
</div>
<div class="clearfix">
</div>
</div>
</div>
</div>
