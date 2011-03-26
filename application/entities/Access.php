<?php
namespace login\application\entities {
	use login\application\entities\User;
	class Access {
		private $id = null;
		private $type = null;
		private $dateHour = null;
		private $user = null;
		
		/**
		 * Atribui um valor ao 'id' do acesso
		 * @param int $newId Identificador do acesso
		 */
		public function setId ($newId) {
			$this->id = $newId;
		}
		
		/**
		 * 
		 * Atribui um valor ao tipo do acesso
		 * @param string $newType Tipo de acesso (login, logout)
		 */
		public function setType ($newType) {
			$this->type = $newType;
		}
		
		/**
		 * Atribui a hora e data do acesso
		 * @param DatetTime $newTimeDate Eh o momento do acesso de login ou logout
		 */
		public function setDateHour ($newDateHour) {
			$this->dateHour = $newDateHour;
		}
		
		/**
		 * Atribui a hora e data do acesso
		 * @param User $newTimeDate Eh o momento do acesso de login ou logout
		 */
		public function setUser (User $newUser) {
			$this->user = $newUser;
		}
		
		/**
		 * Retorna o 'id' do acesso
		 * @return int $id Identificador de acesso
		 */
		public function getId () {
			return $this->id;
		}
		
		/**
		 * Retorna o tipo do acesso
		 * @return string $type Tipo de acesso (login ou logout)
		 */
		public function getType () {
			return $this->type;
		}
		
		/**
		 * Retorna o DateTime no monento do acesso
		 * @return DateTime $dateHour Data e hora do acesso
		 */
		public function getDateHour () {
			return $this->dateHour;
		}
		
		/**
		 * Retorna o usuario do acesso
		 * @return User $user Usuario do acesso
		 */
		public function getUser () {
			return $this->user;
		}
	}
}