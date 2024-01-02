<?php
session_start();
 include'../../database/database.php';
 $cari=$_GET['cari'];
 
			
if($cari=='dataitem')
{
if($_GET['brand']=='')
{
	$query = mysql_query("SELECT *,i.id_size as size,
	(select nama_jenis_item from m_jenis_item where id_jenis_item=i.jenis_item) as nama_jenis,
	(select nama_brand from m_brand where id_brand=i.brand) as nama_brand,
	(select nama_size from m_size where id_size=i.id_size) as namasize
	FROM m_item i inner join t_stok k on i.kode_item=k.kode_item"); 
}
else
{
	$query = mysql_query("SELECT *,i.id_size as size,
	(select nama_jenis_item from m_jenis_item where id_jenis_item=i.jenis_item) as nama_jenis,
	(select nama_brand from m_brand where id_brand=i.brand) as nama_brand,
	(select nama_size from m_size where id_size=i.id_size) as namasize
	FROM m_item i inner join t_stok k on i.kode_item=k.kode_item where i.brand='$_GET[brand]'"); 
}
	$a=array();
			while($row = mysql_fetch_array($query)){
			//$q=mysql_query("select sum(jumlah) as jum from  t_barang_masuk where kode_item='$row[kode_item]' and size='$row[id_size]'");
			//$jum=mysql_fetch_array($q);
			$tambah="<a class='btn btn-primary' href='?m=stok&hal=tambah&id=$row[kode_item]&id_stok=$row[id_stok]'>Tambah</a>";				
			$return="<a class='btn btn-default' href='?m=stok&hal=return&id=$row[kode_item]&id_stok=$row[id_stok]'>Return</a>";
			$edit="<a class='btn btn-primary' href='?m=stok&hal=editsize&id=$row[kode_item]&id_stok=$row[id_stok]'>Edit Size</a>";
			$kurangstok="<a class='btn btn-default' href='?m=stok&hal=kurang_stok&id=$row[kode_item]&id_stok=$row[id_stok]'>Kurang Stok</a>";
			//$hapus="<a class='btn btn-danger' href='?m=stok&hal=hapus&id=$row[kode_item]&id_stok=$row[id_stok]'>hapus Size</a>";
			/*if($_SESSION['id']=='1440125148' or $_SESSION['id']=='1440414887'){
			$kurangstok="<a class='btn btn-default' href='?m=stok&hal=kurang_stok&id=$row[kode_item]&size=$row[id_size]&id_stok=$row[id_stok]'>Kurang Stok</a>";
			}
			else
			{
			$kurangstok="#";
			
			}

			*/

			if($_SESSION['id']=='1' or $_SESSION['id']=='2' ){
				$hapus="<a class='btn btn-danger' href='?m=stok&hal=hapus&id=$row[kode_item]&id_stok=$row[id_stok]'>hapus</a>";
				}
				else
				{
				$hapus="#";
				}
			 array_push($a, array(
									$row['kode_item'],
									$row['nama'],
									$row['jenis_item'],
									$row['brand'],
									$row['harga'],
									$row['harga_beli'],
									$row['ed'],
									$row['stok']." ".$row['size'],
									$tambah,
									$kurangstok,
									$hapus
								)
							);
			}
				
			echo "{\"data\":",json_encode($a),"}";
}
?>