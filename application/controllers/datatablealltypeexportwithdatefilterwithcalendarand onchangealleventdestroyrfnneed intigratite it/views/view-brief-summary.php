<style type="text/css">
#draggablePanelList .panel-heading {
   cursor: move;
}
#draggablePanelList2 .panel-heading {
   cursor: move;
   }
   body {
   font-family: "open sans", "Helvetica Neue", Helvetica, Arial, sans-serif!important;
   font-size:13px;
   }
   @media screen and (min-width: 1024px) and (max-width: 2000px) {
   .table-responsive {
   min-height: .01%;
   overflow-x:auto;
   }
   .box_padd{padding-left:0px; margin-top: 20px;}
   .content-wrapper, .right-side {
   min-height: 100%;
   background-color: #fff;
   z-index: 800;
   }
   }
   @media screen and (min-width: 600px) and (max-width: 2000px) {
   .panel-body{height:580px; overflow-x:auto;overflow-y:auto;padding: 0px!important;}
   }
   /*  ..panel-info>.panel-heading{background-color: #112b4ed9!important; padding: 1px 1px 1px 10px!important;font-weight: 700;}*/
   .panel-info>.panel-heading > h5{font-weight: 500;font-size:13px!important;color:#fff!important;font-family: "open sans", "Helvetica Neue", Helvetica, Arial, sans-serif!important;}
   thead{background-color:#fafafa;}
   .ibox{ margin-top: 3%;}
   #mydiv {
   position: absolute;
   z-index: 9;
   }
   .panel-info>.panel-heading {
   background-color: #112b4ed9!important; padding: 1px 1px 1px 10px!important;font-weight: 700;color: #fff!important;
   }
   #mydivheader {
   cursor: move;
   }
   .panel-info {
   border-color: #344b681a;
   border-radius: 0px;}
   .panel-heading .accordion-toggle:after {
    /* symbol for "opening" panels */
    font-family: 'Glyphicons Halflings';  /* essential for enabling glyphicon */
    content: "\e114";    /* adjust as needed, taken from bootstrap.css */
    float: right;        /* adjust as needed */
    color: #fff; 
    margin-right: 10px;        /* adjust as needed */
}
.panel-heading .accordion-toggle.collapsed:after {
    /* symbol for "collapsed" panels */
    content: "\e113";    /* adjust as needed, taken from bootstrap.css */
}
.mystyle{
  font-size:12px;
}
.inner_txt{
  font-size:11px;
}
/*top boxes css start*/
.top_box_padd{padding: 0px 15px 0px 15px;}
.ibox {
    clear: both;
    margin-bottom: 25px;
    margin-top: 0;
    padding: 0;
    border: 1px solid #ddd;
}
.ibox-title {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #ffffff;
    border-color: #e7eaec;
    border-image: none;
    border-width: 2px 0 0;
    color: inherit;
    margin-bottom: 0;
    padding: 15px 15px 7px;
    min-height: 48px;
}
.ibox-content {
    clear: both;
}

.ibox-content {
    background-color: #ffffff;
    color: inherit;
    padding: 15px 20px 20px 20px;
    border-color: #e7eaec;
    border-image: none;
    border-style: solid solid none;
    border-width: 1px 0;
}
.ibox-title h5 {
   font-weight: 600;
    display: inline-block;
    font-size: 16px;
    margin: 0 0 7px;
    padding: 0;
    text-overflow: ellipsis;
    float: left;
}

.nav .label, .ibox .label {
    font-size: 10px;
}

.label-success, .badge-success {
    background-color: #1c84c6;
    color: #FFFFFF;
}

.label {
   margin-right: 2px;
    background-color: #d1dade;
    color: #5e5e5e;
    font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    font-weight: 600;
    padding: 3px 8px;
    text-shadow: none;
}
.no-margins {
    margin: 0 !important;
}

h1 {
    font-size: 30px;
}
.text-success {
    color: #1c84c6;
}

.font-bold {
    font-weight: 600;
}

.stat-percent {
    float: right;
}
.small, small {
    font-size: 85%;
}
/*top boxes css end*/
 .panel-actions {
   margin-top: -20px;
   margin-bottom: 0;
   text-align: right;
   }
   .panel-actions a {
   color:#333;
   }
   .panel-fullscreen {
   display: block;
   z-index: 9999;
   position: fixed;
   width: 100%;
   height: 100%;
   top: 0;
   right: 0;
   left: 0;
   bottom: 0;
   overflow-x: auto;
   }
   .old_user, .userdate{
    cursor: pointer;
    color:#3c8dbc;
   }
