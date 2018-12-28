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
			<div class="col-md-12">
				<div class="col-md-12">
	              <?php
	              if($this->session->flashdata('topic_insert_message')){
	              	echo $this->session->flashdata('topic_insert_message');
	              }
	              ?>
				</div>
				<section class="invoice show">
					<!-- title row -->
					<div class="row" style="background-color: #587EA3">
						<div class="col-md-12">
							<h2 class="lel">All User List</h2> </div>
					</div>
					<div class="clearfix" style="margin-top: 20px;"></div>
					<div class="">
						<div class="col-md-12">
							
							</div>
					</div>
					<!-- /.box-header -->
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-16">
							
							 <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-col">
        <div class="box-header with-border">
	        <div class="col-md-12"><input type="button" class="btn btn-primary btn-md" style="float: left;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" onclick="tableToExcel('testtable2', 'user score data');" value="Export to Excel" />
	          <!-- <input type="button" class="btn btn-primary btn-md pull-right" id="exportall" style="float: right;background-color:#112B4E; border-color: #112B4E; margin-left: 3px;" value="Export All Score Data to Excel" /> -->
	      	</div>
			<div class="col-md-6">
			</div>
			<div id="resultStats" style="margin-top: 5px!important;" class="col-md-12"></div>
        </div>
      </div>
      <!-- /.box -->
  <div class="table-responsive">   
	          	<div class="col-md-12" style="padding-top: 10px;" id="smalluserdata">
	          		<!--Code By Khushboo-->
	          	<div class="">
<div class="row" style="margin-top: 0%">
         <form method="post" action="<?php echo base_url().'user-all-detail'; ?>" id="search_form">
       <div class="col-md-2">
           <div class="form-group">
               <div class="icon-addon addon-lg">
                    <select class="form-control" id="usertype" name="usertype" > 
                      <option value="">Select User Type</option>
                        <?php
                          foreach ($user_type as $ulist1) {
                            $all=$ulist1['user_type_id'];
                            if(!empty($search_title)){
                                 if($all==$search_title){
                                    $sel = 'selected="selected"';
                                 }
                                 else{
                                    $sel = '';
                                 }
                            }
                        ?>
                      <option value="<?php echo $ulist1['user_type_id']; ?>" <?php echo $sel; ?>><?php echo $ulist1['type_name']; ?></option>
                      <?php
                          }
                      ?>
                    </select>
                </div>
           </div>
        </div>    
        <div class="col-md-3">
           <div class="form-group">
               <div class="icon-addon addon-lg">
                    <input type="text" class="form-control" placeholder="Email Or Name" name="email">
                </div> 
           </div>
        </div>
        <div class="col-md-1">
           <div class="form-group">
               <div class="icon-addon addon-lg">
                   <input type="submit" class="btn btn-primary" value="Search">
                </div>
           </div>
        </div>    
        </form>
        <div class="col-md-6">
        <form method="post" action="<?php echo base_url().'user-all-detail'; ?>">
       <div class="col-md-3">
           <div class="form-group">
               <div class="icon-addon addon-lg">
                    <select id="get_all" name="get_all" class="form-control">
                        <option value="10" <?php echo ($noOfrecords==10)?"selected":"selected"; ?>>10</option>
                       <option value="25" <?php echo ($noOfrecords==25)?"selected":""; ?>>25</option>
                       <option value="50" <?php echo ($noOfrecords==50)?"selected":""; ?>>50</option>
                       <option value="100" <?php echo ($noOfrecords==100)?"selected":""; ?>>100</option>
                       <option value="1000" <?php echo ($noOfrecords==1000)?"selected":""; ?>>1000</option>
                       <option value="5000" <?php echo ($noOfrecords==5000)?"selected":""; ?>>5000</option>
                       <option value="10000" <?php echo ($noOfrecords==10000)?"selected":""; ?>>10,000</option>
                       <option value="15000" <?php echo ($noOfrecords==15000)?"selected":""; ?>>15,000</option>
                       <option value="1">All</option>
                    </select> record
                </div>
           </div>
        </div>    
        <div class="col-md-0">
           <div class="form-group">
               <div class="icon-addon addon-lg">
                   <input type="submit" class="btn btn-primary" name="sub" value="Show">
                </div>
           </div>
        </div>    
        </form>
        </div>
 </div>

  <div class="row" style="margin-top: 0%; margin-left: -2%;">
  	<div class="col-lg-12">
  <table class="table table-striped table-responsive" id="testtable2">
    <thead>
      <tr>
      	  <th>Sr.No</th>
		   <th>Id</th>
      	  <th>Name</th>
      	  <th>Email</th>
      	  <th>Registration Date</th>
      	  <th>City Name</th>
      	  <th>State Name</th>
      	  <th>Board Name</th>
      	  <th>Intermediate</th>
      	  <th>Graduation</th>
      	  <th>Graduation Un</th>
      	  <th>Post Graduation</th>
      	  <th>PG University</th>
      	  <th>Work Experience</th>
      	  <th>Status</th>
      	  <th>UserType</th>
      	  <th>Status</th>
	  </tr>
    </thead>
    <tbody>
