<?php
namespace login\application\entities {
	class User {
		private $id = null;
		private $login = null;
		private $password = null;
		private $type = null;
		
		/**
		 * Atribui um valor ao 'id' do usuario
		 * @param int $NewId Identificador do usuario
		 */
		public function setId ($NewId) {
			$this->id = $NewId;
		}
		
		/**
		 * Atribui um valor ao 'login' do usuario
		 * @param string $newLogin Login de acesso do usuario
		 */
		public function setLogin ($newLogin) {
			$this->login = $newLogin;
		}
		
		/**
		 * Atribui um valor a 'password' do usuario
		 * @param string $newPassword Senha de acesso do usuario
		 */
		public function setPassword ($newPassword) {
			$this->password = $newPassword;
		}
		
		/**
		 * 
		 * Atribui um valor ao tipo de usuario
		 * @param string $newType Tipo de usuario ('admin' ou 'comum')
		 */
		public function setType ($newType) {
			$this->type = $newType;
		}
		
		/**
		 * Retorna o 'id' do usuario
		 * @return int $id Identificador do usuario
		 */
		public function getId () {
			return $this->id;
		}
		
		/**
		 * Retorna o 'login' do usuario
		 * @return string $login Login do usuario
		 */
		public function getLogin () {
			return $this->login;
		}
		
		/**
		 * Retorna a 'password' do usuario
		 * @return string $password Senha de acesso do usuario
		 */
		public function getPassword () {
			return $this->password;
		}
		
		/**
		 * Retorna o tipo de usuario em questao
		 * @return $type Tipo de usuario ('admin' ou 'comum')
		 */
		public function getType () {
			return $this->type;
		}
	}
}