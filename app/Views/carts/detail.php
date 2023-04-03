<!-- Shoping Cart -->
<?php include __VIEW__ . 'alert.php'; ?>

<div class="bg0 p-t-75 p-b-85">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
				<form>
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
									<th class="column-6">Delete</th>
								</tr>

								<?php 
									$sum = 0;
									foreach($_SESSION['cart'] as $productId => $product) { 
										$sumProduct = (float)$product['price'] * (int)$product['qty'];
										$sum += $sumProduct;
									?>
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="<?=$product['thumb']?>" alt="IMG">
										</div>
									</td>
									<td class="column-2"><?=$product['title']?></td>
									<td class="column-3"><?=\App\Helpers\Helper::getPriceFormat($product['price'])?></td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="qty[<?=$productId?>]" value="<?=$product['qty']?>">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									<td class="column-5"><?=\App\Helpers\Helper::getPriceFormat($sumProduct)?></td>
									<td class="column-6"><a href="/cart/delete/<?=$productId?>">Xóa</a></td>
								</tr>

								<?php } ?>
							</table>
						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
									
								<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
									Apply coupon
								</div>
							</div>

							<button type="submit" formmethod="post" formaction="/cart/update" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								Update Cart
							</button>
						</div>
					</div>
				</form>
			</div>

			<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
				<form action="/cart/order" method="post" id="orderCart">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						<div class="form-group">
							<label>Tên khách hàng *</label>
							<input type="text" class="form-control" name="name" id="name">
						</div>

						<div class="form-group">
							<label>Số điện thoại *</label>
							<input type="text" class="form-control" name="phone" id="phone">
						</div>

						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email">
						</div>

						<div class="form-group">
							<label>Địa chỉ giao hàng *</label>
							<textarea class="form-control" name="address" id="address"></textarea>
						</div>

						<div class="form-group">
							<label>Ghi chú</label>
							<textarea class="form-control" name="note"></textarea>
						</div>
						

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Tổng Tiền:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									<?=\App\Helpers\Helper::getPriceFormat($sum)?>
								</span>
							</div>
						</div>
				

						<button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Đặt Hàng
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

		