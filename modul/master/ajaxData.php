<?php
session_start();
 include'../../database/database.php';
 $cari=$_GET['cari'];
 
			
if($cari=='dataobat')
{
	
	/*$query = mysql_query("SELECT *,
	(select nama_jenis_item from m_jenis_item where id_jenis_item=i.jenis_item) as nama_jenis,
	(select nama_brand from m_brand where id_brand=i.brand) as nama_brand,
	(select nama_size from m_size where id_size=k.id_size) as nama_size
	FROM m_item i inner join t_stok k on i.kode_item=k.kode_item"); 
	*/
	$query=mysql_query("select i.*,(select nama_jenis_item from m_jenis_item where id_jenis_item=i.jenis_item) as nama_jenis,
	(select nama_brand from m_brand where id_brand=i.brand) as nama_brand from m_item i");
	$a=array();
			while($row = mysql_fetch_array($query)){	
			$edit="<a class='btn btn-primary' href='?m=item&hal=edit&id=$row[kode_item]'>Edit</a>";
			$trn="<a class='btn btn-primary' href='?m=item&hal=transaksi&id=$row[kode_item]'>Lihat</a>";
			$hapus="<a class='btn btn-danger' href='?m=item&hal=hapus&id=$row[kode_item]'>Hapus</a>";

			$stk="<a class='btn btn-primary' href='?m=stok&hal=tambah_baru&id=$row[kode_item]'>+ Stok</a>";
			$pbf="<a class='btn btn-success' href='?m=item&hal=pbf&id=$row[kode_item]'>view pbf</a>";
			//$tambahsize="<a class='btn btn-primary' href='?m=item&hal=tambahsize&id=$row[kode_item]'>Tambah Size</a>";
			/*if($_SESSION['id']=='1440125148'){
			$hapus="<a class='btn btn-danger' href='?m=item&hal=hapus&id=$row[kode_item]'>Hapus</a>";
			}
			else
			{
			$hapus='#';
			}*/
			 array_push($a, array(
									$row['kode_item'],
									$row['nama'],
									$row['jenis_item'],
									$row['brand'],
									$row['harga'],
									$row['harga_beli'],
									$row['ed'],
									$stk." ".$pbf,
									$trn,
									$edit,
									$hapus
								)
							);
			}
				
			echo "{\"data\":",json_encode($a),"}";
}
if($cari=='datajenis')
{
	
	$query = mysql_query("SELECT * from m_jenis_item");   
	$a=array();
			while($row = mysql_fetch_array($query)){	
			$edit="<a class='btn btn-primary' href='?m=jenis&hal=edit&id=$row[id_jenis_item]'>Edit</a>";
			 array_push($a, array(
									$row['id_jenis_item'],
									$row['nama_jenis_item'],
									$edit,
								)
							);
			}
				
			echo "{\"data\":",json_encode($a),"}";
}
if($cari=='databrand')
{
	
	$query = mysql_query("SELECT * from m_brand");   
	$a=array();
			while($row = mysql_fetch_array($query)){	
			$edit="<a class='btn btn-primary' href='?m=brand&hal=edit&id=$row[id_brand]'>Edit</a>";
			 array_push($a, array(
									$row['id_brand'],
									$row['nama_brand'],
									$row['kontak'],
									$row['alamat'],
									$row['email'],
									$row['konsinyasi'],
									$edit,
								)
							);
			}
				
			echo "{\"data\":",json_encode($a),"}";
}
if($cari=='dataPbf')
{
	
	$query = mysql_query("SELECT * from m_pbf");  
	$no=1; 
	$a=array();
			while($row = mysql_fetch_array($query)){	
			$edit="<a class='btn btn-primary' href='?m=pbf&hal=edit&id=$row[id_pbf]'>Edit</a>";
			 array_push($a, array(
									$no,
									$row['nama'],
									$edit,
								)
							);
			$no++;
			}
				
			echo "{\"data\":",json_encode($a),"}";
}
if($cari=='datasize')
{
	
	$query = mysql_query("SELECT * from m_size");   
	$a=array();
			while($row = mysql_fetch_array($query)){	
			$edit="<a class='btn btn-primary' href='?m=size&hal=edit&id=$row[id_size]'>Edit</a>";
			 array_push($a, array(
									$row['id_size'],
									$row['nama_size'],
									$row['type_size'],
									$edit
								)
							);
			}
				
			echo "{\"data\":",json_encode($a),"}";
}
?>