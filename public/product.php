<?php
    include '../config/conn.php';
    include 'includes/header.php';

// Ambil semua produk
    $products = mysqli_query ($conn, "
        SELECT p.productID, p.productNAME, p.productPRICE, p.productSTOCK, p.productIMG, c.categoryNAME
        FROM products p
        LEFT JOIN category c ON p.categoryID = c.categoryID
        ORDER BY p.productNAME ASC" );

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk - Warung Madura</title>
    <style>
        .product-card {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            width: 200px;
            vertical-align: top;
            text-align: center;
        }
        .product-card img {
            max-width: 100%;
            height: 150px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h2>Daftar Produk Warung Madura</h2>
    <div class="product-container">
        <?php while($row = mysqli_fetch_assoc($products)): ?>
            <div class="product-card">
                <img src="<?= $row['productIMG'] ?>" alt="<?= $row['productNAME'] ?>">
                <h3><?= $row['productNAME'] ?></h3>
                <p>Kategori: <?= $row['categoryNAME'] ?></p>
                <p>Harga: Rp<?= number_format($row['productPRICE']) ?></p>
                <p>Stok: <?= $row['productSTOCK'] ?></p>
                <a href="cart.php?add=<?= $row['productID'] ?>">Tambah ke Keranjang</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
