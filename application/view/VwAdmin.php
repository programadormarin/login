<?php
namespace login\application\view {
	require_once _PATH_VIEW_ . 'View.php';
	class VwLogin extends View {
		public static function login($except = null) {
			if ($except):
?>
<div id="excecao">
	<p><?php echo $except; ?></p>
</div>
<?php endif; ?>
<div id="form">
	<form action="?action=login" method="post">
		<p>
			Usuario:<br /><input type="text" name="login" class="text">
		</p>
		<p>
			Senha:<br /><input type="password" name="password" class="text">
		</p>
		<input type="submit" name="entrar" value="Entrar">
	</form>
	<a href="?action=cadastro" title="Cadastre-se">Para cadastrar-se, clique aqui!</a>
</div>
<?php 
		} 
		
		public static function capaAdmin($users, $usuario, $acessos) {
?>
<div id="conteudo">
	<a href="?action=sair" id="sair">Sair</a>
	<h1 align="center">&Aacute;rea do Administrador</h1>
	<div>
		<table cellpadding="2" cellspacing="0" align="center" border="0" id="usuarios" width="300">		
			<tr bgcolor="#dadada">
				<td width="20%" align="center">
					<h3 align="center">Meu Cadastro</h3>
					<form action="admin?action=alterar" method="post">
						<p>
							Usuario:<br />
							<input type="text" name="login" value="<?php echo $usuario->getLogin(); ?>">
						</p>
						<p>
							Senha:<br />
							<input type="password" name="password" value="<?php echo $usuario->getPassword(); ?>">
						</p>
						<input type="submit" name="alterar" value="Alterar">
					</form>
				</td>
			</tr>
		</table>
	</div>
	<div>
		<h3 align="center">Usu&aacute;rios Cadastrados</h3>
		<table cellpadding="3" cellspacing="0" align="center" border="0" id="usuarios" width="800">		
			<tr bgcolor="#dadada">
				<td width="10%" align="center">
					<strong>Id</strong>
				</td>
				<td width="50%" align="center">
					<strong>Login</strong>
				</td>
				<td width="25%" align="center">
					<strong>Tipo</strong>
				</td>
				<td align="center">
					<a href="?action=adicionar" title="Adicionar">
						<img src="<?php echo _PATH_FILES_; ?>img/adicionar.gif" alt="Adicionar">
					</a>
				</td>
			</tr>
			<?php 
				foreach ($users as $user) {
					if ($user->getId() !== $usuario->getId()) :
			?>
			<tr>
				<td>
					<?php echo $user->getId();?>
				</td>
				<td>
					<?php echo $user->getLogin();?>
				</td>
				<td>
					<?php echo $user->getType();?>
				</td>
				<td align="center">
					<a href="?action=detalhar&id=<?php echo $user->getId();?>" title="Detalhar">
						<img src="<?php echo _PATH_FILES_; ?>img/detalhar.gif" alt="Detalhar">
					</a>
					<a href="?action=alterar&id=<?php echo $user->getId();?>" title="Alterar">
						<img src="<?php echo _PATH_FILES_; ?>img/alterar.gif" alt="Alterar">
					</a>
					<a href="?action=excluir&id=<?php echo $user->getId();?>" title="Excluir">
						<img src="<?php echo _PATH_FILES_; ?>img/excluir.gif" alt="Excluir">
					</a>
				</td>
			</tr>
			<?php 
					endif;
				} 
			?>
		</table>
	</div>
	<div class="table">
		<h3 align="center">Hist&oacute;rico de Acessos</h3>
		<table cellpadding="2" cellspacing="0" align="center" border="0" id="usuarios" width="300">		
			<tr bgcolor="#dadada">
				<td width="20%" align="center">
					<strong>Id</strong>
				</td>
				<td align="center">
					<strong>Tipo</strong>
				</td>
				<td width="60%" align="center">
					<strong>Data/hora</strong>
				</td>
			</tr>
			<?php 
				foreach ($acessos as $acesso) {
					$dataHora = explode(' ', $acesso->getDateHour());
					$data = explode('-', $dataHora[0]);
					$data = $data[2] . '/' . $data[1] . '/' . $data[0];
					$hora = $dataHora[1];
					$dataHora = $data . ' as ' . $hora;
			?>
			<tr>
				<td align="center">
					<?php echo $acesso->getId();?>
				</td>
				<td align="center">
					<?php echo $acesso->getType();?>
				</td>
				<td align="center">
					<?php echo $dataHora;?>
				</td>
			</tr>
			<?php 
				} 
			?>
		</table>
	</div>
</div>
<?php 
		}
		
		public static function capaUsuarioComum() {
?>
<div id="conteudo">
	<h1>&Aacute;rea do Usu&aacute;rio</h1>
	
</div>
<?php 
		}
		
		public static function cadastro($except) {
			if ($except):
?>
<div id="excecao">
	<p><?php echo $except; ?></p>
</div>
<?php endif; ?>
<div id="form">
	<form action="?action=login" method="post">
		<p>
			Usuario:<br /><input type="text" name="login" class="text">
		</p>
		<p>
			Senha:<br /><input type="password" name="password" class="text">
		</p>
		<input type="submit" name="entrar" value="Entrar">
	</form>
	<a href="?action=login" title="Cadastre-se">Voltar ao login.</a>
</div>
<?php 
		}
	}
}