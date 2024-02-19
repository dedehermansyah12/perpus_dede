<?php 
require "../../../config.php"; 

$id = $_GET["id"];
if(deleteAdmin($id) > 0) {
    echo "<script>
    alert('Admin berhasil dihapus!');
    document.location.href = 'user.php';
    </script>";
  }else {
    echo "<script>
    alert('Admin gagal dihapus!');
    document.location.href = 'user.php';
    </script>";
}
?>
