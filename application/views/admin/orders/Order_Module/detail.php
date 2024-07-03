<div class="tpi-add-attr">

<div class="tpa-conp-inner">
    <div class="tpci-head">
        <div class="tpci-row-one">
            <div class="tpci-ro-inner">
                <div class="tpci-roi-l">
                    <h4>Order Details</h4>
                    <p>Order Details and necessary information from here</p>
                </div>
                <div class="tpci-roi-r">
                    <span class="tpa-conp-close"><i
                            class="fa-solid fa-xmark"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    <div class="tpci-tab-con">
        <div class="tpi-product-row p-0">
            <div class="tpi-pr-inner justify-content-end">

                <div class="tpi-pri-r">
                    <!-- <div class="od-ta-btn">
                        <a href="#" class="btn1" data-toggle="modal" data-target="#exampleModal"><i class="fa-solid fa-pen-to-square"></i>
                            Take Action</a>
                    </div>
                    <div class="od-po-btn">
                        <a href="#" class="btn2"><i class="fa-solid fa-print"></i>
                            Print Order</a>
                    </div> -->

                </div>
            </div>
        </div>
        <div class="pp-order-details">
                <div class="ppod-first">
                    <div class="row">
                        <div class="col-4">
                            <div class="ppodf-ic">
                                <h6>Order Number</h6>
                                <p><?=$list_data->order_number?></p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="ppodf-ic">
                                <h6>Order Placed On</h6>
                                <p><?=date("d-m-Y h:i:s A" , strtotime($list_data->added_on))?></p>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="ppodf-ic">
                                <h6>Last Action taken On</h6>
                                <p><?=date('d-m-Y h:i:s A', strtotime($list_data->updated_on))?></p>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="ppodf-ic">
                                <h6>Order Status</h6>
                                <p><?php if($list_data->order_status==1){echo "Order placed";}else if($list_data->order_status==2){echo "In Process";}else if($list_data->order_status==3){echo "Out For Delivery";}else if($list_data->order_status==4){echo "Delivered";}else if($list_data->order_status==5){echo "Not Deliver";}else if($list_data->order_status==6){echo "Cancelled";} ?></p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="ppodf-ic">
                                <h6>Customer Name</h6>
                                <p><?=$list_data->name	?></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="ppodf-ic">
                                <h6>Email</h6>
                                <p><?=$list_data->email?></p>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="ppodf-ic">
                                <h6>Customer Contact No.</h6>
                                <p><?=$list_data->d_number?></p>
                            </div>
                        </div>
                        <input type="hidden" id="orders_id" name="orders_id" value="<?=$list_data->orders_id?>" value="">

                          <? if(!empty($list_data->delivery_challan_no)){ ?>
                        <div class="col-4">
                            <div class="ppodf-ic">
                                <h6>Delivery Challan NO.</h6>
                                <p><?=$list_data->delivery_challan_no?></p>

                            </div>
                        </div>
                        <?}?>
                        <div class="col-4">
                            <div class="ppodf-ic">
                                <h6>Courier Name</h6>
                                <p><?php if(!empty($list_data->courier_name)) { echo $list_data->courier_name;} else { echo "N/A"; }?></p>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="ppodf-ic">
                                <h6>Docket No.</h6>
                                <p><?php if(!empty($list_data->docket_no)) { echo $list_data->docket_no;} else { echo "N/A"; }?></p>
                            </div>
                        </div>
                          <? if(!empty($list_data->file_link)){ ?>
                        <div class="col-2">
                            <div class="ppodf-ic">
                                <h6>Docket File</h6>
                                <p><a href="<?=base_url().'assets/docket/'.$list_data->file_link?>" target="_blank">View Docket File</a></p>
                            </div>
                        </div>
                        <?}?>
                        <div class="col-4">
                            <div class="ppodf-ic">
                                <h6>Total</h6>
                                <p><?=$list_data->symbol ?> <?=$list_data->total?></p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="ppodf-ic">
                                <h6>Payment Mode</h6>
                                <p> <?=$list_data->mode?></p>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="ppodf-ic">
                                <h6>Transaction ID</h6>
                                <p><?php if(!empty($list_data->txnid)) { echo $list_data->txnid; } else { echo "N/A" ;}?></p>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="ppodf-ic">
                                <h6>Bank ID</h6>
                                <p><?php if(!empty($list_data->mihpayid)) { echo $list_data->mihpayid; } else { echo "N/A" ;}?></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="ppodf-ic">
                                <h6>Delivery Address</h6>
                                <p>	<? echo $list_data->d_address;
											if(!empty($list_data->d_address2)){echo "<br>".$list_data->d_address2;}
											if(!empty($list_data->d_address3)){echo "<br>".$list_data->d_address3;}
											echo "<br>".$list_data->d_city_name." ($list_data->d_zipcode) ";
											echo "<br>".$list_data->d_state_name;
											echo "<br>".$list_data->d_country_name." ";
										?></p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="ppodf-ic">
                                <h6>Shipping Address</h6>
                                <p><? echo $list_data->b_address;
											if(!empty($list_data->b_address2)){echo "<br>".$list_data->b_address2;}
											if(!empty($list_data->b_address3)){echo "<br>".$list_data->b_address3;}
											echo "<br>".$list_data->b_city_name." ($list_data->b_zipcode) ";
											echo "<br>".$list_data->b_state_name;
											echo "<br>".$list_data->b_country_name." ";
										?></p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="pod-table tpi-product-table">
           <div class="tpt-inner">
            <div class="podt-title">
                <h3>Ordered Product In Detail</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <td class="px-4 py-2 ">Sl No.</td>
                        <td class="px-4 py-2 ">Item Name</td>
                        <td class="px-4 py-2 ">Manufacturer</td>
                        <td class="px-4 py-2 ">Price</td>
                        <td class="px-4 py-2 ">Final Price</td>
                        <td class="px-4 py-2 text-center">Qty</td>
                        <td class="px-4 py-2 text-center">Sub Total</td>
                    </tr>
                </thead>
                <tbody>

                  <?
