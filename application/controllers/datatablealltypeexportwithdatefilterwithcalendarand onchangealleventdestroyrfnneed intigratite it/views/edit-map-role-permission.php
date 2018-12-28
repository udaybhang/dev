<link rel="stylesheet" href="https://cdn.rawgit.com/Chalarangelo/bootstrap-extend/880420ae663f7c539971ded33411cdecffcc2134/css/bootstrap-extend.min.css"/>
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
.mcq_question{
	height: 300px !important;
}
.frmSearch {border: 1px solid #a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;}
#country-list{float:left;z-index:11110;list-style:none;margin-top:-3px;padding:0;width:950px;position: absolute;}
#country-list li{padding: 10px;z-index:11110; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#ece3d2;z-index:11110;cursor: pointer;}
.btn-toggle,.btn-untoggle{height:20px;width:20px;font-size:5px;margin:1px;padding:1px 0px 1px 1px;text-align: center;font-family:calibri;
/*font-family: 'Glyphicons Halflings';*/
content: "\00";font-weight: 300;}
.well{
	margin-top: 2px 0;
	padding:0px;
	padding-left: 28px;
	font-size:14px;
	font-weight: 500;
	border:none;
	box-shadow:none;
	background:none;
}
.main_menu_text{font-weight: 500; font-size:15px;}

/* Checkbox Hack */
.target-label { 
  /*-webkit-appearance: push-button;
  -moz-appearance: button; 
  display: inline-block;
  */
  padding: 1px 3px 1px 3px;
  cursor: pointer;
}
.target-label:hover{
	/*background:lime;*/
}
/* Default State */
.target-div {
 }
/* Toggled State */
input[type=checkbox]:checked ~ .target-div {
   /*background: red;*/
}
.well {
   margin-bottom: 0px !important;
}
</style>
<?php 
	$permission_array=$this->session->userdata('permission_array');
	for($i=0;$i<sizeof($permission_array);$i++){
	$np =$this->Crud_modal->fetch_single_data('permission_description','master_permission',"permission_id='$permission_array[$i]'");
	$newpermission[] = $np["permission_description"];
}?>
<script src="<?php echo base_url() ?>admin_assets/editor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>admin_assets/editor/samples/js/sample.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="row main">
		<div class="col-md-12">
			<div class="col-md-12">
				<?php
				if($this->session->flashdata('data_message')){
					echo $this->session->flashdata('data_message');
				}
				?>
			<section class="invoice show" style="margin-top:20px">
				<!-- title row -->
				<div class="row" style="background-color: #587EA3">
					<div class="col-md-12">
					<h2 class="lel">Map Roles With Permission & Menus</h2> 
					<?php //print_r($mapping_role_data);// die;?>
				</div>
				</div>
				<div class="col-md-3 pull-right">
                        <div class="alert alert-danger" style="display: none"> 
                             Data Already Exists
                        </div>
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
								<!-- <div class="box-header with-border">
									<h3 class="box-title">Create Group</h3>
								</div> -->
								<!-- /.box-header -->
		<?php // print_r($mapping_role_data); 
               foreach ($mapping_role_data as $menudata) {
               	  $menu = explode('&&', $menudata['menu_master_id']);
               	  //print_r($menu);
               	  for($i=0; $i<=count($menu)-1; $i++){
                     $menu_data = explode('|', $menu[$i]);
                     for($j=1; $j<= count($menu_data)-1; $j++){
                         $sub = explode('$', $menu_data[$j]);
                         if($sub[0] !="" && $sub[1] !="" && $sub[2] ==""){
                          $submenus[] = $menu_data[$j];
                         }else{
                         	$subsubmenu[] = $menu_data[$j];
                         }
                         
                         //print_r($sub);

                     }
                     //print_r($submenu);
                     //echo $menu_data[0];
                     $menuidl[]=$menu_data[0];
               	  }
                  
               }
               //print_r($submenus);
			?>
								<div class="box-body">
									<form autocomplete="off" method="post" action="" enctype="multipart/form-data" id="edit_map_role_form">
										<div class="row">
											<div class="col-md-12">
                                           <?php
                                               foreach ($mapping_role_data as $mappingrole) {
                                               	  $permission = $mappingrole['permission_id'];
                                               	  $mastermenu = $mappingrole['menu_master_id'];
                                               	  $roleid = $mappingrole['role_id'];
                                               	  $portlet_id = $mappingrole['portlet_id'];
                                               }
                                              ?>
												<!-- this div start for main menu -->
												<div class="col-lg-6" style="max-height: 500px;height:500px; overflow-y: scroll;">
												<?php $i=1; $j=1; $k=3; $sub=1; $sub_sub=1; 
												$mi=1; $mj=0; $mk=0;
												  foreach ($master_menu as $menu) {
                                                     // print_r($menuid);
													 ?>
												<div class="col-lg-12">
													<!--Code For Menus-->	
													<div class="main_menu1">
														<button class="btn btn-primary btn-toggle" type="button" data-toggle="collapse" style="font-size:10px;"
														   data-target="#collapseDataTargetExample<?php echo $i;?>" aria-expanded="false" aria-controls="collapseDataTargetExample">
														</button>
														<!-- <input type="checkbox" class="btn-primary checkmenu" />
														 --><!-- <span class=" target-label target-div">Main Menu</span> -->
														<?php 
														  $mloop_check=0;
														  for($m=0; $m<=count($menuidl)-1; $m++){
                                                              //echo $menuidl[$m];
                                                              if($menuidl[$m]==$menu['menu_id']){ $mloop_check++; ?>
                                                              <input type="checkbox" class="check_menu target-div main_menu_class<?php echo $mi;?>" value="<?php echo $menu['menu_id']; ?>" id="main_menu_id<?php echo $i;?>" name="main_menu_id[]" checked='checked' data-val="<?php echo $mi.'-'.$mj.'-'.$mk;?>" ></input>
														      <label for="main_menu_id" class="main_menu_text target-label1"><?php echo $menu['menu_description']; ?></label>
                                                               
                                                            <?php   } 
                                                              
														  }

														?>
														<?php 
														if($mloop_check==0){ ?>
                                                              <input type="checkbox" class="check_menu target-div main_menu_class<?php echo $mi;?>" value="<?php echo $menu['menu_id']; ?>" id="main_menu_id<?php echo $i;?>" name="main_menu_id[]" data-val="<?php echo $mi.'-'.$mj.'-'.$mk;?>" ></input>
														      <label for="main_menu_id" class="main_menu_text target-label1"><?php echo $menu['menu_description']; ?></label>

                                                        <?php      } ?>
														<div class="collapse" id="collapseDataTargetExample<?php echo $i;?>">
															 
															 <?php $menuid = $menu['menu_id']; 
                                                                  foreach($master_sub_menu as $submenu){
                                                                  	if($submenu['menu_id']==$menuid){
															 	?>
															 	<div class="well">
															 	<!--Code For Sub Menu Start-->
															  	<button class="btn btn-default btn-toggle" type="button" data-toggle="collapse" style="font-size:10px;"
															   		data-target="#submenutarget<?php echo $j;?>" aria-expanded="false" aria-controls="collapseDataTargetExample1">
																</button>
																<?php $slopcheck=0; for($ns=0; $ns<=count($submenus)-1; $ns++){ 
																   $submenuids = explode('$', $submenus[$ns]);
																  // print_r($submenuids);
																   if($submenuids[0]==$menu['menu_id'] && $submenuids[1]==$submenu['sub_menu_id']){ $slopcheck++; ?>
																   	  <input type="checkbox" class="check_sub_menu target-div  sub_menu_class<?php echo $mi;?>  check_sub_menu_class<?php echo $mj;?> check__<?php echo $i;?>" value="<?php echo $menuid."$".$submenu['sub_menu_id']; ?>" id="sub_menu_id<?php echo $i.".".$sub;?>" name="sub_menu_id[]" checked='checked' data-val="<?php echo $mi.'-'.$mj.'-'.$mk;?>" ></input>
																  <label for="sub_menu_id" class="main_menu_text target-label2"><?php echo $submenu['sub_menu_description']; ?></label>

																<?php   	}
																   }
																?>
																<?php 
                                                                    if($slopcheck==0){ ?>
                                                                    <input type="checkbox" class="check_sub_menu target-div sub_menu_class<?php echo $mi;?>  check_sub_menu_class<?php echo $mj;?> check__<?php echo $i;?>" value="<?php echo $menuid."$".$submenu['sub_menu_id']; ?>" id="sub_menu_id<?php echo $i.".".$sub;?>" name="sub_menu_id[]" data-val="<?php echo $mi.'-'.$mj.'-'.$mk;?>" ></input>
																  <label for="sub_menu_id" class="main_menu_text target-label2"><?php echo $submenu['sub_menu_description']; ?></label>

                                                                <?php    }
																?>
																<div class="collapse" id="submenutarget<?php echo $j;?>">
															 	
															  			<!--Code For SUb Sub Menu Start-->
															  			<?php 
															  			
															  			  $submenu_id = $submenu['sub_menu_id'];
                                                                           	foreach($master_sub_sub_menu as $ssmenu){
                                                                           	if(($ssmenu['menu_id']== $menuid) && ($ssmenu['sub_menu_id']== $submenu_id)){
                                                                           
															  			?>
															  			<div class="well">
																	  	<button class="btn btn-success btn-toggle" type="button" data-toggle="collapse" style="font-size:10px;"
																	   		data-target="#sub_sub_menutarget<?php echo $k;?>" aria-expanded="false" aria-controls="sub_sub_menutarget<?php echo $i;?>">
																		</button>
																		<?php $sslopcheck=0; for($o=0; $o<=count($subsubmenu)-1; $o++){
									                                    $subsubmenuid = explode('$', $subsubmenu[$o]);
									                                    if($subsubmenuid[0]==$menu['menu_id'] && $subsubmenuid[1]==$submenu['sub_menu_id'] && $subsubmenuid[2]==$ssmenu['sub_sub_menu_id']){ $sslopcheck++;?>
									                                    <input type="checkbox" class="check_sub_sub_menu target-div sub_sub_menu_class<?php echo $mi;?> check_sub_sub_menu_class<?php echo $mj;?> check_<?php echo $mi.''.$mj;?>" value="<?php echo $menuid."$".$submenu_id."$".$ssmenu['sub_sub_menu_id']; ?>" id="sub_sub_menu_id<?php echo $i.".".$sub."."."$sub_sub";?>" name="sub_sub_menu_id[]" checked='checked' data-val="<?php echo $mi.'-'.$mj.'-'.$mk;?>"></input>
																		<label for="sub_sub_menu_id" class="main_menu_text target-label3"><?php $sub_sub++; echo $ssmenu['sub_sub_menu_description']; ?></label>
									                                    	
															   	     <?php   }
															   	       } ?>
																		<?php 
                                                                         if($sslopcheck==0){ ?>
                                                                          <input type="checkbox" class="check_sub_sub_menu target-div sub_sub_menu_class<?php echo $mi;?> check_sub_sub_menu_class<?php echo $mj;?> check_<?php echo $mi.''.$mj;?>" value="<?php echo $menuid."$".$submenu_id."$".$ssmenu['sub_sub_menu_id']; ?>" id="sub_sub_menu_id<?php echo $i.".".$sub."."."$sub_sub";?>" name="sub_sub_menu_id[]" data-val="<?php echo $mi.'-'.$mj.'-'.$mk;?>"></input>
																		<label for="sub_sub_menu_id" class="main_menu_text target-label3"><?php $sub_sub++; echo $ssmenu['sub_sub_menu_description']; ?></label>
                                                                   <?php      }

																		?>

																		<div class="collapse" id="sub_sub_menutarget<?php echo $i;?>">
																	 	<div class="well">
																	  	</div>
																	  	
																	 	<!--Code For SUb Sub Menu Ends-->
																		</div>
																		</div>
                                                                    <?php $k++; $mk++; }}$sub++; $sub_sub=1;?>
															 	
															 	<!--Code For Sub Menu Ends-->
															 	
																</div>
																</div>
																<?php $j++; $mj++; } }$sub=1; ?>
															
														</div>
													</div>
												</div>	
												<?php $i++; $mi++; } ?>
												<input type="hidden" name="menu_count" value="<?php echo $i-1; ?>">
											</div>
												<!-- main menu end here -->

												<div class="col-lg-6">
													<div class="col-md-12">
													<label>Select Role:</label>
														<div class="form-group">
															<select name="group_type" class="form-control" required="required">
																<option value="">Role Type</option>
																<?php foreach($master_role as $masterrole){?>
																  <option value="<?php echo $masterrole['role_id']; ?>" <?php if($roleid ==$masterrole['role_id']){echo 'selected=selected';}?> ><?php echo $masterrole['role_name']; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="col-md-12">
														<div class="col-md-6">
															<label>Choose Permissions:</label>
															<?php $i=0; $permission_id = explode('|', $permission); 
															   foreach($master_permission as $masterpermission){?>
															<div class="checkbox checkbox-primary checkbox-info" style="margin-left:20px">
																<input type="checkbox" value="<?php echo $masterpermission['permission_id']; ?>"  name="Permission[]" <?php 
		if(in_array($masterpermission['permission_id'],$permission_id)){echo "checked=checked"; echo 'style="background-color: green"';}?>/><label><?php echo $masterpermission['permission_description']; ?></label>
															</div>
															<?php $i++; } ?>
														</div>
														<div class="col-md-6">
															<label>Choose Portlets:</label>
															<?php $ip=0; $pids = explode(',', $portlet_id); 
															   foreach($master_portlets as $p){?>
															<div class="checkbox checkbox-primary checkbox-info"  <?php if($pids[$ip]==$p['portlet_id']){ echo 'style="color: green; margin-left:20px"';}else{ echo 'style="margin-left:20px"';}?>>
																
																<input type="checkbox" value="<?php echo $p['portlet_id']; ?>"  name="Portlet[]" <?php 
		if(in_array($p['portlet_id'],$pids)){echo "checked=checked"; echo 'style="background-color: green"';}?> /><label><?php echo $p['portlet_name']; ?></label>
															</div>
															<?php $ip++; } ?>
														</div>
													</div>
												</div>
											</div>
										</div>
										<input type="hidden" name="update_role_id" id="update_role_id" value="<?php echo $roleid; ?>">
										<a href="<?php echo base_url(); ?>map-role-with-permission-menu" class="btn btn-primary btn-md pull-left"  style="float: left;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;">Back</a>
										<?php if(in_array("Edit", $newpermission)){ ?>
										<input type="button" value="Update" class="btn btn-primary btn-md " style="float: right;background-color:#112B4E; border-color: #112B4E; margin-top: 20px;" id="map_button" />
										<?php } ?>
										<!-- /.row -->
									</form>
								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.box -->
						</section>
						<!-- /.content -->
					</div>
					<!--table-->
					<div class="col-md-12">
                        
                    </div>
					<!--table-->
				</div>
				</section>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
	<!-- /.content -->
	<!-- delete popup start from here -->
   
  <!-- delete popup end from here -->
	<div class="clearfix"></div>
</div>
<script type="text/javascript">
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

	$(document).ready(function (){
                $("#map_button").click(function (){            
                      var url = "<?php echo base_url() ?>edit-map-role-permission-form-save"; // the script where you handle the form input.
                        $.ajax({
                               type: "POST",
                               url: url,
                               data: $("#edit_map_role_form").serialize(), // serializes the form's elements.
                               success: function(data)
                               {
                                    if(data == 0){
                                      $('.alert').css('display','block');
                                  $('.alert').fadeIn().fadeOut(2000);
                                    }
                                    if(data == 1){
                                        location.href="<?php echo base_url()?>map-role-with-permission-menu";
                                    } 
                               }
                             });
                        e.preventDefault(); // avoid to execute the actual submit of the form.
                  
                });
    });
   $(function () {
    $("#testtable2").DataTable();
  
  });
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
<script type="text/javascript">
	$(document).on("click",".btn-toggle",function(){
		$(this).removeClass('btn-toggle');
		$(this).addClass('btn-untoggle');
	});
	$(document).on("click",".btn-untoggle",function(){
		$(this).removeClass('btn-untoggle');
		$(this).addClass('btn-toggle');
	});
	$(document).on("change",".check_menu",function(){
		var str=$(this).attr('data-val');
		var a=str.split("-");
		var mid=a[0];
		var sid=a[0]+"."+a[1]; sid=a[1];
		var smid=a[0]+"."+a[1]+"."+a[2];
		//alert(mid+" "+sid+" "+smid);
		if($(this).prop('checked')){
			$('.sub_menu_class'+mid).prop("checked",true);
			$('.sub_sub_menu_class'+mid).prop("checked",true);
		}else{
			$('.sub_menu_class'+mid).prop("checked",false);
			$('.sub_sub_menu_class'+mid).prop("checked",false);
		}
	});
	$(document).on("change",".check_sub_menu",function(){
		var str=$(this).attr('data-val');
		var a=str.split("-");
		var mid=a[0];
		var sid=a[0]+"."+a[1]; sid=a[1];
		var smid=a[0]+"."+a[1]+"."+a[2];
		//alert(mid+" "+sid+" "+smid); 
		var flag=0;
		if($(this).prop('checked')){
			$('.main_menu_class'+mid).prop("checked",true);
			$('.check_sub_sub_menu_class'+sid).prop("checked",true);
		}else{
			// code to uncheck sub-sub menu
			$('.check_sub_sub_menu_class'+sid).prop("checked",false);
			// code to uncheck main menu
			$('.check__'+mid).each(function(index,item){
			    if($(this).prop("checked")){ flag=1; }
			    else{}
			});
			if(flag==1){
				$('.main_menu_class'+mid).prop("checked",true);
			}else{
				$('.main_menu_class'+mid).prop("checked",false);
			}
		}
	});
	$(document).on("change",".check_sub_sub_menu",function(){
		var str=$(this).attr('data-val');
		var a=str.split("-");
		var mid=a[0];
		var sid=a[0]+"."+a[1]; sid=a[1];
		var smid=a[0]+"."+a[1]+"."+a[2]; smid=a[2];
		var c=mid+""+sid;
		//alert(mid+" "+sid+" "+smid);
		if($(this).prop('checked')){
			$('.main_menu_class'+mid).prop("checked",true);
			$('.check_sub_menu_class'+sid).prop("checked",true);
		}else{
			var flag=0; var flag1=0;
			// code to uncheck sub menu
			$('.check_'+c).each(function(index,item){
			    if($(this).prop("checked")){ flag=1; }
			    else{}
			});
			if(flag==0){
				$('.check_sub_menu_class'+sid).prop("checked",false);
			}
			// code to uncheck main menu
			$('.check__'+mid).each(function(index,item){
			    if($(this).prop("checked")){ flag1=1; }
			    else{}
			});
			if(flag1==1){
				$('.main_menu_class'+mid).prop("checked",true);
			}else{
				$('.main_menu_class'+mid).prop("checked",false);
			}
		}
	});
</script>

