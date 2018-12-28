<style type="text/css"  media="print">
    @media print{
   #noprint,#noprint1{
       display:none;
       }
    }
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
                            <button class="btn btn-default" onClick="printdiv('div_print');" value=" Print " style="float: right" id="noprint"><i class="fa fa-print" aria-hidden="true" style="font-size: 17px; "> Print</i>
                            </button>
                            <h3 class="modal-title" style="padding-left: 1%"><b>Employer Details</b></h3>
                        </div>
                        <div class="box-body">
                            <div class="row invoice-info" style="padding-left: 2%; line-height: 10px">
                                <div class="col-sm-8 invoice-col">
                                   
                                   <div class="form-group">
                                        <label for="exampleInputEmail1">Industry Name <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                            <?php echo $employer['industry_name']?></span>
                                        </label>
                                   </div>
                                   <div class="form-group">
                                        <label for="exampleInputEmail1">Company Name <span class="required-sp"></span>: 
                                            <span style="font-weight: 500;font-style: normal">
                                            <?php echo $employer['employer_company']?></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> Contact Person Name
                                        <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal"><?php echo $employer['employer_contact_person_name'] ?></span>
                                        </label>
                                        <p></p>
                                    </div>
                                    <!-- /.col-lg-4 -->
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mobile No. <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                            <?php echo $employer['employer_mobile']?></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone No. <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                            <?php echo $employer['employer_phone']?></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                            <?php echo $employer['employer_email']?></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Alternate Email <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                            <?php echo $employer['alternate_email']?></span>
                                        </label>
                                       
                                    </div>
                                     <div class="form-group">
                                        <label for="exampleInputEmail1">Designation <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                            <?php echo $employer['designation']?></span>
                                        </label>
                                       
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Registration DateTime <span class="required-sp"></span>: 
                                            <span style="font-weight: 500;font-style: normal">
                                                <?php 
                                                    if($employer['employer_reg_date']!="0000-00-00 00:00:00"){echo date("d/m/Y g:i A", strtotime($employer['employer_reg_date']));}else{echo "Not Available";}
                                                ?>
                                            </span>
                                        </label>
                                       
                                    </div>
                                </div>

                                <div class="col-sm-5 invoice-col1" style="margin-left: -10%">
                                   
                                    <?php 
                                        $img_path=base_url().'upload/employer_upload/profile_pic/';
                                        if($employer['profile_pic']!=""){$img=$employer['profile_pic'];}else{$img="user.jpg";}
                                    ?>
                                    <img src="<?php echo $img_path.$img ?>" class="user-image" alt="Logo Image Not Found"  style="height:35%;width:35%;margin-top: 2%"/>
                                    <h4><strong><?php echo $employer['employer_company'] ?></strong></h4>
                                    <h5><strong><i class="fa fa-envelope margin-r-5"></i><?php echo $employer['employer_email']?></strong></h5>
                                    <h5><strong><i class="fa fa-phone margin-r-5"></i><?php echo $employer['employer_phone']?></strong></h5>
                                    <h5><strong><i class="fa fa-map-marker  margin-r-5"></i><?php echo $employer['employer_address']?></strong></h5>

                                    <!-- <h5><strong><i class="fa fa-location-arrow margin-r-5"></i><?php echo $employer['employer_contact_person_name']?></strong></h5> -->
                                    
                                </div>
                            </div>
                        <div class="modal-header">
                            <h3 class="modal-title"><b>Office Address</b></h3>
                        </div>
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="row" style="line-height: 10px">
                                    <div class="col-lg-12 invoice-col" style="padding-left: -3%; line-height: 10px">
                                    <?php 
                                        $cityId=$employer['employer_city_id'];
                                        $getCity=$this->Admindashboard_modal->get_city_name($cityId);
                                        $stateId=$getCity['state_id'];
                                        $getState=$this->Admindashboard_modal->get_state_name($stateId);
                                    ?>
                                        <div class="col-lg-6 invoice-col">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" style="font-size: 18px">Head Office <span class="required-sp"></span>:</label>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Address <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                                    <?php echo $employer['employer_address']; ?></span>
                                                </label>
                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">City <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                                    <?php echo $getCity['name']; ?></span>
                                                </label>
                                               
                                            </div>
                                             <div class="form-group">
                                                <label for="exampleInputEmail1">State <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                                    <?php echo $getState['name']; ?></span>
                                                </label>
                                               
                                            </div>
                                             <div class="form-group">
                                                <label for="exampleInputEmail1">Country <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                                    <?php echo 'India' ?></span>
                                                </label>
                                               
                                            </div>
                                             <div class="form-group">
                                                <label for="exampleInputEmail1">PinCode <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                                    <?php echo $employer['pincode'] ?></span>
                                                </label>
                                           
                                            </div>
                                        </div>
                                         <?php 
                                            $rcityId=$employer['reg_city'];
                                            $rgetCity=$this->Admindashboard_modal->get_city_name($rcityId);
                                            $rstateId=$employer['reg_state'];
                                            $rgetState=$this->Admindashboard_modal->get_state_name($rstateId);
                                        ?>
                                        <div class="col-lg-6 invoice-col">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" style="font-size: 18px">Regional Office <span class="required-sp"></span>:</label>
                                            </div>
                                             <div class="form-group">
                                                <label for="exampleInputEmail1">Address <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                                    <?php echo $employer['reg_address']; ?></span>
                                                </label>
                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">City <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                                    <?php echo $rgetCity['name']; ?></span>
                                                </label>
                                               
                                            </div>
                                             <div class="form-group">
                                                <label for="exampleInputEmail1">State <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                                    <?php echo $rgetState['name']; ?></span>
                                                </label>
                                               
                                            </div>
                                             <div class="form-group">
                                                <label for="exampleInputEmail1">Country <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                                    <?php echo 'India' ?></span>
                                                </label>
                                               
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">PinCode <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                                    <?php echo $employer['reg_pincode'] ?></span>
                                                </label>
                                           
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               
                            </div>
                            <div class="modal-header" style="margin-top: -20px !important">
                                <h3 class="modal-title"><b>Company Description</b></h3>
                            </div>
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 invoice-col" style="padding-left: 25px;">
                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Description  <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                                <?php echo $employer['employer_description'] ?></span>
                                            </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-header" style="margin-top: -20px !important">
                                <h3 class="modal-title"><b>Social Links</b></h3>
                            </div>
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 invoice-col" style="padding-left: 25px; line-height: 10px">
                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Website Link  <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                                <?php echo $employer['web_link'] ?></span>
                                            </label>
                                            </div>
                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Facebook Link  <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                                <?php echo $employer['fb_link'] ?></span>
                                            </label>
                                            </div>
                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Twitter Link  <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                                <?php echo $employer['twitter_link'] ?></span>
                                            </label>
                                            </div>
                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Linked Link  <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                                <?php echo $employer['linkedin_link'] ?></span>
                                            </label>
                                            </div>
                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Google Plus Link  <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                                <?php echo $employer['google_link'] ?></span>
                                            </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                              <a href="<?php echo base_url()?>employer-lists" class="btn btn-primary btn-md" style="float: left; background-color:#112B4E; border-color: #112B4E; margin-top: 15px;margin-left: 20px;margin-bottom: 20px;" id="noprint1">View All</a>
                              </div>
                        </div>
                        <!-- /.col-lg-6 -->
                      
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