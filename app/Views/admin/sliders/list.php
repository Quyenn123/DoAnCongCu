<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tiêu Đề</th>
            <th>Đường Dẫn</th>
            <th>Trạng Thái</th>
            <th>Sắp Xếp</th>
            <th>Ảnh Đại Diện</th>
            <th>Cập Nhật</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>

    <tbody>
        <?php
            if ($sliders->num_rows > 0) {
                while ($row = $sliders->fetch_assoc()) { ?>
            <tr>
                <td><?=$row['id']?></td>
                <td><?=$row['title']?></td>
                <td><?=$row['url']?></td>
                <td><?=\App\Helpers\Helper::getIsActive($row['is_active'])?></td>
                <td><?=$row['sort_by']?></td>
                <td>
                    <a href="<?=$row['thumb']?>" target="_blank">
                        <img src="<?=$row['thumb']?>" style="width: 60px; height: 30px">
                    </a>
                </td>
                <td><?=$row['updated_at']?></td>
                <td><a href="/admin/siders/edit/<?=$row['id']?>">Sửa</a></td>
                <td><a href="#" onclick="deleteRow(<?=$row['id']?>, '/admin/siders/delete')">Xóa</a></td>
            </tr>
        <?php }} ?>
    </tbody>
</table>

<br>
