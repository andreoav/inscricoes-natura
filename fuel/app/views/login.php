<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Sistema de Inscrições :: Login</title>

    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="chrome=1">
        <link href="<?php echo Uri::create('aquincum/css/ie.css'); ?>" rel="stylesheet" type="text/css">
    <![endif]-->

    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- CSS -->
    <?php echo Casset::render_css(); ?>
    <!-- Javascripts -->
    <script type="text/javascript">var base_url = "<?php echo \Uri::base(); ?>";</script>
    <?php echo Casset::render_js(); ?>

    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-10399091-2']);
        _gaq.push(['_setDomainName', 'naturaco.org']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
    <!-- Fim dos Javascripts -->

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
                    <?php if(Agent::browser() == 'IE'): ?>
                        <div class="nNote nInformation">
                            <p>Recomendamos o uso do Google Chrome, Mozilla Firefox ou Internet Explorer 9+ para visualizar este site.<br/>Versões mais antigas do IE podem apresentar problemas.</p>
                        </div>
                    <?php endif ?>
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