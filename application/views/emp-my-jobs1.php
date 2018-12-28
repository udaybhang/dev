
<style>
   .skin-blue .wrapper,
   .skin-blue .main-sidebar,
   .skin-blue .left-side {
   background-color: #fff;
   webkit-box-shadow: none !important;
   box-shadow: none !important;
   }
   .white-bg {
   background-color: #ffffff;
   }
   .b,
   .strong {
   font-weight: none !important;
   }
   .wrapper-content {
   padding: 2px 10px 40px;
   }

   .contact-box {
   background-color: #ffffff;
   border: 1px solid #e7eaec;
   padding: 15px;
   margin-bottom: 6px;
   }
   .form-horizontal .form-group {
   margin-right: -5px;
   margin-left: -6px;
   }
   .form-group {
   margin-bottom: 0px;
   }
   .btn-primary {
   background-color: #1ab394;
   border-color: #1ab394;
   color: #FFFFFF;
   }
   .btn-primary:hover,
   .btn-primary:active,
   .btn-primary.hover {
   background-color: #1ab394;
   border-color: #1ab394;
   }
   .ibox-title {
   -moz-border-bottom-colors: none;
   -moz-border-left-colors: none;
   -moz-border-right-colors: none;
   -moz-border-top-colors: none;
   background-color: #ffffff;
   border-color: #e7eaec;
   border-image: none;
   border-style: solid solid none;
   border-width: 2px 0 0;
   color: inherit;
   margin-bottom: 0;
   padding: 7px 15px 2px;
   min-height: 48px;
   }
   .ibox-content {
   background-color: #ffffff;
   color: inherit;
   padding: 13px 8px 16px 1px;
   border-color: #e7eaec;
   border-image: none;
   border-style: none;
   border-width: 1px 0;
   }
   tr:nth-child(even) {background: #f3f3f3}
   tr:nth-child(odd) {background: #FFF}
   .ibox1 {
   clear: both;
   margin-bottom: 0px;
   margin-top: 0;
   padding: 0;
   }
   .totalview{
   text-align: right;padding: 0px;
   }
   @media only screen and (max-width: 500px) {
   .totalview{
   text-align: left;margin-top: 10px;
   }
   }
   .small, small {
   font-size: 14px;
   }
   .btn-primary {
   background-color: #607D8B;
   border-color: #607d8b;
   color: #FFFFFF;
   }
   .ibox-content1 {
   background-color: #ffffff;
   color: inherit;
   padding: 0px;
   border-color: #e7eaec;
   border-image: none;
   border-style: none;
   border-width: 1px 0;
   }
   .ibox {
   clear: both;
   margin-bottom:0px; 
   margin-top: 0;
   padding: 0;
   }
   .hr-line-dashed {
   border-top: 1px dashed #e7eaec;
   color: #ffffff;
   background-color: #ffffff;
   height: 1px;
   margin: 6px 0;
   }
  .btn-circle {
    width: 30px;
    height: 30px;
    padding: 6px 0;
    border-radius: 15px;
    text-align: center;
    font-size: 12px;
    line-height: 1.428571429;
    background-color: #88acb4;
    border: 1px solid #88acb4;
    color: #fff;
}
.tip{
    display: inline;
    position: relative;
   /* background: none;*/
}

.tip:hover:after{
    background: rgba(0,0,0,.8);
    border-radius: 5px;
    bottom: 26px;
    color: #fff;
    font-size: 10px;
    content: attr(tip-title);
    left: 8%;
    padding: 3px 5px;
    position: absolute;
    z-index: 98;
    width: auto;
}
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>admin_assets/bootstrap-chosen.css">
<!-- DataTables -->
<script src="<?php echo base_url() ?>admin_assets/editor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>admin_assets/editor/samples/js/sample.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- <h2 style="margin-left:100px;"><?php echo $value;   ?></h2> -->

<div class="content-wrapper" style="background-color:#FAFAFA; border:none;">
   <div class="row wrapper border-bottom  page-heading" style="padding: 0px!important;margin-right: 0px!important;margin-left:0px!important;">
      <div class="col-lg-10" style="padding-left: 6px !important;">
         <h2 style="margin:0px; padding:0px;">My Jobs</h2>
         <ol class="breadcrumb" style="margin-left: 5px;">
            <li> <a href="<?php echo base_url();?>employer-dashboard">Dashboard</a> </li>
            <li> <a href="#">My Jobs</a> </li>
         </ol>
      </div>
   </div>
   <div class="wrapper wrapper-content animated fadeInRight">
      <div class="ibox float-e-margins">       
         <div class="row" style="margin-top: 35px;">
            <div class="col-lg-12">
               <div class="ibox1">
                   <div class="row">
                     <div class="col-lg-8">
                        <h5 style="font-size: 20px; color: #1ab394; padding-left: 10px;"><?php echo $message.' ('.count($jobs1).')'; ?></h5>
                     </div>
                     <form action="<?php echo base_url()?>employer-my-jobs" method="post" id="filter_check1">
                     <div class="col-lg-4">
                        <div class="col-md-8" style="padding: 5px;">
                           <div class="form-group">
                              <div>
                                 <select data-placeholder="Job Status..." class="chosen-select"  tabindex="2" id="job_status" name="job_status">
                                    <option value="">Select Status</option>
                                    <option value="1" <?php if($filter_status==1){ echo "selected='selected'";}?>>Published</option>
                                    <option value="0" <?php if($filter_status==0){ echo "selected='selected'";}?>>Pending</option>
                                    <option value="3" <?php if($filter_status==3){ echo "selected='selected'";}?>>Unpublished</option>
                                    <option value="2" <?php if($filter_status==2){ echo "selected='selected'";}?>>Rejected</option>
                                    <option value="All" <?php if($filter_status=='All'){ echo "selected='selected'";}?>>ALL</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4" style="padding: 5px;">
                           <button type="button" class="btn btn-w-m btn-warning" style="width: 100%;" id="filter_btn1">Filter</button>
                        </div>
                     </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div style="margin-left:150px;" id="aa"></div>
      <div class="row" >
         <div class="col-lg-12" >
            <div class="ibox">
               <div class="ibox-content1">
                  <div class="table-responsive">
                     <table id="job_table" class=" table table-stripped toggle-arrow-tiny default "  style="font-size: 14px; ">
                        <thead>
                           <tr>
                              <th >Created Date</th>
                              <th >Title</th>
                              <th >Min Neurons</th>
                              <th >CTC (In Lac)</th>
                              <th >Functional Area</th>
                              <th >Status</th>
                              <th >Publish Date</th>
                              <th >Applied</th>
                              <th >JAF Applied</th>
                              <th >Action</th>                           
                           </tr>
                        </thead>
                        <tbody id="job_status_data">
                               <?php 
                              $uid=$this->session->userdata('employer_id');
               
                              foreach ($jobs1 as $value){ 
                            $id=$value['job_id'];
                          $encoded_jid=rtrim(strtr(base64_encode($id), '+/', '-_'), '=');                 
                           ?>
                           <tr class="footable-even" style="">
                              <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                <?php echo date("d/m/Y g:i A", strtotime($value['job_created_date']));?>
                              </td>
                              <td class="footable-visible">
                                 <?php echo $value['job_title']; ?>
                                 <?php 
                                       $pk=$value['package_id']; 
                                        $pksk=$value['package_skills_id']; 
                                        $mm_neu=$value['required_system_neurons'];
                                       if($mm_neu==0 && $pk=='' && $pksk==''){ 
                                 ?>
                                      <br/><div style="margin-top: 2%"><span class="label label-danger">Unmapped</span>  </div>
                                 <?php   
                                       } else{ 
                                 ?>
                                      <br><div style="margin-top: 2%"><span class="label label-warning">Mapped
                                 <?php 
                                       if($mm_neu>0 && $pk=='' && $pksk=='') echo " By- MM Neurons";
                                       if($mm_neu==0 && $pk!='' && $pksk=='') echo " By- Package Neurons";
                                       if($mm_neu>0 && $pk!='' && $pksk!='') echo " By- MM Neurons, Package Neurons, Skills";
                                       if($mm_neu>0 && $pk!='' && $pksk=='') echo " By- MM Neurons, Package Neurons";
                                       if($mm_neu==0 && $pk!='' && $pksk!='') echo " By- Package Neurons, Skills";
                                 ?>
                                      </span>  </div>
                                 <?php   
                                       } 
                                 ?>
                              </td>
                             <td class="footable-visible">
                                 <?php echo $value['required_system_neurons']; ?>
                              </td>
                              <td class="footable-visible">
                                 <?php echo $value['ctc_from']."-".$value['ctc_to']; ?>
                              </td>
                              <td class="footable-visible">
                                 <?php echo $value['functional_name']; ?>
                              </td>
                               <td class="footable-visible">
                                 <a class="tip" tip-title="<?php if($value['status']==0){echo "Pending";}elseif($value['status']==1){echo "Published";}else{echo $value['remarks'];} ?>" style="cursor: default; text-decoration: none;">
                                     <?php $st=$value['status']; 
                                             if($st==0){
                                                echo 'Pending';                            
                                             }elseif($st==1){
                                                echo 'Published';                       
                                             }elseif($st==2){
                                                echo 'Rejected';                        
                                             }elseif($st==3){
                                                echo 'Unpublished';                        
                                             }
                                     ?>
                                  </a>
                              </td>
                                <td class="footable-visible">
                                 <?php if($value['publish_date']!="0000-00-00 00:00:00"){echo date("d/m/Y g:i A", strtotime($value['publish_date']));}else{echo "Not Available";} ?>
                              </td>              
                              <td class="footable-visible">                     
                                 <!--  48 views<br> -->
                                 <?php $tp=$this->Employer_model->get_total_applied($id);  ?>
                        <a href="<?php echo base_url().'applied-candidates/'.$encoded_jid; ?>"><span style="color:#1ab394"> <?php echo $value['applied']; ?> </span></a>
                              </td>
                  <td class="footable-visible">                     
                                 <!--  48 views<br> -->
                                 <?php  
                     $pack_id=$value['package_id'];
                     $count_val=0;
                     if($pack_id!=''){
                    $select="u_id";
                    $table_name="score";
                    $where="package_id in($pack_id) and u_id not in (select uid from mm_user_applied_job where job_id='$id') and u_id in (select mm_uid from user where user_type_id='2')";
                    $group="u_id";
                    $having="count(u_id) = (SELECT count(ml_id) FROM `master_level` WHERE `pack_id`  in($pack_id) and `ml_status` = '1')";
                    $order="score_id";
                    $limit ="";                      
                      $package_neurons=$this->Crud_modal->fetchdata_with_limit_and_having($select,$table_name,$where,$group,$having,$order,$limit);
                    $count_val=sizeof($package_neurons);
                     }
                if($value['not_applied']>0){
                 ?> 
                                 <a href="<?php echo base_url().'open-user-job/'.$encoded_jid; ?>"><span style="color:#1ab394"> <?php  echo $value['not_applied']; ?></span></a>
                              </td>
                     <?php }else {
                       echo "-";
                     } ?>
                           <td class="footable-visible" width="10%">
                              <?php $jid=$value['job_id']; $encoded_id=rtrim(strtr(base64_encode($jid), '+/', '-_'), '='); ?>
                                 <a href="<?php echo base_url().'view-job/'.$encoded_id; ?>" class="tip" tip-title="View">
                                    <button class="btn btn-circle" type="button"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                 </a>
                                  <?php if($value['status']!=0){ ?>
                                      <button class="btn btn-circle tip" tip-title="Edit" type="button"  onClick="alert('It cannot be Edited After Published.')">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                     </button>
                                    
                                 <?php }else{ if($tp['total_applied']!='0'){ ?>
                                    
                                    <a href="<?php echo base_url().'edit-emp-job-after-applied/'.$encoded_id; ?>" class="tip" tip-title="Edit">
                                      <button class="btn btn-circle" type="button">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                      </button>
                                    </a> 
                                 <?php }else{ ?>
                                    <a href="<?php echo base_url().'edit-emp-job/'.$encoded_id; ?>" class="tip" tip-title="Edit">
                                       <button class="btn btn-circle" type="button">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                      </button>
                                    </a>
                                 <?php }} ?>
                                 <button class="btn btn-circle share_job tip" type="button" tip-title="Unpublish" data-val="<?php echo $value['job_id']; ?>"  value="<?php echo $value['status']; ?>" aria-hidden="true"><i class="fa fa-share" aria-hidden="true"></i></button>


                                  <button class="btn btn-default btn-sm csv" data-val="<?=$encoded_jid ?>" data-date="<?= date("Y-m-d")?>" data-name="<?= $value['job_title'];?>" style="padding-right: 30px;margin-top: 5px;">
                                    <span><img src="<?= base_url()?>assets/images/button_loader.gif" width="15" style="margin-right:5px;visibility: hidden;">Get CSV</span>
                                  </button>  
                              </td>
                    
                           </tr>
                           <?php
                                
                              }

                           ?>
                           
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="excel">
  

</div>
<script src="<?php echo base_url(); ?>admin_assets/chosen.jquery.js"></script>
<script src="<?php echo base_url(); ?>admin_assets/jasny-bootstrap.min.js"></script>
<script type="text/javascript">
   $('.chosen-select').chosen({width: "100%"});
</script>

<script>
  

  $('.delete_job').click(function() {
      var dj = $(this).attr("data-val");
      var r= confirm("Are You Sure! You Want to Delete It.");  
      
      if (r == true) {
          $.ajax({
               type: "POST",
               data: { job_id:dj },
               url: "<?php echo base_url() ?>delete-emp-job",
               success: function(msg){
                    if(msg==1){
                     alert("Successfully Deleted"); 
                     location.reload();
                    }else{
                     alert("Something Went Wrong");
                    }
               },
               error: function(msg){
                     alert("Some Error Occurred!");
                    
               },
         });
      } else {
          
      }
      
   });
  $('.share_job').click(function() {
      var sj = $(this).attr("data-val");
      var status = $(this).val();
      if(status==1){
         r = confirm("Are You Sure! You Want to Unpublish It. "+"\n"+"After Unpublished, you will not be able to publish it in anyway.");
         st=3;
      }else{
         //r = confirm("Sorry! You have no permission to publish it.");
         alert("You cannot unpublish this job until it have 'Published' status");
         r=false;
      }

      if (r == true && st == 3) {
          $.ajax({
               type: "POST",
               data: { job_id:sj, status:st },
               url: "<?php echo base_url() ?>share-emp-job",
               success: function(msg){
                    if(msg==1){
                        if(st==1)
                           alert("Successfully Published");
                        if(st==3)
                           alert("Job Unpublished"); 
                           location.reload();
                    }
                    else
                     alert("Something Went Wrong");
               },
               error: function(msg){
                     alert("Some Error Occurred!");
                    
               },
         });
      } else {
          
      }
      
   });
  $(function () {    
     $('#job_table').DataTable({
       "paging": true,
       "lengthChange": false,
       "searching": false,
       "ordering": false,
       "info": true,
       "autoWidth": true
     });
   });

  // export to excel 

  var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
    return function(table, name) {
      //alert(name);
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    console.log(uri);
    //console.log(format(template, ctx));
    //console.log(uri + base64(format(template, ctx)));
    //window.location.href = uri + base64(format(template, ctx))
    //window.location.href = uri;
    var link = document.createElement("a");
    link.download = name;
    link.href = uri + base64(format(template, ctx));
    link.click();
  }
})()
  $(".csv").click(function (event) {
    var ths =$(this);
    $(this).attr("disabled",true);
  $(this).find('img').css("visibility","visible");   
  $.post("<?php echo base_url()?>employer/Employer/export_data",{code:$(this).attr('data-val')}, function (result){
      $("#excel").html(result);
    var filename = ths.attr("data-date")+'_'+ths.attr("data-name")+".xls";  
    tableToExcel('testtable1',filename);    
    ths.find('img').css("visibility","hidden"); 
    ths.attr("disabled",false);        
  }).fail(function() {
    alert( "Something went wrong." );
    ths.attr("disabled",false); 
  }) 

}); 
</script>
<script>
  
    $('#filter_btn1').on('click',function(){

      var selectoption = $('#job_status').val();
    
      $.ajax({
        method:"POST",
       url: "<?php echo base_url() ?>employer-my-jobs1",
       dataType:"json",
        data:{job_status:selectoption},

        success: function(res)
        {
           //console.log(res.job1);
          
          //   alert(res.message);
              //$("#aa").html(res.job1[1].job_id);
      
            // $("#gendata")  .html(e.job1);
            var employee_data='';
            for(i=0;i<res.job1.length;i++){
              var pk= res.job1[i].package_id; 
            
      var pksk=res.job1[i].package_skills_id; 

       var mm_neu=res.job1[i].required_system_neurons;

       //console.log(res.job1[i]);
       //alert(res.job1[i]);
              employee_data+='<tr>';
              employee_data+='<td>'+res.job1[i].job_created_date+'</td>';
              employee_data+='<td>'+res.job1[i].job_title;
              if(mm_neu==0 && pk=='' && pksk==''){ 
                                
                                      employee_data+='<br/>';
                                     employee_data+='<div style="margin-top: 2%"><span class="label label-danger">Unmapped</span>  </div>'; 
                                  
                                       } else{ 
                                
                                     employee_data+='<br><div style="margin-top: 2%"><span class="label label-warning">Mapped' ;
                                 
                                       if(mm_neu>0 && pk=='' && pksk=='') 
                                        employee_data+='By- MM Neurons';
                                        
                                       if(mm_neu==0 && pk!='' && pksk=='') 
                                        employee_data+='By- Package Neurons';

                                       if(mm_neu>0 && pk!='' && pksk!='') 
                                         employee_data+='By- MM Neurons, Package Neurons, Skills';
                                       
                                       if(mm_neu>0 && pk!='' && pksk=='') 
                                        employee_data+='By- MM Neurons, Package Neurons';

                                       if(mm_neu==0 && pk!='' && pksk!='') 
                                        employee_data+='By- Package Neurons, Skills';

                                
                                      employee_data+='</span>  </div>';
                                
                                       } 
                                employee_data+='</td>';
                            employee_data+='<td class="footable-visible">'+
                                 res.job1[i].required_system_neurons+
                              '</td>';
                              employee_data+='<td class="footable-visible">'+
                                 res.job1[i].ctc_from+'-'+res.job1[i].ctc_to+
                              '</td>';
                              
                              employee_data+='<td class="footable-visible">'+res.job1[i].functional_name+ '</td>';
                              employee_data+=' <td class="footable-visible"><a class="tip" tip-title=">';
                               if(res.job1[i].status==0){ 
                                employee_data+='Pending'+'"';
                               }
                               else if(res.job1[i].status==1){
                                employee_data+='Published'+'"';
                              }
                              else{
                                employee_data+=res.job1[i].remarks;} 
                                 // employee_data+='style="cursor: default; text-decoration: none;">';
                                     var st = res.job1[i].status; 
                                             if(st==0){
                                                 employee_data+='Pending'+'"';                            
                                             }else if(st==1){
                                               employee_data+='Published'+'"';                       
                                             }else if(st==2){
                                                employee_data+='Rejected'+'"';                        
                                             }else if(st==3){
                                               employee_data+='Unpublished'+'"';                        
                                             }
                                 
                                  +'</a></td>';
                              employee_data+='<td class="footable-visible"></td>';
                               
                             employee_data+='<td>';
                         // employee_data+='<a href="base_url+'applied+'-'+candidates+'/''>';
                        employee_data+='<span style="color:#1ab394">'+res.job1[i].applied+  '</span></a></td>';
                             employee_data+='<td></td>';
                             employee_data+='<td></td>';
                              employee_data+='<td class="footable-visible" width="10%">'+res.job1[i].job_id+
                              '<a href="" class="tip" tip-title="View"> <button class="btn btn-circle" type="button"><i class="fa fa-eye" aria-hidden="true"></i></button> </a>'; 
                            if(res.job1[i].status!=0){ 

                               employer_data+='<button class="btn btn-circle tip" tip-title="Edit" type="button"  >';
                                 employer_data+='<i class="fa fa-pencil-square-o" aria-hidden="true"></i>';
                                       employer_data+='</button>';
                                 }
                                     else{ if(1){ //$tp['total_applied']!='0'
                                      // employer_data+='<a href="<?php echo base_url().'edit-emp-job-after-applied/'.$encoded_id; ?>" class="tip" tip-title="Edit"> <button class="btn btn-circle" type="button"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button> </a> '; 
                                    }
                                    else
                                    {
                           //          employer_data+='<a href="<?php echo base_url().'edit-emp-job/'.$encoded_id; ?>" class="tip" tip-title="Edit"> <button class="btn btn-circle" type="button"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button> </a>'; 
                                   }
                                    }
                                   // employer_data+='<button class="btn btn-circle share_job tip" type="button" tip-title="Unpublish" data-val=" +res.job1[i].job_id+ "  value="+res.job1[i].status+" aria-hidden="true"><i class="fa fa-share" aria-hidden="true"></i></button>';
                                   // employer_data+='<button class="btn btn-default btn-sm csv" data-val="id" data-date="<?= date("Y-m-d")?>" data-name="<?= $value['job_title'];?>" style="padding-right: 30px;margin-top: 5px;"> <span><img src="<?= base_url()?>assets/images/button_loader.gif" width="15" style="margin-right:5px;visibility: hidden;">Get CSV</span> </button>'; 
                                   // employer_data+='</td>';
                             employee_data+='</tr>';
                              $('#job_status_data').append(employee_data);
                              console.log(employee_data);
                    
            }

        }
      })
    })
 
</script>