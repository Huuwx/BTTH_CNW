<?php include("connectDB.php"); ?>
<?php
// Xóa hoa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteIndex'])) {
    $id = (int) $_POST['deleteIndex'];
    $sql = "DELETE FROM flowers WHERE id=$id";
    if (!$conn->query($sql)) {
        echo "<script>alert('Lỗi xóa hoa: " . $conn->error . "');</script>";
    } else {
        header("Location: ?");
    }
}
?>