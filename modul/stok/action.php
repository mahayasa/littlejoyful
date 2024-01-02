<?php
session_start();
    include '../../database/database.php';
    $error = array();
	$act=$_GET['aksi'];
if($act=='tambahstok')
{
	$jumlah=$_POST['jumlahsebelum']+$_POST['jumlahsetelah'];
	$q=mysql_query("update t_stok set stok='$jumlah',tanggal_masuk=NOW() where kode_item='$_POST[kode]' and id_stok='$_POST[id_stok]'")or die(mysql_error());
	$q2=mysql_query("insert into t_barang_masuk values(NOW(),'$_POST[kode]','','$_POST[jumlahsetelah]','','$_SESSION[id]','$_POST[pbf]')")or die(mysql_error());
	if($q && $q2)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=stok&hal=list&message=$message&brand=$_SESSION[brand]");
}

if($act=='tambahstok_baru')
{

	$id=date("U");

	$q=mysql_query("insert into t_stok values('$id',NOW(),'$_POST[kode]','0','$_POST[jumlah]','$_SESSION[id]')")or die(mysql_error());	
	$q2=mysql_query("insert into t_barang_masuk values(NOW(),'$_POST[kode]','','$_POST[jumlah]','','$_SESSION[id]','$_POST[pbf]')")or die(mysql_error());
	if($q && $q2)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=stok&hal=list&message=$message&brand=$_SESSION[brand]");
}
if($act=='return')
{
	$jumlah=$_POST['jumlahsebelum']-$_POST['jumlahsetelah'];
	if($jumlah<0)
	{
		$message='2';
		header("location:../../dashboard.php?m=stok&hal=return&id=$_POST[kode]&size=$_POST[idsize]&message=$message");
	}
	else{
	$q=mysql_query("update t_stok set stok='$jumlah' where kode_item='$_POST[kode]' and id_size='$_POST[idsize]' and id_stok='$_POST[id_stok]'")or die(mysql_error());
	$q2=mysql_query("insert into t_barang_return values(NOW(),'$_POST[kode]','$_POST[idsize]','$_POST[jumlahsetelah]','','$_SESSION[id]')")or die(mysql_error());
	if($q && $q2)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=stok&hal=list&message=$message&brand=$_SESSION[brand]");
	}
}
if($act=='kurang_stok')
{
	$jumlah=$_POST['jumlahsebelum']-$_POST['jumlahsetelah'];
	if($jumlah<0)
	{
		$message='2';
		header("location:../../dashboard.php?m=stok&hal=return&id=$_POST[kode]&size=$_POST[idsize]&message=$message");
	}
	else{
	$q=mysql_query("update t_stok set stok='$jumlah' where kode_item='$_POST[kode]' and id_stok='$_POST[id_stok]'")or die(mysql_error());
	$q2=mysql_query("insert into t_barang_return values(NOW(),'$_POST[kode]','','$_POST[jumlahsetelah]','','$_SESSION[id]')")or die(mysql_error());

	if($q)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=stok&hal=list&message=$message&brand=$_SESSION[brand]");
	}
}

if($act=='editsize')
{
	$q=mysql_query("delete from t_stok where kode_item='$_POST[kode]' and id_stok='$_POST[id_stok]'")or die(mysql_error());
	if($q && $q2)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=stok&hal=list&message=3&brand=$_SESSION[brand]");
}
?>
