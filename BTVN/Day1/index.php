<?php include("header.php"); ?>

<?php
// Đường dẫn file dữ liệu
$filePath = 'data.php';

// Đọc danh sách sản phẩm
$products = file_exists($filePath) ? include($filePath) : [];

// Xử lý yêu cầu xóa sản phẩm
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $deleteName = $_GET['delete'];

    // Lọc bỏ sản phẩm có tên trùng với `$deleteName`
    $products = array_filter($products, function ($product) use ($deleteName) {
        return $product['Name'] !== $deleteName;
    });

    // Ghi lại danh sách vào file
    file_put_contents($filePath, '<?php return ' . var_export($products, true) . ';');

    // Chuyển hướng để tránh lặp lại hành động xóa khi tải lại trang
    header('Location: index.php');
    exit();
}
?>

<script>
    // Đảm bảo script chạy sau khi DOM đã tải xong
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("addButton").addEventListener("click", function (event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ <a>
            window.location.href = "addForm.php"; // Thay bằng URL của form bạn muốn chuyển đến
        });
    });
</script>

<div class="container">
    <a href="#" class="btn" id="addButton">Thêm mới</a>

    <table>
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá thành</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <th><?= htmlspecialchars($product['Name']) ?></th>
                    <td><?= htmlspecialchars($product['price']) ?> VND</td>
                    <td>
                        <a href="updateForm.php?name=<?= urlencode($product['Name']) ?>&price=<?= urlencode($product['price']) ?>"
                            class="edit-icon">✏️</a>
                    </td>
                    <td>
                        <a href="index.php?delete=<?= urlencode($product['Name']) ?>" 
                           class="delete-icon" 
                           onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">🗑️</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include("footer.php"); ?>
