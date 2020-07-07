<?php 
	require_once('./classes/Model.php');
	/**
	 * 
	 */
	class SingUpController extends Controller
	{

		public static function get()
		{
			self::render('register');
		}

		public static function post(array $data = array())
		{
			$user = $data['user'];
			$pass = $data['pass'];
			$name = $data['name'];
			$email = $data['email'];
			
			$is_registered = User::register($user,$pass,$name,$email);

			self::render('register', array('is_registered' => $is_registered));
		}

	}
?>