<!-- Current user form -->
<?php echo Form::open(array('action' => 'login', 'id' => 'login')) ?>
    <div class="loginPic">
        <a href="#" title=""><?php echo Casset::img('aquincum::userLogin2.png'); ?></a>
        <span><a href="#" class="buttonL bBlue flip">Ainda não sou cadastro</a></span>
        <div class="loginActions">
            <div><a href="#" title="Cadastrar-se" class="logleft flip tipE"></a></div>
            <div><a href="#" title="Esqueci minha senha!" class="logright tipW"></a></div>
        </div>
    </div>

    <input type="text" name="username" id="username" placeholder="Insira o seu email" class="loginEmail" />
    <input type="password" name="password" id="password" placeholder="Insira a sua senha" class="loginPassword" />

    <div class="logControl">
        <input type="submit" name="submit" value="Entrar" class="buttonM bBlue" />
        <div class="clear"></div>
    </div>
<?php echo Form::close(); ?>

<!-- New user form -->
<?php echo Form::open(array('action' => 'cadastro', 'id' => 'recover')) ?>
    <div class="loginPic">
        <a href="#" title=""><?php echo Casset::img('aquincum::userLogin2.png'); ?></a>
        <span>// Cadastro</span>
        <div class="loginActions">
            <div><a href="#" title="Login" class="logback flip tipE"></a></div>
            <div><a href="#" title="Esqueci minha senha!" class="logright tipW"></a></div>
        </div>
    </div>

    <input type="text" id="cadastro_username" name="cadastro_username" placeholder="Digite o seu email" class="loginEmail" />
    <input type="password" id="cadastro_password" name="cadastro_password" placeholder="Digite uma senha" class="loginPassword" />
    <input type="password" id="cadastro_password_2" name="cadastro_password_2" placeholder="Digite a senha novamente" class="loginPassword" />

    <div class="logControl">
        <input type="submit" name="submit" value="Cadastrar" class="buttonM bBlue" />
    </div>
<?php echo Form::close(); ?>