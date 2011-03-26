<?php
namespace login\application\view {
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
			self::footer();
		}
		
		public static function capaUsuarioComum() {
			self::header();
?>
<div id="conteudo">
	<h1>&Aacute;rea do Usu&aacute;rio</h1>
	
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