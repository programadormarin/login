<?php
namespace login\application\view {
	class View {
		public static function header () { 
		?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
		<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
				<script type="text/javascript" src="public/js/jquery-1.5.1.min.js"></script>
				<script type="text/javascript" src="public/js/validacao.js"></script>
				<title>Sistema de Login</title>
			</head>
			<body>
			<table cellpadding="3" cellspacing="0" border="0" align="center">
				<tr>
					<td>
		<?php 
		}
		
		public static function footer () {
		?>
						</td>
					</tr>
				</table>
			</body>
		</html>
		<?php
		}
	}
}