<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?=base_url()?>" rel='nofollow'><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Dashboard <span></span> Order Detail
            </div>
        </div>
    </div>
    <div class="page-content pt-50 pb-50">
        <div class="">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                      <?php $this->load->view('template/left-menu', $this->data);?>
                        <div class="col-md-9">
													<div  id="orders" role="tabpanel">
															<div class="card">
																	<div class="card-header">
																			<h3 class="mb-0">Order Detail</h3>
																	</div>
																	<?
																	if(!empty($orders)){
																		?>
																		<div class="card-body">
                                      <div class="invoice invoice-content invoice-3">

                      <div class="container">
                      <div class="row">
                      <div class="col-lg-12">
                      <div class="invoice-inner">
                      <div class="invoice-info" id="invoice_wrapper">
                      <div class="invoice-header">
                      <div class="row">

                          <div class="col-sm-8  text-end">
                              <div class="invoice-numb">
                                  <h4 class="invoice-header-1 mb-10 mt-20" style="font-size:20px;text-align: left;">My Order Details <br>(<?=$o->order_number?>) <span class="text-heading"></span></h4>
                                  <!-- <h6><span class="text-heading">Order Placed 04 Mar 24 | Order Processing 04 Mar 24 | In Transit | Delivered</span></h6> -->
                              </div>
                          </div>
                          <div class="col-sm-4">
                              <div class="invoice-name">
                                  <div class="logo">
                                      <a href="/"><img src="<?=IMAGE?>/gobbe.png" alt="logo" style="width: 200px;"></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                      </div>
                      <?
$order_on = '';
$is_processed = false;
$processed_on = '';
$is_shipped = false;
$shipped_on = '';
$is_delivered = false;
$delivered_on = '';


foreach($o->history as $h)
{
	if($h->order_status_id ==1)
	{
		$order_on = date('d M y' , strtotime($h->updated_on));
	}

	if($h->order_status_id ==2)
	{
		$is_processed = true;
		$processed_on = date('d M y' , strtotime($h->updated_on));
	}

	if($h->order_status_id ==3)
	{
		$is_shipped = true;
		$shipped_on = date('d M y' , strtotime($h->updated_on));
	}

	if($h->order_status_id ==4)
	{
		$is_delivered = true;
		$delivered_on = date('d M y' , strtotime($h->updated_on));
	}
}


?>

                      <div class="invoice-top">
                      <div class="row">
                           <div class="col-lg-6 col-md-6">
                              <div class="invoice-number">
                                  <h4 class="invoice-title-1 mb-10"> Order Details  </h4>
                                  <p class="invoice-addr-1">
                                      <strong>Order Placed <?=$order_on?></strong> <br>
                                      <?
                                      if($is_processed){
                                        ?>
                                        <strong> Order Processing <?=$processed_on?></strong> <br>

                                        <?
                                      }
                                      ?>
                                      <?
                                      if($is_shipped){
                                        ?>
                                        <strong> Shipped On <?=$processed_on?></strong> <br>

                                        <?
                                      }
                                      ?>
                                      <?
                                      if($is_delivered){
                                        ?>
                                        <strong> Shipped On <?=$delivered_on?></strong> <br>

                                        <?
                                      }
                                      ?>

                                  </p>
                              </div>
                          </div>
                           <div class="col-lg-6 col-md-6">
                              <div class="invoice-number">
                                  <h4 class="invoice-title-1 mb-10">Payment Details</h4>
                                  <p class="invoice-addr-1">
                                      <strong>Txn Id : <?=$o->txnid?></strong> <br>
                                      <strong> Payment Mode : <?=$o->mode?></strong> <br>
                                      <strong>Order Id : <?=$o->order_number?></strong> <br>
                                      <strong>Order On : <? echo date('d M y H:i:s' , strtotime($o->added_on)) ?></strong> <span class="text-brand"></span>
                                  </p>
                              </div>
                          </div>
                      </div>
                      <hr>
                      <div class="row">
                          <div class="col-lg-6 col-md-6">
                              <div class="invoice-number">
                                  <h4 class="invoice-title-1 mb-10">Billing Address</h4>
                                  <p class="invoice-addr-1">
                                    <strong><?=$o->d_name?></strong><br><?=$o->b_number?><br><?=$o->b_address?>,<br><?=$o->b_city_name?> - <?=$o->b_zipcode?><br><?=$o->b_state_name?><br><?=$o->b_country_name?><br>
                                      <abbr title="Phone">Phone:</abbr> <?=$o->b_number?>
                                  </p>
                              </div>
                          </div>
                          <div class="col-lg-6 col-md-6">
                              <div class="invoice-number">
                                  <h4 class="invoice-title-1 mb-10">Delivery Address</h4>
                                  <p class="invoice-addr-1">
                                    <strong><?=$o->d_name?></strong><br><?=$o->b_number?><br><?=$o->b_address?>,<br><?=$o->b_city_name?> - <?=$o->b_zipcode?><br><?=$o->b_state_name?><br><?=$o->b_country_name?><br>
                                    <abbr title="Phone">Phone:</abbr> <?=$o->d_number?>
                                  </p>
                              </div>
                          </div>

                      </div>
                      </div>
                      <?
$ordered_product = array();
foreach($o->details as $od){
	$is_exist = 0;
	$index = 0;
	if(!empty($ordered_product))
	{
		foreach($ordered_product as $key=>$op)
		{
			if($od->category_id == $key)
			{
				$index = $key;
				$is_exist = 1;
			}
		}
	}

	if($is_exist==1)
	{
		$ordered_product[$index]['data'][] = $od;
	}
	else
	{
		$ordered_product[$od->category_id]['category_name'] = $od->category_name;
		$ordered_product[$od->category_id]['category_id'] = $od->category_id;
		$ordered_product[$od->category_id]['data'][] = $od;
	}
}
//echo "<pre>";print_r($ordered_product);echo "</pre>";

$total_sub_total = 0;
$total_acctual_total = 0;
$total_delivery = 0;
$total_coupon_dis = 0;
?>

                      <div class="invoice-center">
                      <div class="table-responsive">
                          <table class="table table-striped invoice-table">
                              <thead class="bg-active">
                                  <tr>
                                      <th >Item Name</th>
                                      <th >Item Image</th>
                                      <th class="text-center">Unit Price</th>
                                      <th class="text-center">Quantity</th>
                                      <th class="text-right">Amount</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <? foreach($ordered_product as $op){ ?>


                    <?


      $cat_qty = 0;
      $cat_sub_total = 0;
      $cat_acctual_price = 0;
      foreach($op['data'] as $da)
      {
        $cat_sub_total += round(($da->final_price * $da->prod_in_cart) , 2);
        $cat_acctual_price += round(($da->prod_in_cart * $da->price) , 2);
        $cat_qty += $da->prod_in_cart;
      }
      $total_sub_total += $cat_sub_total;
      $total_acctual_total += $cat_acctual_price;
      ?>
              <tr>

                <th colspan="3"> <strong><?=$op['category_name']?></strong> </th>
                <th class="text-center"><?=$cat_qty?></th>
                <th><?=$o->symbol?> <?=$cat_sub_total?></th>
              </tr>

                <?
    $r_count = 0;
    foreach($op['data'] as $da)
    {$r_count++;
    ?>
    <?

$image_link = base_url().'assets/front/images/noimg.png';
if(!empty($da->product_image_name))
{
$image_link = base_url().'assets/uploads/product/small/'.$da->product_image_name;
}
?>
    <tr>
      <td class="text-center">
        <?=$r_count?>
      </td>
      <td  class="text-center">
          <img src="<?=$image_link?>">
      </td>
        <td >
            <div class="item-desc-1">
                <span><?=$od->product_name?></span>

            </div>
        </td>
        <td class="text-center"><?=$da->prod_in_cart?></td>
        <td class="text-right"><?=$o->symbol?> <?=$da->total?></td>
    </tr>

                <? } ?>


            <? } ?>


                                  <tr>
                                      <td colspan="4" class="text-end f-w-600">Net Amount</td>
                                      <td class="text-right"><?=$o->symbol?> <?=$o->sub_total ?></td>
                                  </tr>

                                  <tr>
                                      <td colspan="4" class="text-end f-w-600">Tax</td>
                                      <td class="text-right"><?=$o->symbol?> <?=$o->total_gst?></td>
                                  </tr>
                                  <tr>
                                      <td colspan="4" class="text-end f-w-600">SubTotal</td>
                                      <td class="text-right"><?=$o->symbol?> <?=$o->sub_total + $o->total_gst?></td>
                                  </tr>
                                  <tr>
                                      <td colspan="4" class="text-end f-w-600">Delivery Charges</td>
                                      <td class="text-right"><?=$o->symbol?> <?=$o->delivery_charges?></td>
                                  </tr>
                                  <? if($o->shipping_discount>0){ ?>

                                    <tr>
                                        <td colspan="4" class="text-end f-w-600">Shipping Discount</td>
                                        <td class="text-right"><?=$o->symbol?> <?=$o->shipping_discount?></td>
                                    </tr>
                                  <? } ?>
                              <? if($o->cod_charges>0){ ?>

                                <tr>
                                    <td colspan="4" class="text-end f-w-600">COD Charges</td>
                                    <td class="text-right"><?=$o->symbol?> <?=$o->cod_charges?></td>
                                </tr>
                              <? } ?>

                              <? if($o->total_packing_charges>0){ ?>

                                <tr>
                                    <td colspan="4" class="text-end f-w-600">Packing Charges</td>
                                    <td class="text-right"><?=$o->symbol?> <?=$o->total_packing_charges?></td>
                                </tr>
                              <? } ?>


                                  <tr>
                                      <td colspan="4" class="text-end f-w-600">Discount</td>
                                      <td class="text-right f-w-600"><?=$o->symbol?> <?=round(($total_acctual_total - $total_sub_total) , 2)?></td>
                                  </tr>
                                  <tr>
                                      <td colspan="4" class="text-end f-w-600">Grand Total</td>
                                      <td class="text-right f-w-600"><?=$o->symbol?> <?=$o->total?></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                      </div>

                      </div>

                      </div>
                      </div>
                      </div>
                      </div>
                      </div>
																		</div>
																		<?
																	}
																	?>

															</div>
													</div>
												</div>
										</div>
								</div>
						</div>
				</div>
		</div>
</main
