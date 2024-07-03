<div class="dsm-main-content">
		<div class="cmc-tab">
			<div class="tab-pane-inner">
					<div class="tpi-title">
							<h4>Dashboard Overview</h4>
					</div>
					<div class="tpi-do-data">
							<div class="tpi-dd-inner">
									<div class="tpi-ddi-box">
											<div class="tpi-db-icon">
													<svg stroke="currentColor" fill="currentColor" stroke-width="0"
															version="1.1" viewBox="0 0 16 16" height="1em" width="1em"
															xmlns="http://www.w3.org/2000/svg">
															<path
																	d="M16 5l-8-4-8 4 8 4 8-4zM8 2.328l5.345 2.672-5.345 2.672-5.345-2.672 5.345-2.672zM14.398 7.199l1.602 0.801-8 4-8-4 1.602-0.801 6.398 3.199zM14.398 10.199l1.602 0.801-8 4-8-4 1.602-0.801 6.398 3.199z">
															</path>
													</svg>
											</div>
											<div class="tpi-db-title">
													<h4>Today Orders</h4>
											</div>
											<div class="tpi-db-dig">
													<h3><?=$today_orders[0]->total_orders?></h3>
											</div>
											<!-- <div class="tpi-db-con">
													<span>Cash : <br> $0.00</span>
													<span>Card : <br> $0.00</span>
													<span>Credit : <br> $0.00</span>
											</div> -->
									</div>
									<div class="tpi-ddi-box">
											<div class="tpi-db-icon">
													<svg stroke="currentColor" fill="currentColor" stroke-width="0"
															version="1.1" viewBox="0 0 16 16" height="1em" width="1em"
															xmlns="http://www.w3.org/2000/svg">
															<path
																	d="M16 5l-8-4-8 4 8 4 8-4zM8 2.328l5.345 2.672-5.345 2.672-5.345-2.672 5.345-2.672zM14.398 7.199l1.602 0.801-8 4-8-4 1.602-0.801 6.398 3.199zM14.398 10.199l1.602 0.801-8 4-8-4 1.602-0.801 6.398 3.199z">
															</path>
													</svg>
											</div>
											<div class="tpi-db-title">
													<h4>Yesterday Orders</h4>
											</div>
											<div class="tpi-db-dig">
													<h3><?=$yesterday_orders[0]->total_orders?></h3>
											</div>
											<!-- <div class="tpi-db-con">
													<span>Cash : <br> $467.15</span>
													<span>Card : <br> $0.00</span>
													<span>Credit : <br> $0.00</span>
											</div> -->
									</div>
									<div class="tpi-ddi-box">
											<div class="tpi-db-icon">
													<svg stroke="currentColor" fill="none" stroke-width="2"
															viewBox="0 0 24 24" stroke-linecap="round"
															stroke-linejoin="round" height="1em" width="1em"
															xmlns="http://www.w3.org/2000/svg">
															<circle cx="9" cy="21" r="1"></circle>
															<circle cx="20" cy="21" r="1"></circle>
															<path
																	d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
															</path>
													</svg>
											</div>
											<div class="tpi-db-title">
													<h4>This Month</h4>
											</div>
											<div class="tpi-db-dig">
													<h3><?=$this_monthorders[0]->total_orders?></h3>
											</div>
									</div>
									<div class="tpi-ddi-box">
											<div class="tpi-db-icon">
													<svg stroke="currentColor" fill="currentColor" stroke-width="0"
															version="1.1" viewBox="0 0 16 16" height="1em" width="1em"
															xmlns="http://www.w3.org/2000/svg">
															<path
																	d="M14.5 2h-13c-0.825 0-1.5 0.675-1.5 1.5v9c0 0.825 0.675 1.5 1.5 1.5h13c0.825 0 1.5-0.675 1.5-1.5v-9c0-0.825-0.675-1.5-1.5-1.5zM1.5 3h13c0.271 0 0.5 0.229 0.5 0.5v1.5h-14v-1.5c0-0.271 0.229-0.5 0.5-0.5zM14.5 13h-13c-0.271 0-0.5-0.229-0.5-0.5v-4.5h14v4.5c0 0.271-0.229 0.5-0.5 0.5zM2 10h1v2h-1zM4 10h1v2h-1zM6 10h1v2h-1z">
															</path>
													</svg>
											</div>
											<div class="tpi-db-title">
													<h4>Last Month</h4>
											</div>
											<div class="tpi-db-dig">
													<h3><?=$last_monthorders[0]->total_orders?></h3>
											</div>
									</div>
									<div class="tpi-ddi-box">
											<div class="tpi-db-icon">
													<svg stroke="currentColor" fill="currentColor" stroke-width="0"
															version="1.1" viewBox="0 0 16 16" height="1em" width="1em"
															xmlns="http://www.w3.org/2000/svg">
															<path
																	d="M14.5 2h-13c-0.825 0-1.5 0.675-1.5 1.5v9c0 0.825 0.675 1.5 1.5 1.5h13c0.825 0 1.5-0.675 1.5-1.5v-9c0-0.825-0.675-1.5-1.5-1.5zM1.5 3h13c0.271 0 0.5 0.229 0.5 0.5v1.5h-14v-1.5c0-0.271 0.229-0.5 0.5-0.5zM14.5 13h-13c-0.271 0-0.5-0.229-0.5-0.5v-4.5h14v4.5c0 0.271-0.229 0.5-0.5 0.5zM2 10h1v2h-1zM4 10h1v2h-1zM6 10h1v2h-1z">
															</path>
													</svg>
											</div>
											<div class="tpi-db-title">
													<h4>All-Time Sales</h4>
											</div>
											<div class="tpi-db-dig">
													<h3><?=$allorders[0]->total_orders?></h3>
											</div>
									</div>
							</div>
					</div>
					<div class="tpi-order-info">
							<div class="tpi-oi-inner">
									<div class="tpi-oii-box">
											<div class="tpi-oib-l">
													<span class="tpi-oibl-ic">
															<svg stroke="currentColor" fill="none" stroke-width="2"
																	viewBox="0 0 24 24" stroke-linecap="round"
																	stroke-linejoin="round" height="1em" width="1em"
																	xmlns="http://www.w3.org/2000/svg">
																	<circle cx="9" cy="21" r="1"></circle>
																	<circle cx="20" cy="21" r="1"></circle>
																	<path
																			d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6">
																	</path>
															</svg>
													</span>
											</div>
											<div class="tpi-oib-r">
													<p>Total Order</p>
													<h3><?=$orderStatusData[1];?></h3>
											</div>
									</div>
									<div class="tpi-oii-box">
											<div class="tpi-oib-l">
													<span class="tpi-oibl-ic">
															<svg stroke="currentColor" fill="none" stroke-width="2"
																	viewBox="0 0 24 24" stroke-linecap="round"
																	stroke-linejoin="round" height="1em" width="1em"
																	xmlns="http://www.w3.org/2000/svg">
																	<polyline points="23 4 23 10 17 10"></polyline>
																	<polyline points="1 20 1 14 7 14"></polyline>
																	<path
																			d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15">
																	</path>
															</svg>
													</span>
											</div>
											<div class="tpi-oib-r">
													<p>Orders Process</p>
													<h3><?=$orderStatusData[2];?></h3>
											</div>
									</div>
									<div class="tpi-oii-box">
											<div class="tpi-oib-l">
													<span class="tpi-oibl-ic">
															<svg stroke="currentColor" fill="none" stroke-width="2"
																	viewBox="0 0 24 24" stroke-linecap="round"
																	stroke-linejoin="round" height="1em" width="1em"
																	xmlns="http://www.w3.org/2000/svg">
																	<rect x="1" y="3" width="15" height="13"></rect>
																	<polygon points="16 8 20 8 23 11 23 16 16 16 16 8">
																	</polygon>
																	<circle cx="5.5" cy="18.5" r="2.5"></circle>
																	<circle cx="18.5" cy="18.5" r="2.5"></circle>
															</svg>
													</span>
											</div>
											<div class="tpi-oib-r">
													<p>Orders Shipped</p>
													<h3><?=$orderStatusData[3];?></h3>
											</div>
									</div>
									<div class="tpi-oii-box">
											<div class="tpi-oib-l">
													<span class="tpi-oibl-ic">
															<svg stroke="currentColor" fill="none" stroke-width="2"
																	viewBox="0 0 24 24" stroke-linecap="round"
																	stroke-linejoin="round" height="1em" width="1em"
																	xmlns="http://www.w3.org/2000/svg">
																	<polyline points="20 6 9 17 4 12"></polyline>
															</svg>


													</span>
											</div>
											<div class="tpi-oib-r">
													<p>Orders Delivered</p>
													<h3><?=$orderStatusData[4];?></h3>
											</div>
									</div>
									<div class="tpi-oii-box">
											<div class="tpi-oib-l">
													<span class="tpi-oibl-ic">
														<svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
															<line x1="18" y1="6" x2="6" y2="18"></line>
															<line x1="6" y1="6" x2="18" y2="18"></line>
														</svg>


													</span>
											</div>
											<div class="tpi-oib-r">
													<p>Orders Cancelled</p>
													<h3><?=$orderStatusData[6];?></h3>
											</div>
									</div>

							</div>
					</div>
					<div class="tpi-do-chart">
							<div class="tpi-doc-inner">
									<div class="tpi-doc-l">
											<div class="cell">
													<h2>Weekly Sales</h2>
													<div id="cont" class="do-chart"></div>
											</div>
									</div>
									<div class="tpi-doc-r">
											<h2>Best Selling Products</h2>

											<figure class="pie-chart">
													<figcaption>
															Coal 38<span style="color:#4e79a7"></span><br>
															Natural Gas 23<span style="color:#f28e2c"></span><br>
															Hydro 16<span style="color:#e15759"></span><br>
															Nuclear 10<span style="color:#76b7b2"></span><br>
															Renewable 6<span style="color:#59a14f"></span><br>
															Other 7<span style="color:#edc949"></span><br>
															fsf 15<span style="color:#af7aa1"></span><br>
															56465456 20<span style="color:#ff9da7"></span>
													</figcaption>
											</figure>
									</div>
							</div>
					</div>
					<div class="tpi-do-recent-order">
							<div class="do-title">
									<h2>Today Orders</h2>
							</div>
							<div class="tpi-product-table">

									<div class="tpt-inner">
										<input type="hidden" name="task" id="task" value="" />

											<table  id="moduledatatable">
													<thead>
															<tr>

																					<td class="px-4 py-2 ">Order No</td>
																					<td class="px-4 py-2 ">Order Time</td>
																					<td class="px-4 py-2 ">Customer Name</td>
																					<td class="px-4 py-2 ">Method</td>
																					<td class="px-4 py-2 ">Amount</td>
																					<td class="px-4 py-2 ">Status</td>

															</tr>
													</thead>
													<? if(!empty($list_data)){ ?>
													<tbody>
														<?
														$offset_val = (int)$this->uri->segment(5);
														$count=$offset_val;

														$status_options = array(
															''=>'Select',
															'1'=>'Order Placed',
															'2'=>'InProcess',
															'3'=>'Out For Delivery',
															'4'=>'Delivered',
															'5'=>'Not Delivered',
															'6'=>'Cancelled',
														);

														foreach($list_data as $urm) {
															$count++;
																?>
																<tr>

																		<td class="px-4 py-2">
																				<span class="tpt-aname">
																		<?=$urm->order_number	?>
																				</span>
																		</td>

																		<td class="px-4 py-2">
																				<span class="tpt-adrp">
																								<?=date("d-m-Y h:i:s A" , strtotime($urm->added_on))?>
																				</span>
																		</td>
																		<td class="px-4 py-2">
																				<span class="tpt-aname">
																		<?=$urm->name	?>
																				</span>
																		</td>
																		<td class="px-4 py-2">
																				<span class="tpt-aname">
																		<?=$urm->mode	?>
																				</span>
																		</td>
																		<td class="px-4 py-2">
																				<span class="tpt-aname">
																	<?=$urm->symbol	?>  <?=$urm->amount	?>
																				</span>
																		</td>
																		<td class="px-4 py-2">
																			<span class="od-action">

																						<?php
																						echo $status_options[$urm->order_status_id];

																						?>
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

									</div>
							</div>
							
					</div>

			</div>
</div>
</div>
