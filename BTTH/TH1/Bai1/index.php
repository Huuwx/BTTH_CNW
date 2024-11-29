<?php include("connectDB.php"); ?>
<?php include("loadFlowers.php"); ?>
<?php include("addFlowers.php"); ?>
<?php include("updateFlowers.php"); ?>
<?php include("deleteFlowers.php"); ?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <main class="container">
        <h1 style="text-align: center;">Danh sách các loài hoa</h1>

        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addFlowerModal">Thêm hoa</button>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên hoa</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php $stt = 1;
                foreach ($flowers as $flower): ?>
                    <tr>
                        <td><?= $stt++; ?></td>
                        <td><?= $flower['name']; ?></td>
                        <td><?= $flower['description']; ?></td>
                        <td><img src="<?= $flower['image']; ?>" alt="<?= $flower['name']; ?>"
                                style="width:100px; height:auto;">
                        </td>
                        <td>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editFlowerModal"
                                data-name="<?= $flower['name']; ?>" data-description="<?= $flower['description']; ?>"
                                data-index="<?= $flower['id']; ?>">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                        </td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="deleteIndex" value="<?= $flower['id']; ?>">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <!-- Modal Thêm hoa -->
    <div class="modal fade" id="addFlowerModal" tabindex="-1" aria-labelledby="addFlowerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" form id="addFlowerForm"  enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFlowerModalLabel">Thêm hoa mới</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên hoa</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Ảnh</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Sửa hoa -->
    <div class="modal fade" id="editFlowerModal" tabindex="-1" aria-labelledby="editFlowerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editFlowerModalLabel">Sửa hoa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="editIndex" id="editIndex">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Tên hoa</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="editDescription" name="description" rows="3"
                                required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('[data-bs-target="#editFlowerModal"]').forEach(button => {
            button.addEventListener('click', function () {
                const name = this.getAttribute('data-name');
                const description = this.getAttribute('data-description');
                const index = this.getAttribute('data-index');

                document.getElementById('editName').value = name;
                document.getElementById('editDescription').value = description;
                document.getElementById('editIndex').value = index;
            });
        });
    </script>
    <script>
    document.getElementById('addFlowerForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('addFlowers.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const tableBody = document.querySelector('table tbody');
                const newRow = `
                    <tr>
                        <td>${tableBody.children.length + 1}</td>
                        <td>${data.flower.name}</td>
                        <td>${data.flower.description}</td>
                        <td><img src="${data.flower.image}" alt="${data.flower.name}" style="width:100px; height:auto;"></td>
                        <td>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editFlowerModal"
                                data-name="${data.flower.name}" data-description="${data.flower.description}" data-index="${data.flower.id}">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                        </td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="deleteIndex" value="${data.flower.id}">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', newRow);

                const addModal = bootstrap.Modal.getInstance(document.getElementById('addFlowerModal'));
                addModal.hide();

                this.reset();
            } else {
                alert('Thêm hoa thất bại: ' + data.message);
            }
        })
        .catch(error => console.error('Lỗi:', error));
    });
</script>

</body>

</html>