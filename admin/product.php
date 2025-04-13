<?php include "../config/auth.php"; include "includes/header.php"; include "../config/conn.php";

    // Tambah produk
    if (isset($_POST['tambah'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $img = $_POST['img'];
        $category = $_POST['category'];
        mysqli_query($conn, "INSERT INTO products (productNAME, productPRICE, productSTOCK, productIMG, categoryID) 
            VALUES ('$name', '$price', '$stock', '$img', '$category')");
    }

    // Hapus produk
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM products WHERE productID=$id");
    }

    // Ambil data produk
    $products = mysqli_query($conn, "SELECT * FROM products");
    $categories = mysqli_query($conn, "SELECT * FROM category");
?>

<h2>Produk</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Nama Produk">
    <input type="number" name="price" placeholder="Harga">
    <input type="number" name="stock" placeholder="Stok">
    <input type="text" name="img" placeholder="../upload/namafile.format">
    <select name="category">
        <?php while($cat = mysqli_fetch_assoc($categories)): ?>
            <option value="<?= $cat['categoryID'] ?>"><?= $cat['categoryNAME'] ?></option>
        <?php endwhile; ?>
    </select>
    <button name="tambah">Tambah Produk</button>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($products)): ?>
        <tr>
            <td><?= $row['productID'] ?></td>
            <td><?= $row['productNAME'] ?></td>
            <td><?= $row['productPRICE'] ?></td>
            <td><?= $row['productSTOCK'] ?></td>
            <td>
                <a href="?delete=<?= $row['productID'] ?>">Hapus</a>
                <!-- Edit bisa dibuat sebagai modal/pop-up atau form terpisah -->
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<?php include "includes/footer.php"?>
