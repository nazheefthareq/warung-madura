<?php
    include "../config/auth.php"; include "includes/header.php"; include "../config/conn.php";
    
    $transactions = mysqli_query($conn, "SELECT * FROM transaction ORDER BY transDATE DESC");
?>

<h2>Riwayat Transaksi</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Total (Rp)</th>
    </tr>
    <?php while($t = mysqli_fetch_assoc($transactions)): ?>
        <tr>
            <td><?= $t['transID'] ?></td>
            <td><?= $t['transDATE'] ?></td>
            <td><?= number_format($t['transTOTAL']) ?></td>
        </tr>
    <?php endwhile; ?>
</table>
