<!-- Slider -->
<?php if ($sliders->num_rows > 0) { ?>
<section class="section-slide">
	<div class="wrap-slick1 rs2-slick1">
		<div class="slick1">

			<?php  while ($slider = $sliders->fetch_assoc()) { ?>
			<div class="item-slick1 bg-overlay1" style="background-image: url(<?=$_ENV['BASE_URL'] . $slider['thumb']?>);" 
					data-thumb="<?=$_ENV['BASE_URL'] . $slider['thumb']?>" data-caption="<?=$slider['title']?>">
				<div class="container h-full">
					<div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
						<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
							<span class="ltext-202 txt-center cl0 respon2">
								Collection
							</span>
						</div>
							
						<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
							<h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
								<?=$slider['title']?>
							</h2>
						</div>
							
						<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
							<a href="<?=$slider['url']?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Shop Now
							</a>
						</div>
					</div>
				</div>
			</div>

			<?php } ?>
		</div>

		<div class="wrap-slick1-dots p-lr-10"></div>
	</div>
</section>
<?php } ?>


<!-- Banner -->
<?php if ($menus->num_rows > 0) { ?>
<div class="sec-banner bg0 p-t-95 p-b-55">
	<div class="container">
		<div class="row">
			<?php while ($menu = $menus->fetch_assoc()) { ?>
			<div class="col-md-6 col-lg-4 p-b-30 m-lr-auto">
				<!-- Block1 -->
				<div class="block1 wrap-pic-w">
					<img src="<?=$_ENV['BASE_URL'] . $menu['thumb'] ?>" alt="IMG-BANNER">

					<a href="/danh-muc/<?=\System\Src\Str::slug($menu['title'])?>-id<?=$menu['id']?>.html" 
							class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
						<div class="block1-txt-child1 flex-col-l">
							<span class="block1-name ltext-102 trans-04 p-b-8">
								<?=$menu['title']?>
							</span>

							<span class="block1-info stext-102 trans-04">
								Giảm Giá HOT
							</span>
						</div>

						<div class="block1-txt-child2 p-b-4 trans-05">
							<div class="block1-link stext-101 cl0 trans-09">
								Shop Now
							</div>
						</div>
					</a>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>

	<!-- Product -->
	<section class="bg0 p-t-23 p-b-130">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					Sản Phẩm Mới Nhất 
				</h3>
			</div>

			<div class="flex-w flex-sb-m p-b-52">

			</div>

			<div class="row isotope-grid">
				<?php include __VIEW__ . 'products/detail.php'; ?>
			</div>

			<!-- Pagination -->
			<div class="flex-c-m flex-w w-full p-t-38">
				<?=$pages?>
			</div>
		</div>
	</section>