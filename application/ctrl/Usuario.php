<?php
namespace login\application\ctrl {
	use login\application\dao\AccessDao;
	use login\application\entities\Access;
	use login\application\dao\UserDao;
	use login\application\entities\User;
	use login\application\view\VwLogin;

	require_once _PATH_DAO_ . 'UserDao.php';
	require_once _PATH_DAO_ . 'AccessDao.php';
	require_once _PATH_VIEW_ . 'VwLogin.php';
	
	class Login {
///////////////////////////////Atributos Principais/////////////////////////////////
	
		private $user = null;
		private $userDao = null;
		private $access = null;
		private $accessDao = null;
		
///////////////////////////////Metodos Principais///////////////////////////////////
	
		public function __construct() {
			$this->user = new User();
			$this->userDao = new UserDao();
			$this->access = new Access();
			$this->accessDao = new AccessDao();
		}
		
		/**
		 * Varifica qual view se destina e executa a m&eacute;todos pertinentes a ela 
		 */
		public function exec () {
			$a = isset($_GET['action']) ? $_GET['action'] : 'login';
			switch ($a) {
				case 'login':
					$this->login();
				break;
				case 'cadastro':
					$this->cadastro();
				break;
				case 'capaAdmin':
					$this->capaAdmin();
				break;
				case 'capaUsuarioComum':
					$this->capaUsuarioComum();
				break;
				case 'sair':
					session_start();
					unset($_SESSION['user']);
					session_destroy();
					header('location:?action=login');
					ob_end_flush();
				break;
			} 
		}

///////////////////////////////Metodos Auxiliares///////////////////////////////////
		
		private function login () {
			if ($_POST) {
				$login = $_POST['login'];
				$password = md5($_POST['password'] . 'sistema de login');
				$this->user = $this->userDao->load($login);
				if ($this->user->getPassword() === $password) {
					session_start();
					$_SESSION['user'] =  $this->user;
					$this->access->setType('login');
					$this->access->setUser($this->user);
					$this->accessDao->addUpdate($this->access);
					if ($this->user->getType() === 'admin') {
						ob_clean();
//						var_dump($this->user->getPassword(), '<br>', $password, '<br>', $this->user->getType(), '<br>', $_SESSION['user']);
						header('location:?action=capaAdmin');
						ob_end_flush();
					} else {
						header('location:?action=capaUsuarioComum');
					}
				} else {
					VwLogin::login('Login ou senha incorretos ou n&atilde;o cadastrados! ');
				}
				return;
			}
			VwLogin::login();
		}
		
		private function cadastro () {
			VwLogin::cadastro();
		}
		
		private function capaAdmin () {
			session_start();
			$user = $_SESSION['user'];
			if ($user->getType() === 'admin') {
				$users = $this->userDao->load();
				VwLogin::capaAdmin($users, $user);
			} else header('?action=login');
		}
		
		private function capaUsuarioComum () {
			session_start();
			$user = $_SESSION['user'];
			if ($user->getType() === 'comum') {
				VwLogin::capaUsuarioComum();
			} else header('?action=login');
		}
	}
}