$count = 0;
foreach($list_data->details as $order_details)
{$count++; //echo "<pre>";print_r($list_data->details);
?>
                        <tr>
                              <td class="px-4 py-2 "><?=$count?>.</td>
                              <td class="px-4 py-2 "><?php /*?><?=$odd->product_name?><br><?php */?><?=$order_details->product_display_name?><br><?=$order_details->combi?></td>
                              <td class="px-4 py-2 "><?=$order_details->brand_name?></td>
                              <?php /*?><td><?=$odd->prod_comment?></td><?php */?>
                              <td class="px-4 py-2 "><?=$list_data->symbol ?> <?=$order_details->price?></td>
                              <td class="px-4 py-2 "><?=$list_data->symbol ?> <?=$order_details->final_price?></td>
                              <td class="px-4 py-2 text-center"><?=$order_details->prod_in_cart?></td>
                              <td class="px-4 py-2 text-center"><?=$list_data->symbol ?> <?=$order_details->sub_total?></td>
                          </tr>
                    <? } ?>

<?
$colspan = 6;
?>
                    <? if(!empty($list_data->coupon_code)){

                 ?>
                                          <tr>
                                                <td class="px-4 py-2" colspan="<?=$colspan?>"  style="text-align:right">Coupon (<?=$list_data->coupon_code?>)</td>
                                                <td class="px-4 py-2 text-center"> <?=$list_data->discount?> %</td>
                                            </tr>
                                       <? } ?>
                                            <tr>
                                                <td class="px-4 py-2"colspan="<?=$colspan?>"  style="text-align:right"><span class="od-qty">
                                                      <b>GST Charges</b>
                                                  </span></td>
                                                <td class="px-4 py-2 text-center"><?=$list_data->symbol ?> <?=$list_data->total_gst?></td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2"colspan="<?=$colspan?>"  style="text-align:right">  <span class="od-qty">
                                                      <b>Delivery Charges</b>
                                                  </span></td>
                                                <td class="px-4 py-2 text-center" ><?=$list_data->symbol ?> <?=$list_data->delivery_charges?></td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2"colspan="<?=$colspan?>"  style="text-align:right"><span class="od-qty">
                                                      <b>COD Charges</b>
                                                  </span></td>
                                                <td class="px-4 py-2 text-center"><?=$list_data->symbol ?> <?=$list_data->cod_charges?></td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2"colspan="<?=$colspan?>"  style="text-align:right"><span class="od-qty">
                                                      <b>Total</b>
                                                  </span></td>
                                                <td class="px-4 py-2 text-center"><?=$list_data->symbol ?> <?=$list_data->total?></td>
                                            </tr>


                </tbody>

            </table>
           </div>
        </div>
        <?
if(!empty($list_data->order_status) && empty($list_data->docket_no))
{
	if($list_data->order_status==2 && $list_data->is_self_pickup==1)
	{
		$insurance=2;
		$service=2;
		$total_package_weight = round($list_data->total_weight/1000 , 3);
		$box_l = $box_b = $box_h = 10;
    ?>
    <div class="shipping-price">
        <div class="row align-items-center">
            <div class="col-5">
                <div class="shp-ic">
                    <div class="shp-icl">
                        <p>Package Weight (In Kg)</p>
                    </div>
                    <div class="shp-icr">
                        <div class="shp-icrf">
                            <input type="text" class="form-control" placeholder="1" name="total_package_weight" id="total_package_weight" value="<?=$total_package_weight?>"> <span>*</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="shp-ic">
                    <div class="shp-icl">
                        <p>Dimension (L*B*H)(In CM)</p>
                    </div>
                    <div class="shp-icr">
                        <div class="shp-icrf">
                            <input type="number" name="box_l" id="box_l" min="1" class="form-control" placeholder="Length" value="<?=$box_l?>"> <span>*</span>
                        </div>
                        <div class="shp-icrf">
                            <input type="number"name="box_b" id="box_b" min="1"  class="form-control" placeholder="Breadth"value="<?=$box_b?>"> <span>*</span>
                        </div>
                        <div class="shp-icrf">
                            <input type="number"  name="box_h" id="box_h" min="1"  class="form-control" placeholder="Height"value="<?=$box_h?>"> <span>*</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="shp-btn text-center">
                    <a onclick="CalculateShippingPrice()"  class="btn2">Get Shipping Price</a>
                </div>
            </div>
        </div>
        <div class="col-12" id="shipRicketResponseDiv">

        </div>

    </div>
    <?
  }
}

