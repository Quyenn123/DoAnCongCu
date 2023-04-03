<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên Danh Mục</th>
            <th>Trạng Thái</th>
            <th>Ảnh Đại Diện</th>
            <th>Cập Nhật</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>

    <tbody>
        <?=\App\Helpers\Helper::getMenuIsAdmin($menus)?>
    </tbody>
</table>