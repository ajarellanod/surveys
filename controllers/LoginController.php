<?php 
	require_once('./classes/Model.php');
	/**
	 * 
	 */
	class LoginController extends Controller
	{

		public static function get()
		{	
			//Si esta logeado lo enviamos a Index
			session_start();
			if(isset($_SESSION["logged"])){
				echo"<script>window.location.href='/survey/index/';</script>";
				exit();
			}

			//Sino Renderizamos el Login
			self::render('login');
		}

		public static function post(array $data = array())
		{
			//Recibimos Data por Post
			$user = $data['user'];
			$pass = $data['pass'];

			//Verificamos si esta registrado
			$is_logged = User::login($user,$pass);
			if($is_logged){
				//Iniciamos Variable de Sesion
				session_start();
                $_SESSION['logged'] = $user;
                //Redirigimos a la pantalla que queremos
                echo"<script>window.location.href='/survey/index/';</script>";
        		exit();
			}else{
				//Enviamos Notificacion de Error
				self::render('login', array('is_logged' => $is_logged));
			}
		}

	}
?>
