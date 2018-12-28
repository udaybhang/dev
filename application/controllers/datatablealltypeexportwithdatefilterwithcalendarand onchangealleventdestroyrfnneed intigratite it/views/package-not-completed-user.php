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
						<h3 class="lel">Package Not Completed Users Report</h3>
					</div>
					<div class="clearfix" style="margin-top: 20px;"></div>
					<div class="row">
						<div class="col-md-12">
							<!-- Search form (start) -->
							<form method='post' action="<?= base_url() ?>package-not-completed-user/<?php echo $encode_pack_id; ?>" id="sssss">
							<div class="col-md-3">
								<input type='text' name='search' value='<?= $search ?>' placeholder="Enter Email Id" class="form-control">
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
							<div class="col-md-5">
								<input type="button" class="btn btn-primary btn-md csv" style="float: right;background-color:#112B4E;border-color:#112B4E;" value="Export to CSV" />
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
										<th>Name</th>
										<th>Email Id</th>
									</tr>
									</thead>
									
									<?php 
									$sno = $row+1;
									foreach($result as $data){
									?>
									<tbody>
                           			<tr>
                            		<?php
										echo "<td>".$sno."</td>";
										echo "<td>".$data['mm_user_full_name']."</td>";
										echo "<td>".$data['mm_user_email']."</td>";
										$sno++;
									}
									?>
									</tr>
									<?php if(count($result) == 0){
										echo "<tr>";
										echo "<td>No record found.</td><td></td><td></td>";
										echo "</tr>";
									}
									?>
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
  $.post("<?php echo base_url()?>admindashboard/Report/export_users_data3",{package_id:"<?php echo $package_id?>"}, function (result){
    $(".ibox-content1").append(result);
     var today = new Date();
     var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
     var filename = "package-not-completed-users"+date+".csv";  
     var args = [$('#testtable1'), filename];        
     exportTableToCSV.apply(this, args);
     $(".loader").fadeOut("hide");         
  }).fail(function(){
     $(".loader").fadeOut("hide");
     alert( "Something went wrong." );
  }); 
});
</script>