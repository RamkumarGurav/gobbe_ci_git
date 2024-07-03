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

                    <div class="tpi-pri-r">
                      <?php
        if($user_access->update_module==1)	{
        ?>
        <div class="tpi-active" >
            <a onclick="validateRecordsActivate()" class="btn4"><i class="fas fa-check"></i>
                Active</a>
        </div>
        <div class="tpi-block" >
            <a onclick="validateRecordsBlock()"class="btn5"><i class="fas fa-ban"></i>
                Block</a>
        </div>
        <?
        }
        ?>
                        <?php
              if($user_access->delete_module==1)	{
            ?>
                        <div class="tpi-delete" >
                            <a onclick="validateRecordsDelete()" class="btn3"><i class="fa-solid fa-trash"></i>
                                Delete</a>
                        </div>
                        <?
                      }
                        ?>
                        <?php
              if($user_access->add_module==1)	{
            ?>
                        <div class="tpi-cate-add">
                            <button type="button"onclick="editModule('<?=MAINSITE_Admin.$user_access->class_name?>',0)" class="btn2"><i class="fa-solid fa-plus"></i>
                              ADD  <?=$page_module_name?></button>
                        </div>
                        <?
                      }
                        ?>

                    </div>
                </div>
            </div>
            <?php echo form_open(MAINSITE_Admin."$user_access->class_name/listing", array('method' => 'post', 'id' => 'ptype_search_form' , "name"=>"ptype_search_form", 'style' => '', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>

            <div class="tpi-filter-row">
                <div class="tfr-inner">
                    <!-- <div class="tfr-box"> -->
                    <div class="tfrb-search">
                      <?php
                      $attributes = array(
                        'name'	=> 'field_value',
                        'id'	=> 'field_value',
                        'title' => "Field Value",
                          'class' => 'form-control',
                        'placeholder'=>"Search by $page_module_name",
                        'value'	=> set_value('field_value'),
                        );
                        echo form_input($attributes);
                      ?>
                    </div>
                    <div class="tfrb-btn">
                      <?php
                      $data = [
                          'name'    => 'search_report_btn',
                          'id'      => 'search_report_btn',
                          'value'   => '1',
                          'type'    => 'submit',
                          'content' => 'Filter',
                          'class' => 'btn2'
                        ];

                        echo form_button($data);
                      ?>
                      <?php
                      $data = [
                          'type'    => 'reset',
                          'content' => 'Reset',
                          'class' => 'btn1'
                        ];
                        echo form_button($data);
                      ?>
                    </div>
                    <!-- </div> -->
                </div>
            </div>
            <?php echo form_close() ?>
            <?php
    if($user_access->view_module==1)	{
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
                                <td class="px-4 py-2 ">NAME</td>
                          
                                <td class="px-4 py-2 ">ADDED ON</td>
                                <td class="px-4 py-2 ">ADDED BY</td>
                                <td class="px-4 py-2 text-center">PUBLISHED</td>

                                <td class="px-4 py-2 text-center">ACTIONS</td>
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
                                          value="<?php echo $urm->id; ?>"></td>
                                          <input type="hidden" name="sel_exrecds" value="<?php echo $urm->id; ?>">
                                  <td class="px-4 py-2">
                                      <div class="tpi-aid">
                                          <?= $count?>
                                      </div>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="tpt-aname">
                                  <?=$urm->name	?>
                                      </span>
                                  </td>

                                  <td class="px-4 py-2">
                                      <span class="tpt-adrp">
                                              <?=date("d-m-Y" , strtotime($urm->added_on))?>
                                      </span>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="tpt-adrp">
                                              <?=$urm->added_by_name?>
                                      </span>
                                  </td>
                                  <td class="px-4 py-2">
                                      <div class="tpt-publishd-btn">
                                          <label class="switch">
                                              <input type="checkbox" disabled  <? echo ($urm->status == 1)?'checked': '' ?>>
                                              <span class="slider round"></span>
                                          </label>
                                      </div>
                                  </td>

                                  <td class="px-4 py-2">
                                      <div class="tpt-action-btn">
                                        <?php
                              if($user_access->update_module==1)	{
                            ?>
                                          <div class="tpt-atr-edit">
                                              <a onclick="editModule('<?=MAINSITE_Admin.$user_access->class_name?>',<?=$urm->id?>)"><i
                                                      class="fa-solid fa-pen-to-square"></i></a>
                                          </div>
                                          <?
                                          }
                                          ?>
                                          <?php
                                if($user_access->delete_module==1)	{
                              ?>
                              <!-- <div class="tpt-ab-delete">
                                  <a href="#"><i class="fa-solid fa-trash"></i></a>
                              </div> -->
                              <?
                            }
                              ?>

                                      </div>
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
