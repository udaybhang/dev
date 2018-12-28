<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="row main">
<li class="panel panel-info">
                                            <div class="panel-heading ui-sortable-handle">
                        <h5>
                          1. Brief Summary                          <span class="Total_Brief_Summary"></span>
                          <div class="panel-actions">
                              <a href="#" class="panel-fullscreen-portlets" data-id="Resize_Brief_Summary" role="button" title="Toggle fullscreen" style="margin-right: 2px; display: none;"><i class="glyphicon glyphicon-resize-full" style="color: #fff;"></i>
                              </a>&nbsp;
                              <span class="pull-right" href="" style="margin-right: 2%;cursor:pointer" id="Link_Brief_Summary">
                                <i class="fa fa-share" aria-hidden="true" style="color:#fff;"></i>
                              </span>
                              <a class="accordion-toggle pull-right" data-toggle="collapse" data-parent="#accordion" href="#Brief_Summary"></a>
                          </div>
                        </h5>
                      </div>
                                           <div id="Brief_Summary" class="panel-collapse collapse in">
                          <div class="panel-body Brief_Summary">
                              <div class="table-responsive">
                                  <table class="table table-bordered mystyle" id="Portlet_Brief_Summary">
                                      <thead>
                                        <tr>
                                          <th>Date</th><th>Published Job</th><th>Unpublished Job</th><th>Applied Users</th><th>Offers</th>
                                          <th>Placed</th><th>Multi Applied Users</th><th>User applied in multiple jobs</th><th>Unique Users</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php for($i=0; $i<sizeof($company); $i++) {  ?>
                                          <tr class="<?php echo $company[$i]['employer_id'] ?>">
                                          <td>
                                              <a class="getRowData"  style="cursor: pointer;">
                                              <?php echo $company[$i]['employer_company'] ?>   </a>
                                          </td>
                                          <td></td><td></td><td></td>
                                          <td></td><td></td><td></td>
                                          <td></td><td></td>
                                        </tr>
                                        <?php }  ?>                                  
                                        </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </li>
                </div>
              </div>

<script type="text/javascript">
  $(".getRowData").click(function(){
    var data_val=$(this).parent().parent().attr("class");
    var this_val=$(this).parent().parent();
    $.ajax({
      method:"post",
      data:{"data_val":data_val},
      url:"<?php echo base_url() ?>employer-report-ajax",
      success:function(data){
        //alert(data);
        this_val.html("");
        this_val.append(data);
      }
    })
  });
</script>