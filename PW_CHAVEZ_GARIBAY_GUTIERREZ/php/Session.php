<?php

	session_start();
	
	class Session
	{
		public function start($id)
		{
			//echo "mi usuario es".$_POST['username'];
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['id'] = $id;
			header("location:productos.php");
			exit;
		}
		
		public function verificar()
		{
			if($_SESSION['username'] == "")
			{
				echo "no puedes estar aqui";
				header("location:index.php");
			}
		}
		
		public function destroy()
		{
			session_destroy();
			header("location:../index.php");
			exit;
		}
	}

	class SessionAdmin
	{
		public function start()
		{
			//echo "mi usuario es".$_POST['user'];
			$_SESSION['user'] = $_POST['user'];
			
			header("location:administrador.php");
			exit;
		}
		
		public function verificar()
		{
			if($_SESSION['user'] == "")
			{
				echo "no puedes estar aqui";
				header("location:registroAdmin.php");
			}
		}
		
		public function destroy()
		{
			session_destroy();
			header("location:../index.php");
			exit;
		}
	}
			
			
?>