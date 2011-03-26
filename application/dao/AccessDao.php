<?php
namespace login\application\dao {
	require_once  _PATH_ENTITIES_ . 'Access.php';
	require_once _PATH_ENTITIES_ . 'User.php';
	require_once  _PATH_DAO_ . 'Dao.php';
	require_once _PATH_DAO_ . 'UserDao.php';
	use login\application\dao\UserDao;
	use login\application\entities\User;
	use login\application\entities\Access;
	use PDO;
	class AccessDao extends Dao {
		/**
		 * Cadatra um novo acesso de usuario(user)
		 * @return boolean
		 */
		public function add () {
			
		}
		
		/**
		 * Exclui um usuario(user) existente
		 * @return boolean
		 */
		public function remove () {
			
		}
		
		/**
		 * Lista acessos cadastrados
		 * @param int/User/null $idLogin Pode ser o id, User ou null para listar todos acessos cadastrados
		 * @return boolean false, Access ou array[Access]
		 */
		public function load($idUser = null) {
			if (is_numeric($idLogin)) {
				$sql = 'SELECT * FROM access WHERE id = ?';
				$statement = $this->conn->prepare($sql);
				$statement->execute(array($idLogin));
				$acesso = $statement->fetch();
				if ($acesso) {
					$access = new Access();
					$user = new UserDao();
					$access->setId($acesso['id']);
					$access->setType($acesso['type']);
					$access->setDateHour($acesso['password']);
					$access->setUser($user->load($acesso['id']));
					return $access;
				} else return false;
			} elseif (is_object($idLogin)) {
				$sql = 'SELECT * FROM access WHERE user_id = ?';
				$statement = $this->conn->prepare($sql);
				$statement->execute(array($idLogin->getId));
				$acesso = $statement->fetch();
				if ($acesso) {
					$access = new Access();
					$user = new UserDao();
					$access->setId($acesso['id']);
					$access->setType($acesso['type']);
					$access->setDateHour($acesso['password']);
					$access->setUser($user->load($acesso['id']));
					return $access;
				} else return false;
			} else {
				$query = 'SELECT * FROM user ORDER BY id';
				$statement = $this->conn->query($query)->fetchAll();
				if ($statement) {
					$accesses = array();
					foreach ($statement as $acesso) {
						$access = new Access();
						$user = new UserDao();
						$access->setId($acesso['id']);
						$access->setType($acesso['type']);
						$access->setDateHour($acesso['password']);
						$access->setUser($user->load($acesso['id']));
						$access[] = $access;
					}
					return $accesses;
				} else return false;
			}
		}
	}
}