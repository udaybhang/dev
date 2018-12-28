<script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<style>
    .image-preview-input {
        position: relative;
        overflow: hidden;
        margin: 0px;
        color: #333;
        background-color: #fff;
        border-color: #ccc;
    }
    
    .image-preview-input input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    
    .image-preview-input-title {
        margin-left: 2px;
    }
    
    .button {
        border: none;
        outline: 0;
        padding: 10px 25px;
        vertical-align: middle;
        overflow: hidden;
        text-decoration: none;
        color: #fff;
        text-align: center;
        cursor: pointer;
        font-size: 16px;
        outline: none;
    }
    
    .assignMnt .assignMntH {
        font-size: 30px;
        color: #00376F;
        font-weight: 600;
        padding: 0 0 40px 0;
        font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }
    
    .assignMntIn .assignMntH2 {
        float: left;
        width: 100%;
        border-bottom: 1px solid #ddd;
        padding: 0 0 15px 0;
        color: #112b4e;
        font-weight: 400;
        font-size: 18px;
        font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }
    
    a.list-group-item:focus,
    a.list-group-item:hover {
        background: #112B4E;
        color: #fff;
    }
    
    .ticket-panel-heading {
        background: #112b4e;
        !important;
    }
    
    .ticket-panel-title {
        padding: 11px;
        margin-top: 0;
        margin-bottom: 0;
        font-size: 16px;
        color: #fff;
    }
    
    .panel-heading+.list-group .list-group-item:first-child {
        color: #6a7483;
    }
    
    .panel-default>.panel-heading {
        color: #fff;
        background-color: #112b4e;
        border-color: #ddd;
    }
    
    .list-group-item {
        position: relative;
        display: block;
        padding: 2px 19px;
        margin-bottom: -1px;
        background-color: #fff;
        border: 1px solid #ddd;
    }
    
    .panel > .list-group .ticket-details-children .title {
        font-weight: bold;
    }
    
    .useyr {
        background: #e0c0bd;
        font-size: 21px;
        float: left;
        width: 100%;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:#fff;">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="padding: 14px 15px 0 24px;">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a> </li>
            <li class="active">Dashboard</li>
            <li class="active">Support Ticket</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- /.box-header -->
        <!-- /1 .row started -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="assignMnt lev1">
                        <div class="assignMntH"><i class="fa fa-ticket" aria-hidden="true" style="margin-right:1%"></i>Reply</div>
                    </div>
                    <?php

				if($this->session->flashdata('data_message')){

					echo $this->session->flashdata('data_message');

				}

				?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <?php if($ticket[0]['status']==1){?>
                    <div class="col-md-12">
                        <div class="panel panel-collapsable" style="color: #fff;
    background-color: #112b4e;">
                            <div class="ticket-panel-heading" id="#Demo">
                                <div data-toggle="collapse" data-target="#demo">
                                    <h3 class="ticket-panel-title">
                <i class="fa fa-pencil"></i> &nbsp; Reply
				 <i class="fa fa-minus pull-right" style="cursor: pointer;"></i>
            </h3> </div>
                            </div>
                        </div>
                        <div id="demo" class="collapse">
                            <div class="panel-body panel-body-collapsed" style="display: block; 
    background-color: #fafafa;    border-radius: 3px;">
                                <form method="POST" action="<?php echo base_url()?>user-chat" enctype="multipart/form-data" role="form" id="frmReply">
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label for="inputName">Name</label>
                                            <input class="form-control readonly" type="text" id="inputName" name="user_name" value="<?php echo $ticket[0]['name']?>" readonly> </div>
                                        <div class="form-group col-sm-4">
                                            <label for="inputEmail">Email Address</label>
                                            <input class="form-control readonly" type="text" id="inputEmail" name="user_mail" value="<?php echo $ticket[0]['email_id']?>" readonly> </div>
                                        <div class="form-group col-sm-4">
                                            <label for="inputEmail">Subject</label>
                                            <input class="form-control readonly" type="text" name="subject" value="<?php echo $ticket[0]['subject']?>" readonly> </div>
                                        <input type="hidden" name="uid" value="<?php echo $ticket[0]['uid']?>">
                                        <input type="hidden" name="ticket_id" value="<?php echo $ticket[0]['ticket_id']?>">
                                        <input type="hidden" name="ticket_sequence_id" value="<?php echo $ticket[0]['ticket_sequence_no'];?>">  
                                    </div>
                                    <div class="form-group">
                                        <label for="inputMessage">Message</label>
                                        <textarea name="replymessage" id="inputMessage" rows="12" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group text-center">
                                        <input class="btn btn-primary" type="submit" name="save" value="Reply">
                                        <input class="btn btn-default" type="reset" value="Cancel"> </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- /.box -->

                <div class="col-md-12">
                    <div class="panel-group">
                    <?php foreach ($chat as $message) { ?>
                        <div class="panel panel-default">
                            <div class="ticket-panel-heading ticket-panel-title">
                                <div class="date pull-right"><?php echo date('y-m-d');?></div>
                                <div class="user">
                                <i class="fa fa-user"></i>
                                    <span
                                    class="name"><?php if($message['user_message']!=''){echo "User";} else{ echo "Admin";}?></span> <span class="type">
                                          
                                    </span>                                     </div>
                            </div>
                            <div class="panel-body">
                                <div class="ticket-reply staff">
                                    <div class="message"> 
                                            <?php
                                        if($message['user_message']!=''){
                                        
                                        if($message['attachment']!=''){
                                        	$filsss = '<a download href="'.base_url().'upload/'. $message['attachment'].'">Download File</a>';
                                        }else{
                                        	$filsss = '';
                                        }
                                            
                                       echo $filsss;
                                        }  echo $message['user_message'];?>

                                           <?php 
                                        if($message['admin_message']!=''){
                                        
                                            }
                                        echo $message['admin_message'];
                                        
                                        ?>
                                        <!--    <div class="clearfix"></div>
                                            <div class="pull-right"> <i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i>                                             <i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></div> -->
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

<?php }?>
                
            </div>
        </div>

                        </div>
                        

                                          
                                                 <!--    <?php foreach ($chat as $message) { ?>
                                                    
                                                            <?php if($message['user_message']!=''){
                                                    echo "user message:-";  
                                                     echo $message['user_message']; 
                                                } 
                                                  if($message['attachment']!=''){ ?>
                                                                <a download href="<?php echo base_url()?>upload/<?php echo $message['attachment'] ?>">Download file</a>
                                                                <?php }?>
                                                        </div>
                                                     
                                                            <?php if($message['admin_message']!=''){
                                                            echo "Admin message:-";
                                                            echo $message['admin_message'];
                                                                }
                                                            

                                                            }?> -->

                                                


             

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="ticket-panel-heading">
                            <h3 class="ticket-panel-title">
                <i class="fa fa-ticket"></i>&nbsp;                Ticket Information
                            </h3>
                        </div>
                        <div class="list-group">
                            <div class="list-group-item ticket-details-children">
                                Ticket No.:
                                <?php echo $ticket[0]['ticket_sequence_no'];?><span class="label" style="<?php if($ticket[0]['status']==1){echo" background:red ";}else{ echo "background: green ";}?>"><?php if($ticket[0]['status']==1){echo "open";}else{echo "closed";}?></span>
                            </div>
                            <div class="list-group-item ticket-details-children">
                                <span class="title">Department</span>
                                <br>
                                <?php echo $ticket[0]['department'];?>
                            </div>
                            <div class="list-group-item ticket-details-children">
                                <span class="title">Submitted</span>
                                <br>
                                <?php echo $ticket[0]['created_date'];?>
                            </div>
                            <div class="list-group-item ticket-details-children">
                                <span class="title">Last Updated</span>
                                <br>
                                <?php echo $ticket[0]['created_date'];?>
                            </div>
                            <div class="list-group-item ticket-details-children">
                                <span class="title">Priority:</span>
                                <?php echo $ticket[0]['priority'];?>
                            </div>
                        </div>
                        <div class="panel-footer clearfix">
                            <?php if($ticket[0]['status']==1){?>
                            <div class="col-xs-6 col-button-left">
                                <button type="button" class="button btn-danger" data-toggle="collapse" data-target="#demo">
                                    <i class="fa fa-pencil"></i> Reply
                                </button>
                            </div>
                            <?php } ?>
                            <div class="col-button-right pull-right">
                                <button class="button btn-danger closebox" <?php if($ticket[0]['status']==1){ echo 'data-ticket="'.rtrim(strtr(base64_encode($ticket[0]["ticket_id"]), '+/', '-_'), '=').'"';}else{echo 'disabled=disabled '.' data-ticket=""';}?>><i class="fa fa-times"></i> Closed</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- /.box-body -->
</div>

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
    $(function() {
        $("#example123").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
    $('.closebox').click(function(){
        var ticket_id=$(this).attr('data-ticket');
        if(ticket_id!=''){
            window.location.href="<?php echo base_url() ?>ticket-close-admin/"+ticket_id;
        }
    });
</script>
 <script>
     CKEDITOR.replace( 'replymessage' );
  </script>             