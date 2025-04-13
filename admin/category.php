<?php 
    include "../config/auth.php"; include "includes/header.php"; include "../config/conn.php";

    // Tambah kategori
    if (isset($_POST['tambah'])) {
        $name = $_POST['name'];
        mysqli_query($conn, "INSERT INTO category (categoryNAME) VALUES ('$name')");
    }

    // Hapus kategori
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM category WHERE categoryID=$id");
    }

    // Ambil data untuk diedit
    $edit_mode = false;
    $edit_data = null;
    if (isset($_GET['edit'])) {
        $edit_mode = true;
        $id = $_GET['edit'];
        $result = mysqli_query($conn, "SELECT * FROM category WHERE categoryID=$id");
        $edit_data = mysqli_fetch_assoc($result);
    }

    // Simpan perubahan edit
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        mysqli_query($conn, "UPDATE category SET categoryNAME='$name' WHERE categoryID=$id");
        header("Location: category.php");
        exit;
    }

    $categories = mysqli_query($conn, "SELECT * FROM category");
?>

<h2>Kategori</h2>

<!-- Form Tambah / Edit -->
<form method="POST">
    <input type="text" name="name" placeholder="Nama Kategori" value="<?= $edit_mode ? $edit_data['categoryNAME'] : '' ?>">
    <?php if ($edit_mode): ?>
        <input type="hidden" name="id" value="<?= $edit_data['categoryID'] ?>">
        <button name="update">Update Kategori</button>
        <a href="category.php">Batal</a>
    <?php else: ?>
        <button name="tambah">Tambah Kategori</button>
    <?php endif; ?>
</form>

<table>
    <tr><th>ID</th><th>Nama</th><th>Aksi</th></tr>
    <?php while($row = mysqli_fetch_assoc($categories)): ?>
        <tr>
            <td><?= $row['categoryID'] ?></td>
            <td><?= $row['categoryNAME'] ?></td>
            <td>
                <a href="?edit=<?= $row['categoryID'] ?>">Edit</a> | 
                <a href="?delete=<?= $row['categoryID'] ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include "includes/footer.php" ?>
