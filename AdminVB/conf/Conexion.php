<?php
 session_start();
$Conexion = new mysqli("localhost", "root", "", "pedidosVB");
	if (mysqli_connect_errno()) {
		echo 'Conexion Fallida: ', mysqli_connect_error();
		exit();
	}
	mysqli_query($Conexion,"set names 'utf8'");//codificacion para caractertes especiales
	
	function check_conectado(){
		global $sesion_stat;
		if(!isset($_SESSION['id_us'])){
			$sesion_stat='no';
		}
		if(isset($_SESSION['id_us'])){
		 $sesion_stat='si';
		}
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