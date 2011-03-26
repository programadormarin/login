<?php
namespace login;
use login\application\entities\User;
use login\application\dao\UserDao;

define('_PATH_RAIZ_', '');
require_once _PATH_RAIZ_ . 'path.php';

//require_once _PATH_DAO_ . 'UserDao.php';
//require_once _PATH_ENTITIES_ . 'User.php';
////$pdo = new PDO('mysql:host=localhost;dbname=login', 'root', '');
//$user = new User();
//$user->setLogin('junior');
//$user->setPassword('senha');
//$user->setType('admin');
//
//$daoUser = new UserDao();
//
//$u = $daoUser->load();
//var_dump('<pre>', $u);

require_once _PATH_DAO_ . 'AccessDao.php';
require_once _PATH_ENTITIES_ . 'Access.php';

$access = new Access();
$access->load();
