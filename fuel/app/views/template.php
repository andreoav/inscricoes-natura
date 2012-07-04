<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?php echo isset($pagina_titulo) ? $pagina_titulo : 'Inscrições - Natura Clube de Orientação'; ?></title>
    <?php echo Casset::render_css(); ?>
    <!--[if IE]><link href="<?php echo Uri::create('aquincum/css/ie.css'); ?>" rel="stylesheet" type="text/css"><![endif]-->
    <!-- Javascripts -->
    <script type="text/javascript">var base_url = "<?php echo \Uri::base(); ?>";</script>
    <?php echo Casset::render_js(); ?>
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