<?php
session_start();
include_once "sesi_pegawai.php";
$modul=(isset($_GET['m']))?$_GET['m']:"awal";
$jawal="Login Pegawai || SI Pegawai";
switch($modul){
    case 'awal': default: $aktif="Beranda"; $judul="Beranda $jawal"; include "dashboard.php"; break;
    case 'Pegawai': $aktif="Pegawai"; $judul="Modul Pegawai $jawal"; include "modul/Pegawai/dashboard.php"; break;
    
   
}

?>