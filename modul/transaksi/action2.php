<?php
session_start();
    include '../../database/database.php';
    $error = array();
	$act=$_GET['aksi'];
	date_default_timezone_set('Asia/Singapore');
if($act='transaksiend')
{
	$id_pegawai=$_SESSION['id'];
		$no_transaksi=$_POST['no_transaksi'];
		$total_harga=$_POST['total_harga'];
		$pembayaran=$_POST['bayar'];
		date_default_timezone_set('Asia/Singapore');
		$tgl=date("Y-m-d");
		//$tanggal=$_POST['tanggal'];
		$q=mysql_query("INSERT INTO t_transaksi VALUES ('$no_transaksi','$id_pegawai','$tgl','$pembayaran','$total_harga','$_SESSION[id]')")or die(mysql_error());	
		if($q)
		{
				$message='1';
				header("location:https://snow.co.id/apotek/modul/transaksi/print.php?id=$no_transaksi&bayar=$pembayaran&kembalian=$_POST[kembalian]");


		}
		else
		{
				$message='2';
		}
	//header("location:../../dashboard.php?m=dashboard&message=$message");
}
?>