</style>
<script src="https://code.jquery.com/jquery-2.2.0.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<div class="content-wrapper">
   <!-- Main content -->
   <div class=" wrapper-content" style="margin-left:1%;margin-right:0%;margin-top: 2%;">
   <!-- Ends first row -->
     <div class="">
        <div class="row">
          <div class="col-md-12">
            <form action="<?php echo base_url() ?>view-brief-summary" method="post" id="Search_form">
              <label style="float:left"> Start Date : </label>
              <div class="col-md-2">
                 <input type="text" class="form-control datecalender" name="todate" value="<?php if($t_date !=''){ echo $t_date;}?>"/>
                 
              </div>
              <label style="float: left">End Date : </label>
              <div class="col-md-2">
                <input type="text" class="form-control datecalender" name="fromdate" value="<?php if($f_date !=''){ echo $f_date;}?>"/>
                
              </div>
              <div class="col-md-1">
                 <input type="Submit" class="btn btn-primary btn-md"  id="search_button" value="Submit">
              </div>
            </form>
         </div>
          </div>
          <div class="col-md-12">
            <ul id="draggablePanelList" class="list-unstyled">
             
             <div class="col-lg-12 col-md-12 box_padd" >
                  <li class="panel panel-info">
                     
                      <div class="panel-heading">
                        <h5>
                          Brief Summary
                        </h5>
                      </div>
                    
                      <div class="panel-collapse collapse in">
                          <div class="panel-body">
                              <div class="table-responsive" >
                                  <table class="table table-bordered mystyle">
                                      <thead>
                                        <tr>
                                          <th>Date</th><th>New User</th><th>Attempted Level(Neurons)</th>
                                          <th>Old Attempted User</th><th>Attempted Level(Neurons)</th><th>Total Level</th>
                                          <th>Total Neurons</th><th>All Users</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                        $kk=0;
                                              while (strtotime($curdate) >= strtotime($end_date)) {

                                        ?>
                                        <tr class="test<?php echo $kk ?>">
                                          <td>
                                              <a class="getRowData" data-val="<?php echo $curdate; ?>" style="cursor: pointer;">
                                              <?php 
                                                  echo date('M j, Y',strtotime($curdate));
                                                  $curdate = date ("Y-m-d", strtotime("-1 day", strtotime($curdate)));
                                                  $kk++;
                                              ?>
                                             </a>
                                          </td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                        </tr>
                                        <?php } ?>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </li>
            </div>
             
            </ul>
          </div>
        </div>
      </div>

    </div>
  
</div>
<!-- end first row -->
<form id="datewise" method="post" action="<?php echo base_url()?>day-user-report">
  <input type="hidden" name="userdate" value="" />
</form>
<form id="datewise_olduser" method="post" action="<?php echo base_url()?>day-old-user-report">
  <input type="hidden" name="olduser_date" value="" />
</form>

<script type="text/javascript">
$(document).ready(function() {
 $(".datecalender").click(function (){
     $(this).datepicker("show").on('change', function () {
     $('.datepicker').hide();
   });
 });
});
  $(document).on('click',".getRowData",function(){
    var curr_class=$(this).parent().parent().attr("class");
    var a=$(this).attr('data-val');
    $("."+curr_class).html('<td colspan=8 align=center>Loading...</td>');
    $.ajax({ 
        type:"POST",
        data:{'date':a}, 
        url:"<?php echo base_url()?>get-mm-summary", 
        async:true,
        success:function(message){
          $("."+curr_class).html("");    
          $("."+curr_class).html(message);     
        },
        error:function(){
          alert('Some Error Occurred!');
        }
      
      }); 
  });

 $(document).on('click',".old_user",function(){
    var dateval = $(this).attr('data-date');
    if(dateval!=''){
      $('input[name="olduser_date"').val(dateval);  
      $('#datewise_olduser').submit();
   }
 });
 $(document).on('click',".userdate",function(){
  var dateval = $(this).attr('data-date');
  if(dateval!=''){
    $('input[name="userdate"').val($(this).attr('data-date'));
    $('#datewise').submit();
  }
});
</script>
