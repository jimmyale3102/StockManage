<?php
	require("connect_DB.php");

	$user=$_POST['user'];
	$pass=$_POST['pass'];
	$flag=FALSE;
	$cargo="";
	$query=mysqli_query($link,"Select * from usuarios where userName='".$user."';");

	if(mysqli_num_rows($query)==0){
		$cargo=-1;
	}else{
		$check=mysqli_fetch_array($query);
		if($check['password']==$pass){
			$cargo=$check['idCargo'];
		}else{
			$cargo=0;
		}
	}

	echo $cargo;