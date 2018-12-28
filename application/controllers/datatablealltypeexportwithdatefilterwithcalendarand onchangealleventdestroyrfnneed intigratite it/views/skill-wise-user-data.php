<style>
   .invoice {
   position: relative;
   background: #fff;
   border: 1px solid #f4f4f4;
   padding: 0px 16px;
   margin: 114px 25px;
   padding-bottom: 20px;
   }
   .show {
   -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
   -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
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
   .dd-mar {
   margin-left: -27px;
   }
   .btn-col {
   background-color: #112B4E;
   border-color: #ecf0f5;
   }
   .ul-mar {
   margin-top: 35px;
   }
   .thead
   {
   align-content: center;
   }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="row main">
      <div class="col-md-12">
         <section class="invoice show">
            <!-- title row -->
            <div class="row" style="background-color: #587EA3">
               <div class="col-md-12">
                  <h2 class="lel">Skill wise report</h2>
               </div>
            </div>
            <div class="clearfix" style="margin-top: 30px;"></div>
            <!-- /.box-header -->
            <div class="row">
               <div class="col-md-12">
                  <div class="tab-content">
                     <div id="home" class="tab-pane fade in active">
                        <div class="col-md-12">
							  
							  <input type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" onclick="tableToExcel('testTable', 'user score data');" value="Export to Excel" />
	          <!-- <input type="button" class="btn btn-primary btn-md pull-right" id="exportall" style="float: right;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" value="Export All Score Data to Excel" /> -->
	    
                        </div>
                        <div class="col-md-12 ">
                           <table class="table  table-striped table-responsive" id="testTable">
                              <thead>
                
                              </thead>
                              <tbody>                 <tr>
                                    <th></th>
									<th></th>
									<th></th>
                                    <?php foreach($skills_id as $skname){?>
                                    <th colspan="3"><?php echo $skname['skills_name']?></th>
                                    <?php }?>
                                    <th colspan="2"></th>
									
                                 </tr>
                                 <tr>
									<th>Sl no.</th> 
								    <th>Name</th>
                                    <th>Email</th>
                                    <?php foreach($skills_id as $skname){?>
                                    <th>Marks</th>
									<th>skills total Marks</th>  
                                    <th>Neurons</th>
                                    <?php }?>
                                    <th>Get marks</th>
									<th>Total marks</th>
                                    <th>Time taken</th>
                                 </tr> 
                                 <?php
								 $i=0;
                                    foreach($user_list as $user){
										$total=0;
										$total_new=0;
										$uid = $user['mm_uid'];
										$score_check=$this->Crud_modal->check_numrow('score',"u_id='$uid' and package_id='42'");
										if($score_check!=''){ 
									?>
                                 <tr>
									<td><?php echo ++$i; ?></td> 
									<td><?php echo $user['mm_user_full_name'] ?></td>
                                    <td><?php echo $user['mm_user_email']?></td>
                                    <?php foreach($skills_id as $skname){
                                       $datafasff = get_package_skills($package_id,$skname['skills_id'],$user['mm_uid']);	
                                       ?>
                                    <td><?php echo round($datafasff['marks']);$total+=round($datafasff['marks'])?></td>
                                    <td><?php echo round($datafasff['total']);$total_new+=round($datafasff['total'])?></td>
                                    <td><?php echo round($datafasff['neurons']);?></td>
                                    <?php }?>
                                    <td><?php echo $total?></td>
                                    <td><?php echo $total_new?></td>
                                    <td><?php $timedata=$this->Crud_modal->fetch_single_data("SEC_TO_TIME( SUM( TIME_TO_SEC( `time_taken` ) ) ) AS timeSum","score","package_id='$package_id' and u_id='$uid'"); echo $timedata['timeSum'] ?></td>
                                 </tr>
									<?php } }?>	
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </div>
   <!-- /.content -->
   <div class="clearfix"></div>
</div>
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
</script>
<script>
   $(function () {
     $("#testTable").DataTable( {
    responsive: true,
	scrollX: 300,
});    

$('#').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
	
   });
</script>