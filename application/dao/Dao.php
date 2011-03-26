<?php
namespace login\application\dao {
	use PDO;
	class Dao {
		///////////////////////////////////////////////////////////////////
		/////////////////////ATRIBUTOS PRINCIPAIS//////////////////////////
		///////////////////////////////////////////////////////////////////
		protected $conn = null;
		private $host = 'localhost';
		private $banco = 'login';
		private $usuario = 'root';
		private $senha = '';
		///////////////////////////////////////////////////////////////////
		//////////////////////METODOS PRINCIPAIS///////////////////////////
		///////////////////////////////////////////////////////////////////
		
		public function __construct () {
			$this->connect();
			$this->exportToTxt();
			$this->exportToXML();
		}
		
		///////////////////////////////////////////////////////////////////
		//////////////////////METODOS ALXILIARES///////////////////////////
		///////////////////////////////////////////////////////////////////
		
		private function connect () {
			$this->conn = new PDO('mysql:host=localhost;dbname=login', 'root', '');
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		
		private function exportToTxt () {
			$pathTxt = _PATH_FILES_ . 'txt/';
			if (!is_dir($pathTxt))
				mkdir($pathTxt, 0777, true);
				
			$usuarios = fopen($pathTxt . 'user.txt', 'w');
			$queryUsuarios = 'SELECT * FROM user ORDER BY id';
			$u = $this->conn->query($queryUsuarios)->fetchAll();
			if ($u) {
				foreach ($u as $arrayUsers) {
					fwrite($usuarios, $arrayUsers['id'] . ';' . $arrayUsers['login'] . ';' . $arrayUsers['password'] . ';' . $arrayUsers['type'] . "\n");
				}
			}
			fclose($usuarios);
			
			$acessos = fopen($pathTxt . 'access.txt', 'w');
			$queryAcessos = 'SELECT * FROM access ORDER BY id';
			$u = $this->conn->query($queryAcessos)->fetchAll();
			if ($u) {
				foreach ($u as $arrayAcessos) {
					fwrite($acessos, $arrayAcessos['id'] . ';' . $arrayAcessos['type'] . ';' . $arrayAcessos['datehour'] . ';' . $arrayAcessos['user_id'] . "\n");
				}
			}
			fclose($acessos);
			
		}
		
		private function exportToXML () {
			$pathXml = _PATH_FILES_ . 'xml/';
			if (!is_dir($pathXml))
				mkdir($pathXml, 0777, true);
				
			$xmlUsuario = fopen($pathXml . 'user.xml', 'w');
			$querySetores = 'SELECT * FROM user ORDER BY id';
			$usuarios = $this->conn->query($querySetores)->fetchAll();
			$arquivo = '<?xml version="1.0" encoding="UTF-8"?>';
			$arquivo .= '<users>';
			if ($usuarios) {
				foreach ($usuarios as $usuario) {
					$arquivo .= '<user id="' . $usuario['id'] . '" login="' . utf8_encode($usuario['login']) . '" password="' . $usuario['password'] . '" type="' . $usuario['type'] . '" />';
				}
			}
			$arquivo .= '</users>';
			$escrevendoXml = fwrite($xmlUsuario, $arquivo);
			$xml = fclose($xmlUsuario);
			
			$xmlAcesso = fopen($pathXml . 'access.xml', 'w');
			$querySetores = 'SELECT * FROM access ORDER BY id';
			$acessos = $this->conn->query($querySetores)->fetchAll();
			$arquivo = '<?xml version="1.0" encoding="UTF-8"?>';
			$arquivo .= '<accesses>';
			if ($acessos) {
				foreach ($acessos as $acesso) {
					$arquivo .= '<access id="' . $acesso['id'] . '" type="' . $acesso['type'] . '" datehour="' . $acesso['datehour'] . '" user_id="' . $acesso['user_id'] . '" />';
				}
			}
			$arquivo .= '</accesses>';
			$escrevendoXml = fwrite($xmlAcesso, $arquivo);
			$xml = fclose($xmlAcesso);
		}
	}
}