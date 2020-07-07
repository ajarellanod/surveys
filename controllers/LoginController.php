<?php 
	require_once('./classes/Model.php');
	/**
	 * 
	 */
	class LoginController extends Controller
	{

		public static function get()
		{
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
                header('Location: /survey/index/');
        		exit();
			}else{
				//Enviamos Notificacion de Error
				self::render('login', array('is_logged' => $is_logged));
			}
		}

	}
?>
