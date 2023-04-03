<form action="/admin/menus/store" method="POST">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" value="<?=old('title')?>" class="form-control" name="title">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Thuộc danh mục</label>
                <select class="form-control" name="parent_id">
                    <option value="0">Danh mục cha</option>

                    <?php if ($menusParent->num_rows > 0) {
                        while ($menu = $menusParent->fetch_assoc()) { ?>
                            <option value="<?=$menu['id']?>"><?=$menu['title']?></option>
                    <?php } } ?>
                    
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Sắp xếp</label>
                <input type="number" class="form-control" value="1" name="sort_by">
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

        <button type="submit" class="btn btn-success">Thêm Danh Mục</button>
    </div>
</form>