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
                <div class="col-md-13">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="btn btn-default" onClick="printdiv('div_print');" value=" Print " style="float: right" id="noprint"><i class="fa fa-print" aria-hidden="true" style="font-size: 17px; "> Print</i>
                            </button>
                            <h3 class="modal-title" style="padding-left: 1%"><b>Blog Preview</b></h3>
                        </div>
                        <div class="box-body">
                            <div class="row invoice-info" style="padding-left: 2%; line-height: 10px">
                                <div class="col-sm-8 invoice-col">
                                   
                                   <div class="form-group">
                                        <label for="exampleInputEmail1">Category Name <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                            <?php echo $blog[0]['blog_category_name']; ?></span>
                                        </label>
                                   </div>
                                   <div class="form-group">
                                        <label for="exampleInputEmail1">Writer Name <span class="required-sp"></span>: 
                                            <span style="font-weight: 500;font-style: normal">
                                            <?php echo $blog[0]['blog_writer_name']; ?></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> Writer Name Show Status
                                            <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                            <?php if($blog[0]['blog_writer_name_status']==1){echo 'Active';}else{echo 'Inactive';} ?>
                                            </span>
                                        </label>
                                        <p></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Highlighter Show Status<span class="required-sp"></span>
                                            <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                            <?php if($blog[0]['blog_highlighter_status']==1){echo 'Active';}else{echo 'Inactive';} ?>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Publish Status<span class="required-sp"></span>
                                            <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                            <?php if($blog[0]['blog_publish_status']==0){
                                                    echo 'Pending';
                                                  }elseif($blog[0]['blog_publish_status']==1){
                                                    echo 'Published';
                                                  }elseif($blog[0]['blog_publish_status']==2){
                                                    echo 'Unpublished';
                                                  }elseif($blog[0]['blog_publish_status']==3){
                                                    echo 'Rejected';
                                                  } 
                                            ?>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Creation DateTime <span class="required-sp"></span>: 
                                            <span style="font-weight: 500;font-style: normal">
                                                <?php 
                                                    if($employer['employer_reg_date']!="0000-00-00 00:00:00"){echo date("d/m/Y g:i A", strtotime($employer['employer_reg_date']));}else{echo "Not Available";}
                                                ?>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Publish DateTime <span class="required-sp"></span>: 
                                            <span style="font-weight: 500;font-style: normal">
                                                <?php 
                                                    if($employer['employer_reg_date']!="0000-00-00 00:00:00"){echo date("d/m/Y g:i A", strtotime($employer['employer_reg_date']));}else{echo "Not Available";}
                                                ?>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Modification DateTime <span class="required-sp"></span>: 
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
                                        $img_path=base_url().'upload/blog/';
                                        if($blog[0]['blog_thumb_image']!=""){$img=$blog[0]['blog_thumb_image'];}else{$img="1521107545_thumb.jpg";}
                                    ?>
                                <img src="<?php echo $img_path.$img ?>" class="image-responsive" alt="Thumb Image Not Found" style="margin-top:2%" title="Thumb Image"/>
                                </div>
                            </div>
                            
                            <div class="modal-header" style="margin-top:20px !important">
                                <h3 class="modal-title"><b>Blog Title</b></h3>
                            </div>
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 invoice-col" style="padding-left: 25px;">
                                            <div class="form-group">
                                            <label for="exampleInputEmail1"><span style="font-weight: 500;font-style: normal">
                                                <?php echo $blog[0]['blog_title']; ?></span>
                                            </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-header" style="margin-top: -20px !important">
                                <h3 class="modal-title"><b>Highlighter Description</b></h3>
                            </div>
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 invoice-col" style="padding-left: 25px;">
                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Description <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                                <?php echo strip_tags($blog[0]['blog_highlighter_desc']); ?></span>
                                            </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-header" style="margin-top: -20px !important">
                                <h3 class="modal-title"><b>Banner Image</b></h3>
                            </div>
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 invoice-col" style="padding-left: 25px; line-height: 10px">
                                            <div class="form-group">
                                            <img src="<?php echo $img_path.$blog[0]['blog_banner_image'] ?>" class="image-responsive" alt="Banner Image Not Found" style="margin-top:2%" title="Banner Image"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="modal-header" style="margin-top: -20px !important">
                                <h3 class="modal-title"><b>Blog Content</b></h3>
                            </div>
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 invoice-col" style="padding-left: 25px;">
                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Description <span class="required-sp"></span>: <span style="font-weight: 500;font-style: normal">
                                                <?php echo $blog[0]['blog_content']; ?></span>
                                            </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                              <a href="<?php echo base_url()?>view-blog-list" class="btn btn-primary btn-md" style="float: left; background-color:#112B4E; border-color: #112B4E; margin-top: 15px;margin-left: 20px;margin-bottom: 20px;" id="noprint1">View All</a>
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