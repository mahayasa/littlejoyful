<?php
session_start();
    include '../../database/database.php';
    $error = array();
	$act=$_GET['aksi'];
if($act=='tambahjenis')
{
	$q=mysql_query("INSERT INTO m_jenis_item VALUES('$_POST[id_jenis]','$_POST[nama]')")or die(mysql_error());
	if($q)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=jenis&hal=list&message=$message");
}
if($act=='editjenis')
{
	$q=mysql_query("update m_jenis_item set id_jenis_item='$_POST[id_jenis]',nama_jenis_item='$_POST[nama]' where id_jenis_item='$_POST[idlama]'")or die(mysql_error());
	if($q)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=jenis&hal=edit&id=$_POST[id_jenis]&message=$message");
}
if($act=='tambahbrand')
{
	$q=mysql_query("INSERT INTO m_brand VALUES(id_brand,'$_POST[nama]','','','','')")or die(mysql_error());
	if($q)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=brand&hal=list&message=$message");
}
if($act=='tambahPbf')
{
	$id=date("U");
	$q=mysql_query("INSERT INTO m_pbf VALUES('$id','$_POST[nama]')")or die(mysql_error());
	if($q)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=pbf&hal=list&message=$message");
}
if($act=='editbrand')
{
	$q=mysql_query("update m_brand set nama_brand='$_POST[nama]',kontak='$_POST[kontak]',alamat='$_POST[alamat]',email='$_POST[email]',
	konsinyasi='$_POST[konsi]'
	where id_brand='$_POST[id]'
	")or die(mysql_error());
	if($q)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=brand&hal=edit&id=$_POST[id]&message=$message");
}
if($act=='editPbf')
{
	$q=mysql_query("update m_pbf set nama='$_POST[nama]'
	where id_pbf='$_POST[id]'
	")or die(mysql_error());
	if($q)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=pbf&hal=edit&id=$_POST[id]&message=$message");
}
if($act=='editPbfItem')
{
	$q=mysql_query("update t_barang_masuk set id_pbf='$_POST[pbf_new]' where tanggal_masuk='$_POST[tgl]' and kode_item='$_POST[kode]' 
	and id_pbf='$_POST[pbf]'")or die(mysql_error());
	if($q)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=item&hal=pbf&id=$_POST[kode]&message=$message");
}
if($act=='tambahsize')
{
	$q=mysql_query("INSERT INTO m_size VALUES(id_size,'$_POST[nama]','')")or die(mysql_error());
	if($q)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=size&hal=list&message=$message");
}
if($act=='editsize')
{
	$q=mysql_query("update m_size set nama_size='$_POST[nama]' where id_size='$_POST[id]'")or die(mysql_error());
	if($q)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=size&hal=edit&id=$_POST[id]&message=$message");
}
if($act=='tambahobat')
{
	$id=date("U");

	$qcek=mysql_query("select * from m_item where kode_item='$_POST[kode]'");
	$cek=mysql_num_rows($qcek);

	if($cek<=0)
	{
	$q=mysql_query("INSERT INTO m_item VALUES(idk,'$_POST[kode]','$_POST[nama]','$_POST[jenis]','$_POST[brand]','$_POST[harga]','$_POST[harga_beli]','$_POST[satuan]','$_POST[ed]')")
	or die(mysql_error());
	$q2=mysql_query("insert into t_barang_masuk values(DATE(NOW()),'$_POST[kode]','','$_POST[stok]','','$_SESSION[id]','$_POST[pbf]')")or die(mysql_error());
	$q3=mysql_query("INSERT INTO t_stok VALUES('$id',DATE(NOW()),'$_POST[kode]','','$_POST[stok]','$_SESSION[id]')")or die(mysql_error());

		if($q and $q2 and $q3)
		{
			$message='1';
			
		}
		else
		{
			$message='2';
			
		}
		header("location:../../dashboard.php?m=item&hal=list&message=$message");

	}
	else
	{
		header("location:../../dashboard.php?m=item&hal=list&message=4");
	}
	
	
}
if($act=='editobat')
{
	$q=mysql_query("update m_item set nama='$_POST[nama]',kode_item='$_POST[kode]',jenis_item='$_POST[jenis]',brand='$_POST[brand]',
	harga='$_POST[harga]',harga_beli='$_POST[harga_beli]',id_size='$_POST[satuan]',ed='$_POST[ed]' where kode_item='$_POST[kodelama]'
	")or die(mysql_error());
	if($q)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=item&hal=edit&id=$_POST[kode]&message=$message");
}
if($act=='stokitem')
{
	$q=mysql_query("select * from m_size where type_size='$_POST[type]' or type_size='-'");
	while($data=mysql_fetch_array($q))
	{
	$id_size=$data['id_size'];
	echo $_POST[$id_size];
	if($_POST[$id_size]!=0)
	{
	$id=date("U");
	$q2=mysql_query("insert into t_barang_masuk values(NOW(),'$_POST[kode]','$data[id_size]','$_POST[$id_size]','','$_SESSION[id]')")or die(mysql_error());
	mysql_query("INSERT INTO t_stok VALUES('null',DATE(NOW()),'$_POST[kode]',$data[id_size],'$_POST[$id_size]','$_SESSION[id]')")or die(mysql_error());
	}
	}
	if($q)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=item&hal=list&message=$message");
}
if($act=='sizebaru')
{
	$q1=mysql_query("insert into t_barang_masuk values(NOW(),'$_POST[kode]','$_POST[size]','$_POST[jumlah]','','$_SESSION[id]')")or die(mysql_error());
	$q2=mysql_query("INSERT INTO t_stok VALUES(NULL,DATE(NOW()),'$_POST[kode]',$_POST[size],'$_POST[jumlah]','$_SESSION[id]')")or die(mysql_error());
		if($q1 && $q2)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=stok&hal=list&message=$message");
}
if($act=='hapus')
{
	$q1=mysql_query("delete from m_item where kode_item='$_POST[kode]'")or die(mysql_error());
	$q2=mysql_query("delete from t_stok where kode_item='$_POST[kode]'")or die(mysql_error());
	$q3=mysql_query("delete from t_barang_masuk where kode_item='$_POST[kode]'")or die(mysql_error());
		if($q1 && $q2 && $q3)
	{
		$message='3';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=item&hal=list&message=$message");
}
?>
