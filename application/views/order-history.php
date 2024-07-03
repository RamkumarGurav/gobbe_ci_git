<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?=base_url()?>" rel='nofollow'><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Dashboard <span></span> Orders
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
																			<h3 class="mb-0">Your Orders</h3>
																	</div>
																	<?
																	if(!empty($orders)){
																		?>
																		<div class="card-body">
																				<div class="table-responsive">
																						<table class="table table-striped">
																								<thead>
																										<tr>
																												<th>Order</th>
																												<th>Date</th>
																												<th>Status</th>
																												<th>Total</th>
																												<th>Actions</th>
																										</tr>
																								</thead>
																								<tbody>

																									<?
																											foreach ($orders as $o){
																									?>
																										<tr>
																												<td><?=$o->order_number?></td>
																												<td><?=date("D, d M y" , strtotime($o->added_on))?></td>
																												<td><?=$o->order_status_display_user?></td>
																												<td><?=$o->symbol?> <?=$o->total?> for <?=$o->total_prod?> item</td>
																												<td><a href="<?=base_url().'order-details/'.$o->orders_id?>"class="btn-small d-block">View</a></td>
																										</tr>
																										<?
																									}
																										?>
																								</tbody>
																						</table>

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
