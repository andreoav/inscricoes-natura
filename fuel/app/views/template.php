<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?php echo isset($pagina_titulo) ? $pagina_titulo : 'Inscrições - Natura Clube de Orientação'; ?></title>

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
        <a href="<?php echo Uri::create('home/index'); ?>" title="" class="logo"><?php echo Casset::img('aquincum::logo.png');?></a>

        <!-- Right top nav -->
        <div class="topNav">
            <ul class="userNav">
                <li><a href="<?php echo Uri::create('perfil'); ?>" title="" class="profile"></a></li>
                <li><a href="<?php echo Uri::create('logout'); ?>" title="Sair" class="logout"></a></li>
                <li class="showTabletP"><a href="#" title="" class="sidebar"></a></li>
            </ul>
            <a title="" class="iButton"></a>
            <a title="" class="iTop"></a>
            <div class="topSearch">
                <div class="topDropArrow"></div>
                <form action="">
                    <input type="text" placeholder="pesquisar..." name="topSearch" />
                    <input type="submit" value="" />
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!-- Top line ends -->

<!-- Inicio Sidebar -->
<!-- TODO: Main navigation para telas menores -->
<?php echo View::forge(isset($custom_sidebar) ? $custom_sidebar : 'template/sidebar'); ?>
<!-- Final Sidebar -->

<!-- Content begins -->
<div id="content">
    <?php echo $conteudo; ?>
</div>
<!-- Content ends -->
</body>
</html>