<?php
$a=1;
foreach($datas as $data)
{
	if($this->uri->segment(3)!='')
	$getval=$this->uri->segment(3); 
	if($data['eamil_auth_status']==1){ $ver='Email Verified';$col='color:#00a65a'; }
    else{ $ver='Email Not Verified';$col='color:#F70E31'; }
?>
     <tr>
      	<td><?php echo $getval+$a."."; ?></td>
		<td><?php echo $data["mm_uid"]; ?></td>
      	<td><?php echo $data["mm_user_full_name"]; ?></td>
      	<td><?php echo $data["mm_user_email"]; ?></td>
      	<td><?php echo date("d M, Y",strtotime($data['reg_date'])); ?></td>
        <td><?php echo $data["cityname"]; ?></td>
        <td><?php echo $data["statename"]; ?></td>
        <td><?php echo $data["board_name"]; ?></td>
        <td><?php echo $data["XIIBoard"]; ?></td>
        <td><?php echo $data["gdegreename"]; ?></td>
        <td><?php echo $data["gun_name"]; ?></td>
        <td><?php echo $data["pgdegreename"]; ?></td>
        <td><?php echo $data["pgun_name"]; ?></td>
        <td>
        	<?php  $user_id = $data["mm_uid"];
                       $work = $this->Crud_modal->all_data_select('*','work_experience',"user_id='$user_id'",'work_exe_id');
                       //print_r($work);
                       if(sizeof($work)>0){
        		?>
        	<table class="table table-responsive" border="1">
        		<tr>
        			<th>Sr. No.</th>
        			<th>Organisation</th>
        			<th>Desg.</th>
        			<th>From</th>
        			<th>To</th>
        		</tr>
        		
        		<?php for($i=0; $i<sizeof($work); $i++){?>
        		<tr>

        			<td><?php echo $i+1; ?></td>
        			<td><?php echo $work[$i]['org_name']; ?></td>
        			<td><?php echo $work[$i]['designnation']; ?></td>
        			<td><?php echo $work[$i]['emp_from']; ?></td>
        			<td><?php echo $work[$i]['emp_to']; ?></td>
        			
        		</tr>
        		<?php }?>
        		
        	</table>
        	<?php }?>

        </td>
		<td><?php echo "<span style='".$col."' >".$ver."</span>"; ?></td>
		<td><?php echo $data["type_name"]; ?></td>
		<td><a href="javascript:void(0)" class="block" data-val="<?php echo $data["mm_uid"]; ?>" data-status="<?php echo $data['user_status']==1 ? "Block" : "Unbolck" ?>"><?php echo $data['user_status']==1? "Want to Block" : "Want to Unbolck" ?></td>		
	 </tr>
      <?php 
      $a++;	
}
?>
    </tbody>
  </table>
</div>
</div>
 </div>
 
<style>
.pagination-dive li {
    list-style: none;
    display: inline-block;
}
.pagination-dive a:hover, .pagination-dive .active a {
    background: #040404;
}

.pagination-dive a {
    display: inline-block;
    height: initial;
    background: #939890;
    padding: 10px 15px;
    border: 1px solid #fff;
    color: #fff;
}
</style>
  
<div class="pagination-dive" >
<?php echo $nav; ?>
</div>
 <!--Code By Khushboo Ends-->
</div>
		   	<input type="hidden" id="startid" value="<?php echo $startid[0]['score_id']?>">
	          	<input type="hidden" id="endid" value="<?php echo $endid[0]['score_id']?>">
	          		<div class="col-sm-7" style="float: right;">
								<div class="" >
									
								</div>
							</div>
	          	</div>
	          	<div class="col-md-12" id="alldataexcel" style="display: none;"></div>
   

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
})();

$(".change_utype").click(function() {
	 var uty = $(this).attr("value"); 
	 var uid = $(this).attr("data-val");

     if(uty==1){
        r = confirm("Are You Sure! You Want to Change UserType into Experienced Professional.");
        ut=2;
     }else{
        r = confirm("Are You Sure! You Want to Change UserType into B Student.");
        ut=1;
     }

     if (r == true) {
        $.ajax({
            type: "POST",
            data: { mm_uid:uid, user_type_id:ut },
            url: "<?php echo base_url() ?>change-user-type",
            success: function(msg){
                if(msg==1){
                  alert("Successfully Changed");
                  location.reload();
                }else{
                	alert("Something Went Wrong");
                }
            },
            error: function(msg){
                alert("Some Error Occurred!");
            }
        });
     } else {
         
     }
     
  });
  $(document).on("click",".block", function(){
	 var thisdata = $(this);
	 $.post("<?php echo base_url()?>admindashboard/admindashboard/block_user",{id:$(this).attr("data-val"),data:$(this).attr("data-status")},function(data){
		 if(data==1){
			 if(thisdata.attr("data-status")=="Block"){
				 thisdata.attr("data-status","Unbolck");
				 thisdata.text("Want to Unbolck");
			 }else if(thisdata.attr("data-status")=="Unbolck"){
				 thisdata.attr("data-status","Block");
				 thisdata.text("Want to Block");
			 }else{
				 alert("Something went wrong");
			 }
			
		 }else{
			 alert("Something went wrong");
		 }
	 })
  });
</script>
