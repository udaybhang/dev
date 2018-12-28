<style>
    .invoice {
    position: relative;
    background: #fff;
    border: 1px solid #f4f4f4;
    padding: 0px 16px;
    margin: 114px 25px;
    padding-bottom: 20px;
    }
    .table>thead>tr>th {
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
    .thead {
    align-content: center;
    }
    .required-sp + span{
            font-style:italic;
                
    }
</style>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 style="margin-left: 13px;">
        Dashboard
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a>
        </li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<!-- Main content -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="container">
                <!-- Modal -->
                <!-- Modal content-->
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="btn btn-default" onClick="printdiv('div_print');" value=" Print " style="float: right"><i class="fa fa-print" aria-hidden="true" style="font-size: 17px; "> Print</i>
                            </button>
                            <h3 class="modal-title"><b>Personal Profile</b></h3>
                        </div>
                        <div class="box-body">
                            <div class="row invoice-info">
                                <div class="col-sm-8 invoice-col">
                                    <div class="form-group ">
                                        <label for="exampleInputEmail1">Position Applied For
                                        <span class="required-sp">
                                       </span><span></span> 
                                        </label>
                                        <div class="selection-box">
                                           
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Father / Husband Name
                                        <span class="required-sp"></span>: <span><?php echo $udata[0]->father_name?></span>
                                        </label>
                                        <p></p>
                                    </div>
                                    <!-- /.col-lg-4 -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Father / Husband Occupation <span class="required-sp"></span>: <span><?php echo $udata[0]->fa_hu_occupation?></span>
                                        </label>
                                       
                                    </div>
                                    <div class="form-group">
                                        <label>DOB<span class="required-sp"></span>: <span><?php echo $udata[0]->dob?></span>
                                        </label>
                                        <div class="input-group date"
                                            <p></p>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Present Address (A)
                                        <span class="required-sp">
                                       </span>: <span><?php echo $udata[0]->present_addr?></span>
                                        </label>
                                      
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Permanent Address(B)
                                        <span class="required-sp">
                                       </span>: <span><?php echo $udata[0]->permanent_addr?></span>
                                        </label>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Emergency Contact No
                                        <span class="required-sp">
                                       </span>: <span><?php echo $udata[0]->emergency_cell?></span>
                                        </label>
                                       
                                    </div>
                                </div>
                                <div class="col-sm-4 invoice-col1">
                                     <img style="border:1px solid #aeaeae;" src="<?php echo base_url()?>upload/users_profile_pic/<?php echo $udata[0]->image?>" class="img-responsive" />
                                    <h4><strong><?php echo $udata[0]->mm_user_full_name?></strong></h4>
                                    <h5><strong><i class="fa fa-envelope margin-r-5"></i><?php echo $udata[0]->mm_user_email?></strong></h5>
                                    <h5><strong><i class="fa fa-phone margin-r-5"></i><?php echo $udata[0]->contact_number?></strong></h5>
                                    <h5><strong><i class="fa fa-map-marker  margin-r-5"></i><?php echo $udata[0]->cityname?></strong></h5>
                                    <h5><strong><i class="fa fa-location-arrow margin-r-5"></i><?php echo $udata[0]->statename?></strong></h5>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="modal-header">
                            <h3 class="modal-title"><b>Education Profile</b></h3>
                        </div>
                        <div class="box box-primary">
                           
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-lg-12 invoice-col2">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <h4 class="border-title ">
                                                    <b>SSC (Class X) Examination Details</b>
                                                    <p></p>
                                                </h4>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ">
                                            <div class="col-sm-3">
                                                <b>(X) Board</b>
                                                <b><span class="required-sp"></span>: <span><?php echo $udata[0]->board_name?></span></b>
                                                <p></p>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">(X) Year of Passing
                                                    <span class="required-sp">
                                                    
                                                    </span>: <span><?php echo $udata[0]->ssc_year_pass?></span>
                                                    </label>
                                                    <p></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">(X) % of Marks
                                                    <span class="required-sp">
                                                    
                                                    </span>: <span><?php echo $udata[0]->ssc_marks_per?></span>
                                                    </label>
                                                    <p></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">(X) Achievements  <span class="required-sp">
                                                    
                                                    </span>: <span><?php echo $udata[0]->ssc_achievements?></span> </label>
                                                    <p></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               
                            
                                <!-- x detail finish content-->
                                <div class="col-lg-12 invoice-col2">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <h4 class="border-title">
                                                <b>HSC (Class XII) Examination Details</b>
                                                <p></p>
                                            </h4>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">(XII) Board
                                                <span class="required-sp">
                                                
                                                </span>: <span><?php echo $udata[0]->XIIBoard?></span>
                                                </label>
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">(XII) Year of Passing
                                                <span class="required-sp"></span>: <span><?php echo $udata[0]->hsc_year_pass?></span>
                                                </label>
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">(XII) % of Marks
                                                <span class="required-sp">
                                                
                                                </span>: <span><?php echo $udata[0]->hsc_marks_per?></span>
                                                </label>
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">(XII) Achievements<span class="required-sp">
                                                
                                                </span>: <span><?php echo $udata[0]->hsc_achievements?></span> </label>
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								</div>
                                <hr>
                                <!-- xii detail finish content-->
                                <!-- x detail finish content-->
							<div class="row">
								<div class="col-lg-12 invoice-col2" >
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <h4 class="border-title  ">
                                            <b>Graduation Examination Details</b>
                                            
                                        </h4>
                                        <hr>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Degree
                                        <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->gdegreename?></span>
                                        </label>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Institution
                                        <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->gun_name?></span>
                                        </label>
                                     
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Year of Passing
                                        <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->grad_year_pass?></span>
                                        </label>
                                     
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">% of Marks
                                        <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->grad_marks_per?></span>
                                        </label>
                                       
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Achievements   <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->grad_achievements?></span></label>
                                        
                                    </div>
                                </div>
								</div>
                                <!-- xii detail finish content-->
                                <!-- x detail finish content-->
								<div class="col-lg-12 invoice-col2">
                                <div class="col-lg-12 ">
                                    <div class="form-group ">
                                        <h4 class="border-title ">
                                            <b>Post Graduation Examination Details</b>
                                            <p></p>
                                        </h4>
                                        <hr>
                                    </div>
                                    <div class="divider "></div>
                                </div>
							<div class="col-lg-12">
                                <div class="col-lg-3 ">
                                    <div class="form-group ">
                                        <label for="exampleInputEmail1 ">PG Degree
                                        <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->pgdegreename?></span></label>
                                       
                                    </div>
                                </div>
                                <div class="col-lg-3 ">
                                    <div class="form-group ">
                                        <label for="exampleInputEmail1 ">PG Institute
                                        <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->pgun_name?></span></label>
                                       
                                    </div>
                                </div>
								<div class="col-lg-12">
                                <div class="col-lg-3 ">
                                    <div class="form-group ">
                                        <label for="exampleInputEmail1 ">(PG) Year of Passing
                                        <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->pg_year_pass ?></span>
                                        </label>
                                       
                                    </div>
                                </div>
                                <div class="col-lg-3 ">
                                    <div class="form-group ">
                                        <label>(PG) % of Marks
                                        <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->pg_marks_per?></span>
                                        </label>
                                       
                                    </div>
                                </div>
                                <div class="col-lg-3 ">
                                    <div class="form-group ">
                                        <label for="exampleInputEmail1 ">(PG) Achievements
                                        <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->pg_achievements?></span></label>
                                        
                                    </div>
                                </div>
								</div>
								</div>
								</div>
                                <div class="col-sm-12">
                                    <div class="col-lg-4 invoice-col4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">CAT Score (If Applicable)
                                            <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->cat_score?></span>
                                            </label>
                                           
                                        </div>
                                    </div>
                                    <div class="col-lg-4 invoice-col4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">GMAT Score (If Applicable)
                                            <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->gmat_score?></span>
                                            </label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-4 invoice-col4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">JEE Score (If Applicable)
                                            <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->jee_core?></span>
                                            </label>
                                           
                                        </div>
                                    </div>
                                </div>
                                <!-- xii detail finish content-->
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="modal-header">
                            <h3 class="modal-title"><b>Work Experience</b></h3>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                            </div>
                            <div class="box-body">
                                <div class="row">
									<div class="col-lg-12 invoice-col2">
										
                                    <div class="col-lg-12">
                                        <h4 class="border-title">
                                            <b>First Organization Details</b>
                                           
                                        </h4>
                                        <hr>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Organization Name
                                            <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->org_name1 ?></span>
                                            </label>
                                           
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Designation
                                            <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->designnation_1 ?></span></label>
                                           
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Employment Period(From)
                                           <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->emp1_from ?></span> </label>
                                           
                                        </div>
                                    </div>
									
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Employment Period(To)
                                           <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->emp1_from ?></span> </label>
                                        
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">CTC-at the time of joining
                                            <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->ctc_join_1 ?></span></label>
                                           
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">CTC-at the time of exit
                                           <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->ctc_left_1 ?></span> </label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">
                                            Reason of Leaving <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->reason_leave1 ?></span></label>
                                            <p></p>
                                        </div>
                                    </div>
								</div>
                                    <!-- First Og End -->
									<div class="col-lg-12 invoice-col2">
                                    <div class="col-lg-12">
                                        <h4 class="border-title">
                                            <b>Second Organization Details</b>
                                            <p></p>
                                        </h4>
                                        <hr>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Organization Name
                                            <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->org_name2 ?></span>
                                            </label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Designation <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->designnation_2 ?></span></label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Employment Period(From)
                                          
                                          <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->emp2_from ?></span> </label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Employment Period(To)
                                           <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->emp2_to ?></span> </label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">CTC-at the time of joining
                                            <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->ctc_join_2 ?></span></label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">CTC-at the time of exit
                                            <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->ctc_left_2 ?></span></label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">
                                            Reason of Leaving <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->reason_leave2 ?></span></label>
                                            <p></p>
                                        </div>
                                    </div>
									</div>
                                    <!-- /Second Og End -->
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <h4 class="border-title"><b>Third Organization Details</b></h4>
                                            <hr>
                                        </div>
                                        <div class="col-lg-3 invoice-col4">
                                            <label for="exampleInputEmail1">Organization Name
                                           <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->org_name3 ?></span> </label>
                                            <p></p>
                                        </div>
                                        <div class="col-lg-3 invoice-col4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Designation <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->designnation_3 ?></span></label>
                                                <p></p>
                                            </div>
                                        </div>
                                        <!-- /.col-lg-6 -->
                                        <div class="col-lg-3 invoice-col4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Employment Period(From)
                                                <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->emp3_from ?></span></label>
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 invoice-col4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Employment Period(To) <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->emp3_to ?></span></label>
                                                <p></p>
                                            </div>
                                        </div>
                                        <!-- /.col-lg-6 -->
                                        <div class="col-lg-4 invoice-col4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">CTC-at the time of joining <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->permanent_addr ?></span></label>
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 invoice-col4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">CTC-at the time of exit <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->ctc_join_3 ?></span></label>
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 invoice-col4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">
                                                Reason of Leaving <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->ctc_left_3 ?></span></label>
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Salary Expected Per Month
                                                <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->reason_leave3 ?></span>
                                                </label>
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>If selected, when can you join (Notice Period)
                                                <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->notice_period ?></span>
                                                </label>
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-header">
                            <h3 class="modal-title"><b>References</b></h3>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                            </div>
                            <div class="box-body">
                                <div class="row">
									<div class="col-md-12 invoice-col2">
                                    <div class="col-lg-12">
                                        <h4 class="border-title">
                                            <b>1 Reference</b>
                                            <p></p>
                                        </h4>
                                        <hr>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->ref_1_name ?></span></label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Address <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->ref_1_add ?></span></label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Occupation <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->ref_1_occu ?></span></label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Telephone No
                                            <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->ref_1_cell ?></span></label>
                                            <p></p>
                                        </div>
                                    </div>
									</div>
                                    <!-- First Og End -->
									 <div class="col-lg-12 invoice-col2">
                                    <div class="col-lg-12">
                                        <h4 class="border-title">
                                            <b>2 Reference</b>
                                            <p></p>
                                        </h4>
                                        <hr>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->ref_2_name ?></span></label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Address <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->ref_2_add ?></span></label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Occupation <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->ref_2_occu ?></span></label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Telephone No
                                           <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->ref_2_cell ?></span> </label>
                                            <p></p>
                                        </div>
                                    </div>
									 </div>
                                    <div class="col-lg-12">
                                        <hr>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>May we make discrete enquiries about you from them
                                      <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->discrete_enquiries ?></span>
                                        </label>
                                        <br>
                                        <p></p>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>If Referred, Please mention the name of the employee
                                      <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->refrered_name ?></span>
                                        </label>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal content-->
                        <div class="modal-header">
                            <h3 class="modal-title"><b>Family Background</b></h3>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                            </div>
                            <div class="box-body">
                                <div class="row">
									<div class="col-md-12 invoice-col2">
                                    <div class="col-lg-12 ">
                                        <h4 class="border-title">
                                            <b>Father</b><span class="required-sp"></span>
                                            <p></p>
                                        </h4>
                                        <hr>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Age(years)
                                        <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->father_age ?></span>
                                            </label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Education
                                          <span class="required-sp">
                                        
                                        </span>: <span><?php $deg= $udata[0]->father_edu;$degname=$this->Crud_modal->fetch_single_data("degree_name","master_degree","md_id='$deg'"); echo $degname['degree_name']; ?></span>
                                            </label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Occupation
                                          <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->father_occu ?></span>
                                            </label>
                                            <p></p>
                                        </div>
                                    </div>
									</div>
                                    <!-- First Og End -->
									<div class="col-lg-12 invoice-col2">
                                    <div class="col-lg-12">
                                        <h4 class="border-title">
                                            <b>Mother</b>
                                            <p></p>
                                        </h4>
                                        <hr>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Age(years)
                                           <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->mother_age ?></span>
                                            </label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Education
                                           <span class="required-sp">
                                        
                                        </span>: <span><?php $deg=  $udata[0]->mother_edu; $degname=$this->Crud_modal->fetch_single_data("degree_name","master_degree","md_id='$deg'"); echo $degname['degree_name']; ?></span>
                                            </label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Occupation
                                           <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->mother_occu;  ?></span>
                                            </label>
                                            <p></p>
                                        </div>
                                    </div>
									</div>
                                    <!-- /Second Og End -->
                                    <div class="col-lg-12">
                                        <h4 class="border-title">
                                            <b>Spouse</b>
                                            <p></p>
                                        </h4>
                                        <hr>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Age(years)   <span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->spouse_age ?></span></label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Education  <span class="required-sp">
                                        
                                        </span>: <span><?php $deg= $udata[0]->spouse_edu;$degname=$this->Crud_modal->fetch_single_data("degree_name","master_degree","md_id='$deg'"); echo $degname['degree_name']; ?></span></label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Occupation  <span class="required-sp">
                                        
                                        </span>: <span><?php  $udata[0]->spouse_occu; ?></span></label>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Have you been involved personally in any leagal/criminal processdings?<span class="required-sp">
                                        
                                        </span>: <span><?php echo $udata[0]->crime_involve ?></span></label>
                                            </label>
                                            <br>
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
</section>
<script language="javascript">
    function printdiv() {
       window.print();
    }
</script>
	</div>