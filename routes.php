<?php
	Route::add('', 'LoginController', 'GET');
	Route::add('', 'LoginController', 'POST');

	Route::add('sing-up', 'SingUpController', 'GET');
	Route::add('sing-up', 'SingUpController', 'POST');

	Route::add('index', 'IndexController', 'GET');
	Route::add('index', 'IndexController', 'POST');

	Route::add('graph', 'GraphController', 'GET');
	Route::add('graph', 'GraphController', 'POST');

	Route::add('survey', 'SurveyController', 'GET');
	Route::add('survey', 'SurveyController', 'POST');

	Route::add('history', 'HistoryController', 'GET');
	Route::add('history', 'HistoryController', 'POST');

	Route::add('logout', 'Logout', 'GET');

	//Run
	Route::run($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);
?>