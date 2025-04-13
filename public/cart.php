<?php
    session_start();
    include "../config/conn.php"; include "includes/header.php";

    // Tambah produk ke keranjang
    if (isset($_GET['add'])) {
        $id = $_GET['add'];
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    }

    // Checkout
    if (isset($_POST['checkout'])) {
        $total = 0;

        foreach ($_SESSION['cart'] as $id => $qty) {
            $result = mysqli_query($conn, "SELECT productPRICE FROM products WHERE productID = $id");
            $product = mysqli_fetch_assoc($result);
            $total += $product['productPRICE'] * $qty;
        }

        $now = date('Y-m-d H:i:s');
        mysqli_query($conn, "INSERT INTO transaction (transDATE, transTOTAL) VALUES ('$now', $total)");

        // Kosongkan keranjang
        unset($_SESSION['cart']);

        echo "<p>Transaksi berhasil! Total: Rp " . number_format($total) . "</p>";
    }
?>

<h2>Keranjang</h2>
<form method="POST">
    <?php
    if (empty($_SESSION['cart'])) {
        echo "<p>Keranjang kosong.</p>";
    } else {
        $grandTotal = 0;
        foreach ($_SESSION['cart'] as $id => $qty) {
            $result = mysqli_query($conn, "SELECT * FROM products WHERE productID = $id");
            $product = mysqli_fetch_assoc($result);
            $subtotal = $product['productPRICE'] * $qty;
            $grandTotal += $subtotal;

            echo "  <div>
                        <strong>{$product['productNAME']}</strong> x $qty = Rp " . number_format($subtotal) . "
                    </div>";
        }

        echo "<p><strong>Total: Rp " . number_format($grandTotal) . "</strong></p>";
        echo '<button type="submit" name="checkout">Checkout</button>';
    }
    ?>
</form>
<?php include "includes/footer.php"; ?>