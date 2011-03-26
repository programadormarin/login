<?php
namespace login\application\view {
	use login\application\entities\User;

	require_once _PATH_VIEW_ . 'View.php';
	class VwLogin extends View {
		public static function login($except = null) {
			self::header();
			if ($except):
?>
<div id="excecao">
	<p><?php echo $except; ?></p>
</div>
<?php endif; ?>
<div id="form">
	<h3>Sistema de login</h3>
	<form action="?action=login" method="post">
		<p>
			Usuario:<br /><input type="text" id="usuario" name="login" class="text">
		</p>
		<p>
			Senha:<br /><input type="password" id="senha" name="password" class="text">
		</p>
		<input type="submit" name="entrar" value="Entrar">
	</form>
	<a href="?action=cadastro" title="Cadastre-se">Para cadastrar-se, clique aqui!</a>
</div>
<?php 
			self::footer();
		}
		
		public static function capaUsuarioComum(User $user, array $acessos) {
			self::header();
?>
<div id="conteudo">
	<p><strong><a href="?action=sair" id="sair">Sair</a></strong></p>
	<h1>&Aacute;rea do Usu&aacute;rio</h1>
	<div id="cadastro">
		<h3>Meu cadastro</h3>
		<form action="?action=capaUsuarioComum" method="post">
			<p>
				Usuario:<br /><input type="text" id="usuario" name="login" class="text" value="<?php echo $user->getLogin(); ?>">
			</p>
			<p>
				Senha:<br /><input type="password" id="senha" name="password" class="text"> <small>Preencha para alterar a senha.</small>
			</p>
			<input type="submit" name="alterar" value="Alterar">
		</form>
	</div>
	<div id="acessos">
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
		
		public static function cadastro($except = null) {
			self::header();
			if ($except):
?>
<div id="excecao">
	<p><?php echo $except; ?></p>
</div>
<?php endif; ?>
<div id="form">
	<h3>Cadastro de usuario comum</h3>
	<form action="?action=login" method="post">
		<p>
			Usuario:<br /><input type="text" id="usuario" name="login" class="text">
		</p>
		<p>
			Senha:<br /><input type="password" id="senha" name="password" class="text">
		</p>
		<input type="submit" name="entrar" value="Entrar">
	</form>
	<a href="?action=login" title="Cadastre-se">Voltar ao login.</a>
</div>
<?php 
		}
	}
}