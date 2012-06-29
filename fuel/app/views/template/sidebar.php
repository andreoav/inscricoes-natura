<!-- Sidebar begins -->
<div id="sidebar">
    <div class="mainNav">
        <div class="user">
            <a title="" class="leftUserDrop"><?php echo Casset::img('aquincum::user.png'); ?><span><strong>3</strong></span></a>
            <ul class="leftUser">
                <li><a href="#" title="" class="sProfile">Meu Perfil</a></li>
                <?php if(Sentry::user()->is_admin()): ?>
                <li><a href="#" title="" class="sSettings">Administração</a></li>
                <?php endif ?>
                <li><?php echo Html::anchor('logout', 'Sair', array('class' => 'sLogout')); ?></li>
            </ul>
        </div>

        <!-- Responsive nav -->
        <div class="altNav">
            <div class="userSearch">
                <form action="">
                    <input type="text" placeholder="search..." name="userSearch" />
                    <input type="submit" value="" />
                </form>
            </div>

            <!-- User nav -->
            <ul class="userNav">
                <li><a href="#" title="" class="profile"></a></li>
                <li><a href="#" title="" class="messages"></a></li>
                <li><a href="#" title="" class="settings"></a></li>
                <li><a href="#" title="" class="logout"></a></li>
            </ul>
        </div>

        <!-- Main nav -->
        <ul class="nav">
            <li><a href="index.html" title="" class="active"><?php echo Casset::img('aquincum::icons/mainnav/dashboard.png'); ?><span>Meu Painel</span></a></li>
            <li><a href="ui.html" title=""><?php echo Casset::img('aquincum::icons/mainnav/ui.png'); ?><span>UI elements</span></a>
                <ul>
                    <li><a href="ui.html" title=""><span class="icol-fullscreen"></span>General elements</a></li>
                    <li><a href="ui_icons.html" title=""><span class="icol-images2"></span>Icons</a></li>
                    <li><a href="ui_buttons.html" title=""><span class="icol-coverflow"></span>Button sets</a></li>
                    <li><a href="ui_grid.html" title=""><span class="icol-view"></span>Grid</a></li>
                    <li><a href="ui_custom.html" title=""><span class="icol-cog2"></span>Custom elements</a></li>
                    <li><a href="ui_experimental.html" title=""><span class="icol-beta"></span>Experimental</a></li>
                </ul>
            </li>
            <li><a href="forms.html" title=""><?php echo Casset::img('aquincum::icons/mainnav/forms.png'); ?><span>Forms stuff</span></a>
                <ul>
                    <li><a href="forms.html" title=""><span class="icol-list"></span>Inputs &amp; elements</a></li>
                    <li><a href="form_validation.html" title=""><span class="icol-alert"></span>Validation</a></li>
                    <li><a href="form_editor.html" title=""><span class="icol-pencil"></span>File uploader &amp; WYSIWYG</a></li>
                    <li><a href="form_wizards.html" title=""><span class="icol-signpost"></span>Form wizards</a></li>
                </ul>
            </li>
            <li><a href="messages.html" title=""><?php echo Casset::img('aquincum::icons/mainnav/messages.png'); ?><span>Messages</span></a></li>
            <li><a href="statistics.html" title=""><?php echo Casset::img('aquincum::icons/mainnav/statistics.png'); ?><span>Statistics</span></a></li>
            <li><a href="tables.html" title=""><?php echo Casset::img('aquincum::icons/mainnav/tables.png'); ?><span>Tables</span></a>
                <ul>
                    <li><a href="tables.html" title=""><span class="icol-frames"></span>Standard tables</a></li>
                    <li><a href="tables_dynamic.html" title=""><span class="icol-refresh"></span>Dynamic table</a></li>
                    <li><a href="tables_control.html" title=""><span class="icol-bullseye"></span>Tables with control</a></li>
                    <li><a href="tables_sortable.html" title=""><span class="icol-transfer"></span>Sortable and resizable</a></li>
                </ul>
            </li>
            <li><a href="other_calendar.html" title=""><?php echo Casset::img('aquincum::icons/mainnav/other.png'); ?><span>Other pages</span></a>
                <ul>
                    <li><a href="other_calendar.html" title=""><span class="icol-dcalendar"></span>Calendar</a></li>
                    <li><a href="other_gallery.html" title=""><span class="icol-images2"></span>Images gallery</a></li>
                    <li><a href="other_file_manager.html" title=""><span class="icol-files"></span>File manager</a></li>
                    <li><a href="#" title="" class="exp"><span class="icol-alert"></span>Error pages <span class="dataNumRed">6</span></a>
                        <ul>
                            <li><a href="other_403.html" title="">403 error</a></li>
                            <li><a href="other_404.html" title="">404 error</a></li>
                            <li><a href="other_405.html" title="">405 error</a></li>
                            <li><a href="other_500.html" title="">500 error</a></li>
                            <li><a href="other_503.html" title="">503 error</a></li>
                            <li><a href="other_offline.html" title="">Website is offline error</a></li>
                        </ul>
                    </li>
                    <li><a href="other_typography.html" title=""><span class="icol-create"></span>Typography</a></li>
                    <li><a href="other_invoice.html" title=""><span class="icol-money2"></span>Invoice template</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- Secondary nav -->
    <div class="secNav">
        <div class="secWrapper">
            <!-- Tabs container -->
            <ul class="iconsLine ic1">
                <li><a href="#general" title="" class="exp subClosed">Menu</a></li>
            </ul>

            <div class="divider"><span></span></div>

            <div id="general">
                <!-- Sidebar big buttons -->
                <div class="sidePad">
                    <a href="#" title="" class="sideB bLightBlue">Nova Inscrição</a>
                </div>

                <div class="divider"><span></span></div>

                <!-- Sidebar chart -->
                <div class="numStats">
                    <ul>
                        <li><a href="#" title="">2751</a><span>pedidos</span></li>
                        <li><a href="#" title="">748</a><span>aprovados</span></li>
                        <li class="last"><a href="#" title="">357</a><span>pendentes</span></li>
                    </ul>
                    <div class="clear"></div>
                </div>

                <div class="divider"><span></span></div>
            </div>

            <!-- Sidebar datepicker -->
            <div class="sideWidget">
                <div class="inlinedate"></div>
            </div>

            <div class="divider"><span></span></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!-- Sidebar ends -->