?>
<div class="label_data">

</div>

        <? if($list_data->is_courier_txn == 1){ ?>
          <div class="ship-procedure">
              <div class="podt-title">
                  <h3>Shipping Procedure</h3>
              </div>
              <diV class="shp-table tpi-product-table ">
                  <div class="tpt-inner">
                      <table>
                          <thead>
                              <tr>
                                  <td class="px-4 py-2 ">#</td>
                                  <td class="px-4 py-2 ">Label</td>
                                  <td class="px-4 py-2 ">Description</td>
                                  <td class="px-4 py-2 ">Action</td>
                              </tr>
                          </thead>
                          <tbody>
                              <!-- <tr>
                                  <td class="px-4 py-2">
                                      <span class="spr-no">1</span>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="spr-label">Pickup Request</span>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="spr-desc">Token : Reference No: 349872499 <br>
                                          Time : 23-05-2023 12:56:12 AM , Tuesday <br>
                                          Pickup is confirmed by Kerry Indev Express For AWB :- 2024592917</span>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="spr-action">Pickup Scheduled</span>
                                  </td>
                              </tr> -->
                              <tr>
                                  <td class="px-4 py-2">
                                      <span class="spr-no">1</span>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="spr-label">Shipping Label</span>
                                  </td>
                                  <td class="px-4 py-2">
                                    <? if(!empty($list_data->label_url)){ ?>
                                      <span class="spr-desc"><a href="<?=$list_data->label_url?>"  target="_blank" class="btn2 bg-ff tpc-cancel">Print/Download Shipping Label</a></span>

                                    <? }?>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="spr-action">Shipping Label Generated</span>
                                  </td>
                              </tr>
                              <tr>
                                  <td class="px-4 py-2">
                                      <span class="spr-no">2</span>
                                  </td>
                                  <td class="px-4 py-2">
                                  <span class="spr-label">Print Manifests</span>

                                  </td>
                                  <td class="px-4 py-2">
                                    <?
                                    if(!empty($list_data->manifest_url)){ ?>
                                      <span class="spr-desc"><a href="<?=$list_data->manifest_url?>"  target="_blank" class="btn2 bg-ff tpc-cancel">Print Manifest</a></span>
                                        <? }else{ ?>

                                      <a class="btn2 bg-ff tpc-cancel" onclick="assignShiprocketGenerateManifests()" class="btn btn-primary assignShiprocketGenerateManifestsBTN">Generate Manifests</a>
                                        <? } ?>
                                  </td>
                                  <td class="px-4 py-2">
                                    <?
                                    if(!empty($list_data->manifest_url)){ ?>
                                      <span class="spr-action">Manifests Generated</span>
                                        <? }else{ ?>
                                          <span class="spr-action"> Generated Manifest</span>
                                        <? } ?>
                                  </td>
                              </tr>

                              <!-- <tr>
                                  <td class="px-4 py-2">
                                      <span class="spr-no">4</span>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="spr-label">Shipping Invoice</span>
                                  </td>
                                  <td class="px-4 py-2">
                                    <? if(!empty($list_data->shipping_invoice_url)){ ?>
              <span class="spr-desc"><a href="<?=$list_data->shipping_invoice_url?>" target="_blank" class="btn2 bg-ff tpc-cancel">Print/Download Shipping Invoice</a></span>

              <? }else{ ?>
                <a class="btn2 bg-ff tpc-cancel" onclick="assignShiprocketOrderInvoice()"  class="btn btn-primary assignShiprocketOrderInvoiceBTN">Generate Shipping Invoice</a>


              <? } ?>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="spr-action">Shipping Invoice Generated</span>
                                  </td>
                              </tr> -->
                              <tr>
                                  <td class="px-4 py-2">
                                      <span class="spr-no">3</span>
                                  </td>
                                  <td class="px-4 py-2" colspan="2">
                                      <span class="spr-label">Tracking</span>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="spr-desc"><a onclick="trackShiprocketOrder()" class="btn2 bg-ff tpc-cancel trackShiprocketOrderBTN">Track Order</a></span>
                                  </td>
                              </tr>
                          </tbody>

                      </table>

                  </div>
                  <div class="col-md-12" id="shipRicketResponseDiv" style="color:green;font-size:30px;padding:10px;">
                                        </div>
              </diV>
          </div>
          <?
          }
          ?>

    </div>
    <!-- <div class="tpci-bottom">
        <div class="tpbt-inner">
            <a href="#" class="btn1 bg-ff tpc-cancel">Cancel</a>
            <a href="#" class="btn2">Update Order Details</a>
        </div>
    </div> -->

</div>

</div>
