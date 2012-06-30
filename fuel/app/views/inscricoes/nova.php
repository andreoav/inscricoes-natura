<?php echo View::forge('template/topbar', array('tPage' => 'Nova Inscrição', 'icon' => 'icon-screen')); ?>
<?php echo Utils::criarBreadcrumb(Uri::segments()); ?>

<div class="wrapper">
    <?php echo View::forge('flash'); ?>

    <form action="" class="main">
        <fieldset>
        <div class="fluid">
        <div class="widget grid6">
            <div class="whead"><h6>Formulário de Inscrição</h6><div class="clear"></div></div>

            <div class="formRow">
                <div class="grid3"><label>Multiple with search:</label></div>
                <div class="grid9">
                    <select data-placeholder="Your Favorite Football Team" class="fullwidth select" multiple="multiple" tabindex="6">
                        <option value=""></option>
                        <optgroup label="NFC EAST">
                            <option>Dallas Cowboys</option>
                            <option selected="selected">New York Giants</option>
                            <option>Philadelphia Eagles</option>
                            <option>Washington Redskins</option>
                        </optgroup>
                        <optgroup label="NFC NORTH">
                            <option selected="selected">Chicago Bears</option>
                            <option>Detroit Lions</option>
                            <option>Green Bay Packers</option>
                            <option>Minnesota Vikings</option>
                        </optgroup>
                        <optgroup label="NFC SOUTH">
                            <option selected="selected">Atlanta Falcons</option>
                            <option>Carolina Panthers</option>
                            <option>New Orleans Saints</option>
                            <option>Tampa Bay Buccaneers</option>
                        </optgroup>
                        <optgroup label="NFC WEST">
                            <option>Arizona Cardinals</option>
                            <option>St. Louis Rams</option>
                            <option>San Francisco 49ers</option>
                            <option>Seattle Seahawks</option>
                        </optgroup>
                        <optgroup label="AFC EAST">
                            <option>Buffalo Bills</option>
                            <option>Miami Dolphins</option>
                            <option>New England Patriots</option>
                            <option>New York Jets</option>
                        </optgroup>
                        <optgroup label="AFC NORTH">
                            <option>Baltimore Ravens</option>
                            <option>Cincinnati Bengals</option>
                            <option>Cleveland Browns</option>
                            <option>Pittsburgh Steelers</option>
                        </optgroup>
                        <optgroup label="AFC SOUTH">
                            <option>Houston Texans</option>
                            <option>Indianapolis Colts</option>
                            <option>Jacksonville Jaguars</option>
                            <option>Tennessee Titans</option>
                        </optgroup>
                        <optgroup label="AFC WEST">
                            <option>Denver Broncos</option>
                            <option>Kansas City Chiefs</option>
                            <option>Oakland Raiders</option>
                            <option>San Diego Chargers</option>
                        </optgroup>
                    </select>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="widget grid6">
            <div class="whead">
                <h6>Informações da Etapa</h6>
                <div class="clear"></div>
            </div>
        </div>
        </fieldset>
    </form>
</div>