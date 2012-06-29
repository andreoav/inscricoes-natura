<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Sistema de Inscrições :: Login</title>
    <?php echo Casset::render_css(); ?>
    <!--[if IE]><link href="<?php echo Uri::create('aquincum/css/ie.css'); ?>" rel="stylesheet" type="text/css"><![endif]-->
    <!-- Javascripts -->
    <?php echo Casset::render_js(); ?>
</head>
<body>
    <!-- Top line begins -->
    <div id="top">
        <div class="wrapper">
            <a href="#" title="" class="logo"><?php echo Casset::img('aquincum::logo.png'); ?></a>
            <div class="clear"></div>
            <div class="fluid">
                <div class="grid3">&nbsp;</div>
                <div class="grid6">
                    <?php echo View::forge('flash'); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Top line ends -->
    <!-- Login wrapper begins -->
    <div class="loginWrapper">
        <?php echo $conteudo; ?>
    </div>
    <!-- Login wrapper ends -->
</body>
</html>