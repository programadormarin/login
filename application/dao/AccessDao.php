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
	use Exception;
	class AccessDao extends Dao {
		/**
		 * Cadatra um novo acesso de usuario(user)
		 * @return boolean
		 */
		public function addUpdate (Access $access) {
			$sql = 'INSERT INTO access (type, datehour, user_id) VALUES(?, now(), ?)';
			$statement = $this->conn->prepare($sql);
			$statement->bindParam(1, $access->getType(), PDO::PARAM_STR);
			$statement->bindParam(2, $access->getUser()->getId(), PDO::PARAM_INT);
			if ($statement->execute()) {
				return $this->load($access->getType());
			} else throw new Exception('Problemas ao cadastrar novo usu&aacute;rio!');
		}
		
		/**
		 * Exclui um usuario(user) existente
		 * @return boolean
		 */
		public function remove (Access $access) {
			if (!$this->load($access->getId())) 
				throw new Exception('Acesso existente!');
			$sql = 'DELETE FROM access WHERE id = ? ORDER BY id LIMIT 1';
			$statement = $this->conn->prepare($sql);
			$statement->bindParam(1, $user->getId(), PDO::PARAM_STR);
			if ($statement->execute()) {
				return true;
			} else throw new Exception('Problemas ao remover usu&aacute;rio!');
		}
		
		/**
		 * Lista acessos cadastrados
		 * @param int/User/null $idLogin Pode ser o id, User ou null para listar todos acessos cadastrados
		 * @return boolean false, Access ou array[Access]
		 */
		public function load($idUser = null) {
			if (is_numeric($idUser)) {
				$sql = 'SELECT * FROM access WHERE id = ?';
				$statement = $this->conn->prepare($sql);
				$statement->execute(array($idUser));
				$acesso = $statement->fetch();
				if ($acesso) {
					$access = new Access();
					$user = new UserDao();
					$access->setId($acesso['id']);
					$access->setType($acesso['type']);
					$access->setDateHour($acesso['datehour']);
					$access->setUser($user->load($acesso['user_id']));
					return $access;
				} else return false;
			} elseif (is_object($idUser)) {
				$sql = 'SELECT * FROM access WHERE user_id = ?';
				$statement = $this->conn->prepare($sql);
				$statement->execute(array($idUser->getId()));
				if ($statement) {
					$accesses = array();
					foreach ($statement as $acesso) {
						$access = new Access();
						$user = new UserDao();
						$access->setId($acesso['id']);
						$access->setType($acesso['type']);
						$access->setDateHour($acesso['datehour']);
						$access->setUser($user->load($acesso['user_id']));
						$accesses[] = $access;
					}
					return $accesses;
				} else return false;
			} else {
				$query = 'SELECT * FROM access ORDER BY id';
				$statement = $this->conn->query($query)->fetchAll();
				if ($statement) {
					$accesses = array();
					foreach ($statement as $acesso) {
						$access = new Access();
						$user = new UserDao();
						$access->setId($acesso['id']);
						$access->setType($acesso['type']);
						$access->setDateHour($acesso['datehour']);
						$access->setUser($user->load($acesso['user_id']));
						$accesses[] = $access;
					}
					return $accesses;
				} else return false;
			}
		}
	}
}