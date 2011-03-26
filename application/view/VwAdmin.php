<?php
namespace login\application\view {
	require_once _PATH_VIEW_ . 'View.php';
	class VwAdmin extends View {
		
		public static function capa($users, $usuario, $acessos, $msg = null) {
			self::header();
?>
<div id="conteudo">
	<a href="?action=sair" id="sair">Sair</a>
	<h1 align="center">&Aacute;rea do Administrador</h1>
	<div id="login">
		<h3 align="center">Meu Cadastro</h3>
		<?php if ($msg) echo "<p>$msg</p>"?>
		<form action="admin?action=capa" method="post">
			<p>
				Usuario:<br />
				<input type="text" name="login" value="<?php echo $usuario->getLogin(); ?>">
			</p>
			<p>
				Senha:<br />
				<input type="password" name="password"> <small>Preencha para alterar a senha.</small>
			</p>
			<input type="submit" name="alterar" value="Alterar">
		</form>
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
			self::footer();
		}
		
		public static function adicionar($except = null) {
			self::header();
			if ($except):
?>
<div id="excecao">
	<p><?php echo $except; ?></p>
</div>
<?php endif; ?>
<div id="form">
	<h3>Cadastrar novo usu&aacute;rio</h3>
	<form action="?action=adicionar" method="post">
		<p>
			Usuario:<br /><input type="text" name="login" class="text">
		</p>
		<p>
			Senha:<br /><input type="password" name="password" class="text">
		</p>
		<p>
			Tipo:<br />
			<select name="type">
				<option value="admin">Administrador</option>
				<option value="comum">Usu&aacute;rio Comum</option>
			</select>
		</p>
		<input type="submit" name="cadastrar" value="Cadastrar">
	</form>
	<a href="?action=login" title="Voltar a capa">Voltar a capa.</a>
</div>
<?php 
			self::footer();
		}
		
		public static function detalhar($user, $acessos) {
			self::header();
?>
<div id="form">
	<p><a href="?action=capa" title="Voltar a capa">Voltar a capa.</a></p>
	<h3>Informa&ccedil;&otilde;es do usuario</h3>
	<p>
		Usuario: <?php echo $user->getLogin(); ?>
	</p>
	<p>
		Tipo: 
		<?php 
			if ($user->getType() === 'admin')
				echo 'Administrador';
			else  echo 'Usu&aacute;rio comum';
		?>
	</p>
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
	<p><a href="?action=capa" title="Voltar a capa">Voltar a capa.</a></p>
</div>
<?php 
			self::footer();
		}
	
		public static function alterar($user, $except = null) {
			self::header();
			if ($except):
?>
<div id="excecao">
	<p><?php echo $except; ?></p>
</div>
<?php endif; ?>
<div id="form">
	<h3>Alterar cadastro de usuario</h3>
	<form action="admin?action=alterar" method="post">
		<input type="hidden" name="id" value="<?php echo $user->getId();?>">
		<p>
			Usuario:<br /><input type="text" name="login" class="text" value="<?php echo $user->getLogin();?>">
		</p>
		<p>
			Senha:<br /><input type="password" name="password" class="text"><small>Preencha para alterar a senha.</small>
		</p>
		<p>
			Tipo:<br />
			<select name="type">
				<?php if ($user->getType() === 'admin'): ?>
					<option value="admin" selected="selected">Administrador</option>
					<option value="comum">Usu&aacute;rio Comum</option>
				<?php endif;?>
				<?php if ($user->getType() === 'comum'): ?>
					<option value="admin">Administrador</option>
					<option value="comum" selected="selected">Usu&aacute;rio Comum</option>
				<?php endif;?>
			</select>
		</p>
		<input type="submit" name="entrar" value="Alterar">
	</form>
	<a href="?action=capa" title="Voltar a capa">Voltar a capa.</a>
</div>
<?php 
			self::footer();
		}
		
		public static function excluir($user, $except = null) {
			self::header();
			if ($except):
?>
<div id="excecao">
	<p><?php echo $except; ?></p>
</div>
<?php endif; ?>
<div id="form">
	<h3>Exclus&atilde;o de usuario</h3>
	<p>Confirme a exclus&atilde;o do usuario '<?php echo $user->getLogin(); ?>' abaixo:</p>
	<form action="admin?action=excluir" method="post">
		<input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
		<p>
			<input type="submit" name="excluir" value="Excluir">
			<input type="submit" name="cancelar" value="Cancelar">
		</p>
	</form>
</div>
<?php 
			self::footer();
		}
	}
}