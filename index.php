<?php
namespace login;

use login\application\ctrl\Admin;

use login\application\ctrl\Login;

ob_start();

define('_PATH_RAIZ_', '');
require _PATH_RAIZ_ . 'path.php';

$request = explode('/', $_SERVER['REQUEST_URI']);
$request = $request[count($request) - 1];
$request = explode('?', $request);
$request = $request[0];

if ($request === 'admin') {
	require _PATH_CTRL_ . 'Admin.php';
	$a = new Admin();
	$a->exec();
} else {
	require_once _PATH_CTRL_ . 'Login.php';
	$l = new Login();
	$l->exec();
}
