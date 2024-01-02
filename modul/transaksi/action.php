<?php
session_start();
    include '../../database/database.php';
    $error = array();
	$act=$_GET['aksi'];
if($act=='transaksi')
{
		$no_transaksi=$_POST['no_transaksi'];
		$kode_barang=$_POST['kode'];
		$jumlah=$_POST['jumlah'];
		$diskon=$_POST['diskon'];
		$size=$_POST['size'];
		$q=mysql_query("select * from t_stok where kode_item='$kode_barang'");
		$data=mysql_fetch_array($q);
		$stok=$data['stok'];
		if($stok<=0)
		{
			$message='3';
			header("location:../../dashboard.php?m=dashboard&message=$message");
			
		}
		elseif($stok<$jumlah)
		{
			$message='3';
			header("location:../../dashboard.php?m=dashboard&message=$message");
		}
		else{
		$q=mysql_query("select * from m_item where kode_item='$kode_barang'");
		$a=mysql_fetch_array($q);
		$harga=$a['harga'];
		$total=$jumlah*$harga;
		$hargadis=$total-($total*($diskon/100));
		// query insert
		$q=mysql_query("insert into t_transaksi_detail values('$no_transaksi','$kode_barang','','$jumlah','$total','$diskon','$hargadis','$a[harga_beli]')");
		$q2=mysql_query("update t_stok set stok=stok-'$jumlah' where kode_item='$kode_barang'")or die(mysql_error());
		if($q && $q2)
		{
				$message='1';
		}
		else
		{
				$message='2';
		}
		header("location:../../dashboard.php?m=dashboard&message=$message");
		}

}
elseif($act='cancel')
{
	$id_transaksi=$_GET['id_transaksi'];
$id_barang=$_GET['id_barang'];
$size=$_GET['size'];
$jumlah=$_GET['jumlah'];
// query insert
$q=mysql_query("delete from t_transaksi_detail 
where id_transaksi='$id_transaksi' and kode_item='$id_barang'");
$q2=mysql_query("update t_stok set stok=stok+'$jumlah' where kode_item='$id_barang'")or die(mysql_error());
if($q && $q2)
		{
				$message='4';
		}
		else
		{
				$message='2';
		}
header("location:../../dashboard.php?m=dashboard&message=$message");
}
?>
