<?php include("connectDB.php"); ?>
<?php
// Sửa hoa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editIndex'])) {
    $id = (int) $_POST['editIndex'];
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);

    $sql = "UPDATE flowers SET name='$name', description='$description' WHERE id=$id";
    if (!$conn->query($sql)) {
        echo "<script>alert('Lỗi sửa hoa: " . $conn->error . "');</script>";
    } else {
        header("Location: ?");
    }
}
?>