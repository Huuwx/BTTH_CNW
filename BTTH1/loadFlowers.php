<?php include("connectDB.php"); ?>
<?php
// Lấy danh sách hoa từ cơ sở dữ liệu
$sql = "SELECT * FROM flowers";
$result = $conn->query($sql);
$flowers = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $flowers[] = $row;
    }
}
?>

