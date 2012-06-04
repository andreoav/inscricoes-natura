<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8">
		<title>Sistema de Inscrições | Natura Clube de Orientação</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Sistema de Inscrições em etapas de campeonatos de orientação.">
		<meta name="author" content="Andreo Vieira">

		<!-- Le styles -->
		<?php echo Asset::css('bootstrap.css'); ?>
		<style type="text/css">
			body {
				padding-top: 50px;
				padding-bottom: 40px;
			}
		</style>
		<?php echo Asset::css('bootstrap-responsive.min.css'); ?>
		<?php echo Asset::css('jquery.dataTables-bootstrap.css'); ?>
		<?php echo Asset::css('validationEngine.jquery.css'); ?>
		<?php echo Asset::css('chosen.css'); ?>
		<?php echo Asset::css('colorbox.css'); ?>

		<style type="text/css">
			.map {
			    height: 400px;
			    border: 1px solid #000;
			    margin-bottom: 20px;
			}

			.map img {
				max-width: none;
			}

			.map p{
				margin: 10px;
				color: #333;
			}
		</style>

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="../assets/ico/favicon.ico">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
	</head>

	<body>
		<?php if (Sentry::check()): ?>
			<div class="navbar navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<a class="brand" href="#"><?php echo Config::get('sysconfig.app.name'); ?></a>
						<div class="btn-group pull-right">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="icon-user"></i> <?php echo Sentry::user()->get('metadata.nome') ?: 'Novo Usuário'; ?>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><?php echo Html::anchor('usuario/perfil', 'Meu Perfil'); ?></li>
								<?php if (Sentry::user()->is_admin()): ?>
									<li><?php echo Html::anchor('admin/painel', 'Administração'); ?></li>
								<?php endif ?>
								<li class="divider"></li>
								<li><?php echo Html::anchor('logout', 'Sair'); ?></li>
							</ul>
						</div>
						<div class="nav-collapse">
							<ul class="nav">
								<li class="active"><?php echo Html::anchor('/', 'Home'); ?></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										Inscrições
										<b class="caret"></b>
									</a>
									<ul class="dropdown-menu">
										<li><?php echo Html::anchor('inscricoes/nova', 'Nova Inscrição'); ?></li>
										<li><?php echo Html::anchor('inscricoes', 'Minhas Inscrições'); ?></li>
									</ul>
								</li>
								<li><?php echo Html::anchor('etapas', 'Etapas'); ?></li>
							</ul>
						</div><!--/.nav-collapse -->
					</div>
				</div>
			</div>
			<div class="container">
				<?php if(Session::get('profile_unfinished') == true): ?>
					<div class="alert alert-error">
						<strong>Perfil Incompleto!</strong> Atualmente o seu perfil está incompleto. Não será possível realizar uma nova inscrição até que dados como seu cpf, data de nascimento e nome completo estejam cadastrados em seu perfil! 
						Atualize o seu perfil através <?php echo Html::anchor('usuario/perfil', 'deste link', array('rel' => 'tooltip', 'title' => 'Atualize o seu perfil!')); ?>.
					</div>
				<?php endif; ?>
				<?php echo View::forge('flash'); ?>
				<?php echo $conteudo; ?>
				<footer>
					<hr><p class="pull-right"><small>Sistema desenvolvido por <a href="#" rel="tooltip" title="Acesse o site do desenvolvedor">Andreo Vieira</a></small></p>
				</footer>
			</div>
			<!--/.container-->
		<?php else: ?>
			<div class="navbar navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<a class="brand" href="#"><?php echo Config::get('sysconfig.app.name'); ?></a>
					</div>
				</div>
			</div>
			<div class="container">
				<?php echo View::forge('flash'); ?>
				<?php echo $conteudo; ?>
			</div>
		<?php endif; ?>

		<!-- Le javascript ================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script type="text/javascript">var base_url = "<?php echo \Uri::base(); ?>";</script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<?php echo Asset::js('jquery-1.7.2.min.js'); ?>
		<?php echo Asset::js('bootstrap.min.js'); ?>
		<?php echo Asset::js('jquery.dataTables.js'); ?>
		<?php echo Asset::js('jquery.dataTables-bootstrap.js'); ?>
		<?php echo Asset::js('jquery.maskedinput-1.3.min.js'); ?>
		<?php echo Asset::js('jquery.validationEngine.js'); ?>
		<?php echo Asset::js('languages/jquery.validationEngine-pt_BR.js'); ?>
		<?php echo Asset::js('jquery.colorbox-min.js'); ?>
		<?php echo Asset::js('jquery.gmap.min.js'); ?>
		<?php echo Asset::js('chosen.jquery.min.js'); ?>
		<?php echo Asset::js('app.core.js'); ?>

		<?php if (isset($localidade_map)): ?>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#localidade_map').gMap({
					address: "<?php echo $localidade_map; ?>",
					zoom: 15,
					markers: [
						{
							address: "<?php echo $localidade_map; ?>",
						}
					]
				});
			});
		</script>
		<?php endif ?>

	</body>
</html>