<?php
session_start();
    include '../../database/database.php';
    $error = array();
	$act=$_GET['aksi'];
if($act=='tambahpengguna')
{
	$pass=md5($_POST['password']);
	$q=mysql_query("INSERT INTO m_pengguna VALUES(UNIX_TIMESTAMP(),'$_POST[nama]','$_POST[username]','$pass','$_POST[level]')")or die(mysql_error());
	//$q2=mysql_query("INSERT INTO m_log VALUES(UNIX_TIMESTAMP(),'$_SESSION[id]','Input data Pengguna Sistem : $_POST[nama_pustakawan]',now())")or die(mysql_error());
	if($q)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=pengguna&hal=list&message=$message");
}
if($act=='editpengguna')
{
	$pass=md5($_POST['password']);
	$q=mysql_query("update m_pengguna set nama='$_POST[nama]',level='$_POST[level]',username='$_POST[username]',password='$pass'
	where id_pengguna='$_POST[id]'")or die(mysql_error());
	//$q2=mysql_query("INSERT INTO m_log VALUES(UNIX_TIMESTAMP(),'$_SESSION[id]','Edit data Pengguna Sistem : $_POST[id]',now())")or die(mysql_error());
	if($q)
	{
		$message='1';
	}
	else
	{
		$message='2';
	}
	header("location:../../dashboard.php?m=pengguna&hal=edit&id=$_POST[id]&message=$message");
}
?>
