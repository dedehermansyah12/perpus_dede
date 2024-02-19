<?php

include '../../../config.php';

    $statusArray = [1];
    $statusString = implode(',', $statusArray);  // Mengubah array menjadi string terpisah koma
    // Mendapatkan waktu saat ini
    $currentDate = date('Y-m-d');

    // Mengupdate status peminjaman yang sudah melewati tanggal akhir
    $sql = "UPDATE peminjaman SET status='3' WHERE tgl_kembali < '$currentDate' AND status IN ($statusString)";

    if ($connection->query($sql) === TRUE) {
        echo '<script>alert("Peminjaman berhasil dinonaktifkan."); window.location.href="peminjamanBuku.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }