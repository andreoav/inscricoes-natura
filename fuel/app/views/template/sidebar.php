<!-- Sidebar begins -->
<div id="sidebar">
    <div class="mainNav">
        <div class="user">
            <a title="" class="leftUserDrop"><?php echo Casset::img('aquincum::user2.png'); ?></a>
            <ul class="leftUser">
                <li><a href="<?php echo Uri::create('perfil'); ?>" title="" class="sProfile">Meu Perfil</a></li>
                <?php if(Sentry::user()->is_admin()): ?>
                    <li><a href="<?php echo Uri::create('admin'); ?>" title="" class="sSettings">Administração</a></li>
                <?php endif ?>
                <li><?php echo Html::anchor('logout', 'Sair', array('class' => 'sLogout')); ?></li>
            </ul>
        </div>

        <!-- Main nav -->
        <ul class="nav">
            <li><a href="<?php echo Uri::create('home') ?>" title="" class="active"><?php echo Casset::img('aquincum::icons/mainnav/dashboard.png'); ?><span>Meu Painel</span></a></li>
            <li><a href="<?php echo Uri::create('noticias') ?>" title="" class=""><?php echo Casset::img('aquincum::icons/mainnav/messages.png'); ?><span>Notícias</span></a></li>
            <li><a href="<?php echo Uri::create('inscricoes'); ?>" title=""><?php echo Casset::img('aquincum::icons/mainnav/forms.png'); ?><span>Inscrições</span></a></li>
            <li><a href="<?php echo Uri::create('etapas'); ?>" title=""><?php echo Casset::img('aquincum::icons/mainnav/tables.png'); ?><span>Etapas</span></a></li>
            <li><a href="<?php echo Uri::create('faq'); ?>" title=""><?php echo Casset::img('aquincum::icons/mainnav/other.png'); ?><span>Ajuda</span></a></li>
        </ul>
    </div>

    <!-- Secondary nav -->
    <div class="secNav">
        <div class="secWrapper">
            <ul class="iconsLine ic1">
                <li><a href="#general" title="" class="exp subClosed"><?php echo Sentry::user()->get('email'); ?></a></li>
            </ul>
            <div class="divider"><span></span></div>

            <div id="general">
                <div class="sidePad">
                    <?php echo Html::anchor('inscricoes/nova', 'Nova Inscrição', array('class' => 'sideB bLightBlue mt10')); ?>
                    <?php echo Html::anchor('logout', 'Sair do Sistema', array('class' => 'sideB bRed mt10')); ?>
                    <?php if(Sentry::user()->is_admin()): ?>
                        <?php echo Html::anchor('admin', 'Administração', array('class' => 'sideB bRed mt10')); ?>
                    <?php endif ?>
                </div>
                <div class="divider"><span></span></div>
            </div>

            <!-- Sidebar datepicker -->
            <div class="sideWidget">
                <div class="inlinedate"></div>
            </div>

        </div>
        <div class="clear"></div>
    </div>
</div>
<!-- Sidebar ends -->