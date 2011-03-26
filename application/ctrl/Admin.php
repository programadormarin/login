<?php
namespace login\application\ctrl {
	use login\application\view\VwAdmin;

	use login\application\dao\AccessDao;
	use login\application\entities\Access;
	use login\application\dao\UserDao;
	use login\application\entities\User;
	use login\application\view\VwLogin;

	require_once _PATH_DAO_ . 'UserDao.php';
	require_once _PATH_DAO_ . 'AccessDao.php';
	require_once _PATH_VIEW_ . 'VwAdmin.php';
	
	class Admin {
///////////////////////////////Atributos Principais/////////////////////////////////
	
		private $user = null;
		private $access = null;
		private $userDao = null;
		private $accessDao = null;
		
///////////////////////////////Metodos Principais///////////////////////////////////
	
		public function __construct() {
			$this->user = new User();
			$this->access = new Access();
			$this->userDao = new UserDao();
			$this->accessDao = new AccessDao();
		}
		
		/**
		 * Varifica qual view se destina e executa a m&eacute;todos pertinentes a ela 
		 */
		public function exec () {
			$a = isset($_GET['action']) ? $_GET['action'] : 'capa';
			switch ($a) {
				case 'capa':
					$this->capa();
				break;
				case 'adicionar':
					$this->adicionar();
				break;
				case 'alterar':
					$this->alterar();
				break;
				case 'detalhar':
					$this->detalhar();
				break;
				case 'excluir':
					$this->excluir();
				break;
				case 'sair':
					$this->sair();
				break;
			} 
		}

///////////////////////////////Metodos Auxiliares///////////////////////////////////
		
		private function sair () {
			session_start();
			$this->user = $_SESSION['user'];
			$this->access->setType('logout');
			$this->access->setUser($this->user);
			$this->accessDao->addUpdate($this->access);
			unset($_SESSION['user']);
			session_destroy();
			header('location:login?action=login');
			ob_end_flush();
		}
		
		private function capa () {
			session_start();
			$user = $_SESSION['user'];
			if ($_POST) {
				$user->setLogin($_POST['login']);
				if (isset($_POST['password']) && $_POST['password'] != '')
					$user->setPassword(md5($_POST['password'] . 'sistema de login'));
				$this->userDao->addUpdate($user);  
			}
			if ($user->getType() === 'admin') {
				$users = $this->userDao->load();
				$this->access = $this->accessDao->load($user);
				VwAdmin::capa($users, $user, $this->access);
			} else header('location:login?action=login');
		}
		
		private function adicionar () {
			if ($_POST) {
				$this->user->setLogin($_POST['login']);
				$this->user->setPassword(md5($_POST['password'] . 'sistema de login'));
				$this->user->setType($_POST['type']);
				try {
					$this->userDao->addUpdate($this->user);
				} catch (Exception $e) {
					VwAdmin::adicionar($e->getMessage());
					return;
				}
				header('location:admin?action:capa');
			} else VwAdmin::adicionar();
		}
		
		private function detalhar () {
			if (isset($_GET['id']) && $_GET['id'] != '') {
				$this->user = $this->userDao->load($_GET['id']);
				$this->access = $this->accessDao->load($this->user);
				VwAdmin::detalhar($this->user, $this->access);
			} else header('location:admin?action=capa');
		}
		
		private function alterar () {
			if ($_POST) {
				$this->user->setId($_POST['id']);
				$this->user->setLogin($_POST['login']);
				$this->user->setPassword(md5($_POST['password'] . 'sistema de login'));
				$this->user->setType($_POST['type']);
				try {
					$this->userDao->addUpdate($this->user);
				} catch (Exception $e) {
					VwAdmin::alterar($this->user, $e->getMessage());
					return;
				}
				header('location:admin?action:capa');
				return;
			} 
			if (isset($_GET['id']) && $_GET['id'] != '') {
				$this->user = $this->userDao->load($_GET['id']);
				VwAdmin::alterar($this->user);
			} else header('location:admin?action=capa');
		}
		
		private function excluir () {
			if ($_POST) {
				if (isset($_POST['cancelar']) && $_POST['cancelar'] === 'Cancelar') header('location:admin?action=capa');
				else {
					$this->user = $this->userDao->load($_POST['id']);
					if ($this->user) {
						try {
							$this->userDao->remove($this->user);
						} catch (Exception $e) {
							VwAdmin::excluir($this->user, $e->getMessage());
							return;
						}
						header('location:admin?action=capa');
					}
				}
				return;
			}
			if (isset($_GET['id']) && $_GET['id'] != '') {
				$this->user = $this->userDao->load($_GET['id']);
				VwAdmin::excluir($this->user);
			} else header('location:admin?action=capa');
		}
		
		
	}
}