<?php
include("connectDB.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['description']) && isset($_FILES['image'])) {
    $uploadDir = 'images/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $imageName = basename($_FILES['image']['name']);
    $imagePath = $uploadDir . $imageName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
        $name = $conn->real_escape_string($_POST['name']);
        $description = $conn->real_escape_string($_POST['description']);
        $image = $conn->real_escape_string($imagePath);

        $sql = "INSERT INTO flowers (name, description, image) VALUES ('$name', '$description', '$image')";
        if ($conn->query($sql)) {
            echo json_encode([
                'success' => true,
                'flower' => [
                    'id' => $conn->insert_id,
                    'name' => $name,
                    'description' => $description,
                    'image' => $imagePath
                ]
            ]);
        } else {
            echo "<script>alert('Lỗi thêm hoa: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Lỗi tải ảnh len: " . $conn->error . "');</script>";
    }
}
$conn->close();
?>
