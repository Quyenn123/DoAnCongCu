<?php if ($products->num_rows > 0) { 
        while ($product = $products->fetch_assoc()) { ?>

    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
        <!-- Block2 -->
        <div class="block2">
            <div class="block2-pic hov-img0">
                <img src="<?=$_ENV['BASE_URL'] . $product['thumb']?>" alt="IMG-PRODUCT">

                <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                    Xem Nhanh
                </a>
            </div>

            <div class="block2-txt flex-w flex-t p-t-14">
                <div class="block2-txt-child1 flex-col-l ">
                    <a href="<?=$_ENV['BASE_URL'] . '/' . \System\Src\Str::slug($product['title'])?>-id<?=$product['id']?>.html" 
                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                        <?=$product['title']?>
                    </a>

                    <div class="stext-105 cl3">
                        <?=\App\Helpers\Helper::getPrice($product['price'], $product['price_sale'])?>
                    </div>
                </div>

                <div class="block2-txt-child2 flex-r p-t-3">
                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                        <img class="icon-heart1 dis-block trans-04" src="<?=$_ENV['BASE_URL']?>/template/images/icons/icon-heart-01.png" alt="ICON">
                        <img class="icon-heart2 dis-block trans-04 ab-t-l" src="<?=$_ENV['BASE_URL']?>/template/images/icons/icon-heart-02.png" alt="ICON">
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php } } ?>