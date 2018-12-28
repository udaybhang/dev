<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-10 col-md-offset-1">
				<div class="col-md-12">
	              <?php
	              if($this->session->flashdata('topic_insert_message')){
	              	echo $this->session->flashdata('topic_insert_message');
	              }
	              ?>
				</div>
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="text-align: center">
						<h3 class="lel">Package Record List</h3>
					</div>
					<div class="clearfix" style="margin-top: 20px;"></div>
					<div class="row">
						<div class="col-md-12">
							<!-- Search form (start) -->
							<form method='post' action="<?= base_url() ?>package-record-list" id="sssss">
							<div class="col-md-3">
								<input type='text' name='search' value='<?= $search ?>' placeholder="Enter Package Name" class="form-control">
							</div>
							<div class="col-md-2">
								<select name="nor" id="nor" class="form-control">
									<option value="10" <?php if($tsearch==10){ echo "selected='selected'"; }?>>10</option>
									<option value="20" <?php if($tsearch==20){ echo "selected='selected'"; }?>>20</option>
									<option value="30" <?php if($tsearch==30){ echo "selected='selected'";}?>>30</option>
									<option value="50" <?php if($tsearch==50){ echo "selected='selected'";}?>>50</option>
								</select>
								<input type="hidden" name="pageh" id="pageh">
							</div>
							</form>
							<div class="col-md-2">
								<input type='submit' name='submit' value='Submit' id="submit" class="btn btn-primary">
							</div>
							<form method='post' action="<?= base_url() ?>package-record-list" id="sssss1">
							<div class="col-md-3">
								<select name='package_type' class="form-control" id="package_type">
									<option value="">Choose Package Type</option>
									<?php
										foreach ($pack_type_list as $p) {
									?>
										<option value="<?php echo $p['pack_type_id']; ?>" <?php if($p['pack_type_id']==$pack_type){echo "selected";} ?>><?php echo $p['pack_type_name']; ?></option>
									<?php
										}
									?>
								</select>
							</div>
							</form>
							<div class="col-md-2">
								<input type="button" class="btn btn-primary btn-md csv hide" style="float: right;background-color:#112B4E;border-color:#112B4E;" value="Export to Excel" />
							</div>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12">
							<section class="content">
						      <!-- /.box -->
						      <div class="ibox-content1">
					          	<div class="col-md-12" style="padding-top: 10px;">
						          	<table border='1' style='border-collapse:collapse;' class="table table-bordered" id="testtable2">
						          	<thead>
									<tr>
										<th>S.No.</th>
										<th>Package Name</th>
										<th>Package Type</th>
										<th>Total Marks</th>
										<th>Total Time</th>
										<th>Total Levels</th>
										<th>Total Skills</th>
										<th>Action</th>
									</tr>
									</thead>
									
									<?php 
									$sno = $row+1; $count=0; $sum_levels=0; $sum_time=0; $sum_marks=0;
									foreach($result as $data){
										if(count($result) != 0){
											$count++;
									?>
									<tbody>
                           			<tr>
                            		<?php
										echo "<td>".$sno."</td>";
										echo "<td>".$data['package_name']."</td>";
										$typ=$this->Crud_modal->fetch_single_data("pack_type_name","mm_master_package_type","pack_type_id=".$data["pack_type_id"]);
										echo "<td>".$typ['pack_type_name']."</td>";
										echo "<td>".$data['total_marks']."</td>";
										echo "<td>".$data['total_time']."</td>";
										$sum_time=$sum_time+$data['total_time'];
										$sum_marks=$sum_marks+$data['total_marks'];
										$levels=$this->Crud_modal->fetch_single_data("count(ml_id) as total_levels","master_level","pack_id=".$data["package_id"]);
										$sum_levels=$sum_levels+$levels['total_levels'];
										echo "<td>".$levels['total_levels']."</td>";
										$skills=explode(',',$data["skills"]);
										echo "<td>".sizeof($skills)."</td>";
										$url=base_url().'view-package-data/'.rtrim(strtr(base64_encode($data['package_id']), '+/', '-_'), '=');
										echo "<td><a href='".$url."' target='_blank' style='color:royalblue;'>View</a></td>";
										$sno++;
									?>
									</tr>
									<?php }else{
											echo "<tr>";
											echo "<td>No record found.</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>";
											echo "</tr>";
									   	  }
									}
									?>
									<?php if($count>0){ ?>
									<tr>
										<th>Total</th>
										<th></th>
										<th></th>
										<th><?php echo $sum_marks; ?></th>
										<th><?php echo $sum_time.' Min.'; ?></th>
										<th><?php echo $sum_levels; ?></th>
										<th></th>
										<th></th>
									</tr>
									<?php } ?>
									</tbody>
									</table>
									<!-- Paginate -->
									<div style='margin-top: 10px;'>
										<?= $pagination; ?>
									</div>
								</div>
								</div>
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
		$(document).on('change','#package_type',function(){
           $('#sssss1').submit();  
		});
	});	
</script>
<script type="text/javascript">
	//### Code for Csv Format download #######

    function exportTableToCSV($table, filename) {
        var $rows = $table.find('tr:has(th),tr:has(td)'),
            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            tmpColDelim = String.fromCharCode(11), // vertical tab character
            tmpRowDelim = String.fromCharCode(0), // null character

            // actual delimiter characters for CSV format
            colDelim = '","',
            rowDelim = '"\r\n"',

            // Grab text from table into CSV formatted string
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                    $cols = $row.find('th,td');

                return $cols.map(function (j, col) {
                    var $col = $(col),
                        text = $col.text();
                    return text.replace(/\r?\n|\r/,'""'); // escape double quotes


                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"';

                // Deliberate 'false', see comment below
        if (false && window.navigator.msSaveBlob) {
          var blob = new Blob([decodeURIComponent(csv)], {
                type: 'text/csv;charset=utf8'
            });            
            // Crashes in IE 10, IE 11 and Microsoft Edge
            // See MS Edge Issue #10396033: https://goo.gl/AEiSjJ
            // Hence, the deliberate 'false'
            // This is here just for completeness
            // Remove the 'false' at your own risk
            window.navigator.msSaveBlob(blob, filename);            
        } else if (window.Blob && window.URL) {
      // HTML5 Blob        
            var blob = new Blob([csv], { type: 'text/csv;charset=utf8' });
            var csvUrl = URL.createObjectURL(blob);
            $(this)
                .attr({
                    'download': filename,
                    'href': csvUrl
                });
          var link = document.createElement("a");
            link.download = filename;
            link.href =csvUrl;
            link.click();
        } else {
            // Data URI
            var csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
        var link = document.createElement("a");
            link.download = filename;
            link.href =csvData;
            link.click();
          
        }
    }
  
$(".csv").click(function (event) {
  $(".loader").fadeIn("slow");
  $.post("<?php echo base_url()?>admindashboard/Report/export_users_data4",{package_id:"<?php echo $package_id?>"}, function (result){
    $(".ibox-content1").append(result);
     var today = new Date();
     var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
     var filename = "package-record-list"+date+".csv";  
     var args = [$('#testtable1'), filename];        
     exportTableToCSV.apply(this, args);
     $(".loader").fadeOut("hide");         
  }).fail(function(){
     $(".loader").fadeOut("hide");
     alert( "Something went wrong." );
  }); 
});
</script>