<?php
 include'../../database/database.php';
 $cari=$_GET['cari'];
 
			
if($cari=='datapengguna')
{
	
	$query = mysql_query("SELECT *,(select nama_level from m_level where id_level=m_pengguna.level) as lv FROM m_pengguna");   
	$a=array();
			while($row = mysql_fetch_array($query)){	
				$trn="<a class='btn btn-primary' href='?m=item&hal=transaksi_user&id=$row[id_pengguna]'>Lihat</a>";
			$edit="<a class='btn btn-primary' href='?m=pengguna&hal=edit&id=$row[id_pengguna]'>Edit</a>";
			 array_push($a, array(
									$row['id_pengguna'],
									$row['nama'],
									$row['username'],
									$row['lv'],
									$edit,
									$trn
								)
							);
			}
				
			echo "{\"data\":",json_encode($a),"}";
}
elseif($cari=='datalog')
{
	
	$query = mysql_query("SELECT * FROM m_log l inner join m_pengguna p on l.id_pengguna=p.id_pengguna");   
	$a=array();
			while($row = mysql_fetch_array($query)){	
			 array_push($a, array(
									$row['id_log'],
									$row['nama_pengguna'],
									$row['aktifitas_log'],
									$row['waktu_log']
								)
							);
			}
				
			echo "{\"data\":",json_encode($a),"}";
}
?>