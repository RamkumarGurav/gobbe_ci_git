<div class="dsm-main-content">
    <div class="cmc-tab">
        <div class="tab-pane-inner">
            <div class="tpi-title">
                <h4><?=$page_module_name?></h4>
            </div>
            <div class="tpi-product-row">
                <div class="tpi-pr-inner">
                    <div class="tpi-pri-l">
                      <?php
                      if($user_access->export_data==1)	{
                      ?>
                        <div class="tpi-pri-export">
                            <a href="#" class="btn1 export-btn"><i
                                    class="fa-solid fa-file-export"></i> Export</a>
                            <div class="exp-dd">
                                <ul>
                                    <li><a onclick="validateRecordsExport()"><i class="fa-solid fa-file"></i> Export
                                            to
                                            CSV</a></li>

                                </ul>
                            </div>
                        </div>
                        <?
                      }
                        ?>
                    </div>


                </div>
            </div>
          
            <?php
    if($user_access->view_module==1)	{
      // echo "<pre>";
      // print_r($list_data);
      // echo "</pre>";
  ?>
            <div class="tpi-product-table">

                <div class="tpt-inner">
                  <?php echo form_open(MAINSITE_Admin."$user_access->class_name/doUpdateStatus", array('method' => 'post', 'id' => 'ptype_list_form' , "name"=>"ptype_list_form", 'style' => '', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>
                  <input type="hidden" name="task" id="task" value="" />
                    <? echo $this->session->flashdata('alert_message'); ?>
                    <table  id="moduledatatable">
                        <thead>
                            <tr>
                                <td class="px-4 py-2 "><input class="selectAll" onclick="check_uncheck_All_records()" name="main_check" id="main_check"
                                        type="checkbox"></td>
                                <td class="px-4 py-2 ">ID</td>
                                <td class="px-4 py-2 ">PRODUCT NAME</td>
                                <td class="px-4 py-2 ">CATEGORY</td>
                                <td class="px-4 py-2 ">QUANTITY</td>
                                <td class="px-4 py-2 ">COMBINATION</td>
                                <td class="px-4 py-2 ">IMAGE</td>
                                <td class="px-4 py-2 ">ADDED ON</td>

                            </tr>
                        </thead>
                        <? if(!empty($list_data)){ ?>
                        <tbody>
                          <?
                          $offset_val = (int)$this->uri->segment(5);
                          $count=$offset_val;

                          foreach($list_data as $urm) {
                            $count++;
                              ?>
                              <tr>
                                  <td class="px-4 py-2"><input class="selectAll" name="sel_recds[]"
                                          type="checkbox" id="sel_recds<?php echo $count; ?>"
                                          value="<?php echo $urm->product_id; ?>"></td>
                                          <input type="hidden" name="sel_exrecds" value="<?php echo $urm->product_id; ?>">
                                  <td class="px-4 py-2">
                                      <div class="tpi-aid">
                                          <?= $count?>
                                      </div>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="tpt-aname">
                                  <?=$urm->product_name	?>
                                      </span>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="tpt-aname">
                                  <? if(!empty($urm->combi)){ ?>
          										<?
          										$category_name = explode("~;" , $urm->combi);
          										if(count($category_name)>1)
          										{
          											echo "<ol>";
          											foreach($category_name as $cn)
          											{
          												echo "<li>$cn</li>";
          											}
          											echo "</ol>";
          										}
          										else
          										{
          											echo $category_name[0];
          										}

          										?>

                                                  <? }else{echo "-";} ?>
                                                    </span>
                                                </td>
                                  <td class="px-4 py-2">
                                      <span class="tpt-adrp">
                                          <?=$urm->quantity?>
                                      </span>
                                  </td>
                                  <td class="px-4 py-2">
                                    <a class='btn btn-primary' data-toggle="modal" data-target="#myModal" onclick='productMoniter(<?=$urm->product_id?> , <?=$urm->product_combination_id?>)'
 style='padding:1px 5px;'><i class='fa fa-pencil'></i>Change Stock</a>
                                  </td>
                                  <td class="px-4 py-2">
                                    <a  href="<?=_uploaded_files_.'product/large/'?><?=$urm->product_image_name?>" target="_blank"><img src="<?=_uploaded_files_.'product/small/'?><?=$urm->product_image_name?>" width="75" /></a>

                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="tpt-adrp">
                                              <?=date("d-m-Y" , strtotime($urm->added_on))?>
                                      </span>
                                  </td>





                              </tr>
                              <?
                          }
                          ?>

                        </tbody>
                        <?
                        }
                        ?>
                    </table>
                    	<?php echo form_close() ?>
                      <center><div class="pagination_custum"><? echo $this->pagination->create_links(); ?></div></center>

                </div>
            </div>
            <?
          }else{
  $this->data['no_access_flash_message']="You Dont Have Access To View ".$page_module_name;
  $this->load->view('admin/template/access_denied' , $this->data);
} ?>


        </div>

    </div>


</div>
</div>
<div class="module_data">

</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product Quantity</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="editProduct" style="padding:30px !important">
        <p>Some text in the Modal Body</p>
      <p>Some other text...</p>
      </div>
      <div class="modal-footer">
       <h3 style="display:none">Modal Footer</h3>
      <h3 id="prodError"></h3>
      <div class="pull-right" id="DisplayLoading"></div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function productMoniter(product_id, combi_id)
{
document.getElementById("DisplayLoading").innerHTML = '<img src="<? echo MAINSITE."images/loading-dots.gif" ?>" />';
//modal.style.display = "block";
var myModal = new bootstrap.Modal(document.getElementById('myModal'));
 myModal.show();
//popUp("Fetching The Product List <i></i>" , 10000000);
$.ajax({
 type: "POST",
url:'<?=MAINSITE_Admin."catalog/Stock-Module/"?>GetCompleteProductsListInStoreMonitoringEditQtyPrice',
 //dataType : "json",
 data : {'product_id' : product_id , 'combi_id' : combi_id},
 success : function(result){
   // alert(result);
  $('#editProduct').html(result);
  document.getElementById("DisplayLoading").innerHTML = '';
//	document.getElementById("DisplayButton").innerHTML = '<img src="<? echo MAINSITE."images/loading-dots.gif" ?>" />';
  //ArrangeTable();
  //	popUp("Product List Fetched <i></i>" , 4000);
   }
 });
}
</script>
