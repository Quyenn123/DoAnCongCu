/*Khi vào trang danh mục thì mặt định page = 1, khi click thì sẽ mặt định là 2 */
var page = 2;

function loadMore(menudId = 0) {
    //lấy query string
    const params = new URLSearchParams(window.location.search);
    let sort    = params.has('sort') ? params.get('sort') : '';
    let price   = params.has('price') ? params.get('price') : '';
    
    /* Kiểm tra danh mục gửi đi */
    if (menudId == 0) {
        alert('Có lỗi vui lòng thử lại');
        return ;
    }

    //call data
    $.ajax({
        type: "get", // mặt định là get
        url: URL + '/services/load-product-by-menu',
        data: {menudId, sort, price, page},
        dataType: "JSON",
        success: function (res) {
            if (res.error) {
                alert(res.message);
            } else {
                //tăng page để sử dụng lần sau
                page++;

                //Khi sản phẩm trả về không có thì sẽ xóa đi nút load more
                if (res.products.length == 0) {
                    $('#btn-loadmore').remove();
                }

                let html = '';

                res.products.forEach(ele => {
                    html += `
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img src="${ URL + ele.thumb }" alt="IMG-PRODUCT">
                    
                                    <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                        Xem Nhanh
                                    </a>
                                </div>
                    
                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="" 
                                            class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            ${ ele.title }
                                        </a>
                    
                                        <div class="stext-105 cl3">
                                            ${ ele.price }
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
                    `;
                });

                $('#loadMoreItems').append(html);
            }
        }
    });
}


/*---------------*/
$('#orderCart').submit(function (e) { 
    let name = $('#name').val().trim();
    let phone = $('#phone').val().trim();
    let address = $('#address').val().trim();

    if (name.length == 0) {
        $('#name').css('border-color', 'red');
        e.preventDefault();
    } else {
        $('#name').css('border-color', '#cdcdcd');
    }

    if (phone.length == 0) {
        $('#phone').css('border-color', 'red');
        e.preventDefault();
    } else {
        $('#phone').css('border-color', '#cdcdcd');
    }

    if (address.length == 0) {
        $('#address').css('border-color', 'red');
        e.preventDefault();
    } else {
        $('#address').css('border-color', '#cdcdcd');
    }

    return true;
});