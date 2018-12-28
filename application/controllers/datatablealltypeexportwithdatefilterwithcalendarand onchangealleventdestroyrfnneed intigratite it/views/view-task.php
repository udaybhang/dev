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
   #file_upload_css .fa{
    cursor: pointer;
   }
   #file_upload_css .fa, #add_file{
    cursor: pointer;
   }
   /* Sohrab 1st May 2017 */
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
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	
	<div class="row main">
  <?php
if(isset($task_value)){
?>
		<div class="col-md-12">
			<div class="col-md-10 col-md-offset-1">
        <div class="col-md-12">
          <?php
          if($this->session->flashdata('task_insert_message')){
            echo $this->session->flashdata('task_insert_message');
          }
          ?>
        </div>
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel">Task Detail</h2> </div>
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
							
							 <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-col">
        <div class="box-header with-border">
          <h3 class="box-title">Task Detail</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Assignment Name</label>
                <h4><?php echo $assignmentname['assignment_name'] ?></h4>
              </div>
              <div class="form-group">
                <label>Level Name</label>
                <h4><?php echo $lvlname['lvl_name'] ?></h4>
              </div>
              <div class="form-group">
                  <label>Task Detail</label>
                  <div><?php echo $task_value['task_name']; ?></div>
              </div>
              <div class="form-group">
                <label>File List</label>
                <div><?php 
                if($task_value['sample_files']!=''){
                  $filesize = explode(',',$task_value['sample_files']);
                  for($f=0;$f<sizeof($filesize);$f++){
                    $ran = rand(111111,999999);
                    $filename = explode('/',$filesize[$f]);
                    echo '<div class="row">';
                    echo '<div class="col-sm-11">';
                    echo '<p>'.$filename[1].'<p>';
                    echo '</div>';
                    echo '</div>';
                  }
                }else{
                  echo 'No Files';
                }
                ?></div>
              </div>

              <div class="form-group">
                <label>Accept File List</label>
                <div>
                <ul style="padding:10px;">
                <?php 
                  $filetypesize = explode(',',$task_value['filetype']);
                  foreach ($filetypesize as $filetypelist) {
                    $filetype = $this->Crud_modal->fetch_single_data('ft_name','master_filetype',"ft_id='$filetypelist'");
                    echo '<li>'.$filetype['ft_name'].'</li>';
                  }
                ?>
                </ul>
                </div>
              </div>
          			 
              <div class="form-group">
                <label>Widget</label>
                <div><?php echo $wname ?></div>
              </div>
              <div class="form-group">
                  <label>Instruction *</label>
                  <div><?php echo $task_value['instruction'] ?></div>
              </div>

              <div class="form-group">
              <a href="<?php echo base_url()?>task-list" class="btn btn-primary btn-md" style="float: left; background-color:#112B4E; border-color: #112B4E">View All</a>
                <a href="<?php echo base_url().'edit-task/'.rtrim(strtr(base64_encode($task_value['tid']), '+/', '-_'), '='); ?>" class="btn btn-primary btn-md" style="float: right;background-color:#112B4E; border-color: #112B4E">Edit</a>
              </div>
			  <!-- /.form-group -->
            
          </form>
          </div>
          <!-- /.row -->
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
			<div class="col-md-1"></div>
		</div>
    <?php
  }else{
  ?>
  <div class="col-md-12">
      <div class="col-md-10 col-md-offset-1">
        <div class="col-md-12">
          <div class="danger"><strong>Sorry!</strong> Page Not Found</div>
        </div>
      </div>
    </div>
    <?php
  }
  ?>
	</div>
	<!-- /.content -->
	<div class="clearfix"></div>
</div>