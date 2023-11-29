<?php

include_once "sesi_pegawai.php";

$modul=(isset($_GET['s']))?$_GET['s']:"awal";
switch($modul){
	case 'awal': default: include "../../login.php"; break;
	case 'profil': include '../../profil.php'; break;
	case 'edit': include 'modul/pegawai/edit.php'; break;
	case 'update': include 'modul/pegawai/update.php'; break;
	case 'index': include '../../dasboard.php';
}
?>
