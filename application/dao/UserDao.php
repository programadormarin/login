<?php
namespace login\application\dao {
	require_once  _PATH_ENTITIES_ . 'User.php';
	require_once  _PATH_DAO_ . 'Dao.php';
	use login\application\entities\User;
	use PDO;
	use Exception;
	class UserDao extends Dao {
		/**
		 * Cadastra um novo usuario(user)
		 * @return boolean false ou User
		 * @param User $user Usuario a ser cadastrado
		 */
		public function addUpdate (User $user) {
			if ($user->getId() == null)  {
				if ($this->load($user->getLogin()))
					throw new Exception('Login de usu&aacute;rio j&aacute; existente!');
				$sql = 'INSERT INTO user (login, password, type) VALUES(?, ?, ?)';
			} else $sql = 'UPDATE user SET login=?, password=?, type=? WHERE id = ' . $user->getId();
			$statement = $this->conn->prepare($sql);
			$statement->bindParam(1, $user->getLogin(), PDO::PARAM_STR);
			$statement->bindParam(2, $user->getPassword(), PDO::PARAM_STR);
			$statement->bindParam(3, $user->getType(), PDO::PARAM_STR);
			if ($statement->execute()) {
				return $this->load($user->getLogin());
			} else throw new Exception('Problemas ao cadastrar novo usu&aacute;rio!');
		}
		
		/**
		 * Exclui um usuario(user) existente
		 * @return boolean false ou User
		 * @param User $user Usuario a ser cadastrado
		 */
		public function remove (User $user) {
			if (!$this->load($user->getId())) 
				throw new Exception('Usuario existente!');
			$sql = 'DELETE FROM user WHERE id = ? ORDER BY id LIMIT 1';
			$statement = $this->conn->prepare($sql);
			$statement->bindParam(1, $user->getId(), PDO::PARAM_INT);
			if ($statement->execute()) {
				return true;
			} else throw new Exception('Problemas ao remover usu&aacute;rio!');
		}
		
		/**
		 * Lista usuarios cadastrados
		 * @param int/string/null $idLogin Pode ser o id, o login ou null para listar todos cadastrados
		 * @return boolean false, User ou array[User]
		 */
		public function load($idLogin = null) {
			if (is_numeric($idLogin)) {
				$sql = 'SELECT * FROM user WHERE id = ?';
				$statement = $this->conn->prepare($sql);
				$statement->execute(array($idLogin));
				$usuario = $statement->fetch();
				if ($usuario) {
					$user = new User();
					$user->setId($usuario['id']);
					$user->setLogin($usuario['login']);
					$user->setPassword($usuario['password']);
					$user->setType($usuario['type']);
					return $user;
				} else return false;
			} elseif (is_string($idLogin)) {
				$sql = 'SELECT * FROM user WHERE login = ?';
				$statement = $this->conn->prepare($sql);
				$statement->execute(array($idLogin));
				$usuario = $statement->fetch();
				if ($usuario) {
					$user = new User();
					$user->setId($usuario['id']);
					$user->setLogin($usuario['login']);
					$user->setPassword($usuario['password']);
					$user->setType($usuario['type']);
					return $user;
				} else return false;
			} else {
				$query = 'SELECT * FROM user ORDER BY id';
				$statement = $this->conn->query($query)->fetchAll();
				if ($statement) {
					$users = array();
					foreach ($statement as $usuario) {
						$user = new User();
						$user->setId($usuario['id']);
						$user->setLogin($usuario['login']);
						$user->setPassword($usuario['password']);
						$user->setType($usuario['type']);
						$users[] = $user;
					}
					return $users;
				} else return false;
			}
		}
	}
}