<form action="/admin/menus/update/<?=$menu['id']?>" method="POST">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" value="<?=$menu['title']?>" class="form-control" name="title">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Thuộc danh mục</label>
                <select class="form-control" name="parent_id">
                    <option value="0" <?=$menu['parent_id'] == 0 ? 'selected' : ''?>>Danh mục cha</option>

                    <?php if ($menusParent->num_rows > 0) {
                        while ($menuItem = $menusParent->fetch_assoc()) { ?>
                            <option value="<?=$menuItem['id']?>"
                                <?=$menu['parent_id'] == $menuItem['id'] ? 'selected' : ''?>
                                ><?=$menuItem['title']?></option>
                    <?php } } ?>
                    
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Sắp xếp</label>
                <input type="number" class="form-control" value="<?=$menu['sort_by']?>" name="sort_by">
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label>Mô tả ngắn về danh mục</label>
                <textarea class="form-control" name="description"><?=$menu['description']?></textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label>Ảnh đại diện</label>
                <input type="file" id="file" class="form-control" accept="image/*">

                <div class="show-image">
                    <a href="<?=$menu['thumb']?>" target="_target" id="thumb_href">
                        <img src="<?=$menu['thumb']?>" id="thumb_url" class="img-fluid" style="width: 100px">
                    </a>

                    <input name="thumb" type="hidden" value="">
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label>Trạng thái</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="active"
                         name="is_active" value="1" <?=$menu['is_active'] == 1 ? 'checked' : ''?>>
                    <label class="form-check-label" for="active">Hiển thị</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="noactive"
                         name="is_active" value="0" <?=$menu['is_active'] == 0 ? 'checked' : ''?>>
                    <label class="form-check-label" for="noactive">Ẩn</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Cập Nhật Danh Mục</button>
    </div>
</form>