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



</style>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

	<!-- Content Header (Page header) -->

	

	<div class="row main">

		<div class="col-md-12">

			<div class="col-md-8 col-md-offset-2">

				<div class="col-md-12">

	              <?php

	              if($this->session->flashdata('skills_test_insert_message')){

	              	echo $this->session->flashdata('skills_test_insert_message');

	              }

	              ?>

				</div>

				<section class="invoice show">

					<!-- title row -->

					<div class="row" style="background-color: #587EA3">

						<div class="col-md-12">

							<h2 class="lel">Skills</h2> </div>

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

          <h3 class="box-title">Skills</h3>



        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <div class="row">

            <div class="col-md-12">

	            <form action="<?php echo base_url()?>skill-update" autocomplete="off" method="post">
				 	<div class="form-group">
	              		<input type="text" class="form-control" placeholder="Skills Name" name="skills_name" required="required" value="<?php echo $skills_test_lists[0]['skills_name']?>" />	
					</div> 
					<input type="hidden" name="id" value="<?php echo $skills_test_lists[0]['skills_id']?>">
	              <div class="form-group" id="sub_skills">
	              	
					<div class="form-group col-md-10">
						
					</div>
					<div class=" form-group col-md-2">	              
						<a class="btn btn-primary"  id="add_more" style="background-color:#112B4E; border-color: #112B4E" >+</a>
					</div>
					<?php
	              		$var = explode(",", $skills_test_lists[0]['sub_skills_name']);
	              	for($i=0;$i<sizeof($var);$i++){?>
					<div class="form-group col-md-10">
						<input type="text" class="form-control" placeholder="Sub Skills Name" name="sub_skills_name[]" value="<?php echo $var[$i]?>" required="required" />
					</div>
					<div class=" form-group col-md-2">	              
						<a class="btn btn-primary remove" style="background-color:#112B4E; border-color: #112B4E" >-</a>
					</div>
					<?php }?>
	              </div>
	              <div class="form-group">
					<input type="submit" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E" value="Update" />
				</div>
	          	</form>

            </div>

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

	</div>

	<!-- /.content -->

	<div class="clearfix"></div>

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

$("#add_more").click(function(){
	$("#sub_skills").append('<div class="form-group col-md-10"><input type="text" class="form-control" placeholder="Sub Skills Name" name="sub_skills_name[]" required="required" /></div><div class="form-group col-md-2"><a class="btn btn-primary remove"   style="background-color:#112B4E; border-color: #112B4E" >-</a></div>');
	$(".remove").click(function(){
	$(this).parent().prev().remove();
	$(this).parent().remove();

});
});
$(".remove").click(function(){
		
	$(this).parent().prev().remove();
	$(this).parent().remove();
});

</script>