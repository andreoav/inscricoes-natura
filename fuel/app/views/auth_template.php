<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login | Sistema de Inscrições</title>
    <?php echo Asset::css('login-style.css'); ?>
    <?php echo Asset::css('validationEngine.jquery.css'); ?>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
</head>
<body>
	<div class="main">
		<?php echo $conteudo; ?>
		<span class="copy">Sistema desenvolvido por Andreo Vieira</span>
	</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <?php echo Asset::js('bootstrap.min.js'); ?>
    <?php echo Asset::js('jquery.validationEngine.js'); ?>
    <?php echo Asset::js('languages/jquery.validationEngine-pt_BR.js'); ?>
    <?php echo Asset::js('app.login.js'); ?>
</body>
</html>