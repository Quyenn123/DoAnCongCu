<form action="/admin/products/store" method="POST">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" value="<?=old('title')?>" class="form-control" name="title">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Thuộc danh mục</label>
                <select class="form-control" name="menu_id">
                   <?=\App\Helpers\Helper::getMenuIsActiveShowSelect($menus)?>
                </select>
            </div>
        </div>


        <div class="col-md-3">
            <div class="form-group">
                <label>Giá gốc</label>
                <input type="number" value="<?=old('price')?>" class="form-control" name="price">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Giá giảm</label>
                <input type="number" value="<?=old('price_sale')?>" class="form-control" name="price_sale">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label>Mô tả ngắn về danh mục</label>
                <textarea class="form-control" name="description"><?=old('description')?></textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label>Chi tiết sản phẩm</label>
                <textarea class="form-control" name="content" id="content"><?=old('content')?></textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label>Ảnh đại diện</label>
                <input type="file" id="file" class="form-control" accept="image/*">

                <div class="show-image d-none">
                    <a href="" target="_target" id="thumb_href">
                        <img src="" id="thumb_url" class="img-fluid" style="width: 100px">
                    </a>

                    <input name="thumb" type="hidden" value="">
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label>Trạng thái</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="active" name="is_active" value="1" checked>
                    <label class="form-check-label" for="active">Hiển thị</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="noactive" name="is_active" value="0" >
                    <label class="form-check-label" for="noactive">Ẩn</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Thêm Sản Phẩm</button>
    </div>
</form>

<script>CKEDITOR.replace('content');</script>