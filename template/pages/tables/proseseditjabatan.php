<?php
include '../../koneksi.php';

if (isset($_POST['simpan'])) {
    $jabatan = $_POST['jabatan'];

    // Assuming you have an 'id' field to identify the record you want to update
    $id = $_POST['id_jabatan'];

    $save = "UPDATE tb_jabatan SET jabatan='$jabatan' WHERE id_jabatan=$id";
    $result = mysqli_query($koneksi, $save);

    if ($result) {
        header("location: datajabatan.php");
    } else {
        echo "gagal disimpan";
    }
}
?>
