<?php
 session_start();
$Conexion = new mysqli("localhost", "root", "", "pedidosvb");
	if (mysqli_connect_errno()) {
		echo 'Conexion Fallida: ', mysqli_connect_error();
		exit();
	}
	mysqli_query($Conexion,"set names 'utf8'");//codificacion para caractertes especiales
	$sesion_stat;
	function check_conectado(){	
		if(!isset($_SESSION['id_us'])){
			$sesion_stat='no';
		}
		if(isset($_SESSION['id_us'])){
		 $sesion_stat='si';
		}
		return $sesion_stat;
	}
	function salir(){
		if(isset($_POST['salir'])){
			unset($_SESSION['id_us']);
		}		
	}
	function redir($url){
		echo "<script>window.location='".$url."'</script>";
		die();
	}
 ?>